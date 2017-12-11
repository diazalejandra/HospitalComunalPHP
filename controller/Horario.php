<?php

require_once '../config/ConexionDB.php';
require_once '../model/HorarioModel.php';

class Horario {

    public static function listar() {
        try {
            $pdo = new ConexionDB();
            $stmt = $pdo->prepare("SELECT hor_id, hor_hora FROM horario");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $lista = [];
            
            foreach ($resultado as $value) {
                $dto = new HorarioModel();
                $dto->setHor_id($value["hor_id"]);
                $dto->setHor_hora($value["hor_hora"]);
                $lista[] = $dto;
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        return $lista;
    }
}