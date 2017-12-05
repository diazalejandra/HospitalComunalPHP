<?php

require_once '../config/ConexionDB.php';
require_once '../model/ConsultaModel.php';

class Consulta {

    public static function listar() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT con_id, con_fecha, con_paciente, con_medico, con_estado FROM consulta");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new ConsultaModel();
                $dto->setId_oc($value["con_id"]);
                $dto->setId_producto($value["con_fecha"]);
                $dto->setCantidad($value["con_paciente"]);
                $dto->setSub_total($value["con_medico"]);
                $dto->setSub_total($value["con_estado"]);
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
            $con_fecha = $dto->getCon_fecha();
            $con_paciente = $dto->getCon_paciente();
            $con_medico = $dto->getCon_medico();
            $con_estado = $dto->getCon_estado();

            $stmt = $db->prepare("INSERT INTO consulta (con_fecha, con_paciente, con_medico, con_estado) VALUES(?,?,?,?)");
            $stmt->bindParam(1, $con_fecha);
            $stmt->bindParam(2, $con_paciente);
            $stmt->bindParam(3, $con_medico);
            $stmt->bindParam(4, $con_estado);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

    public static function eliminar($con_id) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("DELETE FROM consulta WHERE con_id = ?");
            $stmt->bindParam(1, $con_id);
            $respuesta = $stmt->execute();
        } catch (Exception $exc) {
            $respuesta = false;
        }
        return $respuesta;
    }

    public static function ver($con_id) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT con_id, con_fecha, con_paciente, con_medico, con_estado FROM consulta "
                    . "WHERE con_id = ?");
            $stmt->bindParam(1, $con_id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new ConsultaModel();
                $dto->setCon_id($value["con_id"]);
                $dto->setCon_fecha($value["con_fecha"]);
                $dto->setCon_paciente($value["con_paciente"]);
                $dto->setCon_medico($value["con_medico"]);
                $dto->setCon_estado($value["con_estado"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }

    public static function editar($dto) {
        try {
            $lista = [];
            $db = new ConexionDB();
            $con_id = $dto->getCon_id();
            $con_fecha = $dto->getCon_fecha();
            $con_paciente = $dto->getCon_paciente();
            $con_medico = $dto->getCon_medico();
            $con_estado = $dto->getCon_estado();

            $stmt = $db->prepare("UPDATE consulta SET con_fecha = ?, con_paciente = ?, con_medico = ?, con_estado = ? "
                    . "WHERE con_id = ?");
            $stmt->bindParam(1, $con_fecha);
            $stmt->bindParam(2, $con_paciente);
            $stmt->bindParam(3, $con_medico);
            $stmt->bindParam(4, $con_estado);
            $stmt->bindParam(5, $con_id);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }
    
        public static function buscarPorRut($rut) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT con_id, con_fecha, con.con_paciente as con_paciente, con.con_medico as con_medico, con_estado FROM consulta con "
                    . "left join paciente pac on con.con_paciente = pac.pac_rut "
                    . "left join medico med on con.con_medico = med.med_rut "
                    . "WHERE con_paciente = ? or con_medico = ? "
                    . "order by con_fecha desc");
            $stmt->bindParam(1, $rut);
            $stmt->bindParam(2, $rut);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];

            foreach ($resultado as $value) {
                $dto = new ConsultaModel();
                $dto->setCon_id($value["con_id"]);
                $dto->setCon_fecha($value["con_fecha"]);
                $dto->setCon_paciente($value["con_paciente"]);
                $dto->setCon_medico($value["con_medico"]);
                $dto->setCon_estado($value["con_estado"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }
}


