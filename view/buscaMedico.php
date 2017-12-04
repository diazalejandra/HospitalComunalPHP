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

    if (isset($_POST["id_usuario"])) {
        if (!Usuario::eliminar($_POST["id_usuario"])) {
            echo "<script type=\"text/javascript\"> alert(\"No se ha podido eliminar.\");</script>";
        } else {

            echo "<script type=\"text/javascript\"> alert(\"Se ha eliminado el usuario.\");</script>";
        }
    }
}