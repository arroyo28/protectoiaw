<?php
session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: login-1.php'); // Redirige si no está autenticado
    exit;
}
// Configuración de la base de datos
$host = "192.168.6.12"; 
$dbname = "db_iaw_aaf"; 
$user = "aaf"; 
$password = "12345";

try {
    // Conectar a la base de datos mediante PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consultar todas las tablas disponibles en la base de datos
    $query = $pdo->query("SHOW TABLES");
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Tabla para Eliminar Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Seleccionar la tabla</h1>
    <form method="POST" action="borrar2.php">
        <label for="table_name">Seleccione la tabla:</label>
        <select name="table_name" id="table_name" required>
            <option value="">Seleccione una tabla</option>
            <?php
            // Generar las opciones del desplegable con las tablas de la base de datos
            foreach ($tables as $table) {
                echo "<option value=\"$table\">$table</option>";
            }
            ?>
        </select>
        <button type="submit">Continuar</button>
    </form>
</body>
</html>
