<!-- Page Content -->
<div class="hero-banner">
    <div id="background-home" aria-hidden="true">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<div class="home-screen">
<div class="container">
    <div class="row">
        <div class="col-sm-4 my-4">
            <div class="orphee-card">
                <img class="card-img-top" src="http://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h4 class="card-title">Créez</h4>
                    <p class="card-text">Créez vos fiches descriptives artistes.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 my-4">
            <div class="orphee-card">
                <img class="card-img-top" src="http://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h4 class="card-title">Assemblez</h4>
                    <p class="card-text">Assemblez vos fiches dans un ouvrage préalablement mis en page.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 my-4">
            <div class="orphee-card">
                <img class="card-img-top" src="http://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h4 class="card-title">Imprimez / Téléchargez</h4>
                    <p class="card-text">Imprimez / téléchargez votre ouvrage.</p>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->

    <div class="black-bg-opacity hide" v-on:click="closePopUp()"></div>
    <div class="container popup-log hide orphee-bloc">
        <div class="row title-form">
            <div class="col-md-12"><h2>Connectez-vous</h2></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors(); ?>
                <?php echo form_open('login/view'); ?>
                    <div class="form-group">
                        <label for="co_email">E-mail</label>
                        <input type="email" name="email" class="form-control orphee-input" id="co_email" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="co_mdp">Mot de passe</label>
                        <input type="password" name="MotDePasse" class="form-control orphee-input" id="co_mdp" placeholder="">
                    </div>
                    <button type="submit" class="btn orphee-btn">Se connecter</button>
                    <p >Vous n'avez pas encore de compte ? <a href="#" v-on:click="openPopUp('popup-sub')" class="orphee-link">Créez un compte en cliquant ici</a></p>
                </form>
            </div>
        </div>
    </div>
    <div class="container popup-sub hide orphee-bloc">
        <div class="row title-form">
            <div class="col-md-12"><h2>Créer votre compte</h2></div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <?php echo form_open("login/creation"); ?>
                    <div class="form-group">
						<?php if(isset($error)){?>
							<p id="error"><?php echo $error; ?></p>
						<?php } ?>
                        <label for="insc_name">Nom</label>
                        <input type="text" class="form-control orphee-input" id="insc_name" aria-describedby="emailHelp" placeholder="" name="Nom" required>
                    </div>
                    <div class="form-group">
                        <label for="insc_email">E-mail</label>
                        <input type="email" class="form-control orphee-input" id="insc_email" aria-describedby="emailHelp" placeholder="" name="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="insc_mdp_1">Mot de passe</label>
                        <input type="password" class="form-control orphee-input" id="insc_mdp_1" placeholder="" name="mdp"  required>
                    </div>
                    <!--<div class="form-group">
                        <label for="insc_mdp_2">Confirmez le mot de passe</label>
                        <input type="password" class="form-control orphee-input" id="insc_mdp_2" placeholder="" name="mdp" onchange="formValidation()" required>
                    </div>-->
                    <button  class="btn btn-primary orphee-btn" onclick="formValidation();">Créer le compte</button>
                    <p>Vous avez déjà un compte ? <a href="#" v-on:click="openPopUp('popup-log')" class="orphee-link">Connectez-vous en cliquant ici</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementsByClassName('orphee-nav')[0].style.backgroundColor = "rgba(0,0,0,0)";
    var nav_link = document.getElementsByClassName('orphee-nav')[0].getElementsByTagName('a');
    for(let i=0;i<nav_link.length;i++) {
        nav_link[i].style.color = "#ffffff";
    }
    document.getElementsByClassName('logo-nav')[0].src = "<?php echo base_url(); ?>img/arpeorphev3_white.png";
</script>
<script>
	var mdp1=document.getElementById("insc_mdp_1");
	var mdp2=document.getElementById("insc_mdp_2");
	
	function formValidation(){
		console.log("mdp1 : "+mdp1.textContent);
		console.log("mdp2 : "+mdp2.value);
		if(mdp1.value!=mdp2.value){
			console.log("nop");
			mdp2.setCustomValidity("Le mot de passe est different !");
		}else{
			console.log("yes");
			mdp2.setCustomValidity("");
		}
	}
	
</script>

