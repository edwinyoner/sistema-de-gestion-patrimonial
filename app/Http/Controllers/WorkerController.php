<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\JobPosition;
use App\Models\Office;
use App\Models\ContractType; // Agregado para incluir tipos de contrato
use Illuminate\Http\Request;
use App\Http\Requests\WorkerRequest;
use Illuminate\Support\Facades\Log;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = Worker::with(['office', 'jobPosition', 'contractType'])->get();
        return view('modules.workers.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobPositions = JobPosition::where('status', true)->get();
        $offices = Office::where('status', true)->get();
        $contractTypes = ContractType::where('status', true)->get(); // Agregado
        return view('modules.workers.create', compact('jobPositions', 'offices', 'contractTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkerRequest $request)
    {
        try {
            Worker::create($request->validated());
            return redirect()->route('workers.index')->with('success', 'Trabajador creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear el trabajador. Inténtalo de nuevo.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        return view('modules.workers.show', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worker $worker)
    {
        $jobPositions = JobPosition::where('status', true)->get();
        $offices = Office::where('status', true)->get();
        $contractTypes = ContractType::where('status', true)->get(); // Agregado
        return view('modules.workers.edit', compact('worker', 'jobPositions', 'offices', 'contractTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkerRequest $request, Worker $worker)
    {
        try {
            Log::info('Request data: ', $request->all()); // Depuración

            // Procesar el valor de status desde el request
            $status = $request->has('status') ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN) : $worker->status;
            Log::info('Processed status: ', ['status' => $status]); // Depuración adicional

            // Usar validated() para mantener consistencia con el Request
            $data = $request->validated();
            $data['status'] = $status; // Asegurar que status se maneje manualmente si es necesario

            // Intentar actualizar el trabajador
            $worker->fill($data)->save();

            return redirect()
                ->route('workers.index')
                ->with('success', 'El trabajador ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error updating worker: ' . $e->getMessage()); // Log del error
            return redirect()->back()
                ->with('error', 'Error al actualizar el trabajador: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        try {
            Log::info('Attempting to delete worker: ', ['worker_id' => $worker->id]);

            // No se puede eliminar si tiene bienes asignados
            
            if ($worker->company_assets()->exists()) {
                throw new \Exception('No se puede eliminar este trabajador porque tiene bienes asignados.');
            }
            

            $worker->delete();

            return redirect()
                ->route('workers.index')
                ->with('success', 'El trabajador ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error deleting worker: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el trabajador: ' . $e->getMessage());
        }
    }
}