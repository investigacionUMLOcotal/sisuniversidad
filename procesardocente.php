<?php
if(!$_POST){
    header('location: docentes.view.php');
}
else {
    //incluimos el archivo funciones que tiene la conexion
    require 'functions.php';
    //Recuperamos los valores que vamos a llenar en la BD
    $nombres = htmlentities($_POST ['nombresDoc']);
    $apellidos = htmlentities($_POST ['apellidosDoc']);
    $numcarnet= htmlentities($_POST ['numcarnetDoc']);
     $sexo = htmlentities($_POST['sexoDoc']);
   

    //insertar es el nombre del boton guardar que esta en el archivo docentes.view.php
    if (isset($_POST['insertarDoc'])){

        $result = $conn->query("insert into docentes (nombre_docente, apellido_apellido, Numdecarnet, sexo) values ('$nombres', '$apellidos', '$numcarnet','$sexo')");
        if (isset($result)) {
            header('location:docentes.view.php?info=1');
        } else {
            header('location:docentes.view.php?err=1');
        }// validación de registro

    //sino boton modificar que esta en el archivo docentedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id del docente a modificar
            $id_docente = htmlentities($_POST['id']);
            $result = $conn->query("UPDATE docentes SET nombre_docente = '$nombres', apellido_apellido = '$apellidos', Numdecarnet = '$numcarnet', sexo = '$sexo' where id = " . $id_docente);
            if (isset($result)) {
                header('location:docentesedit.view.php?id=' . $id_docente . '&info=1');
            } else {
                header('location:docentesedit.view.php?id=' . $id_docente . '&err=1');
            }// validación de registro
    }

}

