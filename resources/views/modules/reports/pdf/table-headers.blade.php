@switch($type)
    @case('trabajadores')
        <th>Nombre</th>
        <th>Email</th>
        <th>Oficina</th>
        <th>Cargo</th>
        <th>Tipo Contrato</th>
        <th>Fecha Registro</th>
        @break
    
    @case('usuarios')
        <th>Nombre</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Estado</th>
        <th>Fecha Registro</th>
        @break
    
    @case('oficinas')
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Total Trabajadores</th>
        <th>Fecha Creación</th>
        @break
    
    @case('cargos')
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Total Asignados</th>
        <th>Fecha Creación</th>
        @break

    @case('tipos_contrato')
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Trabajadores</th>
        <th>Fecha Creación</th>
        @break

    @case('activos_generales')
        <th>Código</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Ubicación</th>
        <th>Responsable</th>
        @break

    @default
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Fecha Creación</th>
@endswitch