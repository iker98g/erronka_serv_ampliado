<?php
    if($_SERVER['SERVER_NAME']=="grupo4.dominios.fpz1920.com"){
        include_once ("connect_data_remote.php");
    }else{
        include_once ("connect_data.php");
    }
    require_once 'ConsultasClass.php';
    require_once 'UsuariosModel.php';
    class ConsultasModel extends ConsultasClass {
        
        private $link;
        private $list = array();
        private $objectUsuario;
        
        function getList(){
            return $this->list;
        }
        
        public function getObjectUsuario(){
            return $this->objectUsuario;
        }
        public function setObjectUsuario($objectUsuario)
        {
            $this->objectUsuario = $objectUsuario;
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
            
            $sql = "CALL spAllConsultas()"; // SQL sententzia - sentencia SQL
            
            $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
            // se guarda en result toda la información solicitada a la bbdd
            
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                
                $new=new ConsultasModel();
                
                $new->setIdConsulta($row['idConsulta']);
                $new->setConsulta($row['consulta']);
                $new->setIdUsuario($row['idUsuario']);
                
                $usuarios=new UsuariosModel();
                $usuarios->setIdUsuario($row['idUsuario']);
                $usuarios->findUsuarioById();
                $new->setObjectUsuario($usuarios);
                
                array_push($this->list, $new);
            }
            mysqli_free_result($result);
            unset($usuarios);
            $this->CloseConnect();
        }
        
        public function aniadirConsulta(){
            $this->OpenConnect();  // konexio zabaldu  - abrir conexión
            
            $consulta=$this->consulta;
            $idUsuario=$this->idUsuario;
            
            $sql="CALL spInsertarConsulta('$consulta',$idUsuario)";
            $numFilas=$this->link->query($sql);
            
            if ($numFilas>=1) {
                return "Consulta insertada";
            } else {
                return "Error al insertar la consulta";
            }
            
            $this->CloseConnect();
        }
        
        public function borrarConsulta() {
            $this->OpenConnect();
            
            $idConsulta=$this->getIdConsulta();
            
            $sql = "CALL spBorrarConsulta('$idConsulta')";
            
            if ($this->link->query($sql)>=1) { // aldatu egiten da
                return "La consulta se ha borrado con exito";
            } else {
                return "Fallo al borrar la consulta: (" . $this->link->errno . ") " . $this->link->error;
            }
            
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
                
                $objUsuario=$object->getObjectUsuario()->getObjectVars();
                $vars['objectUsuario']=$objUsuario;
                
                array_push($arr, $vars);
            }
            return json_encode($arr);
        } 
    }
?>