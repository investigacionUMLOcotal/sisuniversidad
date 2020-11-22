<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesora','Madre'];
permisos($permisos);

?>
<html>
<head>
<title>Inicio | Registro </title>
    <meta name="description" content="Registro  Sis Universidad Martin Lutero Quilali" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1 class="text-center">BIENVENIDO "UML"</h1>
        <h3><?php echo $_SESSION["username"] ?></h3>
</div>


<!-- PRUEBA BARRA NAVEGACION DE BOOTSTRAP 4 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="imagenes/logoUML.png" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">INICIO <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          REGISTRAR
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="alumnos.view.php">Alumnos</a>
          <a class="dropdown-item" href="docentes.view.php">Docentes</a>
          <a class="dropdown-item" href="notas.view.php">Notas</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          REPORTES
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="listadoalumnos.view.php">Lista Alumnos</a>
          <a class="dropdown-item" href="listadodocentes.view.php">Lista Docentes</a>
        </div>
      </li>

      <!-- MENÚ PARA ADMINISTRADORES -->
      <?php if ($_SESSION['rol'] == 'Administrador') { ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ADMINISTRAR
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Registrar Nuevo Usuario</a>
          <a class="dropdown-item" href="#">Registrar Nueva Carrera</a>
          <a class="dropdown-item" href="#">Registrar Nueva Sección</a>
          <a class="dropdown-item" href="#">Registrar Nueva Asignatura</a>
        </div>
      </li>
      <?php } ?>
     


    </ul>
    <ul>

        <li class="nav-link right"><a href="logout.php">SALIR</a> </li>
    </ul>
  </div>
</nav>



<br><br>






<!-- 
<nav>
    <ul>
        <li class="active"><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
        <li><a href="docentes.view.php">Registro de docentes</a> </li>
        <li><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
        <li><a href="listadodocentes.view.php">Listado de Docentes</a> </li>
        <li><a href="notas.view.php">Registro de Notas</a> </li>
        <li><a href="listadonotas.view.php">Consulta de Notas</a> </li>
        
        <li class="right"><a href="logout.php">Salir</a> </li>

    </ul>
</nav> -->

<div class="body">
    <div class="panel">
           <h1 class="text-center">"Sis Universidad "</h1>
           
        <?php
        if(isset($_GET['err'])){
            echo '<h3 class="error text-center">ERROR: Usuario no autorizado</h3>';
        }
        ?>
       <div align="center"><img src="data:image/png;base64,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"></div>

        <br>
        <hr>
        <p class="text-center"><strong>Integrantes </strong><br><br>Yahoska Moreno<br>Alba Bellorin<br>Francis Chavarria</p>
        <br>
        </div>
</div>

<footer>

    <p>Derechos reservados &copy; 2020</p>
</footer>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>