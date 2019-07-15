<?php 
require_once 'config/config.php';


//require_once 'libs/Core.php';
//require_once 'libs/Database.php';
//require_once 'libs/Controller.php';


spl_autoload_register(function($nameClass){

    require_once 'libs/'.$nameClass.'.php';

});


 ?>