<?php 
include '../includes/session.php'; 
include '../includes/db.php';

$get_type = mysqli_query($conn, "SELECT DISTINCT * FROM `user_type`");
$get_department = mysqli_query($conn, "SELECT DISTINCT * FROM `user_department`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add User | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/users.css">
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
        <p class="welcome-message"><h3 class="page-title">Add New User</h3></p>
      </div>
      <div class="container-fluid content-container">
	   		<form action="../users-api/add.php" method="post">
			    <div class="row form-field">
			     	<div class="col-sm-2">
			        <label for="name"><b>Username *</b></label>
			      </div>
			      <div class="col-sm-10">
			        <input type="text" name="username" id="username" placeholder="Enter username" required>
			      </div>
					</div>

					<div class="row form-field">
			      <div class="col-sm-2">
			        <label for="name"><b>Full Name *</b></label>
			      </div>
			      <div class="col-sm-10">
			        <input type="text" name="full_name" id="full_name" placeholder="Enter full name" required>
			      </div>
					</div>

					<div class="row form-field">
			      <div class="col-sm-2">
			 	      <label for="email"><b>Email *</b></label>
			      </div>
			      <div class="col-sm-10">
			        <input type="email" name="email" id="email" placeholder="Enter customer email" required>
			    	</div>
					</div>

					<div class="row form-field">
			      <div class="col-sm-2">
			        <label for="name"><b>Password *</b></label>
			      </div>
			      <div class="col-sm-10">
			        <input type="text" name="password" id="password" placeholder="Enter password" required>
			      </div>
					</div>

					<div class="row form-field">
			      <div class="col-sm-2">
			        <label for="user_department"><b>Department *</b></label>
			      </div>
			      <div class="col-sm-10">
				      <select name="user_department">		            	
				      <?php  while ($department = mysqli_fetch_array($get_department,MYSQLI_ASSOC)){ ?>
				        <option value="<?php echo $department["id"];?>">
				          <?php echo $department["name"]; ?>
				        </option>
					    <?php } ?>
				      </select>
				    </div>
					</div>

					<div class="row form-field">
			      <div class="col-sm-2">
			        <label for="user_type"><b>User Type *</b></label>
			      </div>
			      <div class="col-sm-10">
				      <select name="user_type">		            	
				      <?php  while ($type = mysqli_fetch_array($get_type,MYSQLI_ASSOC)){ ?>
				        <option value="<?php echo $type["id"];?>">
				          <?php echo $type["user_type"]; ?>
				        </option>
					    <?php } ?>
				      </select>
				    </div>
					</div>

					<div class="form-button">
						<button type="submit" class="btn submit-btn" name="submit">Save</button>
			      <button type="button" class="btn cancel-btn" name="cancel" onclick="cancelAddUser()">Cancel</button>
					</div>
	   		</form>
			</div>
		</div>
	</div>
</div>

<script>
	function cancelAddUser() {
        window.location.href = '../pages/users.php';
  	}
</script>

</body>
</html>



