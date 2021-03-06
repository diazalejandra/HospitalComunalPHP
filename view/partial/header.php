<?php

if (isset($_SESSION['userlogin'])){
    $usuario = $_SESSION['userlogin'][0];  
}else{
    $usuario = "Usuario";
}
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://bootswatch.com/3/cerulean/bootstrap.min.css">
<link href="css/main.css" rel="stylesheet" type="text/css">

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./home.php">Hospital Tetengo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if($usuario->getUsu_perfil() == 'ADM'){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./agregarUsuario.php">Agregar</a></li>
                        <li><a href="./buscarUsuario.php">Buscar</a></li>
                        <li><a href="./modificarUsuario.php">Modificar</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if(!($usuario->getUsu_perfil() == 'PAC')){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Médicos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if($usuario->getUsu_perfil() == 'ADM'){ ?>
                        <li><a href="./agregarMedico.php">Agregar</a></li>
                        <?php } ?>
                        <li><a href="./buscarMedico.php">Buscar</a></li>
                        <?php if($usuario->getUsu_perfil() == 'ADM'){ ?>
                        <li><a href="./modificarMedico.php">Modificar</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php if(!($usuario->getUsu_perfil() == 'PAC')){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pacientes<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if($usuario->getUsu_perfil() == 'ADM'){ ?>
                        <li><a href="./agregarPaciente.php">Agregar</a></li>
                        <?php } ?>
                        <li><a href="./buscarPaciente.php">Buscar</a></li>
                        <?php if($usuario->getUsu_perfil() == 'ADM'){ ?>
                        <li><a href="./modificarPaciente.php">Modificar</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Atenciones<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if($usuario->getUsu_perfil() == 'SEC'){ ?>
                        <li><a href="./agregarAtencion.php">Agregar</a></li>
                        <?php } ?>
                        <?php if(!($usuario->getUsu_perfil() == 'PAC')){ ?>
                        <li><a href="./buscarAtencion.php">Buscar</a></li>
                        <?php } ?>
                        <?php if($usuario->getUsu_perfil() == 'PAC'){ ?>
                        <li><a href="./listarAtencion.php">Buscar</a></li>
                        <?php } ?>
                        <?php if($usuario->getUsu_perfil() == 'SEC'){ ?>
                        <li><a href="./modificarAtencion.php">Modificar</a></li>
                        <li><a href="./modificarEstado.php">Actualizar Estado</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if($usuario->getUsu_perfil() == 'DIR'){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estadísticas<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./estadisticaAtenciones.php">Atenciones</a></li>
                        <li><a href="./listaTopOC.php">Pacientes</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido <?php echo $usuario->getUsu_nombre() ;?>  <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Perfil</a></li>
                        <li><a href="logout.php" id="cerrar_sesion">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>