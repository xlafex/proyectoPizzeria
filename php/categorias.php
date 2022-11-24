<!DOCTYPE html>
<?php
    include("conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../librerias/bootstrap/css/bootstrap.css">
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
                <p><a href="ventas.php">Ventas</a></p>
            </div>
        </nav>
    </header>
    </header>
    <div class="col-md-8 col-md-offset-2">
        <h1>Categorias</h1>

        <form method="POST" action="categorias.php">
            <div class="form-group">
                <label for="">Nombre categoria:</label>
                <input type="text" name="nombre_cat" class="form-control" placeholder="Escriba el nombre de categoria"><br />
            </div>
            <div class="form-group">
                <label for="">Activa:</label>
                <select name="activa" id="active" class="form-control">
                    <option value="Y">Si</option>
                    <option value="N">No</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="insert" class="btn btn-warning" value="Insertar categoria."><br />
            </div>
        </form>

    </div>
<br /><br/> <br/>

    <?php

        if(isset($_POST['insert'])){
            $nombre_categ = $_POST['nombre_cat'];
            $activ = $_POST['activa'];

            //change (id_cliente), it needs to be auto incremental in the DB so we can delete the parameter
            // and make it increment automatically.
            $insertar = "INSERT INTO dbo.CATEGORIAS(Nombre_Categoria,Activa)VALUES('$nombre_categ', '$activ')";
            
            $ejecutar = sqlsrv_query($conn, $insertar);

            if($ejecutar){
                echo "<h3>Insertado correctamente</h3>";
            }

        }

    ?>
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>Id_Categoria</td>
                <td>Nombre de Categoria</td>
                <td>Activa</td>
                <td>Acción</td>
                <td>Acción</td>
            </tr>

            <?php
                $consulta = "SELECT * from CATEGORIAS";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Categoria'];
                    $NombreCat = $fila['Nombre_Categoria'];
                    $Activ = $fila['Activa'];
                    
                    $i++;
                

            ?>

            <tr align="center">
                <td><?php echo $id?></td>
                <td><?php echo $NombreCat?></td>
                <td><?php echo $Activ?></td>
                <td><a href="categorias.php?editar=<?php echo $id;?>">Editar</a></td>
                <td><a href="categorias.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr>

            <?php } ?>

        </table>
    </div>
    
    <?php
        if(isset($_GET['editar'])){
            include("editar/editar_categorias.php");
        }

    ?>

<?php
        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from CATEGORIAS where Id_Categoria='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Categoria eliminada.')</script>";
                echo "<script>window.open('categorias.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






