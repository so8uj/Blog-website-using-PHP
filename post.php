<?php require_once('header.php'); // require the header file 
// require check like file for check if like
require_once('admin/functions/check_like.php'); 
// catch all the latest blogs from user
$all_blogs = mysqli_query($db_con, "SELECT * FROM `blogs` WHERE `user_id` = '$id' ORDER BY `id` DESC");
// catch all the categories for select new post category
$categories = mysqli_query($db_con, "SELECT * FROM `categories`");
$upcategories = mysqli_query($db_con, "SELECT * FROM `categories`");

// add post

if (isset($_POST['addPostBtn'])) {

    $user_id = $_POST['user_id'];
    $category = $_POST['category'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $add_postquery = mysqli_query($db_con, "INSERT INTO `blogs`(`user_id`, `category`, `subject`, `content`) VALUES ('$user_id','$category','$subject','$content')");
    if ($add_postquery == true) {
        header("Location: post.php?post_added");
    } else {
        header("Location: post.php?error");
    }
    mysqli_close($db_con);
}
// update post
if (isset($_POST['updatePostBtn'])) {

    $post_id = $_POST['post_id'];
    $category = $_POST['category'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $update_postquery = mysqli_query($db_con, "UPDATE `blogs` SET `category`='$category',`subject`='$subject',`content`='$content' WHERE `id` = '$post_id'");
    if ($update_postquery == true) {
        header("Location: post.php?post_updated");
    } else {
        header("Location: post.php?error");
    }
    mysqli_close($db_con);
}



?>

<div class="post_area">
    <div class="d-flex justify-content-end mb-3">
        <button class="button btn-primary" data-bs-toggle="modal" data-bs-target="#createPost">Create a New Post</button>
    </div>

    <!-- show success message from add post edit post -->
    <?php if (isset($_GET['post_added'])) { ?><div class="alert alert-success">New post added</div> <?php } ?>
    <?php if (isset($_GET['post_updated'])) { ?><div class="alert alert-success">Post data updated</div> <?php } ?>
    <?php if (isset($_GET['error'])) { ?><div class="alert alert-danger">Server Error</div> <?php } ?>

    

    <table style="width: 100%;" class="data-table">
        <thead>
            <tr>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- show all the latest blog from user -->
            <?php while ($all_blog = mysqli_fetch_assoc($all_blogs)) { ?>
            <tr>
                <td>
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between"><span><?= $all_blog['category']; ?></span><button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#updatePost<?= $all_blog['id']; ?>">Edit</button></div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $all_blog['subject']; ?></h5>
                            <p class="card-text"><?= $all_blog['content']; ?></p>
                        </div>
                        <div class="card-footer text-muted">
                             Likes <?= count_likes($all_blog['id'],$db_con) ?>, <span  onclick="show_comment_area(<?= $all_blog['id']; ?>)">Comment  <?= count_comments($all_blog['id'],$db_con) ?></span>, Posted at <?= $all_blog['created_at']; ?>
                             <?php if(count_comments($all_blog['id'],$db_con) > 0){ ?> 
                                
                                <div class="comment_area" id="blogComment_<?= $all_blog['id']; ?>">
                                    <!-- comment  section -->
                                    <?php if(check_comment($all_blog['id'],$db_con) == 'Has Comment'){ 
                                    //  show the comments 
                                        $blog_id = $all_blog['id'];
                                        $comments = mysqli_query($db_con,"SELECT comment.id, comment.comment , users.f_name , users.l_name ,users.photo FROM comment INNER JOIN users ON comment.user_id = users.id WHERE `blog_id` = '$blog_id' ORDER BY comment.id DESC"); // query for show comment and user name
                                        while($comment = mysqli_fetch_assoc($comments)){ $comment_id = $comment['id']; ?>
                                        <div class="comment_item" id="comment_ID<?= $comment_id; ?>">
                                            <div class="comments d-flex my_post_page" style="width: 100%;">
                                                <div class="commnet_user me-3">
                                                <img src="uploads/<?= $comment['photo']; ?>" width="45px"  alt="...">
                                                </div>
                                                <div class="comment_text">
                                                <b><?= $comment['f_name'].' '.$comment['l_name']; ?></b>
                                                <p><?= $comment['comment']; ?> </p>
                                                </div>
                                            </div>
                                            <?php if(get_comment_replays($db_con,$comment_id == 'Has_Replays')){ 
                                            
                                            $replays = mysqli_query($db_con,"SELECT comment_replays.replay, users.f_name , users.l_name ,users.photo FROM comment_replays INNER JOIN users ON comment_replays.user_id = users.id WHERE `comment_id` = '$comment_id'");
                                            while($replay = mysqli_fetch_assoc($replays)){ ?> 
                                            
                                                <div class="replay_comments d-flex" style="width: 100%;">
                                                    <div class="commnet_user me-3">
                                                    <img src="uploads/<?= $replay['photo']; ?>" width="45px"  alt="...">
                                                    </div>
                                                    <div class="comment_text">
                                                    <b><?= $replay['f_name'].' '.$replay['l_name']; ?></b>
                                                    <p><?= $replay['replay']; ?> </p>
                                                    </div>
                                                </div>
                                            <?php } } ?>
                                        </div>
                                        <div id="comment_link_<?= $comment_id; ?>">
                                            <span class="link" onclick="comment_replay_area(<?= $comment_id ; ?>)">Replay</span>
                                        </div>
                                        <div class=" mt-2 comment_replay_area" id="replay_area_<?= $comment_id; ?>">
                                            <div class="mb-2">
                                                <textarea id="replay_text<?= $comment_id; ?>" cols="30" class="form-control" rows="2" placeholder="Replay ..."></textarea>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-success" onclick="comment_replay(<?= $id; ?>,<?= $comment_id; ?>)">Replay</button>
                                            </div>
                                        </div>
                                            
                                    <?php } } ?>
                                </div>    
                                <?php }?>

                            

                        </div>
                    </div>
                </td>
            </tr>

            <!-- modal for edit data -->
            <div class="modal fade" id="updatePost<?= $all_blog['id']; ?>" tabindex="-1" aria-labelledby="updatePostLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updatePostLabel">Update Post Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="post_id" value="<?= $all_blog['id']; ?>">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Select Category</label>
                                    <select name="category" class="form-select" id="category" required>
                                        <option value="<?= $all_blog['category']; ?>" selected> <?= $all_blog['category']; ?> </option>
        
                                        <?php while ($upcategory = mysqli_fetch_array($upcategories)) { ?>
                                            <option value="<?= $upcategory['name']; ?>"> <?= $upcategory['name']; ?> </option> <!-- look the readme point 7 -->
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="type here ..." value="<?= $all_blog['subject'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea name="content" id="content" class="form-control" placeholder="type here ..." cols="30" rows="7"><?= $all_blog['content'] ?></textarea>
                                </div>
        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="updatePostBtn" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </tbody>
    </table>


</div>


<!-- Modal for create post-->
<div class="modal fade" id="createPost" tabindex="-1" aria-labelledby="createPostLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostLabel">Create your own post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select name="category" class="form-select" id="category" required>
                            <?php while ($category = mysqli_fetch_array($categories)) { ?>
                                <option value="<?= $category['name']; ?>"> <?= $category['name']; ?> </option> <!-- look the readme point 7 -->
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" id="subject" placeholder="type here ..." required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" class="form-control" placeholder="type here ..." cols="30" rows="7"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addPostBtn" class="btn btn-primary">Publish</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); // require the footer file 
?>