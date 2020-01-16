<?php
include_once ("../../model/EquiposModel.php");

$equipo = new EquiposModel();

$id=($_POST["id"]);

if ($id != null) {
    $equipo -> setIdEquipo($id);
    $resultado = $equipo -> borrarEquipo();
} else {
    $resultado = "No se ha pasado la ID";
}
echo $resultado;
?>