<?php

namespace App;

class Main
{
    // Conexión a la base de datos, compartida por todas las instancias de la clase.
    protected static $db;

    // Lista de columnas de la tabla 'propiedades' en la base de datos.
    protected static $columnasDB = [];

    protected static $tabla = '';

    // Almacena los mensajes de error generados durante la validación de datos.
    protected static $errores = [];

    // Propiedades públicas que representan los campos de la tabla 'propiedades'.
    

    /**
     * Asigna la conexión de base de datos a la clase.
     * Esto permite que todos los métodos de la clase utilicen la misma conexión
     * sin necesidad de pasarla como argumento en cada método.
     *  
     */
    public static function setDB($database)
    {
        self::$db = $database;
    }

    /**
     * Inserta una nueva propiedad en la base de datos.
     * Primero sanitiza los datos para evitar inyección SQL, luego construye la consulta
     * INSERT dinámicamente usando los atributos de la instancia y ejecuta la consulta.
     * Devuelve el resultado de la operación, que puede ser true/false o un objeto mysqli_result.
     * 
     */
    public function crear()
    {
        if (!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->guardar();
        }
    }

    public function guardar()
    {
        $atributos = $this->sanitizarDatos();

        $columnas = join(', ', array_keys($atributos));
        $fila = join("', '", array_values($atributos));
        $query = "INSERT INTO " . static::$tabla . " ($columnas) VALUES ('$fila');";

        $resultado = self::$db->query($query);
        
        if($resultado){
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar()
    {
        $atributos = $this->sanitizarDatos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1;";

        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: /admin?resultado=2');
        }
    }

    public function eliminar()
    {
        // Asegúrate de que static::$tabla tenga un valor
        $query = "DELETE FROM " . static::$tabla . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1;";

        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header("Location: /admin?resultado=3");
            exit; // Es buena práctica añadir exit después de header
        }
    }

    public function borrarImagen()
    {
        $carpetaImagenes = '../imagenes/';
        $existeArchivo = file_exists($carpetaImagenes . $this->imagen);
        if ($existeArchivo) {
            unlink($carpetaImagenes . $this->imagen);
        }
    }
    /**
     * Sanitiza los datos de los atributos de la propiedad.
     * Utiliza la función escape_string de mysqli para limpiar cada valor y evitar inyección SQL.
     * Devuelve un array asociativo con los datos ya sanitizados.
     * 
     * @return array Datos sanitizados listos para usarse en una consulta SQL.
     */
    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    /**
     * Obtiene los atributos de la instancia de Propiedad en un array asociativo.
     * Excluye el campo 'id' ya que normalmente es autoincremental en la base de datos.
     * 
     * @return array Array de atributos de la propiedad (excepto 'id').
     */
    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    /**
     * Devuelve el array de errores de validación acumulados.
     * Esta función es útil para mostrar mensajes de error al usuario después de validar los datos.
     * 
     * @return array Lista de errores de validación.
     */
    public static function errores()
    {
        return static::$errores;
    }

    /**
     * Valida los datos de la propiedad antes de guardarla en la base de datos.
     * Verifica que todos los campos obligatorios tengan un valor y agrega mensajes de error si falta alguno.
     * Devuelve el array de errores encontrados.
     * 
     * @return array Lista de errores encontrados durante la validación.
     */
    public function validarDatos()
    {
        static::$errores = [];
        return static::$errores;
    }

    /**
     * Asigna el nombre de la imagen a la propiedad.
     * Este método se utiliza cuando se sube una imagen y se quiere asociar el nombre del archivo a la propiedad.
     * 
     * @param string $imagen Nombre del archivo de imagen.
     */
    public function setImagen($imagen)
    {
        $carpetaImagenes = '../imagenes/';
        if (!is_null($this->id)) {
            $existeArchivo = file_exists($carpetaImagenes . $this->imagen);
            if ($existeArchivo) {
                unlink($carpetaImagenes . $this->imagen);
            }
        }

        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    /**
     * Obtiene todas las propiedades almacenadas en la base de datos.
     * Ejecuta una consulta SELECT * y devuelve un array de objetos Propiedad.
     * 
     * @return array Lista de objetos Propiedad con los datos de la base de datos.
     */
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultaSQL($query);
        return $resultado;
    }

    /**
     * Ejecuta una consulta SQL personalizada y convierte los resultados en objetos Propiedad.
     * Este método es útil para reutilizar la lógica de conversión de registros a objetos.
     * 
     * @param string $query Consulta SQL a ejecutar.
     * @return array Lista de objetos Propiedad resultantes de la consulta.
     */
    public static function consultaSQL($query)
    {
        $resultado = self::$db->query($query);

        $array = [];

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjetos($registro);
        }

        $resultado->free();

        return $array;
    }

    /**
     * Crea una instancia de Propiedad a partir de un array asociativo (registro de la base de datos).
     * Asigna cada valor del array al atributo correspondiente del objeto.
     * 
     * @param array $registro Registro de la base de datos.
     * @return self Objeto Propiedad con los datos asignados.
     */
    protected static function crearObjetos($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    /**
     * Obtiene un registro de propiedades almacenada en la base de datos.
     * Ejecuta una consulta SELECT * y devuelve un array de objetos Propiedad.
     * 
     * @return array Lista de objetos Propiedad con los datos de la base de datos.
     */
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = '$id'";
        $resultado = self::consultaSQL($query);
        return array_shift($resultado);
    }

    public function actualizarDatos($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
        return $this;
    }
}
