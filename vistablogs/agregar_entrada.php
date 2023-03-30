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
    // Obtenemos los datos del formulario
    $entrada = $_POST['entrada'];
    $blogs = $_POST['id_carta'];
    $usuario_id = new MongoDB\BSON\ObjectID($_SESSION['usuario']['id']);

    // Creamos el documento a insertar
    $documento = array(
        'entrada' => $entrada,
        'id_blog' => new MongoDB\BSON\ObjectId($blogs),
        "usuario_id" => $usuario_id // Agregar esta línea

    );
    
    // Insertamos el documento en la colección de Entrada
    $resultado = $coleccion_entrada->insertOne($documento);
    if($resultado->getInsertedCount() === 1) {
        // Si se insertó correctamente, redirigir a la página del blog
        $url = 'vermas.php?id=' . $blogs;
        echo "<script>
            Swal.fire({
                title: '¡Entrada Creada!',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '$url';
            });
        </script>";
        exit;
    } else {
        // Si hubo un error, mostrar un mensaje
        $error = "Hubo un error al insertar la entrada";
    }
    
}

?>
