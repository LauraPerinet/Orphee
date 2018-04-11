<div class="container" id="creationFiche">
	<?php echo form_open_multipart('fiche/creation');?>
		<p><label>Nom de l'artiste ou du groupe</label>
		<input name="Nom"></p>
		<p><label>Genre musical</label>
		<select name="Genre">
			<?php 
			foreach($genres as $genre){ ?>
			
				<option value="<?php echo $genre['ID']; ?>"><?php echo $genre['Nom']; ?></option>
			<?php }?>
		</select></p>
		
		<p><label>Sous-titre</label>
		<input name="SousTitre"></p>
		
		<p><label>Description</label>
		<textarea name="Description"></textarea></p>
		
		<p><label>Citation</label>
		<textarea name="Citation"></textarea></p>
		
		<div >
			<p>Historique </p>
			<table >
				<tr v-for="(dates, index) in histo">
					<td>{{ dates.date }}</td>
					<td>{{ dates.description }}</td>
					<td><button type="button" @click="supprimer(index)" >Supprimer</button></td>
					<input type="hidden" name="dateHisto[]" v-bind:value="dates.date"/>
					<input type="hidden" name="descriptionHisto[]" v-bind:value="dates.description" />
				</tr>
			</table>
			<p>
				<label> Date : </label>
				<input type="date" v-model="dateHisto" id="dateHistorique"/>
				<label> Description : </label>
				<input v-model="descriptionHisto" id="DescriptionHistorique"/>
			</p>
			
			<p><button type="button" @click="ajouter()">Ajouter historique</button></p>
		</div>
		<p>Fichiers :</p>
		<label>Photo portrait</label>
		<input type="file" name="Portrait"/>
		<label>Photo couverture</label>
		<input type="file" name="Couverture"/>
		<p>Musique :</p>
		<label>Nom du morceau :</label>
		<input name="nomMusique"/>
		<input type="file" name="Musique" />
		<label>Video :</label>
		<input type="file" name="Video" />
		<input type="submit" value="Créer la fiche" />
		
	</form>
</div>
<script>
	var date=document.getElementById("dateHistorique"); 
	var dateDescription=document.getElementById("descriptionHistorique"); 
	new Vue({
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
				  this.histo.push({date:this.dateHisto, description:this.descriptionHisto});
			  }
			  
		  }
	});
</script>
