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
                <h2>CREATE NEW PASSWORD</h2>
            </div>
            <br>
        </div>
        <br> <br>
        <div class="row">
            <div class="col-md-12">
                <form action="" class="form-horizontal" method="post">




                    <div class="form-group">
                        <label class="control-label col-sm-2" for="user_name">New Password:<font color="red"><b>*</b></font></label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="user_name" placeholder="Enter username" name="user_name" value="<?= $row['user_name']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="user_password">Confirm Password:<font color="red"><b>*</b></font></label>

                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="user_password" placeholder="Enter password" name="user_password" value="<?= $row['user_password']; ?>" required>
                        </div>
                    </div>
                    <br>


                    <div class=" mx-auto text-center mb-5">

                        <input type="submit" name="submit" class="btn btn-primary" value="SAVE" />

                    </div>
                    <br> <br> <br>

                </form>
            </div>
        </div>
    </div>
    <br><br><br>
</body>

</html>