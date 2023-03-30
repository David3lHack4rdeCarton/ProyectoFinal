<?php
require_once '../Conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Imagen</title>

    <!-- Agregar Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-5">Insertar Imagen</h1>

        <form method="POST" action="insertimg.php" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nombre" class="form-label">Titulo:</label>
                <input type="text" name="Titulo" id="Titulo" class="form-control">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Imagen:</label>
                <input type="file" name="Imagen" id="Imagen" class="form-control">
            </div>

            <div class="mb-3">
  <label for="blog">Imagen:</label>
  <select name="blog" class="form-select">
    <?php
    // Obtener todos los documentos de la colección de roles
    $title = $coleccion_blogs->find();

    // Iterar sobre los documentos para crear una opción para cada uno
    foreach ($title as $titu) {
      echo '<option value="' . $titu['_id'] . '">' . $titu['titulo'] . '</option>';
    }
    ?>
  </select>
</div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Insertar Imagen
            </button>
        </form>
    </div>

    <!-- Agregar Bootstrap 5 JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/6720e4bdbe.js" crossorigin="anonymous"></script>
</body>
</html>
