@extends('layouts.app')

@section('title', 'Lista de Agentes - Apex Legends')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">
                <i class="fas fa-users me-2 text-primary"></i>
                Agentes de Apex Legends
            </h1>
            <a href="{{ route('agentes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Nuevo Agente
            </a>
        </div>

        @if($agentes->count() > 0)
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Avatar</th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Habilidad</th>
                                    <th>Creado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agentes as $agente)
                                <tr>
                                    <td>
                                        <div class="agent-avatar">
                                            @php
                                                // Definir imágenes por agente
                                                $avatars = [
                                                    'Wraith' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/6/60/Wraith_Icon.png',
                                                    'Lifeline' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/5/57/Lifeline_Icon.png',
                                                    'Bloodhound' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/f/f4/Bloodhound_Icon.png',
                                                    'Gibraltar' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/d/d2/Gibraltar_Icon.png',
                                                    'Octane' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/e/e8/Octane_Icon.png',
                                                    'Wattson' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/9/9c/Wattson_Icon.png',
                                                    'Pathfinder' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/7/7d/Pathfinder_Icon.png',
                                                    'Caustic' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/9/94/Caustic_Icon.png',
                                                    'Bangalore' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/b/bd/Bangalore_Icon.png',
                                                    'Mirage' => 'https://static.wikia.nocookie.net/apexlegends_gamepedia_en/images/a/a7/Mirage_Icon.png'
                                                ];
                                                $defaultAvatar = 'https://via.placeholder.com/40x40/ff6600/ffffff?text=' . substr($agente->nombre, 0, 2);
                                                $avatarUrl = $avatars[$agente->nombre] ?? $defaultAvatar;
                                            @endphp
                                            <img src="{{ $avatarUrl }}" 
                                                 alt="{{ $agente->nombre }}" 
                                                 class="rounded-circle border border-warning" 
                                                 style="width: 40px; height: 40px; object-fit: cover;"
                                                 onerror="this.src='{{ $defaultAvatar }}'">
                                        </div>
                                    </td>
                                    <td class="fw-bold">{{ $agente->id }}</td>
                                    <td>
                                        <strong>{{ $agente->nombre }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge role-badge role-{{ $agente->rol }}">
                                            {{ $agente->rol_nombre }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="habilidad-preview p-2 rounded" style="background: rgba(45, 45, 45, 0.8); border: 1px solid rgba(255, 102, 0, 0.2);">
                                            <small class="text-light">
                                                {{ Str::limit($agente->habilidad, 50) }}
                                            </small>
                                        </div>
                                    </td>
                                    <td class="text-muted">
                                        {{ $agente->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('agentes.show', $agente) }}" 
                                               class="btn btn-outline-info" 
                                               title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('agentes.edit', $agente) }}" 
                                               class="btn btn-outline-warning" 
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('agentes.destroy', $agente) }}" 
                                                  method="POST" 
                                                  style="display: inline;"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar a {{ $agente->nombre }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger" 
                                                        title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $agentes->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-user-slash fa-5x text-muted"></i>
                </div>
                <h3 class="text-muted">No hay agentes registrados</h3>
                <p class="text-muted mb-4">Comienza agregando tu primer agente de Apex Legends</p>
                <a href="{{ route('agentes.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>
                    Crear Primer Agente
                </a>
            </div>
        @endif
    </div>
</div>
@endsection