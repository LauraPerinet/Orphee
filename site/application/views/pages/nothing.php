<div class="container">
Il n'y a pas de <?php echo $type; ?> à montrer !
<div class="btnNew">
	<a href="<?php echo site_url($type.'/creation'); ?>">Créer <?php echo $type=="fiche" ? "une nouvelle fiche":"un nouvel ouvrage";?></a>
</div>
</div>