<?php
session_start();
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "videogame");



?>
<html>

<head>
    <style>
        hr {
            border: 0.5px solid;
        }
    </style>
    
</head>

<body>
    <div class="contanier">
        <div class="row">
            <div class="mx-auto text-center">
                <h2 class="mb-5">User Review</h2>
                <hr class="hr">
            </div>
                <?php
                $sql = "select * from review where rental_id=" . $_REQUEST['rental_id'];
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <div class="card">

                        <div style="background-color: #9A9796"><h3><font color="black"><?php $user_id = $row['user_id'];


                                                list($username) = mysqli_fetch_array(mysqli_query($conn, "select user_name from personal_details
                                                where user_id='" . $user_id . "'"));


                                                print $username;


                                                ?>
                        </font></h3></div>
                        <div> <?= $row['review_desc']; ?></div>
                        
                    </div>

                <?php  }   ?>
        </div>
    </div>
</body>

</html>