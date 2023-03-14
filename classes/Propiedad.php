<?php 

namespace App;

use Exception;

class Propiedad{
    //Conexion a la base de datos
    protected static $db;
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorId'];
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar(){
        $atributos = $this->sanitizarAtributos();

        // Crear la query del INSERT
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ',array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        // debugging($query);
        
        $resultado = self::$db->query($query);

        return $resultado;
    }

    /**
     * Set up the connection to a MySQL DB 
     */
    public static function setDB($database){
        self::$db = $database;
    }

    /**
     * Identify and join the attributes from the DB on an array
     */
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    /**
     * Apply escape string method to the input data
     */
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value); 
        }
        return $sanitizado;
    }

    public function setImage($imagen){
        // Elimina la imagen previa, si la hay
        if($this->id){
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public static function getErrores(){
        return self::$errores;
    }

    /**
     * Fill the 'errores' array with messages to display in the UI
     */
    public function validar(){
        if(!$this->titulo){
            self::$errores[] = 'El Titulo es obligatorio';
        }
        if(!$this->precio){
            self::$errores[] = 'El Precio es obligatorio';
        }    
        if(strlen($this->descripcion) < 50){
            self::$errores[] = 'La Descripción es obligatoria y debe tener al menos 50 caracteres';
        }    
        if(!$this->habitaciones){
            self::$errores[] = 'El número de Habitaciones es obligatorio';
        }
        if(!$this->wc){
            self::$errores[] = 'El número de Baños es obligatorio';
        }
        if(!$this->estacionamiento){
            self::$errores[] = 'El número de lugares de Estacionamiento es obligatorio';
        }
        if(!$this->vendedorId){
            self::$errores[] = 'Elige un vendedor';
        }
        if(!$this->imagen){
            self::$errores[] = 'La imagen es obligatoria';
        }
        return self::getErrores();
    }

    /** Returns all rows of the table 'propiedades' */
    public static function all(){
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /** Search a row in 'propiedades' table by the ID and returns it */
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $arreglo = [];
        while($registro = $resultado->fetch_assoc()){
            $arreglo[] = self::crearObjeto($registro);
        }

        $resultado->free();

        //retornar los resultado
        return $arreglo;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists($objeto,$key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    /** Sincronize the object in memory with changes made by the user */
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this,$key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}