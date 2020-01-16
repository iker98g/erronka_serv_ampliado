<?php
include_once ("../../model/UsuariosModel.php");

$usuarios = new UsuariosModel();

$id=($_POST["id"]);

if ($id != null) {
    $usuarios -> setIdUsuario($id);
    $resultado = $usuarios -> borrarUsuario();
} else {
    $resultado = "No se ha pasado la ID";
}
echo $resultado;
?>