<?php

// Manejo de la exepción si falla la conexcion;

try {
    $base = new PDO('mysql:host=localhost; dbname=productos', 'root', ''); // conectar a base de datos
    echo ("Conexcion establecida");
} catch (Exception $e) {
    // echo "ERROR ==> : El código de excepción es: " . $e->getCode() . "<br />";
    echo " ERROR: El código de excepción es: " . $e->getMessage() . "<br />";
    echo "En el archivo: " . $e->getFile() . "<br />";
    echo "En la linea : " . $e->getLine() . "<br />";

} finally {
    $base = null;
}



?>
