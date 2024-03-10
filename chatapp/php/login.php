<?php
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);    
    if(!empty($email) && !empty($password)){
    $query=mysqli_query($con, "SELECT * FROM `users` WHERE email='{$email}' AND password='{$password}'"); 
    $row=mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query)>0){
        $status="Active now";
        $query2=mysqli_query($con, "UPDATE `users` SET status='{$status}' WHERE unique_id='{$row['unique_id']}' ");
        if($query2){
        $_SESSION['unique_id']=$row['unique_id'];
        echo"success";
        }
    }  

else{
    echo"Email or password are incorrect";
}
}

else{
    echo"All input fields are required";
}

?>