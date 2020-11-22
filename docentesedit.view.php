<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador', 'Profesor'];
permisos($permisos);
if (isset($_GET['id'])) {

    $id_docente = $_GET['id'];

    $docente = $conn->prepare("select * from docentes where id = " . $id_docente);
    $docente->execute();
    $docente = $docente->fetch();
} else {
    die('Ha ocurrido un error');
}
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

        <h4>Edición de Docentes</h4>
        <form method="post" action="procesardocente.php">
            <div class="form-row">
                <div class="form-group col-12 col-sm-6">
                    <label>Nombres</label>
                    <input class="form-control" type="text" required name="nombresDoc" value="<?php echo $docente['nombre_docente'] ?>" maxlength="45">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Apellidos</label>
                    <input class="form-control" type="text" required name="apellidosDoc" value="<?php echo $docente['apellido_apellido'] ?>" maxlength="45">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>No de Carnet</label>
                    <input class="form-control" type="text" value="<?php echo $docente['Numdecarnet'] ?>" name="numcarnetDoc">
                </div>

                <!--colocamos un campo oculto que tiene el id del alumno-->
                <input type="hidden" value="<?php echo $docente['id'] ?>" name="id">

                <label>Sexo</label>
                <input required type="radio" name="sexoDoc" <?php if ($docente['sexo'] == 'M') {
                                                                echo "checked";
                                                            } ?> value="M"> Masculino
                <input type="radio" name="sexoDoc" required value="F" <?php if ($docente['sexo'] == 'F') {
                                                                            echo "checked";
                                                                        } ?>> Femenino
            </div>
            <button  class="btn btn-success" type="submit" name="modificar">Guardar Cambios</button>
            <a class="btn btn-outline-danger" href="listadodocentes.view.php">Ver Listado</a>
           
            <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
            <?php
            if (isset($_GET['err']))
                echo '<div class="alert alert-danger mt-auto">Error al editar el registro</div>';
            if (isset($_GET['info']))
                echo '<div class="alert alert-success mt-auto">Registro modificado correctamente!</div>';
            ?>
        </form>

    </div>
    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>