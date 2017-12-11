<?php

class HorarioModel implements JsonSerializable{
    private $hor_id;
    private $hor_hora;
    
    function __construct() {
        
    }

    function getHor_id() {
        return $this->hor_id;
    }

    function getHor_hora() {
        return $this->hor_hora;
    }

    function setHor_id($hor_id) {
        $this->hor_id = $hor_id;
    }

    function setHor_hora($hor_hora) {
        $this->hor_hora = $hor_hora;
    }
    
    public function jsonSerialize() {
        
    }

}
