<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maderalpes: {
                            black: '#000000',
                            white: '#FFFFFF',
                            gold: '#FFD700',
                            green: '#8DC63F',
                            dark: '#333333'
                        }
                    },
                    backgroundImage: {
                        'forest-mountains': "url('https://img.freepik.com/foto-gratis/renderizado-3d-casa-madera_23-2151264382.jpg')"
                    }
                }
            }
        }
    </script>
    <style>
        .bg-overlay {
            background-color: rgba(0, 0, 0, 0.65);
        }
    </style>
</head>

<body class="font-sans antialiased bg-forest-mountains bg-cover bg-center bg-fixed">
    <div class="min-h-screen flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 bg-overlay">
        <div class="w-full max-w-md">
            

            <!-- Heading -->
            <h2 class="mt-2 text-center text-2xl font-bold tracking-tight text-white">
                Inicia sesión en tu cuenta
            </h2>

            <!-- Form Container -->
            <div class="mt-8 bg-white py-8 px-6 shadow-2xl rounded-lg sm:px-10 border border-maderalpes-green">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-maderalpes-dark">
                            Correo electrónico
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-maderalpes-green focus:border-maderalpes-green sm:text-sm">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-maderalpes-dark">
                            Contraseña
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-maderalpes-green focus:border-maderalpes-green sm:text-sm">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 text-maderalpes-green focus:ring-maderalpes-green border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-maderalpes-dark">
                                Recordarme
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('password.request') }}"
                                class="font-medium text-maderalpes-green hover:text-maderalpes-gold">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    </div>

                    <!-- Sign In Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-md text-sm font-medium text-maderalpes-black bg-maderalpes-gold hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-maderalpes-green">
                            Iniciar sesión
                        </button>
                    </div>
                </form>

                </div>

            <!-- Enlace para registrarse -->
            <div class="mt-6 text-center text-sm text-white">
                ¿No tienes una cuenta?
                <a href="{{ route('register') }}" class="font-medium text-maderalpes-gold hover:text-maderalpes-green">
                    Regístrate
                </a>
            </div>

            <!-- Slogan -->
            <div class="mt-2 text-center text-sm text-maderalpes-gold italic font-semibold">
                Inspírate en lo natural
            </div>
        </div>
    </div>
</body>

</html>
