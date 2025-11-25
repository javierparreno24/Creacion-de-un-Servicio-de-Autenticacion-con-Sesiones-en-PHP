<?php
// Inicia la sesión. Aunque no se manipulan variables de sesión aquí.
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Definición de la fuente para la estética general */
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-red-50 flex items-center justify-center min-h-screen p-4">
    <!-- El contenido es estático, diseñado para informar al usuario sin permisos. -->
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-2xl border-t-4 border-red-500 text-center">
        <h1 class="text-4xl font-extrabold text-red-700"> Acceso Denegado</h1>
        <p class="text-lg text-gray-600">Lo sentimos, no puedes acceder a esta sección sin haber iniciado sesión previamente.</p>
        
        <p class="text-md text-gray-500">Esta es la "Pantalla de no tienes permisos".</p>

        <!-- Enlace de redirección al formulario de login (Punto de entrada). -->
        <a href="login.php" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
            Ir a la página de Login
        </a>
    </div>
</body>
</html>