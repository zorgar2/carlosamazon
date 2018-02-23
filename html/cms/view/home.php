<div class="infom">
<ul class="men">
    <img class="gundam" src = "../public/img/icini.png"/>
      <li class="letra"><a href="/cms/public/index.php">Home</a></li>
      <li class="letra"><a href="">Sobre nosotros</a></li>
</ul>
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