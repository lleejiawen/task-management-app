<?php 
include '../includes/session.php'; 
include '../includes/db.php';

$customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : null;

if ($customer_id) {
    $get_details = mysqli_query($conn, 
      "SELECT * FROM `customer` WHERE id=$customer_id
      ");
    if ($get_details) {
        $customer = mysqli_fetch_assoc($get_details);
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Customer | Task Management Application</title>
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
        <p class="welcome-message"><h3 class="page-title">Edit Customer: <?php echo $customer_id; ?></h3></p>
      </div>

      <div class="content-container">
		   <form action="../customers-api/update.php" method="post">
		      <div class="row form-field">
		        <div class="col-sm-2">
		        	<label for="name"><b>Customer Name *</b></label>
		        </div>
		        <div class="col-sm-10">
		          <input type="text" name="name" id="name" placeholder="Enter customer name" value="<?php echo $customer['name']; ?>" required>
		        </div>
					</div>

					<div class="row form-field">
		        <div class="col-sm-2">
		 	        <label for="email"><b>Email *</b></label>
		        </div>
		        <div class="col-sm-10">
		          <input type="email" name="email" id="email" placeholder="Enter customer email" value="<?php echo $customer['email']; ?>" required>
		    	  </div>
					</div>

					<div class="row form-field">
		       	<div class="col-sm-2">
		 	        <label for="email"><b>Phone *</b></label>
		        </div>
		        <div class="col-sm-10">
		          <input type="tel" name="phone" id="phone" placeholder="Enter customer phone" pattern="[689]\d{7,}$" value="<?php echo $customer['phone']; ?>" required>
		    	  </div>
					</div>

					<div class="row form-field">
		       	<div class="col-sm-2">
		          <label for="remarks"><b>Remarks</b></label>
		        </div>
		        <div class="col-sm-10">
		          <textarea id="remarks" name="remarks" placeholder="Enter remarks"><?php echo $customer['remarks']; ?></textarea>
		        </div>
					</div>

					<input type="hidden" name="customer_id" value="<?php echo $customer['id']; ?>">

					<div class="form-button">
						<button type="submit" class="btn submit-btn" name="submit">Save</button>
			      <button type="button" class="btn cancel-btn" name="cancel" onclick="cancelEditCustomer()">Cancel</button>
					</div>
		   </form>
			</div>
		</div>
	</div>
</div>

<script>
	function cancelEditCustomer() {
			window.location.href = '../pages/customer.php?customer_id=<?php echo $customer_id; ?>';  	}
</script>

</body>
</html>



