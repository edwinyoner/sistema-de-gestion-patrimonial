<?php

namespace App\Traits;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasQrCode
{
    /**
     * Genera y guarda un código QR para este modelo.
     *
     * @param array $data Datos adicionales a incluir en el QR.
     * @param string $format Formato de imagen (png por defecto).
     * @return string URL del QR generado.
     */
    public function generateQrCode(array $data = [], string $format = 'png'): string
    {
        // Datos base del activo
        $qrData = [
            'asset_id'        => $this->id,
            'patrimonial_code'=> $this->patrimonial_code ?? $this->code ?? $this->id,
            'description'     => $this->description ?? 'Bien patrimonial',
            'location'        => $this->office->name ?? 'Sin ubicación',
            'status'          => $this->assetState->name ?? 'Sin estado',
            'responsible'     => $this->responsibleUser
                ? "{$this->responsibleUser->first_name} {$this->responsibleUser->last_name_paternal}"
                : 'Sin responsable',
            'view_url'        => route('company_assets.show', $this->id),
        ];

        // Fusionar con datos adicionales
        $qrData = array_merge($qrData, $data);

        // Convertir a JSON
        $qrString = json_encode($qrData, JSON_UNESCAPED_UNICODE);

        // Crear QR
        $qrCode = new QrCode(
            data: $qrString,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        // Logo opcional
        $logo = null;
        $logoPath = public_path('images/logo.png');
        if (file_exists($logoPath)) {
            $logo = new Logo(
                path: $logoPath,
                resizeToWidth: 60,
                punchoutBackground: true
            );
        }

        // Generar imagen
        $writer = new PngWriter();
        $result = $writer->write($qrCode, $logo);

        // Nombre único del archivo
        $qrFilename = 'qr_' . Str::slug($this->patrimonial_code ?? $this->id) . '.' . $format;
        $qrPath = 'qrcodes/' . $qrFilename;

        // Guardar en storage/app/public/qrcodes
        Storage::disk('public')->put($qrPath, $result->getString());

        // Actualizar campo en la BD
        $this->update(['qr_code_path' => $qrPath]);

        // Retornar URL accesible
        return Storage::url($qrPath);
    }

    /**
     * Accesor para obtener la URL del QR.
     */
    public function getQrCodeUrlAttribute(): string
    {
        if (!$this->qr_code_path) {
            $this->generateQrCode();
        }
        return Storage::url($this->qr_code_path);
    }
}
