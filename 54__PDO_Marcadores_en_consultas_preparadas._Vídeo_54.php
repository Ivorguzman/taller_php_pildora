<?php
$dsn = 'mysql:dbname=productos;host=127.0.0.1';
$usuario = 'root';
$contraseña = '';
$seccion_articulo = $_GET["seccion"];
$seccion_articulo = strtoupper($seccion_articulo); // transforma en mayuscula el string
$pais = $_GET["pais_origen"];
$pais = strtoupper($pais); // transforma en mayuscula el string


//! Prepara una sentencia SQL con parámetros de sustitución nombrados [= : Nombre ]



try {
    $conexion_pdo = new PDO($dsn, $usuario, $contraseña); // Almacenando creación de conexion objeto tipo conecxion
    echo ('conexion establecida' . "<br />");

    // ojo estudiar esta linea
    $conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexion_pdo->exec("SET CHARACTER SET utf8"); // Establciendo uso de caracteres especiales

    $query_sql = "SELECT CODIGOARTICULO,NOMBREARTICULO,PRECIO,PAISDEORIGEN,SECCION
    FROM productos 
    WHERE
     SECCION = :SECCION AND  PAISDEORIGEN = :PAISDEORIGEN"; //Amacenando ejecucuón de consulta metodo con el uso de [= :......]
//*  $query = "SELECT * FROM  productos where nombrearticulo like '%$laBuequeda%




    // ===COMPROBACIONES===
    print "<pre>\n";
    print_r($seccion_articulo . "<br />");
    print_r($pais . "<br /><br />");
    print_r($query_sql . "<br />");
    // print_r( "$registro[2] ". " linea 75 <br />");
    echo "<br />";
    print "<pre>";
    // ===FIN COMPROBACIONES===

    $obj_pdo_stmt = $conexion_pdo->prepare($query_sql); // alamcenando el Objesto PDOStatemen devuelto (record Set)

    $obj_pdo_stmt->execute(array(":SECCION" => $seccion_articulo, ":PAISDEORIGEN" => $pais)); //


    echo "<br />";


    // Probar con expreiones regulares
    if ($seccion_articulo == null || $seccion_articulo == 0 || $pais == null || $pais == 0) {
        exit("producto inexistente");
    }




    //[fetch(PDO::FETCH_ASSOC)DEVULVE UN ARRAY CON EL RESULTADO DE LA COSULTA SQL($query_sql)]";
    echo "======= Consulta Exitosa =======";
    echo "<br /><br />";
    // while ($registro = $obj_pdo_stmt->fetch(PDO::FETCH_ASSOC)) {
    while ($registro = $obj_pdo_stmt->fetch(PDO::FETCH_BOTH)) {
        // Recorriendo fila a fila el Record Set con [fetch(PDO::FETCH_ASSOC)]

        //********** Impresion con echo
//         echo "<table width='70%' align='center' border='1'>";
//         echo "<td  align='center' >$registro[CODIGOARTICULO]</td> ";
//         echo "<td  align='center' >$registro[NOMBREARTICULO]</td> ";
//         echo "<td  align='center' >$registro[PRECIO]</td> ";
//         echo "<td  align='center'>$registro[PAISDEORIGEN]  </td></tr></table>";


        //******* Inpresion con print
        // print "\n";
        // print "<table  width='90%' align='center' border=1>";
        // print "<tr>";
        // print "<td align='center'> $registro[CODIGOARTICULO] </td>"; // ojo NO SE NECECITO LA COMILLA EN EL VALOR DEL ARRAY
        // print "<td align='center'> $registro[CODIGOARTICULO] </td>";
        // print "<td align='center'> $registro[NOMBREARTICULO] </td>";
        // print "<td align='center'> $registro[PRECIO] </td>";
        // print "<td align='center'> $registro[PAISDEORIGEN] </td>";
        // print "</tr>";
        // print "</table>";


        // ****** IMPRESION DE LOS RESULTADOA LA FUNCION PRINTF (PRINT CON FORMATO)
        printf(
            "|%s | %s | %s | %s|\n" . "<br />",
            "Codigo del articulo : " . $registro[0], //! fetch(PDO::FETCH_BOTH)
            "Nombre del articulo : " . $registro["NOMBREARTICULO"],
            "Prescio del articulo : " . $registro["PRECIO"] . "$",
            "Pais del articulo : " . $registro["PAISDEORIGEN"],
        );




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
