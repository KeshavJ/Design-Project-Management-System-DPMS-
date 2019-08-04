<?php
	include('database_connection.php');
	$id=$_GET['id'];
	$query = "DELETE FROM student_details WHERE StudentNo = '$id'";
    $result = $connection->query($query);

        if (!$result) die($connection->error);
	header('location:students.php');

?>