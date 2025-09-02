<?php

namespace App\Http\Controllers;

use App\Models\AssetType;
use Illuminate\Http\Request;
use App\Http\Requests\AssetTypeRequest;
use Illuminate\Support\Facades\Log;

class AssetTypeController extends Controller
{
    // Muestra una lista de todos los tipos de activos.
    public function index()
    {
        $assetTypes = AssetType::all();
        return view('modules.asset_types.index', compact('assetTypes'));
    }

    // Muestra el formulario para crear un nuevo tipo de activo.
    public function create()
    {
        return view('modules.asset_types.create');
    }

    // Almacena un nuevo tipo de activo en la base de datos.
    public function store(AssetTypeRequest $request)
    {
        try {
            AssetType::create([
                // Convierte el nombre a mayúsculas antes de guardarlo (usando el mutador del modelo).
                'name' => $request->name,
                'description' => $request->description,
                // Establece el estado según el formulario, con valor predeterminado true si no se envía.
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()
                ->route('asset_types.index')
                ->with('success', 'El tipo de activo ha sido registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar el tipo de activo: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Muestra los detalles de un tipo de activo específico.
    public function show(AssetType $assetType)
    {
        return view('modules.asset_types.show', compact('assetType'));
    }

    // Muestra el formulario para editar un tipo de activo específico.
    public function edit(AssetType $assetType)
    {
        return view('modules.asset_types.edit', compact('assetType'));
    }

    // Actualiza un tipo de activo específico en la base de datos.
    public function update(AssetTypeRequest $request, AssetType $assetType)
    {
        try {
            Log::info('Request data: ', $request->all()); // Depuración

            // Procesa el valor de status desde el request.
            $status = $request->has('status') ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN) : $assetType->status;
            Log::info('Processed status: ', ['status' => $status]); // Depuración adicional

            // Intenta actualizar el tipo de activo.
            $assetType->fill([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $status,
            ])->save();

            return redirect()
                ->route('asset_types.index')
                ->with('success', 'El tipo de activo ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error updating asset type: ' . $e->getMessage()); // Log del error
            return redirect()->back()
                ->with('error', 'Error al actualizar el tipo de activo: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Elimina un tipo de activo específico de la base de datos.
    public function destroy(AssetType $assetType)
    {
        try {
            Log::info('Attempting to delete asset type: ', ['asset_type_id' => $assetType->id]);

            // Valida si el tipo de activo tiene activos asociados.
            
            if ($assetType->companyAssets()->exists()) {
                throw new \Exception('No se puede eliminar este tipo de activo porque está asignado a uno o más activos.');
            }
            

            $assetType->delete(); // Soft delete

            return redirect()
                ->route('asset_types.index')
                ->with('success', 'El tipo de activo ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error deleting asset type: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el tipo de activo: ' . $e->getMessage());
        }
    }
}