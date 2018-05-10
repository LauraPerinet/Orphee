<div class="container" id="fiche">
	TO DO :<br/>
	- Mettre image + morceau pour musique. 
	<br/>-Modification : récupération des noms des fichiers video, musique et images et suppression si l'utilisateur en change
	<br/>- Modification : récupération de l'historique
	<br/> Informations quand ça marche pas
	
	<div class="row">
            <div class="col-12"><h1><?php echo isset($fiche)?"Modifier":"Créer"; ?> une fiche</h1></div>
    </div>
	<div class="row fiche_form_apercu">
		<div class="col-12 col-md-6">
			<div class="bloc_form_fiche">
				<?php 
					$idFicheModifiee = isset($fiche) ? $fiche->ID:"";
					echo form_open_multipart('fiche/creation/'.$idFicheModifiee, array('id'=>"form_fiche"));
					if(isset($problemes)) echo $problemes;
				?>
					<div class="form-group col-12">
						<label for="template">Gabarit fiche</label>
						<select name="template" class="form-control" id="artiste_template" v-model="artiste_template" maxlength="20" required>
							<option value="black">Black</option>
							<option value="black">Black</option>
							<option value="black">Black</option>
						</select>
					</div>
                    <div class="form-group col-12">
                        <label for="Nom">Nom de l'artiste ou du groupe</label>
						<input id="Nom" name="Nom" <?php if(isset($fiche)) echo 'value="'.$fiche->Nom.'"'; ?> class="form-control" id="artiste_nom" v-model="artiste_nom" maxlength="30"required>					
					</div>
                    <div class="form-group col-12">
                            <label for="Genre">Genre musical</label>
							<select name="Genre" class="form-control" id="artiste_genre" v-model="artiste_genre" maxlength="20" >
								<?php 
								
								foreach($genres as $genre){ ?>
									
									<option value="<?php echo $genre['ID']; ?>" <?php if(isset($fiche)) echo $fiche->genre===$genre['Nom'] ? "selected" : "";?>><?php echo $genre['Nom']; ?></option>
								<?php }?>
							</select>
					</div>
                    <div class="form-group col-12">
						<label for="nationnalite">Nationnalité</label>
						<input name="nationnalite" id="nationnalite" <?php if(isset($fiche)) echo 'value="'.$fiche->nationnalite.'"'; ?> class="form-control" v-model="nationnalite" maxlength="42" required>
					</div>
                    <div class="form-group col-12">
						<label for="SousTitre">Sous-titre</label>
						<input name="SousTitre" <?php if(isset($fiche)) echo 'value="'.$fiche->SousTitre.'"'; ?> class="form-control" id="artiste_soustitre" v-model="artiste_soustitre" maxlength="40" >
					</div>
                    <div class="form-group col-12">
						<label for="Description">Description</label>
						<textarea name="Description" class="form-control" id="artiste_description" rows="3" v-model="artiste_description" maxlength="650" required ><?php if(isset($fiche)) echo $fiche->Description; ?></textarea>
					</div>
                    <div class="form-group col-12">
						<label for="Citation">Citation</label>
						<textarea name="Citation" class="form-control" id="artiste_citation" rows="1" v-model="artiste_citation" maxlength="100" ><?php if(isset($fiche)) echo $fiche->Citation;?></textarea>
					</div>
					 <h2 class="col-12">Discographie</h2>
                        <div class="form-group col-12">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="artiste_discographie_date">Date*</label>
                                    <input type="date" class="form-control" id="artiste_discographie_date" v-model="dateHisto" id="dateHistorique" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="artiste_discographie_nom">Nom de l'album*</label>
                                    <input type="text" class="form-control" id="artiste_discographie_nom" v-model="descriptionHisto" id="DescriptionHistorique" required>
                                    
                                </div> 
                                <div class="col-12 col-sm-2">
                                    <label for="artiste_discographie_nom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <button type="button" class="btn btn-primary" @click="ajouter()" >+</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <div class="row" v-for="(dates, index) in histo">
                                <div class="col-12 col-sm-4">
                                    <input type="date" class="form-control" id="artiste_discographie_date" v-bind:value="dates.date" name="dateHisto[]">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control" id="artiste_discographie_nom" v-bind:value="dates.description" name="descriptionHisto[]">       
                                </div> 
                                <div class="col-12 col-sm-2">
                                    <button type="button" class="btn btn-danger" @click="supprimer(index)">-</button>
                                </div>
                            </div>
                        </div>
					<h2 class="col-12">Multimédia</h2>
					
					<div class="row col-12">
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="artiste_portrait">Photo portrait*</label>
                                <input type="file" class="form-control-file" id="artiste_portrait" @change="previewImage($event,'artiste_portrait')" accept="image/*" required name="Portrait">
                            </div>
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="artiste_couverture">Image de couverture</label>
                                <input type="file" class="form-control-file" id="artiste_couverture" @change="previewImage($event,'artiste_couverture')" accept="image/*" name="Couverture">
                            </div>
                    </div>
					<p>Musique :</p>
					<table>
						<tr>
							<td></td>
							<th><label >Nom du morceau :</label></th>
							<th><label >Image du morceau :</label></th>
							<th><label >Fichier mp3 du morceau :</label></th>
						</tr>
						<tr>
							<th>Morceau 1</th>
							<td><input name="nomMusique0" id="nomMusique0"/></td>
							<td><input type="file" name="imgMusique0" id="imgMusique0"/></td>
							<td><input type="file" name="mp3Musique0" id="mp3Musique0"/></td>
						</tr>
						<tr>
						<th>Morceau 2</th>
							<td><input name="nomMusique1" id="nomMusique1"/></td>
							<td><input type="file" name="imgMusique1" id="imgMusique1"/></td>
							<td><input type="file" name="mp3Musique1" id="mp3Musique1"/></td>
						</tr>
						<tr>
							<th>Morceau 3</th>
							<td><input name="nomMusique2" id="nomMusique2"/></td>
							<td><input type="file" name="imgMusique2" id="imgMusique2"/></td>
							<td><input type="file" name="mp3Musique2" id="mp3Musique2"/></td>
						</tr>
					</table>
				
					<label>Video :</label>
					<input type="file" name="Video" />
					
		
				</form>
			</div>
		</div>
		 <div class="col-xs-12 col-md-6">
			<div class="apercu_page">
				<div class="apercu_page_content" v-bind:class="changeTemplate">
					<div class="preview_artiste_couverture" v-if="artiste_couverture.length > 0" :style="{ backgroundImage: 'url(' + artiste_couverture + ')' }"></div>
					<div class="preview_artiste_portrait" v-if="artiste_portrait.length > 0" :style="{ backgroundImage: 'url(' + artiste_portrait + ')' }"></div>
					<span class="preview_artiste_nom" v-text="artiste_nom"></span>
					<span class="preview_artiste_soustitre" v-text="artiste_soustitre"></span>
					<span v-text="artiste_genre"></span>                           
					<span v-text="artiste_description"></span>
					<span v-text="artiste_citation"></span>
					<span v-text="artiste_nationalite"></span>                            
				</div>
			</div>
		</div>
	
	</div>
	<div class="col-xs-12 centrer">
		<button type="submit" class="btn btn-primary col-xs-12 btn_creer_fiche" v-on:click="valider_form">Créer la fiche</button>    
	</div>
</div>
<?php
	if(isset($fiche)){
		echo "<table>";
		foreach($fiche as $key=>$value){
			echo "<tr>
				<td>".$key."</td>
				<td>";
			if(getType($value)=="array"){
				echo "164 Array";
			}else{
				echo $value;
			}
			echo "</td>
			</tr>";
		}
		echo "</table>";
	}

?>
<script>
	var date=document.getElementById("dateHistorique"); 
	var dateDescription=document.getElementById("descriptionHistorique"); 
	var idsText={
		"input":["artiste_nom","artiste_nationalite","artiste_soustitre","artiste_description","artiste_citation"],
		"select":["artiste_template", "artiste_genre"]
	};
        new Vue({
            el: '#fiche',
            data: {
                artiste_nom:"",
                artiste_genre:"",
                artiste_soustitre:"",
                artiste_nationalite:"",
                artiste_description:"",
                artiste_citation:"",
                artiste_portrait: "https://vignette.wikia.nocookie.net/outlast-roblox/images/5/5d/Unknown-person.jpg/revision/latest?cb=20160503161502",
                artiste_couverture: "https://www.planwallpaper.com/static/images/6909249-black-hd-background.jpg",
                artiste_template:"template_test",
                dateHisto:"",
                descriptionHisto:"",
                histo:[]
            },
            computed: {
                changeTemplate: function () {
                    return this.artiste_template;
                }
            },
            methods:{
                supprimer:function(index){
                    this.histo.splice(index,1);
                },
                ajouter:function(){
                    if(this.dateHisto && this.descriptionHisto) {
                        this.histo.push({date:this.dateHisto, description:this.descriptionHisto});
                    }
                },
                previewImage: function(event,img) {
                    var input = event.target;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = (e) => {
                            if(img == "artiste_portrait") this.artiste_portrait = e.target.result;
                            else if(img == "artiste_couverture") this.artiste_couverture = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                },
                valider_form: function() {
                    document.getElementById("form_fiche").submit(); 
                },
            }
        });
	
	function stockage(){
		var tags={
			"input":document.querySelectorAll("input, textarea"),
			"select":document.getElementsByTagName("select")
		};
		for(var i=0; i<tags.input.length; i++){
			if(tags.input[i].getAttribute("name")!=null){
				sessionStorage.setItem(tags.input[i].getAttribute("name"), tags.input[i].value);
				
			}
		}
	}
	
	for(var i=0; i<idsText.input.length; i++){
		if(sessionStorage.getItem(idsText.input[i])!=null) document.getElementById(idsText.input[i]).value=sessionStorage.getItem(idsText.input[i]);
	}
	console.log(sessionStorage);

	
	
</script>
