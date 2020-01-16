<?php
    require_once '../../model/UsuariosModel.php';
    
    $username=filter_input(INPUT_GET, "username");
    
    $user = new UsuariosModel();
    $user->setUsuario($username);
    
    if ($user->usuarioExistente()){
        echo 1;
    }else {
        echo 0;
    }
?>