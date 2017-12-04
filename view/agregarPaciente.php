<?php
include_once '../model/UsuarioModel.php';
session_start();
include_once '../controller/Paciente.php';
include_once '../model/PacienteModel.php';
include_once '../controller/Usuario.php';

if (isset($_POST['btn_registro'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['pac_rut']);
    $usuario->setUsu_nombre($_POST['pac_nombre'] . " " . $_POST['pac_apellido']);
    $usuario->setUsu_perfil('PAC');
    $usuario->setUsu_password($_POST['pac_password']);

    $paciente = new PacienteModel();
    $paciente->setPac_rut($_POST['pac_rut']);
    $paciente->setPac_nombre($_POST['pac_nombre']);
    $paciente->setPac_apellido($_POST['pac_apellido']);
    $paciente->setPac_direccion($_POST['pac_direccion']);
    $paciente->setPac_sexo($_POST['pac_sexo']);
    $paciente->setPac_telefono($_POST['pac_telefono']);

    if (Usuario::crear($usuario) && Paciente::crear($paciente)) {
        echo "<script type=\"text/javascript\"> alert(\"Paciente creado\");</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al crear Paciente\");</script>";
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
                    <legend>Agregar Paciente</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_rut">Rut</label>  
                        <div class="col-md-4">
                            <input id="pac_rut" name="pac_rut" type="text" placeholder="12345678-9" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_nombre">Nombre</label>  
                        <div class="col-md-4">
                            <input id="pac_nombre" name="pac_nombre" type="text" placeholder="Juan" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_apellido">Apellido</label>  
                        <div class="col-md-4">
                            <input id="pac_apellido" name="pac_apellido" type="text" placeholder="Perez" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_nacimiento">Fecha de Nacimiento</label>  
                        <div class="col-md-4">
                            <input id="pac_nacimiento" name="pac_nacimiento" type="date" placeholder="" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Multiple Radios -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_sexo">Sexo</label>
                        <div class="col-md-4">
                            <div class="radio">
                                <label for="pac_sexo-0">
                                    <input type="radio" name="pac_sexo" id="pac_sexo-0" value="F" checked="checked">
                                    Femenino
                                </label>
                            </div>
                            <div class="radio">
                                <label for="pac_sexo-1">
                                    <input type="radio" name="pac_sexo" id="pac_sexo-1" value="M">
                                    Masculino
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_direccion">Dirección</label>  
                        <div class="col-md-4">
                            <input id="pac_direccion" name="pac_direccion" type="text" placeholder="Av. Uno 123, Santiago" class="form-control input-md" required="">
                            <span class="help-block"> </span>  
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_telefono">Teléfono</label>  
                        <div class="col-md-4">
                            <input id="pac_telefono" name="pac_telefono" type="text" placeholder="987654432" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_password">Contraseña</label>
                        <div class="col-md-4">
                            <input id="usu_password" name="pac_password" type="password" placeholder="" class="form-control input-md" required="">

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