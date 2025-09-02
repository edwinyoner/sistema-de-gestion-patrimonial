<?php

namespace App\Http\Controllers;

use App\Models\AssetState;
use Illuminate\Http\Request;
use App\Http\Requests\AssetStateRequest;
use Illuminate\Support\Facades\Log;

// Define el espacio de nombres para el controlador, indicando que pertenece al directorio App\Http\Controllers.
class AssetStateController extends Controller
{
    // Muestra una lista de todos los estados de activos.
    public function index()
    {
        $assetStates = AssetState::all();
        return view('modules.asset_states.index', compact('assetStates'));
    }

    // Muestra el formulario para crear un nuevo estado de activo.
    public function create()
    {
        return view('modules.asset_states.create');
    }

    // Almacena un nuevo estado de activo en la base de datos.
    public function store(AssetStateRequest $request)
    {
        try {
            AssetState::create([
                // Convierte el nombre a mayúsculas antes de guardarlo (usando el mutador del modelo).
                'name' => $request->name,
                'description' => $request->description,
                // Establece el estado según el formulario, con valor predeterminado true si no se envía.
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()
                ->route('asset_states.index')
                ->with('success', 'El estado de activo ha sido registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar el estado de activo: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Muestra los detalles de un estado de activo específico.
    public function show(AssetState $assetState)
    {
        return view('modules.asset_states.show', compact('assetState'));
    }

    // Muestra el formulario para editar un estado de activo específico.
    public function edit(AssetState $assetState)
    {
        return view('modules.asset_states.edit', compact('assetState'));
    }

    // Actualiza un estado de activo específico en la base de datos.
    public function update(AssetStateRequest $request, AssetState $assetState)
    {
        try {
            Log::info('Request data: ', $request->all()); // Depuración

            // Procesa el valor de status desde el request.
            $status = $request->has('status') ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN) : $assetState->status;
            Log::info('Processed status: ', ['status' => $status]); // Depuración adicional

            // Intenta actualizar el estado de activo.
            $assetState->fill([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $status,
            ])->save();

            return redirect()
                ->route('asset_states.index')
                ->with('success', 'El estado de activo ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error updating asset state: ' . $e->getMessage()); // Log del error
            return redirect()->back()
                ->with('error', 'Error al actualizar el estado de activo: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Elimina un estado de activo específico de la base de datos.
    public function destroy(AssetState $assetState)
    {
        try {
            Log::info('Attempting to delete asset state: ', ['asset_state_id' => $assetState->id]);
            if ($assetState->companyAssets()->exists()) {
                throw new \Exception('No se puede eliminar este estado de activo porque está asignado a uno o más activos.');
            }
            $assetState->delete();

            return redirect()
                ->route('asset_states.index')
                ->with('success', 'El estado de activo ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error deleting asset state: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el estado de activo: ' . $e->getMessage());
        }
    }
}
