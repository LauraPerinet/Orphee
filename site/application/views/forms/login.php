
<?php echo validation_errors(); ?>
<?php echo form_open('login/view'); 

?>

<h5>Email</h5>
<input type="text" name="email" value="" size="50" />
<h5>Mot de passe</h5>
<input type="text" value="" name="MotDePasse" size="50" />
<div><input type="submit" value="Signer" /></div>


</form>
