# Producto 7: Crear CRUD (Get, Post, Put, Delete) en una base de datos
#### Hecho por: Jared S. Avila

 ## Instrucciones
#### •	Investiga y crea CRUD (Get, Post, Put, Delete) en una base de datos

#### ¿Qué es CRUD?
#### CRUD es un acrónimo que representa las cuatro operaciones básicas para la gestión de datos:
#### •	Create (Crear): Añadir nuevos registros.
#### •	Read (Leer): Consultar o visualizar registros existentes.
#### •	Update (Actualizar): Modificar registros existentes.
#### •	Delete (Eliminar): Borrar registros existentes.
#### Estas operaciones son fundamentales en el desarrollo de aplicaciones que interactúan con bases de datos.
####  CRUD en APIs RESTful
#### En el contexto de las APIs RESTful, CRUD se mapea a los métodos HTTP de la siguiente manera:
#### •	POST: Crear un nuevo recurso.
#### •	GET: Leer o recuperar recursos.
#### •	PUT: Actualizar un recurso existente.
#### •	DELETE: Eliminar un recurso. 
#### Por ejemplo, para gestionar una entidad "usuario", las rutas podrían ser:
#### •	POST /usuarios: Crear un nuevo usuario.
#### •	GET /usuarios: Obtener todos los usuarios.
#### •	GET /usuarios/{id}: Obtener un usuario por su ID.
#### •	PUT /usuarios/{id}: Actualizar un usuario existente.
#### •	DELETE /usuarios/{id}: Eliminar un usuario.
#### Estas convenciones aseguran una estructura coherente y predecible en las APIs RESTful.
 
![image](https://github.com/user-attachments/assets/01257625-c1e0-45db-8a0a-bb2fef4d822d)

## Requisitos Previos
#### Antes de comenzar, asegúrate de tener instalados los siguientes programas:
#### •	XAMPP: Un paquete que incluye Apache, MySQL y PHP. Puedes descargarlo desde https://www.apachefriends.org/es/index.html.
#### •	Visual Studio Code (VS Code): Un editor de código fuente. Descárgalo desde https://code.visualstudio.com/.
#### •	Extensiones recomendadas para VS Code:
#### o	PHP Intelephense
#### o	PHP Debug
#### o	PHP DocBlocker
#### o	PHP Namespace ResolverSourceCodester+2Anixelo+2Udemy+2

## Paso 1: Crear la Base de Datos y la Tabla
#### 1.	Abre phpMyAdmin desde el panel de control de XAMPP (http://localhost/phpmyadmin).
#### 2.	Crea una nueva base de datos llamada crud_php.
#### 3.	Dentro de la base de datos, ejecuta la siguiente consulta SQL para crear una tabla llamada usuarios:
![image](https://github.com/user-attachments/assets/35c9f6ff-872b-4640-b3b3-191c9d6a326b)

## Paso 2: Configurar el Proyecto en VS Code
#### 1.	Crea una carpeta llamada crud_php dentro del directorio htdocs de XAMPP (por ejemplo, C:\xampp\htdocs\crud_php).
#### 2.	Abre esta carpeta en Visual Studio Code.
#### 3.	Dentro de la carpeta, crea un archivo llamado conexion.php con el siguiente contenido:
```php
<?php
$conexion = new mysqli("localhost", "root", "", "crud_php");
if ($conexion->connect_error) {
   die("Error de conexión: " . $conexion->connect_error);
}
?>
```
## Paso 3: Crear el Archivo Principal (index.php)
#### 1.	En la misma carpeta, crea un archivo llamado index.php con el siguiente contenido:
```php
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
```
## Paso 4: Crear el Archivo para Editar Registros (editar.php)
#### 1.	Crea un archivo llamado editar.php con el siguiente contenido:
```php
<?php
include 'conexion.php';
$id = $_GET['id'];
$dato = $conexion->query("SELECT * FROM usuarios WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $conexion->query("UPDATE usuarios SET nombre='$nombre', correo='$correo' WHERE         id=$id");
    header("Location: index.php");
}
?>

<form method="POST">
    <input type="text" name="nombre" value="<?= $dato['nombre'] ?>" required>
    <input type="email" name="correo" value="<?= $dato['correo'] ?>" required>
    <input type="submit" value="Actualizar">
</form>
```
## Paso 5: Crear el Archivo para Eliminar Registros (eliminar.php)
#### 1.	Crea un archivo llamado eliminar.php con el siguiente contenido:
```php
<?php
include 'conexion.php';
$id = $_GET['id'];
$conexion->query("DELETE * FROM usuarios WHERE id=$id");
Header(“Location: index.php”);
```
## Paso 6: Ejecutar el Proyecto

#### 1.	Asegúrate de que Apache y MySQL estén en ejecución desde el panel de control de XAMPP.
#### 2.	Abre tu navegador y visita http://localhost/crud_php/index.php.
#### 3.	Deberías ver el formulario para agregar usuarios y una tabla con los registros existentes.
![image](https://github.com/user-attachments/assets/9b5af085-979f-474b-b2f9-801009a8e504)
![image](https://github.com/user-attachments/assets/7df76363-5bf1-43d7-913c-2c72d4ff27bf)
![image](https://github.com/user-attachments/assets/0f99bba9-c166-47ce-a581-2331815d37d3)
![image](https://github.com/user-attachments/assets/c16b5d6a-e1f7-474c-b48d-afc9fd4accab)
## Referencias:
[Infografía](https://www.uptut.com/tutorial/5-http-methods-and-their-crud-operations)

[Tutorial de la semana 7](https://www.youtube.com/playlist?list=PLesmOrW3mp4i2RdfsPI5R6o5EVacGuovz)

[Tutorial](https://www.youtube.com/watch?v=pn2v9lPakHQ)












