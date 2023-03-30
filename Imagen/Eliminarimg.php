<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
session_start();

// Conexión a la base de datos
require_once '../Conexion/conexion.php';

// Obtener el ID del usuario a eliminar
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectID($_GET['id']);
    $filtro = ['_id' => $id];

// Buscar el documento de la imagen a eliminar
$imagen = $coleccion_imagen->findOne($filtro);

// Verificar si el usuario actual es el propietario de la imagen o es un administrador
if ($_SESSION['usuario']['id'] == $imagen['usuario_id'] || $_SESSION['usuario']['rol'] == 'admin') {
    // Eliminar la imagen
    $resultado = $coleccion_imagen->deleteOne($filtro);
    // Mostrar una confirmación al usuario
    echo "<script>
        Swal.fire({
            title: '¡Imagen eliminada!',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'selectimg.php';
        });
    </script>";

} else { // Si el usuario no tiene permisos para eliminar la imagen
    // Mostrar un mensaje de error al usuario
    echo "<script>
        Swal.fire({
            title: '¡Error!',
            text: 'No tienes permisos para eliminar esta imagen',
            icon: 'error',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'selectimg.php';
        });
    </script>";
}
}
?>

