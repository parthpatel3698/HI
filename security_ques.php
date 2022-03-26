<?php
session_start();
ini_set("display_errors","OFF");
$conn=mysqli_connect("localhost","root","","videogame");
$user_id=$_SESSION['user_id'];

if($_REQUEST['email'])
{
 $email = $_REQUEST['email'];
}

if($_REQUEST['submit'])
{

$secq=addslashes($_REQUEST['secq']);
$ans=md5($_REQUEST['ans']);


 $sql="insert into sec_ques (user_email, sec_ans, sec_que) values ('$email','$ans','$secq')";


$res=mysqli_query($conn,$sql);

if ($res) {
    header("location:index.php?view=welome.php");
} else {
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
                <h2>SECURITY QUESTION</h2>
            </div>
            <br>
        </div>
        <br>  <br>
        <div class="row">
            <div class="col-md-12">
                <form action="" class="form-horizontal" method="post" >


        <div class="form-group">
         <label class="control-label col-sm-2" for="secq">Security question:<font color="red"><b>*</b></font></label>
         
          <div class="col-sm-8">
          <select class="form-control" id="secq" name="secq" required>
                <option value="Mother's lastname">Mothers lastname</option>
                <option value="Favourite actor">Favourite actor</option>
                <option value="Pet name">Pet name</option>
                <option value="Smartphone brand">Smartphone brand</option>
          </select>
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
                            
                    </div>
                    <br>  <br>  <br>  
                   
                </form>
            </div>
        </div>
    </div>
    <br>  <br><br>  <br> <br>  <br> 
</body>

</html>