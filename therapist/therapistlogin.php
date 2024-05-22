<?php

include '../components/connect.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['submit'])){

   // Sanitize and log email input
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   echo 'Sanitized Email: ' . $email . '<br>';

   // Hash and log password
   $pass = sha1($_POST['pass']);
   echo 'Hashed Password: ' . $pass . '<br>';

   try {
      // Prepare and execute query
      $select_therapist = $conn->prepare("SELECT * FROM `therapist` WHERE email = ? AND password = ? LIMIT 1");
      $select_therapist->execute([$email, $pass]);
      
      // Fetch result and log row count
      $row = $select_therapist->fetch(PDO::FETCH_ASSOC);
      echo 'Row Count: ' . $select_therapist->rowCount() . '<br>';

      if($select_therapist->rowCount() > 0){
         // Set cookie and redirect
         setcookie('therapist_id', $row['id'], time() + 60*60*24*30, '/');
         header('location:therapistdash.php');
         exit();
      }else{
         // Display error message
         $message[] = 'Incorrect email or password!';
         echo 'Incorrect email or password!';
      }
   } catch (PDOException $e) {
      // Log any database errors
      echo 'Database Error: ' . $e->getMessage();
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="padding-left: 0;">

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message form">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- login section starts  -->

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>welcome back!</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="pass" placeholder="enter your password" maxlength="50" required class="box">
      <p class="link">don't have an account? <a href="register.php">register new</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</section>

<!-- login section ends -->

<script>
let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enableDarkMode = () => {
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () => {
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}else{
   disableDarkMode();
}
</script>
   
</body>
</html>
