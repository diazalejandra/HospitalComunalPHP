<?php
include_once '/partial/session.php';
include_once '../controller/Consulta.php';
include_once '../controller/Paciente.php';
include_once '../model/ConsultaModel.php';
$lista = [];
if (isset($_SESSION['userlogin'])) {
    $usuario = $_SESSION['userlogin'][0];
    $lista = Paciente::ver($usuario->getUsu_id())[0];
    $atenciones = Consulta::buscarPorRut($usuario->getUsu_id());
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
    <body>
        <?php
        include_once 'partial/header.php';
        ?>
        <section class="container">
            <?php if ($lista != null) { ?>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <th colspan='2'>
                            Datos del paciente
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Rut
                        </td>
                        <td>
                            <?php echo $lista->getPac_rut() ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nombre
                        </td>
                        <td>
                            <?php echo $lista->getPac_nombre() ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Apellido
                        </td>
                        <td>
                            <?php echo $lista->getPac_apellido() ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Fecha de Nacimiento
                        </td>
                        <td>
                            <?php echo $lista->getPac_nacimiento() ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sexo
                        </td>
                        <td>
                            <?php echo $lista->getPac_sexo() ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Telefono
                        </td>
                        <td>
                            <?php echo $lista->getPac_telefono() ?>
                        </td>
                    </tr>
                </table>

                <table class='table table-hover table-responsive'>
                    <tr>
                        <th colspan='2'>
                            Historial de Atenciones
                        </th>
                    </tr>
                    <?php if ($atenciones != null) { ?>
                        <tr> 
                            <th> ID </th> 
                            <th> Fecha </th>
                            <th> Horario </th> 
                            <th> Rut Paciente </th>
                            <th> Paciente </th> 
                            <th> Rut Médico </th> 
                            <th> Médico </th> 
                            <th> Estado </th> 
                        </tr>
                        <?php for ($i = 0; $i < count($atenciones); $i++) { ?>
                            <tr> 
                                <td> <?php echo $atenciones[$i]->getCon_id() ?></td>
                                <td> <?php echo $atenciones[$i]->getCon_fecha() ?></td> 
                                <td> <?php echo $atenciones[$i]->getCon_horario_det() ?></td>
                                <td> <?php echo $atenciones[$i]->getCon_paciente() ?></td> 
                                <td> <?php echo $atenciones[$i]->getCon_paciente_det() ?></td> 
                                <td> <?php echo $atenciones[$i]->getCon_medico() ?></td> 
                                <td> <?php echo $atenciones[$i]->getCon_medico_det() ?></td>
                                <td> <?php echo $atenciones[$i]->getCon_estado_det() ?></td>
                            </tr>
                        <?php }} else { ?>
                        <td colspan='2'>No existe informacion para mostrar</td>
                    <?php } ?>
                </table>
            <?php } ?>
        </section>
    </body>
</html>