<?php
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Imagenes</title>
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
  </head>
  <body>
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

            <?php foreach ($rows as $row): ?>
            <tr align="center">
                <td><?php echo $i++; ?></td>
                <td><?php echo $row["Nombre"]; ?></td>
                <td><img src="imagenes/<?php echo $row['Ruta']; ?>" width = 200 title="<?php echo $row['Ruta']; ?>"> </td>
                <td><?php echo $row['Ruta']?></td>
                <td><a href="imagenes.php?editar=<?php echo $row['Id_Imagen'];?>">Editar</a></td>
                <td><a href="imagenes.php?borrar=<?php echo $row['Id_Imagen'];?>">Borrar</a></td>
            </tr>

            
            <?php endforeach; ?>
        </table>
    </div>
  </body>
</html>