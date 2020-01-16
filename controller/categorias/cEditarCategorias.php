<?php
include_once ("../../model/CategoriasModel.php");
$datosInsert=(count($_POST["datosInsert"]));
for($i = 0; $i <$datosInsert ; $i++){
    $id=($_POST["datosInsert"][$i]["id"]);
    $nombre=($_POST["datosInsert"][$i]["nombre"]);
    $imagen=($_POST["datosInsert"][$i]["imagen"]);
    
    $categoriaNueva = new CategoriasModel();
    
    $categoriaNueva -> setIdCategoria($id);
    $categoriaNueva -> setNombre($nombre);
    $categoriaNueva -> setImagen($imagen);
    
    
    $resultado=$categoriaNueva -> editarCategoria();
    
    echo $resultado;
}

$datosInsert=($_POST["datosInsert"]);

?>