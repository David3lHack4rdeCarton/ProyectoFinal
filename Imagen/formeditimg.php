<?php

require_once '../Conexion/conexion.php';
date_default_timezone_set('America/Mexico_City');
$img = $coleccion_imagen->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar blog</title>

	<!-- Agregar Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center my-5">Editar imagen</h1>

		<form method="POST" action="updateimg.php" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="titulo" class="form-label">titulo:</label>
				<input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $img['titulo'] ?>">
			</div>

            <div class="mb-3">
    <label for="imagen" class="form-label">Imagen actual:</label>
    <img src="<?php echo $img['imagen'] ?>" alt="Imagen actual" width="100">
    <input type="file" name="imagen" id="imagen" class="form-control">
</div>



        

	

			</div>

			<input type="hidden" name="id" value="<?php echo $img['_id'] ?>">
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
