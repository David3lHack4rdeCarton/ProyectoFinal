<?php
require_once '../Conexion/conexion.php';

$Categoria = $coleccion_categorias->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Categorias</title>

	<!-- Agregar Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center my-5">Editar Categorias</h1>

		<form method="POST" action="Editacat.php">
			<div class="mb-3">
				<label for="nombre" class="form-label">Nombre:</label>
				<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $Categoria['nombre'] ?>">
			</div>

			<div class="mb-3">
				<label for="usuario" class="form-label">Descripcion:</label>
				<input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $Categoria['descripcion'] ?>">
			</div>


			<input type="hidden" name="id" value="<?php echo $Categoria['_id'] ?>">
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
