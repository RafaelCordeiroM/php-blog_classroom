<footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">

      </div>
    </div>
  </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>


<script src="/public_html/js/jquery.min.js"></script>
<script src="/public_html/js/jquery-migrate-3.0.1.min.js"></script>
<script src="/public_html/js/popper.min.js"></script>
<script src="/public_html/js/bootstrap.min.js"></script>
<script src="/public_html/js/jquery.easing.1.3.js"></script>
<script src="/public_html/js/jquery.waypoints.min.js"></script>
<script src="/public_html/js/jquery.stellar.min.js"></script>
<script src="/public_html/js/owl.carousel.min.js"></script>
<script src="/public_html/js/jquery.magnific-popup.min.js"></script>
<script src="/public_html/js/aos.js"></script>
<script src="/public_html/js/jquery.animateNumber.min.js"></script>
<script src="/public_html/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="/public_html/js/google-map.js"></script>
<script src="/public_html/js/main.js"></script>
<script>
  window.onscroll = function() {
    myFunction()
  };

  var navbar = document.getElementById("navbar_main");
  var sticky = navbar.offsetTop;

  function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }
</script>
</body>

</html>

<?php 

if(isset($_POST['modal_book'])){

    echo "<script>
         $(window).load(function(){
             $('#modal_book').modal('show');
         });
    </script>";

}

?>