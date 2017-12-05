<?php

class EstadoModel implements JsonSerializable{
    private $est_id;
    private $est_descripcion;
    
    function __construct() {
        
    }

    function getEst_id() {
        return $this->est_id;
    }

    function getEst_descripcion() {
        return $this->est_descripcion;
    }

    function setEst_id($est_id) {
        $this->est_id = $est_id;
    }

    function setEst_descripcion($est_descripcion) {
        $this->est_descripcion = $est_descripcion;
    }

    public function jsonSerialize() {
        
    }

}
