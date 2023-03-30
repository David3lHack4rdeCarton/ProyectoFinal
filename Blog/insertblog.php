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
 date_default_timezone_set('America/Mexico_City');
session_start();
require_once '../Conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['Título'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $categoria = $_POST['Categoría'];
    $usuario_id = new MongoDB\BSON\ObjectID($_SESSION['usuario']['id']);

    $fecha_creacion = date("Y-m-d H:i:s");
    // Crear el documento de blog
    $documento_blog = [
      "titulo" => $titulo,
      "fecha_creacion" => $fecha_creacion,
      "categoria" => new MongoDB\BSON\ObjectID($categoria),
      "usuario_id" => $usuario_id // Agregar esta línea
    ];

    // Insertar el nuevo documento en la colección de blogs
    $resultado = $coleccion_blogs->insertOne($documento_blog);

    // Redireccionar al usuario a la página principal de blogs
    echo "<script>
    Swal.fire({
        title: '¡Blog creado!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'blog.php';
    });
  </script>";
}
?>
