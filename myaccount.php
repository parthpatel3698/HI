<?php
session_start();
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "videogame");
$user=$_SESSION['user'];



list($user_id)=mysqli_fetch_array(mysqli_query($conn,"select user_id from personal_details where user_name='".$user."'"));


  $usql="select * from personal_details where user_id=$user_id";

$ures=mysqli_query($conn,$usql);

$row=mysqli_fetch_array($ures);

if ($_REQUEST['edit']) {
    
    $user_id = $_REQUEST['user_id'];
    $user_name = addslashes($_REQUEST['user_name']);
    
    $user_fname = addslashes($_REQUEST['user_fname']);
    $user_mname = addslashes($_REQUEST['user_mname']);
    $user_lname = addslashes($_REQUEST['user_lname']);
    $user_email = $_REQUEST['user_email'];
    $user_address1 = addslashes($_REQUEST['user_address1']);
    $user_address2 = addslashes($_REQUEST['user_address2']);
    $user_city = addslashes($_REQUEST['user_city']);
    $country_id = $_REQUEST['country_id'];
    $state_id = $_REQUEST['state_id'];
    $user_zipcode = $_REQUEST['user_zipcode'];
    $user_ssn = $_REQUEST['user_ssn'];
    $user_hphone = $_REQUEST['user_hphone'];
    $user_ophone = $_REQUEST['user_ophone'];
    
    $rent_limit = $_REQUEST['rent_limit'];
    $sub_deposit = ($rent_limit * 500);
    
    

            $sql = "update personal_details set user_name='$user_name',
            user_fname='$user_fname',user_mname='$user_mname',user_lname='$user_lname',user_email='$user_email',
            user_address1='$user_address1',
            user_address2='$user_address2',user_city='$user_city',country_id='$country_id',state_id='$state_id',
            user_zipcode='$user_zipcode',user_ssn='$user_ssn',user_hphone='$user_hphone',
            user_ophone='$user_ophone',rent_limit='$rent_limit', sub_deposit='$sub_deposit', 
            user_status='P'
             where user_id=" . $user_id;

           

    $res1 = mysqli_query($conn,$sql);
    if ($res1)
    header("location:index.php?view=updatedetails.php");
    else
        print mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


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
                <h2>Personal Details</h2>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col-md-11">
                <form action="" class="form-horizontal" method="post" >
                    <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                    

                    

        <div class="form-group">
         <label class="control-label col-sm-2" for="user_name">Username:</label>
         
          <div class="col-sm-8">
          <input type="text" class="form-control" id="user_name" placeholder="Enter username" 
              readonly  name="user_name" value="<?=$row['user_name'];?>" required>
          </div>
        </div>

      

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_fname">First Name:</label>
    
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_fname" placeholder="Enter first name" name="user_fname" value="<?=$row['user_fname'];?>" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_mname">Middle Name:</label>
     
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_mname" placeholder="Enter middle name" name="user_mname" value="<?=$row['user_mname'];?>">
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_lname">Last Name:</label>
        
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_lname" placeholder="Enter last name" name="user_lname" value="<?=$row['user_lname'];?>" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_email">Email:</label>
        
          <div class="col-sm-8">
        <input type="email" class="form-control" id="user_email" placeholder="Enter email" name="user_email" value="<?=$row['user_email'];?>" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_address1">Address 1:</label>
        
          <div class="col-sm-8">
        <textarea class="form-control" id="user_address1" placeholder="Enter address 1" name="user_address1" required><?=$row['user_address1'];?></textarea>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_address2">Address 2:</label>
        
          <div class="col-sm-8">
        <textarea class="form-control" id="user_address2" placeholder="Enter address 2" name="user_address2"><?=$row['user_address2'];?></textarea>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_city">City:</label>
        
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_city" placeholder="Enter city" name="user_city" value="<?=$row['user_city'];?>" required>
      </div>
      </div>


      <div class="form-group">
        <label class="control-label col-sm-2" for="country_id">Country:</label>
        
          <div class="col-sm-8">
        <select class="form-control" id="country_id" name="country_id" value="<?=$row['country_id'];?>" required>


          <?php

          $csql = "select * from country";
          $cres = mysqli_query($conn, $csql);
          while ($crow = mysqli_fetch_array($cres)) {
          ?>
            <option <?php if ($row['country_id'] == $crow[0]) print "selected"; ?> value="<?= $crow[0]; ?>"><?= $crow[1]; ?></option>


          <?php  }  ?>



        </select>
      </div>
      </div>

      
      <div class="form-group">
        <label class="control-label col-sm-2" for="state_id">State:</label>
        
          <div class="col-sm-8">
        <select class="form-control" id="state_id" name="state_id" value="<?=$row['state_id'];?>" required>


          <?php

          $ssql = "select * from state";
          $sres = mysqli_query($conn, $ssql);
          while ($srow = mysqli_fetch_array($sres)) {
          ?>
            <option <?php if ($row['state_id'] == $srow[0]) print "selected"; ?> value="<?= $srow[0]; ?>"><?= $srow[1]; ?></option>

          <?php  }  ?>

        </select>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_zipcode">Zipcode:</label>
        
          <div class="col-sm-8">
        <input type="number" class="form-control" id="user_zipcode" placeholder="Enter zipcode" name="user_zipcode" value="<?=$row['user_zipcode'];?>" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_ssn">Social Security Number:</label>
        
          <div class="col-sm-8">
        <input type="number" class="form-control" id="user_ssn" placeholder="Enter social security no." name="user_ssn" value="<?=$row['user_ssn'];?>" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_hphone">Contact (Home):</label>
       
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_hphone" placeholder="Enter home contact" name="user_hphone" value="<?=$row['user_hphone'];?>" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_ophone">Contact (Office):</label>
       
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_ophone" placeholder="Enter office contact" name="user_ophone" value="<?=$row['user_ophone'];?>">
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_rdate">Registration Date:</label>
       
          <div class="col-sm-8">
        <input type="date" class="form-control" id="user_rdate" placeholder="Enter registration date" name="user_rdate" value="<?=$row['user_rdate'];?>" readonly>
      </div>
      </div>

      <div class="form-group">

      <label class="control-label col-sm-2" for="user_ophone">Rent Limit Subscription:</label>
      <div class="col-sm-8">
                <label for="one">Games at a time (Deposit Rs. 500 per game)</label><br>
                <input type="radio" <?php if($row['rent_limit']==1) print "Checked"; ?> id="one" name="rent_limit" value="1">
                <label for="one">ONE</label><br>
                <input type="radio" <?php if($row['rent_limit']==2) print "Checked"; ?> id="two" name="rent_limit" value="2">
                <label for="two">TWO</label><br>
                <input type="radio" <?php if($row['rent_limit']==3) print "Checked"; ?> id="three" name="rent_limit" value="3">
                <label for="three">THREE</label><br>
                <input type="radio" <?php if($row['rent_limit']==4) print "Checked"; ?> id="four" name="rent_limit" value="4">
                <label for="four">FOUR</label><br>
                
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_rdate">Deposit:</label>
       
          <div class="col-sm-8">
        <input type="text" class="form-control" id="sub_deposit" placeholder="" name="sub_deposit" value="<?=$row['sub_deposit'];?>" readonly>
      </div>
      </div>

                    
                    <div class=" mx-auto text-center mb-5">
                        
                            <input type="submit" name="edit" class="btn btn-primary" value="Edit" />

                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>