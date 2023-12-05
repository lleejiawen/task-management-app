<?php 
include '../includes/session.php'; 
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Change Password | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
<div class="container-fluid main-content" id="mainContent">
	<div class="row content">
		<div class="col-sm-3 nav-col">
      <!-- include navigation-->
      <?php include '../includes/nav.php'; ?>
    </div>
    <div class="col-sm-9 content-col">
      <div class="welcome-container">
        <p class="welcome-message"><h3 class="page-title">Change Password</h3></p>
      </div>
      <div class="content-container">
		   	<form action="../users-api/change-password.php" method="post">   
			    <div class="row form-field">
			      <div class="col-sm-2">
			        <label for="name"><b>Current Password *</b></label>
			      </div>
			      <div class="col-sm-10">
			        <input type="text" name="current" id="current" placeholder="Enter current password" required>
			      </div>
					</div>

					<div class="row form-field">
			      <div class="col-sm-2">
			      	<label for="name"><b>New Password *</b></label>
			     	</div>
			      <div class="col-sm-10">
			        <input type="text" name="new" id="new" placeholder="Enter new password" required>
			      </div>
					</div>

					<input type="hidden" name="user_id" value="<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : null; ?>">

					<div class="form-button">
						<button type="submit" class="btn submit-btn" name="submit">Save</button>
			        <button type="button" class="btn cancel-btn" name="cancel" onclick="cancelChange()">Cancel</button>
					</div>
		   	</form>
		   	<input type="hidden" name="redirect" id="redirect" value="<?php echo $_SESSION['user_id'] == $_GET['user_id'];?>">
			</div>
    </div>
	</div>
</div>
<script>
	function cancelChange() {
		if(document.getElementById('redirect').value = 1){
			window.location.href = '../pages/profile.php';
		}else{
			window.location.href = '../pages/users.php';
	  }  
	}
</script>

</body>
</html>



