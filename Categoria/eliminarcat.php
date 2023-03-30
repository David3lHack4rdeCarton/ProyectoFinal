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
// Conexión a la base de datos
require_once '../Conexion/conexion.php';

// Obtener el ID del usuario a eliminar
$id = $_GET['id'];

// Eliminar el usuario
$coleccion_categorias->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

// Mostrar una confirmación al usuario
echo "<script>
    Swal.fire({
        title: '¡Categoria eliminada!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'consultacat.php';
    });
</script>";

// Redireccionar al usuario a la página de consulta de usuarios


?>

