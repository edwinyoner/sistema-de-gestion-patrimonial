```markdown
# 📋 Sistema de Gestión Patrimonial

Sistema integral para la administración de activos, inventario y recursos patrimoniales desarrollado para instituciones públicas.

![Laravel](https://img.shields.io/badge/Laravel-10.x-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![License](https://img.shields.io/badge/License-Proprietary-yellow)

---

## 🏢 Desarrollado por

**Winner Systems Corporation S.A.C.**
- **RUC:** 20613731335
- **Website:** [www.winner-systems.com](https://www.winner-systems.com)
- **Email:** info@winner-systems.com

---

## 📖 Descripción

Sistema web desarrollado con Laravel 10 que permite gestionar de manera eficiente el inventario patrimonial de instituciones públicas y privadas. Incluye control de activos, asignación de responsables, generación de reportes y trazabilidad completa de movimientos.

### Características Principales

- ✅ Gestión completa de activos patrimoniales
- ✅ Control de usuarios con roles y permisos
- ✅ Administración de oficinas y trabajadores
- ✅ Inventario por categorías (Hardware, Software, Mobiliario, Maquinaria, Herramientas)
- ✅ Sistema de reportes con exportación a PDF y Excel
- ✅ Trazabilidad de movimientos y cambios
- ✅ Interfaz moderna y responsiva
- ✅ Sistema de manuales de usuario
- ✅ Soporte técnico integrado

---

## 🛠️ Tecnologías Utilizadas

### Backend
- Laravel 10.x
- PHP 8.2
- MySQL 8.0
- Jetstream (Autenticación)
- Spatie Permissions (Roles y Permisos)

### Frontend
- AdminLTE 3
- Bootstrap 4
- jQuery
- DataTables
- SweetAlert2
- Font Awesome

### Librerías Principales
- **barryvdh/laravel-dompdf** - Generación de PDFs
- **maatwebsite/excel** - Exportación a Excel
- **intervention/image** - Procesamiento de imágenes
- **spatie/laravel-permission** - Sistema de permisos

---

## 📋 Requisitos del Sistema

### Requisitos Mínimos
- PHP >= 8.2
- Composer
- MySQL >= 8.0 o MariaDB >= 10.3
- Apache o Nginx
- Extensiones PHP: GD, PDO, Mbstring, OpenSSL, Tokenizer, XML, Ctype, JSON

### Requisitos Recomendados
- PHP 8.2+
- MySQL 8.0+
- 2GB RAM mínimo
- 1GB espacio en disco

---

## 🚀 Instalación

### 1. Clonar el repositorio
```bash
git clone [URL_DEL_REPOSITORIO]
cd sistema-de-gestion-patrimonial
```

### 2. Instalar dependencias
```bash
composer install
npm install && npm run build
```

### 3. Configurar el entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar base de datos
Editar el archivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

### 5. Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```

### 6. Crear enlace simbólico para storage
```bash
php artisan storage:link
```

### 7. Iniciar servidor de desarrollo
```bash
php artisan serve
```

Acceder a: `http://localhost:8000`

---

## 👤 Credenciales por Defecto

```
Usuario: admin@dominio.com
Contraseña: password
```

**⚠️ IMPORTANTE:** Cambiar estas credenciales inmediatamente en producción.

---

## 📂 Estructura del Proyecto

```
sistema-de-gestion-patrimonial/
├── app/
│   ├── Http/Controllers/    # Controladores
│   ├── Models/              # Modelos Eloquent
│   ├── Exports/             # Clases de exportación
│   └── Policies/            # Políticas de autorización
├── database/
│   ├── migrations/          # Migraciones de BD
│   └── seeders/             # Seeders
├── resources/
│   └── views/
│       └── modules/         # Vistas por módulo
├── public/
│   ├── assets/             # Assets públicos
│   └── images/             # Imágenes y logos
└── routes/
    └── web.php             # Rutas de la aplicación
```

---

## 🔐 Roles y Permisos

### Roles Predefinidos

| Rol | Descripción | Permisos |
|-----|-------------|----------|
| **Admin** | Administrador del sistema | Acceso total |
| **Autoridad** | Personal autorizado | Visualización y reportes |
| **Usuario** | Usuario estándar | Consulta básica |

### Permisos Principales
- Gestión de usuarios
- Gestión de roles y permisos
- CRUD de activos patrimoniales
- Generación de reportes
- Exportación de datos
- Gestión de trabajadores y oficinas

---

## 📊 Módulos del Sistema

### 1. Gestión de Accesos
- Usuarios
- Roles
- Permisos

### 2. Organización Interna
- Oficinas
- Cargos
- Tipos de Contrato
- Trabajadores

### 3. Gestión de Activos
- Tipos de Activos
- Estados de Activos
- Tipos de Software
- Inventario General
- Categorías específicas:
  - Hardware
  - Software
  - Mobiliario
  - Maquinaria
  - Herramientas
  - Otros Activos

### 4. Reportes y Analíticas
- Reportes de inventario
- Exportación a PDF/Excel
- Filtros personalizables
- Vista previa de datos

### 5. Documentación
- Manual del usuario
- Soporte técnico
- Información del sistema

---

## 📈 Generación de Reportes

El sistema incluye un generador de reportes completo:

```bash
# Acceder a reportes
/reports
```

### Tipos de Reportes Disponibles
- Mobiliarios
- Hardware
- Maquinarias
- Software
- Herramientas
- Activos Generales
- Trabajadores
- Usuarios
- Oficinas
- Cargos
- Tipos de Contrato

### Formatos de Exportación
- PDF (con logo y branding institucional)
- Excel (XLSX)
- Vista previa en pantalla

---

## 🔧 Configuración Adicional

### Configurar Logo Institucional
Colocar el logo en: `public/assets/images/logo.png`

### Personalizar Datos de la Empresa
Editar `ReportController.php`, método `getCompanyData()`:
```php
return [
    'name' => 'Tu Institución',
    'ruc' => 'Tu RUC',
    'address' => 'Tu dirección',
    // ...
];
```

### Configurar Email
En `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-contraseña
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🐛 Solución de Problemas Comunes

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Permission denied" en storage
```bash
chmod -R 775 storage bootstrap/cache
```

### Extensión GD no instalada (para PDFs con logo)
```bash
# Windows (XAMPP): descomentar en php.ini
extension=gd

# Linux
sudo apt-get install php8.2-gd
```

### Limpiar caché
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

---

## 📝 Changelog

### Versión 1.0.0 (2025-09-17)
- ✨ Lanzamiento inicial del sistema
- ✨ Gestión completa de activos patrimoniales
- ✨ Sistema de usuarios, roles y permisos
- ✨ Módulo de reportes con exportación
- ✨ Interfaz responsive con AdminLTE

---

## 🤝 Soporte y Contacto

### Winner Systems Corporation S.A.C.
- **Web:** [www.winner-systems.com](https://www.winner-systems.com)
- **Email Soporte:** soporte@winner-systems.com
- **Email Comercial:** ventas@winner-systems.com
- **WhatsApp:** +51 931-741-355

### Horarios de Atención
- Lunes a Viernes: 8:00 AM - 6:00 PM
- Sábados: 9:00 AM - 1:00 PM

---

## 📄 Licencia

Copyright © 2025 Winner Systems Corporation S.A.C.

Este software es propiedad de Winner Systems Corporation S.A.C. (RUC: 20613731335). 
Todos los derechos reservados.

El uso, copia, modificación o distribución no autorizada de este software está 
estrictamente prohibido y puede resultar en acciones legales.

---

## 🌟 Desarrollado con ❤️ por Winner Systems

**Transformación Digital para Municipalidades**

Bolognesi, Ancash - Perú
```

Este README es profesional, completo y específico para tu proyecto. Incluye toda la información necesaria para que cualquier desarrollador pueda instalar y entender el sistema, además de reflejar correctamente la autoría de Winner Systems Corporation.