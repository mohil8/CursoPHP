<?php
class Usuario{

    private $id,$tipo;

    public function __construct($id,$tipo){

        $this->id = $id;
        $this->tipo = $tipo;
    }
    


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
?>