<?php 
// require the database connection
require_once('../db/db.php');

// catch the post datas
$user_id = $_POST['user_id'];
$blog_id = $_POST['blog_id'];
$comment = $_POST['comment'];

$add_comment = mysqli_query($db_con,"INSERT INTO `comment`(`user_id`, `blog_id`, `comment`) VALUES ('$user_id','$blog_id','$comment')");

if($add_comment == true){
    // return with new comment
    $get_user = mysqli_query($db_con,"SELECT * FROM `users` WHERE `id` = '$user_id'");
    $user_dt = mysqli_fetch_assoc($get_user);
    echo $user_dt['f_name'].' '.$user_dt['l_name'].'_'.$user_dt['photo'].'_'.$comment;
    
    
}

$db_con->close();

?>