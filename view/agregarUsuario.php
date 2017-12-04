<?php
include_once '../model/UsuarioModel.php';
session_start();
include_once '../controller/Usuario.php';
include_once '../controller/Perfil.php';
$lista = Perfil::listar();

if (isset($_POST['btn_registro'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['usu_id']);
    $usuario->setUsu_nombre($_POST['usu_nombre']);
    $usuario->setUsu_perfil($_POST['usu_perfil']);
    $usuario->setUsu_password($_POST['usu_password']);

    if (Usuario::crear($usuario)) {
        echo "<script type=\"text/javascript\"> alert(\"Usuario creado\");</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al crear usuario\");</script>";
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
                    <legend>Agregar Usuario</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_id">Rut</label>  
                        <div class="col-md-4">
                            <input id="usu_id" name="usu_id" type="text" placeholder="12345678-9" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_nombre">Nombre</label>  
                        <div class="col-md-4">
                            <input id="usu_nombre" name="usu_nombre" type="text" placeholder="Juan Perez" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_perfil">Perfil</label>
                        <div class="col-md-4">
                        <select id="usu_perfil" name="usu_perfil" required>
                            <option value="">-- Selecionar Perfil --</option>
                            <?php foreach ($lista as $value) { ?>
                                <option value="<?php echo $value->getPer_id(); ?>"><?php echo $value->getPer_descripcion(); ?></option>
                            <?php } ?>
                        </select>  
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_password">Contraseña</label>
                        <div class="col-md-4">
                            <input id="usu_password" name="usu_password" type="password" placeholder="" class="form-control input-md" required="">

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