<?php
// Configuración de la base de datos
$host = "192.168.6.12"; // Dirección del servidor
$dbname = "db_iaw_aaf"; // Nombre de la base de datos
$user = "aaf"; // Usuario de la base de datos
$password = "12345"; // Contraseña del usuario

try {
    // Conectar a la base de datos mediante PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar que los datos fueron enviados correctamente
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["table_name"], $_POST["record_id"], $_POST["fields"])) {
        $table_name = htmlspecialchars(trim($_POST["table_name"]));
        $record_id = intval($_POST["record_id"]);
        $fields = $_POST["fields"];

        // Construir la consulta de actualización dinámica
        $set_clause = "";
        $params = [];

        foreach ($fields as $column => $value) {
            $set_clause .= "$column = :$column, ";
            $params[$column] = htmlspecialchars(trim($value));
        }

        // Eliminar la última coma
        $set_clause = rtrim($set_clause, ", ");

        // Preparar y ejecutar la consulta SQL
        $sql = "UPDATE $table_name SET $set_clause WHERE id = :id";
        $params['id'] = $record_id;

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute($params)) {
            echo "<p>El registro con ID $record_id en la tabla '$table_name' fue actualizado correctamente.</p>";
        } else {
            echo "<p>Error al actualizar el registro. Verifica los datos e intenta nuevamente.</p>";
        }
    } else {
        echo "<p>Datos inválidos. Por favor, vuelve al formulario anterior.</p>";
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
    <title>Modificar Registro</title>
    <link rel="stylesheet" href="style.css"> <!-- Estilos CSS -->
</head>
<body>
    <footer>
        <a href="index.php">Volver a la página principal</a>
    </footer>
</body>
</html>