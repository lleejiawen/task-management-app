<?php include '../includes/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Customers | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/customers.css">
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
	        	<p class="welcome-message"><h3 class="page-title">Customers</h3></p>
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
			    <a class="btn add-btn" href="customer-add.php">Add</a>
		  	</div>

		  	<div class="filter-search">
				<div class="search">
					<input type="text" id="searchInput" placeholder="Enter keywords to search">
					<button class="btn search-btn" id="search-customer" onclick="search()">Search</button>
					<button class="btn clear-btn" id="clear-search" onclick="clearSearch()">Clear</button>
				</div>
		  	</div>

		  	<div class="container-fluid customers-container">
			    <div class="row customers-table" id="customersContainer">    
			    </div>
		  	</div>
		</div>	
	</div>
</div>

<script>
  	//get all tasks
	function fetchAndDisplayCustomers() {
    fetch('../customers-api/read.php')
        .then(response => response.json())
        .then(customers => {
            document.getElementById('customersContainer').innerHTML = formatData(customers);
        })
        .catch(error => console.error('Error fetching customers:', error));
	}

	//search tasks
	function search() {
		const searchTerm = document.getElementById('searchInput').value;
	    searchAndDisplayCustomers(searchTerm);
	}

	function searchAndDisplayCustomers(searchTerm) {
	    const url = `../customers-api/search.php?search=${encodeURIComponent(searchTerm)}`;
	    fetch(url)
	        .then(response => response.json())
	        .then(search => {
	            document.getElementById('customersContainer').innerHTML = formatData(search);
	        })
	        .catch(error => console.error('Error fetching customers:', error));
	}

	function clearSearch() {
		document.getElementById('searchInput').value = '';
	    searchAndDisplayCustomers('');
	}

	//generate customers table
	function formatData(customers) {
		if (customers.length === 0) {
        	return '<div class="no-result"><p>No customer found.</p></div>';
    	}

	    let html = '<table>';
	    html += '<tr>';
	  	html += '<th style="width: 10%;">Customer ID</th>'; 
	  	html += '<th style="width: 20%;">Customer Name</th>'; 
	  	html += '<th style="width: 20%;">Email</th>'; 
	  	html += '<th style="width: 10%;">Phone</th>'; 
	  	html += '<th style="width: 10%;">Remarks</th>'; 
	  	html += '<th style="width: 10%;"></th>';
	  	html += '</tr>';

    	//all tasks details
    	customers.forEach(customer => {
	    	//format fields
	        const name = formatField(customer.name);
	        const email = formatField(customer.email);
	   		const phone = formatField(customer.phone);
	        const remarks = formatField(customer.remarks);

	      	html += '<tr>';
	      	html += `<td>${customer.id}</td>`;
	      	html += `<td>${name}</td>`;
	      	html += `<td>${email}</td>`;
	      	html += `<td>${phone}</td>`;
	      	html += `<td>${remarks}</td>`;
	      	html += `<td><a class="btn detail-btn" href="customer.php?customer_id=${customer.id}">View</a></td>`;
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

document.addEventListener('DOMContentLoaded', function() {
    fetchAndDisplayCustomers();
});
</script>

</body>
</html>
