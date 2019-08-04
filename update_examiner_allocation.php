<?php
include('database_connection.php');

$id = mysqli_real_escape_string($connection, $_GET['id']);


if (isset($_POST['examiner']) && isset($_POST['time']) && isset($_POST['venue'])){


    $examinerid = mysqli_real_escape_string($connection, $_POST['examiner']);
    $timeid = mysqli_real_escape_string($connection, $_POST['time']);
    $venue = mysqli_real_escape_string($connection, $_POST['venue']);



    $queryGetexaminer = "SELECT StaffName FROM staff_details WHERE StaffID = '$examinerid'";
    $resultGetexaminer = $connection->query($queryGetexaminer);
    if (!$resultGetexaminer) die($connection->error);  

    while($rowGetexaminer = mysqli_fetch_assoc($resultGetexaminer)) {

        $examiner = $rowGetexaminer['StaffName'];

    }



    $queryGetTime = "SELECT StartTime, Days FROM time WHERE TimeId = '$timeid'";
    $resultGetTime = $connection->query($queryGetTime);
    if (!$resultGetTime) die($connection->error);  

    while($rowGetTime = mysqli_fetch_assoc($resultGetTime)) {


        $timeNew = date("H:i ",strtotime($rowGetTime['StartTime']));
        $dayNew = $rowGetTime['Days'];

    }


    $query = "UPDATE project_allocation SET Examiner = '$examiner', ExaminerId = '$examinerid', Day = '$dayNew', Time = '$timeNew', TimeId = '$timeid', Venue = '$venue' WHERE TopicNumber = '$id'";

    $result = $connection->query($query);

    if (!$result) die($connection->error);

    $queryEdit = "UPDATE project_allocation SET Edited = 'Yes'";

    $resultEdit = $connection->query($queryEdit);
    if (!$resultEdit) die($connection->error);


}

header('location:Examiner_allocation.php');

?>