<?php
require 'functions.php';

$permisos = ['Administrador','Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de docenetes
$docentes = $conn->prepare("SELECT d.id, d.nombre_docente, d.apellido_apellido, d.Numdecarnet, d.sexo  FROM docentes as d ");
$docentes->execute();
$docentes = $docentes->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Docentes | Reporte </title>
    <meta name="description" content="Registro de Notas Sis Universidad Martin Lutero Quilali" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Registro  - UML " "</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>



<nav>
    <ul>
        <li class="active"><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
        <li><a href="docentes.view.php">Registro de docentes</a> </li>
        <li><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
        <li><a href="listadodocentes.view.php">Listado de Docentes</a> </li>
        <li><a href="notas.view.php">Registro de Notas</a> </li>
        <li><a href="listadonotas.view.php">Consulta de Notas</a> </li>
        
        <li class="right"><a href="logout.php">Salir</a> </li>

    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de Docentes</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>No de<br>Carnet</th><th>Apellidos</th><th>Nombres</th><th>Sexo</th>
                    <th>Editar</th><th>Eliminar</th>
                </tr>
                <?php foreach ($docentes as $docente) :?>
                <tr>
                    <td align="center"><?php echo $docente['Numdecarnet'] ?></td>
                    <td><?php echo $docente['apellido_apellido'] ?></td>
                    <td><?php echo $docente['nombre_docente'] ?></td>
                    <td align="center"><?php echo $docente['sexo'] ?></td>
                    <td><a href="docentesedit.view.php?id=<?php echo $docente['id'] ?>">Editar</a> </td>
                    <td><a href="docentesdelete.php?id=<?php echo $docente['id'] ?>">Eliminar</a> </td>
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="docentes.view.php">Agregar Docente</a>
                <br><br>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
                ?>


