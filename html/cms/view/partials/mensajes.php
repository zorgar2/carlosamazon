<?php 
    if(isset($_SESSION['mensajes']) AND count($_SESSION['mensajes'] > 0)){
        foreach ($_SESSION['MENSAJES'] AS $MENSAJE){
            echo '<div class ="alert alert-'.$mensaje['tipo'].'">
                    '.$mensaje['texto'].'
                    </div>';
        } 
    }
    $_SESSION['mensajes'] = [];