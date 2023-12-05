<?php include '../includes/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Tasks | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/tasks.css">
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
        <p class="welcome-message"><h3 class="page-title">Tasks</h3></p>
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
	    <a class="btn add-btn" href="task-add.php">Add</a>
  	</div>

	<div class="filter-search">
		<div class="search">
			<input type="text" id="searchInput" placeholder="Enter keywords to search">
			<button class="btn search-btn" id="search-task" onclick="search()">Search</button>
			<button class="btn clear-btn" id="clear-search" onclick="clearSearch()">Clear</button>
		</div>
		<div class="filter">
			<select id="assignedFilter" onchange="applyFilters()"> 
				<option value="">- Select Assigned To -</option>
			</select>
			
			<select id="priorityFilter" onchange="applyFilters()"> 
				<option value="">- Select Task Priority -</option>
			</select>

			<select id="statusFilter" onchange="applyFilters()"> 
				<option value="">- Select Task Status -</option>
			</select>
		</div>
  	</div>

  	<div class="container-fluid tasks-container">
	    <div class="row tasks-table" id="tasksContainer">    
	    </div>
  	</div>
  </div>
</div>

<script>
  	//get all tasks
	function fetchAndDisplayTasks() {
    fetch('../tasks-api/read.php')
        .then(response => response.json())
        .then(tasks => {
            document.getElementById('tasksContainer').innerHTML = formatTasks(tasks);
        })
        .catch(error => console.error('Error fetching tasks:', error));
	}

	//search tasks
	function search() {
		const searchTerm = document.getElementById('searchInput').value;
	    searchAndDisplayTasks(searchTerm);
	}

	function searchAndDisplayTasks(searchTerm) {
	    const url = `../tasks-api/search.php?search=${encodeURIComponent(searchTerm)}`;

	    fetch(url)
	        .then(response => response.json())
	        .then(search => {
	            document.getElementById('tasksContainer').innerHTML = formatTasks(search);
	        })
	        .catch(error => console.error('Error fetching tasks:', error));
	}

	function clearSearch() {
		document.getElementById('searchInput').value = '';
		document.getElementById('statusFilter').value = '';
		document.getElementById('priorityFilter').value = '';
		document.getElementById('assignedFilter').value = '';
	    searchAndDisplayTasks('');
	}

	//generate tasks table
	function formatTasks(tasks) {
		if (tasks.length === 0) {
        	return '<div class="no-result"><p>No task found.</p></div>';
    	}

	    let html = '<table>';
	    html += '<tr>';
	  	html += '<th style="width: 5%;">ID</th>'; 
	  	html += '<th style="width: 10%;">Task Name</th>'; 
	  	html += '<th style="width: 15%;">Description</th>'; 
	  	html += '<th style="width: 10%;">Assigned To</th>'; 
	  	html += '<th style="width: 10%;">Priority</th>'; 
	  	html += '<th style="width: 10%;">Status</th>'; 
	  	html += '<th style="width: 5%;"></th>';
	  	html += '</tr>';

    	//all tasks details
    	tasks.forEach(task => {
	    	//format fields
	        const task_name = formatField(task.task_name);
	        const task_description = formatField(task.task_description);
	        const assigned_to = formatField(task.assigned_to);
	   		const task_priority = formatField(task.task_priority);
	        const task_status = formatField(task.task_status);

	      	html += '<tr>';
	      	html += `<td>${task.id}</td>`;
	      	html += `<td>${task_name}</td>`;
	      	html += `<td>${task_description}</td>`;
	      	html += `<td>${assigned_to}</td>`;
	      	html += `<td><span class="display-btn ${getPriorityClass(task.task_priority)}">${task_priority}</span></td>`;
	      	html += `<td><span class="display-btn ${getStatusClass(task.task_status)}">${task_status}</span></td>`;
	      	html += `<td><a class="btn detail-btn" href="task.php?task_id=${task.id}">Details</a></td>`;
	      	html += '</tr>';
	    });
	    
	    html += '</table>';
	    return html;
	  }

	// display '-'' if null
	function formatField(value) {
		return value ? value : '-';
	}

  	function getPriorityClass(priority) {
	  	switch (priority) {
	    	case 'Low':
		      return 'low-priority';
		    case 'Medium':
		      return 'medium-priority';
		    case 'High':
		      return 'high-priority';
		    default:
		      return 'default-priority';
		}
	}

	function getStatusClass(status) {
	  	switch (status) {
	    	case 'Open':
		      return 'open-status';
		    case 'In Progress':
		      return 'in-progress-status';
		    case 'Completed':
		      return 'completed-status';
		    default:
		      return 'default-status';
		}
	}

	function applyFilters() {
	    const priorityFilter = document.getElementById('priorityFilter').value;
	    const statusFilter = document.getElementById('statusFilter').value;
	    const assignedFilter = document.getElementById('assignedFilter').value;
	    const url = `../tasks-api/filter.php?priority=${encodeURIComponent(priorityFilter)}&status=${encodeURIComponent(statusFilter)}&assigned=${encodeURIComponent(assignedFilter)}`;
	    fetch(url)
	        .then(response => response.json())
	        .then(filtered => {
	            document.getElementById('tasksContainer').innerHTML = formatTasks(filtered);
	        })
	        .catch(error => console.error('Error fetching tasks:', error));
	}

  // Load and display tasks when the page loads
  document.addEventListener('DOMContentLoaded', function() {
    fetch('../tasks-api/get_priority_filter.php')
        .then(response => response.json())
        .then(options => {
            const priorityDropdown = document.getElementById('priorityFilter');
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.priority;
                priorityDropdown.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Error fetching priority options:', error));

    fetch('../tasks-api/get_status_filter.php')
        .then(response => response.json())
        .then(options => {
            const statusDropdown = document.getElementById('statusFilter');
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.status;
                statusDropdown.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Error fetching priority options:', error));

    fetch('../tasks-api/get_user_filter.php')
        .then(response => response.json())
        .then(options => {
            const assignedDropdown = document.getElementById('assignedFilter');
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.full_name;
                assignedDropdown.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Error fetching assigned to options:', error));    

    // Call fetchAndDisplayTasks or any other initialization function here
    fetchAndDisplayTasks();
});

  

</script>

</body>
</html>
