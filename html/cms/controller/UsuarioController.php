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
        $resultado = $this->db->query("SELECT * FROM usuario WHERE usuario='".$usuario."'");
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
        $resultado = $this->db->query("SELECT * FROM usuario");
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
    
    public function crear(){

        //Insert
        $nombre = "usuario".rand(1000, 9999);
        $registros = $this->db->exec('INSERT INTO usuario (usuario) VALUES ("'.$nombre.'")');
        //Mensaje
        if ($registros){
            $mensaje[] = [
                        'tipo' => 'success',
                        'texto' => "El usuario <strong>$nombre</strong> se ha añadico correctamente.",
                        ];
        }
        else{
            $mensaje[] = [
                        'tipo' => 'danger',
                        'texto' => "Ha ocurrido un error al añadir al usuario.",
                        ]; 
        }
        $_SESSION['mensajes'] = $mensaje;

        //Le redirijo al panel
        header("Location: ".$_SESSION['home']."panel/usuarios");
        
    }
    
    function activar($id){
        
        if ($id){
            $registros = $this->db->exec("UPDATE usuarios SET activo=1 WHERE id=".$id."");
            //Mensaje
            if ($registros){
                $mensaje[] = [
                            'tipo' => 'success',
                            'texto' => "El usuario se ha activado correctamente.",
                            ];
            }
            else{
                $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "Ha ocurrido un error al activar al usuario.",
                            ]; 
            }
        }
        else{
            $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "El usuario no existe.",
                            ];
        }
        
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel de usuarios
        header("Location: ".$_SESSION['home']."panel/usuarios");
        
    }
    
    function desactivar($id){
        
        if ($id){
            $registros = $this->db->exec("UPDATE usuarios SET activo=0 WHERE id=".$id."");
            //Mensaje
            if ($registros){
                $mensaje[] = [
                            'tipo' => 'success',
                            'texto' => "El usuario se ha desactivado correctamente.",
                            ];
            }
            else{
                $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "Ha ocurrido un error al desactivar al usuario.",
                            ]; 
            }
        }
        else{
            $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "El usuario no existe.",
                            ];
        }
        
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel de usuarios
        header("Location: ".$_SESSION['home']."panel/usuarios");
        
    }
    
    function borrar($id){
        
        if ($id){
            $registros = $this->db->exec("DELETE FROM usuario WHERE id=".$id."");
            //Mensaje
            if ($registros){
                $mensaje[] = [
                            'tipo' => 'success',
                            'texto' => "El usuario se ha borrado correctamente.",
                            ];
            }
            else{
                $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "Ha ocurrido un error al borrar al usuario.",
                            ]; 
            }
        }
        else{
            $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "El usuario no existe.",
                            ];
        }
        
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel de usuarios
        header("Location: ".$_SESSION['home']."panel/usuarios");
        
    }
    
    function editar($id){
        
        if ($id){
            if (isset($_POST["guardar"]) AND $_POST["guardar"] == "Guardar"){
                //Recojo los valores de los inputs
                $usuario = filter_input(INPUT_POST,'usuario',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $usuarios = (filter_input(INPUT_POST, 'usuarios', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
                $noticias = (filter_input(INPUT_POST, 'noticias', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
                $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                //TODO: GUARDAR LA CLAVE SI ESTÁ MARCADO EL CHECK
                //Guardo en la base de datos
                $this->db->beginTransaction();
                $this->db->exec('UPDATE usuario SET usuario="'.$usuario.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE usuario SET usuarios="'.$usuarios.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE usuario SET noticias="'.$noticias.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE usuario SET clave="'.crypt('otaku',$clave).'" WHERE id='.$id.'');
                $this->db->commit();
                //Mensaje y redirección
                $mensaje[] = [
                            'tipo' => 'success',
                            'texto' => "El usuario <strong>$usuario</strong> se ha guardado correctamente.",
                            ];
                $_SESSION['mensajes'] = $mensaje;
                header("Location: ".$_SESSION['home']."panel/usuarios");
            }
            else{
                $resultado = $this->db->query("SELECT * FROM usuario WHERE id=".$id." LIMIT 1");
                if ($resultado){
                    $usuario = $resultado->fetch(\PDO::FETCH_OBJ);
                    //Le paso los datos a la vista
                    $this->view->vista('usuario',$usuario);
                }
                else{
                    $mensaje[] = [
                                'tipo' => 'danger',
                                'texto' => "Ha ocurrido un error al editar al usuario.",
                                ]; 
                    $_SESSION['mensajes'] = $mensaje;
                    //Le redirijo al panel de usuarios
                    header("Location: ".$_SESSION['home']."panel/usuarios");
                }
            }
        }
        else{
            $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "El usuario no existe.",
                            ];
            $_SESSION['mensajes'] = $mensaje;
            //Le redirijo al panel de usuarios
            header("Location: ".$_SESSION['home']."panel/usuarios");
        }
  
    }
}
