@extends('layouts.main')

@section('subtitle', 'Detalles del Activo')
@section('content_header_title', 'Activos')
@section('content_header_subtitle', 'Ver detalles del activo')

@section('content_body')
<div class="container-fluid">
    @if (session('success'))
        <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    @if ($errors->any())
        <x-adminlte-alert theme="danger" id="error-alert" title="Errores" dismissable>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-11">
            <x-adminlte-card title="Información del Activo Patrimonial" theme="info" icon="fas fa-box" collapsible>
                
                <!-- Información General -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="info-card h-100">
                            <div class="info-item">
                                <i class="fas fa-building text-primary"></i>
                                <div>
                                    <label>Oficina / Área</label>
                                    <p>{{ $companyAsset->office->name ?? 'No asignada' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card h-100">
                            <div class="info-item">
                                <i class="fas fa-user-tie text-success"></i>
                                <div>
                                    <label>Responsable</label>
                                    <p>{{ $companyAsset->responsibleUser ? "{$companyAsset->responsibleUser->first_name} {$companyAsset->responsibleUser->last_name_paternal} {$companyAsset->responsibleUser->last_name_maternal}" : 'No asignado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card h-100">
                            <div class="info-item">
                                <i class="fas fa-user text-info"></i>
                                <div>
                                    <label>Usuario Final</label>
                                    <p>{{ $companyAsset->finalUser ? "{$companyAsset->finalUser->first_name} {$companyAsset->finalUser->last_name_paternal} {$companyAsset->responsibleUser->last_name_maternal}" : 'No asignado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datos del Activo -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="info-card h-100">
                            <div class="info-item">
                                <i class="fas fa-tags text-warning"></i>
                                <div>
                                    <label>Tipo de Activo</label>
                                    <p>{{ $companyAsset->assetType->name ?? 'No definido' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-card h-100">
                            <div class="info-item">
                                <i class="fas fa-barcode text-dark"></i>
                                <div>
                                    <label>Código Patrimonial</label>
                                    <p class="font-weight-bold">{{ $companyAsset->patrimonial_code ?? 'No asignado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-card h-100">
                            <div class="info-item">
                                <i class="fas fa-check-circle text-success"></i>
                                <div>
                                    <label>Estado del Activo</label>
                                    <p>{{ $companyAsset->assetState->name ?? 'No definido' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-card h-100">
                            <div class="info-item">
                                <i class="fas fa-calendar text-danger"></i>
                                <div>
                                    <label>Fecha de Inventario</label>
                                    <p>{{ $companyAsset->inventory_date ? $companyAsset->inventory_date->format('d/m/Y') : 'No definida' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Sección Principal: Detalles y QR -->
                <div class="row">
                    <!-- Detalles Específicos -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-gradient-info">
                                <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Detalles Específicos del Activo</h5>
                            </div>
                            <div class="card-body">
                                @if ($companyAsset->assetType)
                                    @php
                                        $typeMap = [
                                            'HARDWARE' => 'hardware',
                                            'SOFTWARE' => 'software',
                                            'MOBILIARIOS' => 'furniture',
                                            'MAQUINARÍAS' => 'machinery',
                                            'HERRAMIENTAS' => 'tool',
                                            'OTROS' => 'other',
                                        ];
                                        $relationName = $typeMap[$companyAsset->assetType->name] ?? null;
                                    @endphp
                                    @if ($relationName && $companyAsset->$relationName)
                                        @switch($companyAsset->assetType->name)
                                            @case('HARDWARE')
                                                <div class="detail-row"><span class="detail-label">Nombre:</span> {{ $companyAsset->hardware->hardware_name ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Marca:</span> {{ $companyAsset->hardware->brand ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Modelo:</span> {{ $companyAsset->hardware->model ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Color:</span> {{ $companyAsset->hardware->color ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">N° Serie:</span> {{ $companyAsset->hardware->serial_number ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Descripción:</span> {{ $companyAsset->hardware->description ?? 'No especificado' }}</div>
                                                @break
                                            @case('SOFTWARE')
                                                <div class="detail-row"><span class="detail-label">Tipo:</span> {{ $companyAsset->software->softwareType->name ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Nombre:</span> {{ $companyAsset->software->software_name ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Versión:</span> {{ $companyAsset->software->version ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Licencia:</span> {{ $companyAsset->software->license_key ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Expiración:</span> {{ $companyAsset->software->license_expiry ? $companyAsset->software->license_expiry->format('d/m/Y') : 'No especificado' }}</div>
                                                @break
                                            @case('MOBILIARIOS')
                                                <div class="detail-row"><span class="detail-label">Nombre:</span> {{ $companyAsset->furniture->furniture_name ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Marca:</span> {{ $companyAsset->furniture->brand ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Modelo:</span> {{ $companyAsset->furniture->model ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Material:</span> {{ $companyAsset->furniture->material ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Dimensiones:</span> {{ $companyAsset->furniture->dimensions ?? 'No especificado' }}</div>
                                                @break
                                            @case('MAQUINARÍAS')
                                                <div class="detail-row"><span class="detail-label">Nombre:</span> {{ $companyAsset->machinery->machinerie_name ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Marca:</span> {{ $companyAsset->machinery->brand ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Modelo:</span> {{ $companyAsset->machinery->model ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">VIN:</span> {{ $companyAsset->machinery->vin ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">N° Motor:</span> {{ $companyAsset->machinery->engine_number ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Placa:</span> {{ $companyAsset->machinery->placa ?? 'No especificado' }}</div>
                                                @break
                                            @case('HERRAMIENTAS')
                                                <div class="detail-row"><span class="detail-label">Nombre:</span> {{ $companyAsset->tool->tool_name ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Marca:</span> {{ $companyAsset->tool->brand ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Modelo:</span> {{ $companyAsset->tool->model ?? 'No especificado' }}</div>
                                                @break
                                            @case('OTROS')
                                                <div class="detail-row"><span class="detail-label">Nombre:</span> {{ $companyAsset->other->other_name ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Marca:</span> {{ $companyAsset->other->brand ?? 'No especificado' }}</div>
                                                <div class="detail-row"><span class="detail-label">Modelo:</span> {{ $companyAsset->other->model ?? 'No especificado' }}</div>
                                                @break
                                        @endswitch
                                    @else
                                        <p class="text-warning">No hay detalles específicos disponibles.</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Imagen del Activo -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-gradient-warning">
                                <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Imagen del Activo</h5>
                            </div>
                            <div class="card-body">
                                @if ($companyAsset->photo_path)
                                    <div class="mt-3 text-center">
                                        <img src="{{ $companyAsset->photo_path }}" alt="Foto del activo" class="img-fluid rounded shadow" style="max-height: 300px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Etiqueta QR Profesional -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-gradient-dark text-white text-center">
                                <h5 class="mb-0"><i class="fas fa-qrcode mr-2"></i>Etiqueta de Inventario</h5>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between p-4">
                                
                                <!-- Etiqueta Imprimible -->
                                <div id="qr-label-container" class="qr-sticker mx-auto">
                                    <!-- Encabezado -->
                                    <div class="sticker-header">
                                        <h6 class="company-name">Winner Systems Corporation S.A.C.</h6>
                                        <p class="sticker-date">{{ now()->year }}</p>                                        
                                    </div>

                                    <!-- Cuerpo: Logo + QR -->
                                    <div class="sticker-body">
                                        <div class="logo-container">
                                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="company-logo">
                                        </div>
                                        <div class="qr-container">
                                            @if ($companyAsset->qr_code_path)
                                                <img src="{{ $companyAsset->qr_code_url }}" alt="QR Code" class="qr-code">
                                            @else
                                                <div class="qr-placeholder">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <small>QR No Generado</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Información del Activo -->
                                    <div class="sticker-footer">
                                        <div class="asset-info">
                                            <div class="info-line">
                                                <strong>CÓDIGO:</strong> 
                                                <span class="codigo-patrimonial">{{ $companyAsset->patrimonial_code }}</span>
                                            </div>
                                            <div class="info-line">
                                                <strong>TIPO:</strong> {{ $companyAsset->assetType->name ?? 'N/A' }}
                                            </div>
                                            <div class="info-line">
                                                <strong>UBICACIÓN:</strong> {{ $companyAsset->office->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                @if ($companyAsset->qr_code_path)
                                    <div class="mt-3">
                                        <div class="btn-group btn-group-sm w-100" role="group">
                                            <button type="button" class="btn btn-success" onclick="downloadQR()">
                                                <i class="fas fa-download mr-1"></i>Descargar
                                            </button>
                                            <button type="button" class="btn btn-primary" onclick="printQR()">
                                                <i class="fas fa-print mr-1"></i>Imprimir
                                            </button>
                                        </div>
                                        <p class="text-center text-muted small mt-2 mb-0">
                                            <i class="fas fa-info-circle"></i> 5cm x 2.5cm
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('company_assets.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                    <a href="{{ route('company_assets.edit', $companyAsset->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit mr-1"></i> Editar
                    </a>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
<style>
    /* Cards de información con altura igual */
    .info-card {
        background: #fff;
        border-left: 3px solid #17a2b8;
        padding: 10px;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 6px rgba(0,0,0,0.15);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-item i {
        font-size: 18px;
        min-width: 24px;
    }

    .info-item label {
        font-size: 10px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin: 0;
        font-weight: 600;
    }

    .info-item p {
        font-size: 13px;
        margin: 0;
        color: #2c3e50;
        font-weight: 500;
    }

    /* Detalles específicos */
    .detail-row {
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: baseline;
        font-size: 13px;
    }

    .detail-label {
        font-weight: 600;        
        min-width: 100px;
        display: inline-block;
        font-size: 12px;
    }

    /* Etiqueta QR tipo Sticker - Fondo blanco con borde negro */
    .qr-sticker {
        width: 100%;
        max-width: 340px;
        background: #ffffff;
        border: 2.5px solid #000000;
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        position: relative;
    }

    .sticker-header {
        text-align: center;
        background: #f8f9fa;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 12px;
        border: 1px solid #dee2e6;
    }

    .company-name {
        font-size: 13px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 3px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .sticker-date {
        font-size: 9px;
        color: #7f8c8d;
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .sticker-body {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        background: #ffffff;
        padding: 2.5px;
        border-radius: 6px;
        margin-bottom: 10px;
        border: 1px solid #dee2e6;
    }

    .logo-container {
        flex-shrink: 0;
    }

    .company-logo {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    .qr-container {
        flex-shrink: 0;
    }

    .qr-code {
        width: 120px;
        height: 120px;
        border-radius: 4px;
        background: white;
        padding: 3px;
        border: 1px solid #dee2e6;
    }

    .qr-placeholder {
        width: 120px;
        height: 120px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 4px;
        color: #6c757d;
        font-size: 11px;
    }

    .sticker-footer {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #dee2e6;
    }

    .asset-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .info-line {
        font-size: 11px;
        color: #2c3e50;
        display: flex;
        justify-content: space-between;
        padding: 3px 0;
        border-bottom: 1px dashed #dee2e6;
    }

    .info-line:last-child {
        border-bottom: none;
    }

    .codigo-patrimonial {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        font-size: 12px;
        color: #e74c3c;
    }

    /* Alertas */
    #success-alert, #error-alert {
        transition: opacity 0.5s ease;
    }

    /* Impresión */
    @media print {
        body * {
            visibility: hidden;
        }
        
        #qr-label-container,
        #qr-label-container * {
            visibility: visible;
        }
        
        #qr-label-container {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 10cm;
            max-width: 10cm;
        }
    }

    /* Gradientes para headers */
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
    }

    .bg-gradient-dark {
        background: linear-gradient(135deg, #343a40 0%, #23272b 100%);
    }

    .card-header h5 {
        font-size: 15px;
    }
</style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadQR() {
        const container = document.getElementById('qr-label-container');
        
        html2canvas(container, {
            backgroundColor: null,
            scale: 4,
            logging: false,
            useCORS: true
        }).then(canvas => {
            const link = document.createElement('a');
            link.download = 'Etiqueta_QR_{{ $companyAsset->patrimonial_code }}.png';
            link.href = canvas.toDataURL('image/png', 1.0);
            link.click();
        });
    }

    function printQR() {
        window.print();
    }

    setTimeout(() => {
        ['success-alert', 'error-alert'].forEach(id => {
            const alert = document.getElementById(id);
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 500);
            }
        });
    }, 5000);
</script>
@endpush