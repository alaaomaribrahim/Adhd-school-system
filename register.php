<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         
         // Redirect to login page after successful registration
         header('Location: login.php');
         exit();
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
   <title>Register</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS -->
   <style>
      body {
         margin: 0;
         padding: 0;
         font-family: Arial, sans-serif;
         background-color: #f7f7f7;
      }
      .form-container {
         max-width: 400px;
         margin: 50px auto;
         padding: 30px;
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .form-container h3 {
         text-align: center;
         color: #333;
         font-size: 24px;
         margin-bottom: 20px;
      }
      .form-container p {
         margin-top: 10px;
         color: #333;
      }
      .form-container input[type="text"],
      .form-container input[type="email"],
      .form-container input[type="password"] {
         width: calc(50% - 20px);
         padding: 10px;
         margin-top: 8px;
         border: 1px solid #ccc;
         border-radius: 5px;
         background-color: #fff;
         outline: none;
         transition: border-color 0.3s;
      }
      .form-container input[type="text"]:focus,
      .form-container input[type="email"]:focus,
      .form-container input[type="password"]:focus {
         border-color: #ff6f61;
      }
      .form-container .col {
         display: flex;
         justify-content: space-between;
      }
      .form-container .col p {
         width: 45%;
      }
      .form-container input[type="file"] {
         width: calc(100% - 20px);
         padding: 10px;
         margin-top: 8px;
         border: 1px solid #ccc;
         border-radius: 5px;
         background-color: #fff;
         outline: none;
         transition: border-color 0.3s;
      }
      .form-container input[type="file"]:focus {
         border-color: #ff6f61;
      }
      .form-container .link {
         margin-top: 15px;
         text-align: center;
         color: #333;
         font-size: 16px;
      }
      .form-container .link a {
         color: #ff6f61;
         text-decoration: none;
         font-weight: bold;
      }
      .form-container input[type="submit"] {
         width: 100%;
         padding: 12px;
         margin-top: 20px;
         border: none;
         border-radius: 5px;
         background-color: #ff6f61;
         color: #fff;
         font-weight: bold;
         cursor: pointer;
         transition: background-color 0.3s;
      }
      .form-container input[type="submit"]:hover {
         background-color: #ff4838;
      }
   </style>
</head>
<body>

<div class="form-container">
   <h3>Create Account</h3>
   <form class="register" action="" method="post" enctype="multipart/form-data">
      <div class="col">
         <p>Your Name <span>*</span></p>
         <input type="text" name="name" placeholder="Enter Your Name" maxlength="50" required>
      </div>
      <div class="col">
         <p>Your Email <span>*</span></p>
         <input type="email" name="email" placeholder="Enter Your Email" maxlength="20" required>
      </div>
      <div class="col">
         <p>Your Password <span>*</span></p>
         <input type="password" name="pass" placeholder="Enter Your Password" maxlength="20" required>
      </div>
      <div class="col">
         <p>Confirm Password <span>*</span></p>
         <input type="password" name="cpass" placeholder="Confirm Your Password" maxlength="20" required>
      </div>
      <p>Select Profile Picture <span>*</span></p>
      <input type="file" name="image" accept="image/*" required>
      <input type="submit" name="submit" value="Register Now">
      <p class="link">Already have an account? <a href="login.php">Login Now</a></p>
   </form>
</div>

</body>
</html>
