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
    <script src="<?php echo base_url(); ?>js/itemslide.min.js"></script>
    <script>
        
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
                            
                            
                            drop: function(event, ui) { 
                                if ($(ui.draggable).parents(".allSheets").length) window.open($(ui.draggable).find("a").prop("href"),"_self",false);
                            }
                        })
                        
                        function updateSheet(exclude = null) {
                            if (!exclude) exclude = "";
                            var sheets = "";
                            var elems = $(".book .draggable");
                            for (var i of elems) if (i.id != exclude) sheets += i.id + "-";
                            return sheets;
                        }
                        
                        function suppSheet(item) {
                            $.ajax({
                                url: '<?php if (isset($book)) echo base_url() . "index.php/" . "ouvrage/reorganiseSheet/" . $book->ID . '/'; ?>' + updateSheet(item.prop("id")),
                                success: function(res){
                                    window.open(item.find(".delete").parent().prop("href"),"_self",false);
                                }
                            });
                        }
                        $(".book.drop").sortable({
                            items: ".draggable", 
                            
                            update: function() {
                                window.open('<?php if (isset($book)) echo base_url() . "index.php/" . "ouvrage/reorganiseSheet/" . $book->ID . '/'; ?>' + updateSheet() + '/true', '_self', false);
                            },
                            
                            out: function(event, ui) {out = event.timeStamp},
                            stop: function(event, ui) {
                                if (out != event.timeStamp) {
                                    suppSheet($(ui.item))
                                }
                            },
                        }).disableSelection();
                        
                        for( var i of $(".delete")) {
                            $(i).on("click",function(e){
                                e.preventDefault();
                                suppSheet($($(e.target).parents(".sheet")[0]));
                                return false;
                            })
                        }
                    }
                );
            };
        });
    </script>

  </body>

</html>