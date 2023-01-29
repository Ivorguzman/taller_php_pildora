<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>title</title>
    <!-- <link rel="stylesheet" href="linkToCSS" /> -->

    <?php
    function ejecuta_consulta($laBuequeda) // parametro para el criterio de busqueda en sentencia SQL
    
    {

        require("00_conexion_a_base_de_datos.php");

        $conexion = mysqli_connect($db_host, $db_usuario, $db_clave);
        mysqli_select_db($conexion, $db_nombre) or die("Error: No se pudo conectar a  la Base de datos ");

        echo "Conexion establecida ==> " . mysqli_get_host_info($conexion);
        echo "<br>";
        echo $_SERVER['SERVER_NAME'];
        echo "<br>";
        echo $_SERVER['HTTP_HOST'];
        echo "<br>";
        echo $_SERVER['HTTP_REFERER'];
        echo "<br>";
        echo $_SERVER['HTTP_USER_AGENT'];
        echo "<br>";
        echo $_SERVER['SCRIPT_NAME'];
        echo ("<br /><br /><br />");
     

        mysqli_set_charset($conexion, "utf8");

        $query = "SELECT * FROM  productos where nombrearticulo like '%$laBuequeda%' "; // sentencia SQL con la palabra like y el comodin( % )   
        $resultado_query = mysqli_query($conexion, $query);

        while ($fila = mysqli_fetch_row($resultado_query)) {
            echo "<table  width='70%' align='center' border=1> <tr><td>";
            echo $fila[0] . "</td><td>";
            echo $fila[1] . "</td><td>";
            echo $fila[2] . "</td><td>";
            echo $fila[3] . "</td><td>";
            echo $fila[4] . "</td><td>";
            echo $fila[5] . "</td><td>";
            echo $fila[6];
            echo "</tr></table>";
            echo "<br />";
        }
        ;
    }
    ;

    ?>
</head>

<body>
    <?php

    $mibusqueda = $_GET["buscar"];

    $mismaPagina = $_SERVER["PHP_SELF"]; //Información del entorno del servidor y de ejecución ==> Enviar la informaiona la misma pagina["PHP_SELF"]
    

    //SI ES NO NULO(NO ESTA VACIA) EJECUTA CONSULTA O RENDERIZA FORMULARIO
    if ($mibusqueda != NULL) {
        ejecuta_consulta($mibusqueda); // invoca funcion que ejecuta la cosulata con parameto $mibusqueda
    
    } else {
        echo ("<form action='" . $mismaPagina . "' method='get'>
                <label> Buscar:<input type='text' name='buscar'></label>
                <input type='submit' name='enviando' value='!Dale'>
              </form>");

    }
    ;




    ?>

</body>

</html>
