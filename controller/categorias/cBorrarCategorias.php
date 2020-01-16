<?php
include_once ("../../model/CategoriasModel.php");

$categoria = new CategoriasModel();

$id=($_POST["id"]);

if ($id != null) {
    $categoria -> setIdCategoria($id);
    $resultado = $categoria -> borrarCategoria();
} else {
    $resultado = "No se ha pasado la ID";
}
echo $resultado;
?>