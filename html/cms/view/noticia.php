<div class=" ">
    <div class="editar">
        <h2>Editar noticia</h2>
        <form method="POST" enctype="multipart/form-data">
            <span>Titulo</span><br>
            <input type="text" name="titulo" value="<?php echo $datos->titulo;?>"><br><br>
            <span>Entradilla</span><br>
            <input type="text" name="entradilla" value="<?php echo $datos->entradilla;?>"><br><br>
            <span>Texto</span><br>
            <input class="tam" type="textarea" name="texto" value="<?php echo $datos->texto;?>"><br><br>
            <span>Autor</span><br>
            <input type="text" name="autor" value="<?php echo $datos->autor;?>"><br><br>            
            <?php $publicar = ($datos->activo == 1) ? 'checked' : '' ?>
            <input type="checkbox" name="publicar">Publicar<br>
            <input class="btn" type="file" name="imagen"><br>
            <a class="btn" type="button" href="<?php echo $_SESSION['home'] ?>panel/noticias">Volver</a>
            <input class="btn" type="submit" value="Guardar" name="guardar">
        </form>
    </div>
</div>