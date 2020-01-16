<?php
include_once("../../model/UsuariosModel.php");

$usuarios = new UsuariosModel();
$usuarios -> setList();

$listaUsuariosJSON = $usuarios -> getListJsonString();

echo $listaUsuariosJSON;

unset ($usuarios);
?>