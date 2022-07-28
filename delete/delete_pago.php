<?php

include("../conexion.php");
$con=conectar();

$id_pago=$_GET['id_pago'];

$sql="DELETE FROM pagos  WHERE id_pagos=".$id_pago;
echo $sql;

$query=mysqli_query($con,$sql);

if($query){  
    Header("Location:".$_SERVER['HTTP_REFERER']);
}
?>