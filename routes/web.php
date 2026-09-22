<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('MaderAlpes.index');
})->name('index');

// El catálogo público muestra los productos que el administrador agrega desde el panel.
Route::get('/catalogo', function () {
    $productos = Producto::all();

    return view('MaderAlpes.catalogo', compact('productos'));
})->name('catalogo');

Route::get('/contact', function () {
    return view('MaderAlpes.contact');
})->name('contacto');

// Procesa el mensaje del formulario de contacto.
Route::post('/contact', [ContactController::class, 'send'])->name('contacto.send');

Route::get('/nosotros', function () {
    return view('MaderAlpes.nosotros');
})->name('nosotros');

Route::get('/ubicacion', function () {
    return view('MaderAlpes.ubicacion');
})->name('ubicacion');

Route::middleware('auth')->group(function () {
    Route::get('/productos/index', [ProductoController::class, 'index'])->name('productos.index');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('/categorias/index', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'productos' => Producto::latest()->get(),
        'categorias' => Categoria::orderBy('nombre')->get(),
        'usuarios' => User::latest()->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
