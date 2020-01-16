<?php
include_once ("../../model/JugadoresModel.php");

$jugador = new JugadoresModel();

$id=($_POST["id"]);

if ($id != null) {
    $jugador -> setIdJugador($id);
    $resultado = $jugador -> borrarJugador();
} else {
    $resultado = "No se ha pasado la ID";
}
echo $resultado;
?>