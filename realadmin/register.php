<?php

include '../components/connect.php';
if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $profession = $_POST['profession'];
   $profession = filter_var($profession, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $cpass = $_POST['cpass'];

   // Compare plain text passwords before hashing
   if($pass !== $cpass){
      $message[] = 'confirm password not matched!';
   } else {
      // Hash the passwords after confirmation
      $hashed_pass = sha1($pass);

      $image = $_FILES['image']['name'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $ext = pathinfo($image, PATHINFO_EXTENSION);
      $rename = unique_id().'.'.$ext;
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = '../uploaded_files/'.$rename;

      $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
      $select_tutor->execute([$email]);

      $select_therapist = $conn->prepare("SELECT * FROM `therapist` WHERE email = ?");
      $select_therapist->execute([$email]);

      if($select_tutor->rowCount() > 0 || $select_therapist->rowCount() > 0){
         $message[] = 'email already taken!';
      } else { 
         if($profession == "teacher"){         
            $insert_tutor = $conn->prepare("INSERT INTO `tutors`(id, name, profession, email, password, image) VALUES(?,?,?,?,?,?)");
            $insert_tutor->execute([$id, $name, $profession, $email, $hashed_pass, $rename]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new tutor registered! please login now';
         } else {  
            $insert_therapist = $conn->prepare("INSERT INTO `therapist`(id, name, profession, email, password, image) VALUES(?,?,?,?,?,?)");
            $insert_therapist->execute([$id, $name, $profession, $email, $hashed_pass, $rename]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new therapist registered! please login now';
         }
      }
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="padding-left: 0;">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- register section starts  -->

<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>register</h3>
      <div class="flex">
         <div class="col">
            <p>your name <span>*</span></p>
            <input type="text" name="name" placeholder="eneter your name" maxlength="50" required class="box">
            <p>your profession <span>*</span></p>
            <select name="profession" class="box" required>
               <option value="" disabled selected>-- select your profession</option>
               <option value="teacher">teacher</option>
               <option value="therapist">therapist</option>
               
            </select>
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" maxlength="20" required class="box">
         </div>
         <div class="col">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
            <p>confirm password <span>*</span></p>
            <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
            <p>select pic <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
         </div>
      </div>
      <input type="submit" name="submit" value="Add Teacher" class="btn">
   </form>

</section>

<!-- registe section ends -->












<script>

let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enabelDarkMode = () =>{
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}else{
   disableDarkMode();
}

</script>
   
</body>
</html>