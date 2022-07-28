<?php

include("../conexion.php");
include("../menu.html");

$con = conectar();
$id_factura = $_GET['id_factura'];

$sql = "SELECT f.id_factura,c.nombre,f.fecha FROM factura f JOIN cliente c on f.id_cliente=c.id_cliente";

$sql_productos;
$sql_pagos; 

if(!empty($id_factura)){
    $sql_productos = "SELECT * FROM `detalles_factura` WHERE id_factura = ".$id_factura;
    $sql_pagos = "SELECT * FROM `pagos` WHERE pagos.id_factura = ".$id_factura;
}else {
    $sql_productos = "SELECT * FROM `detalles_factura` WHERE id_factura = 0";
    $sql_pagos = "SELECT * FROM `pagos` WHERE pagos.id_factura = 0";
}

$query = mysqli_query($con, $sql);
$query_productos = mysqli_query($con, $sql_productos);
$query_pagos = mysqli_query($con, $sql_pagos);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Facturas</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="C:\Users\minic\OneDrive\Documents\Xampp\htdocs\crud_dataset\fontawesome/css/all.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href=" https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cliente').DataTable({
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]
            });
        });
    </script>
</head>
<script type="text/javascript">
    function confirmDelete() {

        var respuesta = confirm("Seguro que desea borrar?");
        if (respuesta == true) {
            alert("Registro Borrado");
            return true;
        } else {
            alert("Ha decidido no borrar el registro");
            return false;
        }
    }
</script>

<body>
    <div class="content">
        <div class="container mt-5">
            <div class="row">

                <div class="col-md-3">
                    <h1><span class="badge bg-warning">Nueva Factura</span></h1>
                    <form action="../insert/insert_factura.php" method="POST">

                        <input type="date" class="form-control mb-3" name="fec">
                        <input type="number" class="form-control mb-3" name="idc" placeholder="ID Cliente" required>
                        <input type="submit" class="btn btn-primary" value="Registrar">

                    </form>
                </div>

                <div class="col-md-8">
                    <table id="Factura" class="table table-dark table-striped table-bordered shadow-lg mt-4" style="width:100%">
                        <thead class="bg-warning">
                            <tr align="center">
                                <th color=green>ID Factura</th>
                                <th>Cliente</th>
                                <th>Fecha De Compra</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                <th>Cargar</th>

                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <th><?php echo $row['id_factura'] ?></th>
                                    <th><?php echo $row['nombre'] ?></th>
                                    <th><?php echo $row['fecha'] ?></th>
                                    <th style="text-align:center"><a href="../update/update_factura.php?id_factura=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-info">Editar</button></a></th>
                                    <th style="text-align:center"><a href="../delete/delete_factura.php?id_factura=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-danger" onclick="return confirmDelete()">Eliminar</button></a></th>
                                    <th style="text-align:center"><a href="facturas_page.php?id_factura=<?php echo $row['id_factura'] ?>&nombre=<?php echo $row['nombre'] ?>&fecha=<?php echo $row['fecha'] ?>"> <button type="button" class="btn btn-light">Cargar</button></a></th>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- titulo de factura seleccionada  -->

            <div style="margin: 40 0" lass="row">
                <h1><span id="info_factura" class="badge bg-info" >Factura cargada: <?php echo $_GET['nombre']?> | <?php echo $_GET['fecha']?>  </span></h1>
            </div>

            <!-- formulario de productos  -->

            <div class="row">

                <div class="col-md-3">
                    <h1><span class="badge bg-warning">Nuevo Producto</span></h1>
                    <form action="../insert/insert_detalles.php" method="POST">

                        <input id="id_fact" style="display: none;" class="form-control mb-3" name="id_factura" value="<?php echo $_GET['id_factura'] ?>">
                        <input type="number" class="form-control mb-3" name="id_producto" placeholder="ID Producto">
                        <input type="number" class="form-control mb-3" name="cantidad" placeholder="Cantidad">
                        <input type="number" class="form-control mb-3" name="valor_unitario" placeholder="Valor Unitario">
                        <textarea class="form-cotrol mb-3" name="descripcion" placeholder="Descripcion" cols="32" rows="10" maxlength="200"></textarea>

                        <input type="submit" class="btn btn-primary" value="Registrar">

                    </form>
                </div>

            <!--cargue de productos-->

                <div class="col-md-8">
                    <table id="Factura" class="table table-dark table-striped table-bordered shadow-lg mt-4" style="width:100%">
                        <thead class="bg-warning">
                            <tr align="center">
                                <th color=green>ID Producto</th>
                                <th>Cantidad</th>
                                <th>Valor Unitario</th>
                                <th>Descripcion</th>
                                <th>Subtotal</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query_productos)) {
                            ?>
                                <tr>
                                    <th><?php echo $row['id_detalles'] ?></th>
                                    <th><?php echo $row['cantidad'] ?></th>
                                    <th><?php echo $row['valor_unicario'] ?></th>
                                    <th><?php echo $row['descripsion'] ?></th>
                                    <th><?php echo $row['subtotal'] ?></th>

                                    <th style="text-align:center"><a href="actualizar.php?id_factura=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-info"><i class="fa-solid fa-pencil"></i></button></a></th>

                                    <th style="text-align:center"><a href="../delete/delete_detalle.php?id_detalle=<?php echo $row['id_detalles'] ?>"> <button type="button" class="btn btn-danger" onclick="return confirmDelete()"><i class="fa-solid fa-trash-can"></i></button></a></th>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- formulario de pagos  -->

            <div class="row">

                <div class="col-md-3">
                    <h1><span class="badge bg-warning">Nuevo Pago</span></h1>
                    <form action="../insert/insert_pagos.php" method="POST">

                        <input id="id_fact" style="display: none;" class="form-control mb-3" name="id_factura" value="<?php echo $_GET['id_factura'] ?>">
                        <input type="number" class="form-control mb-3" name="id_pago" placeholder="ID Pago">
                        <input type="date" class="form-control mb-3" name="fecha" placeholder="Fecha">
                        <input type="text" class="form-control mb-3" name="forma_pago" placeholder="Forma De Pago">
                        <input type="number" class="form-control mb-3" name="monto" placeholder="Monto">
                        <input type="submit" class="btn btn-primary" value="Registrar">

                    </form>
                </div>

            <!--cargue de pagos-->

                <div class="col-md-8">
                    <table id="Factura" class="table table-dark table-striped table-bordered shadow-lg mt-4" style="width:100%">
                        <thead class="bg-warning">
                            <tr align="center">
                                <th color=green>ID Pago</th>
                                <th>Fecha</th>
                                <th>Forma Pago</th>
                                <th>Monto</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query_pagos)) {
                            ?>
                                <tr>
                                    <th><?php echo $row['id_pagos'] ?></th>
                                    <th><?php echo $row['fecha'] ?></th>
                                    <th><?php echo $row['forma_pago'] ?></th>
                                    <th><?php echo $row['monto'] ?></th>
                                    <th style="text-align:center"><a href="actualizar.php?id_pago=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-info">Editar</button></a></th>
                                    <th style="text-align:center"><a href="../delete/delete_pago.php?id_pago=<?php echo $row['id_pagos'] ?>"> <button type="button" class="btn btn-danger" onclick="return confirmDelete()">Eliminar</button></a></th>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    </div>
</body>

</html>