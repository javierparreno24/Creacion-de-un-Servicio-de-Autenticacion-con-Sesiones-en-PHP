# 🔒 Sistema Básico de Autenticación con Sesiones en PHP

Este es un proyecto de ejemplo minimalista que implementa un **sistema de autenticación (Login/Logout)** utilizando sesiones de PHP. Demuestra cómo proteger una página (zona privada) y cómo gestionar el estado de un usuario a lo largo de múltiples peticiones HTTP.

## 🌟 Características Principales

* **Autenticación Basada en Sesiones:** Utiliza `$_SESSION` para "recordar" al usuario después de un login exitoso.
* **Zona Privada Protegida:** La página `bienvenida.php` solo es accesible si existe una sesión válida.
* **Redirecciones Seguras:** Implementación de redirecciones (`header('Location: ...')`) para el control de acceso.
* **Logout Sencillo:** Un script dedicado (`logout.php`) para destruir la sesión y cerrar la sesión del usuario.
* **Gestión de Permisos:** Pantalla de "Acceso Denegado" (`permisos.php`) si se intenta acceder a la zona protegida sin sesión.
* **Diseño Sencillo:** Interfaz de usuario básica y responsiva gracias a **Tailwind CSS**.

## 🚀 Estructura del Proyecto

El proyecto se compone de los siguientes archivos clave:

| Archivo | Descripción |
| :--- | :--- |
| `login.php` | **Punto de Entrada.** Contiene el formulario de login, gestiona la validación de credenciales (POST) y crea la sesión `$_SESSION['username']`. |
| `bienvenida.php` | **Zona Protegida.** Verifica la existencia de `$_SESSION['username']`. Muestra el nombre del usuario y la hora actual del servidor. |
| `logout.php` | **Cierre de Sesión.** Destruye la sesión actual (`session_destroy()`) y redirige al usuario a `login.php`. |
| `permisos.php` | **Acceso Denegado.** Página a la que se redirige si el usuario intenta acceder a `bienvenida.php` sin estar logueado. |
| `usuarios.php` | **Datos de Usuarios.** Un array PHP (`$usuarios`) que simula una base de datos de credenciales para la autenticación. |

## 🛠️ Requisitos

Para ejecutar este proyecto, necesitas un entorno de servidor web que soporte PHP.

* **PHP** (Versión 7.0 o superior recomendada).
* **Servidor Web** (Apache, Nginx, o usar el servidor de desarrollo integrado de PHP).

## 💡 Usuarios de Prueba

Las credenciales para probar el sistema están definidas en `usuarios.php`.

| Nombre de Usuario | Contraseña |
| :--- | :--- |
| **admin** | 1234 |
| **usuario** | abcd |
| **cbasulto** | pass2024 |

## ⚙️ Guía de Uso Rápido

### 1. Iniciar Sesión

1.  Accede a la página de login: `http://[TU_SERVIDOR]/login.php`
2.  Introduce credenciales válidas (ej: `admin` y `1234`).
3.  Si las credenciales son correctas, serás redirigido a `bienvenida.php`.
4.  Si son incorrectas, `login.php` mostrará un mensaje de error.

### 2. Acceder a la Zona Protegida

* Si intentas acceder a `http://[TU_SERVIDOR]/bienvenida.php` sin haber iniciado sesión, serás automáticamente redirigido a `permisos.php`.

### 3. Cerrar Sesión

* Haz clic en el botón **"Cerrar Sesión"** en la página `bienvenida.php`. Esto ejecuta `logout.php`, destruyendo tu sesión y enviándote de vuelta a `login.php`.

## 💻 Detalles de Implementación (Análisis de Código)

### `login.php`

1.  **Inicio de Sesión:** `session_start();` debe ir primero.
2.  **Control de Sesión Existente:** Si `$_SESSION['username']` ya existe, se redirige inmediatamente a `bienvenida.php` para evitar un re-login innecesario.
    ```php
    if (isset($_SESSION['username'])) {
        header('Location: bienvenida.php');
        exit;
    }
    ```
3.  **Validación:** Se comprueba el envío del formulario (`$_SERVER['REQUEST_METHOD'] === 'POST'`).
4.  **Autenticación:** La validación se realiza comparando los datos del POST con el array `$usuarios`.
    ```php
    if (isset($usuarios[$username]) && $usuarios[$username] === $password) {
        // ...
        $_SESSION['username'] = $username; // CLAVE para la autenticación
        header('Location: bienvenida.php');
        // ...
    }
    ```

### `bienvenida.php`

1.  **Protección de Acceso:** Esta es la barrera de seguridad.
    ```php
    if (!isset($_SESSION['username'])) {
        header('Location: permisos.php');
        exit;
    }
    ```
2.  **Personalización:** El nombre del usuario se extrae de `$_SESSION['username']` y se muestra, utilizando `htmlspecialchars()` para prevenir XSS.

### `logout.php`

1.  **Destrucción de la Sesión:**
    ```php
    session_start();
    session_destroy(); // Elimina todos los datos de sesión.
    header('Location: login.php'); // Redirige al inicio.
    ```
