<?php
// session start for check login
session_start();

if(!isset($_SESSION['login_id'])){
    header('Location: signin.php');
}
//get the user details from session
require_once('db/db.php');
$id =$_SESSION['login_id'];
$user_query = mysqli_query($db_con,"SELECT * FROM `users` WHERE `id` = $id");
$user = mysqli_fetch_assoc($user_query); // Here i have all the information from user from database and catch data define user variable and data filed name
// get page name and active menu  item
$get_page = $_SERVER['PHP_SELF']; //main page like 
$page = explode('/', $get_page); // devide page 
$page = end($page); //get the last value like index.php,categories.php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OneComunity</title>


    <!-- CSS FILES -->

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!--dataTable-->
    <link rel="stylesheet" href="../vendor/data-table/media/css/dataTables.bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../asset/css/style.css">
    <style>
        
    </style>
</head>

<body>


    <!-- main content container -->

    <div class="main-content">
        <!-- header -->
        <div class="header admin_header">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto align-items-center mb-2 mb-lg-0">
                            <li class="nav_item">
                                <a class="nav-link menu-item <?php if ($page == 'index.php') echo 'nav_active'; ?>" href="index.php">Users</a>
                            </li>
                            <li class="nav_item">
                                <a class="nav-link menu-item <?php if ($page == 'all_posts.php') echo 'nav_active'; ?>" href="all_posts.php">Posts</a>
                            </li>
                            <li class="nav_item">
                                <a class="nav-link menu-item <?php if ($page == 'category.php') echo 'nav_active'; ?>" href="category.php">Categories</a>
                            </li>
                            <li class="nav_item">
                                <a class="nav-link menu-item <?php if ($page == 'my_profile.php') echo 'nav_active'; ?>" href="my_profile.php">My Profile</a>
                            </li>

                            <li class="nav_item">
                                <form class="d-flex" method="GET" action="search.php">
                                    <input class="form-control me-2" name="search_value" type="search" placeholder="Search" aria-label="Search User" required>
                                    <button class="btn btn-outline-primary" type="submit">Search</button>
                                </form>
                            </li>
                            <li class="nav_item">
                                <a class="button small-button button-red radius" href="../logout.php">Logout</a>

                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>

        <!-- page content -->