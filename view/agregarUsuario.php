<?php
include_once '/partial/session.php';
include_once '../controller/Usuario.php';
include_once '../controller/Medico.php';
include_once '../controller/Paciente.php';
include_once '../controller/Perfil.php';
$lista = Perfil::listar();

if (isset($_POST['btn_registro'])) {
    $usuario = new UsuarioModel();
    $usuario->setUsu_id($_POST['usu_id']);
    $usuario->setUsu_nombre($_POST['usu_nombre']);
    $usuario->setUsu_apellido($_POST['usu_apellido']);
    $usuario->setUsu_perfil($_POST['usu_perfil']);
    $usuario->setUsu_password($_POST['usu_password']);
    $guardar = false;

    if ($_POST['usu_perfil'] == 'PAC') {
        $paciente = new PacienteModel();
        $paciente->setPac_rut($_POST['usu_id']);
        $paciente->setPac_nombre($_POST['usu_nombre']);
        $paciente->setPac_apellido($_POST['usu_apellido']);
        $paciente->setPac_direccion($_POST['pac_direccion']);
        $paciente->setPac_nacimiento($_POST['pac_nacimiento']);
        $paciente->setPac_sexo($_POST['pac_sexo']);
        $paciente->setPac_telefono($_POST['pac_telefono']);
        if (Usuario::crear($usuario) && Paciente::crear($paciente)) {
            $guardar = true;
        }
    } elseif ($_POST['usu_perfil'] == 'MED') {
        $medico = new MedicoModel();
        $medico->setMed_rut($_POST['usu_id']);
        $medico->setMed_nombre($_POST['usu_nombre']);
        $medico->setMed_apellido($_POST['usu_apellido']);
        $medico->setMed_contrato($_POST['med_contrato']);
        $medico->setMed_especialidad($_POST['med_especialidad']);
        $medico->setMed_valor($_POST['med_consulta']);
        if (Usuario::crear($usuario) && Medico::crear($medico)) {
            $guardar = true;
        }
    } else {
        if (Usuario::crear($usuario)) {
            $guardar = true;
        }
    }

    if ($guardar) {
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
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.rut.js"></script>
        <script language="javascript">
            $(document).ready(function () {
                $("input#usu_id").rut({formatOn: 'keyup', useThousandsSeparator: false, validateOn: 'change'}).on('rutInvalido', function (e) {
                    alert("El rut " + $(this).val() + " es inválido");
                    $("input#usu_id").val('');
                });

                $('select').on('change', function () {
                    selection = $(this).val();
                    switch (selection)
                    {
                        case 'MED':
                            $("div[name='MED']").show();
                            $("div[name='MED'] input").attr("required", true);
                            $("div[name='PAC'] input").removeAttr("required");
                            $("div[name='PAC']").hide();
                            break;
                        case 'PAC':
                            $("div[name='PAC']").show();
                            $("div[name='MED'] input").removeAttr("required");
                            $("div[name='PAC'] input").attr("required", true); 
                            $("div[name='MED']").hide();
                            break;
                        case 'DIR':
                        case 'ADM':
                        case 'SEC':
                            $("div[name='MED'], div[name='PAC']").hide();
                            $("div[name='PAC'] input, div[name='PAC'] input").removeAttr("required");
                            break;
                    }
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
                    <legend>Agregar Usuario</legend>

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
                            <input id="usu_nombre" name="usu_nombre" type="text" placeholder="Juan" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_apellido">Apellido</label>  
                        <div class="col-md-4">
                            <input id="usu_apellido" name="usu_apellido" type="text" placeholder="Perez" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="usu_password">Contraseña</label>
                        <div class="col-md-4">
                            <input id="usu_password" name="usu_password" type="password" placeholder="" class="form-control input-md" required="">
                        </div>
                    </div>
                    
                    <!-- controles para medico -->
                    <div class="form-group" name="MED" style="display:none">
                        <label class="col-md-4 control-label" for="med_especialidad">Especialidad</label>
                        <div class="col-md-4">
                            <input id="med_especialidad" name="med_especialidad" type="text" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group" name="MED" style="display:none">
                        <label class="col-md-4 control-label" for="med_contrato">Fecha de Contratación</label>
                        <div class="col-md-4">
                            <input id="med_contrato" name="med_contrato" type="date" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group" name="MED" style="display:none">
                        <label class="col-md-4 control-label" for="med_consulta">Valor Consulta</label>
                        <div class="col-md-4">
                            <input id="med_consulta" name="med_consulta" type="number" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    
                    <!-- controles para paciente -->
                    <div class="form-group" name="PAC" style="display:none">
                        <label class="col-md-4 control-label" for="pac_nacimiento">Fecha de Nacimiento</label>
                        <div class="col-md-4">
                            <input id="pac_nacimiento" name="pac_nacimiento" type="date" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group" name="PAC" style="display:none">
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
                    <div class="form-group" name="PAC" style="display:none">
                        <label class="col-md-4 control-label" for="pac_direccion">Dirección</label>
                        <div class="col-md-4">
                            <input id="pac_direccion" name="pac_direccion" type="text" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group" name="PAC" style="display:none">
                        <label class="col-md-4 control-label" for="pac_telefono">Teléfono</label>
                        <div class="col-md-4">
                            <input id="pac_telefono" name="pac_telefono" type="number" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="btn_registro"></label>
                        <div class="col-md-4">
                            <button id="btn_registro" name="btn_registro" class="btn btn-primary" type="submit">Agregar</button>
                            <button id="btn_limpiar" name="btn_limpiar" class="btn btn-default" type="reset">Limpiar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
    </body>
</html>