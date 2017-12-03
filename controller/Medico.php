<?php

require_once '../config/ConexionDB.php';
require_once '../model/MedicoModel.php';

class Medico {

    public static function listar() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT med_rut, med_nombre, med_apellido, med_contrato, med_especialidad, med_valor FROM medico");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new MedicoModel();
                $dto->setMed_rut($value["med_rut"]);
                $dto->setMed_nombre($value["med_nombre"]);
                $dto->setMed_apellido($value["med_apellido"]);
                $dto->setMed_contrato($value["med_contrato"]);
                $dto->setMed_especialidad($value["med_especialidad"]);
                $dto->setMed_valor($value["med_valor"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }

    public static function crear($dto) {
        try {
            $db = new ConexionDB();
            $med_rut = $dto->getMed_rut();
            $med_nombre = $dto->getMed_nombre();
            $med_apellido = $dto->getMed_apellido();
            $med_contrato = $dto->getMed_contrato();
            $med_especialidad = $dto->getMed_especialidad();
            $med_valor = $dto->getMed_valor();

            $stmt = $db->prepare("INSERT INTO medico (med_rut, med_nombre, med_apellido, med_contrato, med_especialidad, med_valor) VALUES(?,?,?,?,?,?)");
            $stmt->bindParam(1, $med_rut);
            $stmt->bindParam(2, $med_nombre);
            $stmt->bindParam(3, $med_apellido);
            $stmt->bindParam(4, $med_contrato);
            $stmt->bindParam(5, $med_especialidad);
            $stmt->bindParam(6, $med_valor);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

    public static function eliminar($med_rut) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("DELETE FROM medico WHERE med_rut = ?");
            $stmt->bindParam(1, $med_rut);
            $respuesta = $stmt->execute();
        } catch (Exception $exc) {
            $respuesta = false;
        }
        return $respuesta;
    }

    public static function ver($med_rut) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT med_rut, med_nombre, med_apellido, med_contrato, med_especialidad, med_valor FROM medico "
                    . "WHERE med_rut = ?");
            $stmt->bindParam(1, $med_rut);
            $stmt->execute();
            $resultado = $stmt->fetchAll();

            foreach ($resultado as $value) {
                $dto = new MedicoModel();
                $dto->setMed_rut($value["med_rut"]);
                $dto->setMed_nombre($value["med_nombre"]);
                $dto->setMed_apellido($value["med_apellido"]);
                $dto->setMed_contrato($value["med_contrato"]);
                $dto->setMed_especialidad($value["med_especialidad"]);
                $dto->setMed_valor($value["med_valor"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }

    public static function editar($dto) {
        try {
            $db = new ConexionDB();
            $med_rut = $dto->getMed_rut();
            $med_nombre = $dto->getMed_nombre();
            $med_apellido = $dto->getMed_apellido();
            $med_contrato = $dto->getMed_contrato();
            $med_especialidad = $dto->getMed_especialidad();
            $med_valor = $dto->getMed_valor();

            $stmt = $db->prepare("UPDATE medico SET med_nombre = ?, med_apellido = ?, med_contrato = ?, med_especialidad = ?, med_valor = ? "
                    . "WHERE med_rut = ?");
            $stmt->bindParam(1, $med_nombre);
            $stmt->bindParam(2, $med_apellido);
            $stmt->bindParam(3, $med_contrato);
            $stmt->bindParam(4, $med_especialidad);
            $stmt->bindParam(5, $med_valor);
            $stmt->bindParam(6, $med_rut);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }
}


