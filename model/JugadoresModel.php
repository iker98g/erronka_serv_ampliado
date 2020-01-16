<?php
if($_SERVER['SERVER_NAME']=="grupo4.dominios.fpz1920.com"){
    include_once ("connect_data_remote.php");
}else{
    include_once ("connect_data.php");
}
require_once 'JugadoresClass.php';
require_once 'EquiposModel.php';


class JugadoresModel extends JugadoresClass {
    
    private $link;
    private $list = array();
    private $objectEquipo;
    
    /**
     * @param mixed $objectEquipo
     */
    public function setObjectEquipo($objectEquipo)
    {
        $this->objectEquipo = $objectEquipo;
    }

    function getList(){
        return $this->list;
    }
    
    public function getObjectEquipo(){
        return $this->objectEquipo;
    }
    
    public function OpenConnect() {
        $konDat=new connect_data();
        try {
            $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
            // mysqli klaseko link objetua sortzen da dagokion konexio datuekin
            // se crea un nuevo objeto llamado link de la clase mysqli con los datos de conexión.
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta
        //                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }
    
    public function CloseConnect() {
        mysqli_close ($this->link);
    }
    
    public function setList() {
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión
        
        $sql = "CALL spAllJugadores()"; // SQL sententzia - sentencia SQL
        
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
        // se guarda en result toda la información solicitada a la bbdd
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $new=new JugadoresModel();
            
            $new->setIdJugador($row['idJugador']);
            $new->setIdEquipo($row['idEquipo']);
            $new->setNombre($row['nombre']);
            $new->setRol($row['rol']);
            $new->setImagen($row['imagen']);
            $new->setTelefono($row['telefono']);
            
            $equipo=new EquiposModel();
            $equipo->setIdEquipo($row['idEquipo']);
            $equipo->findEquipoById();
            
            $new->setObjectEquipo($equipo);
            
            array_push($this->list, $new);
            
        }
        mysqli_free_result($result);
        unset($equipo);
        $this->CloseConnect();
    }
    
    public function aniadirJugador(){
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión
        
        $idEquipo=$this->idEquipo;
        $nombre=$this->nombre;
        $rol=$this->rol;
        $imagen=$this->imagen;
        $telefono=$this->telefono;
        
        $sql="CALL spInsertarJugador('$nombre','$imagen','$rol','$telefono',$idEquipo)";
        
        $numFilas=$this->link->query($sql);
        
        if ($numFilas>=1) {
            return "Jugador insertado";
        } else {
            return "Error al insertar el jugador";
        }
        
        $this->CloseConnect();
    }
    
    public function borrarJugador() {
        $this->OpenConnect();
        
        $idJugador=$this->getIdJugador();
          
        $sql = "CALL spBorrarJugador('$idJugador')";
        
        if ($this->link->query($sql)>=1) { // aldatu egiten da
            return "El jugador se ha borrado con exito";
        } else {
            return "Fallo al borrar el jugador: (" . $this->link->errno . ") " . $this->link->error;
        }
        
        $this->CloseConnect();
    }
    
    public function editarJugador() {
        $this->OpenConnect();
        
        $idJugador=$this->idJugador;
        $idEquipo=$this->idEquipo;
        $nombre=$this->nombre;
        $rol=$this->rol;
        $imagen=$this->imagen;
        $telefono=$this->telefono;
        
        $sql = "CALL spModificarJugador($idJugador,$idEquipo, '$nombre', '$rol', '$imagen', '$telefono')";
        if ($this->link->query($sql)>=1) { // aldatu egiten da
            return "El jugador se ha modificado con exito";
        } else {
            return "Fallo al modificar el jugador: (" . $this->link->errno . ") " . $this->link->error;
        }
        
        $this->CloseConnect();
    }
    
    public function findJugadoresByIdEquipo() {    
        $this->OpenConnect();
        $idEquipo=$this->idEquipo;
        $sql = "CALL spJugadoresPorEquipo($idEquipo)";
        $result= $this->link->query($sql);
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $new=new JugadoresModel();
            
            $new->setIdJugador($row['idJugador']);
            $new->setIdEquipo($row['idEquipo']);
            $new->setNombre($row['nombre']);
            $new->setRol($row['rol']);
            $new->setImagen($row['imagen']);
            $new->setTelefono($row['telefono']);
            
            $equipo=new EquiposModel();
            $equipo->setIdEquipo($row['idEquipo']);
            $equipo->findEquipoById();
            
            $new->setObjectEquipo($equipo);
            
            array_push($this->list, $new);
        }
        mysqli_free_result($result);
        unset($equipo);
        $this->CloseConnect();
    }
        
    function getListJsonString() {
        
        $arr=array();
        
        foreach ($this->list as $object) {
            $vars = get_object_vars($object);
            
            array_push($arr, $vars);
        }
        return json_encode($arr);
    }
    
    function getListJsonStringObject() {       
        // returns the list of objects in a srting with JSON format
        $arr=array();
        
        foreach ($this->list as $object) {
            $vars = $object->getObjectVars();
            
            $objEquipo=$object->getObjectEquipo()->getObjectVars();
            $vars['objectEquipo']=$objEquipo;
            
            array_push($arr, $vars);
        }
        return json_encode($arr);
    } 
}