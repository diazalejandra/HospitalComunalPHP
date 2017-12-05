<?php
include_once '/partial/session.php';
include_once '../controller/Consulta.php';
include_once '../model/ConsultaModel.php';

if (isset($_POST['btn_act_anu'])) {
    if (Consulta::actualizarAnulada($_POST['btn_act_anu'])) {
        echo "<script type=\"text/javascript\"> alert(\"Atenciones actualizadas\");</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al actualizar atenciones\");</script>";
    }
}
if (isset($_POST['btn_act_per'])) {
    if (Consulta::actualizarPerdida($_POST['btn_act_per'])) {
        echo "<script type=\"text/javascript\"> alert(\"Atenciones actualizadas\");</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al actualizar atenciones\");</script>";
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
                    <legend>Buscar Atención por Estado</legend>

                    <table>
                        <tr>
                            <td>
                                <button id="btn_age" type="button" name="btn_age" value="AGE" class="btn btn-primary menu">Agendadas</button>
                            </td>
                            <td>
                                <button id="btn_con" type="button" name="btn_con" value="CON" class="btn btn-primary menu">Confirmadas</button>
                            </td>
                            <td>
                                <button id="btn_anu" type="button" name="btn_anu" value="ANU" class="btn btn-primary menu">Anuladas</button>
                            </td>
                            <td>
                                <button id="btn_per" type="button" name="btn_per" value="PER" class="btn btn-primary menu">Perdidas</button>
                            </td>
                            <td>
                                <button id="btn_rea" type="button" name="btn_rea" value="REA" class="btn btn-primary menu">Realizadas</button>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <button id="btn_act_con" type="button" name="btn_act_con" value="" class="btn btn-success menu">Ver Pendientes</button>
                            </td>
                            <td>
                                <button id="btn_act_anu" type="submit" name="btn_act_anu" value="ANU" class="btn btn-success menu">Actualizar</button>
                            </td>
                            <td>
                                <button id="btn_act_per" type="submit" name="btn_act_per" value="PER" class="btn btn-success menu">Actualizar</button>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
            <div class="resultado"></div>
        </section>
        <div class="resultadoEli"></div>
    </section>

    <script>
        $(document).ready(function () {

            $("#btn_age").on("click", function (event) {
                agregarAg();
            });
            $("#btn_con").on("click", function (event) {
                agregarCo();
            });
            $("#btn_anu").on("click", function (event) {
                agregarAn();
            });
            $("#btn_per").on("click", function (event) {
                agregarPe();
            });
            $("#btn_rea").on("click", function (event) {
                agregarRe();
            });
            $("#btn_act_con").on("click", function (event) {
                agregarVer();
            });

            function agregarAg() {
                var settings = {
                    "url": "buscaAtencion.php",
                    "method": "POST",
                    "data": {"btn_buscar_est": $("#btn_age").val()}
                }

                $.ajax(settings).done(function (response) {
                    $('.resultado').html('');
                    $('.resultado').html(response)
                    eliminar();
                });
            }
            function agregarCo() {
                var settings = {
                    "url": "buscaAtencion.php",
                    "method": "POST",
                    "data": {"btn_buscar_est": $("#btn_con").val()}
                }

                $.ajax(settings).done(function (response) {
                    $('.resultado').html('');
                    $('.resultado').html(response)
                    eliminar();
                });
            }
            function agregarAn() {
                var settings = {
                    "url": "buscaAtencion.php",
                    "method": "POST",
                    "data": {"btn_buscar_est": $("#btn_anu").val()}
                }

                $.ajax(settings).done(function (response) {
                    $('.resultado').html('');
                    $('.resultado').html(response)
                    eliminar();
                });
            }
            function agregarPe() {
                var settings = {
                    "url": "buscaAtencion.php",
                    "method": "POST",
                    "data": {"btn_buscar_est": $("#btn_per").val()}
                }

                $.ajax(settings).done(function (response) {
                    $('.resultado').html('');
                    $('.resultado').html(response)
                    eliminar();
                });
            }
            function agregarRe() {
                var settings = {
                    "url": "buscaAtencion.php",
                    "method": "POST",
                    "data": {"btn_buscar_est": $("#btn_rea").val()}
                }

                $.ajax(settings).done(function (response) {
                    $('.resultado').html('');
                    $('.resultado').html(response)
                    eliminar();
                });
            }
            function agregarVer() {
                var settings = {
                    "url": "buscaAtencion.php",
                    "method": "POST",
                    "data": {"btn_act_con": $("#btn_act_con").val()}
                }

                $.ajax(settings).done(function (response) {
                    $('.resultado').html('');
                    $('.resultado').html(response)
                    eliminar();
                });
            }

            function eliminar() {
                $(".btn_eliminar").on("click", function (e) {
                    var id = $(this).attr("attr-id");
                    var settings = {
                        "url": "buscaAtencion.php",
                        "method": "POST",
                        "data": {"id_eliminar": id}
                    }

                    $.ajax(settings).done(function (response) {
                        $('.resultadoEli').html('');
                        $('.resultadoEli').html(response)
                        agregarM();

                    });
                });
            }
        });
    </script>
</body>
</html>