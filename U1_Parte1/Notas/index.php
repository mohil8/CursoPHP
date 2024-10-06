<?php
require_once 'Modelo.php';
$modelo = new Modelo();
//Cargar asignaturas en un array
$asigs = $modelo->obtenerAsignaturas();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Mis Notas de Exámenes y tareas 2º DAW</h1>
    <form action="" method="post">
        <div>
            <label for="asig">Asignatura</label><br/>
            <select name="asig" id="asig">
            <!-- HAcer un option para cada asignatura -->   
             <?php 
             foreach($asigs as $a){
                echo '<option>'.$a.'</option>';
             }
             ?>
            </select>
        </div>
        <br>
        <div>
            <label for="fecha">Fecha</label><br/>
            <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d');?>"/>
        </div>
        <br>
        <div>
            <label for="desc">Descripción</label><br/>
            <textarea name="desc" id="desc" rows="4" cols="50" placeholder="Examen tema 1"></textarea>
       </div>
        <br>
        <div>
            <label>Tipo</label><br/>
            <input type="radio" name="tipo" id="ex" value="Examen" checked="checked"/>
            <label for="ex">Examen</label>
            <input type="radio" name="tipo" id="ta" value="Tarea"/>
            <label for="ta">Tarea</label>
        </div>
        <br>
        <div>
            <label for="nota">Nota</label><br/>
            <input type="number" name="nota" id="nota" placeholder="Nota"/>
        </div>
        <br>
        <input type="submit" name="crear" value="Crear Nota">
        <br>
    </form>
    <?php 
    
    if(isset($_POST['crear'])){
        if(empty($_POST['asig']) || empty($_POST['fecha']) || empty($_POST['desc']) || empty($_POST['tipo']) || empty($_POST['nota']) ){
            echo "<h3 style='color:red;'>Rellena todos los datos</h3>";
        }else{
            $nota = new Nota($_POST['asig'],$_POST['fecha'],$_POST['desc'],$_POST['tipo'],$_POST['nota'],);
            $modelo->crearNota($nota);
        }        
    }
   
    ?>

<table border="1">
    <tr>
        <th>Asignatura</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Tipo</th>
        <th>Nota</th>
    </tr>

    <?php
    
    $not=$modelo->obtenerNotas();
    foreach($not as $nota){
        echo "<tr>";
        echo "<td>".$nota->getAsi()."</td>";
        echo "<td>".$nota->getFecha()."</td>";
        echo "<td>".$nota->getDesc()."</td>";
        echo "<td>".$nota->getTipo()."</td>";
        if ($nota->getNota() < 5) {
            echo "<td style='background-color: red;'>".$nota->getNota()."</td>";
        } else {
            echo "<td style='background-color: green;'>".$nota->getNota()."</td>";
        }
        
        echo "</tr>"; 
    }
  
    ?>
</table>
</body>
</html>