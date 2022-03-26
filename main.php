<?php
session_start();
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "videogame");
$query = "select index_desc from index_desc";
$result = mysqli_query($conn, $query);


?>

<html>

<head>
    <style>

    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<div class="container">
    <?php


    while ($rows = mysqli_fetch_assoc($result)) {
    ?>
        <p align="justify"><?php echo $rows['index_desc']; ?> </p>
    <?php
    }
    ?>
</div>


<!--game section-->

<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div>
                <h2 class="mb-5">
                    <center>Games</center>
                </h2>
            </div>
        </div>
        <br>



        <form method="post">
            <div class="card">
                <div class="card-body" align="center">
                    <label for="search">Search:</label>

                    <input type="text" id="search" name="searchbox">
                    <input type="submit" class="btn btn-danger" name="search" value="Search"><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="dropdown">
                        <button class="btn btn-danger">Sort by</button>
                        <div class="dropdown-content">

                            <a class="dropdown-item" href="index.php?view=main.php&sort=rental_price&asc=desc">Price Low to High</a>

                            <a class="dropdown-item" href="index.php?view=main.php&sort=rental_price&asc=asc">Price High to Low</a>

                        </div>

                    </div>
                   
                </div>
                <br>
            </div>


        </form>

        <div class="row" id="image">

            <?php


            $asc_desc = "asc";
            if ($_REQUEST['search']) {
                $searchbox = $_REQUEST['searchbox'];
                $psql = "select * from rental_item where rental_name like '$searchbox%'";
            } else if ($_REQUEST['sort']) {
                $sort = $_REQUEST['sort'];

                if ($_REQUEST['asc'] == "asc") {
                    $asc_desc = "desc";
                } else {
                    $asc_desc = "asc";
                }
                $psql = "select * from rental_item order by rental_price $asc_desc";
            } else {
                $psql = "select * from rental_item";
            }


            $result = mysqli_query($conn, $psql);
            $arrVal = array();
            $i = 1;
            // print $psql;
            //print_r($result);
            while ($rows = mysqli_fetch_array($result)) {
                //echo $rows['rental_id'];
            ?>
                <div class="col-md-4">
                    <div class="thumbnail">

                        <a href="index.php?view=gamedetails.php&rental_id=<?php echo ($rows['rental_id']); ?>"> <img src="admin/images/<?php echo $rows['rental_image']; ?>" style="height: 240px;
                            width: -webkit-fill-available;" alt="Image" class="img-fluid"></a>

                        <h4><?php echo $rows['rental_name']; ?></h4>

                        <h5>RS. <?php echo $rows['rental_price']; ?></h5>
                        <?php if ($_SESSION['user'] == "") {  ?>
                            <a href="index.php?view=login.php"><input type="button" class="btn btn-primary" value="Buy" width></a>
                        <?php } else {  ?>
                            <a href="index.php?view=cart.php&buy_id=<?php echo ($rows['rental_id']); ?>"><input type="button" name="buy" class="btn btn-primary" value="Buy" width></a>
                            <a href="index.php?view=rent_cart.php&rent_id=<?php echo ($rows['rental_id']); ?>"><input type="button" name="rent" class="btn btn-primary" value="Rent" width></a>
                            <a href="index.php?view=wishlist.php&rental_id=<?php echo ($rows['rental_id']); ?>" class="btn btn-info"><span class="glyphicon glyphicon-heart"></span> Wishlist</a> 
                            
                        <?php  }   ?>

                    </div>
                </div>

            <?php
                $i = $i++;
            }
            ?>
        </div>
    </div>
</div>