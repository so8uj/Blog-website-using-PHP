<?php require_once('header.php'); require_once('db/db.php');
    // delete category
    if(isset($_GET['delete_category'])){
        $cat_id = base64_decode($_GET['delete_category']);
        mysqli_query($db_con,"DELETE FROM `categories` WHERE `id` = '$cat_id'"); //delete query
        header("Location: category.php?category_deleted");
    }

    // all categories

    $all_categories = mysqli_query($db_con,"SELECT * FROM `categories`");


    // add categories

    if(isset($_POST['add_category_btn'])){
        $name = $_POST['name'];
        $query = mysqli_query($db_con,"INSERT INTO `categories` (`name`) VALUES ('$name')");
        if($query == true){
            header("Location: category.php?category_added");
        }else{
            header("Location: category.php?error");
        }
        mysqli_close($db_con);
    }


?>

<div class="row categoris_area">
    <div class="col-sm-7">
    <?php if (isset($_GET['category_deleted'])) { ?><div class="alert alert-danger">Category Deleted</div> <?php } ?>
        <h5 class="page_title">Categories</h5>

        <div class="categories">
            <div class="card">
                <ul class="list-group list-group-flush">

                    <?php while($all_category = mysqli_fetch_assoc($all_categories)){ ?>
                        <li class="list-group-item">
                        <div class="d-flex justify-content-between"><span><?= $all_category['name']; ?></span><a href="<?= $_SERVER['PHP_SELF'].'?delete_category='.base64_encode($all_category['id']) ?>" class="btn btn-sm btn-danger">Delete</a></div>
                            
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>


    </div>
    <div class="col-sm-5">
        <div class="cat_add">

            <?php if(isset($_GET['category_added'])){ ?> <div class="alert alert-success">Category added</div> <?php } ?>
            <?php if(isset($_GET['error'])){ ?> <div class="alert alert-danger">Server Error</div> <?php } ?>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="mb-4">
                    <label for="cat" class="form-label">Add new category</label>
                    <input type="text" name="name" class="form-control" id="cat" placeholder="Sports">
                </div>
                <div class="mb-4">
                    <button name="add_category_btn" class="btn out-line-blue wid_120">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>