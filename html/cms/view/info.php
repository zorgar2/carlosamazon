<div class=" ">
    <div class="editar">
        <h2>Editar noticia</h2>
        <form method="POST" enctype="multipart/form-data">
            <span>Titulo</span><br>
            <h2 <?php echo $datos->titulo;?>></h2><br><br>
            <span>Entradilla</span><br>
            <h4<?php echo $datos->entradilla;?>></h4><br>
            <span>Texto</span><br>
            <h4<?php echo $datos->texto;?>></h4><br>
            <span>Autor</span><br>
            <h4<?php echo $datos->autor;?>></h4><br>            
            <?php $publicar = ($datos->activo == 1) ? 'checked' : '' ?>
            <input type="checkbox" name="publicar">Publicar<br>
            <input type="file" name="imagen"><br>
            <a type="button" href="<?php echo $_SESSION['home'] ?>panel/noticias">Volver</a>
            <input type="submit" value="Guardar" name="guardar">
        </form>
    </div>
</div>