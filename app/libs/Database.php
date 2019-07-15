<?php



/**
  * Clase para la conexion a la base de datos en PDO
  */
 class Database
 {


 	private $name_db = DB_NAME;
 	private $user_db = DB_USER;
 	private $password_db = DB_PASSWORD;
 	private $host_db = DB_HOST;


 	private $dbh;
 	private $stmt;
 	private $error; 
 	
 	function __construct()
 	{
 		//configurar conexion 
 		$dsn = 'mysql:host=' . $this->host_db . ";dbname=". $this->name_db;
 		$options = [
 			    PDO::ATTR_PERSISTENT   => true,
                PDO::ATTR_ERRMODE      => PDO::ERRMODE_EXCEPTION
                
            ];



            //crear una instancia de PDO

            try {

            	$this->dbh = new PDO($dsn,$this->user_db,$this->password_db,$options);
            	$this->dbh->exec('set names utf8');
            	
            } catch (PDOException $e) {

            	$this->error = $e->getMessage();
            	echo $this->error;
            	
            }
           
 	}//fin construct 

 	public function query($sql){

     $this->stmt = $this->dbh->prepare($sql);


 	}//fin query function

//vinculamos la consulta con bind

 	public function bind($parametro,$valor,$tipo = null){

 		if (is_null($tipo)) {
 			
          switch (true) {
          	case is_int($tipo):
          		$tipo = PDO::PARAM_INT;
          		break;

          	case is_bool($tipo):
          		$tipo = PDO::PARAM_BOOL;
          		break;
          	case is_null($tipo):
          		$tipo = PDO::PARAM_NULL;
          		break;

          	default:
          		$tipo = PDO::PARAM_STR;
          		break;
          }//fin de switch

 		}//fin is_null(var)

 		$this->stmt->bindValue($parametro,$valor,$tipo);


 	}//fin function bind


 	//ejecuta la consulta

 	public function execute(){
 		return $this->stmt->execute();
 	}

 	//obtener los registros 

 	public function registros(){
        $this->execute();
 		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
 	}// fin registros function

 	//obtener EL registro 

 	public function registro(){
        $this->execute();
 		return $this->stmt->fetch(PDO::FETCH_OBJ);
 	}//FIN REGISTRO function

 	//obtener la cantidad de filas con function rowcount

 	public function rowCount(){
      return $this->stmt->rowCount();

 	}


 } 


 ?>