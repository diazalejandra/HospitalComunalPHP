<?php
session_start();
if (isset($_SESSION['message'])) {
    echo "<script type=\"text/javascript\"> alert(\"Usuario o contraseña incorrecta\");</script>";
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tetengo</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://bootswatch.com/3/cerulean/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="view/css/login.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="./view/js/jquery.rut.js"></script>
        <script language="javascript">
            $(document).ready(function () {
                $("input#usu_id").rut({formatOn: 'keyup', useThousandsSeparator: false});
            });
        </script>        
    </head>
    <body>
        <div class="custom_body">
            <div class="container">
                <div class="row">
                    <div class="login_box">
                        <section class="main-box">
                            <form name="frm_login" action="./view/home.php" method="POST">
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-user fixed" style="height: 16px;"></i></span>
                                    <input id="usu_id" type="text" class="form-control input_layout" name="usu_id" placeholder="RUT" minlength="1" required="">
                                </div>
                                <div class="input-box">
                                    <span class="input-group-addon i_icon"><i class="glyphicon glyphicon-lock fixed" style="height: 16px;"></i></span>
                                    <input id="usu_password" type="password" class="form-control input_layout" name="usu_password" placeholder="Contraseña" minlength="1" required="">
                                </div>
                                <button type="submit" name="btn_login" class="btn btn-default btn_style">INGRESAR</button>                            
                            </form>
                            <div class="register">¿Paciente nuevo? <a href="./view/registro.php">Regístrese</a></div>
                        </section>    
                    </div>
                </div>
            </div>
        </div>  
    </body>
</html>
