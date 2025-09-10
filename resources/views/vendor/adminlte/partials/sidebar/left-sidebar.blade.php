{{-- 
    @Author: Edwin Yoner
    @Date: 2025-09-08
    @Change: Adaptación del sidebar para mostrar foto con esquinas redondeadas 
--}}

<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- User Profile Panel --}}
    @auth
            <div class="user-panel mt-5 pt-3 pb-3 mb-0 d-flex">
                <div class="mx-auto d-flex align-items-center">
                    <div class="image">
                    <img src="{{ auth()->user()->adminlte_image() }}" class="rounded elevation-2" alt="User Image"
                        style="width: 34px; height: 34px; object-fit: cover;">
                </div>
                <div class="info">
                    {{-- <a href="{{ url('user/profile') }}" class="d-block text-decoration-none"> --}}
                        <strong class="text-white">
                            {{ implode(' ', array_slice(explode(' ', auth()->user()->name), 0, 2)) ?? 'Usuario' }}
                        </strong>
                        <div class="user-role">
                            @php
                                $userRole = auth()->user()->roles->first()?->name ?? 'Sin rol';
                                $roleClass = match ($userRole) {
                                    'Admin' => 'text-danger',
                                    'Autoridad' => 'text-warning',
                                    'Usuario' => 'text-info',
                                    default => 'text-muted'
                                };
                            @endphp
                            <small class="{{ $roleClass }}">
                                <i class="fas fa-circle" style="font-size: 6px;"></i> {{ $userRole }}
                            </small>
                        </div>
                    {{-- </a> --}}
                </div>
                </div>
            </div>
    @endauth

    {{-- Sidebar menu --}}
    <div class="sidebar mt-0 pt-0">
        <nav class="mt-0 pt-0">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>

{{-- CSS adicional para el panel de usuario --}}
<style>
    .user-panel {
        border-bottom: 1px solid #4f5962;
    }

    .user-panel .info a:hover {
        opacity: 0.8;
    }

    .user-panel .info .user-role {
        margin-top: 2px;
        line-height: 1.2;
    }

    .user-panel .info .user-role small {
        font-size: 0.75rem;
        font-weight: 500;
    }

    .user-panel .info .user-role .fas.fa-circle {
        vertical-align: middle;
        margin-right: 4px;
    }

    /* Ajustes responsive */
    @media (max-width: 768px) {
        .user-panel .info strong {
            font-size: 0.9rem;
        }

        .user-panel .info .user-role small {
            font-size: 0.7rem;
        }
    }
</style>