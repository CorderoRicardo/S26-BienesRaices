<?php 
namespace App;
class ActiveRecord{
    //Conexion a la base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $errores = [];
    protected static $tabla = '';

    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function crear(){
        $atributos = $this->sanitizarAtributos();

        // Crear la query del INSERT
        $query = "INSERT INTO ".static::$tabla." ( ";
        $query .= join(', ',array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        // debugging($query);
        
        $resultado = self::$db->query($query);

        if($resultado){
            header('Location: /S26-BienesRaices/admin/index.php?resultado=1');
        }
    }

    public function actualizar(){
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "$key='$value'";
        }

        $query = "UPDATE ".static::$tabla." SET ";
        $query .= join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";
        
        $resultado = self::$db->query($query);

        if($resultado){
            header('Location: /S26-BienesRaices/admin/index.php?resultado=2');
        }
    }

    /** Deletes a row of the table 'propiedades' */
    public function eliminar(){
        $query = "DELETE FROM ".static::$tabla." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('location: /S26-BienesRaices/admin/index.php?resultado=3');
        }
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
        foreach(static::$columnasDB as $columna){
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
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public static function getErrores(){
        return static::$errores;
    }

    /**
     * Fill the 'errores' array with messages to display in the UI
     */
    public function validar(){
        static::$errores = [];
        return static::getErrores();
    }

    /** Returns all rows of the respective table */
    public static function all(){
        $query = "SELECT * FROM ".static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /** Search a row in 'propiedades' table by the ID and returns it */
    public static function find($id){
        $query = "SELECT * FROM ".static::$tabla." WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $arreglo = [];
        while($registro = $resultado->fetch_assoc()){
            $arreglo[] = static::crearObjeto($registro);
        }

        $resultado->free();

        //retornar los resultado
        return $arreglo;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

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