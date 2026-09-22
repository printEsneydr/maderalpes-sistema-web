# Proyecto MaderAlpes

## Descripción

**MaderAlpes** es una aplicación web para el negocio de distribución de tableros, herrajes y soluciones para mobiliario en Pasto, Ipiales y Túquerres (Nariño, Colombia). El proyecto combina una **página pública** que presenta la empresa y su catálogo con un **panel de administración** donde el dueño puede gestionar los productos, las categorías y los usuarios registrados.

El objetivo del proyecto es mostrar los productos del negocio ante sus clientes y permitir al administrador publicar nuevos productos con foto desde un sitio sencillo y seguro.

## Funcionalidades

### Página pública
- Portada con carrusel, presentación de la empresa, servicios, equipo y testimonios.
- Catálogo de productos que se publica automáticamente con lo que agrega el administrador.
- Página "Nosotros" con misión, visión y proceso de trabajo.
- Página "Ubicación" con mapa, horarios y sucursales.
- Formulario de contacto funcional que confirma el envío del mensaje.
- Enlaces de redes sociales y datos de contacto en el pie de página.

### Panel de administración (requiere iniciar sesión)
- **Productos:** agregar, ver, editar y eliminar productos con opción de subir una imagen.
- **Categorías:** crear, editar y eliminar categorías; se muestra cuántos productos tiene cada una.
- **Usuarios:** crear nuevos usuarios y eliminar los que no sean la sesión actual.
- **Panel de control:** resumen con datos reales de la base de datos (productos, categorías, usuarios).

## Tecnologías utilizadas

- **Laravel 12** (framework de PHP)
- **Blade** (plantillas de vistas)
- **Bootstrap 5** y **Bootstrap 4** (diseño visual)
- **Tailwind CSS** (diseño de las páginas de ingreso y registro)
- **SQLite** (base de datos local, sin configuración previa)
- **Vite** (compilación de estilos)
- **jQuery** y **DataTables** (tablas con búsqueda y ordenamiento)
- **Font Awesome** e íconos de Bootstrap

## Estructura del proyecto

```
app/
├── Http/Controllers/
│   ├── CategoriaController.php   → crea, actualiza y elimina categorías
│   ├── ContactController.php     → recibe el mensaje del formulario de contacto
│   ├── ProductoController.php    → gestiona los productos y sus imágenes
│   ├── ProfileController.php     → perfil del administrador (Breeze)
│   └── UsuarioController.php     → crea y elimina usuarios
├── Models/
│   ├── Categoria.php
│   ├── Producto.php
│   └── User.php
database/
├── migrations/                   → estructura de las tablas
└── seeders/DatabaseSeeder.php    → datos de ejemplo (admin, categorías, productos)
resources/views/
├── MaderAlpes/                   → vistas de la página pública
│   ├── index.blade.php           → portada
│   ├── catalogo.blade.php        → catálogo de productos
│   ├── nosotros.blade.php        → misión y visión
│   ├── ubicacion.blade.php       → mapa y sucursales
│   └── contact.blade.php         → formulario de contacto
├── producto.blade.php            → panel: gestión de productos
├── categorias.blade.php          → panel: gestión de categorías
├── usuarios.blade.php            → panel: gestión de usuarios
└── dashboard.blade.php           → panel: resumen general
routes/web.php                    → direcciones y acceso a las páginas
```

## Requisitos previos

- **PHP** versión 8.2 o superior
- **Composer** (administrador de dependencias de PHP)
- **Node.js** y **npm** (para los estilos)
- Git (opcional, para clonar el repositorio)

## Instalación y configuración paso a paso

Sigue estas instrucciones en orden para dejar el proyecto funcionando en tu computador.

### 1. Copiar el proyecto y acceder a la carpeta

```
git clone https://github.com/tu-usuario/maderalpes.git
cd maderalpes
```

### 2. Instalar las dependencias de PHP

```
composer install
```

### 3. Crear el archivo de configuración

Copie el archivo de ejemplo y ajuste los datos si es necesario.

```
copy .env.example .env
```

Edite `.env` y verifique que aparezca:
```
APP_NAME="MaderAlpes"
DB_CONNECTION=sqlite
```

### 4. Generar la llave de seguridad de la aplicación

```
php artisan key:generate
```

### 5. Crear la base de datos y cargar los datos de ejemplo

```
type nul > database\database.sqlite
php artisan migrate:fresh --seed
```

### 6. Crear el enlace de la carpeta de imágenes

```
php artisan storage:link
```

### 7. Instalar y compilar los estilos

```
npm install
npm run build
```

### 8. Iniciar el servidor

```
php artisan serve
```

Abra en el navegador: http://127.0.0.1:8000

## Datos de acceso de demostración

Para entrar al panel de administración:

- **Correo:** admin@maderalpes.com
- **Contraseña:** password123

Estos datos los crea el paso de instalación número 5.

## Uso del panel de administración

1. Abra la página pública y haga clic en **Iniciar sesión**.
2. Ingrese el correo y la contraseña de demostración.
3. Desde el menú lateral podrá:
   - **Productos:** crearlos con nombre, categoría, precio, descripción y fotografía. Al guardar, el producto aparece automáticamente en el catálogo público.
   - **Categorías:** organizar los productos por grupos.
   - **Usuarios:** dar acceso al panel a otras personas.
4. Use el botón **Cerrar sesión** cuando termine.

## Estado del proyecto

El proyecto está terminado y listo para demostraciones. Cuenta con pruebas automáticas (25 pruebas) que pasan correctamente.

## Preguntas frecuentes

**¿No se ven las imágenes de los productos?**
Ejecute el paso 6 de instalación: `php artisan storage:link`.

**¿Cómo reinicio los datos de ejemplo?**
Ejecute `php artisan migrate:fresh --seed`. Esto borra la información y vuelve a cargar el administrador, las categorías y los productos de muestra.

**¿Por qué no funciona el botón de contacto?**
El formulario de contacto debe enviarse desde el servidor de Laravel; asegúrese de que `php artisan serve` esté activo.

**¿El proyecto necesita internet?**
Solo para cargar los estilos de Bootstrap, Tailwind, las fuentes y los íconos; la aplicación en sí funciona de forma local.

## Autor

- **Nombre:** Esneyder Jesús Ibarra Rosero
- **Universidad:** Universidad Mariana
- **Correo:** maderalpes@gmail.com

Proyecto desarrollado para la materia de programación web, usando el framework Laravel.