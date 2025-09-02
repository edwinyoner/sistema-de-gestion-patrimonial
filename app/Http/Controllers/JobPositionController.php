<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use Illuminate\Http\Request;
use App\Http\Requests\JobPositionRequest;
use Illuminate\Support\Facades\Log;

class JobPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$jobPositions = JobPosition::withTrashed()->get(); // Incluye eliminados lógicamente
        $jobPositions = JobPosition::all();
        return view('modules.job_positions.index', compact('jobPositions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.job_positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPositionRequest $request)
    {
        try {
            JobPosition::create([
                'name' => strtoupper($request->name),
                'description' => $request->description,
                'status' => $request->has('status') ? true : false, // Valor por defecto desde el formulario
            ]);

            return redirect()
                ->route('job_positions.index')
                ->with('success', 'El cargo ha sido registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar el cargo: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosition $jobPosition)
    {
        return view('modules.job_positions.show', compact('jobPosition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPosition $jobPosition)
    {
        return view('modules.job_positions.edit', compact('jobPosition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPositionRequest $request, JobPosition $jobPosition)
    {
        try {
            Log::info('Request data: ', $request->all()); // Depuración

            // Procesar el valor de status desde el request
            $status = $request->has('status') ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN) : $jobPosition->status;
            Log::info('Processed status: ', ['status' => $status]); // Depuración adicional

            // Intentar actualizar el cargo
            $jobPosition->fill([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $status,
            ])->save();

            return redirect()
                ->route('job_positions.index')
                ->with('success', 'El cargo ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error updating job position: ' . $e->getMessage()); // Log del error
            return redirect()->back()
                ->with('error', 'Error al actualizar el cargo: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function destroy(JobPosition $jobPosition)
    {
        try {
            Log::info('Attempting to delete job position: ', ['job_position_id' => $jobPosition->id]);

            // Validar si el cargo tiene trabajadores asociados
            if ($jobPosition->workers()->exists()) {
                throw new \Exception('No se puede eliminar el cargo porque está asignado a uno o más trabajadores.');
            }

            $jobPosition->delete(); // Soft delete

            return redirect()
                ->route('job_positions.index')
                ->with('success', 'El cargo ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error deleting job position: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el cargo: ' . $e->getMessage());
        }
    }
}
