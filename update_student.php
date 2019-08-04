<?php
include('database_connection.php');

$id = mysqli_real_escape_string($connection, $_GET['id']);

if (isset($_POST['studentno']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['initials']) && isset($_POST['discipline'])){

    $stdno = mysqli_real_escape_string($connection, $_POST['studentno']);
    $surname = mysqli_real_escape_string($connection, $_POST['surname']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $initial = mysqli_real_escape_string($connection, $_POST['initials']);
    $discipline = mysqli_real_escape_string($connection, $_POST['discipline']);



    $query = "UPDATE student_details SET StudentNo = '$stdno', Surname = '$surname', FirstName = '$name', Initials = '$initial', Discipline = '$discipline' WHERE StudentNo = '$id'";

    $result = $connection->query($query);

    if (!$result) die($connection->error);

}
header('location:students.php');

?>