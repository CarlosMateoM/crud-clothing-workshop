<?php 
  
    include("../conexion.php");
    include("../menu.html");
    
    $con=conectar();

    $sql="SELECT * FROM cliente";
    $query=mysqli_query($con,$sql);
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Clientes</title>
     
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <div class="content">
    
    
            <div class="container mt-5">
                    <div class="row"> 
                        
                        <div class="col-md-3">
                        <h1><span class="badge bg-warning">Nuevo Cliente</span></h1>
                        
                                <form action="../insert/insert_cliente.php" method="POST">

                                    <!--input type="number" class="form-control mb-3" name="id" placeholder="ID Cliente" required-->
                                    <input type="text" class="form-control mb-3" name="Nom" placeholder="Nombre" required>
                                    <input type="number" class="form-control mb-3" name="Tel" placeholder="Telefono" required>
                                    
                                    <input type="submit" class="btn btn-primary" value="Registrar">
                                     
                                </form> 
                                
                        </div>

                        <div class="col-md-8">
                             <table id="Clientes" class="table table-dark table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                <thead class="bg-warning">
                                    <tr align="center">
                                        <th color=green>ID Cliente</th>
                                        <th>Nombre</th>
                                        <th>Telefono</th>
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
                                                <th><?php  echo $row['id_cliente']?></th>
                                                <th><?php  echo $row['nombre']?></th>
                                                <th><?php  echo $row['telefono']?></th> 
                                                <th style="text-align:center"><a href="../update/update_cliente.php?id_cliente=<?php echo $row['id_cliente'] ?>"> <button type="button" class="btn btn-info"><i class="fa-solid fa-pencil"></i></button></a></th>
                                                <th style="text-align:center"><a href="../delete/delete_cliente.php?id_cliente=<?php echo $row['id_cliente'] ?>"> <button type="button"  class="btn btn-danger" onclick="return confirmDelete()"><i class="fa-solid fa-trash-can"></i></button></a></th>                                        
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