<?php

require_once '../config/ConexionDB.php';
require_once '../model/PerfilModel.php';

class Perfil {

    public static function listar() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT per_id, per_descripcion FROM perfil");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new PerfilModel();
                $dto->setPer_id($value["per_id"]);
                $dto->setPer_descripcion($value["per_descripcion"]);
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
            $per_id = $dto->getPer_id();
            $per_descripcion = $dto->getPer_descripcion();

            $stmt = $db->prepare("INSERT INTO perfil (per_id, per_descripcion) VALUES(?,?)");
            $stmt->bindParam(1, $per_id);
            $stmt->bindParam(2, $per_descripcion);
             return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

    public static function eliminar($per_id) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("DELETE FROM perfil WHERE per_id = ?");
            $stmt->bindParam(1, $per_id);
            $respuesta = $stmt->execute();
        } catch (Exception $exc) {
            $respuesta = false;
        }
        return $respuesta;
    }

    public static function ver($per_id) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT per_id, per_descripcion FROM perfil WHERE per_id = ?");
            $stmt->bindParam(1, $per_id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();

            foreach ($resultado as $value) {
                $dto = new PerfilModel();
                $dto->setPer_id($value["per_id"]);
                $dto->setPer_descripcion($value["per_descripcion"]);
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
            $per_id = $dto->getPer_id();
            $per_descripcion = $dto->getPer_descripcion();

            $stmt = $db->prepare("UPDATE perfil SET per_descripcion = ? where per_id = ?");
            $stmt->bindParam(1, $per_descripcion);
            $stmt->bindParam(2, $per_id);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }
}


