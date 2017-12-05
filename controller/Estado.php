<?php

require_once '../config/ConexionDB.php';
require_once '../model/EstadoModel.php';

class Estado {

    public static function listar() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT est_id, est_descripcion FROM estado");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new EstadoModel();
                $dto->setEst_id($value["est_id"]);
                $dto->setEst_descripcion($value["est_descripcion"]);
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
            $est_id = $dto->getEst_id();
            $est_descripcion = $dto->getEst_descripcion();

            $stmt = $db->prepare("INSERT INTO estado (est_id, est_descripcion) VALUES(?,?)");
            $stmt->bindParam(1, $est_id);
            $stmt->bindParam(2, $est_descripcion);
             return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

    public static function eliminar($est_id) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("DELETE FROM estado WHERE est_id = ?");
            $stmt->bindParam(1, $est_id);
            $respuesta = $stmt->execute();
        } catch (Exception $exc) {
            $respuesta = false;
        }
        return $respuesta;
    }

    public static function ver($est_id) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT est_id, est_descripcion FROM estado WHERE est_id = ?");
            $stmt->bindParam(1, $est_id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new EstadoModel();
                $dto->setEst_id($value["est_id"]);
                $dto->setEst_descripcion($value["est_descripcion"]);
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
            $est_id = $dto->getEst_id();
            $est_descripcion = $dto->getEst_descripcion();

            $stmt = $db->prepare("UPDATE estado SET est_descripcion = ? where est_id = ?");
            $stmt->bindParam(1, $est_descripcion);
            $stmt->bindParam(2, $est_id);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }
}


