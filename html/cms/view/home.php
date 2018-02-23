<?php
//Llamo al menu
require("../view/partials/menu2.php");
?>
<div class="infom">

<div class="borde">
    <?php foreach ($datos as $dato){?>
    <div class="borde2" style="background-image:url('/cms/public/img/<?php echo $dato->imagenes ?>')">
         <a href="../public/index.php/mostrar/<?php echo $dato->id?> ">
             <div class="tit2">   
                <h2 class="tit"  ><?php echo $dato->titulo ?></h2>
             </div>
    </a>
    </div>
   
    <?php }?>
</div>
</div>