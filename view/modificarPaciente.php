<?php
include_once '/partial/session.php';
include_once '../controller/Usuario.php';
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
        </script>
    <body>
        <?php
        include_once 'partial/header.php';
        ?>
        <section class="container">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Modificar Paciente</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_rut">Rut</label>  
                        <div class="col-md-4">
                            <input id="pac_rut" name="pac_rut" type="text" placeholder="12345678-9" class="form-control input-md" required="">

                        </div>
                        <div class="col-md-4">
                            <button id="btn_buscar" type="button" name="btn_buscar" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>

                </fieldset>
            </form>
            <div class="resultado">

            </div>
            <div class="resultadoEli">

            </div>
        </section>

        <script>
            $(document).ready(function () {

                $("#btn_buscar").on("click", function (event) {
                    agregar();
                });

                function agregar() {
                    var settings = {
                        "url": "buscaPaciente.php",
                        "method": "POST",
                        "data": {"pac_rut_mod": $("#pac_rut").val()}
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
                            "url": "buscaPaciente.php",
                            "method": "POST",
                            "data": {"rut_eliminar": id}
                        }

                        $.ajax(settings).done(function (response) {
                            $('.resultadoEli').html('');
                            $('.resultadoEli').html(response)
                            agregar();
                            
                        });
                    });
                }
            });
        </script>
    </body>
</html>