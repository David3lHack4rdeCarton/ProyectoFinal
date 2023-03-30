<?php

require_once '../Conexion/conexion.php';
date_default_timezone_set('America/Mexico_City');
$coment = $coleccion_comentarios->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
$entrada = $coleccion_entrada->find();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Comentario</title>

	<!-- Agregar Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center my-5">Editar Comentario</h1>

		<form method="POST" action="updatecome.php">
			<div class="mb-3">
				<label for="titulo" class="form-label">Comentario:</label>
				<input type="text" name="Comentario" id="Comentario" class="form-control" value="<?php echo $coment['Comentario'] ?>">
			</div>

            <div class="mb-3">
                <!-- <label for="fecha_creacion" class="form-label">Fecha de creación:</label> -->
                <input type="hidden" name="fecha_creacion" placeholder="fecha creacion" value="<?php echo date_create_from_format('Y-m-d H:i:s', $coment['fecha_creacion'])->format('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>">
            </div>


        

			<div class="mb-3">
				<label for="Entrada" class="form-label">Entrada:</label>
				<select name="Entrada" id="Entrada" class="form-select">
    <?php foreach($entrada as $entra): ?>
        <option value="<?php echo $entra['_id'] ?>" <?php if($coment['Entrada'] == $entra['_id']) echo 'selected' ?>><?php echo $entra['entrada'] ?></option>
    
        <?php endforeach; ?>
</select>

			</div>

			<input type="hidden" name="id" value="<?php echo $coment['_id'] ?>">
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
