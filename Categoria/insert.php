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

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Obtener los datos del formulario
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];

  // Crear el documento a insertar en la colección de categorías
  $documento = [
    'nombre' => $nombre,
    'descripcion' => $descripcion
  ];

  // Insertar el documento en la colección de categorías
  $resultado = $coleccion_categorias->insertOne($documento);

  // Mostrar una confirmación al usuario
  echo "<script>
    Swal.fire({
        title: '¡Categoría insertada!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'Consultacat.php';
    });
  </script>";
}
?>

