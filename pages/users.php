<?php include '../includes/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Users | Task Management Application</title>
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
	        	<p class="welcome-message"><h3 class="page-title">Users</h3></p>
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
			    <a class="btn add-btn" href="user-add.php">Add</a>
		  	</div>

		  	<div class="filter-search">
				<div class="search">
					<input type="text" id="searchInput" placeholder="Enter keywords to search">
					<button class="btn search-btn" id="search-user" onclick="search()">Search</button>
					<button class="btn clear-btn" id="clear-search" onclick="clearSearch()">Clear</button>
				</div>
				<div class="filter">
					<select id="typeFilter" onchange="applyFilters()"> 
						<option value="">- Select User Type -</option>
					</select>

					<select id="departmentFilter" onchange="applyFilters()"> 
						<option value="">- Select User Department -</option>
					</select>
				</div>
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
	function fetchAndDisplayUsers() {
    fetch('../users-api/read.php')
        .then(response => response.json())
        .then(users => {
            document.getElementById('usersContainer').innerHTML = formatData(users);
        })
        .catch(error => console.error('Error fetching customers:', error));
	}

	//search tasks
	function search() {
		const searchTerm = document.getElementById('searchInput').value;
	    searchAndDisplayUsers(searchTerm);
	}

	function searchAndDisplayUsers(searchTerm) {
	    const url = `../users-api/search.php?search=${encodeURIComponent(searchTerm)}`;
	    fetch(url)
	        .then(response => response.json())
	        .then(search => {
	            document.getElementById('usersContainer').innerHTML = formatData(search);
	        })
	        .catch(error => console.error('Error fetching users:', error));
	}

	function clearSearch() {
		document.getElementById('searchInput').value = '';
		document.getElementById('typeFilter').value = '';
		document.getElementById('departmentFilter').value = '';
	    searchAndDisplayUsers('');
	}

	//generate users table
	function formatData(users) {
		if (users.length === 0) {
        	return '<div class="no-result"><p>No user found.</p></div>';
    	}

	    let html = '<table>';
	    html += '<tr>';
	  	html += '<th style="width: 5%;">User ID</th>'; 
	  	html += '<th style="width: 20%;">Username</th>'; 
	  	html += '<th style="width: 20%;">Full Name</th>'; 
	  	html += '<th style="width: 10%;">Email</th>'; 
	  	html += '<th style="width: 10%;">Department</th>'; 
	  	html += '<th style="width: 10%;">User Type</th>'; 
	  	html += '<th style="width: 10%;"></th>';
	  	html += '</tr>';

    	//all tasks details
    	users.forEach(user => {
	    	//format fields
	        const username = formatField(user.username);
	        const full_name = formatField(user.full_name);
	   		const email = formatField(user.email);
	   		const user_department_name = formatField(user.user_department_name);
	   		const user_type_name = formatField(user.user_type_name);

	      	html += '<tr>';
	      	html += `<td>${user.id}</td>`;
	      	html += `<td>${username}</td>`;
	      	html += `<td>${full_name}</td>`;
	      	html += `<td>${email}</td>`;
	      	html += `<td>${user_department_name}</td>`;
	      	html += `<td>${user_type_name}</td>`;
	      	html += `<td><a class="btn detail-btn" href="user.php?user_id=${user.id}">View</a></td>`;
	      	html += '</tr>';
	    });
	    
	    html += '</table>';
	    return html;
	  }

	// display '-'' if null
	function formatField(value) {
		return value ? value : '-';
	}

	 // date format dd-mm-yyyy
	function formatDateString(timestamp) {
	  	if (!timestamp) {
	        return '-';
	    }
		const date = new Date(timestamp * 1000);
	    if (isNaN(date)) {
	        return '-';
	    }
		const options = { timeZone: 'Asia/Kuala_Lumpur', day: '2-digit', month: '2-digit', year: 'numeric' };
		const formattedDate = date.toLocaleDateString('en-GB', options);
	    return formattedDate;
	}

	function applyFilters() {
	    const typeFilter = document.getElementById('typeFilter').value;
	    const departmentFilter = document.getElementById('departmentFilter').value;
	    const url = `../users-api/filter.php?type=${encodeURIComponent(typeFilter)}&department=${encodeURIComponent(departmentFilter)}`;
	    fetch(url)
	        .then(response => response.json())
	        .then(filtered => {
	            document.getElementById('usersContainer').innerHTML = formatData(filtered);
	        })
	        .catch(error => console.error('Error fetching users:', error));
	}


document.addEventListener('DOMContentLoaded', function() {

	fetch('../users-api/get_user_type.php')
        .then(response => response.json())
        .then(options => {
            const typeDropdown = document.getElementById('typeFilter');
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.user_type;
                typeDropdown.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Error fetching user type options:', error));

    fetch('../users-api/get_user_department.php')
        .then(response => response.json())
        .then(options => {
            const departmentDropdown = document.getElementById('departmentFilter');
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.name;
                departmentDropdown.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Error fetching user department options:', error));

    fetchAndDisplayUsers();
});
</script>

</body>
</html>
