<?php
require_once "Pelicula.php";

class Modelo {
    private string $nombreFichero = "peliculas.txt";

    public function __construct() {
    
    }

    public function insertarPelicula(Pelicula $pelicula) {
        try {
            $archivo = fopen($this->nombreFichero, 'a+');           
            $linea = $pelicula->getNombre() . ';' .
                     $pelicula->getFecha() . ';' .
                     $pelicula->getGenero() . ';' .
                     $pelicula->getTipo() . ';' .
                     $pelicula->getCapitulos() .  PHP_EOL;

            fwrite($archivo, $linea);
            echo "<p style='color:green'>pelicula registrada correctamente.</p>";
        } catch (Throwable $t) {
            echo "Error: " . $t->getMessage();
        } finally {
            if ($archivo !== null) {
                fclose($archivo);
            }
        }
    }

    public function obtenerPeliculas() {
        $peliculas = array();
        try {
            if (file_exists($this->nombreFichero)) {
                $lineas = file($this->nombreFichero);
                foreach ($lineas as $linea) {
                    $datos = explode(';', $linea);
                    $pelicula = new Pelicula(
                        $datos[0], 
                        $datos[1], 
                        $datos[2], 
                        $datos[3], 
                        $datos[4]
                          
                    );
                    $peliculas[] = $pelicula;
                }
            }
        } catch (Throwable $t) {
            echo "Error: " . $t->getMessage();
        }
        return $peliculas;
    }
}
?>