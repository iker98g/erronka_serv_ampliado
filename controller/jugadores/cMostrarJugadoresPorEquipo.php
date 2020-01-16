<?php
include_once("../../model/JugadoresModel.php");

$idEquipo=filter_input(INPUT_GET, 'value');

$jugadores = new JugadoresModel();
$jugadores->setIdEquipo($idEquipo);

$jugadores->findJugadoresByIdEquipo();

$listaJugadoresJSON = $jugadores -> getListJsonStringObject();

echo $listaJugadoresJSON;

unset ($jugadores);
?>