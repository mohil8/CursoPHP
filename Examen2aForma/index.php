<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>
<body>
    <form action="#" method="post">
        <label for="idDNI">DNI</label><br>
        <input type="text" id="idDNI" name='dni' value=<?php echo isset($_POST['dni'])?$_POST['dni']:'';?>>
        <br>
        <label for="idNombre">Nombre Cliente</label><br>
        <input type="text" id="idNombre" name="nombre" value=<?php echo isset($_POST['nombre'])?$_POST['nombre']:'';?>>
        <br><br>
        <label for="idTipo">Tipo Habitación</label><br>
        <select name="tipo" id="tipHab" value=<?php echo isset($_POST['tipo'])?$_POST['tipo']:'';?>>
            <option value="Doble" selected>Doble</option>
            <option value="Individual">Individual</option>
            <option value="Suite">Suite</option>
        </select>
        <br><br>
        <label for="idNoches">Nº de Noches</label><br>
        <input type="number" id="idNoches" name="noches">
        <br>
        <label for="idEstancia">Estancia</label><br>
        <select name="estancia" id="idEstancia">
            <option value="Diario" selected>Diario</option>
            <option value="finSemana">Fin de semana</option>
            <option value="Promocionado">Promocionado</option>
        </select>
        <br><br>
        <label>Pago</label><br>
        <input type="radio" name="pago" id="idEfectivo" value='efectivo'>
        <label for="idEfectivo">Efectivo</label>
        <input type="radio" name="pago" id="" value='tarjeta'>
        <label for="idTarjeta">Tarjeta</label>
        <br><br>
        <label>Opciones</label><br>
        <input type="checkbox" name="opc[]" value="cuna" id="idCuna">
        <label for="idCuna">Cuna</label>
        <input type="checkbox" name="opc[]" value="cama" id="idCama">
        <label for="idCama">Cama Supletoria</label>
        <input type="checkbox" name="opc[]" value="lavanderia" id="idLavanderia">
        <label for="idLavanderia">Lavandería</label>
        <br><br>
        <input type="submit" name="crear" value="Crear Estancia">
        <input type="submit" name="ver" value="Ver Estancias">
    </form>

    <?php
    
    if(isset($_POST['crear'])){

        $error=array();

        if(empty($_POST['dni']) || empty($_POST['nombre']) || empty($_POST['noches'])){
            $error[]='Rellena todos los campos';
        }else if($_POST['pago']=='efectivo' && $_POST['noches']>1){
            $error[]='Si son mas de dos noches no puedes pagar en efectivo';
        }else if(in_array('cama', $_POST['opc']) && in_array('cuna', $_POST['opc'])){
            $error[]='No se puede elegir cuna y Cama Supletoria a la vez';
        }

        if($error!=null){

            echo '<h1 style="color:red">Errores</h1>';
            echo '<ul>';
            foreach($error as $err){
                echo '<li>'.$err.'</li>';
            }
            echo '</ul>';
        }else{

           echo '<h1 style="color:red">Entrada correcta</h1>';
           
           $importe=0;

           if($_POST['tipo']=='Individual'){
            $importe+=45*$_POST['noches'];
           }else if($_POST['tipo']=='Doble'){
            $importe+=55*$_POST['noches'];
           }else if($_POST['tipo']=='Suite'){
            $importe+=75*$_POST['noches'];
           }

           $precioFin=$importe;
            
            if($_POST['estancia']=='FinSemana'){
                
                $precioFin+=$importe*0.1;

           }else if($_POST['estancia']=='Promocionado'){
            $precioFin-=$importe*0.1;
           }

           echo '<h3 style="color:green">El importe de la estancia es de '.$importe.
           '€, siendo '.$precioFin.'€ el importe</h3>';

        }

    }
    
    
    ?>
</body>
</html>