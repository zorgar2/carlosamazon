<div class="container">
    <div class="row justify-content-center">
        <div class="col-5 caja_acceso">
            <h4>Bienvenido al panel de administración</h4>
            <span><?php echo $datos->mensaje ?></span><br><br>
            <form method="POST" action="">
                <input type="text" name="usuario" placeholder="usuario" autocomplete="off" autofocus>
                <input type="password" name="clave" placeholder="clave" autocomplete="off">
                <input type="submit" name="acceder" value="ACCEDER">
            </form>
        </div>
    </div>
</div>