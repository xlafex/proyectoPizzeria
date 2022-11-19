<?php

    
        $serverName = "localhost\SQLEXPRESS1";

        $connectionInfo = array("Database"=>"PITZERIA", "CharacterSet"=>"UTF-8");

        //$con = sqlsrv_connect($serverName, $connectionInfo);
        $conn = sqlsrv_connect($serverName, $connectionInfo);

        if(!$conn){
            echo "fallo en conexion";
            
        }else{
            echo "conexion exitosa";
        }
    

?>