<?php

session_start();
ini_set("display_errors", "off");
$conn = mysqli_connect("localhost", "root", "", "gamersgarage_db");

$user_id = $_SESSION['user_id'];
$order_id=$_REQUEST['order_id'];





$pordersql = "select * from porder where order_id=".$order_id;
$result= mysqli_query($conn,$pordersql);
$orderrows=mysqli_fetch_array($result);

$sql = "select * from order_detail where order_id=".$order_id;
$result= mysqli_query($conn,$sql);
//$rows=mysqli_fetch_array($result);


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
            h2 {
                  text-decoration: underline;
            }
      </style>
</head>

<body>
      <div class="container">
            <div class="row">
                  <div class="mx-auto text-center mb-5 section-heading">
                        <h2>ORDER</h2>
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
                                                      Order id :  <?php  print  $orderrows[0];?>
                                                </th>

                                                <th>
                                                      Customer name : <?php  $user_id=$orderrows[1];
													  
													   list($user)=mysqli_fetch_array(mysqli_query($conn,"select user_name from personal_details  where user_id=".$user_id));
													  print $user;
													  ?>
                                                </th>

                                                <th>
                                                      order Date :  <?php  print  $orderrows[3];?>
                                                </th>

                                          </tr>
                                    </thead>
							  
							  
							  
                                    <thead>
                                          <tr>
                                                <th>
                                                      Game Name
                                                </th>

                                                <th>
                                                      Quantity
                                                </th>

                                                <th>
                                                      Price
                                                </th>

                                          </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									
									$total=0;
									
                                                          while($rows = mysqli_fetch_array($result))
                                                          {
                                                       ?>    
                                                <tr>
	 <td>   <?php $game_id=$rows['2']; 
	 
	 
	 list($gamename)=mysqli_fetch_array(mysqli_query($conn,"select rental_name from rental_item where rental_id=".$game_id));
	 
	 print $gamename;
	 
	 
	 ?> </td>
	 <td>   <?php echo $rows['3']; ?> </td>
	 <td>   <?php echo $rows['4']; ?> </td>

                                                         

                                                     


                                                </tr>
                                                <?php


    $total+=$rows['4'];

												} ?>
                                          <tr>
                                                <td colspan=2></td>

                                                <td><b>Total: <?php  print $total;?></b></td>
                                                
                                          </tr>
                                                         
                                    </tbody>
                              </table>
                              <br><br>
                              <center> 
                                    <button type="button" name="proceed" class="btn btn-success">
                                          <a href="index.php?view=payment.php">
                                                <font color=white>Proceed For Payment</font>
                                          </a>
                                    </button>
                              </center>



                        </form>
                  </div>
            </div>
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

<br><br>
<br><br>