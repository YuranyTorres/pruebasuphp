<?php
use PHPUnit\Framework\TestCase;
require_once 'promediopoo.php'; // Asegúrate de ajustar la ruta según tu estructura de carpetas

class PromedioTest extends TestCase {
    public function testCalcularPromedioEstudiantes() {
        $estudiante1 = new Estudiante("Pedro");
        $estudiante1->agregarNota(5.0);
        $estudiante1->agregarNota(4.5);
        $estudiante1->agregarNota(4.0);
        $estudiante1->agregarNota(3.5);

        $estudiante2 = new Estudiante("María");
        $estudiante2->agregarNota(3.0);
        $estudiante2->agregarNota(2.5);
        $estudiante2->agregarNota(4.0);
        $estudiante2->agregarNota(3.5);

        $promedio = new Promedio();
        $promedio->agregarEstudiante($estudiante1);
        $promedio->agregarEstudiante($estudiante2);

        $resultados = $promedio->calcularPromedioEstudiantes();

        $this->assertArrayHasKey("Pedro", $resultados);
        $this->assertArrayHasKey("María", $resultados);
        $this->assertEquals("4.25", $resultados["Pedro"]);
        $this->assertEquals("3.25", $resultados["María"]);
    }
}
