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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['Usuario'];
  $password = $_POST['Contraseña'];

  // Buscar el usuario en la base de datos
  $query = array('usuario' => $username, 'contraseña' => $password);
  $usuario = $coleccion_usuarios->findOne($query);

  if ($usuario) {
    // Obtener el rol del usuario de la colección "Rol"
    $rol_query = array('_id' => new MongoDB\BSON\ObjectID($usuario['rol']));
    $rol = $coleccion_roles->findOne($rol_query);

    // Guardar el nombre de usuario y rol en la sesión
    $_SESSION['usuario'] = array(
      'id' => $usuario['_id'],
      'nombre' => $usuario['usuario'],
      'rol' => $rol['nombre']
    );
    
   
    // Redirigir al usuario a la página de inicio
    echo "<script>
    Swal.fire({
        title: '¡Iniciando sesión !',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = '../Vistaprincipal.php';
    });
    </script>";
    
    exit;
  } else {
    // Si las credenciales son inválidas, mostrar un mensaje de error
    echo "<script>
    Swal.fire({
        title: '¡Error de autenticación!',
        text: 'El usuario o la contraseña son incorrectos.',
        icon: 'error',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = '../index.php';
    });
    </script>";

  }
}
?>
