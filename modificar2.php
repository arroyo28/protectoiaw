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

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["table_name"])) {
        $table_name = htmlspecialchars(trim($_POST["table_name"]));
        
        // Consultar las columnas de la tabla seleccionada
        $columns_query = $pdo->query("DESCRIBE $table_name");
        $columns = $columns_query->fetchAll(PDO::FETCH_COLUMN);

        // Manejar la selección de registro
        $record_id = isset($_POST['record_id']) ? intval($_POST['record_id']) : null;

        // Consultar todos los registros para el desplegable
        $records_query = $pdo->query("SELECT * FROM $table_name");
        $records = $records_query->fetchAll(PDO::FETCH_ASSOC);

        // Consultar el registro seleccionado si se envió
        $selected_record = null;
        if ($record_id !== null) {
            $stmt = $pdo->prepare("SELECT * FROM $table_name WHERE id = :id");
            $stmt->execute(['id' => $record_id]);
            $selected_record = $stmt->fetch(PDO::FETCH_ASSOC);
        }
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
    <title>Modificar Registros</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <header>
        <h1>Modificar Registros en la Tabla: <?php echo htmlspecialchars($table_name); ?></h1>
    </header>

    <main>
        <form method="POST" action="">
            <div class="form-group">
                <label for="record_id">Seleccione el registro a modificar:</label>
                <select name="record_id" id="record_id" required onchange="this.form.submit()">
                    <option value="">Seleccione un registro</option>
                    <?php foreach ($records as $record): ?>
                        <option value="<?php echo $record['id']; ?>" 
                            <?php echo ($record_id == $record['id']) ? 'selected' : ''; ?>>
                            ID: <?php echo $record['id']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <h3>Datos del registro</h3>
            <?php if ($selected_record): ?>
                <?php foreach ($columns as $column): ?>
                    <?php if ($column !== "id"): ?>
                        <div class="form-group">
                            <label for="<?php echo $column; ?>"><?php echo ucfirst($column); ?>:</label>
                            <input type="text" id="<?php echo $column; ?>" name="fields[<?php echo $column; ?>]" 
                                value="<?php echo htmlspecialchars($selected_record[$column] ?? ''); ?>" required>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Selecciona un registro para ver los datos.</p>
            <?php endif; ?>

            <input type="hidden" name="table_name" value="<?php echo htmlspecialchars($table_name); ?>">
            <button type="submit" formaction="modificar3.php">Modificar Registro</button>
        </form>
    </main>

    <footer>
        <p>&copy;Realizado por Álvaro Arroyo Fernández</p>
    </footer>
</body>
</html>
