<div class="container" id="">

	<?php  echo form_open_multipart("ouvrage/completerOuvrage/".$book->ID); ?>
	<h2>Choississez les fiches de l'ouvrage</h2>
	<div class="allSheets">
	<?php 
		$i=0;
		if(count($sheets)==0){ ?>
			<p>Toutes les fiches sont dans l'ouvrage !</p>
			<div>
		<?php }
		foreach($sheets as $sheet){
			if($i==0){ ?>
				<div class="bloc">
			<?php }
			?>
			
			<div class="sheet">
				
				<div class="thumb">
					<img src="<?php echo base_url().'img/'.$sheet['Portrait'];?>" alt="Couverture de <?php echo $sheet['Nom']; ?>" />
				</div>
				<div class="action">
					<a href="<?php echo site_url('ouvrage/addSheet/'.$book->ID.'/'.$sheet['ID'].'/'.count($book->fiches)); ?>" /><div class="addSheet"></div></a>
				</div>
				<h3><?php echo $sheet['Nom']; ?></h3>
				
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
	</div>
	<div class="book">
		<div class="bloc">
		<div class="sheet">
			<div class="thumb">
					<img src="<?php echo base_url().'img/'.$book->imagecouverture;?>" alt="Couverture de <?php echo $book->Nom; ?>" />
				</div>
				<h3>Couverture</h3>
				<div class="action">
					<a href="<?php echo site_url('ouvrage/modification/'.$book->ID); ?>" /><div class="modification"></div></a>
				</div>
		</div>
		<div class="sheet">
			<div class="thumb">
					<img src="" alt="Sommaire" />
				</div>
				<h3>Sommaire</h3>
		</div>
		<?php 
		$i=1;
		foreach($book->fiches as $fiche){
			if($i==0){ ?>
				<div class="bloc">
			<?php }
			?>
			
			<div class="sheet">
				
				<div class="thumb">
					<img src="<?php echo base_url().'img/'.$fiche->Portrait;?>" alt="Couverture de <?php echo $fiche->Nom; ?>" />
				</div>
				<div class="action">
					<a href="<?php echo site_url('ouvrage/deleteSheet/'.$book->ID.'/'.$fiche->ID); ?>" /><div class="delete"></div></a>
				</div>
				<h3><?php echo $fiche->Nom; ?></h3>
				
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
	</div>
	</form>
