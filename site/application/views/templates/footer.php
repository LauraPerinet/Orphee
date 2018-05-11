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

  </body>

</html>