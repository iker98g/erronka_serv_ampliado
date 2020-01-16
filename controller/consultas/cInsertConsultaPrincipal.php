<?php
    include_once ("../../model/ConsultasModel.php");
    include_once ("../../model/UsuariosModel.php");
    
    echo $_GET["datosInsert"];
    $misDatos=json_decode($_GET["datosInsert"]);
    
    $consulta=$misDatos->consulta;
    $usuario=$misDatos->usuario;

    $consultaNueva = new ConsultasModel();
    
    $consultaNueva->setConsulta($consulta);
    $consultaNueva->setidUsuario($usuario);
    
    if($usuario==null){
        $consultaNueva->setidUsuario(100);
        $resultado=$consultaNueva->aniadirConsulta();
     }else{
        $resultado=$consultaNueva->aniadirConsulta();
     }
     
   echo $resultado;
?>