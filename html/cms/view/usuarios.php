<div class="container">
    <?php require("partials/menu.php") ?>
    <div class="content_section listado">
        <h2>usuarios</h2>
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
                    <a href="">editar</a>
                    <a href="">activar</a>
                    <a href="">borrar</a>
                </li>
            </ul>    
        <?php } ?>
    </div>  
</div>