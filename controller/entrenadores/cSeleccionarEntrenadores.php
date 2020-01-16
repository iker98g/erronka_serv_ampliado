<?php
include_once("../../model/EntrenadoresModel.php");

$entrenadores = new EntrenadoresModel();
$entrenadores -> setList();

$listaEntrenadoresJSON = $entrenadores -> getListJsonStringObject();

echo $listaEntrenadoresJSON;

unset ($entrenadores);
?>