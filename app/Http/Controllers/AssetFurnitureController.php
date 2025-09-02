<?php

namespace App\Http\Controllers;

use App\Models\AssetFurniture;
use Illuminate\Support\Facades\Log;

class AssetFurnitureController extends Controller
{
    public function index()
    {
        $furnitureAssets = AssetFurniture::with('companyAsset')->get();
        return view('modules.asset_furnitures.index', compact('furnitureAssets'));
    }

    public function show($id)
    {
        $furnitureAsset = AssetFurniture::with('companyAsset')->where('id', $id)->firstOrFail();
        return view('modules.asset_furnitures.show', compact('furnitureAsset'));
    }
}