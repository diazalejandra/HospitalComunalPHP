<?php

require_once '../config/ConexionDB.php';
require_once '../model/ConsultaModel.php';

class Consulta {

    public static function listar() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT con_id, con_fecha, con_horario, con_paciente, con_medico, con_estado FROM consulta");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new ConsultaModel();
                $dto->setId_oc($value["con_id"]);
                $dto->setId_producto($value["con_fecha"]);
                $dto->setCon_horario($value["con_horario"]);
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
            $con_horario = $dto->getCon_horario();
            $con_paciente = $dto->getCon_paciente();
            $con_medico = $dto->getCon_medico();
            $con_estado = $dto->getCon_estado();

            $stmt = $db->prepare("INSERT INTO consulta (con_fecha, con_horario, con_paciente, con_medico, con_estado) VALUES(?,?,?,?,?)");
            $stmt->bindParam(1, $con_fecha);
            $stmt->bindParam(2, $con_horario);
            $stmt->bindParam(3, $con_paciente);
            $stmt->bindParam(4, $con_medico);
            $stmt->bindParam(5, $con_estado);
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
            $stmt = $pdo->prepare("SELECT con_id, con_fecha, con_horario, hor.hor_hora as con_horario_det, con_paciente, con_medico, con_estado,"
                    . " est.est_descripcion as con_estado_det, CONCAT(med.med_apellido, ', ', med.med_nombre) as con_medico_det" 
                    . " FROM consulta con JOIN estado est on con.con_estado = est.est_id"
                    . " JOIN medico med on con.con_medico = med.med_rut"
                    . " JOIN horario hor on con.con_horario = hor.hor_id"
                    . " WHERE con_id = ?");
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
                $dto->setCon_estado_det($value["con_estado_det"]);
                $dto->setCon_medico_det($value["con_medico_det"]);
                $dto->setCon_horario($value["con_horario"]);
                $dto->setCon_horario_det($value["con_horario_det"]);
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
            $con_horario = $dto->getCon_horario();
            $con_paciente = $dto->getCon_paciente();
            $con_medico = $dto->getCon_medico();
            $con_estado = $dto->getCon_estado();

            $stmt = $db->prepare("UPDATE consulta SET con_fecha = ?, con_horario = ?, con_paciente = ?, con_medico = ?, con_estado = ? "
                    . "WHERE con_id = ?");
            $stmt->bindParam(1, $con_fecha);
            $stmt->bindParam(2, $con_horario);
            $stmt->bindParam(3, $con_paciente);
            $stmt->bindParam(4, $con_medico);
            $stmt->bindParam(5, $con_estado);
            $stmt->bindParam(6, $con_id);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }
    
        public static function buscarPorRut($rut) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT con_id, con_fecha, con_horario, hor.hor_hora as con_horario_det,"
                    . " con_paciente, con_medico, con_estado, est.est_descripcion as con_estado_det,"
                    . " CONCAT(med.med_apellido, ', ', med.med_nombre) as con_medico_det,"
                    . " CONCAT(pac.pac_apellido, ', ', pac.pac_nombre) as con_paciente_det"
                    . " FROM consulta con JOIN estado est on con.con_estado = est.est_id"
                    . " join paciente pac on con.con_paciente = pac.pac_rut "
                    . " join medico med on con.con_medico = med.med_rut "
                    . " join horario hor on con.con_horario = hor.hor_id "
                    . " WHERE con_paciente = ? or con_medico = ? "
                    . " order by con_fecha desc");
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
                $dto->setCon_medico_det($value["con_medico_det"]);            
                $dto->setCon_estado($value["con_estado"]);
                $dto->setCon_estado_det($value["con_estado_det"]);
                $dto->setCon_paciente_det($value["con_paciente_det"]);
                $dto->setCon_horario($value["con_horario"]);
                $dto->setCon_horario_det($value["con_horario_det"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }
    
        public static function buscarPorEstado($estado) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT con_id, con_fecha, con_horario, hor.hor_hora as con_horario_det,"
                    . " con_paciente, con_medico, con_estado, est.est_descripcion as con_estado_det,"
                    . " CONCAT(med.med_apellido, ', ', med.med_nombre) as con_medico_det,"
                    . " CONCAT(pac.pac_apellido, ', ', pac.pac_nombre) as con_paciente_det"
                    . " FROM consulta con JOIN estado est on con.con_estado = est.est_id"
                    . " join paciente pac on con.con_paciente = pac.pac_rut "
                    . " join medico med on con.con_medico = med.med_rut "
                    . " join horario hor on con.con_horario = hor.hor_id "                    
                    . " WHERE con_estado = ?"
                    . " order by con_fecha desc");
            $stmt->bindParam(1, $estado);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];

            foreach ($resultado as $value) {
                $dto = new ConsultaModel();
                $dto->setCon_id($value["con_id"]);
                $dto->setCon_fecha($value["con_fecha"]);
                $dto->setCon_paciente($value["con_paciente"]);
                $dto->setCon_paciente_det($value["con_paciente_det"]);
                $dto->setCon_medico($value["con_medico"]);
                $dto->setCon_medico_det($value["con_medico_det"]);
                $dto->setCon_estado($value["con_estado"]);
                $dto->setCon_estado_det($value["con_estado_det"]);
                $dto->setCon_horario($value["con_horario"]);
                $dto->setCon_horario_det($value["con_horario_det"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }
        public static function buscarPendientes() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT con_id, con_fecha, con_horario, hor.hor_hora as con_horario_det,"
                    . " con_paciente, con_medico, con_estado, est.est_descripcion as con_estado_det,"
                    . " CONCAT(med.med_apellido, ', ', med.med_nombre) as con_medico_det,"
                    . " CONCAT(pac.pac_apellido, ', ', pac.pac_nombre) as con_paciente_det"
                    . " FROM consulta con JOIN estado est on con.con_estado = est.est_id"
                    . " join paciente pac on con.con_paciente = pac.pac_rut "
                    . " join medico med on con.con_medico = med.med_rut "
                    . " join horario hor on con.con_horario = hor.hor_id "                    
                    . " WHERE con_estado = 'AGE' and (con_fecha + INTERVAL -2 DAY = CURRENT_DATE)"
                    . " order by con_fecha desc");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];

            foreach ($resultado as $value) {
                $dto = new ConsultaModel();
                $dto->setCon_id($value["con_id"]);
                $dto->setCon_fecha($value["con_fecha"]);
                $dto->setCon_paciente($value["con_paciente"]);
                $dto->setCon_paciente_det($value["con_paciente_det"]);
                $dto->setCon_medico($value["con_medico"]);
                $dto->setCon_medico_det($value["con_medico_det"]);
                $dto->setCon_estado($value["con_estado"]);
                $dto->setCon_estado_det($value["con_estado_det"]);
                $dto->setCon_horario($value["con_horario"]);
                $dto->setCon_horario_det($value["con_horario_det"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }
    
        public static function actualizarAnulada() {
        try {
            $lista = [];
            $db = new ConexionDB();
            $stmt = $db->prepare("UPDATE consulta set con_estado = 'ANU' WHERE (con_fecha + INTERVAL -1 DAY = CURRENT_DATE) and "
                    . "con_estado = 'AGE'");
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }
    
        public static function actualizarPerdida() {
        try {
            $lista = [];
            $db = new ConexionDB();
            $stmt = $db->prepare("UPDATE consulta set con_estado = 'PER' WHERE con_fecha + INTERVAL +1 DAY = CURRENT_DATE and "
                    . "con_estado = 'CON'");
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }
    
        public static function porRango($fec_ini, $fec_fin) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT count(con_id) as cantidad, avg(med.med_valor) as valorizacion from consulta con "
                    . "join medico med on con.con_medico = med.med_rut "
                    . "WHERE (con_fecha >= ?) and (con_fecha <= ?) ");
            $stmt->bindParam(1, $fec_ini);
            $stmt->bindParam(2, $fec_fin);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new ConsultaModel();
                $dto->setCon_cantidad($value["cantidad"]);
                $dto->setCon_valorizacion($value["valorizacion"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }
}


