<?php
include('database_connection.php');

if (isset($_POST['name']) && isset($_POST['initials'])){
    
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $initial = mysqli_real_escape_string($connection, $_POST['initials']);

    $query = "INSERT INTO staff_details(StaffName, Initials) VALUES('$name', '$initial')";

    $result = $connection->query($query);

    if (!$result) die($connection->error);

}
header('location:staff.php');

?>