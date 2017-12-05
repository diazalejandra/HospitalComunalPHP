<?php

include_once '../controller/Consulta.php';
include_once '../model/ConsultaModel.php';

if (isset($_POST["pac_rut"]) || isset($_POST["med_rut"])) {
    if (isset($_POST["pac_rut"])) {
        $lista = Consulta::buscarPorRut($_POST["pac_rut"]);
    } elseif (isset($_POST["med_rut"])) {
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
}

if (isset($_POST["pac_rut_mod"]) || isset($_POST["med_rut_mod"]) || isset($_POST["btn_buscar_est"]) || isset($_POST["btn_act_con"])) {
    if (isset($_POST["pac_rut_mod"])) {
        $listar = Consulta::buscarPorRut($_POST["pac_rut_mod"]);
    } elseif (isset($_POST["med_rut_mod"])) {
        $listar = Consulta::buscarPorRut($_POST["med_rut_mod"]);
    } elseif (isset($_POST["btn_buscar_est"])) {
        $listar = Consulta::buscarPorEstado($_POST["btn_buscar_est"]);
    } elseif (isset($_POST["btn_act_con"])) {
        $listar = Consulta::buscarPendientes();
    }
    if ($listar != null) {
        echo "<form name='frm_actualizar' action='actualizarAtencion.php' method='POST'>";
        echo "<table class='table table-hover table-responsive'>";
        echo "<tr> ";
        echo "<th> ID </th> ";
        echo "<th> Fecha </th> ";
        echo "<th> Paciente </th> ";
        echo "<th> Medico </th> ";
        echo "<th> Estado </th> ";
        echo "<th> Opciones </th> ";
        echo "</tr>";
        for ($i = 0; $i < count($listar); $i++) {
            echo "<tr> ";
            echo "<td> " . $listar[$i]->getCon_id() . "</td> ";
            echo "<td> " . $listar[$i]->getCon_fecha() . "</td> ";
            echo "<td> " . $listar[$i]->getCon_paciente() . "</td> ";
            echo "<td> " . $listar[$i]->getCon_medico() . "</td> ";
            echo "<td> " . $listar[$i]->getCon_estado() . "</td> ";
            echo "<td> <input type=\"button\" class=\"btn_eliminar\" value=\"Eliminar\" attr-id=\"" . $listar[$i]->getCon_id() . "\" /> "
            . "<button type=\"submit\" class=\"btn_modificar\" name=\"btn_modificar\" value=\"" . $listar[$i]->getCon_id() . "\">Modificar</button></td>";
            echo "</tr>";
        }
        echo "</table></form>";
    } else {
        echo "No existe informacion para mostrar";
    }
}

if (isset($_POST["id_eliminar"])) {
    if (!Consulta::eliminar($_POST["id_eliminar"])) {
        echo "<script type=\"text/javascript\"> alert(\"No se ha podido eliminar.\");</script>";
    } else {
        echo "<script type=\"text/javascript\"> alert(\"Se ha eliminado la atencion.\");</script>";
    }
}

?>