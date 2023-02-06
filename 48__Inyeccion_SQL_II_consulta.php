<?php

require("00_conexion_a_base_de_datos.php");

$conexion = mysqli_connect($db_host, $db_usuario, $db_clave);

// $busqueda = $_GET['buscar']; // informacion del cuadrode texto  [name=buscar] del formulario 
// $busqueda = "martillo"; // informacion del cuadrode texto  [name=buscar] del formulario 
$busqueda = mysqli_real_escape_string($conexion, $_GET["buscar"]); // evitando inyecion sql, escapando los caracteres especiales [ mysqli_real_escape_string()]



mysqli_select_db($conexion, $db_nombre) or die("Error: No se pudo conectar a  la Base de datos ");
echo "Conección éxitosa a Base de datos ==>" . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($conexion) . PHP_EOL;
echo "<br /><br /><br />";

mysqli_set_charset($conexion, "utf8");

$query = "SELECT * FROM  productos where CODIGOARTICULO = '$busqueda' "; // comodin( % )con la palabra MYSQL like
// $query = "SELECT * FROM  productos where nombrearticulo like '%$busqueda%' "; // comodin( % )con la palabra MYSQL like

$resultado_query = mysqli_query($conexion, $query);



if (mysqli_affected_rows($conexion) == 0) { //verificacion si existe registro en ase de datos
    echo "No existe ese codigo de articulo : ";
    exit("======= Consulta fallida =======");
} else {

    while ($fila = mysqli_fetch_row($resultado_query)) { // recorres el resulset  de l resultado de la cunsulta
        echo "======= Consulta Exitosa =======";
        echo "<table width='70%' align='center' border='1'>";
        echo "<tr><td  align='center'>$fila[0]</td>";
        echo "<td  align='center' >$fila[1]</td>";
        echo "<td  align='center'>$fila[2]</td>";
        echo "<td  align='center'>$fila[3]</td>";
        echo "<td  align='center'>$fila[4]</td>";
        echo "<td  align='center'>$fila[5]</td>";
        echo "<td  align='center'>$fila[6]</td></tr></table>";
    }
    mysqli_free_result($resultado_query); // liberar memoria del resultado de la busqueda
    ;
}
;








?>
