<?php
session_start();

if(!isset($_SESSION['usuario'])){
  header("location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoCrud</title>
</head>
<body>
<?php include '../navbar.php'; ?>  

<?php
require_once '../Conexion/conexion.php';

// Seleccionar una colección
$blog = $coleccion_blogs;

// Recuperar los documentos de la colección y unir con la colección de categorías
$resultado = $blog->aggregate([
    [
        '$lookup' => [
            'from' => 'Categorias',
            'localField' => 'categoria',
            'foreignField' => '_id',
            'as' => 'categoria'
        ]
    ],
    [
        '$unwind' => '$categoria'
    ],
    // Agregar esta etapa para unir con la colección de usuarios
    [
        '$lookup' => [
            'from' => 'usuarios',
            'localField' => 'usuario_id',
            'foreignField' => '_id',
            'as' => 'usuario'
        ]
    ],
    [
        '$unwind' => '$usuario'
    ]
]);

// Mostrar los documentos en una tabla HTML

foreach ($resultado as $documento) {
    $titulo = $documento['titulo'];
    $fecha_creacion = $documento['fecha_creacion'];
    $usuario = $documento['usuario']['usuario'];
    $categoria = $documento['categoria']['nombre'];

    $id_carta = $documento->_id;
?>

<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-body" style="font-size: 16px; line-height: 1.5;">
    <h5 class="card-title"><?php echo $titulo; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $fecha_creacion; ?></h6>
    <h6 class="card-subtitle mb-2 text-muted">Publicado por: <?php echo $usuario; ?></h6>
    <p class="card-text"><?php echo $categoria; ?></p>
    <a href="vermas.php?id=<?php echo $id_carta; ?>" class="btn btn-primary">Ver más</a>

  </div>
</div>



<?php } ?>
</body>
</html>