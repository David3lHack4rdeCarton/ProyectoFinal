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
    <link rel="stylesheet" type="text/css" href="#">
    <title>InfoCrud</title>
</head>
<body>

<?php include '../navbar.php'; ?>  
<button class="btn btn-secondary" onclick="history.back()">Volver</button>

<?php
require_once '../Conexion/conexion.php';
if (isset($_GET['id'])) {
    // Obtener el ID de la carta enviado
    $id_entrada = $_GET['id'];

  // Obtener todas las entradas correspondientes al id del blog
$entra = $coleccion_entrada->find(['_id' => new MongoDB\BSON\ObjectID($id_entrada)]);
foreach ($entra as $texto) {
    $entrada_texto = $texto->entrada;
    $entrada_u = $texto->usuario_id; 
    $usuario = $coleccion_usuarios->findOne(['_id' => $entrada_u]);
    $entrada_user = $usuario->usuario;
    $id_entrada = $texto->_id;
    ?>
    
    <div class="container">
  <div class="card shadow-lg">
    <div class="card-body">
      <h1 class="card-title text-center"><?php echo $entrada_user; ?></h1>
      <p class="card-text lead text-center"><?php echo $entrada_texto; ?></p>
      <div class="row">
    </div>
  </div>
</div>
  <?php
    }
?>

<?php
        $comentarios = $coleccion_comentarios->find(['Entrada' => new MongoDB\BSON\ObjectID($id_entrada)]);
       
 
        foreach ($comentarios as $coment) {
            $coment_comentario = $coment->Comentario;
            $coment_fecha = $coment->fecha_creacion;

            $coment_u = $coment->usuario_id; 
            $usuario = $coleccion_usuarios->findOne(['_id' => $coment_u]);
            $coment_user = $usuario->usuario;
            

?>
<div class="card">
  <div class="card-header">
    Comentario
  </div>
  <div class="card-body">
    <h5 class="card-title">
      <span class="font-weight-bold"><?php echo $coment_user; ?></span>
      <small class="text-muted ml-2"><?php echo $coment_fecha; ?></small>
    </h5>
    <p class="card-text"><?php echo $coment_comentario; ?></p>   
  </div>
</div>

<?php
    }
?>

<?php
}
?>



</body>
</html>