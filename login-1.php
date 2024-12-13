<?php
// Iniciar la sesión
session_start();

// Verificar si ya está logueado
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header('Location: index.php');
    exit;
}

// Configuración del usuario y contraseña
$valid_username = 'aaf';
$valid_password = '12345';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar las credenciales
    if ($username === $valid_username && $password === $valid_password) {
        // Si las credenciales son correctas, establecer la sesión
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $username;

        // Redirigir al menú principal (index.php)
        header('Location: index.php');
        exit;
    } else {
        // Si las credenciales son incorrectas, mostrar un mensaje de error
        $error_message = 'Credenciales incorrectas. Intente nuevamente.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Iniciar sesión</h1>
    </header>

    <main>
        <!-- Mostrar un mensaje de error si las credenciales son incorrectas -->
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <!-- Formulario para iniciar sesión -->
        <form action="login-1.php" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>
    </main>

    <footer>
        <p>&copy; Realizado por Álvaro Arroyo Fernández</p>
    </footer>
</body>
</html>
