@extends('MaderAlpes.layouts.layoutDasboard')

@section('contenido')
    <!-- Main Content -->
    <main class="main-content p-0">
        <!-- Encabezado del panel -->
        <div class="bg-light border-bottom p-4 mb-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 fw-bold">Panel de Control</h1>
                    <p class="text-muted mb-0 small">
                        Bienvenido, {{ Auth::user()->name }}, al sistema de administración de MaderAlpes.
                    </p>
                </div>
                <a href="{{ route('catalogo') }}" class="btn btn-primary btn-sm d-flex align-items-center">
                    <i class="bi bi-eye me-2"></i>Ver Catálogo Público
                </a>
            </div>
        </div>

        <!-- Contenido del panel -->
        <div class="px-4 pb-4">
            <!-- Tarjetas de estadísticas -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1 fw-normal">Productos Publicados</h6>
                                    <h3 class="mb-0 fw-bold">{{ $productos->count() }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-2 rounded">
                                    <i class="bi bi-box-seam text-primary fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1 fw-normal">Categorías</h6>
                                    <h3 class="mb-0 fw-bold">{{ $categorias->count() }}</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-2 rounded">
                                    <i class="bi bi-collection text-success fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1 fw-normal">Usuarios Registrados</h6>
                                    <h3 class="mb-0 fw-bold">{{ $usuarios->count() }}</h3>
                                </div>
                                <div class="bg-info bg-opacity-10 p-2 rounded">
                                    <i class="bi bi-people text-info fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1 fw-normal">Proyectos del Portafolio</h6>
                                    <h3 class="mb-0 fw-bold">8</h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-2 rounded">
                                    <i class="bi bi-images text-warning fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Últimos productos y usuarios -->
            <div class="row g-4 mb-4">
                <!-- Últimos productos agregados -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Últimos Productos</h5>
                            <a href="{{ route('productos.index') }}" class="btn btn-sm btn-outline-primary">
                                Administrar Productos
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0 ps-3">Producto</th>
                                            <th class="border-0">Categoría</th>
                                            <th class="border-0">Precio</th>
                                            <th class="border-0 text-end pe-3">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($productos->take(6) as $producto)
                                            <tr>
                                                <td class="ps-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-light rounded me-3 p-2 d-flex align-items-center justify-content-center"
                                                            style="width: 40px; height: 40px;">
                                                            @if ($producto->imagen)
                                                                <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                                    alt="{{ $producto->nombre }}"
                                                                    style="width: 34px; height: 34px; object-fit: cover; border-radius: 6px;">
                                                            @else
                                                                <i class="bi bi-box-seam text-secondary"></i>
                                                            @endif
                                                        </div>
                                                        <span>{{ $producto->nombre }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $producto->categoria }}</td>
                                                <td>$ {{ number_format($producto->precio, 0, ',', '.') }}</td>
                                                <td class="text-end pe-3">
                                                    <span class="badge bg-success">Publicado</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    Aún no hay productos registrados.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Usuarios registrados más recientes -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Usuarios Recientes</h5>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-outline-primary">
                                Ver Todos
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @forelse ($usuarios->take(4) as $usuario)
                                    <div class="list-group-item border-0 py-3">
                                        <div class="d-flex">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;">
                                                <span class="fw-bold text-primary small">
                                                    {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">{{ $usuario->name }}</p>
                                                <p class="text-muted small mb-0">{{ $usuario->email }}</p>
                                                <small class="text-muted">
                                                    Registrado el {{ $usuario->created_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="list-group-item border-0 py-3 text-muted text-center">
                                        Aún no hay usuarios registrados.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accesos rápidos -->
            <div class="row g-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent py-3">
                            <h5 class="mb-0 fw-bold">Accesos Rápidos</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('productos.index') }}" class="text-decoration-none">
                                        <div class="card h-100 border-0 bg-light text-center py-4">
                                            <i class="bi bi-box-seam text-primary fs-3 mb-2"></i>
                                            <h6 class="mb-0">Productos</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('categorias.index') }}" class="text-decoration-none">
                                        <div class="card h-100 border-0 bg-light text-center py-4">
                                            <i class="bi bi-collection text-success fs-3 mb-2"></i>
                                            <h6 class="mb-0">Categorías</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('usuarios.index') }}" class="text-decoration-none">
                                        <div class="card h-100 border-0 bg-light text-center py-4">
                                            <i class="bi bi-people text-info fs-3 mb-2"></i>
                                            <h6 class="mb-0">Usuarios</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                                        <div class="card h-100 border-0 bg-light text-center py-4">
                                            <i class="bi bi-person-workspace text-warning fs-3 mb-2"></i>
                                            <h6 class="mb-0">Mi Perfil</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection