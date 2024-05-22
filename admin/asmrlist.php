

<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['delete'])){
   $delete_id = $_POST['asmr_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_asmr = $conn->prepare("SELECT * FROM asmr WHERE id = ? AND tutor_id = ? LIMIT 1");
   $verify_asmr->execute([$delete_id, $tutor_id]);

   if($verify_asmr->rowCount() > 0){

   

   $delete_asmr_thumb = $conn->prepare("SELECT * FROM asmr WHERE id = ? LIMIT 1");
   $delete_asmr_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_asmr_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);
  /*  $delete_bookmark = $conn->prepare("DELETE FROM bookmark WHERE asmr_id = ?");
   $delete_bookmark->execute([$delete_id]); */
   $delete_asmr = $conn->prepare("DELETE FROM asmr WHERE id = ?");
   $delete_asmr->execute([$delete_id]);
   $message[] = 'ASMR deleted!';
   }else{
      $message[] = 'ASMR already deleted!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ASMRs</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlists">

   <h1 class="heading">Added ASMRs</h1>

   <div class="box-container">
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Create New ASMR</h3>
         <a href="add_playlist_asmr.php" class="btn">Add ASMR</a>
      </div>

      <?php
         $select_asmr = $conn->prepare("SELECT * FROM asmr WHERE tutor_id = ? ORDER BY date DESC");
         $select_asmr->execute([$tutor_id]);
         if($select_asmr->rowCount() > 0){
         while($fetch_asmr = $select_asmr->fetch(PDO::FETCH_ASSOC)){
            $asmr_id = $fetch_asmr['id'];
            $count_videos = $conn->prepare("SELECT * FROM asvideo WHERE asmr_id = ?");
            $count_videos->execute([$asmr_id]);
            $total_videos = $count_videos->rowCount();
      ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-circle-dot" style="<?php if($fetch_asmr['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_asmr['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_asmr['status']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_asmr['date']; ?></span></div>
         </div>
         <div class="thumb">
            <span><?= $total_videos; ?></span>
            <img src="../uploaded_files/<?= $fetch_asmr['thumb']; ?>" alt="">
         </div>
         <h3 class="title"><?= $fetch_asmr['title']; ?></h3>
         <p class="description"><?= $fetch_asmr['description']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="asmr_id" value="<?= $asmr_id; ?>">
            <a href="update_asmr_playlist.php?get_id=<?= $asmr_id; ?>" class="option-btn">Update</a>
            <input type="submit" value="Delete" class="delete-btn" onclick="return confirm('Delete this ASMR?');" name="delete">
         </form>
         <a href="view_asmr_playlist.php?get_id=<?= $asmr_id; ?>" class="btn">View ASMR</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">No ASMR added yet!</p>';
      }
      ?>

   </div>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

<script>
   document.querySelectorAll('.asmrs .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

</body>
</html>