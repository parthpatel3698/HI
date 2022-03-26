<?php
session_start();
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "videogame");
$user=$_SESSION['user'];
$user_id=$_SESSION['user_id'];



if ($_REQUEST['submit']) {
    
    
    $user_password = md5($_REQUEST['user_password']);
    $confirm_password = md5($_REQUEST['confirm_password']);
   


    if($user_password==$confirm_password) {
                    $sql = "update personal_details set user_password='$user_password'
                    where user_id=" . $user_id;

                    $res = mysqli_query($conn,$sql);
                    if ($res)
                    header("location:index.php?view=updatedetails.php");
                    else
                    print mysqli_error($conn);
    } else {

  print "Passwords didn't match";

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
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="mx-auto text-center mb-5 section-heading">
                <h2>Change Password</h2>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col-md-11">
                <form action="" class="form-horizontal" method="post" >
                    

        <div class="form-group">
         <label class="control-label col-sm-2" for="user_password">New Password:</label>
         
          <div class="col-sm-8">
          <input type="password" class="form-control" id="user_password" placeholder="Enter New Password" 
                name="user_password" value="" required>
          </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-2" for="confirm_password">Confirm Password:</label>
         
          <div class="col-sm-8">
          <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" 
                name="confirm_password" value="" required>
          </div>
        </div>

      

      
                    
                    <div class=" mx-auto text-center mb-5">
                        
                            <input type="submit" name="submit" class="btn btn-primary" value="SAVE" />

                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>