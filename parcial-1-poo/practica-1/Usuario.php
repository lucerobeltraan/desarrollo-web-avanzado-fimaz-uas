<?php
class Usuario {

    private $nombre;
    private $correo;

    public function __construct($nombre, $correo) {
        $this->setNombre($nombre);
        $this->setCorreo($correo);
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCorreo() {
        return $this->correo;  
    }

    public function setNombre($nombre) {
        if (!empty($nombre)) {
            $this->nombre = $nombre;
        } else {
            echo "El nombre debe ser completado<br>";
        }
    }

    public function setCorreo($correo) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->correo = $correo;
        } else {
            echo "Correo no válido<br>";
        }
    }
}
?>
