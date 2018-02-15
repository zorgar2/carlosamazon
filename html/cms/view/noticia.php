<div class=" ">
    <div class="editar">
        <h2>Editar noticia</h2>
        <form method="POST">
            <span>Titulo</span><br>
            <input type="text" name="titulo" value="<?php echo $datos->titulo;?>"><br><br>
            <span>Entradilla</span><br>
            <input type="text" name="entradilla" value="<?php echo $datos->entradilla;?>"><br><br>
            <span>Texto</span><br>
            <input type="text" name="texto" value="<?php echo $datos->texto;?>"><br><br>
            <span>Autor</span><br>
            <input type="text" name="autor" value="<?php echo $datos->autor;?>"><br><br>            
            <?php $publicar = ($datos->activo == 1) ? 'checked' : '' ?>
            <input type="checkbox" name="publicar">Publicar<br>
            <a type="button" href="<?php echo $_SESSION['home'] ?>panel/noticias">Volver</a>
            <input type="submit" name="Guardar">
        </form>
    </div>
</div>