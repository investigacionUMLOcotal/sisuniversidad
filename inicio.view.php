<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador', 'Profesor', 'Madre'];
permisos($permisos);
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Inicio | Panel de control </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Registro Sis Universidad Martin Lutero Quilali" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    /* MARKETING CONTENT
-------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .marketing .col-lg-4 {
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .marketing h2 {
      font-weight: 400;
    }

    .marketing .col-lg-4 p {
      margin-right: .75rem;
      margin-left: .75rem;
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">
<?php
        include 'includes/nav.php'
        ?>
  <div class="container">
    <?php
    if (isset($_GET['err'])) {
      echo '<h3 class="alert alert-danger">ERROR: Usuario no autorizado</h3>';
    }
    ?>
    <br>
    <div class="row">
      <div class="col-12 col-sm-4">
        <div class="card" style="border:0">
          <img src="imagenes/logoUML.png" class="card-img-top" alt="Logo">
          <div class="card-body">
            <h5 class="card-title text-center">"Sis Universidad "</h5>
            <p class="card-text">
              <a href="#" class="btn btn-primary btn-block">Integrantes</a>
              <br>Yahoska Moreno<br>Alba Bellorin<br>Francis Chavarria</p>
            </p>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-header">
            Información general
          </div>
          <div class="card-body">
            <div class="container marketing">
              <!-- Three columns of text below the carousel -->
              <div class="row">

                <div class="col-lg-4">
                  <svg class="bd-placeholder-img rounded-circle" width="100" height="100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Carreras">
                    <title>Carreras</title>
                    <rect width="100%" height="100%" fill="#739" />
                  </svg>
                  <h2>Carreras</h2>
                  <p><?=contar('carreras')?></p>
                  <p><a class="btn btn-info" href="#" role="button">Ver mas &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <svg class="bd-placeholder-img rounded-circle" width="100" height="100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Docentes">
                    <title>Docentes</title>
                    <rect width="100%" height="100%" fill="#C02" />
                  </svg>
                  <h2>Docentes</h2>
                  <p><?=contar('docentes')?></p>
                  <p><a class="btn btn-danger" href="listadodocentes.view.php" role="button">Ver mas &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <svg class="bd-placeholder-img rounded-circle" width="100" height="100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Estudiantes">
                    <title>Estudiantes</title>
                    <rect width="100%" height="100%" fill="#16B" />
                  </svg>
                  <h2>Estudiantes</h2>
                  <p><?=contar('alumnos')?></p>
                  <p><a class="btn btn-primary" href="listadoalumnos.view.php" role="button">Ver mas &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
              </div><!-- /.row -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include 'includes/footer.php';
  ?>
</body>

</html>