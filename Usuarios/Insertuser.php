
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];

    // Crear el documento de usuario
    $documento_usuario = [
      "nombre" => $nombre,
      "usuario" => $usuario,
      "contraseña" => $contraseña,
      "rol" => new MongoDB\BSON\ObjectID($rol)
  ];

    // Insertar el nuevo documento en la colección de usuarios
    $resultado = $coleccion_usuarios->insertOne($documento_usuario);

    if($resultado->getInsertedCount() === 1) {
        // Si se insertó correctamente, redirigir a la página de inicio
        echo "<script>
        Swal.fire({
          title: '¡Usuario creado!',
          text: 'El usuario ha sido creado exitosamente',
          icon: 'success',
          confirmButtonText: 'Ok',
          willClose: () => {
            window.location.href = 'Consultuser.php'; // Redirigir a la página de usuarios
          }
        });
      </script>";
        exit;
    } else {
        // Si hubo un error, mostrar un mensaje
        $error = "Hubo un error al insertar el usuario";
    }
}

?>

