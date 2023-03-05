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
        if (!$this->conexion_db->connect_errno){

            // ===COMPROBACIONES===
            print "<pre>\n";
            // print_r($this);
            // print_r($this->conexion_db);
            print_r($this->conexion_db->connect_errno);
            // print_r($this->conexion_db->connect_errno);
            echo "<br />";
            print "<pre>";
            // ===FIN COMPROBACIONES===
            
            echo "Fallo al conectar con base de datos" . $this->conexion_db->connect_error;
            return;
        }
        else{
            echo " Conexión establecida";

        }
        $this->conexion_db->set_charset(DB_CHARSET);
    }
}
$conxion1 = new Conexion;


// ===COMPROBACIONES===
print "<pre>\n";
// print_r($conxion1);
echo "<br />";
print "<pre>";
// ===FIN COMPROBACIONES===


?>
