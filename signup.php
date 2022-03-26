<?php
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "videogame");

if ($_POST['submit']) {
    $user_name = addslashes($_REQUEST['user_name']);
    $user_password = md5($_REQUEST['user_password']);
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
    $regdate=date("Y-m-d");
    $rent_limit = $_REQUEST['rent_limit'];
    $sub_deposit = ($rent_limit * 500);


    $rquery = "select * from personal_details where user_name='$user_name' OR user_email='$user_email'";
    $result = mysqli_query($conn,$rquery);
    $count = mysqli_num_rows($result);

    if($count>0){
        $msg = "Username or Email already exist";
    ?>
        <br>
        <center>
            <b>
                <label for="message" class="form-group" style="margin:0 auto;">
                    <font color="red"> <?php echo $msg; ?></font>
                </label>
            </b>
        </center>
    <?php
        exit;
        
    } else {
    

    $query = "insert into personal_details(user_name, user_password, user_fname, user_mname, user_lname,
     user_email, user_address1, user_address2, user_city, country_id, state_id, user_zipcode, user_ssn,
      user_hphone, user_ophone, user_rdate, rent_limit, sub_deposit, user_status) 
    values ('$user_name','$user_password','$user_fname','$user_mname','$user_lname','$user_email',
    '$user_address1','$user_address2','$user_city','$country_id','$state_id','$user_zipcode','$user_ssn',
    '$user_hphone','$user_ophone', '$regdate', '$rent_limit', '$sub_deposit', 'P')";

    $res = mysqli_query($conn, $query);
    if ($res) {
        header("location:index.php?view=security_ques.php&email=".$user_email);
    } else {
        echo mysqli_error($conn);
    }
}
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <style>
        h2 {
            text-decoration: underline;
        }
    </style>


<script language="JavaScript">



  function choose(country_id){

var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("state").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "test.php?country_id="+country_id, true);
  xhttp.send();



  }




</script>



</head>

<body>
    <div class="container">
        <div class="row">
            <div class="mx-auto text-center mb-5 section-heading">
                <h2>Sign Up</h2>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="" class="form-horizontal" method="post" >
                   
                    

                    

        <div class="form-group">
         <label class="control-label col-sm-2" for="user_name">Username:</label>
         
          <div class="col-sm-8">
          <input type="text" class="form-control" id="user_name" placeholder="Enter username" name="user_name" value="" required>
          </div>
        </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_password">Password:</label>
        
          <div class="col-sm-8">
        <input type="password" class="form-control" id="user_password" placeholder="Enter password" name="user_password" value="" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_fname">First Name:</label>
    
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_fname" placeholder="Enter first name" name="user_fname" value="" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_mname">Middle Name:</label>
     
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_mname" placeholder="Enter middle name" name="user_mname" value="">
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_lname">Last Name:</label>
        
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_lname" placeholder="Enter last name" name="user_lname" value="" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_email">Email:</label>
        
          <div class="col-sm-8">
        <input type="email" class="form-control" id="user_email" placeholder="Enter email" name="user_email" value="" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_address1">Address 1:</label>
        
          <div class="col-sm-8">
        <textarea class="form-control" id="user_address1" placeholder="Enter address 1" name="user_address1" required></textarea>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_address2">Address 2:</label>
        
          <div class="col-sm-8">
        <textarea class="form-control" id="user_address2" placeholder="Enter address 2" name="user_address2"></textarea>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_city">City:</label>
        
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_city" placeholder="Enter city" name="user_city" value="" required>
      </div>
      </div>


      <div class="form-group">
        <label class="control-label col-sm-2" for="country_id">Country:</label>
        
          <div class="col-sm-8">
        <select class="form-control" id="country_id" name="country_id" 
        value=""   onchange="JavaScript:choose(this.value);"   required>

		<option>   Select Country  </option>
		

          <?php

          $csql = "select * from country";
          $cres = mysqli_query($conn, $csql);
          while ($crow = mysqli_fetch_array($cres)) {
          ?>
            <option <?php if ($_REQUEST['country_id'] == $crow[0]  ) print "selected"; ?> value="<?= $crow[0]; ?>"><?= $crow[1]; ?></option>


          <?php  }  ?>



        </select>
      </div>
      </div>

      
      <div class="form-group">
        <label class="control-label col-sm-2" for="state_id">State:</label>
        
          <div class="col-sm-8">
		  
		 <div   id="state"> 
		  
        <select class="form-control" id="state_id" name="state_id" value="" required>


          <?php


$country_id=$_REQUEST['country_id'];

          $ssql = "select * from state where country_id=".$country_id;
          $sres = mysqli_query($conn, $ssql);
          while ($srow = mysqli_fetch_array($sres)) {
          ?>
            <option <?php if ($row['state_id'] == $srow[0]) print "selected"; ?> value="<?= $srow[0]; ?>"><?= $srow[1]; ?></option>

          <?php  }  ?>

        </select>
		
		
		</div>
		
		
		
		
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_zipcode">Zipcode:</label>
        
          <div class="col-sm-8">
        <input type="number" class="form-control" id="user_zipcode" placeholder="Enter zipcode" name="user_zipcode" value="" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_ssn">Social Security Number:</label>
        
          <div class="col-sm-8">
        <input type="number" class="form-control" id="user_ssn" placeholder="Enter social security no." name="user_ssn" value="" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_hphone">Contact (Home):</label>
       
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_hphone" placeholder="Enter home contact" name="user_hphone" value="" required>
      </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_ophone">Contact (Office):</label>
       
          <div class="col-sm-8">
        <input type="text" class="form-control" id="user_ophone" placeholder="Enter office contact" name="user_ophone" value="">
      </div>
      </div>



      <div class="form-group">

      <label class="control-label col-sm-2" for="user_ophone">Rent Limit Subscription:</label>
      <div class="col-sm-8">
                <label for="one">Games at a time (Deposit Rs. 500 per game)</label><br>
                <input type="radio" id="one" name="rent_limit" value="1">
                <label for="one">ONE</label><br>
                <input type="radio" id="two" name="rent_limit" value="2">
                <label for="two">TWO</label><br>
                <input type="radio" id="three" name="rent_limit" value="3">
                <label for="three">THREE</label><br>
                <input type="radio" id="four" name="rent_limit" value="4">
                <label for="four">FOUR</label><br>
                
      </div>
      </div>
                    
                    <div class=" mx-auto text-center mb-5">
                      
                            <input type="submit" name="submit" class="btn btn-primary" value="ADD" />
                         
                    </div>
                  
                </form>
            
        </div>
    </div>
</body>

</html>