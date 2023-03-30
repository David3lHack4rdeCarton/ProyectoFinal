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
    // Obtener los datos del formulario
    $titulo = $_POST['Titulo'];
    $imagen = $_FILES['Imagen'];
    $id_blog = $_POST['blog'];

    // Obtener el contenido del archivo cargado
    $imagen_contenido = file_get_contents($_FILES['Imagen']['tmp_name']);

    // Insertar el documento en la colección
    $coleccion_imagen->insertOne([
        'titulo' => $titulo,
        'imagen' => new MongoDB\BSON\Binary($imagen_contenido, MongoDB\BSON\Binary::TYPE_GENERIC),
        'id_blog' => new MongoDB\BSON\ObjectID($id_blog)
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
