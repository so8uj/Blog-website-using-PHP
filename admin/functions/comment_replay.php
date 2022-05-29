<?php 
// require the database connection
require_once('../db/db.php');

// catch the post datas
$user_id = $_POST['user_id'];
$comment_id = $_POST['comment_id'];
$replay = $_POST['replay'];

$add_replay = mysqli_query($db_con,"INSERT INTO `comment_replays`(`user_id`, `comment_id`, `replay`) VALUES ('$user_id','$comment_id','$replay')");

if($add_replay == true){
    // return with new comment
    $get_user = mysqli_query($db_con,"SELECT * FROM `users` WHERE `id` = '$user_id'");
    $user_dt = mysqli_fetch_assoc($get_user);
    echo $user_dt['f_name'].' '.$user_dt['l_name'].'_'.$user_dt['photo'].'_'.$replay;
    
    
}

$db_con->close();

?>