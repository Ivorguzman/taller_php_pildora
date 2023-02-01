<?php

require("00_conexion_a_base_de_datos.php");

$conexion = mysqli_connect($db_host, $db_usuario, $db_clave);

// $busqueda = $_GET['buscar']; // informacion del cuadrode texto  [name=buscar] del formulario 
// $busqueda = "AR40"; // informacion del cuadrode texto  [name=buscar] del formulario  
$busqueda = mysqli_real_escape_string($conexion, $_GET["buscar"]); // evitando inyecion sql, escapando los caracteres especiales [ mysqli_real_escape_string()]

mysqli_select_db($conexion, $db_nombre) or die("Error: No se pudo conectar a  la Base de datos ");
echo "Conección éxitosa: MySQL ==>" . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($conexion) . PHP_EOL;
echo "<br /><br /><br />";

mysqli_set_charset($conexion, "utf8");

$query = "DELETE FROM productos WHERE CODIGOARTICULO = '$busqueda'";

$resultado_query = mysqli_query($conexion, $query); // consulta a la base de datos

$registro_afectado = mysqli_affected_rows($conexion); // cantidad de registros afectados

if ($resultado_query && $busqueda != null && $registro_afectado != 0) {
    echo "Registro Eliminado exitosamente  ==> " . $registro_afectado;

} else  {
    echo "No existe registro que eliminar,  Registros eliminados  ==> " . $registro_afectado;
}
;


// while ($fila = mysqli_fetch_row($resultado_query)) {
// 
//     echo "<table width='70%' align='center' border='1'>";
//     echo "<tr>
//     <td>$fila[0]</td>";
//     echo "<td>$fila[1]</td>";
//     echo "<td>$fila[2]</td>";
//     echo "<td>$fila[3]</td>";
//     echo "<td>$fila[4]</td>";
//     echo "<td>$fila[5]</td>";
//     echo "<td>$fila[6]</td>
//     </tr>
//     </table>";
// }





?>
