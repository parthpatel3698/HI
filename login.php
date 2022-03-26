<?php
session_start();
ini_set("display_errors","OFF");
$conn=mysqli_connect("localhost","root","","videogame");



if($_REQUEST['login'])
{

$uname=$_REQUEST['user_name'];
$pass=md5($_REQUEST['user_password']);	
$sql="select * from personal_details where user_name='$uname' AND 
user_password='$pass'";

$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);

$sql2="select * from personal_details where user_name='$uname' AND 
user_password='$pass' AND user_status='A'";

$res2=mysqli_query($conn,$sql2);
$count2=mysqli_num_rows($res2);


if($count>0)
{
    
    if($count2>0) {

    $row=mysqli_fetch_array($res);
    $user_id=$row['user_id'];
    $_SESSION['user']=$uname;
    $_SESSION['user_id']=$user_id;
    header("location:index.php");
    
    } else {

        $msg2="The account subscription is pending or blocked";
    }


}else{
	
	$msg="Username Or Password Not Matched";
	
}
	
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <style>
     
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="mx-auto text-center mb-5 section-heading">
                <h2>Login</h2>
            </div>
            <br>
        </div>
        <div class="row">
        <div class="col-md-12">
        <form action="" class="form-horizontal" method="post" >
                  
        <div class="form-group">
         <label class="control-label col-sm-2" for="user_name">Username:<font color="red"><b>*</b></font></label>
         
          <div class="col-sm-8">
          <input type="text" class="form-control" id="user_name" placeholder="Enter username" name="user_name" value="<?=$row['user_name'];?>" required>
          </div>
        </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="user_password">Password:<font color="red"><b>*</b></font></label>
        
          <div class="col-sm-8">
        <input type="password" class="form-control" id="user_password" placeholder="Enter password" 
        name="user_password" value="<?=$row['user_password'];?>" required>
        <b><label for="message" class="form-group" style="margin:0 auto;"><font color="red"> <?php echo $msg; ?></font></label></b>
        <b><label for="message2" class="form-group" style="margin:0 auto;"><font color="red"> <?php echo $msg2; ?></font></label></b>
    </div>
      </div>

     
                    
                    <div class=" mx-auto text-center mb-5">
                       
                            <input type="submit" name="login" class="btn btn-primary" value="LOGIN" />
                        
                    </div>
                   
                   
                </form>
            </div>
        </div>
    </div>
    <div class="text-center">
       
        Forgot Password?
        <a href="index.php?view=forgotpassword.php"> <b> <font color="red">Click here</font></b> </a>
 
    </div>
    <br>  <br><br>  <br>  
</body>

</html>