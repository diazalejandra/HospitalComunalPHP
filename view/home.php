<?php
session_start();
include_once '../controller/Usuario.php';
include_once '../model/UsuarioModel.php';

if (isset($_POST['btn_login'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['usu_id']);
    $usuario->setUsu_password($_POST['usu_password']);

    if (Usuario::login($usuario) != null) {
        $usuario = Usuario::ver($usuario->getUsu_id());
        $_SESSION['userlogin'] = $usuario;
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Usuario o contraseña incorrecta\");</script>";
        echo "<script>location.href='../index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tetengo</title>
    </head>
    <body>
        <?php
        include_once 'partial/header.php';
        ?>
        
        <?php
        include_once 'partial/footer.php';
        ?>
    </body>
</html>