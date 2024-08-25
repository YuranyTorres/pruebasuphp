<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calcular Promedio de Notas</title>
</head>
<body>
    <h1>Calcular Promedio de Notas</h1>

    <?php
    // Definición de la clase Estudiante
    class Estudiante {
        private $nombre;
        private $notas;

        public function __construct($nombre) {
            $this->nombre = $nombre;
            $this->notas = [];
        }

        public function agregarNota($nota) {
            if (count($this->notas) < 4) {
                if ($nota < 0 || $nota > 5) {
                    throw new Exception('Las notas deben estar entre 0 y 5.');
                }
                $this->notas[] = $nota;
            } else {
                throw new Exception('Solo se pueden agregar hasta 4 notas.');
            }
        }

        public function calcularPromedio() {
            if (count($this->notas) == 0) {
                throw new Exception('No hay notas para calcular el promedio.');
            }
            $suma = array_sum($this->notas);
            return $suma / count($this->notas);
        }

        public function getNombre() {
            return $this->nombre;
        }
    }

    // Definición de la clase Promedio
    class Promedio {
        private $estudiantes;

        public function __construct() {
            $this->estudiantes = [];
        }

        public function agregarEstudiante($estudiante) {
            $this->estudiantes[] = $estudiante;
        }

        public function calcularPromedioEstudiantes() {
            $resultados = [];
            foreach ($this->estudiantes as $estudiante) {
                try {
                    $promedio = $estudiante->calcularPromedio();
                    $resultados[$estudiante->getNombre()] = number_format($promedio, 2);
                } catch (Exception $e) {
                    $resultados[$estudiante->getNombre()] = 'Error: ' . $e->getMessage();
                }
            }
            return $resultados;
        }
    }

    // Mostrar formulario para la cantidad de estudiantes
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['nombres'])) {
        $cantidad = (int)$_POST['cantidad'];

        echo '<form action="promediopoo.php" method="post">';
        echo '<input type="hidden" name="cantidad" value="' . htmlspecialchars($cantidad, ENT_QUOTES, 'UTF-8') . '">';

        for ($i = 0; $i < $cantidad; $i++) {
            echo '<h2>Estudiante ' . ($i + 1) . '</h2>';
            echo '<label for="nombre' . $i . '">Nombre:</label>';
            echo '<input type="text" id="nombre' . $i . '" name="nombres[]" required><br>';

            for ($j = 0; $j < 4; $j++) {
                echo '<label for="nota' . $i . '_' . $j . '">Nota ' . ($j + 1) . ':</label>';
                echo '<input type="number" step="0.01" id="nota' . $i . '_' . $j . '" name="notas' . $i . '[]" min="0" max="5" required><br>';
            }
        }

        echo '<input type="submit" value="Calcular Promedios">';
        echo '</form>';
    }

    // Procesar formulario para calcular promedios
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombres'])) {
        $nombres = $_POST['nombres'];
        $cantidad = count($nombres);

        $promedio = new Promedio();

        for ($i = 0; $i < $cantidad; $i++) {
            $estudiante = new Estudiante($nombres[$i]);

            for ($j = 0; $j < 4; $j++) {
                try {
                    $estudiante->agregarNota($_POST['notas' . $i][$j]);
                } catch (Exception $e) {
                    echo '<p>Error al agregar nota para ' . $nombres[$i] . ': ' . $e->getMessage() . '</p>';
                }
            }

            $promedio->agregarEstudiante($estudiante);
        }

        $resultados = $promedio->calcularPromedioEstudiantes();

        echo '<h2>Resultados</h2>';
        foreach ($resultados as $nombre => $resultado) {
            echo '<p>' . $nombre . ': ' . $resultado . '</p>';
        }
    } else if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo '<form action="promediopoo.php" method="post">';
        echo '<label for="cantidad">Ingrese la cantidad de Estudiantes:</label>';
        echo '<input type="number" id="cantidad" name="cantidad" min="1" required>';
        echo '<input type="submit" value="Enviar">';
        echo '</form>';
    }
    ?>
</body>
</html>
