<?php
include('database_connection.php');

if (isset($_POST['studentno']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['initials']) && isset($_POST['discipline'])){

    $stdno = mysqli_real_escape_string($connection, $_POST['studentno']);
    $surname = mysqli_real_escape_string($connection, $_POST['surname']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $initial = mysqli_real_escape_string($connection, $_POST['initials']);
    $discipline = mysqli_real_escape_string($connection, $_POST['discipline']);


    $query = "INSERT INTO student_details(StudentNo, Surname, FirstName, Initials, Discipline) VALUES('$stdno', '$surname', '$name', '$initial', '$discipline')";

    $result = $connection->query($query);

    if (!$result) die($connection->error);
}

header('location:students.php');

?>