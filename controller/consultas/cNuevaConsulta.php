<?php
    include_once ("../../model/ConsultasModel.php");
    
    $textoConsulta=filter_input(INPUT_POST, "textoConsulta");
    $idUsuario=filter_input(INPUT_POST, "idUsuario");
    
    echo $textoConsulta;
    echo $idUsuario;

    $consultaNueva = new ConsultasModel();
    $consultaNueva->setConsulta($textoConsulta);
    $consultaNueva->setIdUsuario($idUsuario);

    $consultaNueva->aniadirConsulta();
?>