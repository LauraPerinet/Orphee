<div class="container">
	<?php if(!empty($problemes)){ ?>
		<p>La fiche n'a pas pu être créée</p>
		<p><?php echo $problemes; ?></p>
		<p><a href="">Retour à la création de fiche</a></p>
	<?php }else{ ?>
		<p>La fiche a bien été créée</p>
		<p><a href="">Voir toutes les fiches</a></p>
	<?php } ?>
	
</div>