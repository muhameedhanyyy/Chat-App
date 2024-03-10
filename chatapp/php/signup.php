<?php
include_once "config.php";
session_start();
$fname = mysqli_real_escape_string($con, $_POST['fname']);
$lname = mysqli_real_escape_string($con, $_POST['lname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);
if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
 
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
 
        $query= "SELECT email FROM `users` WHERE  email='{$email}'";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
 
        if($count>0){
            echo"$email is already exist.";
        }
        else {
 
            if(isset($_FILES['image'])){
 
                $img_name = $_FILES['image'] ['name']; 
                $img_type = $_FILES['image']['type']; 
                $tmp_name = $_FILES['image'] ['tmp_name']; 
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode); 
                $extensions=['pnj' , 'jpeg' , 'jpg'];
 
                if(in_array($img_ext,$extensions) === true){
                    $time= time();
                    $new_img_name= $time.$img_name;
                    
                    if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                        $status="Active now";
                        $random_id = rand(time(), 10000000); 
                        $sql2 = mysqli_query($con, "INSERT INTO `users` 
                        VALUES (Null, {$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
 
                        if($sql2){
                                $sql3= mysqli_query($con ,"SELECT * FROM `users` WHERE email='{$email}'" );
                                if(mysqli_num_rows( $sql3)>0){
                                    $row= mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id']= $row['unique_id'];
                                    echo"success";
                                }
                        }
                        else{
                            echo"Something  went wrong! Please try again later.";
                        }
                    }
                }
 
            } else {
                echo"plese select an image file pnj , jpeg , jpg";
            }
        }
 
 
    } else{
        echo"All input values are required";
    }
 
}
 
 
 
?>