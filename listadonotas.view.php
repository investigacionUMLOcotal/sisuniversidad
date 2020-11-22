<!DOCTYPE html>
<?php
require 'functions.php';

$permisos = ['Administrador', 'Profesor', 'Padre'];
permisos($permisos);
//consulta las materias
$materias = $conn->prepare("select * from materias");
$materias->execute();
$materias = $materias->fetchAll();

//consulta las carreras
$carreras = $conn->prepare("select * from carreras order by nombre asc");
$carreras->execute();
$carreras = $carreras->fetchAll();

//consulta de grados
$grados = $conn->prepare("select * from grados");
$grados->execute();
$grados = $grados->fetchAll();

//consulta las secciones
$secciones = $conn->prepare("select * from secciones");
$secciones->execute();
$secciones = $secciones->fetchAll();
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Notas | Registro </title>
    <meta name="description" content="Registro UML" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css" />

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php
        include 'includes/nav.php'
        ?>
        <br>
        <h3>Consulta de Notas</h3>
        <?php
        if (!isset($_GET['consultar'])) {
        ?>
            <p>Seleccione el año, carrera, materia y la sección</p>
            <form method="get" action="listadonotas.view.php">
                <div class="form-row">
                    <div class="form-group col-12 col-sm-6">
                        <label>Seleccione el Año</label><br>
                        <select class="form-control" name="grado" required>
                            <?php foreach ($grados as $grado) : ?>
                                <option value="<?php echo $grado['id'] ?>"><?php echo $grado['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select></div>
                    <div class="form-group col-12 col-sm-6">
                        <label>Seleccione las Carreras</label><br>
                        <select class="form-control" name="carrera" required>
                            <?php foreach ($carreras as $carrera) : ?>
                                <option value="<?php echo $carrera['idcarrera'] ?>"><?php echo $carrera['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label>Seleccione la Materia</label><br>
                        <select class="form-control" name="materia" required>
                            <?php foreach ($materias as $materia) : ?>
                                <option value="<?php echo $materia['id'] ?>"><?php echo $materia['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label>Seleccione la Sección</label><br><br>

                        <?php foreach ($secciones as $seccion) : ?>
                            <input type="radio" name="seccion" required value="<?php echo $seccion['id'] ?>">Sección <?php echo $seccion['nombre'] ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="btn btn-success" type="submit" name="consultar" value="1">Consultar Notas</button></a>
                <br><br>
            </form>
        <?php
        }
        ?>
        <hr>

        <?php
        if (isset($_GET['consultar'])) {
            $id_materia = $_GET['materia'];
            $id_grado = $_GET['grado'];
            $id_seccion = $_GET['seccion'];

            //extrayendo el numero de evaluaciones para esa materia seleccionada
            $num_eval = $conn->prepare("select num_evaluaciones from materias where id = " . $id_materia);
            $num_eval->execute();
            $num_eval = $num_eval->fetch();
            $num_eval = $num_eval['num_evaluaciones'];


            //mostrando el cuadro de notas de todos los alumnos del grado seleccionado
            $sqlalumnos = $conn->prepare("select a.id, a.num_lista, a.apellidos, a.nombres, b.nota,b.observaciones, avg(b.nota) as promedio from alumnos as a left join notas as b on a.id = b.id_alumno
 where id_grado = " . $id_grado . " and id_seccion = " . $id_seccion . " group by a.id");
            $sqlalumnos->execute();
            $alumnos = $sqlalumnos->fetchAll();
            $num_alumnos = $sqlalumnos->rowCount();
            $promediototal = 0.0;

        ?>
            <br>
            <a class="btn btn-outline-danger" href="listadonotas.view.php"><strong>
                    << Volver</strong> </a> <br>
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($alumnos as $index => $alumno) : ?>
                                    <!-- campos ocultos necesarios para realizar el insert-->
                                    <tr>
                                        <td><?php echo $alumno['num_lista'] ?></td>
                                        <td><?php echo $alumno['apellidos'] ?></td>
                                        <td><?php echo $alumno['nombres'] ?></td>
                                        <?php                                        
                                        $notas = $conn->prepare("select id, nota from notas where id_alumno = " . $alumno['id'] . " and id_materia = " . $id_materia);
                                        $notas->execute();
                                        $notas = $notas->fetchAll();
                                        if ($notas) {
                                            foreach ($notas as $eval => $nota) {
                                                echo '<td align="center"><input type="hidden" name="nota' . $eval . '" value="' . $nota['nota'] . '" >' . $nota['nota'] . '</td>';
                                            }
                                        } else {
                                            for ($i = 0; $i < ($num_eval); $i++) {
                                                echo '<td>Sin nota</td>';
                                            }
                                        }
                                        echo '<td>' . number_format($alumno['promedio'], 2) . '</td>';
                                        $promediototal += number_format($alumno['promedio'], 2);
                                        echo '<td>' . $alumno['observaciones'] . '</td>';
                                        ?>
                                    </tr>
                                    
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Promedios por notas</th>
                                    <th></th>
                                    <th></th>
                                        <?php
                                        for ($i = 0; $i < $num_eval; $i++) {
                                            echo '<th><div class="text-center" id="promedio' . $i . '"><div></th>';
                                        }
                                        ?>
                                    <th><?php echo @number_format($promediototal / $num_alumnos, 2) ?></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                        </table>

                        <br>


                    <?php
                }
                    ?>
    </div>
    </div>
    </div>
    <?php
    include 'includes/footer.php';
    ?>
    <script>
        <?php
        for ($i = 0; $i < $num_eval; $i++) {
            echo 'var values' . $i . ' = [];
        var promedio' . $i . ';
    var valor' . $i . ' = 0;
    var nota' . $i . ' = document.getElementsByName("nota' . $i . '");
    for(var i = 0; i < nota' . $i . '.length; i++) {
        valor' . $i . ' += parseFloat(nota' . $i . '[i].value);
    }
    promedio' . $i . ' = (valor' . $i . ' / parseFloat(nota' . $i . '.length));
    document.getElementById("promedio' . $i . '").innerHTML = (promedio' . $i . ').toFixed(2);';
        }
        ?>
    </script>
</body>

</html>