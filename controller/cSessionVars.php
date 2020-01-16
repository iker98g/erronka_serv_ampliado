<?php
    require_once '../model/UsuariosModel.php';
    
    $username=filter_input(INPUT_GET, "username");
    $password=filter_input(INPUT_GET, "password");
    
    $user = new UsuariosModel();
    $user->setUsuario($username);
    $user->setContrasena($password);
    
    if ($user->findUserByUsername()){
        session_start();
        
        $_SESSION['idUsuario']=$user->getIdUsuario();
        $_SESSION['usuario']=$username;
        $_SESSION['admin']=$user->getTipo();
        
        $obj['idUsuario']=$_SESSION['idUsuario'];
        $obj['usuario']=$_SESSION['usuario'];
        $obj['admin']=$_SESSION['admin'];
        
        $objJson= json_encode($obj);
        
        echo $objJson;
    }else {
        echo 0;
    }
?>