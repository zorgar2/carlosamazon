<ul class="menu">
    <a href="<?php echo $_SESSION['home'] ?>panel"><li>inicio</li></a>
    <a href="<?php echo $_SESSION['home'] ?>panel/noticias"><li>noticias</li></a>
    <?php if ($_SESSION['usuarios']){?>
    <a href="<?php echo $_SESSION['home'] ?>panel/usuarios"><li>usuarios</li></a>
    <?php } ?>
    <a href="<?php echo $_SESSION['home'] ?>panel/salir"><li>salir</li></a>
</ul>
