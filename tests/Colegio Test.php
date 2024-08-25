<?php

use PHPUnit\Framework\TestCase;
require_once 'Colegio.php';
require_once 'Estudiante.php';

class ColegioTest extends TestCase {
    private $colegio;

    protected function setUp(): void {
        // Configuración inicial antes de cada prueba
        $this->colegio = new Colegio("Colegio Ejemplo", "123 Avenida Principal");
    }

    public function testAdicionarEstudiante() {
        $this->colegio->adicionarEstudiante("Juan Pérez", 1500.00);
        $this->colegio->adicionarEstudiante("Ana Gómez", 2000.00);

        $totalPensiones = $this->colegio->calcularTotalPensiones();

        $this->assertEquals(3500.00, $totalPensiones, "El total de pensiones no es correcto.");
    }

    public function testCalcularTotalPensionesSinEstudiantes() {
        $totalPensiones = $this->colegio->calcularTotalPensiones();
        $this->assertEquals(0.00, $totalPensiones, "El total de pensiones debería ser 0 cuando no hay estudiantes.");
    }
}
