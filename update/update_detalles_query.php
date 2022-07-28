<?php

include("../conexion.php");
$con=conectar();

$id_factura = $_POST['id_factura'];
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];

$id_detalle=$_POST['id_detalle'];
$cantidad=$_POST['cantidad'];
$valor_unitario=$_POST['valor_unitario'];
$descripcion = $_POST['descripcion'];
$subtotal = $cantidad * $valor_unitario;

$sql = "UPDATE `detalles_factura` SET `cantidad`='$cantidad',`descripsion`='$descripcion',`valor_unicario`='$valor_unitario',`subtotal`='$subtotal' WHERE id_detalles = ".$id_detalle;

echo $sql;

$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: ../pages/facturas_page.php?id_factura=$id_factura&nombre=$nombre&fecha=$fecha");
 
    }
?>