<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador', 'Profesor'];
permisos($permisos);
if (isset($_GET['id'])) {

    $id_alumno = $_GET['id'];

    $alumno = $conn->prepare("select * from alumnos where id = " . $id_alumno);
    $alumno->execute();
    $alumno = $alumno->fetch();

    //consulta las secciones
    $secciones = $conn->prepare("select * from secciones");
    $secciones->execute();
    $secciones = $secciones->fetchAll();

    //consulta de carreras
    $carrera = $conn->prepare("select * from carreras");
    $carrera->execute();
    $carrera = $carrera->fetchAll();

    //consulta de grados
    $grados = $conn->prepare("select * from grados");
    $grados->execute();
    $grados = $grados->fetchAll();
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
    <?php include 'includes/nav.php' ?>
    <div class="container">
        <br>
        <h4>Edición de Alumnos</h4>
        <form method="post" action="procesaralumno.php">
            <input type="hidden" value="<?php echo $alumno['id'] ?>" name="id">
            <div class="form-row">
                <div class="form-group col-12 col-sm-6">
                    <label>Nombres</label><br>
                    <input class="form-control" type="text" required name="nombres" value="<?php echo $alumno['nombres'] ?>">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Apellidos</label><br>
                    <input class="form-control" type="text" required name="apellidos" value="<?php echo $alumno['apellidos'] ?>">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>No de Carnet</label><br>
                    <input class="form-control" type="text" value="<?php echo $alumno['num_lista'] ?>" name="numlista">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Sexo</label><br><input required type="radio" name="genero" <?php if ($alumno['genero'] == 'M') {
                                                                                            echo "checked";
                                                                                        } ?> value="M"> Masculino
                    <input type="radio" name="genero" required value="F" <?php if ($alumno['genero'] == 'F') {
                                                                                echo "checked";
                                                                            } ?>> Femenino
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Carrera</label><br>
                    <select class="form-control" name="carreras" required>
                        <?php foreach ($carrera as $carrera) : ?>
                            <option value="<?php echo $carrera['idcarrera'] ?>" <?php if ($alumno['id_carrera'] == $carrera['idcarrera']) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $carrera['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Año</label><br>
                    <select class="form-control" name="anio" required>
                        <?php foreach ($grados as $grado) : ?>
                            <option value="<?php echo $grado['id'] ?>" <?php if ($alumno['id_grado'] == $grado['id']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $grado['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Seccion</label><br>

                    <?php foreach ($secciones as $seccion) : ?>
                        <input type="radio" name="seccion" <?php if ($alumno['id_seccion'] == $seccion['id']) {
                                                                echo "checked";
                                                            } ?> required value="<?php echo $seccion['id'] ?>">Seccion <?php echo $seccion['nombre'] ?>
                    <?php endforeach; ?>
                </div>
            </div>


            <button class="btn btn-success" type="submit" name="modificar">Guardar Cambios</button>
            <a  class="btn btn-outline-danger" href="listadoalumnos.view.php">Ver Listado</a>

            <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
            <?php
            if (isset($_GET['err']))
                echo '<span class="error">Error al editar el registro</span>';
            if (isset($_GET['info']))
                echo '<span class="success">Registro modificado correctamente!</span>';
            ?>
        </form>
    </div>
    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>