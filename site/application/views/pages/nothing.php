<div class="container">
<p>Il n'y a pas de <?php echo $type; ?> à montrer !</p>

	<a href="<?php echo site_url($type.'/creation'); ?>"><button class="orphee-btn">Créer <?php echo $type=="fiche" ? "une nouvelle fiche":"un nouvel ouvrage";?></button></a>

</div>