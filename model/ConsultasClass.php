<?php

class ConsultasClass {
    protected $idConsulta;
    protected $consulta;
    protected $idUsuario;
    
   
    /**
     * @return mixed
     */
    public function getIdConsulta()
    {
        return $this->idConsulta;
    }

    /**
     * @return mixed
     */
    public function getConsulta()
    {
        return $this->consulta;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idConsulta
     */
    public function setIdConsulta($idConsulta)
    {
        $this->idConsulta = $idConsulta;
    }

    /**
     * @param mixed $consulta
     */
    public function setConsulta($consulta)
    {
        $this->consulta = $consulta;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    function getObjectVars()
    {
        $vars = get_object_vars($this);
        return  $vars;
    }
}
?>