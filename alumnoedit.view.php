<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor'];
permisos($permisos);
if(isset($_GET['id'])) {

    $id_alumno = $_GET['id'];

    $alumno = $conn->prepare("select * from alumnos where id = ".$id_alumno);
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
            <h4>Edición de Alumnos</h4>
            <form method="post" class="form" action="procesaralumno.php">
                <!--colocamos un campo oculto que tiene el id del alumno-->
                <input type="hidden" value="<?php echo $alumno['id']?>" name="id">
                <label>Nombres</label><br>
                <input type="text" required name="nombres" value="<?php echo $alumno['nombres']?>">
                <br>
                <label>Apellidos</label><br>
                <input type="text" required name="apellidos" value="<?php echo $alumno['apellidos']?>" >
                <br><br>
                <label>No de Carnet</label><br>
                <input type="text" value="<?php echo $alumno['num_lista']?>" name="numlista">
                <br><br>
                <label>Sexo</label><br><input required type="radio" name="genero" <?php if($alumno['genero'] == 'M'){ echo "checked";} ?> value="M"> Masculino
                <input type="radio" name="genero" required value="F" <?php if($alumno['genero'] == 'F') { echo "checked";} ?>> Femenino
                <br><br>
                <label>Carrera</label><br>
                <select name="carreras" required>
                    <?php foreach ($carrera as $carrera):?>
                        <option value="<?php echo $carrera['idcarrera'] ?>" <?php if($alumno['id_carrera'] == $carrera['idcarrera']) { echo "selected";} ?> ><?php echo $carrera['nombre'] ?></option>
                    <?php endforeach;?>
                </select>
                <br><br>
                <label>Año</label><br>
                <select name="anio" required>
                    <?php foreach ($grados as $grado):?>
                        <option value="<?php echo $grado['id'] ?>" <?php if($alumno['id_grado'] == $grado['id']) { echo "selected";} ?> ><?php echo $grado['nombre'] ?></option>
                    <?php endforeach;?>
                </select>
                <br><br>
                <label>Seccion</label><br>

                    <?php foreach ($secciones as $seccion):?>
                        <input type="radio" name="seccion" <?php if($alumno['id_seccion'] == $seccion['id']) { echo "checked";} ?> required value="<?php echo $seccion['id'] ?>">Seccion <?php echo $seccion['nombre'] ?>
                    <?php endforeach;?>

                <br><br>
                <button type="submit" name="modificar">Guardar Cambios</button> <a class="btn-link" href="listadoalumnos.view.php">Ver Listado</a>
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