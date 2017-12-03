<?php

class MedicoModel implements JsonSerializable {
    private $med_rut;
    private $med_nombre;
    private $med_apellido;
    private $med_contrato;
    private $med_especialidad;
    private $med_valor;

    function __construct() {
        
    }

    function getMed_rut() {
        return $this->med_rut;
    }

    function getMed_nombre() {
        return $this->med_nombre;
    }

    function getMed_apellido() {
        return $this->med_apellido;
    }

    function getMed_contrato() {
        return $this->med_contrato;
    }

    function getMed_especialidad() {
        return $this->med_especialidad;
    }

    function getMed_valor() {
        return $this->med_valor;
    }

    function setMed_rut($med_rut) {
        $this->med_rut = $med_rut;
    }

    function setMed_nombre($med_nombre) {
        $this->med_nombre = $med_nombre;
    }

    function setMed_apellido($med_apellido) {
        $this->med_apellido = $med_apellido;
    }

    function setMed_contrato($med_contrato) {
        $this->med_contrato = $med_contrato;
    }

    function setMed_especialidad($med_especialidad) {
        $this->med_especialidad = $med_especialidad;
    }

    function setMed_valor($med_valor) {
        $this->med_valor = $med_valor;
    }

    public function jsonSerialize() {
        
    }

}
