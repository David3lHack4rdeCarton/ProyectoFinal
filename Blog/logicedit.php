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
date_default_timezone_set('America/Mexico_City');
require_once '../Conexion/conexion.php';

// Obtener el ID del blog a actualizar
$id = $_POST['id'];

// Obtener los nuevos valores del usuario
$titulo = $_POST['titulo'];
$fecha_creacion = date("Y-m-d H:i:s");
$cat = $_POST['categoria'];

// Buscar el blog a actualizar
$filtro = ['_id' => new MongoDB\BSON\ObjectID($id)];
$blog = $coleccion_blogs->findOne($filtro);

// Verificar si el usuario que está intentando editar el blog es el mismo que lo creó o un administrador
if ($_SESSION['usuario']['id'] == $blog['usuario_id'] || $_SESSION['usuario']['rol'] == 'admin') {

    // Actualizar el blog en la base de datos
    $coleccion_blogs->updateOne(
        $filtro,
        ['$set' => [
            'titulo' => $titulo,
            'fecha_creacion' => $fecha_creacion,
            'categoria' => new MongoDB\BSON\ObjectID($cat)
        ]]
    );

    // Mostrar mensaje de éxito
    echo "<script>
        Swal.fire({
            title: '¡Blog actualizado!',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'blog.php';
        });
    </script>";

} else {
    // Mostrar mensaje de error
    echo "<script>
        Swal.fire({
            title: '¡No tienes permiso para editar este blog!',
            icon: 'error',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'blog.php';
        });
    </script>";
}
?>

