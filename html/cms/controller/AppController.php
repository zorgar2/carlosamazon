<?php
namespace App\Controller;

use App\Model\Noticia;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

class AppController {
    
    var $db;
    var $view;
    var $datos;
    
    function __construct(){
        //Inicializo la conexión
        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;
        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }
    
    public function index(){

        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM noticia WHERE activo = 1 AND home = 1");
        //Asigno la consulta a una variable
        $noticias = [];
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)){ //Recorro el resultado
            $noticias[] = new Noticia($data);
        }
        
        //Le paso los datos
        $this->view->vista("home",$noticias);
        
    }
    public function todas(){

        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM noticia");
        //Asigno la consulta a una variable
        $noticias = [];
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)){ //Recorro el resultado
            $noticias[] = new Noticia($data);
        }
        
        //Le paso los datos
        $this->view->vista("todo",$noticias);
        
    }
    public function mostrar($id) {
        //selecciona con obj
        $resultado = $this->db->query("SELECT * FROM  noticia WHERE id='" . $id . "'");
        //Se asigna la consulta de la variable
        
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)){
            //Se recorre el resultado
            $noticias[]= new Noticia($data);
            
        }
        //Se le pasan los datos
        $this->view->vista("info", $noticias);
        
        
    }
    public function sobre() {

        $this->view->vista("sobre", "");
        
        
    }
}