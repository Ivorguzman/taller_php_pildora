<?php
$dsn = 'mysql:dbname=productos;host=127.0.0.1';
$usuario = 'root';
$contraseña = '';
$busqueda = $_GET["buscar"];


//* Crear una instancia de PDO usando un alias 1*/

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

//************************************************************* */


//* Crear una instancia de PDO usando un alias 2 */

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







///* Amacenando  ejecucuón de consulta metodo con el uso de [= ?]


try {
    $conexion_pdo = new PDO($dsn, $usuario, $contraseña); // Almacenando creación de  conexion objeto tipo conecxion
    echo ('conexion establecida');

    // ojo estudiar esta linea
    $conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexion_pdo->exec("SET CHARACTER SET utf8"); // Establciendo uso de caracteres especiales

    $query_sql = "SELECT CODIGOARTICULO,NOMBREARTICULO,PRECIO,PAISDEORIGEN FROM productos WHERE CODIGOARTICULO = ?"; //Amacenando  ejecucuón de consulta metodo con el uso de [= ?]

    $obj_pdo_stmt = $conexion_pdo->prepare($query_sql); // alamcenando el Objesto PDOStatemen devuelto (record Set)


    $obj_pdo_stmt->execute(array($busqueda)); // 

    // ===COMPROBACIONES===
    print "<pre>\n";
    print_r($busqueda . "<br />");
    //  print_r($query_sql);
    print_r($obj_pdo_stmt);
    "</pre>";
    echo "<br />";
    // ===FIN COMPROBACIONES===


    //[fetch(PDO::FETCH_ASSOC)DEVULVE UN ARRAY CON EL RESULTADO DE LA COSULTA SQL($query_sql)]";
    while ($registro = $obj_pdo_stmt->fetch(PDO::FETCH_ASSOC)) {
        // while ($registro = $obj_pdo_stmt->fetch(PDO::FETCH_BOTH)) {
        // Recorriendo fila a fila el Record Set con [fetch(PDO::FETCH_ASSOC)]

        // ===COMPROBACIONES===
        print "<pre>\n";
        // print_r($conexion_pdo);
        //  print_r($query_sql);
        // print_r($obj_pdo_stmt);
        // print_r($registro);
        "</pre>";
        echo "<br />";
        // ===FIN COMPROBACIONES===


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








//* Prepara una sentencia SQL con parámetros de sustitución nombrados [= : Nombre ]
// 
// try {
//     $conexion_pdo = new PDO($dsn, $usuario, $contraseña); // Almacenando creación de  conexion
//     echo ('conexion establecida');
// 
// 
//     $conexion_pdo->exec("SET CHARACTER SET utf8"); // Establciendo uso de caracteres especiales
// 
// 
// 
//     $query_sql = "SELECT CODIGOARTICULO,NOMBREARTICULO,PRECIO,PAISDEORIGEN FROM productos WHERE CODIGOARTICULO = :CODIGOARTICULO"; //Amacenando  ejecucuón de consulta metodo con el uso de [= :...]
// 
//     $obj_pdo_stmt = $conexion_pdo->prepare($query_sql); // alamcenando el Objesto PDOStatemen devuelto
// 
//     $obj_pdo_stmt->execute(array(":CODIGOARTICULO" => "AR20"));
// 
//     $fila = $obj_pdo_stmt->fetch(PDO::FETCH_BOTH);
// 
//     echo "<br />";
//     echo ($fila[0]) . "<br />";
//     echo ($fila['NOMBREARTICULO']) . "<br />";
//     echo ($fila['PRECIO']) . "<br />";
//     echo ($fila['PAISDEORIGEN']) . "<br />";
// 
//     // 
// // 
// //     // ! ****   REVISAR  ****
// // 
// //     if ($obj_pdo_stmt == false) {
// //         echo "Error en la consulta";
// //     } else {
// //         mysqli_stmt_bind_result($obj_pdo_stmt, $codigo_articulo, $nombre_articulo, $seccion_articulo, $precio_articulo, $origen_articulo);
// //         echo "Articulos : <br /><br />";
// // 
// //         while (mysqli_stmt_fetch($obj_pdo_stmt)) {
// //             echo "======= Consulta Exitosa =======";
// //             echo "<table width='70%' align='center' border='1'>";
// //             echo "<td  align='center' >$codigo_articulo</td> ";
// //             echo "<td  align='center' >$nombre_articulo</td>";
// //             echo "<td  align='center'>$seccion_articulo</td>";
// //             echo "<td  align='center'>$precio_articulo</td>";
// //             echo "<td  align='center'>$origen_articulo</td></tr></table>";
// // 
// //             print "<pre>\n";
// //             print_r(mysqli_stmt_bind_result($obj_pdo_stmt, $codigo_articulo, $nombre_articulo, $seccion_articulo, $precio_articulo, $origen_articulo));
// //             "</pre>";
// //             echo "<br />";
// // 
// // 
// //         }
// // 
// // 
// //     }
// 
//     // ==================COMPROBACIONES====================================
//     print "<pre>\n";
//     // print_r($conexion_pdo);
//     //  print_r($query_sql);
//     print_r($obj_pdo_stmt);
//     "</pre>";
//     echo "<br />";
//     // ================== FIN COMPROBACIONES====================================
// 
// 
// } catch (Exception $e) {
//     echo "ERROR: el codigo de execpción es: " . $e->getMessage() . "<br />";
//     echo "EL archivo es: " . $e->getFile() . "<br />";
//     exit("En la linea: " . $e->getLine()) . "<br />";
// } finally {
//     $conexion_pdo = null;
// }
// ;


?>
