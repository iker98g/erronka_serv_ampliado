<?php
    class UsuariosClass {
        protected $idUsuario;
        protected $nombre;
        protected $contrasena;
        protected $tipo;
        protected $usuario;
        protected $correo;
       
        /**
         * @return mixed
         */
        public function getIdUsuario()
        {
            return $this->idUsuario;
        }
    
        /**
         * @return mixed
         */
        public function getNombre()
        {
            return $this->nombre;
        }
    
        /**
         * @return mixed
         */
        public function getContrasena()
        {
            return $this->contrasena;
        }
    
        /**
         * @return mixed
         */
        public function getTipo()
        {
            return $this->tipo;
        }
    
        /**
         * @return mixed
         */
        public function getUsuario()
        {
            return $this->usuario;
        }
    
        /**
         * @return mixed
         */
        public function getCorreo()
        {
            return $this->correo;
        }
    
        /**
         * @param mixed $idUsuario
         */
        public function setIdUsuario($idUsuario)
        {
            $this->idUsuario = $idUsuario;
        }
    
        /**
         * @param mixed $nombre
         */
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
    
        /**
         * @param mixed $contrasena
         */
        public function setContrasena($contrasena)
        {
            $this->contrasena = $contrasena;
        }
    
        /**
         * @param mixed $tipo
         */
        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }
    
        /**
         * @param mixed $usuario
         */
        public function setUsuario($usuario)
        {
            $this->usuario = $usuario;
        }
    
        /**
         * @param mixed $correo
         */
        public function setCorreo($correo)
        {
            $this->correo = $correo;
        }
    
        function getObjectVars()
        {
            $vars = get_object_vars($this);
            return  $vars;
        }
    }
?>