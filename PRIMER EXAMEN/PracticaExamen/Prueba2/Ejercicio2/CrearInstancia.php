<?php
$cuentaError=0;

function descuento($precio){

    $estancia=$_POST['estancia'];

    if($estancia === "finSemana"){

        $precio+=$precio*0.10;
    }elseif($estancia === "promocionado"){

        $precio-=$precio*0.10;
    }

    return $precio;

}
if(isset($_POST['validar'])){

//Variable a comprobar 
    $DNI=$_POST['dni'];
    $NombreCliente=$_POST['cliente'];
    $noche = $_POST['noches'];
    $pago = $_POST['pago'];
    $habitacion=$_POST['habitacion'];

    if(empty($DNI) || empty($NombreCliente) || empty($noche)){
        echo "<li>Dni,nombre del cliente o número de noches esta vacio</li>";
        
    }elseif($noche>2 && $pago=="efectivo" ){
        echo"<li>No puedes pagar en efectivo si la estancia es de mas de 2 noches </li>";
        
    }else{

        if($habitacion==="individual"){
            $precio = 45*$noche;
            $Total=descuento($precio);
            echo "<h1 style='color:red;'>Entrada correcta.El importe de esta estancia es de ".$Total."€</h1>";

        }elseif($habitacion==="doble"){
            $precio = 55*$noche;
            $Total=descuento($precio);
            echo "<h1 style='color:red;'>Entrada correcta.El importe de esta estancia es de ".$Total."€</h1>";
        }elseif($habitacion==="suite"){
            $precio = 75*$noche;
            $Total=descuento($precio);
            echo "<h1 style='color:red;'>Entrada correcta.El importe de esta estancia es de ".$Total."€</h1>";
        }
       
    }


   


}



?>