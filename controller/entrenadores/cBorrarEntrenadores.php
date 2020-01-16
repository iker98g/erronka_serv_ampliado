<?php
include_once ("../../model/EntrenadoresModel.php");

$entrenador = new EntrenadoresModel();

$id=($_POST["id"]);

if ($id != null) {
    $entrenador -> setIdEntrenador($id);
    $resultado = $entrenador -> borrarEntrenador();
} else {
    $resultado = "No se ha pasado la ID";
}
echo $resultado;
?>