<?php

namespace App\Http\Controllers;

use App\Models\AssetHardware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Añadido para consistencia, aunque no se usa aún

class AssetHardwareController extends Controller
{
    public function index()
    {
        $hardwareAssets = AssetHardware::with('companyAsset')->get();
        return view('modules.asset_hardwares.index', compact('hardwareAssets'));
    }

    public function show($id)
    {
        try {
            $hardwareAsset = AssetHardware::with('companyAsset')->where('id', $id)->firstOrFail();
            return view('modules.asset_hardwares.show', compact('hardwareAsset'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Activo de hardware no encontrado: ID ' . $id, ['exception' => $e->getMessage()]);
            return redirect()->route('asset_hardwares.index')->with('error', 'El activo de hardware no fue encontrado.');
        }
    }
}