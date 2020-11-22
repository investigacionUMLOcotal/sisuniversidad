<?php
require 'functions.php';

$permisos = ['Administrador', 'Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$alumnos = $conn->prepare("select a.id, a.num_lista, a.nombres, a.apellidos, a.genero, carr.nombre, b.nombre as grado, c.nombre as seccion from alumnos as a inner join grados as b on a.id_grado = b.id inner join secciones as c on a.id_seccion = c.id  inner join carreras as carr on carr.idcarrera = a.id_carrera order by a.apellidos");
$alumnos->execute();
$alumnos = $alumnos->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de Alumnos | Registro </title>
    <meta name="description" content="Registro de Notas Sis Universidad Martin Lutero Quilali" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css"/>
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

        <h4>Listado de Alumnos</h4>
        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
            <tr class="bg-primary">
                <th>No de<br>Carnet</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Genero</th>
                <th>Carrera</th>
                <th>Año</th>
                <th>Seccion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($alumnos as $alumno) : ?>
                <tr>
                    <td align="center"><?php echo $alumno['num_lista'] ?></td>
                    <td><?php echo $alumno['apellidos'] ?></td>
                    <td><?php echo $alumno['nombres'] ?></td>
                    <td align="center"><?php echo $alumno['genero'] ?></td>
                    <td align="center"><?php echo $alumno['nombre'] ?></td>
                    <td align="center"><?php echo $alumno['grado'] ?></td>
                    <td align="center"><?php echo $alumno['seccion'] ?></td>
                    <td><a class="btn btn-outline-warning" href="alumnoedit.view.php?id=<?php echo $alumno['id'] ?>">Editar</a> </td>
                    <td><a class="btn btn-outline-danger" href="alumnodelete.php?id=<?php echo $alumno['id'] ?>">Eliminar</a> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <br><br>
        <a class="btn btn-success" href="alumnos.view.php">Agregar Alumno</a>
        <br><br>
        <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
        <?php
        if (isset($_GET['err']))
            echo '<span class="alert alert-danger">Error al almacenar el registro</span>';
        if (isset($_GET['info']))
            echo '<span class="alert alert-success">Registro almacenado correctamente!</span>';
        ?>
    </div>
    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>