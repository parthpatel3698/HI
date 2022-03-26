<?php
session_start();

include('header.php');
require('mysqli_connect.php');
?>





    <div class="about-hero" style="margin-top:0">
    <div id="plugin">
<!--  ATTACHING DOWNLOADED PLUGIN USING OBJECT TAG  -->
<object width="100%" height="450px" data="plugin/examples/index.html"> </object>
</div>
        <div class="banner">
            <h1>Gamers Garage</h1>
        </div>

    </div>






    <footer class="container-fluid text-center">
    <?php include("footer.php"); ?>
  </footer>