<h2><?php echo $subtitle;?></h2>
<table id="container">
	<tr>
		<th>Nom</th>
		<th>Contact</th>
		<th>Statut</th>
		<th>Formation(s)</th>
	</tr>
<?php foreach($students as $student){ ?>
	<tr>
		<td class="name"><?php echo $student->name." ".$student->firstname; ?></td>
		<td class="contact"><?php echo $student->email."<br/>".$student->phone; ?></td>
		<td class="status"><?php echo $student->id_status==1 ? "Candidat" : "Etudiant"; ?></td>
		<td class="formations"><?php foreach($student->formations as $formation){
			echo $formation->ypareo.'<br/>';
		} ?></td>
	</tr>
<?php }?>
</table>
<!--
<script src="<?php echo base_url(); ?>js/vue.js"></script>
<script>
var app=new Vue({
	el:'#container',
	data:{
		students:[]
	}
});

var tr=document.querySelector("#container tr");
for(var i=1; i<tr.length; i++){
	
}
</script> -->