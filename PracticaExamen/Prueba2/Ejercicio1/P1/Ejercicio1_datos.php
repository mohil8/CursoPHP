<?php

$tipoCliente=$_POST['tipo'];
$nombreCliente=$_POST['cliente'];
$email=$_POST['email'];
$motor=$_POST['motor'];
$opciones=isset($_POST['opc'])?$_POST['opc']:[];
$gps=in_array('GPS',$opciones)?1:0;
$clima=in_array('Climatizador',$opciones)?1:0;
$camara=in_array('Camara',$opciones)?1:0;
$vehiculo=$_POST['vehiculo'];
$precio=$_POST['precio'];
$promocion=$_POST['promocion'];

if(isset($_POST['enviar'])){

    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>TipoCliente</th>";
    echo "<td>".$tipoCliente."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>NombreCliente</th>";
    echo "<td>".$nombreCliente."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Email</th>";
    echo "<td>".$email."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Motor</th>";
    echo "<td>".$motor."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Climatizador</th>";
    echo "<td>".$clima."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>GPS</th>";
    echo "<td>".$gps."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Cámara</th>";
    echo "<td>".$camara."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Coche</th>";
    echo "<td>".$vehiculo."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Precio</th>";
    echo "<td>".$precio."€</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Promoción</th>";
    echo "<td>".$promocion."</td>";
    echo "</tr>";
    echo "</table>";
}







?>