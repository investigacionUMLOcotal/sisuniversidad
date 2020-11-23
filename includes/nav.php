<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary" style="border-bottom:5px solid #d5e119">
      <a class="navbar-brand" href="inicio.view.php" style="margin: -8px 0px -8px -16px;
    background: white;
    box-shadow: -3px -10px 10px 6px #0000008c;
    padding: 10px;">
        <img width="150" src="imagenes/logoUML.png" alt="" class="d-inline-block align-center"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="inicio.view.php">Inicio <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Reportes
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="listadoalumnos.view.php">Lista de Alumnos</a>
              <a class="dropdown-item" href="listadodocentes.view.php">Lista de Docentes</a>
              <a class="dropdown-item" href="listadonotas.view.php">Lista de Notas</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Registrar
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="alumnos.view.php">Alumnos</a>
              <a class="dropdown-item" href="docentes.view.php">Docentes</a>
              <a class="dropdown-item" href="notas.view.php">Notas</a>
            </div>
          </li>

          <?php if ($_SESSION['rol'] == 'Administrador') { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administración
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


        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownq" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Usuario: <?php echo $_SESSION["username"] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownq">
              <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <style>
      .container{
        margin-top: 50px;
      }
    </style>