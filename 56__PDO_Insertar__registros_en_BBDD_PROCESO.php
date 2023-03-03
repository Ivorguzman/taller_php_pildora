<?php
$dsn = 'mysql:dbname=productos;host=127.0.0.1';
$usuario = 'root';
$contraseña = '';

$seccion_articulo = $_GET["seccion"];
$seccion_articulo = strtoupper($seccion_articulo); // transforma en mayuscula el string

$pais = $_GET["pais_origen"];
$pais = strtoupper($pais); // transforma en mayuscula el string

$codigo_articulo = $_GET['buscar']; // informacion del cuadrode texto  [name=buscar] del formulario 
$codigo_articulo = strtoupper($codigo_articulo); // transforma en mayuscula el string

$nombre_articulo = $_GET['nombre_articulo'];
$nombre_articulo = strtoupper($nombre_articulo); // transforma en mayuscula el string

$precio_articulo = $_GET['precio'];
$precio_articulo = strtoupper($precio_articulo); // transforma en mayuscula el string

$fecha_articulo = $_GET['fecha'];
$fecha_articulo = strtoupper($fecha_articulo); // transforma en mayuscula el string

$importado_articulo = $_GET['importado'];
$importado_articulo = strtoupper($importado_articulo); // transforma en mayuscula el string



//! Prepara un}a sentencia SQL con parámetros de sustitución nombrados [= : Nombre ]



try {
    $conexion_pdo = new PDO($dsn, $usuario, $contraseña); // Almacenando creación de conexion objeto tipo conecxion
    echo ('conexion establecida' . "<br />");

    // ojo estudiar esta linea
    $conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Le inndica a la base de datos que capture las execciones al producirce un error (La base de datos crea los obj. tipo execcion)

    $conexion_pdo->exec("SET CHARACTER SET utf8"); // Establciendo uso de caracteres especiales



    $query_sql = "INSERT INTO productos (CODIGOARTICULO,SECCION,NOMBREARTICULO,PRECIO,FECHA,IMPORTADO,PAISDEORIGEN) VALUES (:CODIGOARTICULO,:SECCION,:NOMBREARTICULO,:PRECIO,:FECHA,:IMPORTADO,:PAISDEORIGEN)"; //Amacenando ejecucuón de consulta metodo con el uso de [= :......]

    //*  $query = "SELECT * FROM  productos where nombrearticulo like '%$laBuequeda%

    $obj_pdo_stmt = $conexion_pdo->prepare($query_sql); // alamcenando el Objesto PDOStatemen devuelto (record Set)

    // Probar con expreiones regulares
    if (
        $codigo_articulo == null || $codigo_articulo == 0 || $seccion_articulo == null || $seccion_articulo == 0 ||
        $nombre_articulo == null || $nombre_articulo == 0 || $precio_articulo == null || $precio_articulo == 0 ||
        $fecha_articulo == null || $fecha_articulo == 0 || $importado_articulo == null || $importado_articulo == 0 ||
        $pais == null || $pais == 0
    ) {
        exit("POR FAVOR INTRODUSCA VALOR EN EL CAMPO");
    } ;

    $obj_pdo_stmt->execute(
        array(
            ":CODIGOARTICULO" => $codigo_articulo,
            ":SECCION" => $seccion_articulo,
            ":NOMBREARTICULO" => $nombre_articulo,
            ":PRECIO" => $precio_articulo,
            ":FECHA" => $fecha_articulo,
            ":IMPORTADO" => $importado_articulo,
            ":PAISDEORIGEN" => $pais
        )
    );
    // ===COMPROBACIONES===
    print "<pre>\n";
    print_r($query_sql . "<br />");
    echo "<br />";
    print "<pre>";
    // ===FIN COMPROBACIONES===
    echo "<br />";

    echo "Registros insertados sactifasctoriamente";

} catch (Exception $e) {

    echo " ALEX, ERROR: el codigo de execpción es: " . $e->getMessage() . "<br />";
    echo "EL archivo es: " . $e->getFile() . "<br />";
    echo "EL codigo del ERROR es: " . $e->getCode() . "<br />";
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
