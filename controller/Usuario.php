<?php

require_once '../config/ConexionDB.php';
require_once '../model/UsuarioModel.php';

class Usuario {

    public static function listar() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT usu_id, usu_nombre, usu_apellido, usu_perfil, usu_password FROM usuario");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];

            foreach ($resultado as $value) {
                $dto = new UsuarioModel();
                $dto->setUsu_id($value["usu_id"]);
                $dto->setUsu_nombre($value["usu_nombre"]);
                $dto->setUsu_apellido($value["usu_apellido"]);
                $dto->setUsu_perfil($value["usu_perfil"]);
                $dto->setUsu_password($value["usu_password"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }

    public static function crear($dto) {
        try {
            $pass = $dto->getUsu_password();

            $db = new ConexionDB();
            $usu_id = $dto->getUsu_id();
            $usu_nombre = $dto->getUsu_nombre();
            $usu_apellido = $dto->getUsu_apellido();
            $usu_perfil = $dto->getUsu_perfil();
            $usu_password = md5($pass);

            $stmt = $db->prepare("INSERT INTO usuario (usu_id, usu_nombre, usu_apellido, usu_perfil, usu_password) VALUES(?,?,?,?,?)");
            $stmt->bindParam(1, $usu_id);
            $stmt->bindParam(2, $usu_nombre);
            $stmt->bindParam(3, $usu_apellido);
            $stmt->bindParam(4, $usu_perfil);
            $stmt->bindParam(5, $usu_password);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

    public static function eliminar($usu_id) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("DELETE FROM usuario WHERE usu_id = ?");
            $stmt->bindParam(1, $usu_id);
            $respuesta = $stmt->execute();
        } catch (Exception $exc) {
            $respuesta = false;
        }
        return $respuesta;
    }

    public static function ver($usu_id) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT usu_id, usu_nombre, usu_apellido, usu_perfil, per.per_descripcion as usu_perfil_det, usu_password FROM usuario usu"
                    . " join perfil per on usu.usu_perfil = per.per_id WHERE usu_id = ?");
            $stmt->bindParam(1, $usu_id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];

            foreach ($resultado as $value) {
                $dto = new UsuarioModel;
                $dto->setUsu_id($value["usu_id"]);
                $dto->setUsu_nombre($value["usu_nombre"]);
                $dto->setUsu_apellido($value["usu_apellido"]);
                $dto->setUsu_perfil($value["usu_perfil"]);
                $dto->setUsu_password($value["usu_password"]);
                $dto->setUsu_perfil_det($value["usu_perfil_det"]);
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
            $pass = $dto->getUsu_password();
            $usu_id = $dto->getUsu_id();
            $usu_nombre = $dto->getUsu_nombre();
            $usu_apellido = $dto->getUsu_apellido();
            $usu_perfil = $dto->getUsu_perfil();
            $usu_password = md5($pass);

            $stmt = $db->prepare("UPDATE usuario SET usu_nombre = ?, usu_apellido =?, usu_perfil = ?, usu_password = ? WHERE usu_id = ?");
            $stmt->bindParam(1, $usu_nombre);
            $stmt->bindParam(2, $usu_apellido);
            $stmt->bindParam(3, $usu_perfil);
            $stmt->bindParam(4, $usu_password);
            $stmt->bindParam(5, $usu_id);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

    public static function actualizar($dto) {
        try {
            $db = new ConexionDB();
            $usu_id = $dto->getUsu_id();
            $usu_nombre = $dto->getUsu_nombre();
            $usu_apellido = $dto->getUsu_apellido();

            $stmt = $db->prepare("UPDATE usuario SET usu_nombre = ?, usu_apellido = ? WHERE usu_id = ?");
            $stmt->bindParam(1, $usu_nombre);
            $stmt->bindParam(2, $usu_apellido);
            $stmt->bindParam(3, $usu_id);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

    public static function login($dto) {
        try {
            $db = new ConexionDB();
            $usu_id = $dto->getUsu_id();
            $usu_password = $dto->getUsu_password();

            $stmt = $db->prepare("SELECT usu_id, usu_nombre, usu_apellido, usu_perfil, usu_password FROM usuario WHERE usu_id = ? AND usu_password = ?");
            $stmt->bindParam(1, $usu_id);
            $stmt->bindParam(2, $usu_password);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

}
