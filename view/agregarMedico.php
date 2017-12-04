<?php
include_once '../model/UsuarioModel.php';
session_start();
include_once '../controller/Medico.php';
include_once '../model/MedicoModel.php';
include_once '../controller/Usuario.php';

if (isset($_POST['btn_registro'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['med_rut']);
    $usuario->setUsu_nombre($_POST['med_nombre'] . " " . $_POST['med_apellido']);
    $usuario->setUsu_perfil('MED');
    $usuario->setUsu_password($_POST['med_password']);

    $medico = new MedicoModel();
    $medico->setMed_rut($_POST['med_rut']);
    $medico->setMed_nombre($_POST['med_nombre']);
    $medico->setMed_apellido($_POST['med_apellido']);
    $medico->setMed_contrato($_POST['med_contrato']);
    $medico->setMed_especialidad($_POST['med_especialidad']);
    $medico->setMed_valor($_POST['med_consulta']);

    if (Usuario::crear($usuario) && Medico::crear($medico)) {
        echo "<script type=\"text/javascript\"> alert(\"Medico creado\");</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al crear Medico\");</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tetengo</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
        include_once 'partial/header.php';
        ?>
        <section class="container">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Agregar Médico</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_rut">Rut</label>  
                        <div class="col-md-4">
                            <input id="med_rut" name="med_rut" type="text" placeholder="12345678-9" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_nombre">Nombre</label>  
                        <div class="col-md-4">
                            <input id="med_nombre" name="med_nombre" type="text" placeholder="Juan" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_apellido">Apellido</label>  
                        <div class="col-md-4">
                            <input id="med_apellido" name="med_apellido" type="text" placeholder="Perez" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_especialidad">Especialidad</label>  
                        <div class="col-md-4">
                            <input id="med_especialidad" name="med_especialidad" type="text" placeholder="Médico Cirujano" class="form-control input-md" required="">
                            <span class="help-block"> </span>  
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_contrato">Fecha de Contratación</label>  
                        <div class="col-md-4">
                            <input id="med_contrato" name="med_contrato" type="date" placeholder="" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="med_consulta">Valor Consulta</label>  
                        <div class="col-md-4">
                            <input id="med_consulta" name="med_consulta" type="number" placeholder="40000" class="form-control input-md" required="">

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
                            <button id="btn_limpiar" name="btn_limpiar" class="btn btn-default" type="reset">Limpiar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
    </body>
</html>