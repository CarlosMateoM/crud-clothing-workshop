<?php 
  
    include("../conexion.php");
    include("../menu.html");
    $con=conectar();

    $sql="SELECT * FROM productos";
    $query=mysqli_query($con,$sql);
    $result = mysqli_query($con,$sql) or die ('No pudo conectar a la consulta');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> Productos </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script>
        $(document).ready(function() {
        $('#municipios').DataTable({
            "lengthMenu": [[5,10,50,-1],[5,10,50,"All"]]
        });
        } );
    </script>
</head>
<script type="text/javascript">
        function confirmDelete()
        {

        var respuesta = confirm("Seguro que desea borrar?");
         if (respuesta==true)
        {
            alert("Registro Borrado");
            return true;
        }
        else
        {
            alert("Ha decidido no borrar el registro");
            return false;
        }
        } 
    </script>
    <body>
        
    <div class="container mt-5">
                    <div class="row"> 
                        <div class="col-md-3">
                        <h1><span class="badge bg-success">Agregar Prenda</span></h1>
                                <form action="../insert/insert_producto.php" method="POST">
                                    
                                    <input type="text" class="form-control mb-3" name="idP" placeholder="Codigo Producto">
                                    <input type="text" class="form-control mb-3" name="nom" placeholder="Nombre">
                                    <input type="text" class="form-control mb-3" name="tal" placeholder="Talla">
                                    <input type="text" class="form-control mb-3" name="num" placeholder="Numero (Opcional)">
                                    <input type="text" class="form-control mb-3" name="obs" placeholder="Observacion">
                                    <input type="text" class="form-control mb-3" name="idD" placeholder="ID Detalles Factura">
                                    <!--select name="Detalles_factura" id="" style="width:260px;border:1px solid #04467E;background-color:#DDFFFF;color:#2D4167;font-size:18px"-->
                                   
                                    <input type="submit" class="btn btn-primary" value="Registrar">
                                </form>
                        </div>
                        
                        <div class="col-md-8">
                            <table class="table caption-top">
                                <thead class="table-danger table-striped border-bottom" >
                                    <tr align="center">
                                        <th color=green>Codigo</th>
                                        <th>ID Producto</th>
                                        <th>Nombre</th>
                                        <th>Talla</th>
                                        <th>Numero</th>
                                        <th>Observacion</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($query))
                                            {
                                        ?>
                                            <tr>
                                                <th><?php  echo $row['id_producto']?></th>
                                                <th><?php  echo $row['nombre']?></th>
                                                <th><?php  echo $row['talla']?></th> 
                                                <th><?php  echo $row['numero']?></th>
                                                <th><?php echo $row['observacion']?></th>
                                                <th><?php echo $row['id_detalles']?></th>
                                                <th align="center"><a href="actualizar_mun.php?codigo_mun_=<?php echo $row['0'] ?>"> <button type="button" class="btn btn-info">Editar</button></a></th>
                                                <th align="center"><a href="delete_mun.php?codigo_mun_=<?php echo $row['0'] ?>"> <button type="button"  class="btn btn-danger" onclick="return confirmDelete()">Eliminar</button></a></th>                                        
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
    </body>
</html>