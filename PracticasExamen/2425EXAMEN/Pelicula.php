<?php 

    class Pelicula{

        private $nombre;
        private $fecha;
        private $genero;
        private $tipo;
        private $capitulos;
        
        public function __construct($nombre, $fecha, $genero, $tipo, $capitulos) {
            $this->nombre = $nombre;
            $this->fecha = $fecha;
            $this->genero = $genero;
            $this->tipo = $tipo;
            $this->capitulos = $capitulos;
          
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
         * Get the value of genero
         */ 
        public function getGenero()
        {
                return $this->genero;
        }

        /**
         * Set the value of genero
         *
         * @return  self
         */ 
        public function setGenero($genero)
        {
                $this->genero = $genero;

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

        /**
         * Get the value of capitulos
         */ 
        public function getCapitulos()
        {
             
                return $this->capitulos;
        }

        /**
         * Set the value of capitulos
         *
         * @return  self
         */ 
        public function setCapitulos($capitulos)
        {
                $this->capitulos = $capitulos;

                return $this;
        }
    }

?>