<?php
/// Metodo setter ===> Modificar propiedades de un Objeto
/// Metodo getter ===> Consultar propiedades de un Objeto


class Coche
/// Una clase puede tener sus propias constantes, variables(llamadas "propiedades"), y funciones (llamados "métodos"). 
{
    //* Declaración de propiedades
    //Las variables pertenecientes a una clase se llaman propiedades. 
    // También se les puede llamar usando otros términos como atributos,o campos
    // Si se declaran usando var,serán definidas como 'public'. 

    /// creación de las proíedades(variables) de la clase coche 
    /// propiredad Encapsulada con el modificador(private ó prtected)
    private $ruedas;
    // protected $ruedas;
    var $color;
    private $motor;
    // protected $motor;



    //*  Declaración de  método

    /// creación de las metodos(funciones) de la clase coche 
    function arrancar()
    {
        echo "Estoy arrancando";
    }

    function girar()
    {
        echo "Estoy girando";
    }

    function frenar()
    {
        echo "Estoy frenando";
    }

    /// Los constructores son métodos ordinarios que se llaman durante la instanciación de su objeto

    //? Antes de PHP 8.0.0,Las funciones constructoreseran creados dandole el mismo nombre que la clase (onstructor de estilo antiguo). Esa sintaxis está en desuso y dará como resultado un E_DEPRECATEDerror, pero seguirá llamando a esa función como un constructor.

    function __construct()
    //  Metodo constructor
    /// Le da un estado inicial a la clase 
    {
        //  $this Siempre hace referencia a la clase donde su utilice (class Coche(){...}) == $this
        //  -> Se utiliza para referenciar una propiedad o un metodo de la clase.
        $this->ruedas = 4;
        $this->color = "";
        $this->motor = 1600;
    }


    //  Metodo Getter
    function getterRuedas()
    {
        return $this->ruedas;
    }

    function getterMotor()
    {
        return $this->motor;
    }



    function crear_color($color_coche)
    {
        $this->color = $color_coche;
    }
}
;

/// **_Clase Camion heredadando de Clase coche_**
class Camion extends Coche // Coche (Super clase ó clase Padre), Camion(Sub-clase ó clase Hijo )
{

    function __construct()
    {
        $this->ruedas = 6;
        $this->color = 'gris';
        $this->motor = 2600;
    }

    /// Sobres escritura de metodo establecer color  en la clase Camion de  clase Coche Heredada(extends)
    function crear_color($color_camion)
    {
        $this->color = $color_camion;
    }


    // Instruccion Parent Llama el metode de la clase padre;
    function arrancar()
    {
        parent::arrancar(); // eljecuta le metodo arrancar()
        echo ". Camion  arrancado"; // agrega esta linea al la ejecucion del metodo arrancar
    }

}







?>
