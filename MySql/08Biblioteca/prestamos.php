<?php
require_once 'controlador.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
</head>

<body>
    <?php
    require_once 'menu.php';
    ?>
    <div>
        <br />
        <div>
            <!-- ÁREA DE ERRORES -->
            <?php
            if (isset($mensaje)) {
                echo '<div style="color: green;">' . $mensaje . '</div>';
            }
            if (isset($error)) {
                echo '<div style="color: red;">' . $error . '</div>';
            }
            ?>
        </div>
        <div>
            <!-- ÁREA DE INSERT (SÓLO ADMIN) -->
            <?php
            if ($_SESSION['usuario']->getTipo() == 'A') {
                //Obtenemos los socios
                $socios = $bd->obtenerSocios();
                //Obtenemos libros
                $libros = $bd->obtenerLibros();
            ?>
                <form action="" method="post">
                    <div>
                        <label for="socio">Socio</label>
                        <select name="socio" id="socio">
                            <?php
                            foreach ($socios as $s) {
                                echo '<option value="' . $s->getId() . '">'
                                    . $s->getNombre() . '-' . $s->getUs() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="libro">Libro</label>
                        <select name="libro" id="libro">
                            <?php
                            foreach ($libros as $l) {
                                echo '<option value="' . $l->getId() . '">'
                                    . $l->getTitulo() . '-' . $l->getEjemplares() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label>Acción</label><br />
                        <button type="submit" id="pCrear" name="pCrear">+</button>
                    </div>
                </form>
            <?php
            } else {
                echo '<h5>Estadística</h5>';
                echo '<div>';
                //Pintar estadística de socio
                $s = $bd->obtenerSocioDni($_SESSION['usuario']->getId());
                $datos = $bd->estadistica($s->getId());
                $autores = false;
                foreach ($datos as $d) {
                    if ($d[0] == 1) {
                        pintarCard($d);
                    } elseif ($d[0] == 2) {
                        if (!$autores) {
                            echo '</div>';
                            echo '<h5>Libros leídos por autor</h5>';
                            echo '<div>';
                            $autores = true;
                        }
                        pintarCard($d);
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
        <div>
            <br />
            <!-- mostrar préstamos -->
            <form action="" method="post">
                <table border="1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Socio</th>
                            <th>Libro</th>
                            <th>Fecha Préstamos</th>
                            <th>Fecha Devolución</th>
                            <th>Fecha Real Devolución</th>
                            <?php if ($_SESSION['usuario']->getTipo() == 'A') { ?>
                                <th>Acciones</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SESSION['usuario']->getTipo() == 'A') {
                            $prestamos = $bd->obtenerPrestamos();
                        } elseif ($_SESSION['usuario']->getTipo() == 'S') {
                            $prestamos = $bd->obtenerPrestamosSocio($_SESSION['usuario']);
                        } else {
                            $prestamos = array();
                        }
                        foreach ($prestamos as $p) {
                            echo '<tr>';
                            echo '<td>' . $p->getId() . '</td>';
                            echo '<td>' . $p->getSocio()->getNombre() . '-' . $p->getSocio()->getUs() . '</td>';
                            echo '<td>' . $p->getLibro()->getTitulo() . '-' . $p->getLibro()->getAutor() . '</td>';
                            echo '<td>' . date('d/m/Y', strtotime($p->getFechaP())) . '</td>';
                            echo '<td>' . date('d/m/Y', strtotime($p->getFechaD())) . '</td>';
                            echo '<td>' .
                                ($p->getFechaRD() == null ? '' : date('d/m/Y', strtotime($p->getFechaRD()))) .
                                '</td>';
                            if ($_SESSION['usuario']->getTipo() == 'A') {
                                echo '<td>';
                                echo ($p->getFechaRD() == null ?
                                    '<button type="submit" name="pDevolver" 
                                    value="' . $p->getId() . '">Devolver</button>'
                                    : '');
                                echo '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
