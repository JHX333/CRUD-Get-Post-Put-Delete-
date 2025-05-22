<?php
include 'conexion.php';
$id = $_GET['id'];
$dato = $conexion->query("SELECT * FROM usuarios WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $conexion->query("UPDATE usuarios SET nombre='$nombre', correo='$correo' WHERE id=$id");
    header("Location: index.php");
}
?>

<form method="POST">
    <input type="text" name="nombre" value="<?= $dato['nombre'] ?>" required>
    <input type="email" name="correo" value="<?= $dato['correo'] ?>" required>
    <input type="submit" value="Actualizar">
</form>