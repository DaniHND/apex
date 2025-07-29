@extends('layouts.app')

@section('title', 'Agente: ' . $agente->nombre)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header apex-header text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    {{ $agente->nombre }}
                </h4>
                <span class="badge role-badge role-{{ $agente->rol }} fs-6">
                    {{ $agente->rol_nombre }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-card p-3 border rounded bg-light">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-id-badge me-1"></i>
                                ID del Agente
                            </h6>
                            <p class="fs-4 fw-bold text-primary mb-0">#{{ $agente->id }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card p-3 border rounded bg-light">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-tags me-1"></i>
                                Clasificación
                            </h6>
                            <span class="badge role-badge role-{{ $agente->rol }} fs-5">
                                {{ $agente->rol_nombre }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-magic me-2 text-primary"></i>
                        Habilidades
                    </h5>
                    <div class="p-3 border rounded bg-light">
                        <p class="mb-0 lh-lg">{{ $agente->habilidad }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-card p-3 border rounded">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-calendar-plus me-1"></i>
                                Fecha de Registro
                            </h6>
                            <p class="mb-0">
                                {{ $agente->created_at->format('d/m/Y') }}
                                <small class="text-muted">
                                    ({{ $agente->created_at->format('H:i') }})
                                </small>
                            </p>
                            <small class="text-muted">
                                Hace {{ $agente->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card p-3 border rounded">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-calendar-edit me-1"></i>
                                Última Actualización
                            </h6>
                            <p class="mb-0">
                                {{ $agente->updated_at->format('d/m/Y') }}
                                <small class="text-muted">
                                    ({{ $agente->updated_at->format('H:i') }})
                                </small>
                            </p>
                            <small class="text-muted">
                                Hace {{ $agente->updated_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between flex-wrap gap-2">
                    <div>
                        <a href="{{ route('agentes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Volver a la Lista
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('agentes.edit', $agente) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-1"></i>
                            Editar Agente
                        </a>
                        <form action="{{ route('agentes.destroy', $agente) }}" 
                              method="POST" 
                              style="display: inline;"
                              onsubmit="return confirm('¿Estás seguro de eliminar a {{ $agente->nombre }}? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection