<?php
include_once ("../../model/CategoriasModel.php");
$datosInsert=(count($_POST["datosInsert"]));
for($i = 0; $i <$datosInsert ; $i++){
    $nombre=($_POST["datosInsert"][$i]["nombre"]);
    $imagen=($_POST["datosInsert"][$i]["imagen"]);
    
    $categoriaNueva = new CategoriasModel();
    
    $categoriaNueva -> setNombre($nombre);
    $categoriaNueva -> setImagen($imagen);
    
   
    $resultado=$categoriaNueva -> aniadirCategoria();
    
    echo $resultado;
}

$datosInsert=($_POST["datosInsert"]);

?>