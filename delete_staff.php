<?php
	include('database_connection.php');
	$id=$_GET['id'];
	$query = "DELETE FROM staff_details WHERE StaffID = '$id'";
    $result = $connection->query($query);

        if (!$result) die($connection->error);
	header('location:staff.php');

?>