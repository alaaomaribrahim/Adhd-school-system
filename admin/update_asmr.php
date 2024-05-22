<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:dashboard.php');
}

if(isset($_POST['update'])){

   $video_id = $_POST['video_id'];
   $video_id = filter_var($video_id, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $asmr = $_POST['asmr'];
   $asmr = filter_var($asmr, FILTER_SANITIZE_STRING);

   $update_asvideo = $conn->prepare("UPDATE `asvideo` SET title = ?, description = ?, status = ? WHERE id = ?");
   $update_asvideo->execute([$title, $description, $status, $video_id]);

   if(!empty($asmr)){
      $update_asmr = $conn->prepare("UPDATE `asvideo` SET asmr_id = ? WHERE id = ?");
      $update_asmr->execute([$asmr, $video_id]);
   } 

   $old_thumb = $_POST['old_thumb'];
   $old_thumb = filter_var($old_thumb, FILTER_SANITIZE_STRING);
   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id().'.'.$thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/'.$rename_thumb;

   if(!empty($thumb)){
      if($thumb_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_thumb = $conn->prepare("UPDATE `asvideo` SET thumb = ? WHERE id = ?");
         $update_thumb->execute([$rename_thumb, $video_id]);
         move_uploaded_file($thumb_tmp_name, $thumb_folder);
         if($old_thumb != '' AND $old_thumb != $rename_thumb){
            unlink('../uploaded_files/'.$old_thumb);
         }
      }
   }

   $old_video = $_POST['old_video'];
   $old_video = filter_var($old_video, FILTER_SANITIZE_STRING);
   $video = $_FILES['video']['name'];
   $video = filter_var($video, FILTER_SANITIZE_STRING);
   $video_ext = pathinfo($video, PATHINFO_EXTENSION);
   $rename_video = unique_id().'.'.$video_ext;
   $video_tmp_name = $_FILES['video']['tmp_name'];
   $video_folder = '../uploaded_files/'.$rename_video;

   if(!empty($video)){
      $update_video = $conn->prepare("UPDATE `asvideo` SET video = ? WHERE id = ?");
      $update_video->execute([$rename_video, $video_id]);
      move_uploaded_file($video_tmp_name, $video_folder);
      if($old_video != '' AND $old_video != $rename_video){
         unlink('../uploaded_files/'.$old_video);
      }
   }

   $message[] = 'asmr video updated!';

}

if(isset($_POST['delete_video'])){

   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_video_thumb = $conn->prepare("SELECT thumb FROM `asvideo` WHERE id = ? LIMIT 1");
   $delete_video_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);

   $delete_video = $conn->prepare("SELECT video FROM `asvideo` WHERE id = ? LIMIT 1");
   $delete_video->execute([$delete_id]);
   $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_video['video']);

  

   $delete_asvideo = $conn->prepare("DELETE FROM `asvideo` WHERE id = ?");
   $delete_asvideo->execute([$delete_id]);
   header('location:asmr.php');
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update video</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="video-form">

   <h1 class="heading">update video</h1>

   <?php
      $select_asvideos = $conn->prepare("SELECT * FROM `asvideo` WHERE id = ? AND tutor_id = ?");
      $select_asvideos->execute([$get_id, $tutor_id]);
      if($select_asvideos->rowCount() > 0){
         while($fetch_asvideos = $select_asvideos->fetch(PDO::FETCH_ASSOC)){ 
            $video_id = $fetch_asvideos['id'];
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="video_id" value="<?= $fetch_asvideos['id']; ?>">
      <input type="hidden" name="old_thumb" value="<?= $fetch_asvideos['thumb']; ?>">
      <input type="hidden" name="old_video" value="<?= $fetch_asvideos['video']; ?>">
      <p>update status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="<?= $fetch_asvideos['status']; ?>" selected><?= $fetch_asvideos['status']; ?></option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>update title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="enter video title" class="box" value="<?= $fetch_asvideos['title']; ?>">
      <p>update description <span>*</span></p>
      <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_asvideos['description']; ?></textarea>
       <p>update asmr</p>
      <select name="asmr" class="box">
         <option value="<?= $fetch_asvideos['asmr_id']; ?>" selected>--select asmr</option>
         <?php
         $select_asmrs = $conn->prepare("SELECT * FROM `asmr` WHERE tutor_id = ?");
         $select_asmrs->execute([$tutor_id]);
         if($select_asmrs->rowCount() > 0){
            while($fetch_asmr = $select_asmrlist->fetch(PDO::FETCH_ASSOC)){
         ?>
         <option value="<?= $fetch_asmr['id']; ?>"><?= $fetch_asmr['title']; ?></option>
         <?php
            }
         ?>
         <?php
         }else{
            echo '<option value="" disabled>no asmr created yet!</option>';
         }
         ?> 
      </select>
      <img src="../uploaded_files/<?= $fetch_asvideos['thumb']; ?>" alt="">
      <p>update thumbnail</p>
      <input type="file" name="thumb" accept="image/*" class="box">
      <video src="../uploaded_files/<?= $fetch_asvideos['video']; ?>" controls></video>
      <p>update video</p>
      <input type="file" name="video" accept="video/*" class="box">
      <input type="submit" value="update video" name="update" class="btn">
      <div class="flex-btn">
         <a href="view_asmr.php?get_id=<?= $video_id; ?>" class="option-btn">view video</a>
         <input type="submit" value="delete asvideo" name="delete_video" class="delete-btn">
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">asvideo not found! <a href="add_asmr.php" class="btn" style="margin-top: 1.5rem;">add asvideos</a></p>';
      }
   ?>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
