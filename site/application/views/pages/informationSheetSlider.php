<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Liste de vos fiches</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div id="imageCarousel" class="carousel slide" data-interval="false" data-ride="carousel" data-wrap="true">
<!--                <ol class="carousel-indicators">-->
<!--                    --><?php
//                    for($i=0;$i<count($InformationSheets);$i++) {?>
<!--                        <li data-target="#imageCarousel" data-slide-to="--><?php //echo $i; ?><!--" class="--><?php //if($i==0) echo "active";?><!--"></li>-->
<!--                    --><?php
//                    }
//                    ?>
<!--                </ol>-->
                    <div class="carousel-inner">
                        <?php
                            $firstOcc = true;
                        ?>
                    <?php foreach($InformationSheets as $sheetPage):?>
                        <div class="carousel-item <?php if($firstOcc) echo "active" ?>">
                            <?php $firstOcc=false;?>
                        <?php foreach($sheetPage as $sheetRow):?>
                            <div class="row">
                            <?php foreach($sheetRow as $sheet):?>
                                <div class="col-2">
                                <div class="orphee-sheet" style="background-image: url(<?php echo base_url().'uploads/'; echo $sheet['Portrait']; ?>);">
                                    <div>
                                        <div class="row">
                                            <p class="orphee-sheet-title"><?php echo $sheet['Nom']; ?></p>
                                        </div>
                                        <div class="row">
                                            <p class="orphee-sheet-subtitle"><?php echo $sheet['SousTitre']; ?></p>
                                        </div>
                                        <div class="row orphee-sheet-row-img">
                                            <div class="col-6">
                                                <a href="<?php echo base_url(); echo "index.php/Fiche/modification/"; echo $sheet['ID']; ?>" class="orphee-sheet-link-img">
                                                    <svg class="icon-update" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 386.615 386.615" style="enable-background:new 0 0 386.615 386.615;" xml:space="preserve" width="512px" height="512px">
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <path d="M36.573,309.292h2.09l100.833-21.943c1.964-0.327,3.784-1.237,5.224-2.612L315.56,113.896     c12.48-12.453,19.443-29.391,19.331-47.02c0.023-17.766-6.917-34.833-19.331-47.543C303.108,6.853,286.17-0.11,268.54,0.003     c-17.742-0.157-34.76,7.028-47.02,19.853L51.201,190.696c-1.502,1.209-2.597,2.85-3.135,4.702L26.124,296.231     c-0.599,3.62,0.565,7.308,3.135,9.927C31.188,308.126,33.817,309.253,36.573,309.292z M268.54,20.901     c25.103-0.002,45.454,20.347,45.456,45.45c0,0.175-0.001,0.35-0.003,0.525c0.171,11.959-4.547,23.47-13.061,31.869     l-64.261-64.784C245.137,25.548,256.604,20.848,268.54,20.901z M222.042,49.113l64.261,64.261L137.405,261.749l-64.261-63.739     L222.042,49.113z M64.785,218.909l51.722,51.722L50.156,285.26L64.785,218.909z" fill="#FFFFFF"/>
                                                                    <path d="M368.328,365.717H18.287c-5.771,0-10.449,4.678-10.449,10.449s4.678,10.449,10.449,10.449h350.041     c5.771,0,10.449-4.678,10.449-10.449S374.099,365.717,368.328,365.717z" fill="#FFFFFF"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?php echo base_url(); echo "index.php/Fiche/suppression/"; echo $sheet['ID']; ?>" class="orphee-sheet-link-img">
                                                    <svg class="icon-remove" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 407.521 407.521" style="enable-background:new 0 0 407.521 407.521;" xml:space="preserve" width="512px" height="512px">
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <path d="M335.94,114.944H71.581c-2.86-0.243-5.694,0.702-7.837,2.612c-2.107,2.024-3.083,4.954-2.612,7.837l27.167,236.669     c3.186,26.093,25.436,45.647,51.722,45.453h131.657c27.026,0.385,49.791-20.104,52.245-47.02l22.465-236.147     c0.139-2.533-0.811-5.005-2.612-6.792C341.634,115.646,338.8,114.701,335.94,114.944z M303.026,359.45     c-1.642,15.909-15.366,27.803-31.347,27.167H140.022c-15.694,0.637-29.184-11.024-30.825-26.645L83.075,135.842h241.371     L303.026,359.45z" fill="#FFFFFF"/>
                                                                    <path d="M374.079,47.026H266.454V30.307c0.58-16.148-12.04-29.708-28.188-30.288c-0.53-0.019-1.061-0.024-1.591-0.014h-65.829     c-16.156-0.299-29.494,12.555-29.793,28.711c-0.01,0.53-0.005,1.061,0.014,1.591v16.718H33.442     c-5.771,0-10.449,4.678-10.449,10.449s4.678,10.449,10.449,10.449h340.637c5.771,0,10.449-4.678,10.449-10.449     S379.849,47.026,374.079,47.026z M245.556,30.307v16.718h-83.592V30.307c-0.589-4.579,2.646-8.768,7.225-9.357     c0.549-0.071,1.104-0.086,1.656-0.047h65.829c4.605-0.326,8.603,3.142,8.929,7.748C245.643,29.203,245.627,29.758,245.556,30.307     z" fill="#FFFFFF"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            <?php endforeach;?>
                            </div>
                        <?php endforeach;?>
                        </div>
                    <?php endforeach;?>
                    </div>
                <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev" style="margin-left: -100px">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="color: #0b2e13"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next" style="margin-right: -100px">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>

            </div>
            <div class="col-12" style="text-align: center;">
                <?php
                for($i=0;$i<count($InformationSheets);$i++) {?>
                    <a href="#" class="orphee-link" data-target="#imageCarousel" data-slide-to="<?php echo $i;?>"><?php echo $i+1;?></a>
                <?php
                }
                ?>
            </div>
        </div>

	<div>
		<a href="<?php echo site_url('fiche/creation'); ?>" class="orphee-link">Créer une nouvelle fiche</a>
	</div>
 </div>
