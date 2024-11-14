<?php

require_once "Entrada.php";

class Modeloo {
    private string $nombreFichero = "entradas.txt";

    public function __construct() {
    
    }

    public function rellenarEntrada(Entrada $entrada) {
        try {
            $archivo = fopen($this->nombreFichero, 'a+');           
            $linea = $entrada->getNombre() . ';' .
                    $entrada->getTipo() . ';' .
                     $entrada->getFecha() . ';' .
                     $entrada->getNumeroEntradas() . ';' .
                     $entrada->getDescuentos() . ';' .
                     $entrada->getImporte() .  PHP_EOL;

            fwrite($archivo, $linea);
            echo "<p style='color:green'>entrada registrada correctamente.</p>";
        } catch (Throwable $t) {
            echo "Error: " . $t->getMessage();
        } finally {
            if ($archivo !== null) {
                fclose($archivo);
            }
        }
    }

    public function obtenerEntradas() {
        $entradas = array();
        try {
            if (file_exists($this->nombreFichero)) {
                $lineas = file($this->nombreFichero);
                foreach ($lineas as $linea) {
                    $datos = explode(';', $linea);
                    $entrada = new Entrada(
                        $datos[0], 
                        $datos[1], 
                        $datos[2], 
                        $datos[3], 
                        $datos[4],
                        $datos[5]
                          
                    );
                    $entradas[] = $entrada;
                }
            }
        } catch (Throwable $t) {
            echo "Error: " . $t->getMessage();
        }
        return $entradas;
    }
}
?>

