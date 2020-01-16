<?php
if($_SERVER['SERVER_NAME']=="grupo4.dominios.fpz1920.com"){
    include_once ("connect_data_remote.php");
}else{
    include_once ("connect_data.php");
}
require_once 'EquiposClass.php';
require_once 'CategoriasModel.php';


class EquiposModel extends EquiposClass {
    
    private $link;
    private $list = array();
    private $objectCategoria;
    
    function getList(){
        return $this->list;
    }
    
    public function getObjectCategoria(){
        return $this->objectCategoria;
    }
    public function setObjectCategoria($objectCategoria)
    {
        $this->objectCategoria = $objectCategoria;
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
        
        $sql = "CALL spAllEquipos()"; // SQL sententzia - sentencia SQL
        
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
        // se guarda en result toda la información solicitada a la bbdd
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $new=new EquiposModel();
            
            $new->setIdEquipo($row['idEquipo']);
            $new->setNombre($row['nombre']);
            $new->setIdCategoria($row['idCategoria']);
            $new->setLogo($row['logo']);
       
            $categoria=new CategoriasModel();
            $categoria->setIdCategoria($row['idCategoria']);
            $categoria->findCategoriaById();
            $new->setObjectCategoria($categoria);
            array_push($this->list, $new);
        }
        mysqli_free_result($result);
        unset($categoria);
        $this->CloseConnect();
    }
    public function aniadirEquipo(){
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión
        
        $idCategoria=$this->idCategoria;
        $nombre=$this->nombre;
        $logo=$this->logo;
        
        $sql="CALL spInsertarEquipo('$nombre','$logo',$idCategoria)";
        $numFilas=$this->link->query($sql);
        
        if ($numFilas>=1) {
            return "Entrenador insertado";
        } else {
            return "Error al insertar el entrenador";
        }
        
        $this->CloseConnect();
    }
    
    
    public function borrarEquipo() {
        $this->OpenConnect();
        
        $idEquipo=$this->getIdEquipo();
        
        $sql = "CALL spBorrarEquipo('$idEquipo')";
        
        if ($this->link->query($sql)>=1) { // aldatu egiten da
            return "El equipo se ha borrado con exito";
        } else {
            return "Fallo al borrar el equipo: (" . $this->link->errno . ") " . $this->link->error;
        }
        
        $this->CloseConnect();
    }
    
    public function editarEquipo() {
        $this->OpenConnect();
        
        $idEquipo=$this->idEquipo;
        $nombre=$this->nombre;
        $idCategoria=$this->idCategoria;
        $logo=$this->logo;
        
        $sql = "CALL spModificarEquipo($idEquipo,'$nombre', $idCategoria, '$logo')";
        if ($this->link->query($sql)>=1) { // aldatu egiten da
            return "El equipo se ha modificado con exito";
        } else {
            return "Fallo al modificar el equipo: (" . $this->link->errno . ") " . $this->link->error;
        }
        
        $this->CloseConnect();
    }
    
    
    public function findEquipoById() {
        $this->OpenConnect();
        $idEquipo=$this->idEquipo;
        $sql = "CALL spSeleccionarEquipoPorId($idEquipo)";
        $result= $this->link->query($sql);
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $this->setIdCategoria($row['idCategoria']);
            $this->setIdEquipo($row['idEquipo']);
            $this->setNombre($row['nombre']);
            $this->setLogo($row['logo']);
            
            
            array_push($this->list, $this);
        }
        mysqli_free_result($result);
        $this->CloseConnect();   
    }
    
    public function buscarEquipoId() {       
        $this->OpenConnect();
        $nombre=$this->nombre;
        $sql = "CALL spBuscarEquipoId('$nombre')";
        $result= $this->link->query($sql);
        
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {  
            $this->setIdCategoria($row['idCategoria']);
            $this->setIdEquipo($row['idEquipo']);
            $this->setNombre($row['nombre']);
            $this->setLogo($row['logo']);
            array_push($this->list, $this);
        } 
        mysqli_free_result($result);
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
            
            $objCategoria=$object->getObjectCategoria()->getObjectVars();
            $vars['objectCategoria']=$objCategoria;
            
            array_push($arr, $vars);
        }
        return json_encode($arr);
    } 
    
    public function findEquiposByIdCategoria() {   
        $this->OpenConnect();
        $idCategoria=$this->idCategoria;
        $sql = "CALL spEquiposPorCategoria($idCategoria)";
        $result= $this->link->query($sql);
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $new=new EquiposModel();
            
            $new->setIdEquipo($row['idEquipo']);
            $new->setNombre($row['nombre']);
            $new->setIdCategoria($row['idCategoria']);
            $new->setLogo($row['logo']);
            
            $categoria=new CategoriasModel();
            $categoria->setIdCategoria($row['idCategoria']);
            $categoria->findCategoriaById();
            $new->setObjectCategoria($categoria);
            array_push($this->list, $new);
        }
        mysqli_free_result($result);
        unset($categoria);
        $this->CloseConnect(); 
    }
}