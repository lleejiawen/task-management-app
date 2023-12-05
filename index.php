<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body class="index-body">
   <div class="container-fluid">
   	<div class="row content">
         <div class="col-sm-4 col-sm-offset-4">

             <?php 
               if (isset($_SESSION['error_message'])) { ?>
                  <div class="alert-group error-message">

                     <p><?php echo $_SESSION['error_message']; ?></p>    
                  </div>
                  <?php unset($_SESSION['error_message']);
               }
              ?>
          	
            <div class="login">
          		<div class="login-title">
                  <h3>Task Management Application</h3>
               </div>

               <div class="login-form">
                  <form action="includes/login.php" method="post">
                     <div class="form-field">
                        <label for="username"><b>Username</b></label>
                        <input type="text" name="username" id="username" placeholder="Enter your username" required>
                     </div>
                     <div class="form-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                     </div>
                     
                     <div class="form-button">
                        <button type="submit" class="btn submit-btn" name="login">Login</button>
                     </div>

                  </form>
              	</div>
          	</div>   
          </div>
      </div>
   </div>
</body>
</html>