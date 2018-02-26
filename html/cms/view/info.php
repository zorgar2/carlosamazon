<?php
//Llamo al menu
require("../view/partials/menu2.php");
?>
<div class=" ">
    <div class="editar1">
         <?php foreach ($datos as $dato){?>
        <h2><?php echo $dato->titulo?></h2><br>
            <img src="/cms/public/img/<?php echo $dato->imagenes ?>"><br>
            <h2>Generos: <?php echo $dato->entradilla?></h2><br>
            <h2><?php echo $dato->texto?></h2><br>
            <h2>Autor: <?php echo $dato->autor?></h2><br>
            <h2>Para leerlo haz click en el enlace </h2>
            <a href="http://m.fanfox.net/manga/douluo_dalu_ii_jueshi_tangmen">http://m.fanfox.net/manga/douluo_dalu_ii_jueshi_tangmen</a>
            
         <?php }?>
    </div>
</div>