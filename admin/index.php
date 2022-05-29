<?php require_once('header.php'); 

// all users
$all_users = mysqli_query($db_con,"SELECT * FROM `users`");

// active and deactive user ( just go and change the status from database )
if(isset($_GET['deactive_user'])){
  $id = $_GET['deactive_user'];
  mysqli_query($db_con,"UPDATE `users` SET `status`= 'Deactive' WHERE `id` = '$id'"); //update query
  header("Location: index.php");
}
if(isset($_GET['active_user'])){
  $id =$_GET['active_user'];
  mysqli_query($db_con,"UPDATE `users` SET `status`= 'Active' WHERE `id` = '$id'"); //update query
  header("Location: index.php");
}
// make admin and remove from admin user ( just go and change the user type form database )
if(isset($_GET['make_user_admin'])){
  $id =$_GET['make_user_admin'];
  mysqli_query($db_con,"UPDATE `users` SET `user_type`= 'Admin' WHERE `id` = '$id'"); //update query
  header("Location: index.php");
}
if(isset($_GET['remove_user_admin'])){
  $id = $_GET['remove_user_admin'];
  mysqli_query($db_con,"UPDATE `users` SET `user_type`= 'None' WHERE `id` = '$id'"); //update query
  header("Location: index.php");
}

?>

<!-- page content -->

<div class="table_area">
  <table class="data-table table table-hover" style="width: 100%;">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>User Type</th>
        <th>Status</th>
        <th>Gender</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- while loop for showing data -->
      <?php while($user = mysqli_fetch_assoc($all_users)) { ?> 
        
        <tr class="<?php if($user['status'] == 'Deactive'){ echo 'bg-primary text-white'; }?>">
          <td>
            <a class="link" href="view_profile.php?user_id=<?= $user['id'] ?>">
              <div class="d-flex align-items-center mb-2">
                <img src="../uploads/<?= $user['photo']; ?>" width="30px" class="me-2" alt="User Photo">
                <span class="post_by"><?= $user['f_name'] . ' ' . $user['l_name']; ?></span>
              </div>
            </a>
          </td>
          <td><?= $user['email']; ?></td>
          <td><?= $user['user_type']; ?></td>
          <td><?= $user['status']; ?></td>
          <td><?= $user['gender']; ?></td>
         
          <td class="d-grid gap-2">
            <?php if($user['status'] == 'Active'){ ?>
              <a href="<?= $_SERVER['PHP_SELF'].'?deactive_user='.$user['id'] ?>" class="btn btn-sm btn-outline-danger">Deactivate</a>
            <?php }else{ ?>
              <a href="<?= $_SERVER['PHP_SELF'].'?active_user='.$user['id'] ?>" class="btn btn-sm btn-success">Activate</a>
            <?php } 
            
            if($user['user_type'] == 'Admin'){ ?>
              <a href="<?= $_SERVER['PHP_SELF'].'?remove_user_admin='.$user['id'] ?>" class="btn btn-sm btn-warning">Remove Admin</a>
            <?php }else{ ?>
              <a href="<?= $_SERVER['PHP_SELF'].'?make_user_admin='.$user['id'] ?>" class="btn btn-sm btn-primary">Make Admin</a>
            <?php } ?>
            
          </td>
        </tr>

      <?php } ?> 
      
    </tbody>
  </table>
</div>

<?php require_once('footer.php'); ?>