<?php 
include '../includes/session.php'; 
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Profile | Task Management Application</title>
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
        <p class="welcome-message"><h3 class="page-title">Edit Profile</h3></p>
      </div>
      <?php
        $user_id = $_SESSION['user_id'];
        $result = mysqli_query($conn, "SELECT * FROM `users` WHERE id=$user_id");

        ?>
        <div class="content-container">
          <?php 
            if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
          ?>
         <form action="../profile-api/update.php" method="post">
             
            <div class="row form-field">
              <div class="col-sm-2">
                <label for="task_name"><b>Username</b></label>
              </div>
              <div class="col-sm-10">
                <input type="text" name="username" id="username" placeholder="Enter username" value="<?php echo $user['username']; ?>" required>
              </div>
            </div>

            <div class="row form-field">
              <div class="col-sm-2">
                <label for="task_description"><b>Full Name</b></label>
              </div>
              <div class="col-sm-10">
               <input type="text" name="full_name" class="readonly" id="full_name" placeholder="Enter full name" value="<?php echo $user['full_name']; ?>" required readonly>
              </div>
            </div>

            <div class="row form-field">
              <div class="col-sm-2">
                <label for="task_description"><b>Email</b></label>
              </div>
              <div class="col-sm-10">
                <input type="text" name="email" class="readonly" id="email" placeholder="Enter email" value="<?php echo $user['email']; ?>" required readonly>
              </div>
            </div>

            <div class="row form-field">
              <div class="col-sm-2">
                <label for="created_at"><b>Created At</b></label>
              </div>
              <div class="col-sm-10">
              <?php 
                $created_at_timestamp = ($user["created_at"] != '-') ? (int)$user["created_at"] : null;
                      
                if ($created_at_timestamp !== null && $created_at_timestamp > 0) {
                  $formatted = (new DateTime())->setTimestamp($created_at_timestamp)->format('Y-m-d');
                }
              ?>
                <input type="date" class="readonly" id="created_at" name="created_at" value="<?php echo $formatted; ?>">
              </div>
            </div>

            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <div class="form-button">
              <button type="submit" class="btn submit-btn" name="submit">Save</button>
              <button type="button" class="btn cancel-btn" name="cancel" onclick="cancelEdit()">Cancel</button>
            </div>
         </form>
       <?php } ?>
      </div>
    </div>
  </div>
</div>

<script>
  function cancelEdit() {
        window.location.href = 'profile.php';
    }
</script>

</body>
</html>



