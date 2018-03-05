<?php
//Llamo al menu
require("../view/partials/menu2.php");
?>
<div id="wrapper-container">
    <div class="container object">
	<div id="main-container-image">
            <section class="work">
            	<?php foreach ($datos as $dato){?>
	            	<div class="white">
                            <a href="../public/index.php/mostrar/<?php echo $dato->id?> ">
				<img src="/cms/public/img/<?php echo $dato->imagenes ?>" alt="" />
                            </a>
	                    <div id="wrapper-part-info">
	                    	<div id="part-info"><?php echo $dato->titulo ?></div>
                            </div>
	                </div>
	            <?php }?>
            </section>
        </div>
    </div>
</div>