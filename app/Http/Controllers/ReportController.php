<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    AssetFurniture,
    AssetHardware,
    AssetMachinery,
    AssetOther,
    AssetSoftware,
    AssetTool,
    CompanyAsset,
    JobPosition,
    Office,
    User,
    Worker,
    ContractType
};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('permission:VER REPORTES');
    }

    // Vista principal de reportes
    public function index()
    {
        $reportTypes = $this->getReportTypes();
        return view('modules.reports.index', compact('reportTypes'));
    }

    // Vista de filtros para cada reporte
    public function filters($type)
    {
        $reportConfig = $this->getReportConfig($type);

        if (!$reportConfig) {
            return redirect()->back()->with('error', 'Tipo de reporte no válido.');
        }

        return view('modules.reports.filters', compact('type', 'reportConfig'));
    }

    // Generar reporte con filtros
    public function generate(Request $request, $type)
    {
        $reportConfig = $this->getReportConfig($type);

        if (!$reportConfig) {
            return redirect()->back()->with('error', 'Tipo de reporte no válido.');
        }

        $filters = $this->validateFilters($request, $type);
        $data = $this->getReportData($type, $filters);

        return view('modules.reports.preview', [
            'type' => $type,
            'config' => $reportConfig,
            'data' => $data,
            'filters' => $filters,
            'totalRecords' => count($data)
        ]);
    }

    // Exportar a PDF
    public function exportPdf(Request $request, $type)
    {
        $this->middleware('permission:exportar reportes');

        $reportConfig = $this->getReportConfig($type);
        $filters = $this->validateFilters($request, $type);
        $data = $this->getReportData($type, $filters);

        $companyData = $this->getCompanyData();

        $pdf = Pdf::loadView('modules.reports.pdf.template', [
            'type' => $type,
            'config' => $reportConfig,
            'data' => $data,
            'filters' => $filters,
            'company' => $companyData,
            'generatedAt' => now(),
            'generatedBy' => auth()->user()->name
        ]);

        $filename = "reporte_{$type}_" . now()->format('Y-m-d_H-i-s') . ".pdf";

        return $pdf->download($filename);
    }

    // Exportar a Excel
    public function exportExcel(Request $request, $type)
    {
        $this->middleware('permission:exportar reportes');

        $reportConfig = $this->getReportConfig($type);
        $filters = $this->validateFilters($request, $type);
        $data = $this->getReportData($type, $filters);

        $filename = "reporte_{$type}_" . now()->format('Y-m-d_H-i-s') . ".xlsx";

        return Excel::download(new ReportExport($type, $data, $reportConfig, $filters), $filename);
    }

    // Configuración de tipos de reportes
    private function getReportTypes()
    {
        return [
            'usuarios' => [
                'name' => 'Usuarios',
                'description' => 'Usuarios del sistema y permisos',
                'icon' => 'fas fa-users',
                'color' => 'success',
                'table' => 'users',
                'model' => User::class
            ],
            'oficinas' => [
                'name' => 'Oficinas',
                'description' => 'Estructura organizacional por oficinas',
                'icon' => 'fas fa-building',
                'color' => 'info',
                'table' => 'offices',
                'model' => Office::class
            ],
            'cargos' => [
                'name' => 'Cargos',
                'description' => 'Posiciones y cargos institucionales',
                'icon' => 'fas fa-briefcase',
                'color' => 'primary',
                'table' => 'job_positions',
                'model' => JobPosition::class
            ],
            'tipos_contrato' => [
                'name' => 'Tipos de Contrato',
                'description' => 'Modalidades de contratación',
                'icon' => 'fas fa-file-contract',
                'color' => 'secondary',
                'table' => 'contract_types',
                'model' => ContractType::class
            ],
            'trabajadores' => [
                'name' => 'Trabajadores',
                'description' => 'Personal y empleados de la institución',
                'icon' => 'fas fa-user-tie',
                'color' => 'warning',
                'table' => 'workers',
                'model' => Worker::class
            ],
            'activos_generales' => [
                'name' => 'Activos Generales',
                'description' => 'Inventario general de todos los activos',
                'icon' => 'fas fa-clipboard-list',
                'color' => 'dark',
                'table' => 'company_assets',
                'model' => CompanyAsset::class
            ],
            'hardware' => [
                'name' => 'Hardware',
                'description' => 'Equipos informáticos y tecnológicos',
                'icon' => 'fas fa-desktop',
                'color' => 'info',
                'table' => 'asset_hardwares',
                'model' => AssetHardware::class
            ],
            'software' => [
                'name' => 'Software',
                'description' => 'Licencias y aplicaciones informáticas',
                'icon' => 'fas fa-laptop-code',
                'color' => 'success',
                'table' => 'asset_softwares',
                'model' => AssetSoftware::class
            ],
            'mobiliarios' => [
                'name' => 'Mobiliarios',
                'description' => 'Reporte completo de mobiliario institucional',
                'icon' => 'fas fa-couch',
                'color' => 'primary',
                'table' => 'asset_furnitures',
                'model' => AssetFurniture::class
            ],
            'maquinarias' => [
                'name' => 'Maquinarias',
                'description' => 'Maquinaria pesada y equipos especializados',
                'icon' => 'fas fa-tractor',
                'color' => 'warning',
                'table' => 'asset_machineries',
                'model' => AssetMachinery::class
            ],
            'herramientas' => [
                'name' => 'Herramientas',
                'description' => 'Herramientas de trabajo y mantenimiento',
                'icon' => 'fas fa-tools',
                'color' => 'danger',
                'table' => 'asset_tools',
                'model' => AssetTool::class
            ],
            'otros_activos' => [
                'name' => 'Otros Activos',
                'description' => 'Activos diversos no clasificados',
                'icon' => 'fas fa-layer-group',
                'color' => 'secondary',
                'table' => 'asset_others',
                'model' => AssetOther::class
            ]
        ];
    }

    // Obtener configuración específica del reporte
    private function getReportConfig($type)
    {
        $types = $this->getReportTypes();
        return $types[$type] ?? null;
    }

    // Validar filtros según el tipo de reporte
    private function validateFilters(Request $request, $type)
    {
        $baseRules = [
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'status' => 'nullable|string',
            'office_id' => 'nullable|exists:offices,id',
            'export_format' => 'nullable|in:pdf,excel,csv'
        ];

        // Reglas específicas por tipo
        $specificRules = $this->getSpecificValidationRules($type);

        return $request->validate(array_merge($baseRules, $specificRules));
    }

    // Reglas de validación específicas
    private function getSpecificValidationRules($type)
    {
        $rules = [];

        switch ($type) {
            case 'usuarios':
                $rules['role'] = 'nullable|string';
                $rules['active_only'] = 'boolean';
                break;
            case 'trabajadores':
                $rules['contract_type_id'] = 'nullable|exists:contract_types,id';
                $rules['job_position_id'] = 'nullable|exists:job_positions,id';
                break;
            case 'activos_generales':
                $rules['asset_type_id'] = 'nullable|exists:asset_types,id';
                $rules['asset_state_id'] = 'nullable|exists:asset_states,id';
                break;
        }

        return $rules;
    }

    // Obtener datos del reporte
    private function getReportData($type, $filters)
    {
        $config = $this->getReportConfig($type);
        $model = $config['model'];

        $query = $model::query();

        // Aplicar relaciones comunes
        $this->applyCommonRelations($query, $type);

        // Aplicar filtros
        $this->applyFilters($query, $filters, $type);

        return $query->get();
    }

    // Aplicar relaciones comunes
    private function applyCommonRelations($query, $type)
    {
        switch ($type) {
            case 'trabajadores':
                $query->with(['office', 'jobPosition', 'contractType']);
                break;
            case 'usuarios':
                $query->with(['roles', 'permissions']);
                break;
            case 'activos_generales':
                $query->with(['assetType', 'assetState', 'office', 'worker']);
                break;
            case 'hardware':
            case 'software':
            case 'mobiliarios':
            case 'maquinarias':
            case 'herramientas':
            case 'otros_activos':
                $query->with(['companyAsset']);
                break;
        }
    }

    // Aplicar filtros
    private function applyFilters($query, $filters, $type)
    {
        // Filtros de fecha
        if (!empty($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to'] . ' 23:59:59');
        }

        // Filtro por oficina
        if (!empty($filters['office_id'])) {
            if (in_array($type, ['trabajadores', 'activos_generales'])) {
                $query->where('office_id', $filters['office_id']);
            }
        }

        // Filtros específicos
        $this->applySpecificFilters($query, $filters, $type);
    }

    // Filtros específicos por tipo
    private function applySpecificFilters($query, $filters, $type)
    {
        switch ($type) {
            case 'usuarios':
                if (!empty($filters['role'])) {
                    $query->whereHas('roles', function ($q) use ($filters) {
                        $q->where('name', $filters['role']);
                    });
                }
                if ($filters['active_only'] ?? false) {
                    $query->whereNotNull('email_verified_at');
                }
                break;

            case 'trabajadores':
                if (!empty($filters['contract_type_id'])) {
                    $query->where('contract_type_id', $filters['contract_type_id']);
                }
                if (!empty($filters['job_position_id'])) {
                    $query->where('job_position_id', $filters['job_position_id']);
                }
                break;

            case 'activos_generales':
                if (!empty($filters['asset_type_id'])) {
                    $query->where('asset_type_id', $filters['asset_type_id']);
                }
                if (!empty($filters['asset_state_id'])) {
                    $query->where('asset_state_id', $filters['asset_state_id']);
                }
                break;
        }
    }

    // Datos de la empresa para reportes
    private function getCompanyData()
    {
        $logoPath = public_path('assets/images/logo.png');
        $logoBase64 = '';

        if (file_exists($logoPath)) {
            $type = pathinfo($logoPath, PATHINFO_EXTENSION);
            $imageData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        }

        return [
            'name' => 'Municipalidad Provincial de Yungay',
            'ruc' => '20123456789',
            'address' => 'Plaza de Armas S/N, Yungay, Ancash',
            'phone' => '+51 (043) 39-3001',
            'email' => 'info@muniyungay.gob.pe',
            'website' => 'www.muniyungay.gob.pe',
            'logo' => $logoBase64, // DEBE SER BASE64, NO LA RUTA
            'developed_by' => [
                'name' => 'Winner Systems Corporation S.A.C.',
                'ruc' => '20613731335',
                'website' => 'www.winner-systems.com',
                'email' => 'info@winner-systems.com'
            ]
        ];
    }
}
