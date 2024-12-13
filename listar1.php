<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Registros</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <header>
        <h1>Ver Registros de la Base de Datos</h1>
    </header>

    <main>
        <form method="POST" action="listar2.php">
            <div class="form-group">
                <label for="table_name">Nombre de la tabla:</label>
                <input type="text" id="table_name" name="table_name" required>
            </div>

            <button type="submit">Listar Registros</button>
        </form>

    </main>

    <footer>
        <p>&copy; Realizado por Álvaro Arroyo Fernández</p>
    </footer>
</body>
</html>
