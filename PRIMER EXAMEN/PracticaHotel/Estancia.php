<?php
class Estancia {
    private $dni;
    private $nombre;
    private $tipoHabitacion;
    private $numNoches;
    private $tipoEstancia;
    private bool $pagoEfectivo;
    private bool $pagoTarjeta;
    private bool $opcionCuna;
    private bool $opcionCamaSupletoria;
    private bool $opcionLavanderia;

    public function __construct($dni, $nombre, $tipoHabitacion, $numNoches, $tipoEstancia, $pago, $opciones) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->tipoHabitacion = $tipoHabitacion;
        $this->numNoches = $numNoches;
        $this->tipoEstancia=$tipoEstancia;
        $this->pagoEfectivo = 0;
        $this->pagoTarjeta = 0;
        $this->opcionCuna = 0;
        $this->opcionCamaSupletoria = 0;
        $this->opcionLavanderia = 0;
        

        if($pago=='Efectivo'){
            $this->pagoEfectivo=true;
        }else{
            $this->pagoTarjeta=true;
        }

        if(in_array('cuna',$opciones)){
            $this->opcionCuna=true;
        }elseif(in_array('cama',$opciones)){
            $this->opcionCamaSupletoria=true;
        }elseif(in_array('lavanderia',$opciones)){
            $this->opcionLavanderia=true;
        }

    }

    

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
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
     * Get the value of tipoHabitacion
     */ 
    public function getTipoHabitacion()
    {
        return $this->tipoHabitacion;
    }

    /**
     * Set the value of tipoHabitacion
     *
     * @return  self
     */ 
    public function setTipoHabitacion($tipoHabitacion)
    {
        $this->tipoHabitacion = $tipoHabitacion;

        return $this;
    }

    /**
     * Get the value of numNoches
     */ 
    public function getNumNoches()
    {
        return $this->numNoches;
    }

    /**
     * Set the value of numNoches
     *
     * @return  self
     */ 
    public function setNumNoches($numNoches)
    {
        $this->numNoches = $numNoches;

        return $this;
    }

    /**
     * Get the value of tipoEstancia
     */ 
    public function getTipoEstancia()
    {
        return $this->tipoEstancia;
    }

    /**
     * Set the value of tipoEstancia
     *
     * @return  self
     */ 
    public function setTipoEstancia($tipoEstancia)
    {
        $this->tipoEstancia = $tipoEstancia;

        return $this;
    }

    /**
     * Get the value of pagoEfectivo
     */ 
    public function getPagoEfectivo()
    {
        return $this->pagoEfectivo;
    }

    /**
     * Set the value of pagoEfectivo
     *
     * @return  self
     */ 
    public function setPagoEfectivo($pagoEfectivo)
    {
        $this->pagoEfectivo = $pagoEfectivo;

        return $this;
    }

    /**
     * Get the value of pagoTarjeta
     */ 
    public function getPagoTarjeta()
    {
        return $this->pagoTarjeta;
    }

    /**
     * Set the value of pagoTarjeta
     *
     * @return  self
     */ 
    public function setPagoTarjeta($pagoTarjeta)
    {
        $this->pagoTarjeta = $pagoTarjeta;

        return $this;
    }

    /**
     * Get the value of opcionCuna
     */ 
    public function getOpcionCuna()
    {
        return $this->opcionCuna;
    }

    /**
     * Set the value of opcionCuna
     *
     * @return  self
     */ 
    public function setOpcionCuna($opcionCuna)
    {
        $this->opcionCuna = $opcionCuna;

        return $this;
    }

    /**
     * Get the value of opcionCamaSupletoria
     */ 
    public function getOpcionCamaSupletoria()
    {
        return $this->opcionCamaSupletoria;
    }

    /**
     * Set the value of opcionCamaSupletoria
     *
     * @return  self
     */ 
    public function setOpcionCamaSupletoria($opcionCamaSupletoria)
    {
        $this->opcionCamaSupletoria = $opcionCamaSupletoria;

        return $this;
    }

    /**
     * Get the value of opcionLavanderia
     */ 
    public function getOpcionLavanderia()
    {
        return $this->opcionLavanderia;
    }

    /**
     * Set the value of opcionLavanderia
     *
     * @return  self
     */ 
    public function setOpcionLavanderia($opcionLavanderia)
    {
        $this->opcionLavanderia = $opcionLavanderia;

        return $this;
    }
}
?>
