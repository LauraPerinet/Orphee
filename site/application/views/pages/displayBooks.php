<div class="container">
	<?php 
	$i=0;
	foreach($books as $book){
		if($i==0){ ?>
			<div class="bloc">
		<?php }
		?>
		
		<div class="sheet">
			
			<div class="thumb">
				<img src="<?php echo base_url().'uploads/'.$book->imagecouverture;?>" alt="Couverture de <?php echo $book->Nom; ?>" />
			</div>
			<div class="action">
				<a href="<?php echo site_url('ouvrage/completerOuvrage/'.$book->ID); ?>" /><div class="modification"></div></a>
				<a href="<?php echo site_url('ouvrage/suppression/'.$book->ID); ?>" /><div class="delete"></div></a>
			</div>
			<h3><?php echo $book->Nom; ?></h3>
			
		</div>
	<?php
		if($i==4){ ?>
			</div>
		<?php	$i=0;
		}else{
			$i++;
		}
	}?>
	</div>
	<div class="btnNew">
		<a href="<?php echo site_url('ouvrage/creation'); ?>">Créer un nouvel ouvrage</a>
	</div>
</div>