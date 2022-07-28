<?php

include("../conexion.php");
$con=conectar();

$id_detalle=$_GET['id_detalle'];

$sql="DELETE FROM detalles_factura  WHERE id_detalles=".$id_detalle;
echo $sql;

$query=mysqli_query($con,$sql);

if($query){  
    Header("Location:".$_SERVER['HTTP_REFERER']);
}
?>