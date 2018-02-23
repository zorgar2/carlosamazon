<?php
//Llamo al menu
require("../view/partials/menu2.php");
?>
<div class=" ">
    <div class="editar">
         <?php foreach ($datos as $dato){?>
            <h2><?php echo $dato->titulo?></h2>
            <img src="/cms/public/img/<?php echo $dato->imagenes ?>">
            <h2><?php echo $dato->entradilla?></h2>
            <h2><?php echo $dato->texto?></h2>
            <h2><?php echo $dato->autor?></h2>
            
         <?php }?>
    </div>
</div>