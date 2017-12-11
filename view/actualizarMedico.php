<?php
include_once '/partial/session.php';
include_once '../controller/Medico.php';
include_once '../model/MedicoModel.php';
include_once '../controller/Usuario.php';

if (isset($_POST["btn_modificar"])) {
    $lista = Medico::ver($_POST["btn_modificar"])[0];
}
print_r($lista);

if (isset($_POST['btn_registro'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['pac_rut']);
    $usuario->setUsu_nombre($_POST['pac_nombre']);
    $usuario->setUsu_apellido($_POST['pac_apellido']);
    $usuario->setUsu_perfil('MED');
    $usuario->setUsu_password($_POST['pac_password']);

    $medico = new MedicoModel();
    $medico->setMed_rut($_POST['med_rut']);
    $medico->setMed_nombre($_POST['med_nombre']);
    $medico->setMed_apellido($_POST['med_apellido']);
    $medico->setMed_contrato($_POST['med_contrato']);
    $medico->setMed_especialidad($_POST['med_especialidad']);
    $medico->setMed_valor($_POST['med_consulta']);

    if (Usuario::editar($usuario) && Medico::editar($medico)) {
        echo "<script type=\"text/javascript\"> alert(\"Medico actualizado\");</script>";
        echo "<script>location.href='modificarMedico.php';</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al actualizar Medico\");</script>";
        echo "<script>location.href='modificarMedico.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tetengo</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/jquery.rut.js"></script>
        <script language="javascript">
            $(document).ready(function () {
                $("input#med_rut").rut({formatOn: 'keyup', useThousandsSeparator: false, validateOn: 'change'}).on('rutInvalido', function(e) {
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
                    <legend>Actualizar Médico</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_rut">Rut</label>  
                        <div class="col-md-4">
                            <input id="med_rut" name="med_rut" type="text" value="<?php echo $lista->getMed_rut(); ?>" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_nombre">Nombre</label>  
                        <div class="col-md-4">
                            <input id="med_nombre" name="med_nombre" type="text" value="<?php echo $lista->getMed_nombre(); ?>" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_apellido">Apellido</label>  
                        <div class="col-md-4">
                            <input id="med_apellido" name="med_apellido" type="text" value="<?php echo $lista->getMed_apellido(); ?>" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_especialidad">Especialidad</label>  
                        <div class="col-md-4">
                            <input id="med_especialidad" name="med_especialidad" type="text" value="<?php echo $lista->getMed_especialidad(); ?>" class="form-control input-md" required="">
                            <span class="help-block"> </span>  
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_contrato">Fecha de Contratación</label>  
                        <div class="col-md-4">
                            <input id="med_contrato" name="med_contrato" type="date" value="<?php echo $lista->getMed_contrato(); ?>" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_consulta">Valor Consulta</label>  
                        <div class="col-md-4">
                            <input id="med_consulta" name="med_consulta" type="number" value="<?php echo $lista->getMed_valor(); ?>" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_password">Contraseña</label>
                        <div class="col-md-4">
                            <input id="med_password" name="med_password" type="password" placeholder="" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="btn_registro"></label>
                        <div class="col-md-4">
                            <button id="btn_registro" name="btn_registro" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
    </body>
</html>