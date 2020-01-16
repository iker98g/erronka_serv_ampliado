<?php
include_once("../../model/EquiposModel.php");

$equipos = new EquiposModel();
$equipos -> setList();

$listaEquiposJSON = $equipos ->getListJsonStringObject();

echo $listaEquiposJSON;

unset ($equipos);
?>
