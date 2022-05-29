<?php require_once('header.php'); 
$input = $_GET['search_value'];
$search_query = mysqli_query($db_con,"SELECT * FROM `users` WHERE `f_name` LIKE '%$input%' OR `l_name` LIKE '%$input%'");

?>


<h3 class="my-3 ps-2 text-primary">Showing result with "<?= $input ?>"</h3>

<?php while($resut = mysqli_fetch_assoc($search_query)){ ?> 
    <div class="card mb-3">
        <div class="card-body">

            <div class="d-flex align-items-center mb-2">
                <a class="link" href="view_profile.php?user_id=2">

                    <img src="../uploads/<?= $resut['photo'] ?>" width="30px" class="me-2 alt=">
                    <span class="post_by"><?= $resut['f_name'].' '.$resut['l_name'] ?> </span>
                </a>
            </div>


        </div>
    </div>

<?php } ?>

<!-- print_r($_POST); -->


<? require_once('footer.php');




?>