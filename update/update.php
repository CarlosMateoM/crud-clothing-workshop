<?php

include("../conexion.php");
$con=conectar();

$id_client=$_POST['id_cliente'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];


$sql="UPDATE cliente SET  id_cliente='$id_client',nombre='$nombre',telefono='$telefono' WHERE id_cliente='$id_client'";

$query=mysqli_query($con,$sql);

    if($query){
        header("Location: ../pages/clientes_page.php");
    }
?>