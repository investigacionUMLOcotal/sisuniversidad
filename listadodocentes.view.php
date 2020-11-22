<?php
require 'functions.php';

$permisos = ['Administrador', 'Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de docenetes
$docentes = $conn->prepare("SELECT d.id, d.nombre_docente, d.apellido_apellido, d.Numdecarnet, d.sexo  FROM docentes as d ");
$docentes->execute();
$docentes = $docentes->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Docentes | Reporte </title>
    <meta name="description" content="Registro de Notas Sis Universidad Martin Lutero Quilali" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css" />
</head>

<body class="d-flex flex-column min-vh-100">
<?php include 'includes/nav.php'?>
    <div class="container">
        <?php
        if (isset($_GET['err'])) {
            echo '<h3 class="alert alert-danger">ERROR: Usuario no autorizado</h3>';
        }
        ?>
       
        <br>


        <h4>Listado de Docentes</h4>
        <div id="example_wrapper">


            <table class="table" cellspacing="0" cellpadding="0">
                <thead>
                    <tr class="bg-primary">
                        <th>No de<br>Carnet</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Sexo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($docentes as $docente) : ?>
                        <tr>
                            <td align="center"><?php echo $docente['Numdecarnet'] ?></td>
                            <td><?php echo $docente['apellido_apellido'] ?></td>
                            <td><?php echo $docente['nombre_docente'] ?></td>
                            <td align="center"><?php echo $docente['sexo'] ?></td>
                            <td><a class="btn btn-outline-warning" href="docentesedit.view.php?id=<?php echo $docente['id'] ?>">Editar</a> </td>
                            <td><a class="btn btn-outline-danger" href="docentesdelete.php?id=<?php echo $docente['id'] ?>">Eliminar</a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br><br>

        <a class="btn btn-success" href="docentes.view.php">Agregar Docente</a>
        <br><br>
        <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
        <?php
        if (isset($_GET['err']))
            echo '<span class="error">Error al almacenar el registro</span>';
        if (isset($_GET['info']))
            echo '<span class="success">Registro almacenado correctamente!</span>';
        ?>
    </div>

    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>