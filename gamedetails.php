<?php
session_start();
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "gamersgarage_db");


$rental_id = $_GET['rental_id'];

$q2 = "SELECT * FROM rental_item WHERE rental_id = $rental_id";
$result1 = mysqli_query($conn, $q2);
$rows = mysqli_fetch_array($result1);


$query = "SELECT * FROM rental_item WHERE rental_id = $rental_id";
$result = mysqli_query($conn, $query);


$user_id = $_SESSION['user_id'];

$user = $_SESSION['user'];
list($user_id) = mysqli_fetch_array(mysqli_query($conn, "select user_id from personal_details where user_name='" . $user . "'"));


if ($_POST['save']) {
    $game_review = $_REQUEST['game_review'];
    $review_desc = $_REQUEST['review_desc'];


    $rquery = "select * from review where user_id='$user_id' AND rental_id='$rental_id'";
    
    $result = mysqli_query($conn,$rquery);
    $count = mysqli_num_rows($result);

    if($count>0){
        $msg = "Review on this game is already given by you";
        ?> 

<br>
                    <center>
                        <b>
                            <label for="message" class="form-group" style="margin:0 auto;">
                                <font color="red"> <?php echo $msg; ?></font>
                            </label>
                        </b>
                    </center>
                    
        <a href="index.php?view=gamedetails.php&rental_id=<?php echo $rental_id ?>"> &nbsp;&nbsp; BACK </a>
        <?php
        exit;
    } else {


    $rquery = "insert into review (review_id,game_review,review_desc,rental_id,user_id )  values ('','$game_review','$review_desc','$rental_id','$user_id')";
    $res = mysqli_query($conn, $rquery);

    if ($res) {
        echo '<script type="text/javascript">';
        echo ' alert("Thank you For Rating")';  //not showing an alert box.
        echo '</script>';
    } else
        print mysqli_error($conn);
}
}





$sql = "SELECT avg(`game_review`) FROM `review` WHERE rental_id=" . $rental_id;
$res1 = mysqli_query($conn, $sql);


list($rate) = mysqli_fetch_array($res1);



?>

<html>

<head>
    <style>
        .card-horizontal {
            display: flex;
            flex: 1 1 auto;
        }

        .vertical-line {
            display: inline-block;
            border-left: solid #ccc;
            margin: 0 10px;
            height: 250px;
        }

        .button {
            width: 100px;
            height: 45px;
            font-family: 'Roboto', sans-serif;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-weight: 500;
            color: white;
            background-color: black;
            border: none;
            border-radius: 80px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease 0s;
            cursor: pointer;
            outline: none;
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto text-center">
                <h2 class="mb-5"><?php echo $rows['rental_name']; ?></h2>
                <hr>
            </div>
        </div>
        <br>
        <form method="post">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-horizontal">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <div class="img-square-wrapper">
                                        <a href=""> <img src="admin/image/<?php echo $row['rental_logo']; ?>" height="250" width="320" style="border-radius:5px"></a>
                                    </div>
                                    <span class="vertical-line"></span>
                                    <div class="card-body">
                                        <h4 class="card-title"><b>Description:<b></h4>
                                        <b>
                                            <p class="card-text" style="padding-bottom:12px;" align="justify"><?php echo $row['rental_desc']; ?></p>
                                        </b>
                                        <b>Rating:&nbsp;&nbsp;&nbsp;&nbsp;<label for="message"> <h4> <font color="green"> <?php echo(round($rate,1)); ?> </font> </h4> </label></b><br><br>
                                        <?php if ($_SESSION['user'] == "") {  ?>
                                            <a href="index.php?view=login.php"><input type="button" class="button" value="Login"></a>
                                        <?php } else { ?>

                                            <a href="index.php?view=cart.php&buy_id=<?php echo ($rows['rental_id']); ?>"><input type="button" name="buy" class="button" value="Buy" width></a>

                                            <a href="index.php?view=rent_cart.php&rent_id=<?php echo ($rows['rental_id']); ?>"><input type="button" name="rent" class="button" value="Rent" width></a>
                                            
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <a href="index.php?view=wishlist.php&rental_id=<?php echo ($rows['rental_id']); ?>" class="btn btn-info"><span class="glyphicon glyphicon-heart"></span> Wishlist</a> 
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <br><br>
                            <div>
                                <b>Publisher: </b><?php $pub_id = $rows['pub_id'];
                                                    list($publisher) = mysqli_fetch_array(mysqli_query($conn, "select pub_title from publisher where pub_id=" . $pub_id));
                                                    print $publisher; ?><br>
                                <b>Platform: </b><?php $id = $rows['id'];
                                                    list($platform) = mysqli_fetch_array(mysqli_query($conn, "select title from platform where id=" . $id));
                                                    print $platform; ?><br>
                                <b>Category: </b><?php $sub_id = $rows['sub_id'];
                                                    list($category) = mysqli_fetch_array(mysqli_query($conn, "select sub_name from subcategory where sub_id=" . $sub_id));
                                                    print $category; ?><br>
                                <b>Release Date: </b><?php echo $rows['rental_date']; ?><br>
                                <b>Number Of Players: </b><?php echo $rows['player_count']; ?><br>
                                <b>Rating: </b><?php $rating_id = $rows['rating_id'];
                                                list($rating) = mysqli_fetch_array(mysqli_query($conn, "select rate_title from rating where rating_id=" . $rating_id));
                                                print $rating; ?><br>

                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <div class="card-horizontal"> <a href=""> <img src="image/star.jpg" height="60" width="60" style="border-radius:5px"></a>
                                        &nbsp;&nbsp;
                                        <div class="card-body">

                                            <br><br>
                                            <b>
                                                <input type="radio" name="game_review" value="1">1
                                                <input type="radio" name="game_review" value="2">2
                                                <input type="radio" name="game_review" value="3">3
                                                <input type="radio" name="game_review" value="4">4
                                                <input type="radio" name="game_review" value="5">5
                                            </b>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <textarea name="review_desc" id="review_desc" class="form-control" value="review_desc" placeholder="" required></textarea>
                                        <a href="index.php?view=viewreview.php&rental_id=<?php echo ($rows['rental_id']); ?>">
                                            <font color="green">Read Review</font>
                                        </a><br>
                                        <input type="submit" name="save" class="btn btn-primary" value="Send" />
                                    </div><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </form>
    <br><br><br>
</body>

</html>