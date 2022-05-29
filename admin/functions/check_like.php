<?php 

function check_like($user_id,$blog_id,$db_con){


    $check_query = mysqli_query($db_con,"SELECT * FROM  `likes` WHERE `user_id` = '$user_id' AND `blog_id` = '$blog_id'");

    if(mysqli_num_rows($check_query) > 0){
        return 'Liked';
    }else{
        return 'Unliked';
    }
}

function check_comment($blog_id,$db_con){
    $check_comment_query = mysqli_query($db_con,"SELECT * FROM  `comment` WHERE `blog_id` = '$blog_id'");
    if(mysqli_num_rows($check_comment_query) > 0){
        return 'Has Comment';
    }else{
        return 'No Comment';
    }
}

function count_likes($blog_id,$db_con){
    $count_like_query = mysqli_query($db_con, "SELECT COUNT(*) FROM `likes` WHERE `blog_id`='$blog_id'");
    $count_like = mysqli_fetch_assoc($count_like_query);
    return $count_like['COUNT(*)'];
}
function count_comments($blog_id,$db_con){
    $count_like_query = mysqli_query($db_con, "SELECT COUNT(*) FROM `comment` WHERE `blog_id`='$blog_id'");
    $count_like = mysqli_fetch_assoc($count_like_query);
    return $count_like['COUNT(*)'];
}

function get_comment_replays($db_con,$comment_id){
    $check_replay_query = mysqli_query($db_con,"SELECT * FROM `comment_replays` WHERE `comment_id` = '$comment_id'");
    if(mysqli_num_rows($check_replay_query) > 0){
        return 'Has_Replays';
    }else{
        return 'No_Replays';
    }
}

?>