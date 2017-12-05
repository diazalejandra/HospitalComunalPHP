<?php
include_once '/partial/session.php';
include_once '../controller/Medico.php';
include_once '../controller/Consulta.php';
include_once '../model/ConsultaModel.php';
$lista = Medico::listar();

if (isset($_POST['btn_registro'])) {
    $consulta = new ConsultaModel();
    $consulta->setCon_fecha($_POST['con_fecha']);
    $consulta->setCon_paciente($_POST['con_paciente']);
    $consulta->setCon_medico($_POST['con_medico']);
    $consulta->setCon_estado('AGE');

    if (Consulta::crear($consulta)) {
        echo "<script type=\"text/javascript\"> alert(\"Atencion creada\");</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al crear Atencion\");</script>";
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
        <script src="js/jquery.rut.js"></script>
       <script>
            $(function () {
                $("#con_paciente").autocomplete({
                    source: 'buscaPaciente.php'
                });
            });

            $(document).ready(function () {
                $("input#con_paciente").rut({
                    //formatOn: 'keyup',
                    minimumLength: 0, // validar largo mínimo; default: 2
                    validateOn: 'null' // si no se quiere validar, pasar null
                });


                $("input#con_paciente").rut({useThousandsSeparator: false}).on('rutInvalido', function (e) {
                    $('input#con_paciente').val('');
                    alert("El rut " + $(this).val() + " es inválido");
                });
            });
        </script> 
    </head>
    <body>
        <?php
        include_once 'partial/header.php';
        ?>

        <section class="container">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Agregar Atención</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="con_fecha">Fecha</label>  
                        <div class="col-md-4">
                            <input id="con_fecha" name="con_fecha" type="date" placeholder="" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="con_paciente">Rut Paciente</label>  
                        <div class="col-md-4">
                            <input id="con_paciente" name="con_paciente" type="text" placeholder="12345678-9" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="con_medico">Médico</label>  
                        <div class="col-md-4">
                        <select id="con_medico" name="con_medico" required>
                            <option value="">-- Selecionar Medico --</option>
                            <?php foreach ($lista as $value) { ?>
                            <option value="<?php echo $value->getMed_rut(); ?>"><?php echo $value->getMed_apellido() . ", " . $value->getMed_nombre(); ?></option>
                            <?php } ?>
                        </select>  
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="btn_registro"></label>
                        <div class="col-md-4">
                            <button id="btn_registro" name="btn_registro" class="btn btn-primary">Agregar</button>
                            <button id="btn_limpiar" name="btn_limpiar" class="btn btn-default" type="reset">Limpiar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
    </body>
</html>