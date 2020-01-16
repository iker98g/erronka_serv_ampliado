<?php
include_once("../../model/JugadoresModel.php");

$jugadores = new JugadoresModel();
$jugadores -> setList();

$listaJugadoresJSON = $jugadores -> getListJsonStringObject();

echo $listaJugadoresJSON;

unset ($jugadores);
?>