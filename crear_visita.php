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
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la tabla si no existe
    $sql = "CREATE TABLE IF NOT EXISTS visitas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        paciente_id INT NOT NULL,
        motivo VARCHAR(255) NOT NULL,
        fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE ON UPDATE CASCADE
    )";

    $pdo->exec($sql);
    echo "Tabla 'visitas' creada correctamente.";
} catch (PDOException $e) {
    die("Error al crear la tabla: " . $e->getMessage());
}
?>
