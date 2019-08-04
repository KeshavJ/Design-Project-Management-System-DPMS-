<?php
include('database_connection.php');

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


    $query = "INSERT INTO project_list(Topic, Description, Supervisor, SupervisorId, Discipline) VALUES('$topic', '$description', '$supervisor', '$supervisorid', '$discipline')";

    $result = $connection->query($query);



    if (!$result){
        die($connection->error);
    } 
    else{
        $last_id = mysqli_insert_id($connection);
    }





    $query = "INSERT INTO project_allocation(TopicNumber, Topic, Description, Supervisor, SupervisorId) VALUES('$last_id', '$topic', '$description', '$supervisor', '$supervisorid')";

    $result = $connection->query($query);

    if (!$result) die($connection->error);
}

header('location:projects.php');

?>