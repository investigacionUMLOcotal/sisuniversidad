<?php
if(!$_POST){
    header('location: alumnos.view.php');
}
else {
    //incluimos el archivo funciones que tiene la conexion
    require 'functions.php';
    //Recuperamos los valores que vamos a llenar en la BD

    $nombres = htmlentities($_POST ['nombres']);
    $apellidos = htmlentities($_POST ['apellidos']);
    $numlista = htmlentities($_POST['numlista']);
    $genero = htmlentities($_POST['genero']);
    $idcarrera = htmlentities($_POST['carreras']);
    $idanio = htmlentities($_POST['anio']);
    $idseccion = htmlentities($_POST['seccion']);


    //insertar es el nombre del boton guardar que esta en el archivo alumnos.view.php
    if (isset($_POST['insertar'])){

        $result = $conn->query("INSERT INTO alumnos (num_lista, nombres, apellidos, genero, id_grado, id_seccion, id_carrera) VALUES ('$numlista', '$nombres', '$apellidos', '$genero', '$idanio', '$idseccion', '$idcarrera')");
        if (isset($result)) {
            header('location:alumnos.view.php?info=1');
        } else {
            header('location:alumnos.view.php?err=1');
        }// validación de registro

    //sino boton modificar que esta en el archivo alumnoedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id alumnos a modificar
            $id_alumno = htmlentities($_POST['id']);
            $result = $conn->query("UPDATE alumnos SET num_lista = '$numlista', nombres = '$nombres', apellidos = '$apellidos', genero = '$genero', id_grado = '$idanio', id_seccion = '$idseccion', id_carrera = '$idcarrera' WHERE id = " . $id_alumno);
            if (isset($result)) {
                header('location:alumnoedit.view.php?id=' . $id_alumno . '&info=1');
            } else {
                header('location:alumnoedit.view.php?id=' . $id_alumno . '&err=1');
            }// validación de registro
    }

}

