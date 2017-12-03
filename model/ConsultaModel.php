<?php

class ConsultaModel implements JsonSerializable {
    private $con_id;
    private $con_fecha;
    private $con_paciente;
    private $con_medico;
    private $con_estado;

    function __construct() {
        
    }

    function getCon_id() {
        return $this->con_id;
    }

    function getCon_fecha() {
        return $this->con_fecha;
    }

    function getCon_paciente() {
        return $this->con_paciente;
    }

    function getCon_medico() {
        return $this->con_medico;
    }

    function getCon_estado() {
        return $this->con_estado;
    }

    function setCon_id($con_id) {
        $this->con_id = $con_id;
    }

    function setCon_fecha($con_fecha) {
        $this->con_fecha = $con_fecha;
    }

    function setCon_paciente($con_paciente) {
        $this->con_paciente = $con_paciente;
    }

    function setCon_medico($con_medico) {
        $this->con_medico = $con_medico;
    }

    function setCon_estado($con_estado) {
        $this->con_estado = $con_estado;
    }

    public function jsonSerialize() {
        
    }

}
