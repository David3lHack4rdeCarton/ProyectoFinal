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
require_once '../Conexion/conexion.php';

// Obtener el ID del blog a actualizar
$id = $_POST['id'];

// Obtener los nuevos valores del usuario
$entrada = $_POST['Entrada'];
$nombre_blog = $_POST['blog'];


// Buscar el blog a actualizar
$filtro = ['_id' => new MongoDB\BSON\ObjectID($id)];
$blog = $coleccion_entrada->findOne($filtro);

if ($_SESSION['usuario']['id'] == $blog['usuario_id'] || $_SESSION['usuario']['rol'] == 'admin') {

// Actualizar el blog en la base de datos
$coleccion_entrada->updateOne(
    ['_id' => new MongoDB\BSON\ObjectID($id)],
    ['$set' => [
        'entrada' => $entrada,
        'id_blog' => new MongoDB\BSON\ObjectID($nombre_blog)
    ]]
);


// Mostrar mensaje de éxito
echo "<script>
    Swal.fire({
        title: '¡Entrada actualizada!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'Entrada.php';
    });
</script>";
} else {
    // Mostrar mensaje de error
    echo "<script>
        Swal.fire({
            title: '¡No tienes permiso para editar esta ENTRADA!',
            icon: 'error',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'Entrada.php';
        });
    </script>";
}
?>
