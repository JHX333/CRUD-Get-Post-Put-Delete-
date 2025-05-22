<?php
$conexion = new mysqli("localhost", "root", "", "crud_php");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
