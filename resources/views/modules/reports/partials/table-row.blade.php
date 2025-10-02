@switch($type)
    @case('trabajadores')
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->office->name ?? 'N/A' }}</td>
        <td>{{ $item->jobPosition->name ?? 'N/A' }}</td>
        <td>{{ $item->contractType->name ?? 'N/A' }}</td>
        <td>{{ $item->created_at->format('d/m/Y') }}</td>
        @break
    
    @case('usuarios')
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>
            @foreach($item->roles as $role)
                <span class="badge badge-primary">{{ $role->name }}</span>
            @endforeach
        </td>
        <td>
            @if($item->email_verified_at)
                <span class="badge badge-success">Activo</span>
            @else
                <span class="badge badge-secondary">Inactivo</span>
            @endif
        </td>
        <td>{{ $item->created_at->format('d/m/Y') }}</td>
        @break
    
    @case('oficinas')
        <td>{{ $item->name }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->workers->count() }}</td>
        <td>{{ $item->created_at->format('d/m/Y') }}</td>
        @break

    @case('cargos')
        <td>{{ $item->name }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->workers->count() }}</td>
        <td>{{ $item->created_at->format('d/m/Y') }}</td>
        @break

    @case('tipos_contrato')
        <td>{{ $item->name }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->workers->count() }}</td>
        <td>{{ $item->created_at->format('d/m/Y') }}</td>
        @break

    @case('activos_generales')
        <td>{{ $item->code }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->assetType->name ?? 'N/A' }}</td>
        <td>
            <span class="badge badge-info">{{ $item->assetState->name ?? 'N/A' }}</span>
        </td>
        <td>{{ $item->office->name ?? 'N/A' }}</td>
        <td>{{ $item->worker->name ?? 'N/A' }}</td>
        @break

    @default
        <td>{{ $item->name ?? $item->title ?? 'N/A' }}</td>
        <td>{{ $item->description ?? 'N/A' }}</td>
        <td>{{ $item->created_at->format('d/m/Y') }}</td>
@endswitch