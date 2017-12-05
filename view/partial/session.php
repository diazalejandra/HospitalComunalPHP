<?php
include_once '../model/UsuarioModel.php';
session_start();
if (!isset($_SESSION['userlogin']))
    header("Location: ../index.php");

?>