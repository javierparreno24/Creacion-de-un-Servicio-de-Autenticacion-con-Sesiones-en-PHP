<?php
// Comienzo de la gestión de sesiones. Esto debe ir al principio de cualquier archivo que interactúe con $_SESSION.
session_start();

// Carga el array de usuarios predefinidos para la validación.
require_once 'usuarios.php';

// Variable para almacenar el mensaje de error de autenticación.
$error_message = '';

// --- Mecanismo de control de sesión existente ---
// Si el usuario ya está autenticado (existe 'username' en la sesión),
// se redirige directamente a la página de bienvenida para evitar que se loguee dos veces.
if (isset($_SESSION['username'])) {
    // Redirección con header() a la página protegida.
    header('Location: bienvenida.php');
    exit; // Detiene la ejecución del script después de la redirección.
}

// --- Manejo del formulario POST ---
// Verifica si la solicitud al servidor es de tipo POST, indicando un envío de formulario.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // D) Autentificación: Validación de credenciales.
    // 1. Verifica si el nombre de usuario existe como clave en el array $usuarios.
    // 2. Verifica si el valor (contraseña) asociado al nombre de usuario coincide con la contraseña ingresada.
    if (isset($usuarios[$username]) && $usuarios[$username] === $password) {
        // B) Sesiones: Credenciales válidas. Se almacena el nombre de usuario en la sesión.
        // Esto "recuerda" al usuario para futuras peticiones.
        $_SESSION['username'] = $username;
        
        // Redirección exitosa a la página de bienvenida (zona protegida).
        header('Location: bienvenida.php');
        exit; // Detiene la ejecución.
    } else {
        // Credenciales inválidas. Se prepara un mensaje de error para mostrarlo en el formulario.
        $error_message = 'Credenciales inválidas. Por favor, inténtalo de nuevo.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Sistema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-2xl">
        <h1 class="text-3xl font-extrabold text-center text-indigo-700">🔐 Acceso Requerido</h1>
        
        <?php if ($error_message): ?>
            <!-- Muestra el mensaje de error si existe (tras un intento fallido de login) -->
            <div class="p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm" role="alert">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                <input type="text" id="username" name="username" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                       placeholder="Ej: admin">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                       placeholder="Introduce tu contraseña">
            </div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                Iniciar Sesión
            </button>
        </form>
        <div class="text-center text-xs text-gray-500 pt-4 border-t mt-4">
            <p>Usuarios de prueba:</p>
            <ul class="list-disc list-inside mt-1 inline-block text-left">
                <li>admin / 1234</li>
                <li>usuario / abcd</li>
            </ul>
        </div>
    </div>
</body>
</html>