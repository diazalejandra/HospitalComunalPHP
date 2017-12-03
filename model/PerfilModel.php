<?php

class PerfilModel implements JsonSerializable {
    private $per_id;
    private $per_descripcion;
    
    function __construct() {
        
    }
    
    function getPer_id() {
        return $this->per_id;
    }

    function getPer_descripcion() {
        return $this->per_descripcion;
    }

    function setPer_id($per_id) {
        $this->per_id = $per_id;
    }

    function setPer_descripcion($per_descripcion) {
        $this->per_descripcion = $per_descripcion;
    }

    public function jsonSerialize() {
        
    }

}
