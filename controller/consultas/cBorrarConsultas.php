<?php
include_once ("../../model/ConsultasModel.php");

$consultas = new ConsultasModel();

$id=($_POST["id"]);

if ($id != null) {
    $consultas -> setIdConsulta($id);
    $resultado = $consultas -> borrarConsulta();
} else {
    $resultado = "No se ha pasado la ID";
}
echo $resultado;
?>