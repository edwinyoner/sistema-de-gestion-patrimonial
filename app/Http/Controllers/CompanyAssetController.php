<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyAssetRequest;
use App\Http\Requests\AssetFurnitureRequest;
use App\Http\Requests\AssetHardwareRequest;
use App\Http\Requests\AssetSoftwareRequest;
use App\Http\Requests\AssetMachineryRequest;
use App\Http\Requests\AssetToolRequest;
use App\Http\Requests\AssetOtherRequest;
use App\Htrp\Requests\SoftwareTypeRequest;
use App\Models\CompanyAsset;
use App\Models\AssetFurniture;
use App\Models\AssetType;
use App\Models\Office;
use App\Models\AssetState;
use App\Models\SoftwareType;
use App\Models\Worker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyAssetController extends Controller
{
    public function index()
    {
        $companyAssets = CompanyAsset::with(['office', 'assetState', 'assetType'])->get();
        return view('modules.company_assets.index', compact('companyAssets'));
    }

    public function create()
    {
        $offices = Office::all();
        $assetStates = AssetState::all();
        $assetTypes = AssetType::where('status', true)->get();
        $workers = Worker::all();
        $softwareTypes = SoftwareType::all(); // Añadido para el partial _software

        $assetTypeId = request()->input('asset_type_id') ?? old('asset_type_id');
        $assetTypeName = $assetTypeId ? optional(AssetType::find($assetTypeId))->name : null;

        // Determinar si se debe incluir el partial _software (asumiendo que "Software" es un AssetType específico)
        $showSoftwareForm = $assetTypeId && AssetType::find($assetTypeId)?->name === 'Software';

        return view('modules.company_assets.create', compact(
            'offices',
            'assetStates',
            'assetTypes',
            'workers',
            'assetTypeName',
            'softwareTypes',
            'showSoftwareForm'
        ));
    }

    public function store(CompanyAssetRequest $request)
    {
        try {
            Log::info('Iniciando almacenamiento de activo. Datos recibidos: ', $request->all());
            DB::beginTransaction();

            // Procesar foto si existe
            $photoPath = null;
            if ($request->hasFile('photo_path')) {
                $image = $request->file('photo_path');
                $originalName = $image->getClientOriginalName();
                $timestamp = now()->format('Y-m-d_H-i-s');
                $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);
                $newName = $timestamp . '_' . $cleanName;
                $storedPath = $image->storeAs('assets/photos', $newName, 'public');
                $photoPath = Storage::url($storedPath);
                Log::info('Foto procesada. Ruta: ' . $photoPath);
            }

            $validatedData = $request->validated();
            $assetTypeId = (int)$validatedData['asset_type_id'];
            Log::info('Datos validados para company_asset: ', $validatedData);

            // Ajustar asset_state_id para SOFTWARE
            if ($assetTypeId == 2 && $validatedData['asset_state_id'] === 'Sin estado') {
                $validatedData['asset_state_id'] = null; // O asigna un id por defecto si lo prefieres
            } elseif ($assetTypeId != 2 && !$validatedData['asset_state_id']) {
                return redirect()->back()->withErrors(['asset_state_id' => 'El estado del activo es requerido.'])->withInput();
            }

            // Crear el activo general
            $companyAsset = CompanyAsset::create(array_merge($validatedData, ['photo_path' => $photoPath]));
            Log::info('Activo general creado. ID: ' . $companyAsset->id);
            // Validación y creación del modelo específico según tipo
            switch ($assetTypeId) {
                case 1: // HARDWARE
                    $hardwareData = $request->only(['hardware_name', 'brand', 'model', 'color', 'serial_number', 'description', 'status']);
                    Log::info('Datos específicos para hardware: ', $hardwareData);
                    $validator = Validator::make($hardwareData, (new AssetHardwareRequest)->rules());
                    if ($validator->fails()) {
                        Log::error('Validación de hardware falló: ', $validator->errors()->all());
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->hardware()->create($hardwareData);
                    Log::info('Hardware creado para activo ID: ' . $companyAsset->id);
                    break;

                case 2: // SOFTWARE
                    $softwareData = $request->only(['software_type_id', 'software_name', 'version', 'license_key', 'license_expiry', 'description', 'status']);
                    Log::info('Datos iniciales para software: ', $softwareData);

                    $rules = [
                        'software_type_id' => 'required|exists:software_types,id',
                        'software_name' => 'required|string|max:100',
                        'version' => 'nullable|string|max:25',
                        'license_key' => 'nullable|string|max:255',
                        'license_expiry' => 'nullable|date',
                        'description' => 'nullable|string',
                        'status' => 'required|boolean',
                    ];

                    $validator = Validator::make($softwareData, $rules);

                    if ($request->software_type_id == 1) { // PROPIETARIO
                        $validator->addRules([
                            'license_key' => 'required|string|max:255',
                            'license_expiry' => 'required|date',
                        ]);
                    } else {
                        $softwareData['license_key'] = null;
                        $softwareData['license_expiry'] = null;
                    }

                    if ($validator->fails()) {
                        Log::error('Validación de software falló: ', $validator->errors()->all());
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    Log::info('Datos validados para software antes de crear: ', $softwareData);

                    $companyAsset->software()->create($softwareData);
                    Log::info('Software creado para activo ID: ' . $companyAsset->id);
                    break;

                case 3: // MOBILIARIO
                    $furnitureData = $request->only(['furniture_name', 'brand', 'model', 'color', 'material', 'dimensions', 'description', 'status']);
                    Log::info('Datos específicos para mobiliario: ', $furnitureData);
                    $validator = Validator::make($furnitureData, (new AssetFurnitureRequest)->rules());
                    if ($validator->fails()) {
                        Log::error('Validación de mobiliario falló: ', $validator->errors()->all());
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->furniture()->create($furnitureData);
                    Log::info('Mobiliario creado para activo ID: ' . $companyAsset->id);
                    break;

                case 4: // MAQUINARIAS
                    $machineryData = $request->only(['machinerie_name', 'brand', 'model', 'vin', 'engine_number', 'serial_number', 'year', 'color', 'placa', 'description', 'status']);
                    Log::info('Datos específicos para maquinaria: ', $machineryData);
                    $validator = Validator::make($machineryData, (new AssetMachineryRequest)->rules());
                    if ($validator->fails()) {
                        Log::error('Validación de maquinaria falló: ', $validator->errors()->all());
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->machinery()->create($machineryData);
                    Log::info('Maquinaria creada para activo ID: ' . $companyAsset->id);
                    break;

                case 5: // HERRAMIENTAS
                    $toolData = $request->only(['tool_name', 'brand', 'model', 'color', 'description', 'status']);
                    Log::info('Datos específicos para herramienta: ', $toolData);
                    $validator = Validator::make($toolData, (new AssetToolRequest)->rules());
                    if ($validator->fails()) {
                        Log::error('Validación de herramienta falló: ', $validator->errors()->all());
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->tool()->create($toolData);
                    Log::info('Herramienta creada para activo ID: ' . $companyAsset->id);
                    break;

                case 6: // OTROS ACTIVOS
                    $otherData = $request->only(['other_name', 'brand', 'model', 'color', 'description', 'status']);
                    Log::info('Datos específicos para activo diverso: ', $otherData);
                    $validator = Validator::make($otherData, (new AssetOtherRequest)->rules());
                    if ($validator->fails()) {
                        Log::error('Validación de activo diverso falló: ', $validator->errors()->all());
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->other()->create($otherData);
                    Log::info('Activo diverso creado para activo ID: ' . $companyAsset->id);
                    break;

                    // Agrega más casos según necesites
            }

            DB::commit();
            Log::info('Transacción completada. Redirigiendo a index.');

            return redirect()->route('company_assets.index')->with('success', 'El activo ha sido registrado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar activo: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Error al registrar el activo: ' . $e->getMessage())->withInput();
        }
    }

    public function show(CompanyAsset $companyAsset)
    {
        $companyAsset->load(['office', 'assetType', 'assetState', 'furniture', 'hardware', 'machinery', 'software', 'tool', 'other', 'responsibleUser', 'finalUser']);
        return view('modules.company_assets.show', compact('companyAsset'));
    }

    public function edit(CompanyAsset $companyAsset)
    {
        $offices = Office::all();
        $assetStates = AssetState::all();
        $assetTypes = AssetType::where('status', true)->get();
        $workers = Worker::all();
        $softwareTypes = SoftwareType::all(); // Para el partial _software

        // Cargar relaciones específicas
        $companyAsset->load(['hardware', 'software', 'furniture', 'machinery', 'tool', 'other']);

        return view('modules.company_assets.edit', compact(
            'companyAsset',
            'offices',
            'assetStates',
            'assetTypes',
            'workers',
            'softwareTypes'
        ));
    }

    public function update(CompanyAssetRequest $request, CompanyAsset $companyAsset)
    {
        try {
            DB::beginTransaction();

            $photoPath = $companyAsset->photo_path;
            if ($request->hasFile('photo_path')) {
                if ($photoPath) {
                    Storage::delete(str_replace('/storage/', '', $photoPath));
                }

                $image = $request->file('photo_path');
                $originalName = $image->getClientOriginalName();
                $timestamp = now()->format('Y-m-d_H-i-s');
                $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);
                $newName = $timestamp . '_' . $cleanName;
                $storedPath = $image->storeAs('assets/photos', $newName, 'public');
                $photoPath = Storage::url($storedPath);
            }

            $companyAsset->update(array_merge($request->validated(), ['photo_path' => $photoPath]));

            // Validación y actualización del modelo específico
            $assetTypeId = $companyAsset->asset_type_id;
            switch ($assetTypeId) {
                case 1: // HARDWARE
                    $hardwareData = $request->only(['hardware_name', 'brand', 'model', 'color', 'serial_number', 'description', 'status']);
                    $validator = Validator::make($hardwareData, (new AssetHardwareRequest)->rules());
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->hardware()->updateOrCreate(
                        ['company_asset_id' => $companyAsset->id],
                        $hardwareData
                    );
                    break;

                case 2: // SOFTWARE
                    $softwareData = $request->only(['software_type_id', 'software_name', 'version', 'license_key', 'license_expiry', 'description', 'status']);
                    $validator = Validator::make($softwareData, (new AssetSoftwareRequest)->rules());
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->software()->updateOrCreate(
                        ['company_asset_id' => $companyAsset->id],
                        $softwareData
                    );
                    break;

                case 3: // MOBILIARIO
                    $furnitureData = $request->only(['furniture_name', 'brand', 'model', 'color', 'material', 'dimensions', 'description', 'status']);
                    $validator = Validator::make($furnitureData, (new AssetFurnitureRequest)->rules());
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->furniture()->updateOrCreate(
                        ['company_asset_id' => $companyAsset->id],
                        $furnitureData
                    );
                    break;

                case 4: // MAQUINARÍAS
                    $machineryData = $request->only(['machinerie_name', 'brand', 'model', 'vin', 'engine_number', 'serial_number', 'year', 'color', 'placa', 'description', 'status']);
                    $validator = Validator::make($machineryData, (new AssetMachineryRequest)->rules());
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->machinery()->updateOrCreate(
                        ['company_asset_id' => $companyAsset->id],
                        $machineryData
                    );
                    break;

                case 5: // HERRAMIENTAS
                    $toolData = $request->only(['tool_name', 'brand', 'model', 'color', 'description', 'status']);
                    $validator = Validator::make($toolData, (new AssetToolRequest)->rules());
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->tool()->updateOrCreate(
                        ['company_asset_id' => $companyAsset->id],
                        $toolData
                    );
                    break;

                case 6: // OTROS
                    $otherData = $request->only(['other_name', 'brand', 'model', 'color', 'description', 'status']);
                    $validator = Validator::make($otherData, (new AssetOtherRequest)->rules());
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $companyAsset->other()->updateOrCreate(
                        ['company_asset_id' => $companyAsset->id],
                        $otherData
                    );
                    break;

                default:
                    Log::warning('Tipo de activo no manejado en update. ID: ' . $assetTypeId);
                    break;
            }

            DB::commit();

            return redirect()->route('company_assets.index')->with('success', 'El activo ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar activo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar el activo: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(CompanyAsset $companyAsset)
    {
        try {
            DB::beginTransaction();

            if ($companyAsset->photo_path) {
                Storage::delete(str_replace('/storage/', '', $companyAsset->photo_path));
            }

            // Eliminar modelo específico
            if ($companyAsset->furniture) {
                $companyAsset->furniture()->delete();
            }
            // Agrega aquí más tipos de activo si los tienes definidos

            $companyAsset->delete();

            DB::commit();

            return redirect()->route('company_assets.index')->with('success', 'El activo ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar activo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar el activo: ' . $e->getMessage());
        }
    }

    public function getWorkersByOffice($officeId)
    {
        $workers = Worker::where('office_id', $officeId)->get();
        return response()->json($workers);
    }
}
