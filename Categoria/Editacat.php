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
require_once '../Conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $coleccion_categorias->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($id)],
        ['$set' => ['nombre' => $nombre, 'descripcion' => $descripcion]]
    );

   // Mostrar mensaje de éxito
echo "<script>
Swal.fire({
    title: '¡Categoria actualizada!',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
}).then(() => {
    window.location.href = 'consultacat.php';
});
</script>";
}


?>
