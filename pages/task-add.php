<?php 
include '../includes/session.php'; 
include '../includes/db.php';

//get options from db
$get_users = mysqli_query($conn, "SELECT DISTINCT * FROM `users`");
$get_priority = mysqli_query($conn, "SELECT DISTINCT * FROM `tasks_priority`");
$get_status = mysqli_query($conn, "SELECT DISTINCT * FROM `tasks_status`");
$get_customer = mysqli_query($conn, "SELECT DISTINCT * FROM `customer`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Task | Task Management Application</title>
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
        <p class="welcome-message"><h3 class="page-title">Add New Task</h3></p>
      </div>
			<div class="content-container">
	   		<form action="../tasks-api/add.php" method="post">
	       	<div class="row form-field">
	        	<div class="col-sm-2">
	        		<label for="task_name"><b>Task Name *</b></label>
	        	</div>
	          <div class="col-sm-10">
	            <input type="text" name="task_name" id="task_name" placeholder="Enter task name" required>
	          </div>
					</div>

					<div class="row form-field">
	        	<div class="col-sm-2">
	 	           <label for="task_description"><b>Description *</b></label>
	          </div>
	          <div class="col-sm-10">
	    	      <textarea id="task_description" name="task_description" placeholder="Enter task description" required></textarea>
	    	    </div>
					</div>

					<div class="row form-field">
	        	<div class="col-sm-2">
	           	<label for="assigned_to"><b>Assigned To</b></label>
	          </div>
	          <div class="col-sm-10">
	           	<select name="assigned_to">		            	
		           	<?php  while ($users = mysqli_fetch_array($get_users,MYSQLI_ASSOC)){ ?>
		              <option value="<?php echo $users["id"];?>">
		                <?php echo $users["full_name"]; ?>
		              </option>
			          <?php } ?>
		        	</select>
		        </div>
					</div>

					<div class="row form-field">
	        	<div class="col-sm-2">
	            <label for="priority"><b>Priority</b></label>
	          </div>
	          <div class="col-sm-10">
		          <select name="priority">		            	
		         	<?php  while ($priority = mysqli_fetch_array($get_priority,MYSQLI_ASSOC)){ ?>
		            <option value="<?php echo $priority["id"];?>">
                  <?php echo $priority["priority"]; ?>
	              </option>
	            <?php } ?>
		        	</select>
		        </div>
					</div>

					<div class="row form-field">
	        	<div class="col-sm-2">
	           	<label for="status"><b>Status</b></label>
	          </div>
	          <div class="col-sm-10">
		          <select name="status">		            	
		          <?php  while ($status = mysqli_fetch_array($get_status,MYSQLI_ASSOC)){ ?>
		           <option value="<?php echo $status["id"];?>">
		             	<?php echo $status["status"]; ?>
		           </option>
			        <?php } ?>
		        </select>
		        </div>
					</div>

					<div class="row form-field">
	        	<div class="col-sm-2">
	           	<label for="completion_date"><b>Completion Date</b></label>
	          </div>
	     	    <div class="col-sm-10">
	          	<input type="date" id="completion_date" name="completion_date">
	          </div>
					</div>

					<div class="row form-field">
	        	<div class="col-sm-2">
	            <label for="comments"><b>Comments</b></label>
	          </div>
	          <div class="col-sm-10">
	          	<textarea id="comments" name="comments" placeholder="Enter comments"></textarea>
	          </div>
					</div>

					<div class="row form-field">
	        	<div class="col-sm-2">
	            <label for="customer_info"><b>Customer Information</b></label>
	          </div>
	          <div class="col-sm-10">
	           	<select name="customer_info">		            	
		            <?php  while ($customer = mysqli_fetch_array($get_customer,MYSQLI_ASSOC)){ ?>
		              <option value="<?php echo $customer["id"];?>">
		                <?php echo $customer["name"]; ?>
		              </option>
			           <?php } ?>
		        	</select>
	         	</div>
					</div>

				<div class="form-button">
					<button type="submit" class="btn submit-btn" name="submit">Save</button>
		        	<button type="button" class="btn cancel-btn" name="cancel" onclick="cancelAddTask()">Cancel</button>
				</div>
		   	</form>
			</div>
		</div>
  </div>
</div>

<script>
	function cancelAddTask() {
        window.location.href = '../pages/tasks.php';
  	}
</script>

</body>
</html>



