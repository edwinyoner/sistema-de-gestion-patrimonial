<?php

namespace App\Http\Controllers;

use App\Models\SoftwareType;
use Illuminate\Http\Request;
use App\Http\Requests\SoftwareTypeRequest;
use Illuminate\Support\Facades\Log;

class SoftwareTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $softwareTypes = SoftwareType::all();
        return view('modules.software_types.index', compact('softwareTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.software_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SoftwareTypeRequest $request)
    {
        try {
            SoftwareType::create([
                'name' => strtoupper($request->name),
                'description' => $request->description,
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()
                ->route('software_types.index')
                ->with('success', 'El tipo de software ha sido registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar el tipo de software: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SoftwareType $softwareType)
    {
        return view('modules.software_types.show', compact('softwareType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoftwareType $softwareType)
    {
        return view('modules.software_types.edit', compact('softwareType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SoftwareTypeRequest $request, SoftwareType $softwareType)
    {
        try {
            Log::info('Request data: ', $request->all());

            $status = $request->has('status') ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN) : $softwareType->status;
            Log::info('Processed status: ', ['status' => $status]);

            $softwareType->fill([
                'name' => strtoupper($request->name),
                'description' => $request->description,
                'status' => $status,
            ])->save();

            return redirect()
                ->route('software_types.index')
                ->with('success', 'El tipo de software ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error updating software type: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al actualizar el tipo de software: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoftwareType $softwareType)
    {
        try {
            Log::info('Attempting to delete software type: ', ['software_type_id' => $softwareType->id]);
            Log::info('Checking assetSoftwares relationship: ', ['exists' => $softwareType->assetSoftwares()->exists()]);

            if ($softwareType->assetSoftwares()->exists()) {
                throw new \Exception('No se puede eliminar el tipo de software porque está asignado a uno o más softwares.');
            }

            $softwareType->delete();

            return redirect()
                ->route('software_types.index')
                ->with('success', 'El tipo de software ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error deleting software type: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el tipo de software: ' . $e->getMessage());
        }
    }
}