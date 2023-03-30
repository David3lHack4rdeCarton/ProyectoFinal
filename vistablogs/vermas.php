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
<?php
require_once '../Conexion/conexion.php';

if (isset($_GET['id'])) {
    // Obtener el ID de la carta enviado
    $id_carta = $_GET['id'];

    // Obtener la información de la carta correspondiente de la base de datos
    $carta = $coleccion_blogs->findOne(['_id' => new MongoDB\BSON\ObjectID($id_carta)]);

    if ($carta) {
    // Obtener la información de la categoría correspondiente de la base de datos
    $categoria = $coleccion_categorias->findOne(['_id' => $carta->categoria]);

    // Obtener la información del usuario correspondiente de la base de datos
    $usuario = $coleccion_usuarios->findOne(['_id' => $carta->usuario_id]);

        // Mostrar la información de la carta en una tabla HTML
        $titulo = $carta->titulo;
        $fecha_creacion = $carta->fecha_creacion;
        $nombre_categoria = $categoria->nombre;
        $nombre_usuario = $usuario->usuario;
?>
<br> 
<div class="container">
  <div class="card-header shadow-lg bg-light text-dark">
    <div class="card-body">
      <h1 class="card-title text-center"><?php echo $titulo; ?></h1>
      <p class="card-text text-center"><small class="text-muted"><?php echo $fecha_creacion; ?></small></p>
      <div class="row">
        <div class="col-6 text-start">
          <p class="card-text"><strong>Publicado por:</strong> <?php echo $nombre_usuario; ?></p>
        </div>
        <div class="col-6 text-end">
          <p class="card-text"><strong>Categoría:</strong> <?php echo $nombre_categoria; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Obtener todas las imágenes correspondientes al id del blog -->
<?php
    $imagenes = $coleccion_imagen->find(['id_blog' => new MongoDB\BSON\ObjectID($id_carta)]);
    // Recorrer las imágenes y mostrarlas en una lista horizontal
?>
<br> 
<div class="card-deck">
  
    <?php 
      $contador = 0; // Inicializar el contador
    foreach ($imagenes as $imagen) {
        $imagen_url = $imagen->imagen;
        $imagen_title = $imagen->titulo;
        $imagen_u = $imagen->usuario_id; 
        $usuario = $coleccion_usuarios->findOne(['_id' => $imagen_u]);
        $imagen_user = $usuario->usuario;
    ?>
    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <img src="<?php echo $imagen_url; ?>" class="card-img-top img-fluid mx-auto" alt="Imagen de la publicación" style="max-width: 220px;">
        <div class="card-body" style="font-size: 16px; line-height: 1.5;">
            <h5 class="card-title"><?php echo $imagen_title; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $imagen_user; ?></h6>
        </div> 
    </div>
    <?php
        $contador++; // Incrementar el contador
        if ($contador % 5 == 0) {
            echo '</div><div class="card-deck mt-4">';
        }
    }
    ?>
</div>



<!-- Obtener todas las entradas correspondientes al id del blog -->
<?php
        $entra = $coleccion_entrada->find(['id_blog' => new MongoDB\BSON\ObjectID($id_carta)]);
       
 
        foreach ($entra as $texto) {
            $entrada_texto = $texto->entrada;
            $entrada_u = $texto->usuario_id; 
            $usuario = $coleccion_usuarios->findOne(['_id' => $entrada_u]);
            $entrada_user = $usuario->usuario;
            $id_entrada =$texto ->_id;
?>
<div class="card-header bg-light text-dark">
  <div class="card-header bg-dark text-white">
Entrada  </div>
  <div class="card-body">
  <h5 class="card-title"> <?php echo $entrada_user; ?></h5>
    <p class="card-text">   <?php echo $entrada_texto; ?></p>
    <a href="comentarioentrada.php?id=<?php echo $id_entrada; ?>" class="btn btn-primary">Comentarios</a>
    <a href="../Entrada/Eliminarentrada.php?id=<?php echo $id_entrada; ?>" class="btn btn-danger">Eliminar</a>

   
  </div>
</div>
<?php
    }
?>



<?php
        }
        
    }

?>
      <br> 
      <br> 
<div class="card-header bg-light text-dark">
<div class="card-header bg-info text-white">Agregar Entrada</div>

  <div class="card-body">
    <form action="agregar_entrada.php" method="POST">
      <input type="hidden" name="id_carta" value="<?php echo $id_carta; ?>">
      <div class="mb-3">
        <label for="entrada" class="form-label">Entrada</label>
        <textarea class="form-control" id="entrada" name="entrada" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Agregar Entrada</button>
    </form>
  </div>
</div>
</body>
</html>