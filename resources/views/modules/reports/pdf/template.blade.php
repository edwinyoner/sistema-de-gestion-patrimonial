<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte {{ $config['name'] }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #333;
        }

        /* Header */
        .header {
            border-bottom: 3px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header-content {
            display: table;
            width: 100%;
        }

        .header-logo {
            display: table-cell;
            width: 15%;
            vertical-align: middle;
        }

        .header-logo img {
            max-width: 80px;
            height: auto;
        }

        .header-info {
            display: table-cell;
            width: 70%;
            vertical-align: middle;
            padding-left: 15px;
        }

        .header-info h1 {
            font-size: 16pt;
            color: #007bff;
            margin-bottom: 5px;
        }

        .header-info p {
            font-size: 9pt;
            color: #666;
            margin: 2px 0;
        }

        .header-report {
            display: table-cell;
            width: 15%;
            vertical-align: middle;
            text-align: right;
        }

        .report-badge {
            background: #007bff;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 9pt;
            font-weight: bold;
        }

        /* Report Info */
        .report-info {
            background: #f8f9fa;
            padding: 12px;
            margin: 20px 0;
            border-left: 4px solid #007bff;
        }

        .report-info h2 {
            font-size: 14pt;
            color: #007bff;
            margin-bottom: 10px;
        }

        .info-grid {
            display: table;
            width: 100%;
            margin-top: 10px;
        }

        .info-row {
            display: table-row;
        }

        .info-cell {
            display: table-cell;
            padding: 5px 10px 5px 0;
            width: 50%;
        }

        .info-label {
            font-weight: bold;
            color: #666;
        }

        .info-value {
            color: #333;
        }

        /* Filters Section */
        .filters-section {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
        }

        .filters-section h3 {
            font-size: 11pt;
            color: #856404;
            margin-bottom: 8px;
        }

        .filter-item {
            display: inline-block;
            background: white;
            padding: 4px 8px;
            margin: 3px;
            border-radius: 3px;
            font-size: 9pt;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        thead {
            background: #007bff;
            color: white;
        }

        th {
            padding: 10px 8px;
            text-align: left;
            font-size: 9pt;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
            font-size: 9pt;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 8pt;
            font-weight: bold;
        }

        .badge-success {
            background: #28a745;
            color: white;
        }

        .badge-info {
            background: #17a2b8;
            color: white;
        }

        .badge-warning {
            background: #ffc107;
            color: #333;
        }

        .badge-danger {
            background: #dc3545;
            color: white;
        }

        .badge-secondary {
            background: #6c757d;
            color: white;
        }

        .badge-primary {
            background: #007bff;
            color: white;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            border-top: 2px solid #007bff;
            padding: 10px 0;
            font-size: 8pt;
            color: #666;
        }

        .footer-content {
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            width: 50%;
            vertical-align: middle;
        }

        .footer-right {
            display: table-cell;
            width: 50%;
            text-align: right;
            vertical-align: middle;
        }

        /* Page Break */
        .page-break {
            page-break-after: always;
        }

        /* Summary Box */
        .summary-box {
            background: #e7f3ff;
            border: 2px solid #007bff;
            padding: 12px;
            margin: 15px 0;
            border-radius: 4px;
        }

        .summary-box h3 {
            color: #007bff;
            font-size: 12pt;
            margin-bottom: 8px;
        }

        .summary-stat {
            display: inline-block;
            margin: 5px 15px 5px 0;
        }

        .summary-stat strong {
            color: #007bff;
            font-size: 14pt;
        }

        /* No Data Message */
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .no-data i {
            font-size: 48pt;
            display: block;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-logo">
                @if(!empty($company['logo']))
                    <img src="{{ $company['logo'] }}" alt="Logo" style="max-width: 60px; max-height: 60px;">
                @endif
            </div>
            <div class="header-info">
                <h1>{{ $company['name'] }}</h1>
                <p><strong>RUC:</strong> {{ $company['ruc'] }}</p>
                <p><strong>Dirección:</strong> {{ $company['address'] }}</p>
                <p><strong>Teléfono:</strong> {{ $company['phone'] }} | <strong>Email:</strong> {{ $company['email'] }}
                </p>
            </div>
            <div class="header-report">
                <div class="report-badge">REPORTE OFICIAL</div>
            </div>
        </div>
    </div>

    <!-- Report Info -->
    <div class="report-info">
        <h2>Reporte de {{ $config['name'] }}</h2>
        <p style="color: #666; font-size: 9pt;">{{ $config['description'] }}</p>

        <div class="info-grid">
            <div class="info-row">
                <div class="info-cell">
                    <span class="info-label">Tipo de Reporte:</span>
                    <span class="info-value">{{ $config['name'] }}</span>
                </div>
                <div class="info-cell">
                    <span class="info-label">Total de Registros:</span>
                    <span class="info-value">{{ count($data) }}</span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-cell">
                    <span class="info-label">Fecha de Generación:</span>
                    <span class="info-value">{{ $generatedAt->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="info-cell">
                    <span class="info-label">Generado por:</span>
                    <span class="info-value">{{ $generatedBy }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Applied -->
    @if(!empty(array_filter($filters)))
        <div class="filters-section">
            <h3>🔍 Filtros Aplicados</h3>
            @if(!empty($filters['date_from']))
                <span class="filter-item">📅 Desde: {{ $filters['date_from'] }}</span>
            @endif
            @if(!empty($filters['date_to']))
                <span class="filter-item">📅 Hasta: {{ $filters['date_to'] }}</span>
            @endif
            @if(!empty($filters['office_id']))
                <span class="filter-item">🏢 Oficina:
                    {{ \App\Models\Office::find($filters['office_id'])->name ?? 'N/A' }}</span>
            @endif
        </div>
    @endif

    <!-- Summary Box -->
    <div class="summary-box">
        <h3>📊 Resumen Ejecutivo</h3>
        <div class="summary-stat">
            <strong>{{ count($data) }}</strong> Registros Totales
        </div>
        @if($type === 'trabajadores')
            <div class="summary-stat">
                <strong>{{ $data->unique('office_id')->count() }}</strong> Oficinas
            </div>
            <div class="summary-stat">
                <strong>{{ $data->unique('contract_type_id')->count() }}</strong> Tipos de Contrato
            </div>
        @endif
    </div>

    <!-- Data Table -->
    @if(count($data) > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    @include('modules.reports.pdf.table-headers', ['type' => $type])
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        @include('modules.reports.pdf.table-row', ['type' => $type, 'item' => $item])
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <i>📭</i>
            <h3>No se encontraron registros</h3>
            <p>No hay datos disponibles con los filtros aplicados</p>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <strong>{{ $company['name'] }}</strong><br>
                Sistema de Gestión Patrimonial | Página <span class="pagenum"></span>
            </div>
            <div class="footer-right">
                Desarrollado por: <strong>{{ $company['developed_by']['name'] }}</strong><br>
                {{ $company['developed_by']['website'] }}
            </div>
        </div>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("Arial");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>

</html>