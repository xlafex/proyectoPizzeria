<!DOCTYPE html>
<?php
use Sabberworm\CSS\Value\Value;
    include("conexion.php");
    $sql = "SELECT * FROM CLIENTES";
    $all_clients = sqlsrv_query($conn,$sql);

    $sql_prod = "SELECT * FROM PRODUCTOS";
    $all_products = sqlsrv_query($conn,$sql_prod);

    $idVentaActual = 12;

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
        <h1>Ventas</h1>
        <div class="historialVentas">
            <p class="btn btn-warning"><a href="ventasExtra/historialVentas.php">Ver Historial de Ventas</a></p>
        </div>
        <br/>
        <div class="ventasDelDia">
            <p class="btn btn-warning"><a href="ventasExtra/ventasDia.php">Ver Ventas Diarias</a></p>
        </div>
        <br/>
        <div class="ventasDetalladas">
            <p class="btn btn-warning"><a href="ventasExtra/historialVentaDetallada.php">Ver Ventas Detalladas</a></p>
        </div>
            <form method="POST" action="ventas.php">
            <div class="form-group">
                <label for="">Cliente:</label>
                <select name="client" id="client" class="form-control">
                    <?php
                        while ($clients = sqlsrv_fetch_array(
                                $all_clients)):;
                    ?>
                        <option value="<?php echo $clients["Id_Cliente"];?>">
                            <?php echo $clients["Nombre"]?><p> </p> <?php echo $clients["Apellido"];?>
                        </option>
                    <?php
                        endwhile;
                        // While loop must be terminated
                    ?>
                </select>
            </div>    

            <div class="form-group">
                <label for="">Producto:</label>
                <select name="product" id="product" class="form-control">
                    <?php
                        while ($products = sqlsrv_fetch_array($all_products)):;
                    ?>
                        <option value="<?php echo $products["Id_Producto"];?>">
                            <?php echo $products["Nombre_Producto"]?> <p> , $</p> <?php echo $products["Precio"];?>
                        </option>
                    <?php
                        endwhile;                        
                    ?>                        
                </select>                    
            </div>
            <div class="form-group">
                <label for="">Cantidad:</label>
                <input type="number" name="cantidad" class="form-control" placeholder=""><br />
            </div>
            
            <div class="form-group">
                <input type="submit" name="insert_product_to_order" class="btn btn-warning" value="Insertar Producto a la Orden."><br />
            </div>
            <div class="form-group">
                <input type="submit" name="insert_venta" class="btn btn-warning" value="Generar Venta."><br />
            </div>
        </form>

    </div>
<br /><br/> <br/>

    <?php

        if(isset($_POST['insert_product_to_order'])){
            $producto = $_POST['product'];
            $cantidad = $_POST['cantidad'];
            
            $sql_producto = "SELECT * FROM PRODUCTOS where Id_Producto = $producto";
            $productosSQL = sqlsrv_query($conn,$sql_producto);
            $productos = sqlsrv_fetch_array($productosSQL);

            $precio = $productos['Precio'];

            $insertar_producto_orden = "INSERT INTO dbo.ORDEN_TEMPORAL(Id_Producto,Cantidad,Precio)VALUES('$producto', '$cantidad' , '$precio')";
            
            /* echo "<script>alert('$id_cat', '$nombr' , '$price' , '$desc','$id_img)</script>";
            exit; */
            $ejecutar = sqlsrv_query($conn, $insertar_producto_orden);

            if($ejecutar){
                echo "<script>alert('Producto agregado a la orden.')</script>";
            }

        }


        /* boton generar venta */
        if(isset($_POST['insert_venta'])){
           
            $idCliente = $_POST['client'];
            $precioTotal = 0;
            $todayDate = date("Y/m/d");

            $sql_orden_temp = "SELECT * FROM ORDEN_TEMPORAL";
            $all_ordentemp = sqlsrv_query($conn,$sql_orden_temp);

            $sql_idProd = "SELECT * FROM PRODUCTOS";
            $all_products = sqlsrv_query($conn,$sql_idProd);
            
            $i = 0;
            
            while($filaOrden = sqlsrv_fetch_array($all_ordentemp)){
                $cantidadTemp = $filaOrden['Cantidad'];
                $PrecioTemp = $filaOrden['Precio'];     
                /* $idProductoTemp = $filaOrden['Id_Producto'];   */
                $precioTotal += $cantidadTemp*$PrecioTemp;
                
                $i++;
                
            }      
            
            $insertVenta = "INSERT INTO dbo.VENTAS(Id_Cliente,Precio_Total,Fecha_Venta)VALUES('$idCliente', '$precioTotal' , '$todayDate')";
            
            $ejecutar = sqlsrv_query($conn, $insertVenta);
            
            

            /*  */
            $sql_getOrder = "SELECT * FROM ORDEN_TEMPORAL";
            $all_getOrdersTemps = sqlsrv_query($conn,$sql_getOrder);

            $checkLastVenta = "SELECT MAX(Id_Venta) as LastID from VENTAS;";
            
            $ejecutarLastVenta = sqlsrv_query($conn, $checkLastVenta);

            $LastIdVenta = sqlsrv_fetch_array($ejecutarLastVenta);
            /* $IdVentaUltimo = $filaIdVenta['LastID']; */
            $lastId = $LastIdVenta['LastID'];

            $y=0;
            while($filaOrdenTmp = sqlsrv_fetch_array($all_getOrdersTemps)){
                $cantidadTemp = $filaOrdenTmp['Cantidad'];
                $PrecioTemp = $filaOrdenTmp['Precio'];     
                $idProductoTemp = $filaOrdenTmp['Id_Producto'];  
                

                $insertVentaDetallada = "INSERT INTO dbo.VENTAS_DETALLADAS(Id_Venta,Id_Producto,Cantidad,Precio)VALUES('$lastId','$idProductoTemp', '$cantidadTemp' , '$PrecioTemp')";
            
                $ejecutarTemp = sqlsrv_query($conn, $insertVentaDetallada);
                if($ejecutarTemp){
                    echo "<script>alert('Venta detail added.')</script>";
                }
                $y++;
            }
            
            /* Al realizarse todos los procesos, se suma el idVentaActual para que el siguiente CLICK
            sea otra venta */
            
            if($ejecutar){
                echo "<script>alert('Venta realizada con exito.')</script>";
            }
        }

    ?>
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>ID_Orden</td>
                <td>Nombre del Producto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Acción</td><!-- solo podemos borrar productos de la orden -->
            </tr>

            <?php
                $consulta = "SELECT * from ORDEN_TEMPORAL";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $idOrden = $fila['Id_OrdenTemporal'];
                    $idProd = $fila['Id_Producto'];
                    $cant = $fila['Cantidad'];
                    $PrecioProd = $fila['Precio'];     
                    
                    $ConsultaNameProduct= "SELECT Nombre_Producto from PRODUCTOS where Id_Producto = $idProd";
                    $ejecutarNameProd = sqlsrv_query($conn, $ConsultaNameProduct);
                    $nombreProducto = sqlsrv_fetch_array($ejecutarNameProd);

                    $i++;
                

            ?>

            <tr align="center">
                <td><?php echo $idOrden?></td>
                <td><?php echo $nombreProducto['Nombre_Producto']?></td>
                <td><?php echo $cant?></td>
                <td><?php echo $PrecioProd?></td>                        
                <td><a href="ventas.php?borrar=<?php echo $idOrden;?>">Borrar</a></td>
            </tr>

            <?php } ?>

        </table>
    </div>

<?php
        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from ORDEN_TEMPORAL where Id_OrdenTemporal='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Producto eliminado de la orden.')</script>";
                echo "<script>window.open('ventas.php','_self')</script>";
            }
    
        }
?>   

<?php
        if(isset($_GET['editar'])){
            include("editar/editar_clientes.php");
        }

?>

</body>
</html>






