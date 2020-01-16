<?php
include_once("../../model/ConsultasModel.php");

$consultas = new ConsultasModel();
$consultas -> setList();

$listaConsultasJSON = $consultas -> getListJsonStringObject();

echo $listaConsultasJSON;

unset ($consultas);
?>