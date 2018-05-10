<div class="container" id="creationFiche">
	TO DO :<br/>
	- Gestion des fichiers video et musique à l'import et export format epub
	<br/>-Modification : récupération des noms des fichiers video, musique et images et suppression si l'utilisateur en change
	<br/>- Modification : récupération de l'historique
	<br/> Informations quand ça marche pas
	<?php 
		$idFicheModifiee = isset($fiche) ? $fiche->ID:"";
		echo form_open_multipart('fiche/creation/'.$idFicheModifiee);
		if(isset($problemes)) echo $problemes;
	?>
		<h2><?php echo isset($fiche)?"Modifier":"Créer"; ?> une fiche</h2>
		<p><label for="template">Gabarit fiche</label>
		<select name="template" id="template">
			<option value="black">Black</option>
			<option value="black">Black</option>
			<option value="black">Black</option>
		</select></p>
		<p><label for="Nom">Nom de l'artiste ou du groupe</label>
		<input id="Nom" name="Nom" <?php if(isset($fiche)) echo 'value="'.$fiche->Nom.'"'; ?> required></p>
		<p><label for="Genre">Genre musical</label>
		<select name="Genre" id="Genre">
			<?php 
			
			foreach($genres as $genre){ ?>
				
				<option value="<?php echo $genre['ID']; ?>" <?php if(isset($fiche)) echo $fiche->genre===$genre['Nom'] ? "selected" : "";?>><?php echo $genre['Nom']; ?></option>
			<?php }?>
		</select></p>
		<p>
			<label for="nationnalite">Nationnalité</label>
			<input name="nationnalite" id="nationnalite" <?php if(isset($fiche)) echo 'value="'.$fiche->nationnalite.'"'; ?> required>
		<p>
			<label for="SousTitre">Sous-titre</label>
			<input name="SousTitre" id="SousTitre" <?php if(isset($fiche)) echo 'value="'.$fiche->SousTitre.'"'; ?>>
		</p>
		
		<p>
			<label for="Description">Description</label>
			<textarea name="Description" id="Description" required ><?php if(isset($fiche)) echo $fiche->Description; ?></textarea>
		</p>
		
		<p>
			<label for="Citation">Citation</label>
			<textarea id="Citation" name="Citation"><?php if(isset($fiche)) echo $fiche->Citation;?></textarea>
		</p>
		
		<div >
			<p>Historique </p>
			<table >
				<tr v-for="(dates, index) in histo">
					<td>{{ dates.annee }}</td>
					<td>{{ dates.description }}</td>
					<td><button type="button" @click="supprimer(index)" >Supprimer</button></td>
					<input type="hidden" name="dateHisto[]" v-bind:value="dates.date"/>
					<input type="hidden" name="descriptionHisto[]" v-bind:value="dates.description" />
				</tr>
			</table>
			<p>
				<label> Date : </label>
				<input  v-model="dateHisto" id="dateHistorique"/>
				<label> Description : </label>
				<input v-model="descriptionHisto" id="DescriptionHistorique"/>
			</p>
			
			<p><button type="button" @click="ajouter()">Ajouter historique</button></p>
		</div>
		<p>Fichiers :</p>
		<label>Photo portrait</label>
		<input type="file" name="Portrait" />
		<label>Photo couverture</label>
		<input type="file" name="Couverture"/>
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
		<input type="submit" value="Créer la fiche" onclick="stockage()"/> 
		
	</form>
</div>

<script>
	var date=document.getElementById("dateHistorique"); 
	var dateDescription=document.getElementById("descriptionHistorique"); 
	var idsText={
		"input":["Nom","nationnalite","SousTitre","Description","Citation"],
		"select":["template", "Genre"]
	};
	
	var vue=new Vue({
          el: '#creationFiche',
          data: {
			dateHisto:"",
			descriptionHisto:"",
			histo:[]
          },
		  methods:{
			  supprimer:function(index){
				  this.histo.splice(index,1);
			  },
			  ajouter:function(){
				  this.histo.push({annee:this.dateHisto, description:this.descriptionHisto});
			  }
			  
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

	
	
</script>
