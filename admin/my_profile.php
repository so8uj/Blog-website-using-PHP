<?php require_once('header.php');
// require the header file 
// count all post and likes and commnts 
$posts = mysqli_query($db_con, "SELECT COUNT(*) FROM `blogs`");
$count_post = mysqli_fetch_assoc($posts);

// Likes
$likes = mysqli_query($db_con, "SELECT COUNT(*) FROM `likes`");
$count_like = mysqli_fetch_assoc($likes);
// Comment
$commentss = mysqli_query($db_con, "SELECT COUNT(*) FROM `comment`");
$count_comment = mysqli_fetch_assoc($commentss);

// update profile
// first check signUpBtn click if click then go next step
if(isset($_POST['updateProfileBtn'])){

  // chech the form input values
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  $gender = $_POST['gender'];
  $birth = $_POST['birth'];
  $addr = $_POST['addr'];
  $institute = $_POST['institute'];
  $updateProfilequery = "UPDATE `users` SET `f_name`='$f_name',`l_name`='$l_name',`city`='$city',`country`='$country',`gender`='$gender',`birth`='$birth',`addr`='$addr',`institute`='$institute' WHERE `id` = '$id'";
  $run_upquery = mysqli_query($db_con,$updateProfilequery);
  if($run_upquery == true){
    header('Location: my_profile.php?profile_updated');
  }else{
    header('Location: my_profile.php?error');
  }
}


// first check signUpBtn click if click then go next step
if(isset($_POST['updateProfilePictureBtn'])){

  // check this is the default photo or not
  $old_photo = $user['photo'];
  if($old_photo != 'usr.png'){
    unlink('../uploads/'.$old_photo);
  }
  $tmp_name = $_FILES["photo"]["tmp_name"];
  //  get the file extension for rename the file with date like 1650895559.png , 1650895559.jpg 
  $ex = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
  $new_name =  time().'.'.$ex ;
  move_uploaded_file($tmp_name,'../uploads/'.$new_name);
  $update_picture_query = mysqli_query($db_con,"UPDATE `users` SET `photo`='$new_name' WHERE `id` = '$id'");
  header('Location: my_profile.php?profilePicture_updated');
}

?>

  <!-- show the profile update and error message  -->
  <?php if(isset($_GET['profilePicture_updated'])){ ?><div class="alert alert-success">Profile picture updated</div> <?php } ?>
  <?php if(isset($_GET['profile_updated'])){ ?><div class="alert alert-success">Profile updated</div> <?php } ?>
  <?php if(isset($_GET['error'])){ ?><div class="alert alert-danger">Server Error</div> <?php } ?>
<div class="profile_area">
    
  <row class="row align-items-center justify-content-between">
    <div class="col-md-7">
      <div class="card mb-5 pb-5">
        <div class="card_img">
        <img src="../uploads/<?= $user['photo']; ?>" class="card-img-top" alt="...">
          <button class="btn btn-primary btn-sm edit_btn" data-bs-toggle="modal" data-bs-target="#updatePicture">Update Picture</button>
        </div>
        <div class="card-body">
          <h5 class="card-title"><?= $user['f_name'] . ' ' . $user['l_name']; ?></h5> <!-- here i need to show the user name in header page we already define a user variable to chatch all data from this logged user merge first name and last name to show full name what i do in h5 card-title section -->

          <p class="text-disabled"><?= $user['user_type'] ?></p>
          <p class="card-text">University Name: <?= $user['institute']; ?></p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Email: <?= $user['email']; ?></li>
          <li class="list-group-item">Gender: <?= $user['gender']; ?></li>
          <li class="list-group-item">Date of birth: <?= $user['birth']; ?></li>
          <li class="list-group-item">Country: <?= $user['country']; ?>, City: <?= $user['city']; ?></li>
          <!-- <li class="list-group-item"></li> -->
          <li class="list-group-item">Address: <?= $user['addr']; ?></li>
        </ul>

      </div>
    </div>
    <div class="col-md-4">
      <button class="button btn-primary wid_120 edit_btn" data-bs-toggle="modal" data-bs-target="#updateProfile">Edit</button>
      <div class="card">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="d-flex justify-content-between"><span>Total Posts</span><span class="badge bg-primary rounded-pill"><?= $count_post['COUNT(*)']; ?></span></div>
          </li>
          <li class="list-group-item">
            <div class="d-flex justify-content-between"><span>Total Likes</span><span class="badge bg-primary rounded-pill"><?= $count_like['COUNT(*)']; ?></span></div>
          </li>
          <li class="list-group-item">
            <div class="d-flex justify-content-between"><span>Total Coments</span><span class="badge bg-primary rounded-pill"><?= $count_comment['COUNT(*)']; ?></span></div>
          </li>
        </ul>
      </div>
    </div>
  </row>
</div>


<!-- modal for update user data -->

<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="updateProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProfileLabel">Update Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">

          <div class="row">
            <div class="col-sm-6">
              <div class="mb-4">
                <label for="f_name" class="form-label">First Name</label>
                <input type="text" class="form-control" name="f_name" id="f_name" value="<?= $user['f_name'] ?>" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-4">
                <label for="l_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="l_name" id="l_name" value="<?= $user['l_name'] ?>" required>
              </div>
            </div>
            
          </div>

          <div class="row align-items-center">
            <div class="col-sm-3">
              <div class="mb-4">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" id="city" value="<?= $user['city']; ?>" placeholder="Dhaka" required>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-4">
                <label for="country" class="form-label">Country</label>
                <select id="country" class="form-select" name="country" aria-label="Select Country" required>
                  <option value="<?= $user['country']; ?>" selected><?= $user['country']; ?></option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="India">India</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="United States">United States</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="mb-4">
                <label for="gender" class="form-label">Gender</label>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required <?php if($user['gender'] == 'Male'){ echo 'checked'; } ?>>
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required <?php if($user['gender'] == 'Female'){ echo 'checked'; } ?>>
                  <label class="form-check-label" for="female">Female</label>
                </div>

              </div>
            </div>
            <div class="col-sm-3">
              <div class="mb-4">
                <label for="birth" class="form-label"> Birthday</label>
                <input type="text" onfocus="(this.type='date')" name="birth" value="<?= $user['birth'] ?>" class="form-control" id="birth" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="mb-4">
                <label for="addr" class="form-label">Address</label>
                <input type="text" class="form-control" value="<?= $user['addr'] ?>" name="addr" id="addr" placeholder="Road no 130" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-4">
                <label for="institute" class="form-label">University name</label>
                <input type="text" class="form-control" value="<?= $user['institute'] ?>" name="institute" id="institute" required>
              </div>
            </div>



          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="updateProfileBtn" class="btn btn-primary">Update</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>


<!-- modal for update profile picture-->

<div class="modal fade" id="updatePicture" tabindex="-1" aria-labelledby="updatePictureLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatePictureLabel">Update Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center mb-4">
          <img src="../uploads/<?= $user['photo']; ?>" width="150px" alt="...">
        </div>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">


          <div class="col-sm-12">
            <div class="mb-4">
              <label for="photo" class="form-label">Upload Picture</label>
              <input type="file" class="form-control" name="photo" id="photo" placeholder="Road no 130" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="updateProfilePictureBtn" class="btn btn-primary">Update</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>


<?php require_once('footer.php'); // require the footer file ?>