<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="imageCarousel" class="carousel slide" data-interval="2000" data-ride="carousel" data-pause="hover" data-wrap="true">
                <ol class="carousel-indicators">
                    <li data-target="#imageCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#imageCarousel" data-slide-to="1"></li>
                    <li data-target="#imageCarousel" data-slide-to="2"></li>
                </ol>
                    <div class="carousel-inner">
                    <?php foreach($InformationSheets as $sheetPage):?>
                        <div class="item active">
                        <?php foreach($sheetPage as $sheetRow):?>
                            <div class="row">
                            <?php foreach($sheetRow as $sheet):?>
                                <div class="col-xs-2">
                                    <img src="<?php echo base_url(); echo $sheet['Portrait']; ?>" class="img-responsive">
                                    <div>
                                        <h5><?php echo $sheet['Nom']; ?></h5>
                                        <p><?php echo $sheet['SousTitre']; ?></p>
                                        <a role="button" class="btn btn-primary" href="<?php echo base_url(); echo "index.php/Fiche/modification/"; echo $sheet['ID']; ?>">Modifier</a>
                                        <a role="button" class="btn btn-danger" href="<?php echo base_url(); echo "index.php/Fiche/suppression/"; echo $sheet['ID']; ?>">Supprimer</a>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            </div>
                        <?php endforeach;?>
                        </div>
                    <?php endforeach;?>
                    </div>
                    <a href="#imageCarousel" class="carousel-control left" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a href="#imageCarousel" class="carousel-control right" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>

            </div>
        </div>
    </div>
