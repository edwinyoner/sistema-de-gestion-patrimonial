<?php

namespace App\Http\Controllers;

use App\Models\AssetTool;
use App\Http\Requests\AssetToolRequest;
use Illuminate\Support\Facades\Log;

class AssetToolController extends Controller
{
    /**
     * Muestra una lista de todas las herramientas.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $toolAssets = AssetTool::with('companyAsset')->get();
            return view('modules.asset_tools.index', compact('toolAssets'));
        } catch (\Exception $e) {
            Log::error('Error al listar herramientas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar la lista de herramientas.');
        }
    }

    /**
     * Muestra el formulario para crear una nueva herramienta.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        try {
            return view('modules.asset_tools.create');
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de creación de herramienta: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario de creación.');
        }
    }

    /**
     * Almacena una nueva herramienta en el almacenamiento.
     *
     * @param AssetToolRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AssetToolRequest $request)
    {
        try {
            $tool = AssetTool::create($request->validated());
            Log::info('Herramienta creada con ID: ' . $tool->id);
            return redirect()->route('asset_tools.index')->with('success', 'Herramienta creada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear herramienta: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al crear la herramienta.')->withInput();
        }
    }

    /**
     * Muestra los detalles de una herramienta específica.
     *
     * @param AssetTool $assetTool
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(AssetTool $assetTool)
    {
        try {
            $toolAsset = $assetTool->load('companyAsset');
            return view('modules.asset_tools.show', compact('toolAsset'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar detalles de herramienta con ID ' . $assetTool->id . ': ' . $e->getMessage());
            return redirect()->route('asset_tools.index')->with('error', 'Ocurrió un error al cargar los detalles de la herramienta.');
        }
    }

    /**
     * Muestra el formulario para editar una herramienta específica.
     *
     * @param AssetTool $assetTool
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(AssetTool $assetTool)
    {
        try {
            $toolAsset = $assetTool->load('companyAsset');
            return view('modules.asset_tools.edit', compact('toolAsset'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de edición de herramienta con ID ' . $assetTool->id . ': ' . $e->getMessage());
            return redirect()->route('asset_tools.index')->with('error', 'Ocurrió un error al cargar el formulario de edición.');
        }
    }

    /**
     * Actualiza una herramienta específica en el almacenamiento.
     *
     * @param AssetToolRequest $request
     * @param AssetTool $assetTool
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AssetToolRequest $request, AssetTool $assetTool)
    {
        try {
            $assetTool->update($request->validated());
            Log::info('Herramienta actualizada con ID: ' . $assetTool->id);
            return redirect()->route('asset_tools.index')->with('success', 'Herramienta actualizada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar herramienta con ID ' . $assetTool->id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la herramienta.')->withInput();
        }
    }

    /**
     * Elimina una herramienta específica del almacenamiento.
     *
     * @param AssetTool $assetTool
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AssetTool $assetTool)
    {
        try {
            $assetTool->delete();
            Log::info('Herramienta eliminada con ID: ' . $assetTool->id);
            return redirect()->route('asset_tools.index')->with('success', 'Herramienta eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar herramienta con ID ' . $assetTool->id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar la herramienta.');
        }
    }
}