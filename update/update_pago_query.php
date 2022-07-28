<?php

include("../conexion.php");
$con=conectar();

$id_factura = $_POST['id_factura'];
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];

$id_pago=$_POST['id_pago'];
$fecha=$_POST['fecha'];
$forma_pago=$_POST['forma_pago'];
$monto = $_POST['monto'];

$sql = "UPDATE `pagos` SET `fecha`='$fecha',`forma_pago`='$forma_pago',`monto`='$monto' WHERE `id_pagos` = ".$id_pago;

echo $sql;

$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: ../pages/facturas_page.php?id_factura=$id_factura&nombre=$nombre&fecha=$fecha");
 
    }
?>