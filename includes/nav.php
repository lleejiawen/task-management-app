<!-- nav.php -->
<style type="text/css">
  html, body {
    height: 100%;
    margin: 0;
  }

.sidebar{
  background-color: #f5f5f5;
  padding-top: 30px;
  padding-left: 30px;
  height: 100vh;
  position: fixed;
  width: 25%;
}

.sidebar a {
  padding: 15px;
  display: block;
  text-decoration: none;
  font-size: 18px;
}

@media (max-width: 768px) {
  .main-content {
    flex-direction: column;
  }
  
  .sidebar {
    width: 100%;
    height: 100%;
    padding-top: 0;
    position: unset;
  }
}
</style>

<div class="sidebar">
    <a href="../pages/dashboard.php"><i class="fa fa-home "></i> Dashboard</a>
    <a href="../pages/profile.php"><i class="fa fa-id-card "></i> My Profile</a>
    <a href="../pages/tasks.php"><i class="fa fa-tasks"></i> Manage Tasks</a>
    <a href="../pages/customers.php"><i class="fa fa-users "></i> Manage Customers</a>
    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1 ) { ?>
      <a href="../pages/users.php"><i class="fa fa-user "></i> Manage Users</a>
       <a href="../pages/department.php"><i class="fa fa-building-o"></i> Manage Department</a>
    <?php } ?>
    <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
</div>

