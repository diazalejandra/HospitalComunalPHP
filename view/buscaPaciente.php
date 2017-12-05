<?php

include_once '../controller/Paciente.php';
include_once '../model/PacienteModel.php';

if (isset($_GET['term'])) {
    include_once '../config/ConexionDB.php';

    $searchTerm = $_GET['term'];

    $pdo = new ConexionDB();
    $stmt = $pdo->prepare("SELECT * FROM paciente WHERE pac_rut LIKE '%" . $searchTerm . "%' ORDER BY pac_rut ASC");
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    foreach ($resultado as $row) {
        $data[] = $row['pac_rut'];
    }

//return json data
    echo json_encode($data);
}

if (isset($_POST["pac_rut"])) {
    if (Paciente::ver($_POST["pac_rut"]) != null) {
        $lista = Paciente::ver($_POST["pac_rut"])[0];
        echo "<table class='table table-hover table-responsive table-bordered'><tr><th colspan='2'>Datos del paciente</th></tr><tr><td>";
        echo "Rut";
        echo "</td><td>" . $lista->getPac_rut() . "</td></tr><tr><td>";
        echo "Nombre";
        echo "</td><td>" . $lista->getPac_nombre() . "</td></tr><tr><td>";
        echo "Apellido";
        echo "</td><td>" . $lista->getPac_apellido() . "</td></tr><tr><td>";
        echo "Fecha de Nacimiento";
        echo "</td><td>" . $lista->getPac_nacimiento() . "</td></tr><tr><td>";
        echo "Sexo";
        echo "</td><td>" . $lista->getPac_sexo() . "</td></tr><tr><td>";
        echo "Direccion";
        echo "</td><td>" . $lista->getPac_direccion() . "</td></tr><tr><td>";
        echo "Telefono";
        echo "</td><td>" . $lista->getPac_telefono() . "</td></tr></table>";
    } else {
        echo "No existe informacion para mostrar";
    }
}

if (isset($_POST["pac_rut_mod"])) {
    if (Paciente::ver($_POST["pac_rut_mod"]) != null) {
        $lista = Paciente::ver($_POST["pac_rut_mod"]);
        echo "<form name='frm_actualizar' action='actualizarPaciente.php' method='POST'>";
        echo "<table class='table table-hover table-responsive'>";
        echo "<tr> ";
        echo "<th> Rut </th> ";
        echo "<th> Nombre </th> ";
        echo "<th> Apellido </th> ";
        echo "<th> Fecha de Nacimiento </th> ";
        echo "<th> Sexo </th> ";
        echo "<th> Direccion </th> ";
        echo "<th> Telefono </th> ";
        echo "<th> Opciones </th> ";
        echo "</tr>";
        for ($i = 0; $i < count($lista); $i++) {
            echo "<tr> ";
            echo "<td> " . $lista[$i]->getPac_rut() . "</td> ";
            echo "<td> " . $lista[$i]->getPac_nombre() . "</td> ";
            echo "<td> " . $lista[$i]->getPac_apellido() . "</td> ";
            echo "<td> " . $lista[$i]->getPac_nacimiento() . "</td> ";
            echo "<td> " . $lista[$i]->getPac_sexo() . "</td> ";
            echo "<td> " . $lista[$i]->getPac_direccion() . "</td> ";
            echo "<td> " . $lista[$i]->getPac_telefono() . "</td> ";
            echo "<td> <input type=\"button\" class=\"btn_eliminar\" value=\"Eliminar\" attr-id=\"" . $lista[$i]->getPac_rut() . "\" /> "
            . "<button type=\"submit\" class=\"btn_modificar\" name=\"btn_modificar\" value=\"" . $lista[$i]->getPac_rut() . "\">Modificar</button></td> ";
            echo "</tr>";
        }
        echo "</table></form>";
    } else {
        echo "No existe informacion para mostrar";
    }
}

if (isset($_POST["rut_eliminar"])) {
    if (!Paciente::eliminar($_POST["rut_eliminar"]) && !Usuario::eliminar($_POST["rut_eliminar"])) {
        echo "<script type=\"text/javascript\"> alert(\"No se ha podido eliminar.\");</script>";
    } else {

        echo "<script type=\"text/javascript\"> alert(\"Se ha eliminado el paciente.\");</script>";
    }
}

