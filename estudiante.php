<?php

class Estudiante {
    private $nombre;
    private $pensionMensual;

    public function __construct($nombre, $pensionMensual) {
        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        $this->setPensionMensual($pensionMensual);
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    }

    public function getPensionMensual() {
        return $this->pensionMensual;
    }

    public function setPensionMensual($pension) {
        $this->pensionMensual = max(0, $pension);
    }
}
?>
