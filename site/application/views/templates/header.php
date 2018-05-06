<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>
		Orphée 
	</title>
	<link href="<?php echo base_url(); ?>vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url(); ?>styles/business-frontpage.css" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url(); ?>styles/styles.css" type="text/css" rel="stylesheet"/>
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Orphee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
			<?php if(isset($this->session->user)){ ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('fiche/show'); ?>">Fiches</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('ouvrage/show'); ?>">Ouvrages</a>
				</li>
			<?php } ?>
            <li class="nav-item">
				<?php if(isset($this->session->user)){ ?>
					<a class="nav-link" href="<?php echo site_url('login/disconnect'); ?>">Deconnexion</a>
				<?php }else{ ?>
					<a class="nav-link" href="#">Connexion</a>
				<?php } ?>
              
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Inscription</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	