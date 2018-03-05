<div class="container">
    <?php require("partials/menu.php") ?>
    <?php require("partials/mensajes.php") ?>
    <div class="content_section listado">
        <h2>Noticias</h2>
       
        <ul class="row titulo">
            <li class="col-9">NOTICIA</li>
            <li class="col-3 derecha">ACCIONES</li>
        </ul>    
        <?php foreach ($datos as $dato){ ?>
            <ul class="row item">
                <li class="col-9">
                    <a href="">
                        <?php echo $dato->titulo ?>
                    </a>    
                </li>
                <li class="col-3 derecha">
                    <?php $ruta = $_SESSION['home']."panel/noticias/editar/".$dato->id ?>
                    <a href="<?php echo $ruta ?>"><i class="fas fa-edit"></i></a>
                    <?php $color = ($dato->activo==1) ? 'activo' : 'inactivo';?>
                    <?php $texto = ($dato->activo==1) ? 'desactivar' : 'activar';?>
                    <?php $ruta = $_SESSION['home']."panel/noticias/".$texto."/".$dato->id ?>
                    <a href="<?php echo $ruta ?>" class="<?php echo $color ?>"title="<?php echo $texto?>">
                        <span class="far fa-check-square"></span></a>
                    <?php $color1 = ($dato->home==1) ? 'activo' : 'inactivo';?>
                    <?php $texto1 = ($dato->home==1) ? 'desactivar1' : 'activar1';?>
                    <?php $ruta = $_SESSION['home']."panel/noticias/".$texto1."/".$dato->id ?>
                    <?php $ruta = $_SESSION['home']."panel/noticias/borrar/".$dato->id ?>    
                    <a href="<?php echo $ruta ?>"><i class="fas fa-trash"></i></a>
                </li>
            </ul>    
        <?php } ?>
         <a href="<?php echo $_SESSION['home'] ?>panel/noticias/crear">Nueva Noticia</a>
    </div>  
</div>