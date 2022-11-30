<?php
        if(isset($_GET['editar'])){
            $editar_id = $_GET['editar'];

            $consulta = "SELECT * from CATEGORIAS where Id_Categoria='$editar_id'";

            $ejecutar = sqlsrv_query($conn, $consulta);

            $fila = sqlsrv_fetch_array($ejecutar);

            $NombreCat = $fila['Nombre_Categoria'];
            $Activ = $fila['Activa'];
            
            //$selected = "";
            //if($Activ == 'Y'){echo "selected";}
        }
?>

<br />

<div class="col-md-8 col-md-offset-2">
        
        <form method="POST" action="categorias.php">
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Nombre categoria:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="nombre_cat" class="form-control" value="<?php echo $NombreCat; ?>"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Activa:</label>
                <select style="font-size:16px;font-family: 'Rubik', sans-serif;" name="activa" id="active" class="form-control" >
                    <option value="Y" <?php if($Activ == 'Y'){echo ", selected";} ?>>Si</option>
                    <option value="N" <?php if($Activ == 'N'){echo ", selected";} ?>>No</option>
                </select>
                
            </div>
            
            <div class="form-group">
                <input style="font-size:18px;font-family: 'Rubik', sans-serif;" type="submit" name="actualizar_cat" class="btn btn-warning" value="Actualizar categoria."><br />
            </div>
        </form>

</div>

<?php

    if(isset($_POST['actualizar_cat'])){
        $actualizar_nombrecategoria = $_POST['nombre_cat'];
        $actualizar_activo = $_POST['activa'];

        $consulta_cat = "UPDATE CATEGORIAS SET Nombre_Categoria='$actualizar_nombrecategoria' , Activa='$actualizar_activo' where Id_Categoria='$editar_id'";

        $ejecutar = sqlsrv_query($conn, $consulta_cat);

        if($ejecutar){
            echo "<script>alert('Datos actualizados.')</script>";
            //echo "<script>window.open('../categorias.php')</script>";
        }

    }


?>