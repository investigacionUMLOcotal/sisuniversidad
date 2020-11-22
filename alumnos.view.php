<!DOCTYPE html>
<?php
require 'functions.php';
//Define queienes tienen permiso en este archivo
$permisos = ['Administrador', 'Profesor'];
permisos($permisos);
//consulta las secciones
$secciones = $conn->prepare("select * from secciones");
$secciones->execute();
$secciones = $secciones->fetchAll();

//consulta las carreras
$carreras = $conn->prepare("select * from carreras order by nombre asc");
$carreras->execute();
$carreras = $carreras->fetchAll();

//consulta de grados
$grados = $conn->prepare("select * from grados");
$grados->execute();
$grados = $grados->fetchAll();
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inicio | Registro </title>
    <meta name="description" content="Registro  Sis Universidad Martin Lutero Quilali" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">

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
        <h4>Registro de Alumnos</h4>
        <form method="post" action="procesaralumno.php">
            <div class="form-row">
                <div class="form-group  col-12 col-sm-6">
                    <label>Nombres</label>
                    <input type="text" required name="nombres" maxlength="45" class="form-control">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Apellidos</label>
                    <input type="text" required name="apellidos" maxlength="45" class="form-control">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>No de Carnet</label>
                    <input type="text" required name="numlista" class="form-control">
                </div>

                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
                        <div class="col-12 col-sm-6">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="form-check-input" type="radio" name="genero" id="gridRadios1" value="M" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Masculino
                                </label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="form-check-input" type="radio" name="genero" id="gridRadios2" value="F">
                                <label class="form-check-label" for="gridRadios2">
                                    Femenino
                                </label>
                            </div>
                        </div>
                </fieldset>
                <div class="form-group  col-12 col-sm-6">
                    <label>Carreras</label>
                    <select name="carreras" required class="form-control">
                        <?php foreach ($carreras as $carrera) : ?>
                            <option value="<?php echo $carrera['idcarrera'] ?>"><?php echo $carrera['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Año</label>
                    <select name="anio" required class="form-control">
                        <?php foreach ($grados as $grado) : ?>
                            <option value="<?php echo $grado['id'] ?>"><?php echo $grado['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>



                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-4 pt-0">Sección</legend>
                        <div class="col-12 col-sm-6">
                            <?php foreach ($secciones as $x => $seccion) : ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="seccion" id="gridRadios<?= $x ?>" value="<?= $seccion['id'] ?>">
                                    <label class="form-check-label" for="gridRadios<?= $x ?>">
                                        <?= $seccion['nombre'] ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                </fieldset>
            </div>


            <button type="submit" name="insertar" class="btn btn-success">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
            <a class="btn btn-info" href="listadoalumnos.view.php">Ver Listado</a>
            <br><br>
            <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
            <?php
            if (isset($_GET['err']))
                echo '<span class="error">Error al almacenar el registro</span>';
            if (isset($_GET['info']))
                echo '<span class="success">Registro almacenado correctamente!</span>';
            ?>

        </form>
        <?php
        if (isset($_GET['err']))
            echo '<span class="error">Error al guardar</span>';
        ?>
    </div>
    </div>
    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>