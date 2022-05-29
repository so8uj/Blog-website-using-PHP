<?php 
// require the header file 
require_once('header.php');
$get_user_id = $_GET['user_id'];
$get_user_query = mysqli_query($db_con,"SELECT * FROM `users` WHERE `id` = $get_user_id");
$get_user = mysqli_fetch_assoc($get_user_query);

// count all post and likes and commnts 
$posts = mysqli_query($db_con, "SELECT COUNT(*) FROM `blogs` WHERE `user_id`='$get_user_id'");
$count_post = mysqli_fetch_assoc($posts);
// Likes
$likes = mysqli_query($db_con, "SELECT COUNT(*) FROM `likes` WHERE `user_id`='$get_user_id'");
$count_like = mysqli_fetch_assoc($likes);
// Comment
$commentss = mysqli_query($db_con, "SELECT COUNT(*) FROM `comment` WHERE `user_id`='$get_user_id'");
$count_comment = mysqli_fetch_assoc($commentss);
?>


<div class="profile_area">
    
  <div class="row align-items-center justify-content-between">
    <div class="col-md-7">
      <div class="card mb-5 pb-5">
        <div class="card_img">
          <img src="../uploads/<?= $get_user['photo']; ?>" class="card-img-top" alt="...">
        </div>
        <div class="card-body">
          <h5 class="card-title"><?= $get_user['f_name'] . ' ' . $get_user['l_name']; ?></h5> <!-- here i need to show the user name in header page we already define a user variable to chatch all data from this logged user merge first name and last name to show full name what i do in h5 card-title section -->

          <p class="text-disabled"><?= $get_user['user_type'] ?></p>
          <p class="card-text">University Name: <?= $get_user['institute']; ?></p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Email: <?= $get_user['email']; ?></li>
          <li class="list-group-item">Gender: <?= $get_user['gender']; ?></li>
          <li class="list-group-item">Date of birth: <?= $get_user['birth']; ?></li>
          <li class="list-group-item">Country: <?= $get_user['country']; ?>, City: <?= $get_user['city']; ?></li>
          <!-- <li class="list-group-item"></li> -->
          <li class="list-group-item">Address: <?= $get_user['addr']; ?></li>
        </ul>

      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="d-flex justify-content-between"><span>Posts</span><span class="badge bg-primary rounded-pill"><?= $count_post['COUNT(*)']; ?></span></div>
          </li>
          <li class="list-group-item">
            <div class="d-flex justify-content-between"><span>Likes</span><span class="badge bg-primary rounded-pill"><?= $count_like['COUNT(*)']; ?></span></div>
          </li>
          <li class="list-group-item">
            <div class="d-flex justify-content-between"><span>Coments</span><span class="badge bg-primary rounded-pill"><?= $count_comment['COUNT(*)']; ?></span></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>


<?php require_once('footer.php'); // require the footer file ?>