<?php
require_once './Conexion/conexion.php';
session_start();
if(isset($_SESSION['usuario'])){
  header("location: Vistaprincipal.php");
  exit();
}
//var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./login/style.css" />
   
    <title>Inicio de sesion</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="./login/validacion.php" method="POST" class="sign-in-form">
            <h2 class="title">Iniciar Sesion</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Usuario" name="Usuario" id="Usuario" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" name="Contraseña" id="Contraseña" />
            </div>  
       
            <input type="submit" value="Iniciar" class="btn solid" />
        
            <p class="social-text">iniciar con otra cuenta</p>
            <div class="social-media">
              
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              
            </div>
          </form>
          <form action="./login/registro.php" method="POST" class="sign-up-form">
            <h2 class="title">Registrarse</h2>
            <div class="input-field">
              <i class="fas fa-user-tie"></i>
              <input type="text" placeholder="nombre" name="nombre" id="nombre" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Usuario" name="Usuario" id="Usuario" />
            </div>  
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" name="Contraseña" id="Contraseña"/>
            </div>
            
            <input type="submit" class="btn" value="Crear cuenta" />

          
            <p class="social-text">Crea una cuenta con la siguiente red</p>
            <div class="social-media">
              
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Nuevo por aquí?</h3>
            <p>
              Registrate para que seas parte de esta gran comunidad!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Registrarte
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Tienes cuenta?</h3>
            <p>
              Inicia sesion.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Inicia sesion
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="./login/app.js"></script>
  </body>
</html>
