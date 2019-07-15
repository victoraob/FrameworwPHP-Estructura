<?php 


/**
 * Clase vista principal para cargar  modelos y vistas 
 */
class Controller
{
	
	function __construct()
	{
		# code...
	}

   //funcion para cargar modelo
	public function callModel($model){
		//CARGA 
		require_once '../app/models/'.$model .'.php';
		//instanciar modelo
		return new $model();
	}



	//funcion para cargar vistas 

	public function callView($view,$datosView = []){
		//chekear si el archivo vista existe
		if (file_exists('../app/views/'.$view .'.php')) {
           require_once '../app/views/'.$view .'.php';
		}else{
			// si el archivo de la vista no existe
			die('La vista no Existe');
		}

	}
}




 ?>