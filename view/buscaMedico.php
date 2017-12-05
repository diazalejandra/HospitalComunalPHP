<?php

include_once '../controller/Medico.php';
include_once '../model/MedicoModel.php';

if (isset($_GET['term'])) {
    include_once '../config/ConexionDB.php';

    $searchTerm = $_GET['term'];

    $pdo = new ConexionDB();
    $stmt = $pdo->prepare("SELECT * FROM medico WHERE med_rut LIKE '%" . $searchTerm . "%' ORDER BY med_rut ASC");
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    foreach ($resultado as $row) {
        $data[] = $row['med_rut'];
    }

//return json data
    echo json_encode($data);
}

if (isset($_POST["med_rut"])) {
    if (Medico::ver($_POST["med_rut"]) != null) {
        $lista = Medico::ver($_POST["med_rut"])[0];
        echo "<table class='table table-hover table-responsive table-bordered'><tr><th colspan='2'>Datos del paciente</th></tr><tr><td>";
        echo "Rut";
        echo "</td><td>" . $lista->getMed_rut() . "</td></tr><tr><td>";
        echo "Nombre";
        echo "</td><td>" . $lista->getMed_nombre() . "</td></tr><tr><td>";
        echo "Apellido";
        echo "</td><td>" . $lista->getMed_apellido() . "</td></tr><tr><td>";
        echo "Fecha de Contratacion";
        echo "</td><td>" . $lista->getMed_contrato() . "</td></tr><tr><td>";
        echo "Especialidad";
        echo "</td><td>" . $lista->getMed_especialidad() . "</td></tr><tr><td>";
        echo "Valor Consulta";
        echo "</td><td>" . $lista->getMed_valor() . "</td></tr></table>";
    } else {
        echo "No existe informacion para mostrar";
    }
}

if (isset($_POST["med_rut_mod"])) {
    if (Medico::ver($_POST["med_rut_mod"]) != null) {
        $lista = Medico::ver($_POST["med_rut_mod"]);
        echo "<form name='frm_actualizar' action='actualizarMedico.php' method='POST'>";
        echo "<table class='table table-hover table-responsive'>";
        echo "<tr> ";
        echo "<th> Rut </th> ";
        echo "<th> Nombre </th> ";
        echo "<th> Apellido </th> ";
        echo "<th> Fecha de Contratacion </th> ";
        echo "<th> Especialidad </th> ";
        echo "<th> Valor Consulta </th> ";
        echo "<th> Opciones </th> ";
        echo "</tr>";
        for ($i = 0; $i < count($lista); $i++) {
            echo "<tr> ";
            echo "<td> " . $lista[$i]->getMed_rut() . "</td> ";
            echo "<td> " . $lista[$i]->getMed_nombre() . "</td> ";
            echo "<td> " . $lista[$i]->getMed_apellido() . "</td> ";
            echo "<td> " . $lista[$i]->getMed_contrato() . "</td> ";
            echo "<td> " . $lista[$i]->getMed_especialidad() . "</td> ";
            echo "<td> " . $lista[$i]->getMed_valor() . "</td> ";
            echo "<td> <input type=\"button\" class=\"btn_eliminar\" value=\"Eliminar\" attr-id=\"" . $lista[$i]->getMed_rut() . "\" /> "
            . "<button type=\"submit\" class=\"btn_modificar\" name=\"btn_modificar\" value=\"" . $lista[$i]->getMed_rut() . "\">Modificar</button></td> ";
            echo "</tr>";
        }
        echo "</table></form>";
    } else {
        echo "No existe informacion para mostrar";
    }
}

if (isset($_POST["rut_eliminar"])) {
    if (!Medico::eliminar($_POST["rut_eliminar"]) && !Usuario::eliminar($_POST["rut_eliminar"])) {
        echo "<script type=\"text/javascript\"> alert(\"No se ha podido eliminar.\");</script>";
    } else {

        echo "<script type=\"text/javascript\"> alert(\"Se ha eliminado el medico.\");</script>";
    }
}
