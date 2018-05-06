<div class="container" id="creationFiche">
	<?php
	$action= isset($book) ? "modification/".$book->ID : "creation";
	echo form_open_multipart("ouvrage/".$action); ?>
	<h2>Nouvel ouvrage</h2>
	<p><label>Titre : </label>
		<input name="title" required value="<?php if(isset($book)) echo $book->Nom;?>"/>
	</p>
	<p><label>Auteur : </label>
		<input name="author" required value="<?php echo isset($book) ? $book->Auteur : $this->session->user->Nom; ?>"/>
	</p>
	<p><label>Image de couverture : </label>
		<input type="file" name="imagecouverture" />
	</p>
	<p><input type="submit" value="<?php echo isset($book) ? "Modifier":"Créer";?> l'ouvrage" /></p>
</div>