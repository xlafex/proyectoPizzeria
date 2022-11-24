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
            $IdImagen = $fila['Id_Imagen'];

            $ConsultaCateg = "SELECT Nombre_Categoria from CATEGORIAS where Id_Categoria = $IdCategoria";
            $ejecutarcateg = sqlsrv_query($conn, $ConsultaCateg);
            $nombreCateg = sqlsrv_fetch_array($ejecutarcateg);


            $ConsultaImg = "SELECT Nombre from IMAGENES where Id_Imagen = $IdImagen";
            $ejecutarimagen = sqlsrv_query($conn, $ConsultaImg);
            $nombreImagen = sqlsrv_fetch_array($ejecutarimagen);

        }
?>

<br />

<div class="col-md-8 col-md-offset-2">
<form method="POST" action="productos.php">
            <div class="form-group">
                <label for="">Nombre del Producto:</label>
                <input type="text" name="nombre_product" class="form-control" value="<?php echo $NombreProducto; ?>"><br />
            </div>
            <div class="form-group">
                <label for="">Precio:</label>
                <input type="text" name="precio_product" class="form-control" value="<?php echo $PrecioProducto; ?>"><br />
            </div>
            <div class="form-group">
                <label for="">Descripción:</label>
                <input type="text" name="descripcion_product" class="form-control" value="<?php echo $DescProducto; ?>"><br />
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
                <label for="">Imagen:</label>
                <select name="imagen_product" id="img_product" class="form-control">
                    <?php

                        while ($image = sqlsrv_fetch_array(
                                $all_images)):;
                    ?>
                        <option value="<?php echo $nombreImagen['Nombre'];?>">
                            <?php echo $nombreImagen['Nombre'];?><!-- Campo Nombre de Tabla Imagen -->
                        </option>
                    <?php
                        endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="actualizar_producto" class="btn btn-warning" value="Actualizar Producto."><br />
            </div>
        </form>

</div>

<?php
    if(isset($_POST['actualizar_producto'])){
        $actualizar_nombreprod = $_POST['nombre_product'];
        $actualizar_precioprod = $_POST['precio_product'];
        $actualizar_descripcionprod = $_POST['descripcion_product'];
        $actualizar_categoriaprod = $_POST['categ'];
        $actualizar_imagenprod = $_POST['imagen_product'];

        $updateProducto = "UPDATE PRODUCTOS SET Nombre_Producto='$actualizar_nombreprod', Precio='$actualizar_precioprod' , Descripcion='$actualizar_descripcionprod', Id_Categoria='$actualizar_categoriaprod' , Id_Imagen='$actualizar_imagenprod' where Id_Producto='$editar_id'";

        $ejecutar = sqlsrv_query($conn, $updateProducto);

        if($ejecutar){
            echo "<script>alert('Datos actualizados.')</script>";
            echo "<script>window.open('../productos.php','_self')</script>";
        }

    }


?>





<!-- CODIGO -->
