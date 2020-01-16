<?php
include_once ("../../model/ConsultasModel.php");
include_once ("../../model/UsuariosModel.php");
$datosInsert=(count($_POST["datosInsert"]));
for($i = 0; $i <$datosInsert ; $i++){
    $consulta=($_POST["datosInsert"][$i]["consulta"]);
    $usuario=($_POST["datosInsert"][$i]["usuario"]);
    
    $consultaNueva = new ConsultasModel();
    
    $consultaNueva -> setConsulta($consulta);

    $consultaUsuarioNueva = new UsuariosModel();
    $consultaUsuarioNueva->setUsuario($usuario);
    
    $consultaUsuarioNueva->buscarUsuarioId();
    $consultaNueva -> setIdUsuario($consultaUsuarioNueva->getIdUsuario());
    $consultaUsuarioNueva -> setIdUsuario($consultaUsuarioNueva->getIdUsuario());
    
    $consultaUsuarioNueva->findUsuarioById();
    
    $resultado=$consultaNueva -> aniadirConsulta();
    
    echo $resultado;
}

$datosInsert=($_POST["datosInsert"]);

?>