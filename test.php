<?php
ini_set("display_errors", "OFF");
$conn = mysqli_connect("localhost", "root", "", "videogame");


$country_id=$_REQUEST['country_id'];

?>

<select class="form-control" id="state_id" name="state_id" value="<?=$row['state_id'];?>" required>


<?php

          $ssql = "select * from state where country_id=".$country_id;
          $sres = mysqli_query($conn, $ssql);
          while ($srow = mysqli_fetch_array($sres)) {
          ?>
            <option <?php if ($row['state_id'] == $srow[0]) print "selected"; ?> value="<?= $srow[0]; ?>"><?= $srow[1]; ?></option>

          <?php  }  ?>

        </select>