<?php

require("57__config.php"); /// requiriendo el archivo de conexion a base de datos.


// Creando la clase de conexion
class Conexion
{
    protected $conexion_db;
    // CREANDO EL CONSTRUCTO
    function __construct()
    {
        $this->conexion_db = new mysqli(DB_HOST, DB_USUARIOS, DB_CONTRA, DB_NOMBRE);
        // creando condicional del error
        if (!$this->conexion_db->connect_error) {

            // ===COMPROBACIONES===
            print "<pre>\n";
            print_r($this);
            // print_r($this->conexion_db);
            print_r(!$this->conexion_db-> connect_error . "<br />");
            print_r($this->conexion_db->connect_error);
            echo "<br />";
            print "<pre>";
            // ===FIN COMPROBACIONES===

            printf("Falló la conexión: % s\n", $this->conexion_db->connect_error);
            exit();
            // exit("Fallo al conectar con base de datos");
        } else {
            echo " Conexión establecida";

        }
        $this->conexion_db->set_charset(DB_CHARSET);
    }
}
$conexion1 = new Conexion;


// ===COMPROBACIONES===
print "<pre>\n";
// print_r($conxion1);
echo "<br />";
print "<pre>";
// ===FIN COMPROBACIONES===


?>
