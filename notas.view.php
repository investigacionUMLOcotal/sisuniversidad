<!DOCTYPE html>
<?php
require 'functions.php';
//arreglo de permisos
$permisos = ['Administrador', 'Profesor'];
permisos($permisos);

//consulta las materias
$materias = $conn->prepare("select * from materias");
$materias->execute();
$materias = $materias->fetchAll();

//consulta de grados
$grados = $conn->prepare("select * from grados");
$grados->execute();
$grados = $grados->fetchAll();

//consulta las carreras
$carreras = $conn->prepare("select * from carreras order by nombre asc");
$carreras->execute();
$carreras = $carreras->fetchAll();

//consulta las secciones
$secciones = $conn->prepare("select * from secciones");
$secciones->execute();
$secciones = $secciones->fetchAll();

//consulta los docentes
$docentes = $conn->prepare("select * from docentes");
$docentes->execute();
$docentes = $docentes->fetchAll();
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Notas | Registro </title>
    <meta name="description" content="Registro de Notas UML" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css" />
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include 'includes/nav.php' ?>
    <div class="container">
        <br>
        <h3>Registro y Modificación Notas</h3>
        <?php if (!isset($_GET['revisar'])) { ?>
            <form method="get" action="notas.view.php">
                <div class="form-row">
                    <div class="form-group col-12 col-sm-6">
                        <label>Seleccione las carreras</label>
                        <select name="carrera" required class="form-control">
                            <?php foreach ($carreras as $carrera) : ?>
                                <option value="<?php echo $carrera['idcarrera'] ?>"><?php echo $carrera['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label>Seleccione el Docente</label><br>
                        <select name="docente" required class="form-control">
                            <?php foreach ($docentes as $docente) : ?>
                                <option value="<?php echo $docente['id'] ?>"><?php echo $docente['nombre_docente'] ?><?php echo " " ?><?php echo $docente['apellido_apellido'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label>Seleccione la Materia</label><br>
                        <select name="materia" required class="form-control">
                            <?php foreach ($materias as $materia) : ?>
                                <option value="<?php echo $materia['id'] ?>"><?php echo $materia['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label>Seleccione el Año</label><br>
                        <select name="grado" required class="form-control">
                            <?php foreach ($grados as $grado) : ?>
                                <option value="<?php echo $grado['id'] ?>"><?php echo $grado['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Selecciona la sección</legend>
                            <div class="col-10">
                                <?php foreach ($secciones as $id => $seccion) : ?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <label class="form-check-label" for="input<?= $id ?>">
                                            Sección <?php echo $seccion['nombre'] ?>
                                        </label>
                                        <input id="input<?= $id ?>" class="form-check-input" type="radio" name="seccion" required value="<?php echo $seccion['id'] ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <button class="btn btn-success" type="submit" name="revisar" value="1">Ingresar Notas</button>
                <a class="btn btn-outline-info" href="listadonotas.view.php">Consultar Notas</a>

            </form>


        <?php
        }
        if (isset($_GET['revisar'])) {
            $id_materia = $_GET['materia'];
            $id_grado = $_GET['grado'];
            $id_seccion = $_GET['seccion'];
            $id_docente = $_GET['docente'];
            $id_carrera = $_GET['carrera'];

            //extrayendo el numero de evaluaciones para esa materia seleccionada
            $num_eval = $conn->prepare("select num_evaluaciones from materias where id = " . $id_materia);
            $num_eval->execute();
            $num_eval = $num_eval->fetch();
            $num_eval = $num_eval['num_evaluaciones'];

            //mostrando el cuadro de notas de todos los alumnos del grado seleccionado
            $sqlalumnos = $conn->prepare("select a.id, a.num_lista, a.apellidos, a.nombres, b.nota, avg(b.nota) as promedio, b.observaciones from alumnos as a left join notas as b on a.id = b.id_alumno
            where id_grado = " . $id_grado . " and id_seccion = " . $id_seccion . " group by a.id");
            $sqlalumnos->execute();
            $alumnos = $sqlalumnos->fetchAll();
            $num_alumnos = $sqlalumnos->rowCount();

        ?>
            <form action="procesarnota.php" method="post">
                <input type="hidden" value="<?php echo $num_eval ?>" name="num_eval">
                <!-- campos para devolver los parametros en el get y mantener los mismos datos al hacer el header location-->
                <input type="hidden" value="<?php echo $id_materia ?>" name="id_materia">
                <input type="hidden" value="<?php echo $id_grado ?>" name="id_grado">
                <input type="hidden" value="<?php echo $id_seccion ?>" name="id_seccion">
                <input type="hidden" value="<?php echo $id_docente ?>" name="id_docente">
                <input type="hidden" value="<?php echo $id_carrera ?>" name="id_carrera">
                <input type="hidden" value="<?php echo $num_alumnos ?>" name="num_alumnos">
                <table class="table">
                    <thead>
                        <tr class="bg-info">
                            <th>No de lista</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <?php
                            for ($i = 1; $i <= $num_eval; $i++) {
                                echo '<th>Nota ' . $i . '</th>';
                            }
                            ?>
                            <th>Promedio</th>
                            <th>Observaciones</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $index => $alumno) : ?>
                            <tr>
                                <td>
                                <input type="hidden" value="<?php echo $alumno['id'] ?>" name="<?='id_alumno' . $index?>">
                                <?php echo $alumno['num_lista'] ?></td>
                                <td><?php echo $alumno['apellidos'] ?></td>
                                <td><?php echo $alumno['nombres'] ?></td>
                                <?php
                                if (existeNota($alumno['id'], $id_materia, $conn) > 0) {
                                    //ya tiene notas registradas
                                    $notas = $conn->prepare("select id, nota from notas where id_alumno = " . $alumno['id'] . " and id_materia = " . $id_materia);
                                    $notas->execute();
                                    $registrosnotas = $notas->fetchAll();
                                    $num_notas = $notas->rowCount();
                                    foreach ($registrosnotas as $eval => $nota) {
                                        echo '<input type="hidden" value="' . $nota['id'] . '" name="idnota' . $eval . 'alumno' . $index . '">';
                                        echo '<td><input class="form-control" type="text" maxlength="5" value="' . $nota['nota'] . '" name="evaluacion' . $eval . 'alumno' . $index . '" class="txtnota"></td>';
                                    }
                                    if ($num_eval > $num_notas) {
                                        $dif = $num_eval - $num_notas;
                                        for ($i = $num_notas; $i < $dif + $num_notas; $i++) {
                                            echo '<input type="hidden" value="' . $nota['id'] . '" name="idnota' . $i . 'alumno' . $index . '">';
                                            echo '<td><input class="form-control" type="text" maxlength="5" value="' . $nota['nota'] . '" name="evaluacion' . $i . 'alumno' . $index . '" class="txtnota"></td>';
                                        }
                                    }
                                } else {
                                    //extrayendo el numero de evaluaciones para esa materia seleccionada
                                    for ($i = 0; $i < $num_eval; $i++) {
                                        echo '<td><input class="form-control" type="text" maxlength="5" name="evaluacion' . $i . 'alumno' . $index . '" class="txtnota"></td>';
                                    }
                                }

                                echo '<td align="center">' . number_format($alumno['promedio'], 2) . '</td>';

                                if (existeNota($alumno['id'], $id_materia, $conn) > 0) {
                                    echo '<td><input class="form-control" type="text" maxlength="100" value="' . $alumno['observaciones'] . '" name="observaciones' . $index . '" class="txtnota"></td>';
                                } else {
                                    echo '<td><input class="form-control" type="text" name="observaciones' . $index . '" class="txtnota"></td>';
                                }

                                if (existeNota($alumno['id'], $id_materia, $conn) > 0) {
                                    echo '<td><a class="btn btn-danger btn-rounded" href="notadelete.php?idalumno=' . $alumno['id'] . '&idmateria=' . $id_materia . '">Eliminar</a> </td>';
                                } else {
                                    echo '<td>Sin notas</td>';
                                }
                                ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
                <button class="btn btn-outline-success" type="submit" name="insertar">Guardar</button>
                <button class="btn btn-outline-danger" type="reset">Limpiar</button>
            </form>
            <br>
        <?php } ?>
        <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
        <?php
        if (isset($_GET['err']))
            echo '<div class="alert alert-danger">Error al almacenar el registro</div>';
        if (isset($_GET['info']))
            echo '<div class="alert alert-success">Registro almacenado correctamente!</div>';
        ?>
        </form>
    </div>
    </div>
    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>