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

    // Validar datos recibidos
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['paciente_id'], $_POST['motivo'])) {
        $paciente_id = intval($_POST['paciente_id']);
        $motivo = htmlspecialchars(trim($_POST['motivo']));

        // Insertar la visita en la tabla
        $sql = "INSERT INTO visitas (paciente_id, motivo) VALUES (:paciente_id, :motivo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':paciente_id' => $paciente_id,
            ':motivo' => $motivo
        ]);

        echo "Visita registrada correctamente.";
    } else {
        echo "Datos inválidos. Por favor, complete el formulario.";
    }
} catch (PDOException $e) {
    die("Error al registrar la visita: " . $e->getMessage());
}
?>
