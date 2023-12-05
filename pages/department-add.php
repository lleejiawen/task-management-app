<?php 
include '../includes/session.php'; 
include '../includes/db.php';

$get_type = mysqli_query($conn, "SELECT DISTINCT * FROM `user_type`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Department | Task Management Application</title>
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
        <p class="welcome-message"><h3 class="page-title">Add New Department</h3></p>
      </div>
      <div class="container-fluid content-container">
	   		<form action="../department-api/add.php" method="post">
			    <div class="row form-field">
			     	<div class="col-sm-2">
			        <label for="name"><b>Department Name *</b></label>
			      </div>
			      <div class="col-sm-10">
			        <input type="text" name="name" id="name" placeholder="Enter department name" required>
			      </div>
					</div>

					<div class="row form-field">
	        	<div class="col-sm-2">
	 	           <label for="remarks"><b>Remarks</b></label>
	          </div>
	          <div class="col-sm-10">
	    	      <textarea id="remarks" name="remarks" placeholder="Enter remarks"></textarea>
	    	    </div>
					</div>

					<div class="form-button">
						<button type="submit" class="btn submit-btn" name="submit">Save</button>
			      <button type="button" class="btn cancel-btn" name="cancel" onclick="cancelAddDepartment()">Cancel</button>
					</div>
	   		</form>
			</div>
		</div>
	</div>
</div>

<script>
	function cancelAddDepartment() {
        window.location.href = '../pages/department.php';
  	}
</script>

</body>
</html>



