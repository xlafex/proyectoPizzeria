<?php
    $sql = "SELECT * FROM CATEGORIAS";
    $all_categories = sqlsrv_query($conn,$sql);

    $sql_img = "SELECT * FROM IMAGENES";
    $all_images = sqlsrv_query($conn,$sql_img);

   
        if(isset($_GET['editar'])){
            $editar_id = $_GET['editar'];
            
            $consulta = "SELECT * from PRODUCTOS where Id_Producto='$editar_id'";

            $ejecutar = sqlsrv_query($conn, $consulta);

            $fila = sqlsrv_fetch_array($ejecutar);

            $id = $fila['Id_Producto'];
            $NombreProducto = $fila['Nombre_Producto'];
            $PrecioProducto = $fila['Precio'];
            $DescProducto = $fila['Descripcion'];
            $IdCategoria = $fila['Id_Categoria'];


            $ConsultaCateg = "SELECT Nombre_Categoria from CATEGORIAS where Id_Categoria = $IdCategoria";
            $ejecutarcateg = sqlsrv_query($conn, $ConsultaCateg);
            $nombreCateg = sqlsrv_fetch_array($ejecutarcateg);


           
        }
?>

<br />

<div class="col-md-8 col-md-offset-2">
<form method="POST" action="productos.php">
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Nombre del Producto:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="nombre_product_tmp" class="form-control" value="<?php echo $NombreProducto; ?>"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Precio:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="precio_product_tmp" class="form-control" value="<?php echo $PrecioProducto; ?>"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Descripción:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="descripcion_product_tmp" class="form-control" value="<?php echo $DescProducto; ?>"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Categoria:</label>
                <select style="font-size:16px;font-family: 'Rubik', sans-serif;" name="categ_tmp" id="categ" class="form-control">
                    <!-- <option value="Y">Si</option>
                    <option value="N">No</option> -->
                    <?php

                        while ($category = sqlsrv_fetch_array(
                                $all_categories)):;
                    ?>
                        <option value="<?php echo $nombreCateg['Nombre_Categoria'];?>">
                            <?php echo $nombreCateg['Nombre_Categoria'];?>
                        </option>
                    <?php
                        endwhile;
                        // While loop must be terminated
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <input style="font-size:18px;font-family: 'Rubik', sans-serif;" type="submit" name="actualizar_producto" class="btn btn-warning" value="Actualizar Producto."><br />
            </div>
        </form>

</div>

<?php
    if(isset($_POST['actualizar_producto'])){
        $updateIdProd = $editar_id;
        $actualizar_nombreprod = $_POST['nombre_product_tmp'];
        $actualizar_precioprod = $_POST['precio_product_tmp'];
        $actualizar_descripcionprod = $_POST['descripcion_product_tmp'];
        $actualizar_categoriaprod = $_POST['categ_tmp'];


        $updateProducto = "UPDATE PRODUCTOS SET Nombre_Producto='$actualizar_nombreprod', Precio='$actualizar_precioprod' , Descripcion='$actualizar_descripcionprod', Id_Categoria='$actualizar_categoriaprod'  where Id_Producto='$updateIdProd'";

        $ejecutar = sqlsrv_query($conn, $updateProducto);

        if($ejecutar){
            echo "<script>alert('Datos actualizados.')</script>";
            echo "<script>window.open('../productos.php','_self')</script>";
        }

    }


?>





<!-- CODIGO -->
