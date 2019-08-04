<?php
include('database_connection.php');

$id = mysqli_real_escape_string($connection, $_GET['id']);

if (isset($_POST['topic']) && strlen(trim($_POST['description'])) && isset($_POST['supervisor']) && isset($_POST['discipline'])){

    $topic = mysqli_real_escape_string($connection, $_POST['topic']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $supervisorid = mysqli_real_escape_string($connection, $_POST['supervisor']);
    $discipline = mysqli_real_escape_string($connection, $_POST['discipline']);


    $queryGetSupervisor = "SELECT StaffName FROM staff_details WHERE StaffID = '$supervisorid'";
    $resultGetSupervisor = $connection->query($queryGetSupervisor);
    if (!$resultGetSupervisor) die($connection->error);  

    while($rowGetSupervisor = mysqli_fetch_assoc($resultGetSupervisor)) {



        $supervisor = $rowGetSupervisor['StaffName'];

    }

    $query = "UPDATE project_list SET Topic = '$topic', Description = '$description', Supervisor = '$supervisor', SupervisorId = '$supervisorid', Discipline = '$discipline' WHERE TopicNumber = '$id'";

    $result = $connection->query($query);

    if (!$result) die($connection->error);

    $query = "UPDATE project_allocation SET Topic = '$topic', Description = '$description', Supervisor = '$supervisor', SupervisorId = '$supervisorid' WHERE TopicNumber = '$id'";

    $result = $connection->query($query);

    if (!$result) die($connection->error);
}

header('location:projects.php');

?>