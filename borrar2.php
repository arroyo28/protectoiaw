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
// Configuración de la base de datos
$host = "192.168.6.12"; 
$dbname = "db_iaw_aaf"; 
$user = "aaf"; 
$password = "12345";

try {
    // Conectar a la base de datos mediante PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar que el nombre de la tabla fue enviado desde seleccionar_tabla.php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["table_name"])) {
        $table_name = htmlspecialchars(trim($_POST["table_name"]));

        // Consultar todos los registros de la tabla seleccionada
        $records_query = $pdo->query("SELECT id FROM $table_name");
        $records = $records_query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        die("No se recibió el nombre de la tabla. Vuelve al paso anterior.");
    }
} catch (PDOException $e) {
    die("Error de conexión o consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Registro a Eliminar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Seleccionar el registro a eliminar</h1>
    <form method="POST" action="borrar3.php">
        <label for="record_id">Seleccione el registro a eliminar:</label>
        <select name="record_id" id="record_id" required>
            <option value="">Seleccione un registro</option>
            <?php foreach ($records as $record): ?>
                <option value="<?php echo $record['id']; ?>">ID: <?php echo $record['id']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="table_name" value="<?php echo htmlspecialchars($table_name); ?>">
        <button type="submit">Eliminar Registro</button>
    </form>
</body>
</html>
