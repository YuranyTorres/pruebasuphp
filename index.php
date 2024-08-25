<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calcular Total de Pensiones</title>
</head>
<body>
    <h1>Calcular Total de Pensiones del Colegio, </h1>

    <?php
    require_once 'Colegio.php';
    require_once 'Estudiante.php';

    class Index {
        private $colegio;

        public function __construct() {
            $this->colegio = new Colegio("Colegio Ejemplo", "123 Avenida Principal");
        }

        public function handleRequest() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['nombres'])) {
                    $this->processStudentData();
                } else {
                    $this->displayStudentForm();
                }
            } else {
                $this->displayInitialForm();
            }
        }

        private function processStudentData() {
            $nombres = $_POST['nombres'];
            $pensiones = $_POST['pensiones'];

            for ($i = 0; $i < count($nombres); $i++) {
                $this->colegio->adicionarEstudiante(
                    $nombres[$i],
                    $pensiones[$i]
                );
            }

            $totalPensiones = $this->colegio->calcularTotalPensiones();

            echo "<h2>Resultado</h2>";
            echo "El total de pensiones recibidas es: " . number_format($totalPensiones, 2) . " pesos.";
        }

        private function displayStudentForm() {
            $cantidad = (int)$_POST['cantidad'];

            echo '<form action="" method="post">';
            echo '<input type="hidden" name="cantidad" value="' . htmlspecialchars($cantidad, ENT_QUOTES, 'UTF-8') . '">';

            for ($i = 0; $i < $cantidad; $i++) {
                echo '<h2>Estudiante ' . ($i + 1) . '</h2>';
                echo '<label for="nombre' . $i . '">Nombre:</label>';
                echo '<input type="text" id="nombre' . $i . '" name="nombres[]" required><br>';
                echo '<label for="pension' . $i . '">Pensión mensual:</label>';
                echo '<input type="number" step="0.01" id="pension' . $i . '" name="pensiones[]" required><br><br>';
            }

            echo '<input type="submit" value="Calcular Total de Pensiones">';
            echo '</form>';
        }

        private function displayInitialForm() {
            echo '<form action="" method="post">';
            echo '<label for="cantidad">Ingrese la cantidad de estudiantes:</label>';
            echo '<input type="number" id="cantidad" name="cantidad" min="1" required>';
            echo '<input type="submit" value="Enviar">';
            echo '</form>';
        }
    }

    // Crear instancia de Index y manejar solicitud
    $index = new Index();
    $index->handleRequest();
    ?>
</body>
</html>
