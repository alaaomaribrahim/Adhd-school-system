<?php
session_start(); // Start the session

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){
   // Form submitted, process login
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email input
   $pass = sha1($_POST['pass']); // Hash the password

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($row){ // Check if a user is found
     setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
     header('Location: home.php'); // Redirect to home page upon successful login
     exit();
   }else{
      $_SESSION['error_message'] = 'Incorrect email or password!'; // Store error message in session
      header('Location: login.php'); // Redirect to login page
      exit();
   }
}

// Redirect to register page if the registration button is clicked
if(isset($_POST['register'])){
   header('Location: register.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS -->
   <style>
      body {
         margin: 0;
         padding: 0;
         font-family: Arial, sans-serif;
         background-image: url('background_image.jpg'); /* Replace 'background_image.jpg' with the path to your child-friendly background image */
         background-size: cover;
         background-position: center;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
      }
      .form-container {
         max-width: 400px;
         padding: 30px;
         background-color: rgba(255, 255, 255, 0.9);
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
      .form-container input[type="email"],
      .form-container input[type="password"] {
         width: 100%;
         padding: 10px;
         margin-top: 8px;
         border: 1px solid #ccc;
         border-radius: 5px;
         background-color: #fff;
         outline: none;
         transition: border-color 0.3s;
      }
      .form-container input[type="email"]:focus,
      .form-container input[type="password"]:focus {
         border-color: #ff6f61;
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
      .error-message {
         color: red;
         text-align: center;
         margin-top: 10px;
      }
   </style>
</head>
<body>

<div class="form-container">
   <h3>Welcome Back!</h3>
   <form action="" method="post">
      <p>Your Email <span>*</span></p>
      <input type="email" name="email" placeholder="Enter Your Email" required>
      <p>Your Password <span>*</span></p>
      <input type="password" name="pass" placeholder="Enter Your Password" required>
      <input type="submit" name="submit" value="Login Now">
      <p class="link">Don't have an account? <a href="register.php">Register Now</a></p>
      <?php if(isset($_SESSION['error_message'])): ?> <!-- Check if error message is set in session -->
         <div class="error-message"><?php echo $_SESSION['error_message']; ?></div> <!-- Display error message here -->
         <?php unset($_SESSION['error_message']); ?> <!-- Unset error message from session to hide it after reload -->
      <?php endif; ?>
   </form>
</div>

</body>
</html>
