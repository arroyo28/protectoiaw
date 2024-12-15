<?php
session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: login-1.php'); // Redirige si no está autenticado
    exit;
}
// Configuración de la base de datos
$servername = "192.168.6.12"; // O la IP de tu servidor
$username = "aaf"; // Tu nombre de usuario
$password = "12345"; // Tu contraseña
$dbname = "db_iaw_aaf"; // El nombre de tu base de datos

try {
    // Crear una conexión a la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificamos si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Obtenemos el nombre de la tabla desde el formulario
        $table_name = htmlspecialchars($_POST["table_name"]);

        if (!empty($table_name)) {
            // Preparamos la consulta SQL para obtener los registros de la tabla
            $stmt = $conn->prepare("SELECT * FROM $table_name");
            $stmt->execute();

            // Obtener todos los registros de la tabla
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Comprobamos si existen registros
            if (count($records) > 0) {
                echo "<table border='1'>
                        <thead>
                            <tr>";
                // Imprimir los encabezados de las columnas
                foreach (array_keys($records[0]) as $column_name) {
                    echo "<th>$column_name</th>";
                }
                echo "</tr>
                    </thead>
                    <tbody>";

                // Mostrar los registros
                foreach ($records as $row) {
                    echo "<tr>";
                    foreach ($row as $column_value) {
                        echo "<td>$column_value</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No se encontraron registros en la tabla '$table_name'.</p>";
            }
        } else {
            echo "<p>Por favor, ingresa un nombre de tabla.</p>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<a href="index.php">Volver al inicio</a>
