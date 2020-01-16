<?php
include_once ("../../model/CategoriasModel.php");
include_once ("../../model/EquiposModel.php");
$datosInsert=(count($_POST["datosInsert"]));
for($i = 0; $i <$datosInsert ; $i++){
    $nombre=($_POST["datosInsert"][$i]["nombre"]);
    $logo=($_POST["datosInsert"][$i]["logo"]);
    $categoria=($_POST["datosInsert"][$i]["categoria"]);
    
    $equipoNuevo = new EquiposModel();
    
    $equipoNuevo -> setNombre($nombre);
    $equipoNuevo -> setLogo($logo);
    
    $categoriaEquipoNuevo = new CategoriasModel();
    $categoriaEquipoNuevo->setNombre($categoria);
    
    $categoriaEquipoNuevo->buscarCategoriaId();
    $equipoNuevo -> setIdCategoria($categoriaEquipoNuevo->getIdCategoria());
    
    
    $resultado=$equipoNuevo -> aniadirEquipo();
    
    echo $resultado;
}

$datosInsert=($_POST["datosInsert"]);

?>