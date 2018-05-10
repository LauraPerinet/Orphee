<div class="container">
	<?php if(empty($export)){?>
		<p>Votre ouvrage a bien été exporté en epub.</p>
	<?php }else{?>
		<p>Votre ouvrage a été exporté en epub, mais il y a eu quelques problèmes :</p>
		<p><?php echo $export; ?></p>
	<?php }?></p>
</div>