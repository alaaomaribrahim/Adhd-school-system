<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>kids</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- students section starts  -->

<section class="student">

   <h1 class="heading">kids profile</h1>

  <!--  <form action="search_tutor.php" method="post" class="search-tutor">
      <input type="text" name="search_tutor" maxlength="100" placeholder="search tutor..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form> -->
   <div class="box-container">

      

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
      <div class="box">
         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_users['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_user['name']; ?></h3>
            </div>
         </div>
         <p>id:<span><?= $user_id; ?></span></p>
         <p>name : <span><?= $user_name ?></span></p>
         <!-- <p>grades: <span><?= $user_grade ?></span></p> -->
         <form action="stprofile.php" method="post">
            <input type="hidden" name="user_email" value="<?= $fetch_users['email']; ?>">
            <input type="submit" value="view profile" name="users_fetch" class="inline-btn">
         </form>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no kids found!</p>';
         }
      ?>

   </div>

</section>

<!-- student section ends -->






























  

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>