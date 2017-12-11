<?php
include_once '../controller/Usuario.php';
include_once '../model/UsuarioModel.php';
include_once '../controller/Paciente.php';
include_once '../model/PacienteModel.php';

if (isset($_POST['btn_registro'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['pac_rut']);
    $usuario->setUsu_nombre($_POST['pac_nombre']);
    $usuario->setUsu_apellido($_POST['pac_apellido']);
    $usuario->setUsu_perfil('PAC');
    $usuario->setUsu_password($_POST['pac_password']);

    $paciente = new PacienteModel();
    $paciente->setPac_rut($_POST['pac_rut']);
    $paciente->setPac_nombre($_POST['pac_nombre']);
    $paciente->setPac_apellido($_POST['pac_apellido']);
    $paciente->setPac_direccion($_POST['pac_direccion']);
    $paciente->setPac_nacimiento($_POST['pac_nacimiento']);
    $paciente->setPac_sexo($_POST['pac_sexo']);
    $paciente->setPac_telefono($_POST['pac_telefono']);

    if (Usuario::crear($usuario) && Paciente::crear($paciente)) {
        echo "<script type=\"text/javascript\"> alert(\"Usuario creado\");</script>";
        echo "<script>location.href='../index.php';</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Usuario ya existe\");</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Importadora LTT</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://bootswatch.com/3/cerulean/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/login.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.rut.js"></script>
        <script language="javascript">
            $(document).ready(function () {
                $("input#pac_rut").rut({formatOn: 'keyup', useThousandsSeparator: false}).on('rutInvalido', function (e) {
                    alert("El rut " + $(this).val() + " es inválido");
                    $("input#pac_rut").val('');
                });
            });
        </script>
    </head>
    <body>
        <section class="container">
            <form class="form-horizontal" action="" method="POST" id="registro">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Datos Personales</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_rut">Rut</label>  
                        <div class="col-md-6">
                            <input id="pac_rut" name="pac_rut" type="text" placeholder="12345678-9" class="form-control input-md" maxlength="10" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_nombre">Nombre</label>  
                        <div class="col-md-6">
                            <input id="pac_nombre" name="pac_nombre" type="text" placeholder="Juan" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_apellido">Apellido</label>  
                        <div class="col-md-6">
                            <input id="pac_apellido" name="pac_apellido" type="text" placeholder="Perez" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_nacimiento">Fecha de Nacimiento</label>  
                        <div class="col-md-6">
                            <input id="pac_nacimiento" name="pac_nacimiento" type="date" placeholder="" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Multiple Radios -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_sexo">Sexo</label>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <input id="pac_direccion" name="pac_direccion" type="text" placeholder="Av. Uno 123, Santiago" class="form-control input-md" required="">
                            <span class="help-block"> </span>  
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_telefono">Teléfono</label>  
                        <div class="col-md-6">
                            <input id="pac_telefono" name="pac_telefono" type="text" placeholder="987654432" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pac_password">Contraseña</label>
                        <div class="col-md-6">
                            <input id="usu_password" name="pac_password" type="password" placeholder="" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="btn_registro"></label>
                        <div class="col-md-8">
                            <button id="btn_registro" name="btn_registro" class="btn btn-primary">Registrarse</button>
                            <button id="btn_volver" name="btn_volver" class="btn btn-default" type="button" onclick="location.href = '../index.php'">Volver</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </body>
</html>

