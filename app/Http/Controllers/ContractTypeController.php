<?php

namespace App\Http\Controllers;

use App\Models\ContractType;
use Illuminate\Http\Request;
use App\Http\Requests\ContractTypeRequest;
use Illuminate\Support\Facades\Log;

/**
 * Controlador para gestionar los tipos de contrato.
 */
class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$contractTypes = ContractType::withTrashed()->get(); // Incluye eliminados lógicamente
        $contractTypes = ContractType::all();
        return view('modules.contract_types.index', compact('contractTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.contract_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContractTypeRequest $request)
    {
        try {
            ContractType::create([
                'name' => strtoupper($request->name), // Usa strtoupper directamente
                'description' => $request->description,
                'status' => $request->has('status') ? true : false, // Valor por defecto desde el formulario
            ]);

            return redirect()
                ->route('contract_types.index')
                ->with('success', 'El tipo de contrato ha sido registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar el tipo de contrato: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ContractType $contractType)
    {
        return view('modules.contract_types.show', compact('contractType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractType $contractType)
    {
        return view('modules.contract_types.edit', compact('contractType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContractTypeRequest $request, ContractType $contractType)
    {
        try {
            Log::info('Request data: ', $request->all()); // Depuración

            // Procesar el valor de status desde el request
            $status = $request->has('status') ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN) : $contractType->status;
            Log::info('Processed status: ', ['status' => $status]); // Depuración adicional

            // Intentar actualizar el tipo de contrato
            $contractType->fill([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $status,
            ])->save();

            return redirect()
                ->route('contract_types.index')
                ->with('success', 'El tipo de contrato ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error updating contract type: ' . $e->getMessage()); // Log del error
            return redirect()->back()
                ->with('error', 'Error al actualizar el tipo de contrato: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContractType $contractType)
    {
        try {
            Log::info('Attempting to delete contract type: ', ['contract_type_id' => $contractType->id]);

            // Validar si el tipo de contrato tiene trabajadores asociados
            if ($contractType->workers()->exists()) {
                throw new \Exception('No se puede eliminar este tipo de contrato porque está asignado a uno o más trabajadores.');
            }

            $contractType->delete(); // Soft delete

            return redirect()
                ->route('contract_types.index')
                ->with('success', 'El tipo de contrato ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error deleting contract type: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el tipo de contrato: ' . $e->getMessage());
        }
    }
}