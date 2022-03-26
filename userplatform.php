<?php
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "videogame");
$id = $_GET['id'];

$query = "SELECT * FROM platform WHERE id = $id ";
$result = mysqli_query($conn, $query);
$rows = mysqli_fetch_array($result);


if ($_REQUEST['search']) {
    $searchbox = $_REQUEST['searchbox'];
    $psql = "select * from rental_item where rental_name like '$searchbox%' AND id=$id";
} else if ($_REQUEST['sort']) {
    $sort = $_REQUEST['sort'];

    if ($_REQUEST['type'] == "lowtohigh") {
        $asc_desc = "asc";
    } else if ($_REQUEST['type'] == "hightolow") {
        $asc_desc = "desc";
    }
    $psql = "select * from rental_item where id=$id order by rental_price $asc_desc";
} else {
    $psql = "select * from rental_item where id='" . $id . "'";
}
$result1 = mysqli_query($conn, $psql);

$count = mysqli_num_rows($result1);

?>
<html>

<head>
    <style>
        h2 {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto text-center">
                <h2 class="mb-5"><?php echo  strtoupper($rows['title']); ?></h2>
                <hr>
            </div>
        </div>


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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;
                    <?php if ($count >= 1) { ?>
                        <div class="dropdown"> 
                            <button class="btn btn-danger">Sort by</button>
                            <div class="dropdown-content">

                                <a class="dropdown-item" href="index.php?view=userplatform.php&sort=rental_price&id=<?= $id; ?>&type=lowtohigh">Price Low to High</a>

                                <a class="dropdown-item" href="index.php?view=userplatform.php&sort=rental_price&id=<?= $id; ?>&type=hightolow">Price High to Low</a>

                            </div>

                        </div>
                        
                        
                    <?php } ?>
                </div>
               
                <br>
            </div>
            <?php if ($count < 1) {
                    $msg =  "No Games Found"; ?>
                    <br>
                    <center>
                        <b>
                            <label for="message" class="form-group" style="margin:0 auto;">
                                <font color="red"> <?php echo $msg; ?></font>
                            </label>
                        </b>
                    </center>
                <?php
                } else {
                ?>
        </form>

        <br>
        <div class="row">
            <?php


            while ($row = mysqli_fetch_assoc($result1)) {

            ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="index.php?view=gamedetails.php&rental_id=<?php echo ($row['rental_id']); ?>"> <img src="admin/images/<?php echo $row['rental_image']; ?>" style="height: 240px;
                            width: -webkit-fill-available;" alt="Image" class="img-fluid"></a>

                        <h3><?php echo $row['rental_name']; ?></h3>

                        <h5>RS. <?php echo $row['rental_price']; ?></h5>
                        <?php if ($_SESSION['user'] == "") {  ?>
                            <a href="index.php?view=login.php"><input type="button" class="btn btn-primary" value="Buy" width></a>
                        <?php } else {  ?>
                            <a href="index.php?view=cart.php&buy_id=<?php echo ($row['rental_id']); ?>"><input type="button" name="buy" class="btn btn-primary" value="Buy" width></a>
                            <a href="index.php?view=rent_cart.php&rent_id=<?php echo ($row['rental_id']); ?>"><input type="button" name="buy" class="btn btn-primary" value="Rent" width></a>
                            <a href="index.php?view=wishlist.php&rental_id=<?php echo ($row['rental_id']); ?>" class="btn btn-info"><span class="glyphicon glyphicon-heart"></span> Wishlist</a>  
                        <?php  }   ?>

                    </div>

                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <br><br><br>
        <?php } ?>
</body>

</html>
<br><br>