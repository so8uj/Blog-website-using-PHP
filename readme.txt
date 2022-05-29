Hello 
For your understand i make some note for you hope you like it.
===============================================================

=====================================
For Configuretion 
=====================================

1. Here you have project_9.sql just create a new batabase in your localhost and name it accourding your choise.

2. Go admin/db/db.php and edit $db_name = 'project_9' to $db_name = 'accourding your database name';
 
3. And put all the files your root folder and run it.


=====================================
PHP Related
=====================================


1. PHP format short <?php ?> to <? ?>

2. Short echo <?php echo 'name'; ?> to <?= 'name'; ?>

3. <?php echo $_SERVER['PHP_SELF'] ?> to <?= $_SERVER['PHP_SELF'] ?> which are used in form action part

4. For show data from database first make a query(mysqli_query) and fetch all the data with 
(mysqli_fetch_assoc).

5. if data is single the just make a variable  like $user = mysqli_fetch_assoc($user_query).

6. if data is multiple just make a variable  like $user = mysqli_fetch_assoc($user_query) and putinto a while loop and each time loop will run and show the data one by one .

7.this is the best way to combine code with html and php like first open php (<?php) and close php (?>) and run all the html codes then if you need again open php (<?php) and close php (?>). (complex way --- 
<?php if($name == 'Sobuj'){ 
    echo '<h1> My Name</h1>'; }
?>) here you don't find which was html file and it confushed if you code like this  (simple and professional way -----

<?php if($name == 'Sobuj'){ ?>
    now run all html code you need. 
<?php } ?>

=====================================
for mysql data base quiiery
=====================================

1. all select = SELECT * FROM `datatable name`;

2. select group , slect by a user or select by a blog =  SELECT * FROM `datatable name` WHERE `table filed name` = 'value'; like i have only id query will be WHERE `id` = 1 , or i have blog or user id or name any think just do this `filed name` = 'filed value'.

3. update = UPDATE `table name` SET `filed`=[value-1],`filed`=[value-2],`filed`=[value-3] WHERE `filed` = 'value'.

4. delete = DELETE * FROM `datatable name`;




=============================================
Developer Info
=============================================
Name : Mohammad Sobuj
Email : developersobuj@gmail.com
What's app number : 01889773336 

if you can't find me in fiverr just leave a message in what's app i'm alwyas free to help you and you have 10 rivision so don't worry. 

Thanks From Sobuj.
