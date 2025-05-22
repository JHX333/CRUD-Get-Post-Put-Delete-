<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    $conexion->query("INSERT INTO usuarios (nombre, correo) VALUES ('$nombre', '$correo')");
    header("Location: index.php");
}
?>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="correo" placeholder="Correo" required>
    <input type="submit" value="Agregar">
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    <?php
    $resultado = $conexion->query("SELECT * FROM usuarios");
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['correo']}</td>
                <td><a href='editar.php?id={$fila['id']}'>Editar</a> | <a href='eliminar.php?id={$fila['id']}'>Eliminar</a></td>
              </tr>";
    }
    ?>
</table>