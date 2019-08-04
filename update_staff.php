<?php
include('database_connection.php');

$id = mysqli_real_escape_string($connection, $_GET['id']);

if (isset($_POST['name']) && isset($_POST['initials'])){

    $name = mysqli_real_escape_string($connection, $_POST['name']);  
    $initial = mysqli_real_escape_string($connection, $_POST['initials']);


    $query = "UPDATE staff_details SET StaffName = '$name', Initials = '$initial' WHERE StaffID = '$id'";

    $result = $connection->query($query);

    if (!$result) die($connection->error);
}

header('location:staff.php');

?>