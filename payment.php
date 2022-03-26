<?php
session_start();
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "gamersgarage_db");

$user_id = $_SESSION['user_id'];



$psql = "select * from card where user_id=".$user_id;


if ($_REQUEST['delete']) {
    $checkbox = $_REQUEST['checkbox'];
    $a = implode(",", $checkbox);
    //echo $a;
    mysqli_query($conn, "delete from card where card_id in($a)");
}

$result = mysqli_query($conn, $psql);



if ($_REQUEST['add']) {
    $card_uname = $_REQUEST['card_uname'];
    $card_bank = $_REQUEST['card_bank'];
    $card_number = $_REQUEST['card_number'];
    $card_exmonth = $_REQUEST['card_exmonth'];
    $card_exyear = $_REQUEST['card_exyear'];


    $query = "insert into card(user_id, card_uname, card_bank, card_number, card_exmonth, card_exyear) 
   values ('$user_id','$card_uname','$card_bank','$card_number','$card_exmonth','$card_exyear')";

   $res = mysqli_query($conn, $query);
   if ($res) {
       header("location:index.php?view=payment.php");
   } else {
       echo mysqli_error($conn);
   }
    
}


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

        #addnew {
            border: 1px solid black;
            width: 40%;
           
            border-collapse: collapse;
        }

        #addnew td {
           
            padding: 8px;
            width: 200px;
        }

        #addnew tr:hover {background-color: #f5f5f5;}

        #dropdown{
            width: 172px;
            height: 25px;
        }
    </style>
    <style>
        h2 {
            text-decoration: underline;
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
<div class="container-fluid">
        <form method="post">
            <div class=" mx-auto text-center mb-5 section-heading">
            <br><h2>PAYMENT DETAILS</h2>
            </div>
            <br>
           
            <br>
            <table  class="table">
                <thead>
                    <tr>
                        <th>Bank</th> 
                        <th>Name</th>
                        <th>Card Number</th>
                        <th>Ex. Month</th>
                        <th>Ex. Year</th> 
                        <th></th>
                        <th align="center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $rows['card_bank']; ?></td>
                            <td><?php echo $rows['card_uname']; ?></td>
                            <td><?php echo $rows['card_number']; ?></td>
                            <td><?php echo $rows['card_exmonth']; ?></td>
                            <td><?php echo $rows['card_exyear']; ?></td>
                            
                            <td align="center">
                                <button type="button" name="edit" class="btn btn-success"><a href="#">
                                        <font color=white>Pay</font>
                                    </a>
                                </button>
                            </td>
                            <td align="center">
                                <input type="Checkbox" name="checkbox[]" value="<?php echo $rows['card_id']; ?>">
                            </td>
                        </tr>
                    <?php

                    }
                    ?>
                    <tr>
                        <th colspan="6"></th>
                        <td align="center">
                            <input type="submit" name="delete" class="btn btn-danger" value="Delete" >
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>

    
<br>
<center>
<h3> <b>ADD NEW CARD </b></h3>
<br>
<table id="addnew" >
    <tr> <td> <label class="control-label col-sm-8" for="card_uname">Holder Name:</label></td>
    <td align="right"> <input type="text" name="card_uname" placeholder="Enter name" required></td> </tr>

    <tr> <td> <label class="control-label col-sm-8" for="card_number">Number:</label></td>
    <td align="right"> <input type="number" name="card_number" placeholder="Enter number" required ></td> </tr>



    <tr> <td> <label class="control-label col-sm-8" for="card_exyear">Expiry Year:</label></td>
    <td align="right"> <input type="number" name="card_exyear" placeholder="Enter year" required></td> </tr>


    </td> </tr>

    <tr> <td> <label class="control-label col-sm-8" for="card_exmonth">Expiry Month:</label></td>
    <td align="right">
    <select id="dropdown" name="card_exmonth" required>
            <option value="">Select expiry month</option>
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
            
            
    </select>

    </td> </tr>

    <tr> <td> <label class="control-label col-sm-8" for="card_bank">Bank:</label></td>
    <td align="right"> 
    

    <select id="dropdown" name="card_bank" required>
            <option value="">Select your bank</option>
            <option value="HDFC Bank">HDFC Bank</option>
            <option value="YES Bank">YES Bank</option>
            <option value="ICICI Bank">ICICI Bank</option>
            <option value="SBI">SBI</option>
    </select>

    </td> </tr>
    
    

    

   



</table>
<br>
<input type="submit" name="add" class="btn btn-success" value="ADD" >
</center>

<br> <br>


  
    </form>
   
                </body>
</html>