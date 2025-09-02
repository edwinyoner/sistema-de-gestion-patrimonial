<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Requests\OfficeRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::all();
        return view('modules.offices.index', compact('offices'));
    }

    public function create()
    {
        return view('modules.offices.create');
    }

    public function store(OfficeRequest $request)
    {
        try {
            Office::create([
                'name' => strtoupper($request->name),
                'short_name' => strtoupper($request->short_name),
                'description' => $request->description,
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()
                ->route('offices.index')
                ->with('success', 'La oficina ha sido registrada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al registrar la oficina: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al registrar la oficina: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Office $office)
    {
        return view('modules.offices.show', compact('office'));
    }
    public function edit(Office $office)
    {
        return view('modules.offices.edit', compact('office'));
    }

    public function update(OfficeRequest $request, Office $office) 
    {
        try {
            Log::info('Request data: ', $request->all());
            $status = $request->has('status') ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN) : $office->status;
            Log::info('Processed status: ', ['status' => $status]);

            $office->fill([
                'name' => $request->name,
                'short_name' => $request->short_name,
                'description' => $request->description,
                'status' => $status,
            ])->save();

            return redirect()
                ->route('offices.index')
                ->with('success', 'La oficina ha sido actualizada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error updating office: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al actualizar la oficina: ' . $e->getMessage())
                ->withInput();
        }
    }
    public function destroy(Office $office)
    {
        try {
            Log::info('Attempting to delete office: ', ['office_id' => $office->id]);

            if ($office->workers()->exists()) {
                throw new \Exception('No se puede eliminar esta oficina porque está asignada a uno o más trabajadores.');
            }

            $office->delete();

            return redirect()
                ->route('offices.index')
                ->with('success', 'La oficina ha sido eliminada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error deleting office: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar la oficina: ' . $e->getMessage());
        }
    }
}