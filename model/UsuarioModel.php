<?php

class UsuarioModel implements JsonSerializable {
    private $usu_id;
    private $usu_nombre;
    private $usu_apellido;
    private $usu_perfil;
    private $usu_password;
    
    function __construct() {
        
    }

    function getUsu_id() {
        return $this->usu_id;
    }

    function getUsu_nombre() {
        return $this->usu_nombre;
    }

    function getUsu_perfil() {
        return $this->usu_perfil;
    }

    function getUsu_password() {
        return $this->usu_password;
    }

    function setUsu_id($usu_id) {
        $this->usu_id = $usu_id;
    }

    function setUsu_nombre($usu_nombre) {
        $this->usu_nombre = $usu_nombre;
    }

    function setUsu_perfil($usu_perfil) {
        $this->usu_perfil = $usu_perfil;
    }

    function setUsu_password($usu_password) {
        $this->usu_password = $usu_password;
    }
    
    function getUsu_apellido() {
        return $this->usu_apellido;
    }

    function setUsu_apellido($usu_apellido) {
        $this->usu_apellido = $usu_apellido;
    }

    public function jsonSerialize() {
        
    }

}
