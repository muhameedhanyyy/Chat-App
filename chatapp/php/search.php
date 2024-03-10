<?php
include('./config.php');
session_start();
$outgoing_id=$_SESSION['unique_id'];
$searchTerm=mysqli_real_escape_string($con,$_POST['searchTerm']);
$output="";
$query=mysqli_query($con, "SELECT  *  FROM  `users` where not unique_id= {$outgoing_id} AND(fname LIKE '%{$searchTerm}%' OR  lname LIKE '%{$searchTerm}%')") ;
if(mysqli_num_rows($query)>0)
{
    include('data.php');
}
else{
        echo "NO user found";
}
echo  $output;
?>