<?php

namespace App\Http\Controllers;

use App\Models\AssetOther;
use App\Http\Requests\AssetOtherRequest;
use Illuminate\Support\Facades\Log;

class AssetOtherController extends Controller
{
    /**
     * Muestra una lista de todos los activos diversos.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $otherAssets = AssetOther::with('companyAsset')->get();
            return view('modules.asset_others.index', compact('otherAssets'));
        } catch (\Exception $e) {
            Log::error('Error al listar activos diversos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar la lista de activos diversos.');
        }
    }

    /**
     * Muestra el formulario para crear un nuevo activo diverso.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        try {
            return view('modules.asset_others.create');
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de creación de activo diverso: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario de creación.');
        }
    }

    /**
     * Almacena un nuevo activo diverso en el almacenamiento.
     *
     * @param AssetOtherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AssetOtherRequest $request)
    {
        try {
            $other = AssetOther::create($request->validated());
            Log::info('Activo diverso creado con ID: ' . $other->id);
            return redirect()->route('asset_others.index')->with('success', 'Activo diverso creado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear activo diverso: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al crear el activo diverso.')->withInput();
        }
    }

    /**
     * Muestra los detalles de un activo diverso específico.
     *
     * @param AssetOther $assetOther
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(AssetOther $assetOther)
    {
        try {
            $otherAsset = $assetOther->load('companyAsset');
            return view('modules.asset_others.show', compact('otherAsset'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar detalles de activo diverso con ID ' . $assetOther->id . ': ' . $e->getMessage());
            return redirect()->route('asset_others.index')->with('error', 'Ocurrió un error al cargar los detalles del activo diverso.');
        }
    }

    /**
     * Muestra el formulario para editar un activo diverso específico.
     *
     * @param AssetOther $assetOther
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(AssetOther $assetOther)
    {
        try {
            $otherAsset = $assetOther->load('companyAsset');
            return view('modules.asset_others.edit', compact('otherAsset'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de edición de activo diverso con ID ' . $assetOther->id . ': ' . $e->getMessage());
            return redirect()->route('asset_others.index')->with('error', 'Ocurrió un error al cargar el formulario de edición.');
        }
    }

    /**
     * Actualiza un activo diverso específico en el almacenamiento.
     *
     * @param AssetOtherRequest $request
     * @param AssetOther $assetOther
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AssetOtherRequest $request, AssetOther $assetOther)
    {
        try {
            $assetOther->update($request->validated());
            Log::info('Activo diverso actualizado con ID: ' . $assetOther->id);
            return redirect()->route('asset_others.index')->with('success', 'Activo diverso actualizado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar activo diverso con ID ' . $assetOther->id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el activo diverso.')->withInput();
        }
    }

    /**
     * Elimina un activo diverso específico del almacenamiento.
     *
     * @param AssetOther $assetOther
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AssetOther $assetOther)
    {
        try {
            $assetOther->delete();
            Log::info('Activo diverso eliminado con ID: ' . $assetOther->id);
            return redirect()->route('asset_others.index')->with('success', 'Activo diverso eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar activo diverso con ID ' . $assetOther->id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el activo diverso.');
        }
    }
}