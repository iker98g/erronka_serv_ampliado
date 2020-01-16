<?php
    require_once '../../model/UsuariosModel.php';
    
    $correo=filter_input(INPUT_GET, "correo");
    
    $user = new UsuariosModel();
    $user->setCorreo($correo);
    
    if ($user->correoExistente()){
        echo 1;
    }else {
        echo 0;
    }
?>