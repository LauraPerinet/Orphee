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
                <?php //echo validation_errors(); ?>
                <?php echo form_open('login/view'); ?>
                    <div class="form-group">
                        <label for="co_email">Votre email</label>
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
                <form>
                    <div class="form-group">
                        <label for="insc_name">Votre nom</label>
                        <input type="text" class="form-control orphee-input" id="insc_name" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="insc_email">Votre email</label>
                        <input type="email" class="form-control orphee-input" id="insc_email" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="insc_mdp_1">Mot de passe</label>
                        <input type="password" class="form-control orphee-input" id="insc_mdp_1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="insc_mdp_2">Entrez de nouveau votre mot de passe</label>
                        <input type="password" class="form-control orphee-input" id="insc_mdp_2" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary orphee-btn">Se connecter</button>
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
    for(let i=0;nav_link.length;i++) {
        nav_link[i].style.color = "#ffffff";
    }
	 <script>
        new Vue({
            el: '#orphee',
            data: {

            },
            methods: {
                closePopUp: function () {
                    document.getElementsByClassName('show')[0].classList.add("hide");
                    document.getElementsByClassName('show')[0].classList.remove("show");
                    document.getElementsByClassName('show')[0].classList.add("hide");
                    document.getElementsByClassName('show')[0].classList.remove("show");
                },
                openPopUp: function (className) {
                    if(document.getElementsByClassName('show')[0] != undefined) {
                        this.closePopUp();
                    }
                    document.getElementsByClassName(className)[0].classList.add("show");
                    document.getElementsByClassName(className)[0].classList.remove("hide");
                    document.getElementsByClassName('black-bg-opacity')[0].classList.add("show");
                    document.getElementsByClassName('black-bg-opacity')[0].classList.remove("hide");
                }
            }
        });
    </script>
</script>