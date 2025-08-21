<?php

namespace App;

class Propiedad
{

    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedor_id'];

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
    public $vendedor_id;

    public static function setDB($database)
    {
        self::$db = $database;
    }

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
        $this->vendedor_id = $args['vendedor_id'] ?? '';
    }

    public function guardar()
    {
        $atributos = $this->sanitizarDatos();

        $columnas = join(', ', array_keys($atributos));
        $fila = join("', '", array_values($atributos));
        $query = "INSERT INTO propiedades($columnas) VALUES ('$fila');";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function atributos()
    {
        $atributos = [];

        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //validaciones
    public static function errores()
    {
        return self::$errores;
    }

    public function validarDatos()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }

        if (!$this->descripcion) {
            self::$errores[] = "Debes añadir una descripcion";
        }

        if (!$this->wc) {
            self::$errores[] = "Debes añadir un numero de wc";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir un numero de habitaciones";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "Debes añadir un numero de estacionamiento";
        }

        if (!$this->vendedor_id) {
            self::$errores[] = "Debes añadir un vendedor";
        }

        if (!$this->imagen) {
             self::$errores[] = "Debes añadir una imagen";
        }
        return self::$errores;
    }

    public function setImagen($imagen){
        if($imagen){
            $this->imagen = $imagen;
        }
    }
}
