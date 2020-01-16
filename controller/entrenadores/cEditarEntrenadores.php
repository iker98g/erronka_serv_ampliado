<?php
include_once ("../../model/EntrenadoresModel.php");
include_once ("../../model/EquiposModel.php");
$datosInsert=(count($_POST["datosInsert"]));
for($i = 0; $i <$datosInsert ; $i++){
    $id=($_POST["datosInsert"][$i]["id"]);
    $nombre=($_POST["datosInsert"][$i]["nombre"]);
    $imagen=($_POST["datosInsert"][$i]["imagen"]);
    $telefono=($_POST["datosInsert"][$i]["telefono"]);
    $equipo=($_POST["datosInsert"][$i]["equipo"]);
    
    $entrenadorNuevo = new EntrenadoresModel();
    
    $entrenadorNuevo -> setIdEntrenador($id);
    $entrenadorNuevo -> setNombre($nombre);
    $entrenadorNuevo -> setImagen($imagen);
    $entrenadorNuevo -> setTelefono($telefono);
    
    $equipoEntrenadorNuevo = new EquiposModel();
    $equipoEntrenadorNuevo->setNombre($equipo);
    
    $equipoEntrenadorNuevo->buscarEquipoId();
    $entrenadorNuevo -> setIdEquipo($equipoEntrenadorNuevo->getIdEquipo());

    
    $resultado=$entrenadorNuevo -> editarEntrenador();
    
    echo $resultado;
}

$datosInsert=($_POST["datosInsert"]);

?>