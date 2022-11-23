<!DOCTYPE html>
<script src="test.js"></script>
<?php
    include("conexion.php");
    if(isset($_POST["insert_img"])){
        $name = $_POST["nombre_img"];
        
        if($_FILES["ruta_img"]["error"] == 4){
          echo
          "<script> alert('Image Does Not Exist'); </script>"
          ;
        }
        else{
          $fileName = $_FILES["ruta_img"]["name"];
          $fileSize = $_FILES["ruta_img"]["size"];
          $tmpName = $_FILES["ruta_img"]["tmp_name"];
      
          $validImageExtension = ['jpg', 'jpeg', 'png'];
          $imageExtension = explode('.', $fileName);
          $imageExtension = strtolower(end($imageExtension));
          if ( !in_array($imageExtension, $validImageExtension) ){
            echo
            "
            <script>
              alert('Invalid Image Extension');
            </script>
            ";
          }
          else if($fileSize > 1000000){
            echo
            "
            <script>
              alert('Image Size Is Too Large');
            </script>
            ";
          }
          else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
      
            move_uploaded_file($tmpName, 'imagenes/' . $newImageName);
            $query = "INSERT INTO IMAGENES VALUES('', '$name', '$newImageName')";
            sqlsrv_query($conn, $query);
            echo
            "
            <script>
              alert('Successfully Added');
              document.location.href = 'imagenes.php';
            </script>
            ";
          }
        }
      }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes</title>
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
        <h1>Imagenes</h1>

        <form method="POST" action="imagenes.php" enctype="multipart/form-data" >
            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" name="nombre_img" class="form-control" placeholder="Escriba el nombre de la imagen"><br />
            </div>
            <div class="form-group">
<!--                 <label for="">Ruta:</label>
                <input type="text" name="ruta_img" class="form-control" placeholder="Escriba el nombre de categoria"><br /> -->
                <label for="">Ruta:</label>
                <input type="file" id="image" name="ruta_img" accept=".jpg, .jpeg, .png ">
            </div>

            <div class="form-group">
                <input type="submit" name="insert_img" class="btn btn-warning" value="Insertar imagen."><br />
            </div>
        </form>
        <a href="verImagenes.php"> Ver Imagenes</a>
    </div>
<br /><br/> <br/>

    <?php
        /* $name = $_GET['nombre']; */

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

            
        
            /* if($_FILES["imageimage"]["error"] == 4){
            echo
            "<script> alert('Image Does Not Exist'); </script>"
            ;
            }
            else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
        
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if ( !in_array($imageExtension, $validImageExtension) ){
                echo
                "
                <script>
                alert('Invalid Image Extension');
                </script>
                ";
            }
            else if($fileSize > 1000000){
                echo
                "
                <script>
                alert('Image Size Is Too Large');
                </script>
                ";
            }
            else{
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;
        
                move_uploaded_file($tmpName, 'imagenes/' . $newImageName);
                $query = "INSERT INTO IMAGENES VALUES('', '$nombre_imagen', '$newImageName')";
                sqlsrv_query($conn, $query);
                echo
                "
                <script>
                alert('Successfully Added');
                document.location.href = 'imagenes.php';
                </script>
                ";
            }
            }
             */
            
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
            $i = 1;
            $rows = sqlsrv_query($conn, "SELECT * FROM IMAGENES ORDER BY Id_Imagen DESC")
            ?>
    
            
            <?php
                $consulta = "SELECT * FROM IMAGENES ORDER BY Id_Imagen DESC";
                
                
                $ejecutar = sqlsrv_query($conn, $consulta);
                
                $i = 0;
                
                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Imagen'];
                    $NombreImg = $fila['Nombre'];
                    $Ruta = $fila['Ruta'];
                    
                    $i++;

            ?>
            <tr align="center">
                <td><?php echo $id?></td>
                <td><?php echo $fila['Nombre']?></td>
                <td><img src="imagenes/<?php echo $fila['Ruta']; ?>" width = 200 title="<?php echo $Ruta; ?>"> </td>
                <td> <?php echo $Ruta?></td>
                <td><a href="imagenes.php?editar=<?php echo $id;?>">Editar</a></td>
                <td><a href="imagenes.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr>

            <?php } ?>
            
        </table>
    </div>
    
    <?php
        if(isset($_GET['editar'])){
            include("editar/editar_imagenes.php");
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






