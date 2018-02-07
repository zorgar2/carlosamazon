<?php
namespace App\Controller;

use App\Model\Usuario;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

class UsuarioController {
    
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
    
    public function acceso(){
        
        //Inicio el objeto datos
        $datos = new \stdClass();

        //Compruebo si esta logeado
        if (isset($_SESSION['usuario']) AND ($_SESSION['usuario'])){
            $datos->usuario = $_SESSION['usuario'];
            $vista = "panel";
        }
        else{
            $vista = "acceso";
        }
        
        //Inicializo mensaje
        $datos->mensaje = "Por favor, introduce usuario y clave";
        //Compruebo si ha rellenado el formulario
        if (isset($_POST['acceder'])){
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($usuario AND $clave){
                //Compruebo que existe el usuario
                if ($this->comprueba_usuario($usuario,$clave)){
                    //Entro al panel
                    $datos->usuario = $_SESSION['usuario'];
                    $vista = "panel";
                }
                else{
                    $datos->mensaje = "<span class='rojo'>Usuario y/o clave incorrectos.<br>Vuelve a intentarlo.</span>";
                }
            }
        }
        //Le paso los datos a la vista
        $this->view->vista($vista,$datos);
        
    }
    
    function comprueba_usuario($usuario,$clave){
        
        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM usuarios WHERE usuario='".$usuario."'");
        //Asigno la consulta a una variable
        $data = $resultado->fetch(\PDO::FETCH_OBJ);
        //Compruebo la contraseña
        if ($data AND hash_equals($data->clave, crypt($clave, $data->clave))){
            //Añado el nombre de usuario a la sesión
            $_SESSION['usuario'] = $data->usuario;
            return 1;
        }
        else{
            return 0;
        }
    }
    
    public function index(){

        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM usuarios");
        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)){ //Recorro el resultado
            $usuarios[] = new Usuario($data);
        }
        
        //Le paso los datos
        $this->view->vista("usuarios",$usuarios);
        
    }
    
    public function salir(){
        
        //Borro el nombre de usuario a la sesión
        $_SESSION['usuario'] = "";
        
        //Le redirijo al panel
        header("Location: ".$_SESSION['home']."panel");
        
    }
}
