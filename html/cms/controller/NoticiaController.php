<?php
namespace App\Controller;

use App\Model\Noticia;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

class NoticiaController {
    
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
        $resultado = $this->db->query("SELECT * FROM noticia");
        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)){ //Recorro el resultado
            $noticias[] = new Noticia($data);
        }
        
        //Le paso los datos
        $this->view->vista("noticias",$noticias);
        
    }

    public function crear(){

        //Insert
        $nombre = "noticia".rand(1000, 9999);
        $registros = $this->db->exec('INSERT INTO noticia (titulo) VALUES ("'.$nombre.'")');
        //Mensaje
        if ($registros){
            $mensaje[] = [
                        'tipo' => 'success',
                        'texto' => "La noticia <strong>$nombre</strong> se ha añadico correctamente.",
                        ];
        }
        else{
            $mensaje[] = [
                        'tipo' => 'danger',
                        'texto' => "Ha ocurrido un error al añadir la noticia.",
                        ]; 
        }
        $_SESSION['mensajes'] = $mensaje;

        //Le redirijo al panel
        header("Location: ".$_SESSION['home']."panel/noticias");
        
    }
    
    function activar($id){
        
        if ($id){
            $registros = $this->db->exec("UPDATE noticia SET activo=1 WHERE id=".$id."");
            //Mensaje
            if ($registros){
                $mensaje[] = [
                            'tipo' => 'success',
                            'texto' => "La noticia se ha activado correctamente.",
                            ];
            }
            else{
                $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "Ha ocurrido un error al activar la noticia.",
                            ]; 
            }
        }
        else{
            $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "La noticia no existe.",
                            ];
        }
        
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel de noticias
        header("Location: ".$_SESSION['home']."panel/noticias");
        
    }
    
    function desactivar($id){
        
        if ($id){
            $registros = $this->db->exec("UPDATE noticia SET activo=0 WHERE id=".$id."");
            //Mensaje
            if ($registros){
                $mensaje[] = [
                            'tipo' => 'success',
                            'texto' => "La noticia se ha desactivado correctamente.",
                            ];
            }
            else{
                $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "Ha ocurrido un error al desactivar la noticia.",
                            ]; 
            }
        }
        else{
            $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "La noticia no existe.",
                            ];
        }
        
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel de noticias
        header("Location: ".$_SESSION['home']."panel/noticias");
        
    }
    
    function borrar($id){
        
        if ($id){
            $registros = $this->db->exec("DELETE FROM noticia WHERE id=".$id."");
            //Mensaje
            if ($registros){
                $mensaje[] = [
                            'tipo' => 'success',
                            'texto' => "La noticia se ha borrado correctamente.",
                            ];
            }
            else{
                $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "Ha ocurrido un error al borrar la noticia.",
                            ]; 
            }
        }
        else{
            $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "La noticia no existe.",
                            ];
        }
        
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel de usuarios
        header("Location: ".$_SESSION['home']."panel/noticias");
        
    }
    
    function editar($id){
        if ($id){
            if (isset($_POST["guardar"]) AND $_POST["guardar"] == "Guardar"){
                //Recojo los valores de los inputs
                $titulo = filter_input(INPUT_POST,'titulo',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $entradilla = filter_input(INPUT_POST,'entradilla',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $autor = filter_input(INPUT_POST,'autor',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $texto = filter_input(INPUT_POST,'texto',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $activo = (filter_input(INPUT_POST, 'publicar', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
                //Guardo en la base de datos
                $this->db->beginTransaction();
                $this->db->exec('UPDATE noticia SET titulo="'.$titulo.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticia SET entradilla="'.$entradilla.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticia SET autor="'.$autor.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticia SET activo="'.$activo.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticia SET texto="'.$texto.'" WHERE id='.$id.'');
                $this->db->commit();
                //Mensaje y redirección
                $mensaje[] = [
                            'tipo' => 'success',
                            'texto' => "La noticia <strong>$titulo</strong> se ha guardado correctamente.",
                            ];
                $_SESSION['mensajes'] = $mensaje;
                header("Location: ".$_SESSION['home']."panel/noticias");
            }
            else{
                $resultado = $this->db->query("SELECT * FROM noticia WHERE id=".$id." LIMIT 1");
                $noticia = $resultado->fetch(\PDO::FETCH_OBJ);
                if ($noticia){
                    //Le paso los datos a la vista
                    $this->view->vista('noticia',$noticia);
                }
                else{
                    $mensaje[] = [
                                'tipo' => 'danger',
                                'texto' => "Ha ocurrido un error al editar la noticia.",
                                ]; 
                    $_SESSION['mensajes'] = $mensaje;
                    //Le redirijo al panel de noticia
                    header("Location: ".$_SESSION['home']."panel/noticias");
                }
            }
        }
        else{
            $mensaje[] = [
                            'tipo' => 'danger',
                            'texto' => "La noticia no existe.",
                            ];
            $_SESSION['mensajes'] = $mensaje;
            //Le redirijo al panel de noticias
            header("Location: ".$_SESSION['home']."panel/noticias");
        }
    }
}