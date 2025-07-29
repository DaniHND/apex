@extends('layouts.app')

@section('title', 'Editar Agente: ' . $agente->nombre)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header apex-header text-white">
                <h4 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>
                    Editar Agente: {{ $agente->nombre }}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('agentes.update', $agente) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">
                            <i class="fas fa-user me-1"></i>
                            Nombre del Agente
                        </label>
                        <input type="text" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre', $agente->nombre) }}" 
                               placeholder="Ej: Wraith, Octane, Lifeline..."
                               required>
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            El nombre debe ser único para cada agente.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label fw-bold">
                            <i class="fas fa-tags me-1"></i>
                            Rol del Agente
                        </label>
                        <select class="form-select @error('rol') is-invalid @enderror" 
                                id="rol" 
                                name="rol" 
                                required>
                            <option value="">Seleccionar rol...</option>
                            @foreach($roles as $valor => $nombre)
                                <option value="{{ $valor }}" 
                                        {{ old('rol', $agente->rol) == $valor ? 'selected' : '' }}>
                                    {{ $nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('rol')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            <strong>Asalto:</strong> Agentes ofensivos | 
                            <strong>Defensivo:</strong> Protección del equipo | 
                            <strong>Apoyo:</strong> Ayuda al equipo | 
                            <strong>Reconocimiento:</strong> Información del campo
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="habilidad" class="form-label fw-bold">
                            <i class="fas fa-magic me-1"></i>
                            Descripción de Habilidades
                        </label>
                        <textarea class="form-control @error('habilidad') is-invalid @enderror" 
                                  id="habilidad" 
                                  name="habilidad" 
                                  rows="4" 
                                  placeholder="Describe las habilidades principales del agente..."
                                  required>{{ old('habilidad', $agente->habilidad) }}</textarea>
                        @error('habilidad')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            Describe la habilidad pasiva, táctica y definitiva del agente.
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-calendar-plus me-1"></i>
                                Creado: {{ $agente->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-calendar-edit me-1"></i>
                                Última actualización: {{ $agente->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('agentes.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i>
                                Volver a la Lista
                            </a>
                            <a href="{{ route('agentes.show', $agente) }}" class="btn btn-info">
                                <i class="fas fa-eye me-1"></i>
                                Ver Detalles
                            </a>
                        </div>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i>
                            Actualizar Agente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection