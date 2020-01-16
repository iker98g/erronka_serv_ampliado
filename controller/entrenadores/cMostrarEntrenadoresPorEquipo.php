<?php
include_once("../../model/EntrenadoresModel.php");

$idEquipo=filter_input(INPUT_GET, 'value');


$entrenador = new EntrenadoresModel();
$entrenador->setIdEquipo($idEquipo);

$entrenador->findEntrenadoresByIdEquipo();

$listaEntrenadoresJSON = $entrenador -> getListJsonStringObject();

echo $listaEntrenadoresJSON;

unset ($entrenador);
?>