<?php
require_once '../Conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Insertar usuarios</title>

	<!-- Agregar Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center my-5">Insertar usuarios</h1>

		<form method="POST" action="Insertuser.php">
			<div class="mb-3">
				<label for="nombre" class="form-label">Nombre:</label>
				<input type="text" name="nombre" id="nombre" class="form-control">
			</div>

            <div class="mb-3">
    <label for="usuario" class="form-label">Usuario:</label>
    <input type="text" name="usuario" id="usuario" class="form-control">
</div>
<div class="mb-3">
  <label for="contraseña" class="form-label">Contraseña:</label>
  <input type="password" name="contraseña" id="contraseña" class="form-control">
</div>

<div class="mb-3">
  <label for="rol">Rol:</label>
  <select name="rol" class="form-select">
    <?php
    // Obtener todos los documentos de la colección de roles
    $roles = $coleccion_roles->find();

    // Iterar sobre los documentos para crear una opción para cada uno
    foreach ($roles as $rol) {
      echo '<option value="' . $rol['_id'] . '">' . $rol['nombre'] . '</option>';
    }
    ?>
  </select>
</div>

<button type="submit" class="btn btn-primary">
    <i class="fas fa-save"></i> Insertar usuario
</button>

		</form>
	</div>

	<!-- Agregar Bootstrap 5 JS (opcional) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/6720e4bdbe.js" crossorigin="anonymous"></script>

</body>
</html>
