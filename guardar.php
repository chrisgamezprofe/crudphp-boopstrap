<?php
session_start();
require 'conexion.php';

if(isset($_POST['btnGuardar'])){
    $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion,$_POST['apellido']);
    $edad = mysqli_real_escape_string($conexion,$_POST['edad']);
    $pais = mysqli_real_escape_string($conexion,$_POST['pais']);

    $sql = "INSERT INTO estudiantes(nombre,apellido,edad,id_pais) VALUES
    ('$nombre','$apellido','$edad','$pais')";

    $res = $conexion->query($sql);
    if($res){
        $_SESSION['mensaje'] = "Estudiante registrado correctamente";
        $_SESSION['error'] = false;
    }else{
        $_SESSION['mensaje'] = "No se logró registrar el Estudiante"; 
        $_SESSION['error'] = true;
    }
    header("location:crear-estudiantes.php");
    exit;

}else if(isset($_POST['btnActualizar'])){
    $id = mysqli_real_escape_string($conexion,$_POST['id']);
    $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion,$_POST['apellido']);
    $edad = mysqli_real_escape_string($conexion,$_POST['edad']);
    $pais = mysqli_real_escape_string($conexion,$_POST['pais']);

    $sql = "UPDATE estudiantes SET nombre='$nombre',apellido='$apellido',edad='$edad',id_pais='$pais' WHERE md5(id)='$id'";

    $res = $conexion->query($sql);
    if($res){
        $_SESSION['mensaje'] = "Estudiante actualizado correctamente";
        $_SESSION['error'] = false;
    }else{
        $_SESSION['mensaje'] = "No se logró actualizar el Estudiante"; 
        $_SESSION['error'] = true;
    }
    header("location:index.php");
    exit;

}else if(isset($_POST['btnEliminar'])){
    $id = mysqli_real_escape_string($conexion,$_POST['btnEliminar']);


    $sql = "delete from estudiantes WHERE md5(id)='$id'";

    $res = $conexion->query($sql);
    if($res){
        $_SESSION['mensaje'] = "Estudiante eliminado correctamente";
        $_SESSION['error'] = false;
    }else{
        $_SESSION['mensaje'] = "No se logró eliminarse el Estudiante"; 
        $_SESSION['error'] = true;
    }
    header("location:index.php");
    exit;

}

?>