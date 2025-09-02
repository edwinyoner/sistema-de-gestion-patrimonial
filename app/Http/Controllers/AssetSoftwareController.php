<?php

namespace App\Http\Controllers;

use App\Models\AssetSoftware;
use App\Http\Requests\AssetSoftwareRequest;
use App\Models\CompanyAsset;
use App\Models\SoftwareType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AssetSoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetSoftwares = AssetSoftware::with(['companyAsset', 'softwareType'])->get();
        return view('modules.asset_softwares.index', compact('assetSoftwares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companyAssets = CompanyAsset::all();
        $softwareTypes = SoftwareType::all();
        return view('modules.asset_softwares.create', compact('companyAssets', 'softwareTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssetSoftwareRequest $request)
    {
        try {
            $softwareData = $request->only([
                'company_asset_id',
                'software_type_id',
                'software_name',
                'version',
                'license_key',
                'license_expiry',
                'description',
                'status'
            ]);
            Log::info('Datos recibidos para crear software: ', $softwareData);

            // Validación condicional para license_key y license_expiry
            if ($request->software_type_id != 1) { // No PROPIETARIO
                $softwareData['license_key'] = null;
                $softwareData['license_expiry'] = null;
            } elseif ($request->software_type_id == 1) { // PROPIETARIO
                $request->validate([
                    'license_key' => 'required|string|max:255',
                    'license_expiry' => 'required|date',
                ], [
                    'license_key.required' => 'La clave de licencia es obligatoria para software PROPIETARIO.',
                    'license_expiry.required' => 'La fecha de expiración es obligatoria para software PROPIETARIO.',
                ]);
            }

            $assetSoftware = AssetSoftware::create($softwareData);
            Log::info('Software creado con ID: ' . $assetSoftware->id);

            return redirect()->route('asset_softwares.index')
                ->with('success', 'El software ha sido registrado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear software: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al registrar el software: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetSoftware $assetSoftware)
    {
        return view('modules.asset_softwares.show', compact('assetSoftware'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetSoftware $assetSoftware)
    {
        $companyAssets = CompanyAsset::all();
        $softwareTypes = SoftwareType::all();
        return view('modules.asset_softwares.edit', compact('assetSoftware', 'companyAssets', 'softwareTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssetSoftwareRequest $request, AssetSoftware $assetSoftware)
    {
        try {
            $softwareData = $request->only([
                'company_asset_id',
                'software_type_id',
                'software_name',
                'version',
                'license_key',
                'license_expiry',
                'description',
                'status'
            ]);
            Log::info('Datos recibidos para actualizar software: ', $softwareData);

            // Validación condicional para license_key y license_expiry
            if ($request->software_type_id != 1) { // No PROPIETARIO
                $softwareData['license_key'] = null;
                $softwareData['license_expiry'] = null;
            } elseif ($request->software_type_id == 1) { // PROPIETARIO
                $request->validate([
                    'license_key' => 'required|string|max:255',
                    'license_expiry' => 'required|date',
                ], [
                    'license_key.required' => 'La clave de licencia es obligatoria para software PROPIETARIO.',
                    'license_expiry.required' => 'La fecha de expiración es obligatoria para software PROPIETARIO.',
                ]);
            }

            $assetSoftware->update($softwareData);
            Log::info('Software actualizado con ID: ' . $assetSoftware->id);

            return redirect()->route('asset_softwares.index')
                ->with('success', 'El software ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar software: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar el software: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetSoftware $assetSoftware)
    {
        try {
            Log::info('Intentando eliminar software con ID: ' . $assetSoftware->id);
            $assetSoftware->delete();
            Log::info('Software eliminado con ID: ' . $assetSoftware->id);

            return redirect()->route('asset_softwares.index')
                ->with('success', 'El software ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar software: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar el software: ' . $e->getMessage());
        }
    }

    public function deletePhoto(CompanyAsset $companyAsset)
    {
        try {
            if ($companyAsset->photo_path) {
                Storage::delete(str_replace('/storage/', '', $companyAsset->photo_path));
                $companyAsset->update(['photo_path' => null]);
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false, 'message' => 'No hay foto para eliminar'], 400);
        } catch (\Exception $e) {
            Log::error('Error al eliminar foto: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al eliminar la foto'], 500);
        }
    }
}
