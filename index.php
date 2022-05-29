<?php require_once('header.php'); // require the header file 
// require check like file for check if like
require_once('admin/functions/check_like.php');

$get_blog_query = "SELECT blogs.id,blogs.category,blogs.subject,blogs.content,blogs.status , blogs.user_id , users.f_name,users.l_name,users.photo FROM blogs INNER JOIN users ON blogs.user_id = users.id ORDER BY blogs.id DESC"; //this is the join of 2 tables 1st i took user id in blog table then i join user table with blog table with user id
// $get_blog_query = "SELECT * FROM blogs";
$blogs = mysqli_query($db_con, $get_blog_query);
?>

<div class="home_area">

  <table style="width: 100%;" class="data-table">
    <thead>
      <tr>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <!-- show all the latest blog -->
      <?php while ($blog = mysqli_fetch_assoc($blogs)) {
        if ($blog['status'] == 'Active') { //check status active 
      ?>

          <tr>
            <td>
              <div class="card mb-3">
                <div class="card-body">

                  <div class="d-flex align-items-center mb-2">
                    <a class="link" href="view_profile.php?user_id=<?= $blog['user_id'] ?>">

                      <img src="uploads/<?= $blog['photo']; ?>" width="30px" class="me-2" alt="User Photo">
                      <span class="post_by"><?= $blog['f_name'] . ' ' . $blog['l_name']; ?> </span>
                    </a>
                  </div>
                  <h5 class="card-title"><?= $blog['subject']; ?> </h5>

                  <p class="text-disabled"><?= $blog['category']; ?></p>
                  <p class="card-text"><?= $blog['content']; ?></p>

                  <div class="text-muted">
                    Likes <span class="like_count_text_<?= $blog['id']; ?>"><?= count_likes($blog['id'], $db_con) ?></span> , comments <span class="comment_count_text_<?= $blog['id']; ?>"><?= count_comments($blog['id'], $db_con) ?></span>
                  </div>
                </div>
                <div class="card-footer">

                  <!-- like section -->
                  <button id="blogLike_<?= $blog['id']; ?>" onclick="like(<?= $id; ?>,<?= $blog['id']; ?>)" class="button wid_120 <?php if (check_like($id, $blog['id'], $db_con) == 'Liked') { echo 'liked'; } else { echo 'out-line-blue'; } ?>">Like </button>

                  <!-- comment section -->
                  <button onclick="show_comment_area(<?= $blog['id']; ?>)" class="button btn-primary wid_120 mr-2">Comment</button>
                  <div class="comment_area" id="blogComment_<?= $blog['id']; ?>">
                    <!-- comment  section -->
                    <?php if (check_comment($blog['id'], $db_con) == 'Has Comment') {
                      //  show the comments 
                      $blog_id = $blog['id'];
                      
                      $comments = mysqli_query($db_con, "SELECT comment.id,comment.comment , users.f_name , users.l_name ,users.photo FROM comment INNER JOIN users ON comment.user_id = users.id WHERE `blog_id` = '$blog_id' ORDER BY comment.id DESC"); // query for show comment and user name
                      while ($comment = mysqli_fetch_assoc($comments)) { $comment_id = $comment['id']; ?>
                      <div class="comment_item">
                        <div class="comments d-flex" style="width: 100%;">
                          <div class="commnet_user me-3">
                            <img src="uploads/<?= $comment['photo']; ?>" width="45px" alt="...">
                          </div>
                          <div class="comment_text">
                            <b><?= $comment['f_name'] . ' ' . $comment['l_name']; ?></b>
                            <p><?= $comment['comment']; ?> </p>
                          </div>
                        </div>
                        <?php if (get_comment_replays($db_con, $comment_id == 'Has_Replays')) {

                          $replays = mysqli_query($db_con, "SELECT comment_replays.replay, users.f_name , users.l_name ,users.photo FROM comment_replays INNER JOIN users ON comment_replays.user_id = users.id WHERE `comment_id` = '$comment_id' ORDER BY comment_replays.id DESC");
                          while ($replay = mysqli_fetch_assoc($replays)) { ?>

                            <div class="replay_comments d-flex" style="width: 100%;">
                              <div class="commnet_user me-3">
                                <img src="uploads/<?= $replay['photo']; ?>" width="45px" alt="...">
                              </div>
                              <div class="comment_text">
                                <b><?= $replay['f_name'] . ' ' . $replay['l_name']; ?></b>
                                <p><?= $replay['replay']; ?> </p>
                              </div>
                            </div>
                            <?php } } ?>
                        </div>
                        
                      <?php } } ?>
                        
                    

                    <!-- comment form -->
                    <div class="commnet_form my-2" id="commnet_form_<?= $blog['id']; ?>">

                      <div class="mb-2">
                        <textarea id="comment_text<?= $blog['id']; ?>" cols="30" class="form-control" rows="2" placeholder="write a comment"></textarea>
                      </div>
                      <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-success" onclick="comment(<?= $id; ?>,<?= $blog['id']; ?>)">Post</button>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </td>
          </tr>
      <?php }
      }  ?>
    </tbody>
  </table>



</div>

<?php require_once('footer.php'); // require the footer file 
?>