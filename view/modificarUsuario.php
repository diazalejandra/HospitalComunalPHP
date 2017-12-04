<?php
include_once '../model/UsuarioModel.php';
session_start();
include_once '../controller/Usuario.php';
$lista = Usuario::listar();
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
                $("#usu_id").autocomplete({
                    source: 'buscaUsuario.php'
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
                    <legend>Buscar Usuario</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_id">Rut</label>  
                        <div class="col-md-4">
                            <input id="usu_id" name="usu_id" type="text" placeholder="12345678-9" class="form-control input-md" required="">

                        </div>
                        <div class="col-md-4">
                            <button id="btn_buscar" type="button" name="btn_buscar" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>

                </fieldset>
            </form>
            <div class="resultado">
                <table class='table table-hover table-responsive'>
                    <tr> 
                        <th> Rut </th> 
                        <th> Nombre </th>
                        <th> Perfil </th> 
                        <th> Opciones </th>
                    </tr>
                    <?php for ($i = 0; $i < count($lista); $i++) { ?>
                        <tr> 
                            <td> <?php echo $lista[$i]->getUsu_id(); ?></td>
                            <td> <?php echo $lista[$i]->getUsu_nombre(); ?></td>
                            <td> <?php echo $lista[$i]->getUsu_perfil(); ?></td>
                            <td> <input type="button" class="btn_eliminar" value="Eliminar" attr-id="<?php $lista[$i]->getUsu_id(); ?>"/>
                                 <input type="button" class="btn_modificar" value="Modificar" attr-id="<?php $lista[$i]->getUsu_id(); ?>"/>                          
                            </td>
                        </tr>
                    <?php } ?>
                </table>
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
                        "url": "buscaUsuario.php",
                        "method": "POST",
                        "data": {"usu_id_mod": $("#usu_id").val()}
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
                            "url": "buscaUsuario.php",
                            "method": "POST",
                            "data": {"id_usuario": id}
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