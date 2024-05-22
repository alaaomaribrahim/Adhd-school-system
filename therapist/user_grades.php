<?php

include '../components/connect.php';


if(isset($_COOKIE['therapist_id'])){
    $therapist_id = $_COOKIE['therapist_id'];
 }else{
    $therapist_id = '';
   
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

</head>
<body>

<?php include '../components/therapist_header.php'; ?>

<section class="grades">
   <h1 class="heading">Your Grades</h1>
   <div class="show-grades">
   <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         if($select_users->rowCount() > 0){
            while($fetch_user = $select_users->fetch(PDO::FETCH_ASSOC)){

               $user_id = $fetch_user['id'];

               /* $count_grades = $conn->prepare("SELECT * FROM `grades` WHERE user_id = ?");
               $count_grades->execute([$user_id]);
               $total_grades = $count_grades->rowCount(); */

               // You can add more count queries as needed for other statistics

      ?>
      <div class="grade-box">
         <p><strong>User Name:</strong> <?= $fetch_user['name']; ?></p>
         <p><strong>User ID:</strong> <?= $fetch_user['id']; ?></p>
         <p><strong>grade for english:</strong> <?= 5; ?></p>
         <p><strong>grade for math:</strong> <?= 3; ?></p>
         <p><strong>grade for science:</strong> <?= 4; ?></p>
         <!-- Only displaying the grade -->
         <!-- <p><?= $fetch_grade['grade']; ?></p> -->
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">No grades submitted yet!</p>';
         }
      ?>
   </div>
</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
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
      /* CSS styles for grades section */
      .grades {
         margin-top: 20px;
      }
      .show-grades {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
         gap: 20px;
      }
      .grade-box {
         background-color: #f9f9f9;
         padding: 20px;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .grade-box p {
         margin: 0;
         padding-bottom: 10px;
      }
      .empty {
         font-style: italic;
      }
   </style>
</head>
<body>


</body>
</html>
