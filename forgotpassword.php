<?php
session_start();
ini_set("display_errors","OFF");
$conn=mysqli_connect("localhost","root","","videogame");
$user_id=$_SESSION['user_id'];

if($_REQUEST['submit'])
{

$email=$_REQUEST['email'];
$ans=md5($_REQUEST['ans']);


 $sql="select * from sec_ques where user_email='$email' AND sec_ans='$ans'";


$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);

if ($count>0) {
    header("location:index.php?view=changepassword.php");
} else {
    $msg= "Email and security answer didn't match";
    
    
    echo mysqli_error($conn);
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
        h2 {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="mx-auto text-center mb-5 section-heading">
                <h2>FORGOT PASSWORD</h2>
            </div>
            <br>
        </div>
        <br>  <br>
        <div class="row">
            <div class="col-md-12">
                <form action="" class="form-horizontal" method="post" >

                <div class="form-group">
         <label class="control-label col-sm-2" for="email">Email:<font color="red"><b>*</b></font></label>
         
          <div class="col-sm-8">
          <input type="email" class="form-control" id="email" placeholder="Enter valid email" name="email" value="" required>
          </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-2" for="ans">Answer:<font color="red"><b>*</b></font></label>
         
          <div class="col-sm-8">
          <input type="text" class="form-control" id="ans" placeholder="Enter your answer" name="ans" value="" required>
          </div>
        </div>
      </div>

     
                    
                    <div class=" mx-auto text-center mb-5">
                       
                            <input type="submit" name="submit" class="btn btn-primary" value="GO" />
                            <br><br>
                             <b><label for="message" class="form-group" style="margin:0 auto;"><font color="red"> <?php echo $msg; ?></font></label></b>
                        
                        
                    </div>
                    <br>  <br>  <br>  
                   
                </form>
            </div>
        </div>
    </div>
    <br>  <br><br>  <br> <br>  <br> 
</body>

</html>