<?php
namespace App;
session_start();

use App\Controller\UsuarioController;
use App\Controller\NoticiaController;
use App\Controller\AppController;

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

$array_ruta = explode("/", $ruta);

//Enrutamientos
if (count($array_ruta) == 2 && $array_ruta[0] == "mostrar"){
    if ($array_ruta[0] == "mostrar"){
    $id = $array_ruta[1];
    //insertando el controlador
    $controller = new AppController;
    //Le mando el panel de acceso
    $controller->mostrar($id);
    
    }
}else if (count($array_ruta) == 4){
    
    if ($array_ruta[0].$array_ruta[1] == "panelusuarios"){
        if ($array_ruta[2] == "editar" OR 
            $array_ruta[2] == "borrar" OR
            $array_ruta[2] == "desactivar" OR
            $array_ruta[2] == "activar"){
            $controller = new UsuarioController;
            $accion = $array_ruta[2];
            $id = $array_ruta[3];
            //LLamo a la acción
            $controller->$accion($id);
        }
        else{
            $controller = new AppController;
            $controller->index();
        }
        
    }
    else if ($array_ruta[0].$array_ruta[1] == "panelnoticias"){
        if ($array_ruta[2] == "editar" OR 
            $array_ruta[2] == "borrar" OR
            $array_ruta[2] == "desactivar" OR    
            $array_ruta[2] == "activar" OR
            $array_ruta[2] == "desactivar1" OR
            $array_ruta[2] == "activar1"){
            $controller = new NoticiaController;
            $accion = $array_ruta[2];
            $id = $array_ruta[3];
            //LLamo a la acción
            $controller->$accion($id);
        }
        else{
            $controller = new AppController;
            $controller->index();
        }
    }
    else{
        $controller = new AppController;
        $controller->index();
    }
    
}
else{
    switch ($ruta){

        case 'panel':
            $controller = new UsuarioController;
            $controller->acceso();
            break;
        case 'panel/salir':
            $controller = new UsuarioController;
            $controller->salir();
            break;
        case 'panel/usuarios':
            $controller = new UsuarioController;
            $controller->index();
            break;
        case 'panel/usuarios/crear':
            $controller = new UsuarioController;
            $controller->crear();
            break;
        case 'panel/noticias':
            $controller = new NoticiaController;
            $controller->index();
            break;
        case 'panel/noticias/crear':
            $controller = new NoticiaController;
            $controller->crear();
            break;
        case 'sobre':
            $controller = new AppController;
            $controller->sobre();
            break;
        case 'todo':
            $controller = new AppController;
            $controller->todas();
            break;
        default: 
            $controller = new AppController;
            $controller->index();
    }
}

//Llamo al pie
require("../view/partials/footer.php");