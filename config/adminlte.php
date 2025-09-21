<?php

return [

    'title' => 'SISTEMA DE GESTIÓN DE PATRIMONIAL',
    'title_prefix' => '',
    'title_postfix' => '',

    'use_ico_only' => true,
    'use_full_favicon' => false,

    'google_fonts' => [
        'allowed' => true,
    ],


    'logo' => '<b>WINNER SYSTEMS</b>',
    'logo_img' => 'vendor/adminlte/dist/img/Logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'WINNER SYSTEMS',

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/Logo.png',
            'alt' => 'WINNER SYSTEMS',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    'preloader' => [
        'enabled' => false,
        'mode' => 'cwrapper',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/Logo.png',
            'alt' => 'WINNER SYSTEMS',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-gray',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-orange',
    'classes_auth_header' => 'card-danger',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/dashboard', //home
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'forgot-password', // Cambia a la ruta real de Jetstream
    'password_email_url' => 'forgot-password', // Ajusta para el POST
    'profile_url' => '/user/profile',
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */



    'menu' => [
        // BARRA SUPERIOR
        [
            'type' => 'navbar-search',
            'text' => 'Buscar...',
            'topnav_right' => false,
            // Sin permiso específico - todos pueden buscar
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => false,
        ],
        [
            'type'         => 'darkmode-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ],

        // PANEL PRINCIPAL
        [
            'header' => 'PANEL PRINCIPAL',
            'classes'    => 'text-white text-bold text-center',
        ],

        [
            'text'       => 'Dashboard',
            'url'        => 'dashboard',
            'icon'       => 'fas fa-tachometer-alt',
            'icon_color' => 'primary',
            'classes'    => 'text-white',
            // Sin permiso específico - todos tienen acceso al dashboard
        ],

        // GESTIÓN DE ACCESOS
        [
            'header'     => 'GESTIÓN DE ACCESOS',
            'classes'    => 'text-white text-bold text-center',
        ],

        [
            'text'       => 'Usuarios',
            'route'      => 'users.index',
            'icon'       => 'fas fa-user',
            'icon_color' => 'info',
            'classes'    => 'text-white',
            'can'        => 'ver usuarios',
            'active'     => ['users*'],
        ],

        [
            'text'       => 'Roles',
            'route'      => 'roles.index',
            'icon'       => 'fas fa-user-tag',
            'icon_color' => 'success',
            'classes'    => 'text-white',
            'can'        => 'ver roles',
            'active'     => ['roles*'],
        ],

        [
            'text'       => 'Permisos',
            'route'      => 'permissions.index',
            'icon'       => 'fas fa-key',
            'icon_color' => 'warning',
            'classes'    => 'text-white',
            'can'        => 'ver permisos',
            'active'     => ['permissions*'],
        ],

        // ORGANIZACIÓN INTERNA
        [
            'header' => 'ORGANIZACIÓN INTERNA',
            'classes'    => 'text-white text-bold text-center',
        ],
        [
            'text' => 'Oficinas',
            'route' => 'offices.index',
            'icon' => 'fas fa-building',
            'icon_color' => 'info',
            'classes'    => 'text-white',
            'can' => 'ver oficinas',
            'active' => ['offices*'],
        ],
        [
            'text' => 'Cargos',
            'route' => 'job_positions.index',
            'icon' => 'fas fa-briefcase',
            'icon_color' => 'success',
            'classes'    => 'text-white',
            'can' => 'ver puestos de trabajo',
            'active' => ['job-positions*'],
        ],
        [
            'text' => 'Contratos',
            'route' => 'contract_types.index',
            'icon' => 'fas fa-file-contract',
            'icon_color' => 'warning',
            'classes'    => 'text-white',
            'can' => 'ver tipos de contratos',
            'active' => ['contract-types*'],
        ],
        [
            'text' => 'Trabajadores',
            'route' => 'workers.index',
            'icon' => 'fas fa-users',
            'icon_color' => 'danger',
            'classes'    => 'text-white',
            'can' => 'ver trabajadores',
            'active' => ['workers*'],
        ],

        // ACTIVOS
        [
            'header' => 'GESTIÓN DE ACTIVOS',
            'classes'    => 'text-white text-bold text-center',
        ],
        // TIPOS DE ACTIVOS
        [
            'text'       => 'Tipos de Activos',
            'route'      => 'asset_types.index',
            'icon'       => 'fas fa-cubes',
            'icon_color' => 'info',
            'classes'    => 'text-white',
            'can'        => 'ver tipos de activos',
            'active'     => ['asset-types*'],
        ],
        // ESTADOS DE ACTIVOS
        [
            'text'       => 'Estados de Activos',
            'route'      => 'asset_states.index',
            'icon'       => 'fas fa-clipboard-check',
            'icon_color' => 'success',
            'classes'    => 'text-white',
            'can'        => 'ver estados de activos',
            'active'     => ['asset-states*'],
        ],
        [
            'text'       => 'Tipos de Software',
            'route'      => 'software_types.index',
            'icon'       => 'fas fa-laptop-code',
            'icon_color' => 'warning',
            'classes'    => 'text-white',
            'can'        => 'ver tipos de software',
            'active'     => ['software-types*'],
        ],

        [
            'text'       => 'Inventario',
            'icon'       => 'fas fa-boxes',
            'icon_color' => 'danger',
            'classes'    => 'text-white',
            'can'        => 'ver activos de la empresa', // Permiso general para ver el menú
            'active'     => ['company-assets*'],
            'submenu'    => [
                [
                    'text' => 'General',
                    'route'  => 'company_assets.index',
                    'icon' => 'fas fa-clipboard-list',
                    'icon_color' => 'danger',
                    'classes'    => 'text-danger',
                    'can' => 'ver activos de la empresa',
                    'active' => ['company-assets', 'company-assets/index', 'company-assets/create', 'company-assets/edit', 'company-assets/show'],
                ],
                [
                    'text' => 'Hardware',
                    'route'  => 'asset_hardwares.index',
                    'icon' => 'fas fa-desktop',
                    'icon_color' => 'danger',
                    'classes'    => 'text-danger',
                    'can' => 'ver hardware',
                    'active' => ['asset-hardwares*'],
                ],
                [
                    'text' => 'Software',
                    'route'  => 'asset_softwares.index',
                    'icon' => 'fas fa-laptop-code',
                    'icon_color' => 'danger',
                    'classes'    => 'text-danger',
                    'can' => 'ver software',
                    'active' => ['asset-softwares*'],
                ],
                [
                    'text' => 'Mobiliario',
                    'route'  => 'asset_furnitures.index',
                    'icon' => 'fas fa-couch',
                    'icon_color' => 'danger',
                    'classes'    => 'text-danger',
                    'can' => 'ver mobiliarios',
                    'active' => ['assets-furnitures*'],
                ],
                [
                    'text' => 'Maquinaria',
                    'route'  => 'asset_machineries.index',
                    'icon' => 'fas fa-tractor',
                    'icon_color' => 'danger',
                    'classes'    => 'text-danger',
                    'can' => 'ver maquinaria',
                    'active' => ['asset-machineries*']
                ],
                [
                    'text' => 'Herramienta',
                    'route'  => 'asset_tools.index',
                    'icon' => 'fas fa-tools',
                    'icon_color' => 'danger',
                    'classes'    => 'text-danger',
                    'can' => 'ver otros activos', // Herramientas entran en "otros activos"
                    'active' => ['asset-tools*'],
                ],
                [
                    'text' => 'Otros Activos',
                    'route'  => 'asset_others.index',
                    'icon' => 'fas fa-layer-group',
                    'icon_color' => 'danger',
                    'classes'    => 'text-danger',
                    'can' => 'ver otros activos',
                    'active' => ['asset-others*'],
                ]
            ],
        ],
        // REPORTES
        [
            'header' => 'REPORTES',
            'classes'    => 'text-white text-bold text-center',
        ],

        [
            'text'       => 'Reportes Generales',
            //'route'      => 'reports.index',
            'icon'       => 'fas fa-chart-pie',
            'icon_color' => 'primary',
            'classes'    => 'text-white',
            //'can'        => 'ver reportes',
            'active'     => ['reports*'],
        ],

        // CONFIGURACIÓN
        [
            'header' => 'CONFIGURACIÓN',
            'classes'    => 'text-white text-bold text-center',
        ],

        [
            'text'       => 'Mi Perfil',
            'url'        => 'user/profile',
            'icon'       => 'fas fa-user-circle',
            'icon_color' => 'info',
            'classes'    => 'text-white',
            // Sin permiso específico - todos pueden ver su perfil
        ],

        // DOCUMENTACIÓN Y SOPORTE
        [
            'header' => 'DOCUMENTACIÓN Y SOPORTE',
            'classes'    => 'text-white text-bold text-center',
        ],

        [
            'text'       => 'Manual del Usuario',
            'route'      => 'user_manuals.index',
            'icon'       => 'fas fa-book',
            'icon_color' => 'info',
            'classes'    => 'text-white',
            'active' => ['user-manuals*'],
            // Sin permiso específico - todos pueden acceder al manual
        ],

        [
            'text' => 'Soporte Técnico',
            'route' => 'support',
            'icon' => 'fas fa-headset',
            'icon_color' => 'success',
            'classes' => 'text-white',
            'active' => ['support*'],
        ],
        [
            'text' => 'Acerca del Sistema',
            'route' => 'about',
            'icon' => 'fas fa-info-circle',
            'icon_color' => 'warning',
            'classes' => 'text-white',
            'active' => ['about*'],
        ],
    ],












    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */


    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true, // Habilita el plugin Datatables
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'DatatablesPlugins' => [
            'active' => true, // Habilita los plugins de exportación (opcional)
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true, // Activamos para modales
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11', // Versión actualizada
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'BootstrapSwitch' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-switch/js/bootstrap-switch.min.js',
                ],
            ],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
