<!DOCTYPE html>
<?php
    include("../conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../../librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
    <header>
        <nav class="menu">
        <div class="container">
                
                <img src="../../imagenes/logo2.png" alt="" width="150" height="75">
                <ul class="nav">
        </div>
            <div class="menudata">
                <p><a href="../clientes.php">Clientes</a></p>
                <p><a href="../categorias.php">Categorias</a></p>
                <p><a href="../historialProductos.php">Historial Productos</a></p>
                <p><a href="../productos.php">Producto</a></p>
                <p><a href="../index.php">Ventas</a></p>
            </div>
        </nav>
    </header>
    <div class="col-md-8 col-md-offset-2">
        <h1>Historial de Ventas Detalladas</h1>
        <p><a href="../index.php">Regresar.</a></p>
    </div>
<br /><br/> <br/>

    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>Id_Detalle</td>
                <td>Id_Venta</td>
                <td>Nombre del Producto</td>
                <td>Descripcion</td>
                <td>Cantidad</td>
                <td>Precio Unitario</td>
                <td>Precio X Cantidad</td>
                <td>Id_Producto</td>
                <td>Id_Categoria</td>
            </tr>

            <?php
                $consulta = "SELECT * from VentaDeProducto1";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $idDetalle = $fila['Id_Detallada'];
                    $idVenta = $fila['Id_Venta'];
                    $Cantidad = $fila['Cantidad'];
                    $Precio = $fila['Precio'];
                    $PrecioxCant = $Cantidad * $Precio; /* $fila['Precio x Cantidad']; *//*  */
                    $IdProducto = $fila['Id_Producto'];
                    $IdCateg = $fila['Id_Categoria'];/*  */
                    $NombreProd = $fila['Nombre_Producto'];/*  */
                    $Descripcion = $fila['Descripcion'];/*  */



                    $i++;
            ?>

            <tr align="center">
                <td><?php echo $idDetalle?></td>
                <td><?php echo $idVenta?></td>
                <td><?php echo $NombreProd?></td>
                <td><?php echo $Descripcion?></td>
                <td><?php echo $Cantidad?></td>
                <td><?php echo $Precio?></td>
                <td><?php echo $PrecioxCant?></td>
                <td><?php echo $IdProducto?></td>
                <td><?php echo $IdCateg?></td>
                
            </tr>

            <?php } ?>

        </table>
    </div>
    


</body>
</html>






