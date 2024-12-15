<?php
session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: login-1.php'); // Redirige si no está autenticado
    exit;
}
?>


<?php include 'cabecera.php'; ?>

<main>
    <h1>Registrar Visita</h1>

    <form action="guardar_visita.php" method="post">
        <label for="paciente_id">ID del Paciente:</label>
        <input type="number" id="paciente_id" name="paciente_id" required>

        <label for="motivo">Motivo de la visita:</label>
        <input type="text" id="motivo" name="motivo" required>

        <button type="submit">Registrar Visita</button>
    </form>
</main>

<?php include 'pie.php'; ?>
