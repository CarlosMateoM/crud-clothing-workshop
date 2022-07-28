<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>


    <?php
    include("../conexion.php");
    $con = conectar();
    $id_factura = $_POST['id_factura'];
    $id_pago = $_POST['id_pago'];
    $fecha = $_POST['fecha'];
    $forma_pago = $_POST['forma_pago'];
    $monto = $_POST['monto'];
    


    if (empty($id_factura)) {
        echo '<div class="container">
      <div class="row">
     <div class="col-md-3  col-sm-6 col-xs-12">';
        echo '<div class="alert alert-danger" role="alert"> ID de cliente VACIO </div>';
        echo '<th><input type="button" value="Página anterior" onClick="history.go(-1);"></th>';
        echo '</div>
</div>
</div>';
    } else {
        $sql = "INSERT INTO `pagos`(`id_pagos`, `fecha`, `forma_pago`, `monto`, `id_factura`) VALUES ('$id_pago','$fecha','$forma_pago',$monto,'$id_factura')";
        $query = mysqli_query($con, $sql);

        if ($query) {

            header("Location:" . $_SERVER['HTTP_REFERER']);
        } else {
            echo '<div class="container">
        <div class="row">
        <div class="col-md-3  col-sm-6 col-xs-12">';
            echo '<div class="alert alert-warning" role="alert"> Error en el Ingreso del registro </div>';
            echo '<th><input type="button" value="Página anterior" onClick="history.go(-1);"></th>';
            echo '</div>
        </div>
        </div>';
        }
    }

    ?>
</body>
