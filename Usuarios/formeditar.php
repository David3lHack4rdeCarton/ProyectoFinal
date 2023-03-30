<?php
require_once '../Conexion/conexion.php';

$usuario = $coleccion_usuarios->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
$roles = $coleccion_roles->find();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar usuario</title>

	<!-- Agregar Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center my-5">Editar usuario</h1>

		<form method="POST" action="editausuario.php">
			<div class="mb-3">
				<label for="nombre" class="form-label">Nombre:</label>
				<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $usuario['nombre'] ?>">
			</div>

			<div class="mb-3">
				<label for="usuario" class="form-label">Usuario:</label>
				<input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario['usuario'] ?>">
			</div>

            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña:</label>
                <input type="text" name="contraseña" id="contraseña" class="form-control" value="<?php echo $usuario['contraseña'] ?>">
            </div>

			<div class="mb-3">
				<label for="rol" class="form-label">Rol:</label>
				<select name="rol" id="rol" class="form-select">
					<?php foreach($roles as $rol): ?>
					<option value="<?php echo $rol['_id'] ?>" <?php if($usuario['rol'] == $rol['_id']) echo 'selected' ?>><?php echo $rol['nombre'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<input type="hidden" name="id" value="<?php echo $usuario['_id'] ?>">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                <span>Guardar</span>
            </button>
		</form>
	</div>

	<!-- Agregar Bootstrap 5 JS (opcional) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://kit.fontawesome.com/6720e4bdbe.js" crossorigin="anonymous"></script>

</body>
</html>
