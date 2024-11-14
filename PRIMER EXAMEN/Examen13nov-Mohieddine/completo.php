
<?php 

require_once 'Entrada.php';
require_once 'Modelo.php';

$m = new Modeloo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <fieldset style="display: inline;">
        <legend>Ventana Entradas</legend>
        <form action="#" method="POST">
            <label for="idNombre">Nombre Completo</label><br>
            <input type="text" id="idNombre" name="nombre" value="<?php echo isset($_POST['nombre'])?$_POST['nombre']:'';?>">
            <br>
            <br>
            <label>Tipo de entrada</label><br>
            <input type="radio" name="entrada" id="idGeneral" value="General" <?php echo isset($_POST['entrada']) && $_POST['entrada'] == "General" ? 'checked' : ''; ?> checked>
            <label for="idGeneral">General</label>
            <input type="radio" name="entrada" id="idMayor" value="Mayor" <?php echo isset($_POST['entrada']) && $_POST['entrada'] == "Mayor" ? 'checked' : ''; ?>>
            <label for="idMayor">Mayor de 60</label>
            <input type="radio" name="entrada" id="idMenor" value="Menor" <?php echo isset($_POST['entrada']) && $_POST['entrada'] == "Menor" ? 'checked' : ''; ?>>
            <label for="idMenor">Menor jde 6 años</label>
            <br>
            <br>
            <label for="idFecha">Fecha del Evento</label><br>
            <input type="date" name="fecha" id="idFecha" value=<?php echo isset($_POST['fecha'])?$_POST['fecha']:date('Y-m-d');?>>
            <br>
            <br>
            <label for="idNum">Número de entradas</label><br>
            <input type="number" name="numeroEnt" id="idNum" value=<?php echo isset($_POST['numeroEnt'])?$_POST['numeroEnt']:'';?>>
            <br>
            <br>
            <label>Descuentos</label><br>
            <select name="descuento[]" multiple='multiple'>
                <option value="sinDes">SinDescuento</option>
                <option value="famNum">FamiliaNumerosa</option>
                <option value="abonado">Abonado</option>
                <option value="diaEspec">DiadelEspectador</option>
            </select>
            <br>
            <br>
            <input type="submit" name="comprar" value="comprar">
        </form>
     </fieldset>

     <?php
     
        if(isset($_POST['comprar'])){

            $error=array();

            if(empty($_POST['nombre']) || empty($_POST['entrada']) || empty($_POST['fecha']) || empty($_POST['numeroEnt'])){
                $error[]='Los campos NOMBRE,ENTRADA,FECHA Y NUMERO DE ENTRADAS deben estar rellenos';
            }elseif(isset($_POST['numeroEnt'])){
                if($_POST['numeroEnt'] < 1 || $_POST['numeroEnt'] > 4){
                    $error[]='El número de entradas debe estar entre el 1 y el 4';
                }
            }

            if($error!=null){

            echo '<h1>Errores</h1>';
            echo '<ul>';
            foreach($error as $err){

                echo '<li>'.$err.'</li>';
            }

            echo '</ul>';


            }else{

               

                $precioEntrada=0;
                $precioTotal=0;
                

                

                $entrada = new Entrada($_POST['nombre'],$_POST['entrada'],$_POST['fecha'],implode('/',$_POST['descuento']),$_POST['numeroEnt'],$precioTotal);

                $m->rellenarEntrada($entrada);


            }

           

        }
        ?>

        <table border='1';>
            <tr>
                <th>NOMBRE</th>
                <th>TIPO DE ENTRADA</th>
                <th>FECHA</th>
                <th>DESCUENTO</th>
                <th>NUMERO DE ENTRADAS</th>
                <th>DESCUENTO</th>
            </tr>
            
        
        <?php

         $entradas=$m->obtenerEntradas();
            foreach($entradas as $ent){
                echo '<tr>';
                echo '<td>'.$ent->getNombre().'</td>';
                echo '<td>'.$ent->getTipo().'</td>';
                echo '<td>'.$ent->getFecha().'</td>';
                echo '<td>'.$ent->getDescuentos().'</td>';
                echo '<td>'.$ent->getNumeroEntradas().'</td>';
                echo '<td>'.$ent->getImporte().'</td>';
                echo '</tr>';
            }
            
            echo '</table>';
         ?>

</body>
</html>