<?php
require_once 'Nota.php';

class Modelo{
    private $nombreFN='notas.dat', $nombreFA='asig.dat';

    function __construct(){

    }

    function crearNota(Nota $n){
        try{
            //Creamos fichero
            $f = fopen($this->nombreFN,'a+');
            //Lo rellenamos
            fwrite($f,$n->getAsi().";".$n->getFecha().";".$n->getDesc().";".$n->getTipo().";".$n->getNota().PHP_EOL);

        }catch(\throwable $th){

            $th->getMessage();

        }finally{
            fclose($f);
        }

    }

    function obtenerNotas(){
        $notas=array();
        try{
            if(file_exists($this->nombreFN)){
                $linea=file($this->nombreFN);
                foreach($linea as $l){
                    $campos=explode(';',$l);
                    $notas[]=new Nota($campos[0],$campos[1],
                    $campos[2], $campos[3],$campos[4]);
                }
            }

        }catch(\Throwable $th){
            $th->getMessage();

        }
        return $notas;
    }

    function obtenerAsignaturas(){
        $asignaturas=array();

        try{
        if(file_exists($this->nombreFA)){
            $linea =file($this->nombreFA);
            foreach($linea as $l){
                $asignaturas[]=$l; 
            }
        }
        }catch(\Throwable $th){
            echo $th->getMessage();
        }

        return $asignaturas;
    }
}
?>