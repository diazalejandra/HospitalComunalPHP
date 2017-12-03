<?php

class PacienteModel implements JsonSerializable {
    private $pac_rut;
    private $pac_nombre;
    private $pac_apellido;
    private $pac_nacimiento;
    private $pac_sexo;
    private $pac_direccion;
    private $pac_telefono;
    
    function __construct() {
        
    }

    function getPac_rut() {
        return $this->pac_rut;
    }

    function getPac_nombre() {
        return $this->pac_nombre;
    }

    function getPac_apellido() {
        return $this->pac_apellido;
    }

    function getPac_nacimiento() {
        return $this->pac_nacimiento;
    }

    function getPac_sexo() {
        return $this->pac_sexo;
    }

    function getPac_direccion() {
        return $this->pac_direccion;
    }

    function getPac_telefono() {
        return $this->pac_telefono;
    }

    function setPac_rut($pac_rut) {
        $this->pac_rut = $pac_rut;
    }

    function setPac_nombre($pac_nombre) {
        $this->pac_nombre = $pac_nombre;
    }

    function setPac_apellido($pac_apellido) {
        $this->pac_apellido = $pac_apellido;
    }

    function setPac_nacimiento($pac_nacimiento) {
        $this->pac_nacimiento = $pac_nacimiento;
    }

    function setPac_sexo($pac_sexo) {
        $this->pac_sexo = $pac_sexo;
    }

    function setPac_direccion($pac_direccion) {
        $this->pac_direccion = $pac_direccion;
    }

    function setPac_telefono($pac_telefono) {
        $this->pac_telefono = $pac_telefono;
    }

    public function jsonSerialize() {
        
    }

}
