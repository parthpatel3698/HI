<head>

<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: red; /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid black;
  width: 60%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

    </style>
</head>
<center>

<!-- Trigger/Open The Modal -->
<button id="myBtn" class="btn btn-success">Checkout</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3> PAYMENT DETAILS </h3>
    <form method="post" class="form-horizontal">



<div class="form-group">
         <label class="control-label col-sm-2" for="user_name">Username:<font color="red"><b>*</b></font></label>
         
          <div class="col-sm-8">
          <input type="text" class="form-control" id="user_name" placeholder="Enter username" name="user_name"  required>
          </div>
        </div>
<br>
      <div class="form-group">
        <label class="control-label col-sm-2" for="user_password">Password:<font color="red"><b>*</b></font></label>
        
          <div class="col-sm-8">
        <input type="password" class="form-control" id="user_password" placeholder="Enter password" 
        name="user_password"  required>
        
    </div>
      </div>

      <center>
                        <input type="submit" name="submit"  value="sumbit" class="btn btn-success">
                        
                        
                    </center>
    </form>
  </div>

</div>

</center>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>