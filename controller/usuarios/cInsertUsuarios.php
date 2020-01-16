<?php
    include_once ("../../model/UsuariosModel.php");
    
    $nombre = filter_input(INPUT_POST, 'nombre');
    $correo = filter_input(INPUT_POST, 'correo');
    $usuario = filter_input(INPUT_POST, 'usuario');
    $contrasena = filter_input(INPUT_POST, 'contrasena');
    
    $usuarios = new UsuariosModel();
    
    $usuarios -> setNombre($nombre);
    $usuarios -> setCorreo($correo);
    $usuarios -> setContrasena($contrasena);
    $usuarios -> setUsuario($usuario);
    
    $usuarios -> insertarUsuario();
?>