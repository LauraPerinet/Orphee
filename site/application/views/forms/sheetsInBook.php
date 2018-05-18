<div class="container" id="completeOuvrage">
    <div class="row">
        <div class="col-12"><h1>Choississez les fiches de l'ouvrage</h1></div>
    </div>
	<?php  echo form_open_multipart("ouvrage/completerOuvrage/".$book->ID); ?>
	<div class="allSheets drop row">
	<?php
		foreach($sheets as $sheet) {
            ?>
            <div class="draggable col-2">
                <div class="orphee-sheet" style="background-image: url(<?php echo base_url() . 'uploads/';
                echo $sheet['Portrait']; ?>);">
                    <div>
                        <div class="row">
                            <p class="orphee-sheet-title"><?php echo $sheet['Nom']; ?></p>
                        </div>
                        <div class="row orphee-sheet-row-img">
                            <div class="col-12">
                                <a href="<?php echo site_url('ouvrage/addSheet/' . $book->ID . '/' . $sheet['ID'] . '/' . count($book->fiches)); ?>"
                                   class="orphee-sheet-link-img"/>
                                <svg class="icon-plus" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 31.444 31.444" style="enable-background:new 0 0 31.444 31.444;"
                                     xml:space="preserve">
                                        <path d="M1.119,16.841c-0.619,0-1.111-0.508-1.111-1.127c0-0.619,0.492-1.111,1.111-1.111h13.475V1.127
                                    C14.595,0.508,15.103,0,15.722,0c0.619,0,1.111,0.508,1.111,1.127v13.476h13.475c0.619,0,1.127,0.492,1.127,1.111
                                    c0,0.619-0.508,1.127-1.127,1.127H16.833v13.476c0,0.619-0.492,1.127-1.111,1.127c-0.619,0-1.127-0.508-1.127-1.127V16.841H1.119z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
    </div>
    <div class="row book drop">
                <div class="col-2">
                    <div class="orphee-sheet" style="background-image: url(<?php echo base_url().'uploads/'.$book->imagecouverture;?>)">
                        <div>
                            <div class="row">
                                <p class="orphee-sheet-title">Couverture</p>
                            </div>
                            <div class="row orphee-sheet-row-img">
                                <div class="col-12">
                                    <a href="<?php echo site_url('ouvrage/modification/'.$book->ID); ?>" class="orphee-sheet-link-img">
                                        <svg class="icon-add" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 386.615 386.615" style="enable-background:new 0 0 386.615 386.615;" xml:space="preserve" width="512px" height="512px">
                                            <path d="M36.573,309.292h2.09l100.833-21.943c1.964-0.327,3.784-1.237,5.224-2.612L315.56,113.896     c12.48-12.453,19.443-29.391,19.331-47.02c0.023-17.766-6.917-34.833-19.331-47.543C303.108,6.853,286.17-0.11,268.54,0.003     c-17.742-0.157-34.76,7.028-47.02,19.853L51.201,190.696c-1.502,1.209-2.597,2.85-3.135,4.702L26.124,296.231     c-0.599,3.62,0.565,7.308,3.135,9.927C31.188,308.126,33.817,309.253,36.573,309.292z M268.54,20.901     c25.103-0.002,45.454,20.347,45.456,45.45c0,0.175-0.001,0.35-0.003,0.525c0.171,11.959-4.547,23.47-13.061,31.869     l-64.261-64.784C245.137,25.548,256.604,20.848,268.54,20.901z M222.042,49.113l64.261,64.261L137.405,261.749l-64.261-63.739     L222.042,49.113z M64.785,218.909l51.722,51.722L50.156,285.26L64.785,218.909z" fill="#FFFFFF"/>
                                            <path d="M368.328,365.717H18.287c-5.771,0-10.449,4.678-10.449,10.449s4.678,10.449,10.449,10.449h350.041     c5.771,0,10.449-4.678,10.449-10.449S374.099,365.717,368.328,365.717z" fill="#FFFFFF"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="orphee-sheet">
                        <div>
                            <div class="row">
                                <p class="orphee-sheet-title">Sommaire</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                foreach($book->fiches as $fiche){
                    ?>
                <div class="col-2 draggable" id="<?php echo $fiche->ID; ?>">
                    <div class="orphee-sheet" style="background-image: url(<?php echo base_url().'uploads/'.$fiche->Portrait;?>)">
                        <div>
                            <div class="row">
                                <p class="orphee-sheet-title"><?php echo $fiche->Page.' • '.$fiche->Nom; ?></p>
                            </div>
                            <div class="row orphee-sheet-row-img">
                                <div class="col-4">
                                    <a href="<?php echo site_url('ouvrage/moveSheet/'.$book->ID.'/'.$fiche->ID).'/left'; ?>" />
                                        <svg version="1.1" class="icon-plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 477.175 477.175" style="enable-background:new 0 0 477.175 477.175;" xml:space="preserve">
                                            <path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225
                                            c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="<?php echo site_url('ouvrage/deleteSheet/'.$book->ID.'/'.$fiche->ID); ?>" />
                                    <svg class="icon-del" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 414.298 414.299" style="enable-background:new 0 0 414.298 414.299;"
                                         xml:space="preserve">
                                        <path d="M3.663,410.637c2.441,2.44,5.64,3.661,8.839,3.661c3.199,0,6.398-1.221,8.839-3.661l185.809-185.81l185.81,185.811
                                            c2.44,2.44,5.641,3.661,8.84,3.661c3.198,0,6.397-1.221,8.839-3.661c4.881-4.881,4.881-12.796,0-17.679l-185.811-185.81
                                            l185.811-185.81c4.881-4.882,4.881-12.796,0-17.678c-4.882-4.882-12.796-4.882-17.679,0l-185.81,185.81L21.34,3.663
                                            c-4.882-4.882-12.796-4.882-17.678,0c-4.882,4.881-4.882,12.796,0,17.678l185.81,185.809L3.663,392.959
                                            C-1.219,397.841-1.219,405.756,3.663,410.637z"/>
                                    </svg>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="<?php echo site_url('ouvrage/moveSheet/'.$book->ID.'/'.$fiche->ID).'/right'; ?>" />
                                        <svg version="1.1" class="icon-plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 477.175 477.175" style="enable-background:new 0 0 477.175 477.175;" xml:space="preserve">
                                            <path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5
                                            c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z
                                            "/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
    </div>
    </form>
    <div class="row">
        <div class="col-12" style="margin-top: 30px;margin: auto;text-align: center">
            <a href="<?php echo site_url("ouvrage/export/".$book->ID); ?>">
                <button class="orphee-btn">Assemblage</button>
            </a>
        </div>
    </div>
</div>

