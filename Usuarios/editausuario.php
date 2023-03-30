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

// Obtener el ID del usuario a actualizar
$id = $_POST['id'];

// Obtener los nuevos valores del usuario
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$rol = $_POST['rol'];

// Actualizar el usuario en la base de datos
$coleccion_usuarios->updateOne(
    ['_id' => new MongoDB\BSON\ObjectID($id)],
    ['$set' => [
        'nombre' => $nombre,
        'usuario' => $usuario,
        'contraseña' => $contraseña,
        'rol' => new MongoDB\BSON\ObjectID($rol)
    ]]
);

// Mostrar mensaje de éxito
echo "<script>
    Swal.fire({
        title: '¡Usuario actualizado!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'consultuser.php';
    });
</script>";
?>

