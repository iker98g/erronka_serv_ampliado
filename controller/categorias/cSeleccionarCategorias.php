<?php
include_once("../../model/CategoriasModel.php");

$categorias = new CategoriasModel();
$categorias -> setList();

$listaCategoriasJSON = $categorias -> getListJsonString();

echo $listaCategoriasJSON;

unset ($categorias);
?>