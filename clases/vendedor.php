<?php

namespace App;

class Vendedor extends Main{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = [
        'id',
        'nombre',
        'apellido',
        'telefono'
    ];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    /**
     * Constructor de la clase Propiedad.
     * Inicializa los atributos de la propiedad con los valores proporcionados en el array $args.
     * Si algún valor no está presente en $args, se asigna un valor por defecto.
     * 
     * @param array $args Datos para inicializar la propiedad.
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validarDatos(){
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un Nombre";
        }
        if (!$this->apellido) {
            self::$errores[] = "Debes añadir un Apellido";
        }
        if (!$this->telefono) {
            self::$errores[] = "Debes añadir un Telefono";
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Formato de telefono no valido";
        }
        return self::$errores;
    }
}
