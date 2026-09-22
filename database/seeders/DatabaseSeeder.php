<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Crea los datos de ejemplo del proyecto:
     * un administrador, las categorias principales y algunos productos.
     */
    public function run(): void
    {
        // Usuario administrador para entrar al panel.
        User::create([
            'name' => 'Administrador MaderAlpes',
            'email' => 'admin@maderalpes.com',
            'password' => 'password123',
        ]);

        // Categorias iniciales del catalogo.
        Categoria::create(['nombre' => 'Hogar']);
        Categoria::create(['nombre' => 'Cocina']);
        Categoria::create(['nombre' => 'Baño']);

        // Productos de demostracion que se muestran en el catalogo publico.
        Producto::create([
            'nombre' => 'Mesa Roble',
            'categoria' => 'Cocina',
            'precio' => 1200000,
            'descripcion' => 'Mesa de comedor en madera maciza de roble, ideal para reuniones familiares.',
        ]);

        Producto::create([
            'nombre' => 'Closet Flotante',
            'categoria' => 'Hogar',
            'precio' => 850000,
            'descripcion' => 'Closet empotrado con acabados finos, que aprovecha el espacio de tu habitación.',
        ]);

        Producto::create([
            'nombre' => 'Puerta Roble',
            'categoria' => 'Cocina',
            'precio' => 450000,
            'descripcion' => 'Puerta interior en madera de roble con acabado elegante y resistente.',
        ]);
    }
}
