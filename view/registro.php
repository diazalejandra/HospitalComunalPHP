<?php
include_once '../controller/Usuario.php';
include_once '../model/UsuarioModel.php';

if (isset($_POST['btn_registro'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['usu_id']);
    $usuario->setUsu_nombre($_POST['usu_nombre']);
    $usuario->setUsu_password($_POST['usu_password']);
    $usuario->setUsu_perfil('PAC');

    if (Usuario::crear($usuario)) {
        echo "<script type=\"text/javascript\"> alert(\"Usuario creado\");</script>";
        echo "<script>location.href='index.php';</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al crear usuario\");</script>";
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
    </head>
    <body>
        <div class="custom_body">
            <div class="container">
                <div class="row">
                    <div class="login_box">
                        <section class="main-box">
                            <form name="frm_registro" action="" method="POST">
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-briefcase"></i></span>
                                    <input id="usu_id" type="text" class="form-control input_layout" name="usu_id" placeholder="RUT" minlength="1" maxlength="10" required="">
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="usu_nombre" type="text" class="form-control input_layout" name="usu_nombre" placeholder="Nombre" minlength="1" maxlength="30" required="">
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="usu_password" type="password" class="form-control input_layout" name="usu_password" placeholder="Password" minlength="1" maxlength="30" required="">
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

