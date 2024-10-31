<?php

class Pelicula {

    public $titulo;
    public $fecha;
    public $genero;
    public $tipo;
    public $numCapitulos;


    public function __construct($titulo,$fecha,$genero,$tipo,$numCapitulos){

        $this->titulo =$titulo;
        $this->fecha =$fecha;
        $this->genero =$genero;
        $this->tipo =$tipo;
        $this->numCapitulos =$numCapitulos;

        if($_POST['tipo']==="Pelicula"){
            $this->numCapitulos=0;
        }

    }

    public function guardar(){


        $linea=implode(';', [

            $this->titulo,
            $this->fecha,
            $this->genero,
            $this->tipo,
            $this->numCapitulos,
            

        ]);

        file_put_contents('pelicula.txt',$linea. PHP_EOL, FILE_APPEND);

    }
    
        
    
}



?>