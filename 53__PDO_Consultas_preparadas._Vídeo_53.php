<?php
$dsn = 'mysql:dbname=productos;host=127.0.0.1';
$usuario = 'root';
$contraseña = '';
$busqueda = $_GET["buscar"];


//! Crear una instancia de PDO usando un alias 1*/

// try {
//     $base = new PDO('mysql:host=localhost; dbname=productos', 'root', '');
//     echo ('conexion establecida');
// }catch(Exception $e){
//     echo "ERROR: el codigo de execpción es: " . $e->getMessage() . "<br />";
//     echo "EL archivo es: " . $e ->getFile(). "<br />";
//     echo "En la linea: " . $e->getLine(). "<br />";
// }finally{
//     $base = null;
// }






//! Crear una instancia de PDO usando un alias 2 */

// $dsn = 'mysql:host=localhost; dbname=productos';
// $usuario = 'root';
// $contraseña = '';
// 
// try {
//     $base = new PDO($dsn, $usuario, $contraseña);
//       echo ('conexion establecida');
// } catch (Exception $e) {
//    echo "ERROR: el codigo de execpción es: " . $e->getMessage() . "<br />";
//    echo "EL archivo es: " . $e ->getFile(). "<br />";
//    echo "En la linea: " .  $e->getLine(). "<br />";
// }finally{
//     $base=null;
// }







//! Amacenando  ejecucuón de consulta metodo con el uso de [= ?]



try {
$conexion_pdo = new PDO($dsn, $usuario, $contraseña); // Almacenando creación de  conexion objeto tipo conecxion
echo ('conexion establecida' . "<br />");
// ojo estudiar esta linea
$conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexion_pdo->exec("SET CHARACTER SET utf8"); // Establciendo uso de caracteres especiales
$qry_sql = "SELECT CODIGOARTICULO,NOMBREARTICULO,PRECIO,PAISDEORIGEN FROM productos WHERE CODIGOARTICULO = ?"; //Amacenando  ejecucuón de consulta metodo con el uso de [= ?]
$obj_pdo_stmt = $conexion_pdo->prepare($query_sql); // alamcenando el Objesto PDOStatemen devuelto (record Set)
$obj_pdo_stmt->execute(array($busqueda)); // 
echo "<br />";
// Probar con expreiones regulares
if ( $busqueda == null || $busqueda == 0) {
exit("producto inexistente");
}
// ===COMPROBACIONES===
print "<pre>\n";
// print_r($registro = $obj_pdo_stmt->fetch(PDO::FETCH_BOTH) . " linea 74 <br />");
// print_r( "$registro[2] ". " linea 75 <br />");
echo "<br />";
print "<pre>";
// ===FIN COMPROBACIONES===
//[fetch(PDO::FETCH_ASSOC)DEVULVE UN ARRAY CON EL RESULTADO DE LA COSULTA SQL($query_sql)]";
while ($registro = $obj_pdo_stmt->fetch(PDO::FETCH_ASSOC)) {
// while ($registro = $obj_pdo_stmt->fetch(PDO::FETCH_BOTH)) {
// Recorriendo fila a fila el Record Set con [fetch(PDO::FETCH_ASSOC)]
echo "======= Consulta Exitosa =======";
echo "<table width='70%' align='center' border='1'>";
echo "<td  align='center' >$registro[CODIGOARTICULO]</td> ";
echo "<td  align='center' >$registro[NOMBREARTICULO]</td> ";
echo "<td  align='center' >$registro[PRECIO]</td> ";
echo "<td  align='center'>$registro[PAISDEORIGEN]  </td></tr></table>";
}
;
// $obj_pdo_stmt->closeCursor();
} catch (Exception $e) {
echo "ERROR: el codigo de execpción es: " . $e->getMessage() . "<br />";
echo "EL archivo es: " . $e->getFile() . "<br />";
exit("En la linea: " . $e->getLine()) . "<br />";
} finally {
function disconnect()
{
global $conexion_pdo, $obj_pdo_stmt;
$obj_pdo_stmt->closeCursor();
$obj_pdo_stmt = null;
$conexion_pdo = null;
echo "<br />";
echo " Consultas y conexciones cerradas";
}
disconnect();
}
;







?>
