<?php

    session_start();
    include_once("config.php") ;
    
    $outgoing_id= $_SESSION['unique_id'];
    $query = mysqli_query($con , "SELECT * FROM users where not unique_id= {$outgoing_id}" ) ;
    $output = "" ;
    if (mysqli_num_rows($query) == 1) {
        $output .= "No users are available to chat" ;
    } else {

       include('data.php');
    }

    echo $output ;
?>