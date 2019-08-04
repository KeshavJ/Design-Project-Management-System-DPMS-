<?php
	include('database_connection.php');
	$id=$_GET['id'];
	$query = "DELETE FROM project_list WHERE TopicNumber = '$id'";
    $result = $connection->query($query);

$query = "DELETE FROM project_allocation WHERE TopicNumber = '$id'";
    $result = $connection->query($query);

        if (!$result) die($connection->error);
	header('location:projects.php');

?>