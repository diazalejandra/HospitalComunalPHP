<?php

include_once '../controller/Consulta.php';
include_once '../model/ConsultaModel.php';

if (isset($_POST["pac_rut"])) {
$lista = Consulta::buscarPorRut($_POST["pac_rut"]);
}elseif(isset($_POST["med_rut"])){
$lista = Consulta::buscarPorRut($_POST["med_rut"]);
}

if ($lista != null) {
    echo "<table class='table table-hover table-responsive'>";
    echo "<tr> ";
    echo "<th> ID </th> ";
    echo "<th> Fecha </th> ";
    echo "<th> Paciente </th> ";
    echo "<th> Medico </th> ";
    echo "<th> Estado </th> ";
    echo "</tr>";
    for ($i = 0; $i < count($lista); $i++) {
        echo "<tr> ";
        echo "<td> " . $lista[$i]->getCon_id() . "</td> ";
        echo "<td> " . $lista[$i]->getCon_fecha() . "</td> ";
        echo "<td> " . $lista[$i]->getCon_paciente() . "</td> ";
        echo "<td> " . $lista[$i]->getCon_medico() . "</td> ";
        echo "<td> " . $lista[$i]->getCon_estado() . "</td> ";
        echo "</tr>";
    }
    echo "</table>";
} else {
echo "No existe informacion para mostrar";
}

if (isset($_POST["id_usuario"])) {
if (!Usuario::eliminar($_POST["id_usuario"])) {
echo "<script type=\"text/javascript\"> alert(\"No se ha podido eliminar.\");</script>";
} else {

echo "<script type=\"text/javascript\"> alert(\"Se ha eliminado el usuario.\");</script>";
}
}

?>