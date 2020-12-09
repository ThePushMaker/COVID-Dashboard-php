<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


// Recepción de los datos enviados mediante POST desde el JS   
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$municipio = (isset($_POST['municipio'])) ? $_POST['municipio'] : '';
$ciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$fechaReporte = date("d") . "/" . date("m") . "/" . date("Y");
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';
$usuario=(isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO reportes (usuario, descripcion, municipio, ciudad, direccion, fechaReporte, estatus) VALUES('$usuario', '$descripcion', '$municipio', '$ciudad', '$direccion', '$fechaReporte', '$estatus') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, descripcion, municipio, ciudad, direccion, fechaReporte, estatus FROM reportes ORDER BY id DESC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
         //$consulta = "SELECT id, nombre, apellido FROM usuarios WHERE email='$email' ";       

         $consulta = "UPDATE reportes SET usuario='$usuario', descripcion='$descripcion', municipio='$municipio', ciudad='$ciudad', direccion='$direccion', fechaReporte='$fechaReporte', estatus='$estatus' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, usuario, descripcion, municipio, ciudad, direccion, fechaReporte, estatus FROM reportes WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        break;        
    case 3://baja
        $consulta = "DELETE FROM reportes WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;       
    case 4: //modificación status
        $consulta = "UPDATE reportes SET estatus='$estatus' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, usuario, municipio, ciudad, direccion, fechaReporte, descripcion, estatus FROM reportes WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;  
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
