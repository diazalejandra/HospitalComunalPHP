<?php
include_once '/partial/session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tetengo</title>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="js/jquery.rut.js"></script>
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

            $(document).ready(function () {
               $("input#pac_rut").rut({formatOn: 'keyup', useThousandsSeparator: false, validateOn: 'change'}).on('rutInvalido', function(e) {
                    alert("El rut " + $(this).val() + " es inválido");
                });
                
                $("input#med_rut").rut({formatOn: 'keyup', useThousandsSeparator: false, validateOn: 'change'}).on('rutInvalido', function(e) {
                    alert("El rut " + $(this).val() + " es inválido");
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
                    <legend>Buscar Atención</legend>

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
                    agregarP();
                });
                
                $("#btn_buscarMed").on("click", function (event) {
                    agregarM();
                });

                function agregarM() {
                    var settings = {
                        "url": "buscaAtencion.php",
                        "method": "POST",
                        "data": {"med_rut": $("#med_rut").val()}
                    }

                    $.ajax(settings).done(function (response) {
                        $('.resultado').html('');
                        $('.resultado').html(response)
                        // eliminar();
                    });
                }
                function agregarP() {
                    var settings = {
                        "url": "buscaAtencion.php",
                        "method": "POST",
                        "data": {"pac_rut": $("#pac_rut").val()}
                    }

                    $.ajax(settings).done(function (response) {
                        $('.resultado').html('');
                        $('.resultado').html(response)
                        // eliminar();
                    });
                }
            });
        </script>
    </body>
</html>