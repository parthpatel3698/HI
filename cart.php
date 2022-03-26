<?php

session_start();
ini_set("display_errors", "off");
$conn = mysqli_connect("localhost", "root", "", "gamersgarage_db");

$user_id = $_SESSION['user_id'];





if ($_REQUEST['buy_id']) {
    
    $rid = $_REQUEST['buy_id'];
$sell= "select * from cart where rental_id=$rid AND user_id=".$user_id;

$sellresult= mysqli_query($conn,$sell);


if($sellresult){
    $count = mysqli_num_rows($sellresult);

    if($count>0)
    {
        $getdata= mysqli_fetch_array($sellresult);
        $cart_id= $getdata['cart_id'];
        $cart_quantity= $getdata['cart_quantity'];
        $cart_price= $getdata['cart_price'];
        $cart_quantitynew=$cart_quantity+1;
        $cart_pricenew = $cart_quantitynew * $cart_price;
        $update= "update cart set cart_quantity=".$cart_quantitynew." where cart_id=".$cart_id;
        $rres = mysqli_query($conn, $update);
    
        if ($rres) {
            header("location:index.php?view=cart.php");
        } else {
            print mysqli_error($conn);
            print "No data found";
        }
    }
    else{
        $rsql = "insert into cart (rental_id,user_id,cart_quantity)  values ($rid,$user_id,'1')";

        $rres = mysqli_query($conn, $rsql);
    
        if ($rres) {
            header("location:index.php?view=cart.php");
        } else {
            print mysqli_error($conn);
        }
    }
}
    
}

$sql = "select * from cart where user_id=" . $user_id;

if ($_REQUEST['delete']) {
    $checkbox = $_REQUEST['checkbox'];
    $a = implode(",", $checkbox);
    mysqli_query($conn, "delete from cart where cart_id in($a)");
}

$result = mysqli_query($conn, $sql);
//print_r($result);


if($_REQUEST['checkout'])
{





  $user_id = $_SESSION['user_id'];
    $rentid = $_REQUEST['buy_id'];
    $rent = "select * from rental_item where rental_id=" . $rentid;
    $rentresult = mysqli_query($conn, $rent);
    $rrow = mysqli_fetch_array($rentresult);
    $rprice = $rrow['rental_price'];
    $rquantity = $rrow['cart_quantity'];
    $tprice = $_REQUEST['tprice'];

   $count=$_REQUEST['count'];


    $orderdate=date("Y-m-d");




 $asql = "insert into porder (user_id,total_price,order_date,status) values ($user_id,'$tprice','$orderdate','P')";
    


$aresult = mysqli_query($conn, $asql);

$order_id=mysqli_insert_id($conn);


            for($i=1;  $i < $count; $i++)
            {


                $rentid=$_REQUEST['game_id'.$i];
                $rquantity=$_REQUEST['cart_quantity'.$i];
                $tprice=$_REQUEST['total_price'.$i];

            $bsql = "insert into order_detail (order_id,rental_id,quantity,price) values 
            ('$order_id','$rentid','$rquantity','$tprice')";

            $rresult = mysqli_query($conn, $bsql);

            }


            $delete = "delete from cart where user_id=".$user_id;
            $deleteresult = mysqli_query($conn,$delete);
            header("location:index.php?view=order.php&order_id=".$order_id);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <style>
        
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="mx-auto text-center mb-5 section-heading">
                <h2>CART</h2>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="" class="form-horizontal" method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Image
                                </th>

                                <th>
                                    Name
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Available Copies
                                </th>

                                <th>
                                    Quantity
                                </th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Delete
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 1;
                            while ($rows = mysqli_fetch_array($result)) {
                                $cart_id = $rows['cart_id'];
                                $rental_id = $rows['rental_id'];
                                $cart_quantity = $rows['cart_quantity'];
                                $rentdata = "select * from rental_item where rental_id=" . $rental_id;
                                $rentdataresult = mysqli_query($conn, $rentdata);
                                $rentrow = mysqli_fetch_array($rentdataresult);
                                $image = $rentrow['rental_logo'];
                                $name = $rentrow['rental_name'];
                                $price = $rentrow['rental_price'];
                                $cat_id = $rentrow['sub_id'];
                                $catdata = "select * from subcategory where sub_id=" . $cat_id;
                                $catdataresult = mysqli_query($conn, $catdata);
                                $catrow = mysqli_fetch_array($catdataresult);
                                $catname = $catrow['sub_name'];

                                $cart_price = $price * $cart_quantity;

                            ?>

<input type="hidden" name="game_id<?= $i ?>" value="<?= $rental_id; ?>" >

                                <tr>
                                    <td>
                                        <img src="images/<?php echo $image; ?>" height="80px" width="80px">
                                    </td>

                                    <td>

                                        <?php

                                        echo $name;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $catname;
                                        ?>
                                    </td>

                                    <td width="15%">
                                            <?php 
                                                 $qsql = "SELECT * FROM quantity WHERE rental_id=" . $rows['rental_id'];
                                                 $res = mysqli_query($conn, $qsql);
                                                 $num_row = mysqli_num_rows($res);
                                                 echo $num_row; 

                                                 $avl_qty=$num_row;
                                                 
                                            ?>
                                    </td>

                                    <td width="10%">
                                        <p>

<input type="number" name="cart_quantity<?= $i ?>" min="1" max="10" onchange="CalculatePrice('<?= $i ?>',this.value,'<?= $price; ?>','<?= $avl_qty ;?>');" value="<?php echo $cart_quantity; ?>">
                                        </p>

                                    </td>

                                    <td width="10%">
             <input type="hidden" name="total_price<?= $i ?>" value="<?= $cart_price; ?>" id="total_price<?= $i ?>">
                                        <span id="price<?= $i ?>"> <?php echo number_format($cart_price, 2); ?></span>
                                    </td>

                                    <td width="10%" align="center">
                                        <input type="checkbox" name="checkbox[]" value="<?php echo $rows['cart_id']; ?>">
                                    </td>

                                </tr>

                            <?php


                          $tprice+=$cart_price;


                                $i++;
                            }




                            ?>

<input type="hidden" name="count" value="<?=  $i; ?>" >
<input type="hidden" name="tprice" value="<?=  $tprice; ?>" >
                            <tr>
                                <td colspan=6></td>
                                <td align="center"><input type="submit" class="btn btn-danger" value="Delete" name="delete"></td>
                            </tr>
                        </tbody>
                    </table>



                    <center>
                        <input type="submit" name="checkout"  value="checkout" class="btn btn-success">
                        
                        
                    </center>

                </form>
            </div>
        </div>
    </div>
    <script>
        function CalculatePrice(id, qty, price,avl_qty) {
            //var qty=document.getElementById('cart_quantity').value;
           // alert(qty);


            if(qty>avl_qty)
            {

alert("you can't   add more than Available  QTY");

        



            }

            //alert(avl_qty);

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
<br><br>