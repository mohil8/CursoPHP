<?php 

require_once "Modelo.php";
require_once "Pelicula.php";
function seleccionarTipo($tipo, $validar) {
    if((isset($_POST['tipo']) && $_POST['tipo'] == $tipo) || $validar) {
        echo 'checked="checked"';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<fieldset>
<legend>Crear pelicula</legend>
    <form action="" method="post">
   
    <label >Titulo de la pelicula</label>
    <br>
    <input type="text" name="tituloPagina" placeholder="la momia" value="<?php echo (isset($_POST['tituloPagina']) ? $_POST['tituloPagina'] : ''); ?>" >
    <br><br>
    <label>Fecha de registro</label>
    <br/>
    <input type="date" name="fechaRegistro" value="<?php echo (isset($_POST['fechaRegistro']) ? $_POST['fechaRegistro'] : date('Y-m-d')) ?>"/>         
    <br>
    <label>Genero</label>
            <br/>
    <select name="genero[]" multiple="multiple">
                <option >Comedia</option>
                <option >Drama </option>
                <option >Terror</option>
                <option >Aventura</option>
    </select>  
    <br>
    <label >Tipo</label> 
    <br>
    <input type="radio" name="tipo" value="Pelicula" <?php seleccionarTipo('Pelicula',true)?>/>Pelicula
    <input type="radio" name="tipo" value="Serie"  <?php seleccionarTipo('Serie',false)?>/>Serie
    <br>
    <label >Nº capitulos</label>
    <input type="number" name="numeroCapitulos" value="<?php echo (isset($_POST['numeroCapitulos']) ? $_POST['numeroCapitulos'] : ''); ?>">
    <br><br>
    <input type="submit" name="guardar" value="Guardar">
    </form>
    </fieldset>
    <?php 
          $modelo = new Modelo();
         if(isset($_POST['guardar'])){
            if(empty($_POST['tituloPagina']) || empty($_POST['fechaRegistro']) || empty($_POST['numeroCapitulos'])){
            echo "<h3 style='color:red;'>Error, El titulo ,la fecha y el nº de capitulos no pueden estar vacios</h3>";
            }elseif(($_POST['tipo']=="Serie") && $_POST['numeroCapitulos']==1){
                echo "<h3 style='color:red;'>Error, Si se marca el tipo SERIE , el numero de de capitulos debe ser mayor que 1</h3>";
            }else{
                $validar = true;
                foreach($_POST['genero'] as $genero) {
                    if($genero == 'Comedia' || $genero == 'Drama' || $genero == 'Terror' || $genero == 'Aventura' ) {
                        $validar = false;
                        break;
                    }
                }
                if($validar) {
                    echo "<h3 style='color:red;'>Error, al menos una categoria debe ser seleccionada</h3> ";
                }else{
                    echo '<h3 style="color:green;">Los Datos intruducidos son  correctos. </br>/Pelicula '.$_POST['tituloPagina'].'</br> Genero:'.implode('/', $_POST['genero']).'</h3>';
                }
            }
            $pelicula = new Pelicula($_POST['tituloPagina'], $_POST['fechaRegistro'],implode('/', $_POST['genero']),$_POST['tipo'],$_POST['numeroCapitulos']);

            $modelo->insertarPelicula($pelicula);
        }
           
            $peliculas = $modelo->obtenerPeliculas();
            ?>
        <table border="1">
            <tr>
                <th>Nombre de la pelicula</th>
                <th>fecha</th>
                <th>genero</th>
                <th>Tipo</th>
                <th>Numero de capitulos</th>
                
            </tr>
            <?php
            foreach($peliculas as $pelicula) {
                echo '<tr>'.
                     '<td>'.$pelicula->getNombre().'</td>'.
                     '<td>'.$pelicula->getFecha().'</td>'.
                     '<td>'.$pelicula->getGenero().'</td>'.
                     '<td>'.$pelicula->getTipo().'</td>'.
                     '<td>'.$pelicula->getCapitulos().'</td>'.
                     '</tr>';
            }
            ?>
        </table>
    <?php
    
    ?>
    


   

</html>