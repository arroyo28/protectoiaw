<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado, si no lo está, redirigirlo al login
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: login-1.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de pacientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="title">Gestión de Pacientes</h1>
            <p class="subtitle">Seleccione una opción a gestionar sobre un paciente</p>
        </div>
    </header>

    <main>
        <div class="button-container">
            <div class="button-box">
                <form action="crearTablas.html" method="get">
                    <button type="submit" class="btn">Crear Tabla</button>
                </form>
            </div>

            <div class="button-box">
                <form action="insertar1.php" method="get">
                    <button type="submit" class="btn">Insertar Datos</button>
                </form>
            </div>
            
             <div class="button-box">
                <form action="registrar_visita.php" method="get">
                    <button type="submit" class="btn">Registrar visita</button>
                </form>
            </div>

            <div class="button-box">
                <form action="listar1.php" method="get">
                    <button type="submit" class="btn">Listar registros</button>
                </form>
            </div>

            <div class="button-box">
                <form action="modificar1.php" method="get">
                    <button type="submit" class="btn">Modificar</button>
                </form>
            </div>

            <div class="button-box">
                <form action="borrar1.php" method="get">
                    <button type="submit" class="btn">Borrar registro</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; Realizado por Álvaro Arroyo Fernández</p>
    </footer>
</body>
</html>
