<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Datos en la Base de Datos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="title">Insertar Datos en la Base de Datos</h1>
            <p class="subtitle">Introduce los datos del usuario</p>
        </div>
    </header>

    <main>
        <div class="form-container">
            <form action="insertar2.php" method="post">
                <div class="form-group">
                    <label for="table_name">Nombre de la tabla:</label>
                    <select id="table_name" name="table_name" required>
                        <option value="">Selecciona una tabla</option>
                        <?php
                        // Conexión a la base de datos
                        $servername = "192.168.6.12";
                        $username = "aaf";
                        $password = "12345";
                        $dbname = "db_iaw_aaf";

                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Consulta para obtener los nombres de las tablas
                            $stmt = $conn->query("SHOW TABLES");
                            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                                echo "<option value='$row[0]'>$row[0]</option>";
                            }
                        } catch (PDOException $e) {
                            echo "<option>Error al cargar tablas</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" required>
                </div>

                <div class="form-group">
                    <label for="movil">Móvil:</label>
                    <input type="text" id="movil" name="movil" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Insertar Usuario</button>
                </div>

                <div class="form-group">
                    <button type="reset" class="btn">Restablecer Formulario</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; Realizado por Álvaro Arroyo Fernández</p>
    </footer>
</body>
</html>
