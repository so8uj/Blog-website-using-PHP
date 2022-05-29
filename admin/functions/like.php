<?php 

// require the database connection
require_once('../db/db.php');

// catch the post datas
$user_id = $_POST['user_id'];
$blog_id = $_POST['blog_id'];

// then check if already then delete data and unlike 
$check_query = mysqli_query($db_con,"SELECT * FROM  `likes` WHERE `user_id` = '$user_id' AND `blog_id` = '$blog_id'");
if(mysqli_num_rows($check_query) > 0){
    mysqli_query($db_con,"DELETE FROM  `likes` WHERE `user_id` = '$user_id' AND `blog_id` = '$blog_id'");
    echo 'Unliked';
}else{
    $add_like = mysqli_query($db_con,"INSERT INTO `likes`(`user_id`, `blog_id`) VALUES ('$user_id','$blog_id')");
    echo 'Liked';
}
$db_con->close();



?>