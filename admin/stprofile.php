<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
  
}
if(isset($_POST['user_fetch'])){

   $user_email = $_POST['user_email'];
   $user_email = filter_var($user_email, FILTER_SANITIZE_STRING);
   $select_user = $conn->prepare('SELECT * FROM `users` WHERE email = ?');
   $select_user->execute([$user_email]);

   $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
   $user_id = $fetch_user['id'];
   $user_name = $fetch_user['name'];

   /* $count_grades = $conn->prepare("SELECT * FROM `grades` WHERE user_id = ?");
   $count_grades->execute([$user_id]);
   $total_grades = $count_grades->rowCount(); */

}else{
   header('location:student.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>kids performance</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- teachers profile section starts  -->

<section class="stprofile">

   <h1 class="heading">profile details</h1>

   <div class="details">
      <div class="tutor">
      <img src="uploaded_files/<?= $fetch_users['image']; ?>" alt="">
      <h3>Name: <?= $user_name; ?></h3>
         <p>ID: <?= $fetch_user['id']; ?></p>
      </div>
      <div class="flex">
      <!-- <p>Total Grades: <span><?= $total_grades; ?></span></p> -->
      </div>

   </div>

</section>

<!-- student profile section ends -->

<!-- <?php include 'components/footer.php'; ?>     -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>