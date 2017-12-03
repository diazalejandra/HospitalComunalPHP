<?php

class ConexionDB extends PDO {

    function __construct() {
        try {
            parent::__construct('mysql:host=localhost:3308;dbname=dbhospital', 'root', '');
            parent::setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            die('La base de datos seleccionada no existe');
        }
    }
}