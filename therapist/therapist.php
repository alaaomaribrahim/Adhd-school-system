<?php
session_start();
include '../components/connect.php';

if (isset($_COOKIE['therapist_id'])) {
   $therapist_id = $_COOKIE['therapist_id'];
} else {
   $therapist_id = '';
   header('location:therapistlogin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      /* CSS for appointment table */
      table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
      }

      table, th, td {
         border: 1px solid #ccc;
      }

      th, td {
         padding: 10px;
         text-align: left;
      }

      th {
         background-color: #f4f4f4;
      }

      .empty {
         text-align: center;
         padding: 20px;
         color: #999;
      }

      .action-buttons {
         display: flex;
         gap: 10px;
      }

      .action-buttons button {
         padding: 5px 10px;
         border: none;
         border-radius: 3px;
         cursor: pointer;
      }

      .action-buttons .accept {
         background-color: #4CAF50;
         color: white;
      }

      .action-buttons .reject {
         background-color: #F44336;
         color: white;
      }

      .message {
         margin: 20px 0;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         background-color: #f4f4f4;
         color: #333;
      }
   </style>
</head>
<body>

<?php include '../components/therapist_header.php'; ?>
   
<section class="appointments">

   <h1 class="heading">Appointments</h1>

   <?php
      if (isset($_SESSION['message'])) {
         echo '<div class="message">' . $_SESSION['message'] . '</div>';
         unset($_SESSION['message']);
      }
   ?>

   <div class="show-appointments">
      <?php
         $select_appointments = $conn->prepare("SELECT * FROM `appointment`");
         $select_appointments->execute();
         if ($select_appointments->rowCount() > 0) {
      ?>
      <table>
         <thead>
            <tr>
               <th>Name</th>
               <th>Email</th>
               <th>Child Name</th>
               <th>Age</th>
               <th>Message</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
               while ($fetch_appointment = $select_appointments->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
               <td><?= $fetch_appointment['name']; ?></td>
               <td><?= $fetch_appointment['email']; ?></td>
               <td><?= $fetch_appointment['childname']; ?></td>
               <td><?= $fetch_appointment['age']; ?></td>
               <td><?= $fetch_appointment['message']; ?></td>
               <td>
                  <div class="action-buttons">
                     <form action="update_appointment.php" method="POST">
                        <input type="hidden" name="name" value="<?= $fetch_appointment['name']; ?>">
                        <input type="hidden" name="email" value="<?= $fetch_appointment['email']; ?>">
                        <input type="hidden" name="childname" value="<?= $fetch_appointment['childname']; ?>">
                        <input type="hidden" name="age" value="<?= $fetch_appointment['age']; ?>">
                        <button type="submit" name="action" value="accept" class="accept">Accept</button>
                     </form>
                     <form action="update_appointment.php" method="POST">
                        <input type="hidden" name="name" value="<?= $fetch_appointment['name']; ?>">
                        <input type="hidden" name="email" value="<?= $fetch_appointment['email']; ?>">
                        <input type="hidden" name="childname" value="<?= $fetch_appointment['childname']; ?>">
                        <input type="hidden" name="age" value="<?= $fetch_appointment['age']; ?>">
                        <button type="submit" name="action" value="reject" class="reject">Reject</button>
                     </form>
                  </div>
               </td>
            </tr>
            <?php
               }
            ?>
         </tbody>
      </table>
      <?php
         } else {
            echo '<p class="empty">No appointments found!</p>';
         }
      ?>
   </div>
   
</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
