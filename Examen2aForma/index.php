<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>
<body>
    
        <form action="#" method="post">
            <fieldset style="border: 2px solid black; display: inline;">
                <legend>HOla todos</legend>

                <label for="idTit">Titulo de la pelicula</label><br>
                <input type="text" id="idTit" name="titulo" value='<?php echo isset($_POST['titulo']) ? $_POST['titulo']:'';?>' ><br>
                <label for="idFech">Fecha de registro</label><br>
                <input type="date" id="idFech" name="fecha" value=<?php echo isset($_POST['fecha'])? $_POST['fecha']:date('Y-m-d');?>><br>
                <label for="idGen">Genero</label><br>
                <select name="genero[]" id="idGen" multiple="multiple">
                    <option>Comedia</option>
                    <option>Drama</option>
                    <option>Terror</option>
                    <option>Aventura</option>
                </select>
                <br> 
                <label>Tipo</label><br>
                <label for="idPeli">Pelicula</label>
                <input type="radio" name="tipo" id="idPeli" value="pelicula" <?php echo isset($_POST['tipo']) && $_POST['tipo']=='pelicula' ? 'checked':'';?> checked>
                <label for="idSerie">Serie</label>
                <input type="radio" name="tipo" id="idSerie" value="serie" <?php echo isset($_POST['tipo']) && $_POST['tipo']=='serie' ? 'checked':'';?>>
                <br>
                <label for="idCap">Nº de Capítulos</label><br>
                <input type="number" id="idCap" name="capitulos" value=<?php echo isset($_POST['capitulos']) ? $_POST['capitulos']:'';?>>
                <br><br>
                <input type="submit" name="guardar" value="Guardar">

            </fieldset>

            <?php
            
            if(isset($_POST['guardar'])){
                $error=array();

                if(empty($_POST['titulo']) || empty($_POST['fecha']) || empty($_POST['capitulos'])){
                    $error[]='Error, rellene todos los datos';
                }else if($_POST['tipo']=='serie' && $_POST['capitulos']<2){
                    $error[]='Si eliges serie debes tener mas de un capitulo';
                }else if(empty($_POST['genero'])){
                    $error[]='Debes elegir al menos un genero';
                }

                if($error==null){
                    $generos = implode('/',$_POST['genero']);
                    echo '<h1 style="color:red;">Datos Correctos</h1>';
                    echo '<h1>Pelicula: '.$_POST['titulo'].'</h1>';
                    echo '<h1>Género: '.$generos.'</h1>';
                }else{

                    echo '<h1>Errores:</h1><ul>';
                    foreach($error as $err){
                        echo '<li>'.$err.'</li>';
                    }
                    echo '<ul>';
                }

            }
            
            ?>
        </form>


</body>
</html>