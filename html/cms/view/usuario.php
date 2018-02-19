<div class="container">
    <div class="editar">
        <h2>Editar usuario</h2>
        <form method="POST">
            <span>Usuario</span><br>
            <input type="text" name="usuario" value="<?php echo $datos->usuario;?>"><br><br>
            <span>Clave</span><br>
            <input type="checkbox" name="cambiar_clave">
            (Marcar para cambiar la clave)<br>
            <input type="pasword" name="clave"><br><br>
            <span>Permisos</span><br>
            <?php $usuarios = ($datos->usuarios == 1) ? 'checked' : '' ?>
            <?php $noticias = ($datos->noticias == 1) ? 'checked' : '' ?>
            <input type="checkbox" name="noticias">Noticias<br>
            <input type="checkbox" name="usuarios">Usuarios<br>
            <a type="button" href="<?php echo $_SESSION['home'] ?>panel/usuarios">Volver</a>
            <input type="submit" value="Guardar" name="guardar">
        </form>
    </div>
</div>