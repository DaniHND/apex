@extends('layouts.app')

@section('title', 'Crear Nuevo Agente - Apex Legends')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header apex-header text-white">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    Crear Nuevo Agente
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('agentes.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">
                            <i class="fas fa-user me-1"></i>
                            Nombre del Agente
                        </label>
                        <input type="text" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre') }}" 
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
                                        {{ old('rol') == $valor ? 'selected' : '' }}>
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
                                  required>{{ old('habilidad') }}</textarea>
                        @error('habilidad')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            Describe la habilidad pasiva, táctica y definitiva del agente.
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('agentes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Volver a la Lista
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Crear Agente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection