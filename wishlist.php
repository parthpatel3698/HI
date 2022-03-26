<?php

session_start();
ini_set("display_errors", "OFF");

$conn = mysqli_connect("localhost", "root", "", "videogame");

$user_id = $_SESSION['user_id'];


if ($_REQUEST['rental_id']) {

  $rid = $_REQUEST['rental_id'];

  $wishlist = "select * from wishlist where rental_id=" . $rid;
  $wishlistresult = mysqli_query($conn, $wishlist);
  if ($wishlistresult) {
    $count = mysqli_num_rows($wishlistresult);
    if ($count > 0) {
      $getdata = mysqli_fetch_array($wishlistresult);
      $wid = $getdata['wid'];
      $quantity = $getdata['quantity'];
      $price = $getdata['price'];
      $quantitynew = $quantity + 1;
      $pricenew = $quantitynew * $price;
     
    } else {
      $rental_price = $_REQUEST['rental_price'];

      $rsql = "insert into wishlist (rental_id,user_id)values($rid,$user_id)";

      $rres = mysqli_query($conn, $rsql);

      if ($rres) {
        echo "";
      } else {
        print mysqli_error($conn);
      }
    }


    $sql = "select * from wishlist where user_id=" . $user_id;


    $result = mysqli_query($conn, $sql);
  }
}
$sql = "select * from wishlist where user_id=" . $user_id;
$result = mysqli_query($conn, $sql);


if ($_REQUEST['remove']) {
  $checkbox = $_REQUEST['checkbox'];
  $a = implode(",", $checkbox);
 
  mysqli_query($conn, "delete from wishlist where wid in($a)");
  
}

if ($_REQUEST['add']) 
{
   

$rid=$_REQUEST['rid'];


  $csql = "insert into cart (rental_id,user_id,cart_quantity)values($rid,$user_id,'1')";

    $cres = mysqli_query($conn, $csql);

    if ($cres) {
      header("location:index.php?view=cart.php");
    } else {
      print mysqli_error($conn);
    }
  }



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $(function() {
      $("#tabs").tabs();
    });
  </script>
</head>

<body>

  <div class="container">
    <form method="post">
      <div class=" mx-auto text-center mb-5 section-heading">
        <br>
        <h2>WishList</h2>
      </div>
      <br>
      <div class="card">

        <br>
        <table class="table table-bordered">

          <thead>

            <tr>
              <th>Game Name</th>
              
              <th>Total price</th>
              <th>Add</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $i = 1;
            while ($rows = mysqli_fetch_array($result)) {
              $wid = $rows['wid'];
              $rental_id = $rows['rental_id'];
              $quantity = $rows['quantity'];
              $rentdata = "select * from rental_item where rental_id=" . $rental_id;
              $rentdataresult = mysqli_query($conn, $rentdata);
              $rentrow = mysqli_fetch_array($rentdataresult);
              $image = $rentrow['rental_logo'];
              $name = $rentrow['rental_name'];
              $price = $rentrow['rental_price'];
              $wprice = $price * $quantity;


            ?>

              <tr>
                <td><img src="admin/images/<?php echo $image; ?>" height="80px" width="80px">
                  <?php

                  echo $name;
                  ?></td>
   
                <td width="10%">
             <?php
                    echo $price;
                    ?></td>
                <td align="center">
                <input type="hidden" name="rid"  value="<?php echo $rows['rental_id']; ?>" >
               
                <input type="submit" name="add"  value="Add To Cart" class="btn btn-success">

                </td>
                <td align="center">
                <input type="checkbox" name="checkbox[]" value="<?php echo $rows['wid']; ?>">
                </td>
              </tr>
            <?php
              $tprice += $wprice;


              $i++;
            }
            ?>
            <input type="hidden" name="count" value="<?=  $i; ?>" >
<input type="hidden" name="tprice" value="<?=  $tprice; ?>" >
                          
            <tr>
              <td colspan=3></td>
              <td width="10%" align="center">
                <input type="submit" class="btn btn-danger" name="remove" value="Remove">
              </td>
            </tr>
          </tbody>
        </table>
      </div>


    </form>
  </div>
  <script>
    function CalculatePrice(id, qty, price) {
      //var qty=document.getElementById('cart_quantity').value;
      //alert(qty);
      // alert(price);
      if (qty != '' && price != '') {
        var total = qty * price;
        total = total.toFixed(2);
        document.getElementById('price' + id).innerHTML = total;
        document.getElementById('total_price' + id).value = total;
      }
    }
  </script>
</body>

</html>