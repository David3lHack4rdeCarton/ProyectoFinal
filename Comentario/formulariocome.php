<?php
require_once '../Conexion/conexion.php';

 date_default_timezone_set('America/Mexico_City');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Comentario</title>

    <!-- Agregar Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-5">Insertar Comentario</h1>

        <form method="POST" action="insertcome.php">
            <div class="mb-3">
                <label for="Comentario" class="form-label">Comentario:</label>
                <input type="text" name="Comentario" id="Comentario" class="form-control">
            </div>

            <div class="mb-3">
                <label for="fecha_creacion" class="form-label">Fecha de creación:</label>
                <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control"  min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="mb-3">
  <label for="Entrada" class="form-label">Entrada:</label>
  <select name="Entrada" id="Entrada" class="form-control">
  <?php
$entradas = $coleccion_entrada->find();
foreach ($entradas as $entrada) {
    echo '<option value="' . $entrada['_id'] . '">' . $entrada['entrada'] . '</option>';
}
    ?>
  </select>
</div>


            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Insertar Comentario
            </button>
        </form>
    </div>

    <!-- Agregar Bootstrap 5 JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/6720e4bdbe.js" crossorigin="anonymous"></script>
</body>
</html>
