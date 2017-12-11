<?php
include_once '/partial/session.php';
include_once '../controller/Usuario.php';
include_once '../controller/Perfil.php';
$lista = Perfil::listar();

if (isset($_POST["btn_modificar"])) {
    $modificar = Usuario::ver($_POST["btn_modificar"])[0];
}

if (isset($_POST['btn_registro'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['usu_id']);
    $usuario->setUsu_nombre($_POST['usu_nombre']);
    $usuario->setUsu_apellido($_POST['usu_apellido']);
    $usuario->setUsu_perfil($_POST['usu_perfil']);
    $usuario->setUsu_password($_POST['usu_password']);

    if (Usuario::editar($usuario)) {
        echo "<script type=\"text/javascript\"> alert(\"Usuario actualizado\");</script>";
        echo "<script>location.href='modificarUsuario.php';</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Error al actualizar usuario\");</script>";
        echo "<script>location.href='modificarUsuario.php';</script>";
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
                $("input#usu_id").rut({formatOn: 'keyup', useThousandsSeparator: false, validateOn: 'change'}).on('rutInvalido', function(e) {
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
                    <legend>Actualizar Usuario</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_id">Rut</label>  
                        <div class="col-md-4">
                            <input id="usu_id" name="usu_id" type="text" value="<?php echo $modificar->getUsu_id(); ?>" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_nombre">Nombre</label>  
                        <div class="col-md-4">
                            <input id="usu_nombre" name="usu_nombre" type="text" value="<?php echo $modificar->getUsu_nombre(); ?>" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_apellido">Apellido</label>  
                        <div class="col-md-4">
                            <input id="usu_apellido" name="usu_apellido" type="text" value="<?php echo $modificar->getUsu_apellido(); ?>" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_perfil">Perfil</label>
                        <div class="col-md-4">
                            <select id="usu_perfil" name="usu_perfil" class="selectpicker form-control" required>
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
                            <button id="btn_registro" name="btn_registro" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
    </body>
</html>