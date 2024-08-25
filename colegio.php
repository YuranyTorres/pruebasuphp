<?php

require_once 'Estudiante.php';

class Colegio {
    private $nombre;
    private $direccion;
    private $estudiantes = [];

    public function __construct($nombre, $direccion) {
        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        $this->direccion = htmlspecialchars($direccion, ENT_QUOTES, 'UTF-8');
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function adicionarEstudiante($nombre, $pensionMensual) {
        $estudiante = new Estudiante($nombre, $pensionMensual);
        $this->estudiantes[] = $estudiante;
    }

    public function calcularTotalPensiones() {
        $total = 0;
        foreach ($this->estudiantes as $estudiante) {
            $total += $estudiante->getPensionMensual();
        }
        return $total;
    }
}
?>
