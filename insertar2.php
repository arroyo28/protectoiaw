<?php
session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: login-1.php'); // Redirige si no está autenticado
    exit;
}
$servername = "192.168.6.12";
$username = "aaf";
$password = "12345";
$dbname = "db_iaw_aaf";  

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error de PDO para que lance excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir los datos del formulario
        $table_name = htmlspecialchars(trim($_POST['table_name']));
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $apellidos = htmlspecialchars(trim($_POST['apellidos']));
        $movil = htmlspecialchars(trim($_POST['movil']));

        // Verificar si el nombre de la tabla es válido
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $table_name)) {
            echo "El nombre de la tabla contiene caracteres no permitidos.";
        } else {
            // Preparar la consulta SQL
            $sql = "INSERT INTO $table_name (Nombre, Apellidos, movil) VALUES (:nombre, :apellidos, :movil)";

            // Preparar la sentencia
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros con los valores del formulario
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':movil', $movil);

            // Ejecutar la consulta
            $stmt->execute();

            echo "Nuevo registro creado con éxito en la tabla '$table_name'.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
<a href="index.php">Volver a Inicio</a>
