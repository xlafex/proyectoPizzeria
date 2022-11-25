<!DOCTYPE html>
<?php
use Sabberworm\CSS\Value\Value;
    include("conexion.php");
    $sql = "SELECT * FROM CATEGORIAS";
    $all_categories = sqlsrv_query($conn,$sql);

    $sql_img = "SELECT * FROM IMAGENES";
    $all_images = sqlsrv_query($conn,$sql_img);
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
                <p><a href="historialProductos.php">Historial Productos</a></p>
                <p><a href="productos.php">Producto</a></p>
                <p class="btn btn-warning"><a href="index.php">Ventas</a></p>
            </div>
        </nav>
    </header>
    <div class="col-md-8 col-md-offset-2">
        <h1>Productos</h1>

        <form method="POST" action="productos.php">
            <div class="form-group">
                <label for="">Nombre del Producto:</label>
                <input type="text" name="nombre_product" class="form-control" placeholder="Escriba el nombre del producto."><br />
            </div>
            <div class="form-group">
                <label for="">Precio:</label>
                <input type="text" name="precio_product" class="form-control" placeholder="Escriba el Precio del producto."><br />
            </div>
            <div class="form-group">
                <label for="">Descripción:</label>
                <input type="text" name="descripcion_product" class="form-control" placeholder="Escriba la Descripción del producto."><br />
            </div>
            <div class="form-group">
                <label for="">Categoria:</label>
                <select name="categ" id="categ" class="form-control">
                    <!-- <option value="Y">Si</option>
                    <option value="N">No</option> -->
                    <?php

                        while ($category = sqlsrv_fetch_array(
                                $all_categories)):;
                    ?>
                        <option value="<?php echo $category["Id_Categoria"];?>">
                            <?php echo $category["Nombre_Categoria"];?>
                        </option>
                    <?php
                        endwhile;
                        // While loop must be terminated
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <input type="submit" name="insert_product" class="btn btn-warning" value="Insertar Producto."><br />
            </div>
        </form>

    </div>
<br /><br/> <br/>

    <?php

        if(isset($_POST['insert_product'])){
            $nombr = $_POST['nombre_product'];
            $price = $_POST['precio_product'];
            $desc = $_POST['descripcion_product'];
            $id_cat = $_POST['categ'];
            

            $insertar_producto = "INSERT INTO dbo.PRODUCTOS(Id_Categoria,Nombre_Producto,Precio,Descripcion)VALUES('$id_cat', '$nombr' , '$price' , '$desc')";
            
            /* echo "<script>alert('$id_cat', '$nombr' , '$price' , '$desc','$id_img)</script>";
            exit; */
            $ejecutar = sqlsrv_query($conn, $insertar_producto);

            if($ejecutar){
                echo "<script>alert('Producto agregado correctamente.')</script>";
            }

        }

    ?>
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>ID</td>
                <td>Nombre del Producto</td>
                <td>Precio</td>
                <td>Descripcion</td>
                <td>Categoria</td>
                <td>Activa</td>
                <td>Acción</td>
                <td>Acción</td>
            </tr>

            <?php
                $consulta = "SELECT * from ProductoCompleto1";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Producto'];
                    $NombreProducto = $fila['Nombre_Producto'];
                    $PrecioProducto = $fila['Precio'];
                    $DescProducto = $fila['Descripcion'];
                    $NomCateg = $fila['Nombre_Categoria'];
                    $Active = $fila['Activa'];


                    $i++;
                

            ?>

            <tr align="center">
                <td><?php echo $id?></td>
                <td><?php echo $NombreProducto?></td>
                <td><?php echo $PrecioProducto?></td>
                <td><?php echo $DescProducto?></td>
                <td><?php echo $NomCateg?></td>
                <td><?php echo $Active?></td>
                
                <td><a href="productos.php?editar=<?php echo $id;?>">Editar</a></td>
                <td><a href="productos.php?borrar=<?php echo $id;?>">Borrar</a></td>
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

            $borrar = "DELETE from PRODUCTOS where Id_Producto='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Producto eliminado.')</script>";
                echo "<script>window.open('productos.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






