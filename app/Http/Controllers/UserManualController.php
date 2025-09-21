<?php

namespace App\Http\Controllers;

use App\Models\UserManual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserManualController extends Controller
{
    public function __construct()
    {
        // Middleware de autenticación para todas las rutas
        $this->middleware('auth');

        // Middleware de permisos específicos
        $this->middleware('permission:view-manuals')->only(['index', 'show']);
        $this->middleware('permission:download-manuals')->only(['download', 'view']);
        $this->middleware('permission:manage-manuals')->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy',
            'toggleStatus'
        ]);
    }

    // Vista principal - accesible para todos los usuarios autenticados
    public function index()
    {
        // Verificar permiso básico
        if (!Auth::user()->can('view-manuals')) {
            abort(403, 'No tiene permisos para ver los manuales.');
        }

        $query = UserManual::active()->latest()->with('uploader');

        // Si no es admin, solo mostrar manuales activos
        if (!Auth::user()->can('manage-manuals')) {
            $query->where('is_active', true);
        }

        $manuals = $query->paginate(10);
        $canManage = Auth::user()->can('manage-manuals');

        return view('modules.manuals.index', compact('manuals', 'canManage'));
    }

    public function show($id)
    {
        $manual = UserManual::with('uploader')->findOrFail($id);
        return view('modules.manuals.show', compact('manual'));
    }

    public function download(UserManual $user_manual)
    {
        // Verificar permisos de descarga
        if (!Auth::user()->can('download-manuals')) {
            abort(403, 'No tiene permisos para descargar manuales.');
        }

        // Verificar que el manual esté activo para usuarios no-admin
        if (
            !$user_manual->is_active &&
            !\Illuminate\Support\Facades\Gate::allows('manage-manuals')
        ) {
            abort(404, 'Manual no encontrado.');
        }

        if (!Storage::disk('private')->exists($user_manual->file_path)) {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }

        // Registrar la descarga (opcional)
        $this->logDownload($user_manual);

        $filePath = storage_path('app/private/' . $user_manual->file_path);
        return response()->download($filePath, $user_manual->file_name);
    }

    public function view(UserManual $user_manual)
    {
        // Verificar permisos de visualización
        if (!Auth::user()->can('download-manuals')) {
            abort(403, 'No tiene permisos para ver manuales.');
        }

        // Solo PDFs son visualizables
        if (!$user_manual->is_viewable) {
            return redirect()->route('user_manuals.download', $user_manual);
        }

        // Verificar que el manual esté activo para usuarios no-admin
        if (!$user_manual->is_active && !Auth::user()->can('manage-manuals')) {
            abort(404, 'Manual no encontrado.');
        }

        if (!Storage::disk('private')->exists($user_manual->file_path)) {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }

        $file = Storage::disk('private')->get($user_manual->file_path);

        return response($file, 200)
            ->header('Content-Type', $user_manual->file_type)
            ->header('Content-Disposition', 'inline; filename="' . $user_manual->file_name . '"');
    }

    // Resto de métodos CRUD (solo para admins)
    public function create()
    {
        return view('modules.manuals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'version' => 'required|string|max:20',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'is_active' => 'boolean'
        ]);

        $file = $request->file('file');
        $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('manuals', $fileName, 'private');

        UserManual::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'version' => $request->version,
            'is_active' => $request->boolean('is_active', true),
            'uploaded_by' => Auth::id()
        ]);

        return redirect()->route('user_manuals.index')
            ->with('success', 'Manual cargado exitosamente.');
    }

    public function edit($id)
    {
        $manual = UserManual::findOrFail($id);
        return view('modules.manuals.edit', compact('manual'));
    }

    public function update(Request $request, $id)
    {
        $manual = UserManual::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'version' => 'required|string|max:20',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'is_active' => 'boolean'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'version' => $request->version,
            'is_active' => $request->boolean('is_active', true)
        ];

        if ($request->hasFile('file')) {
            if ($manual->file_path && Storage::disk('private')->exists($manual->file_path)) {
                Storage::disk('private')->delete($manual->file_path);
            }

            $file = $request->file('file');
            $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('manuals', $fileName, 'private');

            $data['file_name'] = $file->getClientOriginalName();
            $data['file_path'] = $filePath;
            $data['file_type'] = $file->getMimeType();
            $data['file_size'] = $file->getSize();
        }

        $manual->update($data);

        return redirect()->route('user_manuals.index')
            ->with('success', 'Manual actualizado exitosamente.');
    }

    public function destroy(UserManual $manual)
    {
        // Eliminar archivo físico
        if (Storage::disk('private')->exists($manual->file_path)) {
            Storage::disk('private')->delete($manual->file_path);
        }

        $manual->delete();

        return redirect()->route('user_manuals.index')
            ->with('success', 'Manual eliminado exitosamente.');
    }

    public function toggleStatus(UserManual $manual)
    {
        $manual->update(['is_active' => !$manual->is_active]);

        $status = $manual->is_active ? 'activado' : 'desactivado';
        return redirect()->back()->with('success', "Manual {$status} exitosamente.");
    }

    // Método privado para registrar descargas (opcional)
    private function logDownload(UserManual $manual)
    {
        // Implementar logging si se requiere
        logger('Manual downloaded', [
            'manual_id' => $manual->id,
            'manual_title' => $manual->title,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'downloaded_at' => now(),
            'ip_address' => request()->ip()
        ]);
    }
}
