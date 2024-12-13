<?php
// Configuración de la base de datos
$host = "192.168.6.12"; 
$dbname = "db_iaw_aaf"; 
$user = "aaf"; 
$password = "12345";

try {
    // Conectar a la base de datos mediante PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar que los datos necesarios fueron enviados desde seleccionar_registro.php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["table_name"], $_POST["record_id"])) {
        $table_name = htmlspecialchars(trim($_POST["table_name"]));
        $record_id = intval($_POST["record_id"]);

        // Ejecutar la consulta para eliminar el registro
        $sql = "DELETE FROM $table_name WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $record_id]);

        echo "<p>El registro con ID $record_id de la tabla '$table_name' ha sido eliminado correctamente.</p>";
    } else {
        echo "<p>Error al intentar eliminar el registro. Vuelve al formulario anterior.</p>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Eliminación</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <footer>
        <a href="index.php">Volver a la página principal</a>
    </footer>
</body>
</html>
