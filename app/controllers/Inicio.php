<?php 


/**
 * clase inicio
 */
class Inicio extends Controller
{
	
	function __construct()
	{
		
	}

	public function index(){

		

		$datosView = [

			'titulo' => 'Welcome To Framework Oropeza'

	    ];
     
     $this->callView('pages/inicio', $datosView);
		

	}
}


 ?>