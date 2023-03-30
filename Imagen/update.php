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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $id_imagen = $_POST['id'];
    $imagen_nueva = $_FILES['imagen'];

    // Buscar el documento de la imagen en la colección
    $imagen = $coleccion_imagen->findOne(['_id' => new MongoDB\BSON\ObjectID($id_imagen)]);

    // Verificar si el usuario actual es el propietario de la imagen o es un administrador
    if ($imagen['usuario_id'] != $_SESSION['usuario']['id'] && $_SESSION['usuario']['rol'] != 'admin') {
        echo "<script>
        Swal.fire({
            title: '¡Error!',
            text: 'No tienes permiso para editar esta imagen',
            icon: 'error',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'selectimg.php';
        });
      </script>";
      exit;
    }

    if ($imagen_nueva['size'] > 0) {
        // Obtener la ruta temporal del archivo cargado
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
    
        // Obtener la extensión del archivo cargado
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    
        // Crear un nombre único para la imagen
        $nombre_imagen = uniqid() . '.' . $extension;
    
        // Guardar la imagen en la carpeta "img"
        $ruta_imagen = '../img/' . $nombre_imagen;
    
        move_uploaded_file($imagen_temporal, $ruta_imagen);
    
        // Actualizar el documento en la colección
        $coleccion_imagen->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($id_imagen)],
            ['$set' => [
                'titulo' => $titulo,
                'imagen' => $ruta_imagen
            ]]
        );
    } else { // Si no se ha subido una imagen nueva, se actualiza sólo el título
        // Actualizar el documento en la colección
        $coleccion_imagen->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($id_imagen)],
            ['$set' => [
                'titulo' => $titulo
            ]]
        );
    }
    // Redireccionar al usuario a la página de selección de imágenes
    echo "<script>
    Swal.fire({
        title: '¡Imagen actualizada!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'selectimg.php';
    });
  </script>";
    exit();
}

?>
