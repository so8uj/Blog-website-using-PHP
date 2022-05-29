<?php require_once('header.php');

$get_blog_query = "SELECT blogs.id,blogs.user_id,blogs.category,blogs.subject,blogs.content,blogs.status, users.f_name,users.l_name,users.photo FROM blogs INNER JOIN users ON blogs.user_id = users.id ORDER BY blogs.id DESC"; //this is the join of 2 tables 1st i took user id in blog table then i join user table with blog table with user id
$blogs = mysqli_query($db_con, $get_blog_query);

// active and deactive blog ( just go and change the status from database )
if (isset($_GET['deactive_blog'])) {
  $blog_id = base64_decode($_GET['deactive_blog']);
  mysqli_query($db_con, "UPDATE `blogs` SET `status`= 'Deactive' WHERE `id` = '$blog_id'"); //update query
  header("Location: all_posts.php");
}
if (isset($_GET['active_blog'])) {
  $blog_id = base64_decode($_GET['active_blog']);
  mysqli_query($db_con, "UPDATE `blogs` SET `status`= 'Active' WHERE `id` = '$blog_id'"); //update query
  header("Location: all_posts.php");
}
if (isset($_GET['delete_blog'])) {
  $blog_id = base64_decode($_GET['delete_blog']);
  mysqli_query($db_con, "DELETE FROM `blogs` WHERE `id` = '$blog_id'"); //update query
  header("Location: all_posts.php?deleted");
}
?>

<!-- page content -->

<div class="table_area">
  <?php if (isset($_GET['deleted'])) { ?><div class="alert alert-danger">Category Deleted</div> <?php } ?>
  <table class="data-table table table-hover" style="width: 100%;">
    <thead>
      <tr>
        <th>Post By</th>
        <th>Category</th>
        <th>Subject</th>
        <th>Status</th>
        <th>Conten</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- while loop for showing data -->
      <?php while ($blog = mysqli_fetch_assoc($blogs)) { ?>

        <tr>
          <td>

            <a class="link" href="view_profile.php?user_id=<?= $blog['user_id'] ?>">
              <div class="d-flex align-items-center mb-2">
                <img src="../uploads/<?= $blog['photo']; ?>" width="30px" class="me-2" alt="User Photo">
                <span class="post_by"><?= $blog['f_name'] . ' ' . $blog['l_name']; ?></span>
              </div> 
            </a>
          </td>

          <td><?= $blog['category']; ?></td>
          <td><?= $blog['subject']; ?></td>
          <td><?= $blog['status']; ?></td>
          <td><?= $blog['content']; ?></td>

          <td class="d-grid gap-2">
            <?php if ($blog['status'] == 'Active') { ?>
              <a href="<?= $_SERVER['PHP_SELF'] . '?deactive_blog=' . base64_encode($blog['id']) ?>" class="btn btn-sm btn-warning">Deactivate</a>
            <?php } else { ?>
              <a href="<?= $_SERVER['PHP_SELF'] . '?active_blog=' . base64_encode($blog['id']) ?>" class="btn btn-sm btn-success">Activate</a>
            <?php } ?>
            <a href="<?= $_SERVER['PHP_SELF'] . '?delete_blog=' . base64_encode($blog['id']) ?>" class="btn btn-sm btn-danger">Delete</a>

          </td>
        </tr>

      <?php } ?>

    </tbody>
  </table>
</div>

<?php require_once('footer.php'); ?>
