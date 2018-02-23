<div class="container">
    <?php require("partials/menu.php") ?>
    <?php require("partials/mensajes.php") ?>
    <div class="content_section listado">
        <h2>Usuarios</h2>
       
        <ul class="row titulo">
            <li class="col-9">USUARIO</li>
            <li class="col-3 derecha">ACCIONES</li>
        </ul>    
        <?php foreach ($datos as $dato){ ?>
            <ul class="row item">
                <li class="col-9">
                    <a href="">
                        <?php echo $dato->usuario ?>
                    </a>    
                </li>
                <li class="col-3 derecha">
                    <?php $ruta = $_SESSION['home']."panel/usuarios/editar/".$dato->id ?>
                    <a href="<?php echo $ruta ?>"><i class="fas fa-edit"></i></a>
                    <?php $color = ($dato->activo==1) ? 'activo' : 'inactivo';?>
                    <?php $texto = ($dato->activo==1) ? 'desactivar' : 'activar';?>
                    <?php $ruta = $_SESSION['home']."panel/usuarios/".$texto."/".$dato->id ?>
                    <a href="<?php echo $ruta ?>" class="<?php echo $color ?>"title="<?php echo $texto?>">
                        <span class="far fa-check-square"></span></a>
                    <?php $ruta = $_SESSION['home']."panel/usuarios/borrar/".$dato->id ?>    
                    <a href="<?php echo $ruta ?>"><i class="fas fa-trash"></i></a>
                </li>
            </ul>    
        <?php } ?>
         <a href="<?php echo $_SESSION['home'] ?>panel/usuarios/crear">Nuevo Usuario</a>
    </div>  
</div>