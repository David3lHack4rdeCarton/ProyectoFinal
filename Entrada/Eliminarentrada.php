<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
  
    // Buscar el blog que se va a eliminar
    $entrada = $coleccion_entrada->findOne($filtro);

if ($_SESSION['usuario']['id'] == $entrada['usuario_id'] || $_SESSION['usuario']['rol'] == 'admin') {

    $resultado = $coleccion_entrada->deleteOne($filtro);

    if ($resultado->getDeletedCount() > 0) {

echo "<script>
    Swal.fire({
        title: '¡Entrada eliminada!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.history.back();    });
</script>";
} else {
    echo "<script>
    Swal.fire({
        title: '¡Error al eliminar la entrada!',
        icon: 'error',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.history.back();
    });
</script>";
}

} else {
    echo "<script>
    Swal.fire({
        title: '¡No tienes permiso para eliminar esta entrada!',
        icon: 'error',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.history.back();
    });
</script>";
}
}
?>

