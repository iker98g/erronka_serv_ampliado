<?php
include_once ("../../model/JugadoresModel.php");
include_once ("../../model/EquiposModel.php");

$datosInsert=(count($_POST["datosInsert"]));

for($i = 0; $i <$datosInsert ; $i++){
    $id=($_POST["datosInsert"][$i]["id"]);
    $nombre=($_POST["datosInsert"][$i]["nombre"]);
    $imagen=($_POST["datosInsert"][$i]["imagen"]);
    $telefono=($_POST["datosInsert"][$i]["telefono"]);
    $equipo=($_POST["datosInsert"][$i]["equipo"]);
    $rol=($_POST["datosInsert"][$i]["rol"]);
    
    $jugadorNuevo = new JugadoresModel();
    
    $jugadorNuevo -> setIdJugador($id);
    $jugadorNuevo -> setNombre($nombre);
    $jugadorNuevo -> setImagen($imagen);
    $jugadorNuevo -> setRol($rol);
    $jugadorNuevo -> setTelefono($telefono);
    
    $equipoJugadorNuevo = new EquiposModel();
    $equipoJugadorNuevo->setNombre($equipo);
    
    $equipoJugadorNuevo->buscarEquipoId();
    $jugadorNuevo -> setIdEquipo($equipoJugadorNuevo->getIdEquipo());

    
    $resultado=$jugadorNuevo -> editarJugador();
    
    echo $resultado;
}

$datosInsert=($_POST["datosInsert"]);
?>