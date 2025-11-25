<?php
// Inicia la sesión. Es crucial para acceder y mantener el estado del usuario.
session_start();

if (!isset($_SESSION['username'])) {
    // Redirige al usuario a la página de "No Tienes Permisos" (CEV e).
    header('Location: permisos.php');
    exit; // Detiene la ejecución del script por seguridad.
}

// Recoge el nombre de usuario de la sesión y lo sanea para evitar ataques XSS.
$username = htmlspecialchars($_SESSION['username']);

// Obtiene la hora actual del servidor, cumpliendo con el requisito del Anexo.
$current_time = date('H:i:s, d/m/Y'); 

// Define el mensaje de bienvenida personalizado.
$welcome_message = "Has accedido como un usuario verificado. ¡Bienvenido al sistema!";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido, <?= $username ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-indigo-50 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-lg p-8 space-y-6 bg-white rounded-xl shadow-2xl border-t-4 border-indigo-500">
        <header class="text-center">
            <h1 class="text-4xl font-extrabold text-indigo-700">👋 ¡Hola, <?= $username ?>!</h1>
            <p class="text-xl text-gray-600 mt-2">Página Protegida</p>
        </header>

        <section class="space-y-4 p-5 bg-indigo-100 rounded-lg border border-indigo-300">
            <div class="flex items-center space-x-3">
                <span class="text-indigo-600 text-2xl">👤</span>
                <p class="text-lg font-semibold text-gray-800">Usuario autenticado: <span class="text-indigo-700 font-bold"><?= $username ?></span></p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-indigo-600 text-2xl">🕒</span>
                <p class="text-lg font-semibold text-gray-800">Hora actual del servidor: <span class="text-indigo-700 font-bold"><?= $current_time ?></span></p>
            </div>
            <div class="p-3 bg-white rounded-md shadow-inner text-gray-700">
                <p class="text-md italic">Mensaje Adicional: "<?= $welcome_message ?>"</p>
            </div>
        </section>

        <footer class="text-center pt-4 border-t">
            <!-- Enlace para cerrar sesión que llama a logout.php -->
            <a href="logout.php" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                <span class="mr-2">🚪</span> Cerrar Sesión
            </a>
        </footer>
    </div>
</body>
</html>