<div class="container" id="">
	TO DO :<br/>
	- Quand on supprime une page du bouquin, réordonner les num de pages dans la base de donnée. ça fait bugguer les fleches sinon.
	<br/>- JS : drag and drop joli et tout
	<br/>- lancement script python et suppression du dossier généré après.
	<br/>- téléchargement automatique de l'epub
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
				<div class="action move">
					<?php if($fiche->Page>0){?>
						<a href="<?php echo site_url('ouvrage/moveSheet/'.$book->ID.'/'.$fiche->ID).'/left'; ?>" /><div class="moveLeft"></div></a>
					<?php } 
					if($fiche->Page<count($book->fiches)-1){ ?>
						<a href="<?php echo site_url('ouvrage/moveSheet/'.$book->ID.'/'.$fiche->ID).'/right'; ?>" /><div class="moveRight"></div></a>
					<?php }?>
				</div>
				<h3><?php echo $fiche->Page.' • '.$fiche->Nom; ?></h3>
				
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
