<?php

include_once '../controller/Usuario.php';
include_once '../model/UsuarioModel.php';

if (isset($_GET['term'])) {
    include_once '../config/ConexionDB.php';

    $searchTerm = $_GET['term'];

    $pdo = new ConexionDB();
    $stmt = $pdo->prepare("SELECT distinct usu_id FROM usuario WHERE usu_id LIKE '%" . $searchTerm . "%' ORDER BY usu_id ASC");
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    foreach ($resultado as $row) {
        $data[] = $row['usu_id'];
    }

//return json data
    echo json_encode($data);
}

if (isset($_POST["usu_id"])) {
    if (Usuario::ver($_POST["usu_id"]) != null) {
        $lista = Usuario::ver($_POST["usu_id"]);
        echo "<table class='table table-hover table-responsive table-bordered'><tr><th colspan='2'>Datos del paciente</th></tr><tr><td>";
        echo "Rut";
        echo "</td><td>" . $lista[0]->getUsu_id() . "</td></tr><tr><td>";
        echo "Nombre";
        echo "</td><td>" . $lista[0]->getUsu_nombre() . "</td></tr>";
        for ($i = 0; $i < count($lista); $i++) {
            echo "<tr><td>Perfil</td>";
            echo "<td>" . $lista[$i]->getUsu_perfil() . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No existe informacion para mostrar";
    }
}

if (isset($_POST["usu_id_mod"])) {
    if (Usuario::ver($_POST["usu_id_mod"]) != null) {
        $lista = Usuario::ver($_POST["usu_id_mod"]);
        echo "<table class='table table-hover table-responsive'>";
        echo "<tr> ";
        echo "<th> Rut </th> ";
        echo "<th> Nombre </th> ";
        echo "<th> Perfil </th> ";
        echo "<th> Opciones </th> ";
        echo "</tr>";
        for ($i = 0; $i < count($lista); $i++) {
            echo "<tr> ";
            echo "<td> " . $lista[$i]->getUsu_id() . "</td> ";
            echo "<td> " . $lista[$i]->getUsu_nombre() . "</td> ";
            echo "<td> " . $lista[$i]->getUsu_perfil() . "</td> ";
            echo "<td> <input type=\"button\" class=\"btn_eliminar\" value=\"Eliminar\" attr-id=\"" . $lista[$i]->getUsu_id() . "\" /> "
            . "<input type=\"button\" class=\"btn_modificar\" value=\"Modificar\" attr-id=\"" . $lista[$i]->getUsu_id() . "\" /></td> ";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No existe informacion para mostrar";
    }
}

if(isset($_POST["id_usuario"])){
if (!Usuario::eliminar($_POST["id_usuario"])) {
    echo "<script type=\"text/javascript\"> alert(\"No se ha podido eliminar.\");</script>";
} else {
    echo "<script type=\"text/javascript\"> alert(\"Se ha eliminado el usuario.\");</script>";
    $lista = [];
}
}


