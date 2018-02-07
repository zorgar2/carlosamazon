<?php
namespace App;
session_start();

use App\Controller\UsuarioController;

//Ruta de la carpeta public
$public = '/cms/public/';

//Llamo a la cabecera
require("../view/partials/header.php");

//Ruta de la home
$home = '/cms/public/index.php/';

//La guardo a la sesión
$_SESSION['home'] = $home;

//Defino la función que autocargará las clases cuando se instancien
spl_autoload_register('App\autoload');
function autoload($clase,$dir=null){
    
    //Directorio raíz de mi proyecto
    if (is_null($dir)){
        $dirname = str_replace('/public', '', dirname(__FILE__));
        $dir = realpath($dirname);
    }
    
    //Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file){
        //Si es un directorio (y no es de sistema) accedo y 
        //busco la clase dentro de él
        if (is_dir($dir."/".$file) AND substr($file, 0, 1) !== '.'){
            autoload($clase, $dir."/".$file);
        }
        //Si es un fichero y el nombr conicide con el de la clase
        else if (is_file($dir."/".$file) AND $file == substr(strrchr($clase, "\\"), 1).".php"){
            require($dir."/".$file);
        }
    }
    
}

//Compruebo qué ruta me están pidiendo
$ruta = str_replace($home, '', $_SERVER['REQUEST_URI']);

//Enrutamientos
switch ($ruta){
    
    case 'panel': 
        //Instancio el controlador
        $controller = new UsuarioController;
        
        //Le mando al panel de acceso
        $controller->acceso();
        break;
    case 'panel/salir':
        //Instancio el controlador
        $controller = new UsuarioController;
        //Le mando al método salir
        $controller->salir();
        break;
    case 'panel/usuarios':
        //Instancio el controlador
        $controller = new UsuarioController;
        //Le mando al método salir
        $controller->index();
        break;
    case 'panel/usuarios/crear':
        //Instancio el controlador
        $controller = new UsuarioController;
        //Le mando al método salir
        $controller->crear();
        break;
}


//Llamo al pie
require("../view/partials/footer.php");