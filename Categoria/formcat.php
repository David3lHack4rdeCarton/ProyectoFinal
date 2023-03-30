<?php
require_once '../Conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar categoría</title>

    <!-- Agregar Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-5">Insertar categoría</h1>

        <form method="POST" action="insertcat.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Insertar categoría
            </button>
        </form>
    </div>

    <!-- Agregar Bootstrap 5 JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/6720e4bdbe.js" crossorigin="anonymous"></script>
</body>
</html>
