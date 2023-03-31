<?php
// Conectar a MongoDB
require_once __DIR__ . '/../vendor/autoload.php';

//$MongoURl = "mongodb+srv://admin:12345@cluster0.1ic62lv.mongodb.net/?retryWrites=true&w=majority";

$cliente = new MongoDB\Client("mongodb://localhost:27017");


//$cliente = new MongoDB\Client($MongoURl);


// Seleccionar una base de datos y una colección
$base_de_datos = $cliente->Blog;

$coleccion_usuarios = $base_de_datos->usuarios;
$coleccion_roles = $base_de_datos->Rol;

$coleccion_categorias = $base_de_datos->Categorias;

$coleccion_blogs = $base_de_datos->blogs;

$coleccion_imagen = $base_de_datos->Imagen;

$coleccion_entrada = $base_de_datos->Entrada;

$coleccion_comentarios = $base_de_datos->Comentarios;
?>

