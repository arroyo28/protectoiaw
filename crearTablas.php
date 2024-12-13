<?php
// Configuración de la conexión a la base de datos
$host = "192.168.6.12"; // IP del servidor
$dbname = "db_iaw_aaf"; // Nombre de la base de datos
$user = "aaf"; // Usuario
$password = "12345"; // Contraseña

// Conectar a la base de datos usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table_name = htmlspecialchars(trim($_POST['table_name']));

    if (!empty($table_name)) {
        // Generar la consulta SQL para crear la tabla con las columnas id, Nombre, Apellidos y movil
        $sql = "CREATE TABLE $table_name (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    Nombre VARCHAR(50) NOT NULL,
                    Apellidos VARCHAR(50) NOT NULL,
                    movil VARCHAR(10) NOT NULL
                );";

        try {
            // Ejecutar la consulta
            $pdo->exec($sql);
            echo "<p>La tabla '$table_name' ha sido creada exitosamente con las columnas: id, Nombre, Apellidos y movil.</p>";
        } catch (PDOException $e) {
            echo "<p>Error al crear la tabla: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Por favor, ingrese un nombre para la tabla.</p>";
    }
}
?>
<a href="index.php">Volver al inicio</a>