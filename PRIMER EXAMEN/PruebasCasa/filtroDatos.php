<?php 

 $nombre = '';
 $edad = '';
 $hobbie = '';
 $sexo = '';

 if(!empty($_POST['nombre'])){

    $nombre= $_POST['nombre'];
 }
 if(!empty($_POST['edad'])){

    $edad= $_POST['edad'];
 }
 if(isset($_POST['hobbie'])){

    foreach($_POST['hobbie'] as $h){
        $hobbie .= $h." |";
    }
if(isset($_POST['sexo'])){

    $sexo = $_POST['sexo'];

} 

echo "<h3>Nombre: ".$nombre."</h3>";
echo "<h3>Edad: ".$edad."</h3>";
echo "<h3>Hobbies: ".$hobbie."</h3>";
echo "<h3>Sexo: ".$sexo."</h3>";

 }

?>