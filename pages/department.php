<?php include '../includes/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Department | Task Management Application</title>
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
  <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1 ) { ?>
  	<div class="row content">
  		<div class="col-sm-3 nav-col">
	      	<!-- include navigation-->
	      	<?php include '../includes/nav.php'; ?>
	    </div>
	    <div class="col-sm-9 content-col">
	      	<div class="welcome-container">
	        	<p class="welcome-message"><h3 class="page-title">Departments</h3></p>
		    </div>

		    <?php 
		  		if (isset($_SESSION['success_message'])) { ?>
		  		<div class="alert-group success-message">
					<p><?php echo $_SESSION['success_message']; ?></p>    
				</div>
		  		<?php unset($_SESSION['success_message']);
		  		}

		  		if (isset($_SESSION['error_message'])) { ?>
		  		<div class="alert-group error-message">
					<p><?php echo $_SESSION['error_message']; ?></p>    
				</div>
		  		<?php unset($_SESSION['error_message']);
		  		}
		 	?>

		 	<div class="action-group">
			    <a class="btn back-btn" href="../pages/dashboard.php">Back</a>  
			    <a class="btn add-btn" href="department-add.php">Add</a>
		  	</div>

		  	<div class="container-fluid users-container">
			    <div class="row users-table" id="usersContainer"> 
			    </div>
		  	</div>
		  <?php } else{ ?>
		  	<div class="alert-group error-message">
				<p><b>Access Denied</b></p>
				<p>Sorry, you do not have the required permissions to view this page. This section is restricted to admin users only.</p>
			</div>
		  <?php } ?>
  	</div>
  </div>
</div>

<script>
  	//get all tasks
	function fetchAndDisplayDepartments() {
    fetch('../department-api/read.php')
        .then(response => response.json())
        .then(departments => {
            document.getElementById('usersContainer').innerHTML = formatData(departments);
        })
        .catch(error => console.error('Error fetching departments:', error));
	}

	//generate users table
	function formatData(departments) {
		if (departments.length === 0) {
        	return '<div class="no-result"><p>No department found.</p></div>';
    	}

	    let html = '<table>';
	    html += '<tr>';
	  	html += '<th style="width: 5%;">Department ID</th>'; 
	  	html += '<th style="width: 20%;">Department Name</th>'; 
	  	html += '<th style="width: 20%;">Remarks</th>'; 
	  	html += '<th style="width: 10%;"></th>';
	  	html += '</tr>';

    	//all tasks details
    	departments.forEach(department => {
	    	//format fields
	        const name = formatField(department.name);
	        const remarks = formatField(department.remarks);

	      	html += '<tr>';
	      	html += `<td>${department.id}</td>`;
	      	html += `<td>${name}</td>`;
	      	html += `<td>${remarks}</td>`;
	      	html += `<td class="action-btn"><a class="btn edit-btn" href="department-edit.php?department_id=${department.id}">Edit</a><a class="btn delete-btn" href="#" onclick="confirmDelete(${department.id});">Delete</a></td>`;
	      	html += '</tr>';
	    });
	    
	    html += '</table>';
	    return html;
	  }

	// display '-'' if null
	function formatField(value) {
		return value ? value : '-';
	}

	function confirmDelete(id) {
	    var confirmDelete = confirm("Are you sure you want to delete this department?");
	    if (confirmDelete) {
	      window.location.href = `../department-api/delete.php?department_id=${id}`;
	    }
	  }

document.addEventListener('DOMContentLoaded', function() {
    fetchAndDisplayDepartments();
});
</script>

</body>
</html>
