<?php

namespace App\Http\Controllers;

use App\Models\AssetMachinery;
use App\Http\Requests\AssetMachineryRequest;
use Illuminate\Support\Facades\Log;

class AssetMachineryController extends Controller
{
    /**
     * Muestra una lista de todas las maquinarias.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $machineryAssets = AssetMachinery::with('companyAsset')->get();
            return view('modules.asset_machineries.index', compact('machineryAssets'));
        } catch (\Exception $e) {
            Log::error('Error al listar maquinarias: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar la lista de maquinarias.');
        }
    }

    /**
     * Muestra el formulario para crear una nueva maquinaria.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        try {
            return view('modules.asset_machineries.create');
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de creación de maquinaria: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario de creación.');
        }
    }

    /**
     * Almacena una nueva maquinaria en el almacenamiento.
     *
     * @param AssetMachineryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AssetMachineryRequest $request)
    {
        try {
            $machinery = AssetMachinery::create($request->validated());
            Log::info('Maquinaria creada con ID: ' . $machinery->id);
            return redirect()->route('asset_machineries.index')->with('success', 'Maquinaria creada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear maquinaria: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al crear la maquinaria.')->withInput();
        }
    }

    /**
     * Muestra los detalles de una maquinaria específica.
     *
     * @param AssetMachinery $assetMachinery
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(AssetMachinery $assetMachinery)
    {
        try {
            $machineryAsset = $assetMachinery->load('companyAsset');
            return view('modules.asset_machineries.show', compact('machineryAsset'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar detalles de maquinaria con ID ' . $assetMachinery->id . ': ' . $e->getMessage());
            return redirect()->route('asset_machineries.index')->with('error', 'Ocurrió un error al cargar los detalles de la maquinaria.');
        }
    }

    /**
     * Muestra el formulario para editar una maquinaria específica.
     *
     * @param AssetMachinery $assetMachinery
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(AssetMachinery $assetMachinery)
    {
        try {
            $machineryAsset = $assetMachinery->load('companyAsset');
            return view('modules.asset_machineries.edit', compact('machineryAsset'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de edición de maquinaria con ID ' . $assetMachinery->id . ': ' . $e->getMessage());
            return redirect()->route('asset_machineries.index')->with('error', 'Ocurrió un error al cargar el formulario de edición.');
        }
    }

    /**
     * Actualiza una maquinaria específica en el almacenamiento.
     *
     * @param AssetMachineryRequest $request
     * @param AssetMachinery $assetMachinery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AssetMachineryRequest $request, AssetMachinery $assetMachinery)
    {
        try {
            $assetMachinery->update($request->validated());
            Log::info('Maquinaria actualizada con ID: ' . $assetMachinery->id);
            return redirect()->route('asset_machineries.index')->with('success', 'Maquinaria actualizada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar maquinaria con ID ' . $assetMachinery->id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la maquinaria.')->withInput();
        }
    }

    /**
     * Elimina una maquinaria específica del almacenamiento.
     *
     * @param AssetMachinery $assetMachinery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AssetMachinery $assetMachinery)
    {
        try {
            $assetMachinery->delete();
            Log::info('Maquinaria eliminada con ID: ' . $assetMachinery->id);
            return redirect()->route('asset_machineries.index')->with('success', 'Maquinaria eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar maquinaria con ID ' . $assetMachinery->id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar la maquinaria.');
        }
    }
}