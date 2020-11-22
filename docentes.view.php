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
        <h4>Registro de docentes</h4>
        <form method="post" action="procesardocente.php">
            <div class="form-row">
                <div class="form-group col-12 col-sm-6">
                    <label>Nombre docente</label><br>
                    <input type="text" required name="nombresDoc" maxlength="45" class="form-control">
                </div>


                <div class="form-group col-12 col-sm-6">
                    <label>Apellido docente</label><br>
                    <input type="text" required name="apellidosDoc" maxlength="45" class="form-control">
                </div>

                <div class="form-group col-12 col-sm-6">
                    <label>No de carnet</label><br>
                    <input type="text" name="numcarnetDoc" class="form-control">
                </div>


                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
                        <div class="col-12 col-sm-6">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="form-check-input" type="radio" name="sexoDoc" id="gridRadios1" value="M" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Masculino
                                </label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="form-check-input" type="radio" name="sexoDoc" id="gridRadios2" value="F">
                                <label class="form-check-label" for="gridRadios2">
                                    Femenino
                                </label>
                            </div>
                        </div>
                </fieldset>
            </div>
            <button type="submit" name="insertarDoc" class="btn btn-success">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
            <a class="btn btn-outline-info" href="listadodocentes.view.php">Ver Listado</a>
            <br><br>
            <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
            <?php
            if (isset($_GET['err']))
                echo '<span class="alert alert-danger">Error al almacenar el registro</span>';
            if (isset($_GET['info']))
                echo '<span class="alert alert-success">Registro almacenado correctamente!</span>';
            ?>

        </form>
        <?php
        if (isset($_GET['err']))
            echo '<span class="error">Error al guardar</span>';
        ?>
    </div>
    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>