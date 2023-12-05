<?php 
include '../includes/session.php'; 
include '../includes/db.php';

$get_type = mysqli_query($conn, "SELECT DISTINCT * FROM `user_type`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Department | Task Management Application</title>
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
	<?php 
		$department_id = isset($_GET['department_id']) ? $_GET['department_id'] : null;
	  	$result = mysqli_query($conn, "SELECT * FROM `user_department` WHERE id=$department_id"); 
  	?>
  	<div class="row content">
	  	<div class="col-sm-3 nav-col">
	      <!-- include navigation-->
	      <?php include '../includes/nav.php'; ?>
	    </div>
	    <div class="col-sm-9 content-col">
	      	<div class="welcome-container">
	        	<p class="welcome-message"><h3 class="page-title">Edit Department: <?php echo $department_id; ?></h3></p>
	      	</div>
		  	<div class="content-container">
		 		 <?php  
		 		    if ($result && mysqli_num_rows($result) > 0) {
		        	$department = mysqli_fetch_assoc($result);
		    	?>
			   <form action="../department-api/update.php" method="post"> 
			    	<div class="row form-field">
				     	<div class="col-sm-2">
					        <label for="name"><b>Department Name *</b></label>
					    </div>
					    <div class="col-sm-10">
					        <input type="text" name="name" id="name" placeholder="Enter department name" value="<?php echo $department['name']; ?>" required>
					    </div>
					</div>

					<div class="row form-field">
			        	<div class="col-sm-2">
			 	           	<label for="remarks"><b>Remarks</b></label>
			          	</div>
			          	<div class="col-sm-10">
			    	      <textarea id="remarks" name="remarks" placeholder="Enter remarks"><?php echo $department['remarks']; ?></textarea>
			    	    </div>
					</div>

					<input type="hidden" name="department_id" value="<?php echo $department['id']; ?>">

					<div class="form-button">
						<button type="submit" class="btn submit-btn" name="submit">Save</button>
			        	<button type="button" class="btn cancel-btn" name="cancel" onclick="cancelEditDepartment()">Cancel</button>
					</div>
			   </form>
		   <?php } ?>
			</div>
	  	</div>
	</div>
</div>

<script>
	function cancelEditDepartment() {
        window.location.href = '../pages/department.php';
  	}
</script>

</body>
</html>



