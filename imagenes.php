<!DOCTYPE html>
<?php
    include("conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes</title>
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="col-md-8 col-md-offset-2">
        <h1>Imagenes</h1>

        <form method="POST" action="imagenes.php" >
            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" name="nombre_img" class="form-control" placeholder="Escriba el nombre de la imagen"><br />
            </div>
            <div class="form-group">
<!--                 <label for="">Ruta:</label>
                <input type="text" name="ruta_img" class="form-control" placeholder="Escriba el nombre de categoria"><br /> -->
                <label for="">Ruta:</label>
                <input type="file" id="rutaimg" name="ruta_img" accept="image/png, image/jpeg">
            </div>

            <div class="form-group">
                <input type="submit" name="insert_img" class="btn btn-warning" value="Insertar imagen."><br />
            </div>
        </form>

    </div>
<br /><br/> <br/>

    <?php

        if(isset($_POST['insert_img'])){
            $nombre_imagen = $_POST['nombre_img'];
            $route = $_POST['ruta_img'];

            //change (id_cliente), it needs to be auto incremental in the DB so we can delete the parameter
            // and make it increment automatically.
            $insertar = "INSERT INTO dbo.IMAGENES(Nombre,Ruta)VALUES('$nombre_imagen', '$route')";
            
            $ejecutar = sqlsrv_query($conn, $insertar);

            if($ejecutar){
                echo "<h3>Insertado correctamente</h3>";
            }

            /* if (($_FILES['ruta_img']['name']!="")){
                // Where the file is going to be stored
                    $target_dir = "imagenes/";
                    $file = $_FILES['ruta_img']['name'];
                    $path = pathinfo($file);
                    $filename = $path['filename'];
                    $ext = $path['extension'];
                    $temp_name = $_FILES['ruta_img']['tmp_name'];
                    $path_filename_ext = $target_dir.$filename.".".$ext;
                 
                // Check if file already exists
                if (file_exists($path_filename_ext)) {
                 echo "Archivo ya existe.";
                 }else{
                 move_uploaded_file($temp_name,$path_filename_ext);
                 echo "Imagen subida correctamente.";
                 }
                 
                } */
            
            
        }

    ?>

    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>Id_Imagen</td>
                <td>Nombre de Imagen</td>
                <td>Vista Previa</td>
                <td>Ruta</td>
                <td>Acción</td>
                <td>Acción</td>
            </tr>

            <?php
                $consulta = "SELECT * from IMAGENES";
                
                
                $ejecutar = sqlsrv_query($conn, $consulta);
                
                $i = 0;
                
                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Imagen'];
                    $NombreImg = $fila['Nombre'];
                    $Ruta = $fila['Ruta'];
                    
                    $sql = "SELECT Nombre from images where Id_Imagen ="+$id;
                    
                    $i++;
                    
                    $result = sqlsrv_query($conn,$sql);
                    $row = sqlsrv_fetch_array($result);

                    $image = $row['Nombre'];
                    $image_src = "imagenes/".$image;

                

            ?>

            <tr align="center">
                <td><?php echo $id?></td>
                <td><?php echo $NombreImg?></td>
                <td><img src=''></td>
                <td><?php echo $Ruta?></td>
                <td><a href="imagenes.php?editar=<?php echo $id;?>">Editar</a></td>
                <td><a href="imagenes.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr>

            <?php } ?>

        </table>
    </div>
    
    <?php
        if(isset($_GET['editar'])){
            include("editar_imagenes.php");
        }

    ?>

<?php
        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from IMAGENES where Id_Imagen='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Imagen eliminada.')</script>";
                echo "<script>window.open('imagenes.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






