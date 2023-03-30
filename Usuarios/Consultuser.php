<?php
session_start();

if(!isset($_SESSION['usuario'])){
  header("location: ../index.php");
  exit();
}

// Verificar si el rol del usuario es administrador

if($_SESSION['usuario']['rol'] !== 'admin') {
    // Redirigir al usuario a la página de inicio
    header('Location: ../index.php');
    exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Consultar usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-k2FV7/72rDn1VrBsSNKj3TvVpX9sZsCsr7P/xiYHRvU8WdMAaG+1nI6ARegrvX8rz6FzZMkI0bQ2wvR8iRtkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include '../navbar.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>Usuarios registrados</h1>
                <a href="formularioinser.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Agregar usuario</a>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Contraseña</th>
							<th>Rol</th>
                            <th>editar</th>
                            <th>eliminar</th>
						</tr>
					</thead>
					<tbody>
					<?php
// Conectar a MongoDB
require_once '../Conexion/conexion.php';

// Seleccionar una colección
$usuarios = $coleccion_usuarios;

// Recuperar los documentos de la colección y unir con la colección de roles
$resultado = $usuarios->aggregate([
    [
        '$lookup' => [
            'from' => 'Rol',
            'localField' => 'rol',
            'foreignField' => '_id',
            'as' => 'rol'
        ]
    ],
    [
        '$unwind' => '$rol'
    ]
]);

// Mostrar los documentos en una tabla HTML
foreach ($resultado as $documento) {
    echo "<tr>";
    echo "<td>" . $documento->nombre . "</td>";
    echo "<td>" . $documento->usuario . "</td>";
    echo "<td>" . $documento->contraseña . "</td>";
    echo "<td>" . $documento->rol->nombre . "</td>";
    echo '<td><a href="formeditaruser.php?id=' . $documento->_id . '" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>';
    echo '<td><a href="eliminarusuario.php?id=' . $documento->_id . '" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>';
    echo "</tr>";

}


?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-n/7RrGNtQoPv/Dz2l76MCrEy6nGNd4QoUJlZlYAoH5w3+s3I5fRPoS5v5yL9fIksCsqYCOYBvlnFv6QwpU6+ug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha512-UO+GmJvL1QljyZlJmP0bK7k2gzUmtmZOmN9+aXH1ltJOT0tj47f3G5XiRzJhMzLZCwTsoROzKN2T9YPHePh99g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://kit.fontawesome.com/6720e4bdbe.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
