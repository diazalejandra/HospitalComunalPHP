<?php
include_once '/partial/session.php';
include_once '../controller/Consulta.php';
include_once '../model/ConsultaModel.php';
$lista = null;
if (isset($_POST['btn_fecha'])) {
    $lista = (Consulta::porRango($_POST['fec_ini'], $_POST['fec_fin']));
    if ($lista == null) {
        echo "<script type=\"text/javascript\"> alert(\"No existen datos a consultar\");</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tetengo</title>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <style>
            .menu{
                width: 100%;
            }

            td{
                width: 130px;
            }

            table{
                margin: 0 0 25px;
            }
        </style>
    <body>
        <?php
        include_once 'partial/header.php';
        ?>
        <section class="container">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Estadisticas Atenciones</legend>

                    <table>
                        <tr>
                            <td>
                                Desde:
                            </td>
                            <td>
                                <input type="date" name="fec_ini" id="fec_ini" value="" required=""/>
                            </td>
                            <td>
                                Hasta:
                            </td>
                            <td>
                                <input type="date" name="fec_fin" id="fec_fin" value="" required=""/>
                            </td>
                            <td>
                                <button id="btn_fecha" type="submit" name="btn_fecha" class="btn btn-primary menu">Buscar por fecha</button>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>


            <?php if ($lista != null) { ?>
                <table class='table table-hover table-responsive'>
                    <tr>
                        <th>Cantidad (total)</th>
                        <th>Valorizacion (promedio)</th>
                    </tr>
                    <?php for ($i = 0; $i < count($lista); $i++) { ?>
                        <tr>
                            <td><?php echo $lista[$i]->getCon_cantidad() ?></td>
                            <td><?php echo $lista[$i]->getCon_valorizacion() ?></td>
                        </tr>
                    <?php } ?>
                </table>    

            <?php } ?>
        </section>

    </body>
</html>