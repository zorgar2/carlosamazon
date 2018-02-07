<?php
namespace App\Model;

class Usuario {
    
    //Variables o atributos
    var $id;
    var $usuario;
    var $clave;
    var $fecha_acceso;
    var $activo;
    var $usuarios;

    function __construct($data){
        
        $this->id = $data->id;
        $this->usuario = $data->usuario;
        $this->clave = $data->clave;
        $this->fecha_acceso = $data->fecha_acceso;
        $this->activo = $data->activo;
        $this->usuarios = $data->usuarios;
        
    }

}
