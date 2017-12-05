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
                $("input#pac_rut").rut({
                    //formatOn: 'keyup',
                    minimumLength: 0, // validar largo mínimo; default: 2
                    validateOn: 'null' // si no se quiere validar, pasar null
                });


                $("input#pac_rut").rut({useThousandsSeparator: false}).on('rutInvalido', function (e) {
                    $('input#pac_rut').val('');
                    //alert("El rut " + $(this).val() + " es inválido");
                });
            });
        </script>
    </head>
    <body>
        <div class="custom_body">
            <div class="container">
                <div class="row">
                    <div class="login_box">
                        <section class="main-box">
                            <form name="frm_registro" action="" method="POST">

                                <div class="input-box" id="titulo">
                                    <b>REGISTRO DE PACIENTE</b>
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-briefcase"></i></span>
                                    <input id="pac_rut" type="text" class="form-control input_layout" name="pac_rut" placeholder="RUT" minlength="1" maxlength="10" required="">
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="pac_nombre" type="text" class="form-control input_layout" name="pac_nombre" placeholder="Nombre" minlength="1" maxlength="30" required="">
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="pac_apellido" type="text" class="form-control input_layout" name="pac_apellido" placeholder="Apellido" minlength="1" maxlength="30" required="">
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-home"></i></span>
                                    <input id="pac_direccion" type="text" class="form-control input_layout" name="pac_direccion" placeholder="Direccion" minlength="1" maxlength="30" required="">
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                    <input id="pac_telefono" type="number" class="form-control input_layout" name="pac_telefono" placeholder="Telefono" required="">
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-home"></i></span>
                                    <select id="pac_sexo" name="pac_sexo" class="form-control" required="">
                                        <option value="">SELECCIONE SEXO</option>
                                        <option value="F">Femenino</option>
                                        <option value="M">Masculino</option>
                                    </select>
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="pac_password" type="password" class="form-control input_layout" name="pac_password" placeholder="Password" minlength="1" maxlength="30" required="">
                                </div>
                                <button type="submit" name="btn_registro" class="btn btn-default btn_style">REGISTRAR</button>
                            </form>                       
                        </section>    
                    </div>
                </div>
            </div>
        </div>  
    </body>
</html>

