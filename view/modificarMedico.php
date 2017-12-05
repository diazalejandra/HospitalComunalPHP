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
                $("#med_rut").autocomplete({
                    source: 'buscaMedico.php'
                });
            });
            
            $(document).ready(function () {
                $("input#med_rut").rut({
                    //formatOn: 'keyup',
                    minimumLength: 0, // validar largo mínimo; default: 2
                    validateOn: 'null' // si no se quiere validar, pasar null
                });


                $("input#med_rut").rut({useThousandsSeparator: false}).on('rutInvalido', function (e) {
                    $('input#med_rut').val('');
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
                    <legend>Modificar Medico</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_rut">Rut</label>  
                        <div class="col-md-4">
                            <input id="med_rut" name="med_rut" type="text" placeholder="12345678-9" class="form-control input-md" required="">

                        </div>
                        <div class="col-md-4">
                            <button id="btn_buscar" type="button" name="btn_buscar" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>

                </fieldset>
            </form>
            <div class="resultado"></div>
            <div class="resultadoEli"></div>
        </section>

        <script>
            $(document).ready(function () {

                $("#btn_buscar").on("click", function (event) {
                    agregar();
                });

                function agregar() {
                    var settings = {
                        "url": "buscaMedico.php",
                        "method": "POST",
                        "data": {"med_rut_mod": $("#med_rut").val()}
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
                            "url": "buscaMedico.php",
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