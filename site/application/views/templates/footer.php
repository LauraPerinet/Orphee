    <!-- Footer -->
    <footer>
      <div class="container">
        <p class="m-0 text-center">Copyright &copy; Orphee 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</div>
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>styles/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>styles/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        
        
        
        //Drag&Drop
        
        $(function(){
            
            if ($(".home-screen").length) {
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
            }
            
            
            if ($("#completeOuvrage").length) {
                $.getScript(
                    //Import jQuery UI
                    "<?php echo base_url(); ?>styles/vendor/jquery/jquery-ui.min.js", 
                    function(){
                        
                        var out;
                        var bb = $(".book .bloc");
                        bb.css("display","flex");
                        var h = bb.height();
                        bb.css({
                            height: h + "px",
                            display: "auto"
                        });
                        $(".book").css("background","none");
                        
                        //Fiche
                        
                        $(".allSheets.drop").sortable({
                            items: ".draggable",
                        }).disableSelection();
                        $(".book").droppable({
                            
                            //Ajout d'une fiche dans l'ouvrage
                            
                            drop: function(event, ui) { 
                                if ($(ui.draggable).parents(".allSheets").length) window.open($(ui.draggable).find("a").prop("href"),"_self",false);
                            }
                        })
                        
                        //Ouvrage
                        
                        $(".book.drop").sortable({
                            items: ".draggable",
                            
                            //Décalage image
                            
                            update: function(event, ui) {console.log("decalage image à save")},
                            
                            //Suppression d'une fiche dans l'ouvrage
                            
                            out: function(event, ui) {out = event.timeStamp},
                            stop: function(event, ui) {
                                if (out != event.timeStamp) window.open($(ui.item).find(".delete").parent().prop("href"),"_self",false);
                            },
                        }).disableSelection();
                    }
                );
            };
        });
    </script>

  </body>

</html>