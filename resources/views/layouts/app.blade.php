<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Agentes de Apex Legends')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --apex-orange: #ff6600;
            --apex-orange-dark: #cc5200;
            --apex-blue: #00b4d8;
            --apex-purple: #7209b7;
            --apex-dark: #1a1a1a;
            --apex-darker: #0d1117;
            --apex-gray: #2d2d2d;
        }

        body {
            background: linear-gradient(135deg, var(--apex-darker) 0%, var(--apex-dark) 100%);
            color: #ffffff;
            min-height: 100vh;
        }

        .apex-header {
            background: linear-gradient(135deg, var(--apex-orange), var(--apex-orange-dark));
            color: white;
            position: relative;
            overflow: hidden;
        }

        .apex-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><polygon points="50,10 90,90 10,90" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/></svg>');
            background-size: 50px 50px;
            opacity: 0.3;
            pointer-events: none;
        }

        .apex-header * {
            position: relative;
            z-index: 1;
        }

        .card {
            background: rgba(45, 45, 45, 0.95);
            border: 1px solid rgba(255, 102, 0, 0.3);
            backdrop-filter: blur(10px);
            color: #ffffff;
        }

        .card-header {
            border-bottom: 1px solid rgba(255, 102, 0, 0.3);
        }

        .role-badge {
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .role-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .role-badge:hover::before {
            left: 100%;
        }

        .role-assault { 
            background: linear-gradient(135deg, #ff4757, #ff3742);
            color: white;
            box-shadow: 0 0 15px rgba(255, 71, 87, 0.4);
        }
        .role-defensive { 
            background: linear-gradient(135deg, #3742fa, #2f3542);
            color: white;
            box-shadow: 0 0 15px rgba(55, 66, 250, 0.4);
        }
        .role-support { 
            background: linear-gradient(135deg, #2ed573, #1e90ff);
            color: white;
            box-shadow: 0 0 15px rgba(46, 213, 115, 0.4);
        }
        .role-recon { 
            background: linear-gradient(135deg, #ffa502, #ff6348);
            color: white;
            box-shadow: 0 0 15px rgba(255, 165, 2, 0.4);
        }

        .table-dark {
            background: var(--apex-gray) !important;
            border-color: rgba(255, 102, 0, 0.3);
        }

        .table-hover tbody tr:hover {
            background: rgba(255, 102, 0, 0.1) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--apex-orange), var(--apex-orange-dark));
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--apex-orange-dark), var(--apex-orange));
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 102, 0, 0.4);
        }

        .form-control, .form-select {
            background: rgba(45, 45, 45, 0.8);
            border: 1px solid rgba(255, 102, 0, 0.3);
            color: #ffffff;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(45, 45, 45, 0.9);
            border-color: var(--apex-orange);
            box-shadow: 0 0 0 0.2rem rgba(255, 102, 0, 0.25);
            color: #ffffff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-control option {
            background: var(--apex-gray);
            color: #ffffff;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(46, 213, 115, 0.2), rgba(30, 144, 255, 0.2));
            border-color: #2ed573;
            color: #ffffff;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(255, 71, 87, 0.2), rgba(255, 55, 66, 0.2));
            border-color: #ff4757;
            color: #ffffff;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .form-text {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .table {
            color: #ffffff;
        }

        .table td, .table th {
            border-color: rgba(255, 102, 0, 0.2);
        }

        .form-label {
            color: #ffffff !important;
            font-weight: 600;
        }

        .pagination .page-link {
            background: rgba(45, 45, 45, 0.8);
            border-color: rgba(255, 102, 0, 0.3);
            color: #ffffff;
        }

        .pagination .page-link:hover {
            background: var(--apex-orange);
            border-color: var(--apex-orange);
            color: #ffffff;
        }

        .pagination .page-item.active .page-link {
            background: var(--apex-orange);
            border-color: var(--apex-orange);
        }

        .btn-secondary {
            background: rgba(108, 117, 125, 0.8);
            border-color: rgba(108, 117, 125, 0.8);
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: rgba(108, 117, 125, 1);
            border-color: rgba(108, 117, 125, 1);
            color: #ffffff;
        }

        .btn-outline-info {
            color: var(--apex-blue);
            border-color: var(--apex-blue);
        }

        .btn-outline-info:hover {
            background: var(--apex-blue);
            border-color: var(--apex-blue);
            color: #ffffff;
        }

        .btn-outline-warning {
            color: #ffc107;
            border-color: #ffc107;
        }

        .btn-outline-warning:hover {
            background: #ffc107;
            border-color: #ffc107;
            color: #000000;
        }

        .btn-outline-danger {
            color: #ff4757;
            border-color: #ff4757;
        }

        .btn-outline-danger:hover {
            background: #ff4757;
            border-color: #ff4757;
            color: #ffffff;
        }

        .apex-logo {
            font-weight: 900;
            font-size: 1.2rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .navbar-brand:hover {
            animation: pulse 1s infinite;
        }

        .info-card {
            background: rgba(45, 45, 45, 0.8);
            border: 1px solid rgba(255, 102, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--apex-orange), var(--apex-blue), var(--apex-purple), var(--apex-orange));
            z-index: -1;
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .info-card:hover::before {
            opacity: 0.7;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #ffffff !important;
        }

        p {
            color: #ffffff;
        }

        small {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .bg-light {
            background: rgba(45, 45, 45, 0.6) !important;
            color: #ffffff !important;
        }

        .dropdown-menu {
            background: var(--apex-gray);
            border-color: rgba(255, 102, 0, 0.3);
        }

        .dropdown-item {
            color: #ffffff;
        }

        .dropdown-item:hover {
            background: var(--apex-orange);
            color: #ffffff;
        }
    </style>
</head>
<body class="bg-dark">
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; opacity: 0.1; background-image: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><polygon points=&quot;50,10 85,35 85,65 50,90 15,65 15,35&quot; fill=&quot;none&quot; stroke=&quot;%23ff6600&quot; stroke-width=&quot;1&quot;/></svg>'); background-size: 50px 50px;"></div>
    <nav class="navbar navbar-expand-lg apex-header">
        <div class="container">
            <a class="navbar-brand apex-logo d-flex align-items-center" href="{{ route('agentes.index') }}">
                <svg width="32" height="32" viewBox="0 0 100 100" class="me-2">
                    <polygon points="50,10 90,90 10,90" fill="currentColor" stroke="rgba(255,255,255,0.5)" stroke-width="2"/>
                    <circle cx="50" cy="50" r="8" fill="rgba(255,255,255,0.8)"/>
                </svg>
                APEX LEGENDS
                <span class="badge bg-light text-dark ms-2 fs-6">AGENTES</span>
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link text-white fw-bold" href="{{ route('agentes.index') }}">
                    <i class="fas fa-list me-1"></i>
                    <span class="d-none d-md-inline">Lista de</span> Agentes
                </a>
                <a class="nav-link text-white fw-bold" href="{{ route('agentes.create') }}">
                    <i class="fas fa-plus me-1"></i>
                    <span class="d-none d-md-inline">Nuevo</span> Agente
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Errores encontrados:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>