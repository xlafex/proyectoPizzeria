<!DOCTYPE html>
<?php
    include("conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header>
        <nav class="menu">
            <div class="logo" id="logo">
                <h1 id="Pitzeria">Pitzeria</h1>
            </div>
            <div class="menudata">
                <p><a href="clientes.php">Clientes</a></p>
                <p><a href="categorias.php">Categorias</a></p>
                <p><a href="imagenes.php">Imagenes</a></p>
                <p><a href="productos.php">Producto</a></p>
                <p><a href="">Empleados</a></p>
                <p><a href="">Ventas</a></p>
            </div>
        </nav>
    </header>
    <div class="col-md-8 col-md-offset-2">
        <h1>Productos</h1>

        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="">Nombre del Producto:</label>
                <input type="text" name="nombre" class="form-control" placeholder="Escriba su nombre"><br />
            </div>
            <div class="form-group">
                <label for="">Precio:</label>
                <input type="text" name="apellido" class="form-control" placeholder="Escriba su apellido"><br />
            </div>
            <div class="form-group">
                <label for="">Descripción:</label>
                <input type="text" name="direccion" class="form-control" placeholder="Escriba su direccion"><br />
            </div>
            <div class="form-group">
                <label for="">Telefono:</label>
                <input type="text" name="telefono" class="form-control" placeholder="Escriba su telefono"><br />
            </div>
            <div class="form-group">
                <input type="submit" name="insert" class="btn btn-warning" value="Insertar cliente."><br />
            </div>
        </form>

    </div>
<br /><br/> <br/>

    <?php

        if(isset($_POST['insert'])){
            $nombr = $_POST['nombre'];
            $apell = $_POST['apellido'];
            $direcc = $_POST['direccion'];
            $telef = $_POST['telefono'];

            //change (id_cliente), it needs to be auto incremental in the DB so we can delete the parameter
            // and make it increment automatically.
            $insertar = "INSERT INTO dbo.CLIENTES(Nombre,Apellido,Direccion,Telefono)VALUES('$nombr', '$apell' , '$direcc' , '$telef')";
            
            $ejecutar = sqlsrv_query($conn, $insertar);

            if($ejecutar){
                echo "<h3>Insertado correctamente</h3>";
            }

        }

    ?>
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Direccion</td>
                <td>Telefono</td>
                <td>Acción</td>
                <td>Acción</td>
            </tr>

            <?php
                $consulta = "SELECT * from CLIENTES";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Cliente'];
                    $Nombre = $fila['Nombre'];
                    $Apellido = $fila['Apellido'];
                    $Direccion = $fila['Direccion'];
                    $Telefono = $fila['Telefono'];

                    $i++;
                

            ?>

            <tr align="center">
                <td><?php echo $id?></td>
                <td><?php echo $Nombre?></td>
                <td><?php echo $Apellido?></td>
                <td><?php echo $Direccion?></td>
                <td><?php echo $Telefono?></td>
                <td><a href="clientes.php?editar=<?php echo $id;?>">Editar</a></td>
                <td><a href="clientes.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr>

            <?php } ?>

        </table>
    </div>
    
    <?php
        if(isset($_GET['editar'])){
            include("editar/editar_productos.php");
        }

    ?>

<?php
        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from CLIENTES where Id_Cliente='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Cliente eliminado.')</script>";
                echo "<script>window.open('clientes.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






