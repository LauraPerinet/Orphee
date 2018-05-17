<div class="container" id="creationFiche">
    <div class="row">
        <div class="col-12">
            <h2>Nouvel ouvrage</h2>
        </div>
    </div>
    <div class="row">
        <?php
        $action= isset($book) ? "modification/".$book->ID : "creation";
        echo form_open_multipart("ouvrage/".$action); ?>
        <div class="col-12">
            <div class="form-group col-12">
                <label>Titre</label>
                <input class="orphee-input" name="title" required value="<?php if(isset($book)) echo $book->Nom;?>"/>
            </div>
            <div class="form-group col-12">
                <label>Auteur : </label>
                <input class="orphee-input" name="author" required value="<?php echo isset($book) ? $book->Auteur : $this->session->user->Nom; ?>"/>
            </div>
            <div class="form-group col-12">
                <label>Image de couverture : </label>
                <input type="file" name="imagecouverture" />
            </div>
            <div class="col-12">
                <input type="submit" value="<?php echo isset($book) ? "Modifier":"Créer";?> l'ouvrage" class="orphee-btn" />
            </div>
        </div>
    </div>
</div>