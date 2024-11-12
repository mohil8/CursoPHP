<?php 

require_once 'Estancia.php';

class Modelo{

    private $nombreFichero='Estancia.txt';

    function __construct(){

    }

    function rellenarFichero(Estancia $estancia){

        try{
            $archivo=fopen($this->nombreFichero,'a+');

           $lineas = $estancia->getDni().';' .
          $estancia->getNombre().';' .
          $estancia->getTipoHabitacion().';' .
          $estancia->getNumNoches().';' .
          $estancia->getTipoEstancia().';' .
          $estancia->getPagoEfectivo().';' .
          $estancia->getPagoTarjeta().';' .
          $estancia->getOpcionCuna().';' .
          $estancia->getOpcionCamaSupletoria().';' .
          $estancia->getOpcionLavanderia() . PHP_EOL;


            fwrite($archivo,$lineas);

        }catch(Throwable $err){
            echo '<h1>Error: '.$err.'</h1>';
        }finally{
            if ($archivo !== null) {
                fclose($archivo);
            }
        }

    }

    function obtenerEstancias(){

        try{

            if(file_exists($this->nombreFichero)){
                
            }

        }catch(Throwable $err){
            echo '<h1>'.$err.'</h1>';
        }

    }

}

?>