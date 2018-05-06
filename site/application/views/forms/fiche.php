<div class="container" id="creationFiche">
	
	<?php 
		$idFicheModifiee = isset($fiche) ? $fiche->ID:"";
		echo form_open_multipart('fiche/creation/'.$idFicheModifiee);
		if(isset($problemes)) echo $problemes;
	?>
		<h2><?php echo isset($fiche)?"Modifier":"Créer"; ?> une fiche</h2>
		<p><label>Gabarit fiche</label>
		<select name="template">
			<option value="black">Black</option>
			<option value="black">Black</option>
			<option value="black">Black</option>
		</select></p>
		<p><label>Nom de l'artiste ou du groupe</label>
		<input name="Nom" <?php if(isset($fiche)) echo 'value="'.$fiche->Nom.'"'; ?>></p>
		<p><label>Genre musical</label>
		<select name="Genre">
			<?php 
			
			foreach($genres as $genre){ ?>
				
				<option value="<?php echo $genre['ID']; ?>" <?php if(isset($fiche)) echo $fiche->genre===$genre['Nom'] ? "selected" : "";?>><?php echo $genre['Nom']; ?></option>
			<?php }?>
		</select></p>
		<p>Nationnalité
		<input name="nationnalite" <?php if(isset($fiche)) echo 'value="'.$fiche->nationnalite.'"'; ?>>
		<p><label>Sous-titre</label>
		<input name="SousTitre" <?php if(isset($fiche)) echo 'value="'.$fiche->SousTitre.'"'; ?>></p>
		
		<p><label>Description</label>
		<textarea name="Description" ><?php if(isset($fiche)) echo $fiche->Description; ?></textarea></p>
		
		<p><label>Citation</label>
		<textarea name="Citation"><?php if(isset($fiche)) echo $fiche->Citation;?></textarea></p>
		
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
		<!--
		<p>Musique :</p>
		<label>Nom du morceau :</label>
		<input name="nomMusique" />
		<input type="file" name="Musique" />
		<label>Video :</label>
		<input type="file" name="Video" />-->
		<input type="submit" value="Créer la fiche" /> 
		
	</form>
</div>

<script>
	var date=document.getElementById("dateHistorique"); 
	var dateDescription=document.getElementById("descriptionHistorique"); 
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
	

	
	
</script>
