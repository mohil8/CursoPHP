<?php 

require_once 'Pelicula.php';

class Modelo{

    private $nombreFichero='Peliculas.txt';

    function __construct(){

    }

    function rellenarFichero(Peliculaa $pelicula){

        try{

            $archivo=fopen($this->nombreFichero,'a+');
            $lineas= $pelicula->getTitulo().';'.$pelicula->getFecha().';'.$pelicula->getGenero().';'.
            $pelicula->getTipo().';'.$pelicula->getCapitulos(). PHP_EOL;
            fwrite($archivo,$lineas);
            echo '<h1>Datos introducidos correctamente';

        }catch(Throwable $err){
            echo 'Error: '.$err->getMessage();
        }finally{
            if ($archivo !== null) {
                fclose($archivo);
            }
        }

    }

    function obtenerPeliculas(){

        $resultado = array();

        try{
            if(file_exists($this->nombreFichero)){
                $lineas = file($this->nombreFichero);
                foreach($lineas as $linea){
                    $datos=explode(';',$linea);
                    $peli= new Peliculaa(
                        $datos[0],
                        $datos[1],
                        $datos[2],
                        $datos[3],
                        $datos[4]
                    );
                    $resultado[]=$peli;
                }
                
            }
        }catch(Throwable $err){
            echo "Error: " . $err->getMessage();
        }

        return $resultado;

    }

}

?>