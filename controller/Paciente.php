<?php

require_once '../config/ConexionDB.php';
require_once '../model/PacienteModel.php';

class Paciente {

    public static function listar() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT pac_rut, pac_nombre, pac_apellido, pac_nacimiento, pac_sexo, pac_direccion, pac_telefono FROM paciente");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];

            foreach ($resultado as $value) {
                $dto = new PacienteModel();
                $dto->setPac_rut($value["pac_rut"]);
                $dto->setPac_nombre($value["pac_nombre"]);
                $dto->setPac_apellido($value["pac_apellido"]);
                $dto->setPac_nacimiento($value["pac_nacimiento"]);
                $dto->setPac_sexo($value["pac_sexo"]);
                $dto->setPac_direccion($value["pac_direccion"]);
                $dto->setPac_telefono($value["pac_telefono"]);
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
            
            $dir = $dto->getPac_direccion();
            $pac_rut = $dto->getPac_rut();
            $pac_nombre = $dto->getPac_nombre();
            $pac_apellido = $dto->getPac_apellido();
            $pac_nacimiento = $dto->getPac_nacimiento();
            $pac_sexo = $dto->getPac_sexo();
            $pac_direccion = md5($dir);
            $pac_telefono = $dto->getPac_telefono();

            $stmt = $db->prepare("INSERT INTO paciente (pac_rut, pac_nombre, pac_apellido, pac_nacimiento, pac_sexo, pac_direccion, pac_telefono) VALUES(?,?,?,?,?,?,?)");
            $stmt->bindParam(1, $pac_rut);
            $stmt->bindParam(2, $pac_nombre);
            $stmt->bindParam(3, $pac_apellido);
            $stmt->bindParam(4, $pac_nacimiento);
            $stmt->bindParam(5, $pac_sexo);
            $stmt->bindParam(6, $pac_direccion);
            $stmt->bindParam(7, $pac_telefono);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

    public static function eliminar($pac_rut) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("DELETE FROM paciente WHERE pac_rut = ?");
            $stmt->bindParam(1, $pac_rut);
            $respuesta = $stmt->execute();
        } catch (Exception $exc) {
            $respuesta = false;
        }
        return $respuesta;
    }

    public static function ver($pac_rut) {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT pac_rut, pac_nombre, pac_apellido, pac_nacimiento, pac_sexo, pac_direccion, pac_telefono FROM paciente "
                    . "WHERE pac_rut = ?");
            $stmt->bindParam(1, $pac_rut);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];

            foreach ($resultado as $value) {
                $dto = new PacienteModel();
                $dto->setPac_rut($value["pac_rut"]);
                $dto->setPac_nombre($value["pac_nombre"]);
                $dto->setPac_apellido($value["pac_apellido"]);
                $dto->setPac_nacimiento($value["pac_nacimiento"]);
                $dto->setPac_sexo($value["pac_sexo"]);
                $dto->setPac_direccion($value["pac_direccion"]);
                $dto->setPac_telefono($value["pac_telefono"]);
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
            $dir = $dto->getPac_direccion();
            $pac_rut = $dto->getPac_rut();
            $pac_nombre = $dto->getPac_nombre();
            $pac_apellido = $dto->getPac_apellido();
            $pac_nacimiento = $dto->getPac_nacimiento();
            $pac_sexo = $dto->getPac_sexo();
            $pac_direccion = md5($dir);
            $pac_telefono = $dto->getPac_telefono();

            $stmt = $db->prepare("UPDATE paciente SET pac_nombre = ?, pac_apellido = ?, pac_nacimiento = ?, pac_sexo = ?, pac_direccion = ?, pac_telefono = ? "
                    . "WHERE pac_rut = ?");
            $stmt->bindParam(1, $pac_nombre);
            $stmt->bindParam(2, $pac_apellido);
            $stmt->bindParam(3, $pac_nacimiento);
            $stmt->bindParam(4, $pac_sexo);
            $stmt->bindParam(5, $pac_direccion);
            $stmt->bindParam(6, $pac_telefono);
            $stmt->bindParam(7, $pac_rut);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return false;
    }

}
