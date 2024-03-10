<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ 
    include_once "config.php";
    $logout_id = mysqli_real_escape_string($con, $_GET['logout_id']);
    if(isset($logout_id)){
      $status="Offline now";
      $query=mysqli_query($con, "UPDATE `users` SET status='{$status}' WHERE unique_id='{$logout_id}' ");
      if($query)
      {
        session_destroy();
        session_unset();
        header("location:../login.php");
      }
      else{
        header("location:../users.php");

      }
    }
    }else{
    header("location: ../login.php");
    }



?>