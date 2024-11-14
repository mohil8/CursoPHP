<?php 

class Entrada{

    private $nombre,$tipo,$fecha,$numeroEntradas,$descuentos,$importe;

    function __construct($nombre,$tipo,$fecha,$numeroEntradas,$descuentos,$importe){

        $this->nombre=$nombre;
        $this->tipo=$tipo;
        $this->fecha=$fecha;
        $this->numeroEntradas=$numeroEntradas;
        $this->descuentos=$descuentos;
        $this->importe=$importe;

    }
    
        
    




    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of numeroEntradas
     */ 
    public function getNumeroEntradas()
    {
        return $this->numeroEntradas;
    }

    /**
     * Set the value of numeroEntradas
     *
     * @return  self
     */ 
    public function setNumeroEntradas($numeroEntradas)
    {
        $this->numeroEntradas = $numeroEntradas;

        return $this;
    }

    /**
     * Get the value of descuentos
     */ 
    public function getDescuentos()
    {
        return $this->descuentos;
    }

    /**
     * Set the value of descuentos
     *
     * @return  self
     */ 
    public function setDescuentos($descuentos)
    {
        $this->descuentos = $descuentos;

        return $this;
    }

    /**
     * Get the value of importe
     */ 
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set the value of importe
     *
     * @return  self
     */ 
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}


?>