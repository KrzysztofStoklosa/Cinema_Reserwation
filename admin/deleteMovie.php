<?php 
    $id = $_GET['id'];
    $link = mysqli_connect("localhost", "root", "", "cinema_db");

    $sql = "DELETE FROM movieTable WHERE movieID = $id"; 
    $sql1 = "DELETE FROM movie__halls WHERE movieID = $id"; 
    
    if ($link->query($sql) === TRUE && $link->query($sql1)===TRUE ) {
        header('Location: /Cinema-Reservation/admin/admin.php');
        exit;
    } else {
        echo "Error: " . $link->error;
    }
?>