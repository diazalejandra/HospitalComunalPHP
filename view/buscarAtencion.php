<?php
include_once '../model/UsuarioModel.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tetengo</title>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#pac_rut").autocomplete({
                    source: 'buscaPaciente.php'
                });
            });

            $(function () {
                $("#med_rut").autocomplete({
                    source: 'buscaMedico.php'
                });
            });
        </script>
    <body>
        <?php
        include_once 'partial/header.php';
        ?>
        <section class="container">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Buscar Atencion</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_rut">Rut Paciente</label>  
                        <div class="col-md-4">
                            <input id="pac_rut" name="pac_rut" type="text" placeholder="12345678-9" class="form-control input-md" required="">

                        </div>
                        <div class="col-md-4">
                            <button id="btn_buscarPac" type="button" name="btn_buscarPac" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_rut">Rut Medico</label>  
                        <div class="col-md-4">
                            <input id="med_rut" name="med_rut" type="text" placeholder="12345678-9" class="form-control input-md" required="">

                        </div>
                        <div class="col-md-4">
                            <button id="btn_buscarMed" type="button" name="btn_buscarMed" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>

                </fieldset>
            </form>
            <div class="resultado"></div>
        </section>

        <script>
            $(document).ready(function () {

                $("#btn_buscarPac").on("click", function (event) {
                    agregar();
                });

                function agregar() {
                    var settings = {
                        "url": "buscaAtencion.php",
                        "method": "POST",
                        "data": {"pac_rut": $("#pac_rut").val(), "med_rut": $("#med_rut").val()}
                    }

                    $.ajax(settings).done(function (response) {
                        $('.resultado').html('');
                        $('.resultado').html(response)
                        // eliminar();
                    });
                }

                function eliminar() {
                    $(".btn_eliminar").on("click", function (e) {
                        var id = $(this).attr("attr-id");
                        var settings = {
                            "url": "buscarUsuario.php",
                            "method": "POST",
                            "data": {"id_usuario": id}
                        }

                        $.ajax(settings).done(function (response) {
                            //                        $('.resultadoEli').html('');
                            //                        $('.resultadoEli').html(response)
                            agregar();
                        });
                    });
                }
            });
        </script>
    </body>
</html>