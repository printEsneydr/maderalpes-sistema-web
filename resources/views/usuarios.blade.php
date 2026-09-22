@extends('MaderAlpes.layouts.layoutDasboard')

@section('contenido')
    <div class="container-fluid py-4">
        <!-- Encabezado con título y botón de agregar -->
        <div class="card card-dashboard mb-4">
            <div class="header-container d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-people me-2"></i>Gestión de Usuarios
                    </h4>
                    <p class="text-muted mb-0 small">Administre los usuarios registrados en el sistema</p>
                </div>
                <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#ModalAgregarUsuario">
                    <i class="bi bi-plus-lg me-2"></i>Agregar Usuario
                </button>
            </div>
        </div>

        <!-- Mensajes de éxito o error -->
        @if (session('exito_usuario'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('exito_usuario') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>Revisa los datos ingresados e inténtalo de nuevo.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <!-- Tarjetas de estadísticas -->
        <div class="row mb-4">
            <!-- Total de usuarios registrados -->
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                <i class="bi bi-people-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1 small">Total Usuarios</h6>
                                <h3 class="fw-bold mb-0">{{ $usuarios->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usuarios nuevos este mes -->
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                <i class="bi bi-person-plus-fill text-success fs-4"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1 small">Usuarios nuevos este mes</h6>
                                <h3 class="fw-bold mb-0">
                                    {{ $usuarios->where('created_at', '>=', now()->startOfMonth())->count() }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cantidad de administradores -->
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                                <i class="bi bi-shield-lock-fill text-warning fs-4"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1 small">Usuarios conectados</h6>
                                <h3 class="fw-bold mb-0">
                                    {{ $usuarios->whereNotNull('remember_token')->count() }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenedor principal de la tabla -->
        <div class="card card-dashboard">
            <div class="card-body p-0">
                <!-- Barra de filtros -->
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary rounded-pill me-2">{{ $usuarios->count() }}</span>
                        <span class="text-muted small">Usuarios registrados</span>
                    </div>
                </div>

                <!-- Tabla de usuarios -->
                <div class="table-responsive">
                    <table class="table table-technical mb-0" id="tabla-usuarios">
                        <thead>
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th style="width: 25%;">USUARIO</th>
                                <th style="width: 30%;">CORREO</th>
                                <th>ESTADO</th>
                                <th>FECHA REGISTRO</th>
                                <th style="width: 120px;" class="text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td class="fw-bold text-muted">#{{ $usuario->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2 d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;">
                                                <span class="fw-bold text-primary small">
                                                    {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $usuario->name }}</div>
                                                <small class="text-muted">
                                                    {{ $usuario->id === auth()->id() ? 'Sesión actual' : 'Cuenta registrada' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ $usuario->email }}</td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success fw-normal">
                                            <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i>Activo
                                        </span>
                                    </td>
                                    <td class="text-muted">{{ $usuario->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        @if ($usuario->id !== auth()->id())
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#ModalEliminarUsuario{{ $usuario->id }}"
                                                title="Eliminar usuario">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales de confirmación para eliminar usuarios -->
    @foreach ($usuarios as $usuario)
        @if ($usuario->id !== auth()->id())
            <div class="modal fade" id="ModalEliminarUsuario{{ $usuario->id }}" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar al usuario
                                {{ $usuario->name }}?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancelar</button>
                            <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-1"></i>Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar un usuario -->
    <div class="modal fade" id="ModalAgregarUsuario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('usuarios.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Nombre completo -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nombre y apellidos" required>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Correo electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="correo@ejemplo.com" required>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Mínimo 8 caracteres" required>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Inicializa la tabla de usuarios con búsqueda y ordenamiento
        $(document).ready(function() {
            $('#tabla-usuarios').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                order: [
                    [0, 'asc']
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'Todos']
                ],
                dom: '<"d-flex justify-content-between align-items-center mb-3"<"d-flex align-items-center"l><"d-flex"f>>t<"d-flex justify-content-between align-items-center mt-3"<"d-flex align-items-center"i><"d-flex"p>>',
            });
        });
    </script>
@endpush