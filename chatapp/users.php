<?php
session_start();
include('header.php');
include_once('./php/config.php');
if(!isset($_SESSION['unique_id']))
header( "Location: login.php" );
$id= $_SESSION['unique_id'];  
$query = "SELECT  * FROM users WHERE unique_id='".$id."'";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$query2=mysqli_query($con,"SELECT  * FROM users");




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KooTa App</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>

    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="./php/images/<?= $row['img']?>" alt="">
                    <div class="details">
                        <span><?=  $row["fname"] . " ". $row["lname"] ?></span>
                        <p><?php $row["status"]?></p>
                    </div>
                </div>
                <a href="./php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select a user to start chat</span>
                <input type="text" placeholder="Search users...">
                <button><i class="fa fa-search"></i></button>
            </div>

        </section>
        <div class="users-list">
           
        </div>
      </div>
      <script src="javascript/users.js"></script>

</body>
</html>