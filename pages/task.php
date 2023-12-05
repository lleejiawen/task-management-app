<?php 
include '../includes/session.php'; 
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Task | Task Management Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
<div class="container-fluid main-content task" id="mainContent">
  <?php
  function getPriorityClass($priority) {
      switch ($priority) {
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
  
  function getStatusClass($status) {
      switch ($status) {
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

  if (isset($_GET['task_id']) && !empty($_GET['task_id'])) {
      $task_id = $_GET['task_id'];
  ?>

  <div class="row content">
    <div class="col-sm-3 nav-col">
      <!-- include navigation-->
      <?php include '../includes/nav.php'; ?>
    </div>
    <div class="col-sm-9 content-col">
      <div class="welcome-container">
        <p class="welcome-message"><h3 class="page-title">Task Detail: <?php echo $task_id; ?></h3></p>
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
        } ?>

        <div class="action-group">
          <a class="btn back-btn" href="../pages/tasks.php">Back</a>  
          <a class="btn edit-btn" href="task-edit.php?task_id=<?php echo $task_id; ?>">Edit</a>  
          <a class="btn delete-btn" href="#" onclick="confirmDelete(<?php echo $task_id; ?>);">Delete</a>  
        </div>

         <?php 
          $result = mysqli_query($conn, 
          "SELECT tasks.*, tasks_priority.priority as priority, tasks_status.status as status, COALESCE(NULLIF(tasks.task_description, ''), '-') as task_description, COALESCE(NULLIF(tasks.completion_date, ''), '-') as completion_date, COALESCE(NULLIF(users.full_name, ''), '-') as assigned_to, COALESCE(NULLIF(tasks.remarks, ''), '-') as remarks, COALESCE(NULLIF(customer.name, ''), '-') as customer_info, customer.id as customer_id
          FROM `tasks`
          LEFT JOIN `tasks_priority` ON tasks.task_priority = tasks_priority.id
          LEFT JOIN `tasks_status` ON tasks.task_status = tasks_status.id
          LEFT JOIN `users` ON tasks.assigned_to = users.id
          LEFT JOIN `customer` ON tasks.customer_info = customer.id
          WHERE tasks.id=$task_id
          ");

          if ($result && mysqli_num_rows($result) > 0) {
              $task = mysqli_fetch_assoc($result);

              echo "<table class='content-table'>";          
              echo "<tr><th>ID</th><td>{$task['id']}</td></tr>";
              echo "<tr><th>Task Name</th><td>{$task['task_name']}</td></tr>";
              echo "<tr><th>Description</th><td>{$task['task_description']}</td></tr>";
              echo "<tr><th>Assigned To</th><td>{$task['assigned_to']}</td></tr>";

              echo "<tr><th>Priority</th><td>";
              $priorityClass = getPriorityClass($task['priority']);
              $priorityText = ($task['priority'] !== '' && $task['priority'] !== null) ? $task['priority'] : '-';
              echo '<span class="display-btn ' . $priorityClass . '">' . $priorityText . '</span>';
              echo "</td></tr>";

              echo "<tr><th>Status</th><td>";
              $statusClass = getStatusClass($task['status']);
              $statusText = ($task['status'] !== '' && $task['status'] !== null) ? $task['status'] : '-';
              echo '<span class="display-btn ' . $statusClass . '">' . $statusText . '</span>';
              echo "</td></tr>";

              echo "<tr><th>Completion Date</th><td>";
              if (!empty($task['completion_date']) && $task['completion_date'] !== 'null' && $task['completion_date'] !== '-') {
                $completion_timestamp = (int)$task['completion_date'];
                if ($completion_timestamp !== false && $completion_timestamp !== -1) {
                    echo date('d/m/Y', $completion_timestamp);
                } else {
                    echo '-';
                }
              } else {
                  echo '-';
              }
              echo "</td></tr>";
              echo "<tr><th>Comments</th><td>{$task['remarks']}</td></tr>";
              echo "<tr><th>Customer Information</th><td><a class='view-customer-btn' href='customer.php?customer_id={$task['customer_id']}' target='_blank'>{$task['customer_info']}</td></tr>";
              echo "<tr><th>Created At</th><td>";
              if (!empty($task['created_at']) && $task['created_at'] !== 'null' && $task['created_at'] !== '-') {
                $created_timestamp = (int)$task['created_at'];
                if ($created_timestamp !== false && $created_timestamp !== -1) {
                    echo date('d/m/Y', $created_timestamp);
                } else {
                    echo '-';
                }
              } else {
                  echo '-';
              }
              echo "</td></tr>";
              echo "</table>";          

              mysqli_free_result($result);
          } else {
              echo "Task not found.";
          }
              mysqli_close($conn);
          } else {
              echo "Invalid task ID.";
          }
        ?>
    </div>
  </div>
</div>

<script>
  function confirmDelete(taskId) {
    var confirmDelete = confirm("Are you sure you want to delete this task?");
    if (confirmDelete) {
      window.location.href = `../tasks-api/delete.php?task_id=${taskId}`;
    }
  }
</script>

</body>
</html>



