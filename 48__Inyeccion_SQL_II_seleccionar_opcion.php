<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Selecione su opcion</title>
    <link rel="stylesheet" href="linkToCSS" />
</head>

<body>
    <?php
    require("00_conexion_a_base_de_datos.php");
    $conexion = mysqli_connect($db_host, $db_usuario, $db_clave);

    $usuario = $_GET["campo_usuario"];

    $clave = $_GET['campo_clave'];

    //     $usuario = mysqli_real_escape_string($conexion, $_GET["campo_usuario"]); // evitando inyecion sql, escapando los caracteres especiales [ mysqli_real_escape_string()]

    //     $clave = mysqli_real_escape_string($conexion,  $_GET['campo_clave']); // evitando inyecion sql, escapando los caracteres especiales [ mysqli_real_escape_string()];
    
    mysqli_select_db($conexion, $db_nombre) or exit("Error: No se pudo conectar a  la Base de datos ");
    echo "Conección éxitosa a Base de datos ==>" . PHP_EOL;
    echo "Información del host: " . mysqli_get_host_info($conexion) . PHP_EOL;
    echo "<br /><br /><br />";

    mysqli_set_charset($conexion, "utf8");

    $query = "SELECT * FROM datos_usuarios";

    $resultado = mysqli_query($conexion, $query);

    $fila = mysqli_fetch_row($resultado);

    echo $fila[0];
    echo $fila[1];

    //! el if solo funciona solo con la primer fila del resultse de la tabalo productos
    if ($usuario == $fila[0] && $clave == $fila[1]) {
        echo "<form method='metodo' action='#' align=\"center\">";
        echo " <fieldset>";
        echo "<legend>Selecione su opcion</legend>";
        echo " <br />";
        echo " <div align=\"center\">";
        echo " <input align=\"center\" id=\"consulta\" type=\"submit\" name=\"consulta\" value=\"Consultar registro\" formaction=\"/48__Inyeccion_SQL_II_form_consultar.php\">";
        echo "<input align=\"center\" type=\"submit\" name=\"eliminar \" value=\"Borrar articulo\"
        formaction=\"/48__Inyeccion_SQL_II_form_eliminar.php\">";
        echo "</div>";
        echo "</fieldset>";
        echo " </form>";
    } else {
        echo "Usuario no registrado";
    }

    ?>

</body>

</html>
