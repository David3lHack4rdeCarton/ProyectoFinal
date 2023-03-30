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
    $usuario = $_POST['Usuario'];
    $contraseña = $_POST['Contraseña'];

    // Verificar si el nombre de usuario ya existe
    $existe_usuario = $coleccion_usuarios->findOne(['usuario' => $usuario]);
    if ($existe_usuario) {
        echo "<script>
        Swal.fire({
            title: '¡Error!',
            text: 'El usuario ya existe',
            icon: 'error',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = '../index.php';
        });
      </script>";
      exit; // Salir del script para que no se inserte el usuario duplicado
    }
    
    // Buscar el documento del rol "invitado" en la colección de roles
    $rol_invitado = $coleccion_roles->findOne(['nombre' => 'invitado']);
    $id_rol_invitado = $rol_invitado['_id'];

    // Crear el documento de usuario
    $documento_usuario = [
      "nombre" => $nombre,
      "usuario" => $usuario,
      "contraseña" => $contraseña,
      "rol" => $id_rol_invitado
    ];

    // Insertar el nuevo documento en la colección de usuarios
    $resultado = $coleccion_usuarios->insertOne($documento_usuario);
    
    echo "<script>
    Swal.fire({
        title: '¡Usuario Registrado!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = '../index.php';
    });
  </script>";
}