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
						<select name="template" class="form-control" id="template" v-model="template" maxlength="20" required>
							<option value="black">Black</option>
							<option value="curve">Curve</option>
							<option value="black">Black</option>
						</select>
					</div>
                    <div class="form-group col-12">
                        <label for="Nom">Nom de l'artiste ou du groupe</label>
						<input id="Nom" name="Nom" <?php if(isset($fiche)) echo 'value="'.$fiche->Nom.'"'; ?> class="form-control" id="Nom" v-model="Nom" maxlength="30"required>					
					</div>
                    <div class="form-group col-12">
                            <label for="Genre">Genre musical</label>
							<select name="Genre" class="form-control" id="Genre" v-model="Genre" maxlength="20" required>
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
						<input name="SousTitre" <?php if(isset($fiche)) echo 'value="'.$fiche->SousTitre.'"'; ?> class="form-control" id="SousTitre" v-model="SousTitre" maxlength="40" >
					</div>
                    <div class="form-group col-12">
						<label for="Description">Description</label>
						<textarea name="Description" class="form-control" id="Description" rows="3" v-model="Description" maxlength="650" required ><?php if(isset($fiche)) echo $fiche->Description; ?></textarea>
					</div>
                    <div class="form-group col-12">
						<label for="Citation">Citation</label>
						<textarea name="Citation" class="form-control" id="Citation" rows="1" v-model="Citation" maxlength="100" ><?php if(isset($fiche)) echo $fiche->Citation;?></textarea>
					</div>
					 <h2 class="col-12">Discographie</h2>
                        <div class="form-group col-12">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="artiste_discographie_date">Date*</label>
                                    <input type="number" class="form-control" id="artiste_discographie_date" v-model="dateHisto" id="dateHistorique" required>
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
                                    <input type="number" class="form-control" id="artiste_discographie_date" v-bind:value="dates.date" name="dateHisto[]">
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
                                <label for="Portrait">Photo portrait*</label>
                                <input type="file" class="form-control-file" id="Portrait" @change="previewImage($event,'Portrait')" accept="image/*" required name="Portrait">
                            </div>
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="Couverture">Image de couverture</label>
                                <input type="file" class="form-control-file" id="Couverture" @change="previewImage($event,'Couverture')" accept="image/*" name="Couverture">
                            </div>
                    </div>
					<p>Musique :</p>
					<table>
						<tr>
							<td></td>
							<th><label >Nom du morceau :</label></th>
							<!--<th><label >Image du morceau :</label></th>-->
							<th><label >Fichier mp3 du morceau :</label></th>
						</tr>
						<tr>
							<th>Morceau 1</th>
							<td><input name="nomMusique0" id="nomMusique0"/></td>
							<!--<td><input type="file" name="imgMusique0" id="imgMusique0"/></td>-->
							<td><input type="file" name="mp3Musique0" id="mp3Musique0"/></td>
						</tr>
						<tr>
						<th>Morceau 2</th>
							<td><input name="nomMusique1" id="nomMusique1"/></td>
							<!--<td><input type="file" name="imgMusique1" id="imgMusique1"/></td>-->
							<td><input type="file" name="mp3Musique1" id="mp3Musique1"/></td>
						</tr>
						<tr>
							<th>Morceau 3</th>
							<td><input name="nomMusique2" id="nomMusique2"/></td>
							<!--<td><input type="file" name="imgMusique2" id="imgMusique2"/></td>-->
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
					<div class="preview_Couverture" v-if="Couverture.length > 0" :style="{ backgroundImage: 'url(' + Couverture + ')' }"></div>
					<div class="preview_Portrait" v-if="Portrait.length > 0" :style="{ backgroundImage: 'url(' + Portrait + ')' }"></div>
					<span class="preview_Nom" v-text="Nom"></span>
					<span class="preview_SousTitre" v-text="SousTitre"></span>
					<span v-text="Genre"></span>                           
					<span v-text="Description"></span>
					<span v-text="Citation"></span>
					<span v-text="nationnalite"></span>                            
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
		var_dump($fiche->Musiques);
		echo "<table id='phpData' class='hidden'>";
		foreach($fiche as $key=>$value){
			echo "<tr>
				<td id='key".$key."'>";
			if(getType($value)=="array"){
				echo "<table class='youhou'>";
				for($i=0; $i<count($value); $i++){
					echo '<tr>';
					foreach($value[$i] as $key2=>$value2){
						echo "<td id=key='".$key2."' class='".$key.$i."'>".$value2."</td>";
					}
					echo '</tr>';
				}
				echo "</table>";
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
		"input":["Nom","nationnalite","SousTitre","Description","Citation"],
		"select":["template", "Genre"]
	};
    var fiche=new Vue({
            el: '#fiche',
            data: {
                Nom:"",
                Genre:"",
                SousTitre:"",
                nationnalite:"",
                Description:"",
                Citation:"",
                Portrait: "https://vignette.wikia.nocookie.net/outlast-roblox/images/5/5d/Unknown-person.jpg/revision/latest?cb=20160503161502",
                Couverture: "https://www.planwallpaper.com/static/images/6909249-black-hd-background.jpg",
                template:"template_test",
                dateHisto:"",
                descriptionHisto:"",
                histo:[],
				Musiques:[]
            },
            computed: {
                changeTemplate: function () {
                    return this.template;
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
                            if(img == "Portrait") this.Portrait = e.target.result;
                            else if(img == "Couverture") this.Couverture = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                },
                valider_form: function() {
                    document.getElementById("form_fiche").submit(); 
                },
            }
        });
	if(document.getElementById("phpData")){
		fiche.Nom=document.getElementById("keyNom").textContent;
		fiche.Genre=document.getElementById("keygenre").textContent;
		fiche.SousTitre=document.getElementById("keySousTitre").textContent;
		fiche.nationnalite=document.getElementById("keynationnalite").textContent;
		fiche.Description=document.getElementById("keyDescription").textContent;
		fiche.Citation=document.getElementById("keyCitation").textContent;
		fiche.Portrait= document.getElementById("keyPortrait").textContent;
		fiche.Couverture= document.getElementById("keyCouverture").textContent;
		fiche.template=document.getElementById("keytemplate").textContent;
	}
	console.log(fiche.Portrait);
	
	
</script>
