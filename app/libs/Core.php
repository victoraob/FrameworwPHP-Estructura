<?php 

/**
 * Mapear URL ingresada en el navegador
   1 = Controlador
   2 = Metodo 
   3 = parametro
   Ejemplo : /Inicio/registrar/4
 */
class Core  
{

    protected $controladorActual = 'inicio';
    protected $metodoActual = 'index';
    protected $parametros = [];
 
	
	public function __construct()
	{
     $url = $this->obtain();



      // buscar el controlador si existe
     if (file_exists('../app/controllers/'. ucwords($url['0']).'.php')) {
      
       // si existe el controlador se toma como controller for default
        $this->controladorActual = ucwords($url['0']);

        //unset indice

        unset($url['0']);
     }//fin if fileexist



     // requerir el controlador

     require_once '../app/controllers/'.$this->controladorActual.'.php';
     $this->controladorActual = new $this->controladorActual;


    // Verificar el segundo indice del arreglo url que es el metodo dentro de los controladores
     
     if (isset($url['1'])) {
         if (method_exists($this->controladorActual, $url['1'])) {

          $this->metodoActual = $url['1'];

          //unset metodo
          unset($url['1']);
       
         }//fin if method_exists
       }//fin if isset
     
      // para probar que trae el metodo ==> echo $this->metodoActual;


       //OBTENER PARAMETROS

       $this->parametros = $url ? array_values($url):[];

       // Llamar callback       

       call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);

	}// fin __contruct


    public function obtain(){

      if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }



    }//fin obtain

   



}//Fin Class Core


 ?>