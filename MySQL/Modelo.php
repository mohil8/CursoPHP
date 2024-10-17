<?php 

require_once 'Usuario.php';


class Modelo{

    private $conexion;

    public function __construct(){

        try{
            $config = $this->obtenerDatos();
            if($config!=null){
            //Establecer conexión con la bd
            $this->conexion = new PDO('mysql:host='.$config['urlBD'].';port='.$config['puerto'].'dbname='.$config['nombreBD'],$config['usBD'],$config['psUs']);
            }
           
        }catch(PDOException $th){
            echo $th->getMessage();
        }


    }
     
    private function obtenerDatos(){

        $resultado = array();
        if(file_exists('.config')){
            $datosF = file('.config',FILE_IGNORE_NEW_LINES);
            foreach($datosF as $linea){
                $campos = explode('=',$linea);
                $resultado[$campos[0]]=$campos[1];
            }
        }else{
            return null;
        }
        return $resultado;
    }

    public function loguear($us,$ps){
        //VA A DEVOLVER NULL SI LOS DATOS NO SON CORRECTOS Y UN OBJETO USUARIO SI LOS DATOS SON CORRECTOS
        $resultado = null;
        //Ejecutamos la consulta 
        //select * from usuario where id = nombre US and ps =psUS cifrada
        try{
            $consulta = $this->conexion->prepare('SELECT * from usuarios where id = ? and ps=sha2(?,512)');
            //Rellenar parámetros
            $params = array();

            //Ejecutar consulta
            if($consulta->execute($params)){
                //Recuperar el resultado y transformarlo en un objero usuario
                if($fila=$consulta->fetch()){
                    $resultado = new Usuario($fila['id'],$fila['tipo']);
                }
            }
        }catch(\Throwable $th){
            echo $th->getMessage();
        }
        return $resultado;
    }
    


    /**
     * Get the value of conexion
     */ 
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */ 
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}

?>