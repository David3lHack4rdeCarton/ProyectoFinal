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
    $titulo = $_POST['Titulo'];
    $imagen = $_FILES['Imagen'];
    $id_blog = $_POST['blog'];
    $usuario_id = new MongoDB\BSON\ObjectID($_SESSION['usuario']['id']);

    // Obtener la ruta temporal del archivo cargado
    $imagen_temporal = $_FILES['Imagen']['tmp_name'];

    // Obtener la extensión del archivo cargado
    $extension = pathinfo($_FILES['Imagen']['name'], PATHINFO_EXTENSION);

    // Crear un nombre único para la imagen
    $nombre_imagen = uniqid() . '.' . $extension;

    // Guardar la imagen en la carpeta "img"
    $ruta_imagen = '../img/' . $nombre_imagen;


    move_uploaded_file($imagen_temporal, $ruta_imagen);

    // Insertar el documento en la colección
    $coleccion_imagen->insertOne([
        'titulo' => $titulo,
        'imagen' => $ruta_imagen,
        'id_blog' => new MongoDB\BSON\ObjectID($id_blog),
        "usuario_id" => $usuario_id // Agregar esta línea

    ]);

    // Redireccionar al usuario a la página principal de blogs
    echo "<script>
    Swal.fire({
        title: '¡Imagen subida!',
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

<!-- HTML del formulario -->
