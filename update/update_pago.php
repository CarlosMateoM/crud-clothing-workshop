<?php
include("../conexion.php");
$con = conectar();
$id_pago = $_GET['id_pago'];
$sql = "SELECT * FROM pagos WHERE id_pagos ='$id_pago'";

$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <title>Actualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">
        <form action="update_pago_query.php" method="POST">
            <input id="id_fact" style="display: none;" class="form-control mb-3" name="id_factura" value="<?php echo $_GET['id_factura'] ?>">
            <input id="id_fact" style="display: none;" class="form-control mb-3" name="nombre" value="<?php echo $_GET['nombre'] ?>">
            <input id="id_fact" style="display: none;" class="form-control mb-3" name="fecha" value="<?php echo $_GET['fecha'] ?>">
            <input id="id_fact" style="display: none;" class="form-control mb-3" name="id_pago" value="<?php echo $_GET['id_pago'] ?>">

            <input type="date" class="form-control mb-3" name="fecha" placeholder="Fecha" value="<?php echo $row['fecha'] ?>">
            <input type="text" class="form-control mb-3" name="forma_pago" placeholder="Forma De Pago" value="<?php echo $row['forma_pago'] ?>">
            <input type="number" class="form-control mb-3" name="monto" placeholder="Monto" value="<?php echo $row['monto'] ?>">

            <input type="submit" class="btn btn-primary btn-block" value="Actualizar">
        </form>

    </div>
</body>

</html>