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
date_default_timezone_set('America/Mexico_City');
if(!isset($_SESSION['usuario'])){
  header("location: ../index.php");
  exit();
}

require_once '../Conexion/conexion.php';

if (isset($_POST['id_entrada']) && isset($_POST['comentario'])) {
  $fecha_creacion = $_POST['fecha_creacion'];
  $id_entrada = $_POST['id_entrada'];
  $comentario = $_POST['comentario'];
  $usuario_id = new MongoDB\BSON\ObjectID($_SESSION['usuario']['id']);

  $fecha_creacion = date("Y-m-d H:i:s");

  $coleccion_comentarios->insertOne([
    'Entrada' => new MongoDB\BSON\ObjectID($id_entrada),
    'Comentario' => $comentario,
    'fecha_creacion' => $fecha_creacion,
    'usuario_id' => new MongoDB\BSON\ObjectID($usuario_id)
  ]);

  echo "<script>
    Swal.fire({
        title: '¡Comentario agregado!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.history.back();
    });
  </script>";
} else {
  echo "<script>
    Swal.fire({
        title: '¡Error al agregar comentario!',
        icon: 'error',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.history.back();
    });
  </script>";
}
?>