<?php
include_once("../../model/EquiposModel.php");

$idCategoria=filter_input(INPUT_GET, 'value');


$equipos = new EquiposModel();
$equipos->setIdCategoria($idCategoria);

$equipos->findEquiposByIdCategoria();

$listaEquiposJSON = $equipos -> getListJsonStringObject();

echo $listaEquiposJSON;

unset ($equipos);
?>
