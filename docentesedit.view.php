<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor'];
permisos($permisos);
if(isset($_GET['id'])) {

    $id_docente = $_GET['id'];

    $docente = $conn->prepare("select * from docentes where id = ".$id_docente);
    $docente->execute();
    $docente = $docente->fetch();

}else{
    Die('Ha ocurrido un error');
}
?>
<html>
<head>
<title>Inicio | Registro </title>
    <meta name="description" content="Registro  Sis Universidad Martin Lutero Quilali" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Registro Sis Universidad Martin Lutero Quilali"</h1>
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
            <h4>Edición de Docentes</h4>
            <form method="post" class="form" action="procesardocente.php">
                <!--colocamos un campo oculto que tiene el id del alumno-->
                <input type="hidden" value="<?php echo $docente['id']?>" name="id">
                <label>Nombres</label><br>
                <input type="text" required name="nombresDoc" value="<?php echo $docente['nombre_docente']?>" maxlength="45">
                <br>
                <label>Apellidos</label><br>
                <input type="text" required name="apellidosDoc" value="<?php echo $docente['apellido_apellido']?>" maxlength="45">
                <br><br>
                <label>No de Carnet</label><br>
                <input type="text" value="<?php echo $docente['Numdecarnet']?>" name="numcarnetDoc">
                <br><br>
                <label>Sexo</label><br><input required type="radio" name="sexoDoc" <?php if($docente['sexo'] == 'M'){ echo "checked";} ?> value="M"> Masculino
                <input type="radio" name="sexoDoc" required value="F" <?php if($docente['sexo'] == 'F') { echo "checked";} ?>> Femenino
                <br><br>
                <button type="submit" name="modificar">Guardar Cambios</button> <a class="btn-link" href="listadodocentes.view.php">Ver Listado</a>
                <br><br>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al editar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro modificado correctamente!</span>';
                ?>

            </form>
        </div>
</div>

<footer>
    <p>Derechos reservados &copy; 2020</p>
</footer>

</body>

</html>