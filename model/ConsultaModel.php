<?php

class ConsultaModel implements JsonSerializable {
    private $con_id;
    private $con_fecha;
    private $con_paciente;
    private $con_medico;
    private $con_estado;
    private $con_cantidad;
    private $con_valorizacion;
    private $con_estado_det;
    private $con_medico_det;
    private $con_paciente_det;
    private $con_horario;
    private $con_horario_det;

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

    function getCon_cantidad() {
        return $this->con_cantidad;
    }

    function getCon_valorizacion() {
        return $this->con_valorizacion;
    }

    function setCon_cantidad($con_cantidad) {
        $this->con_cantidad = $con_cantidad;
    }

    function setCon_valorizacion($con_valorizacion) {
        $this->con_valorizacion = $con_valorizacion;
    }
    
    function getCon_estado_det() {
        return $this->con_estado_det;
    }

    function setCon_estado_det($con_estado_det) {
        $this->con_estado_det = $con_estado_det;
    }
    
    function getCon_medico_det() {
        return $this->con_medico_det;
    }

    function setCon_medico_det($con_medico_det) {
        $this->con_medico_det = $con_medico_det;
    }

    function getCon_paciente_det() {
        return $this->con_paciente_det;
    }

    function setCon_paciente_det($con_paciente_det) {
        $this->con_paciente_det = $con_paciente_det;
    }
    
    function getCon_horario() {
        return $this->con_horario;
    }

    function setCon_horario($con_horario) {
        $this->con_horario = $con_horario;
    }
    
    function getCon_horario_det() {
        return $this->con_horario_det;
    }

    function setCon_horario_det($con_horario_det) {
        $this->con_horario_det = $con_horario_det;
    }
    
    public function jsonSerialize() {
        
    }

}
