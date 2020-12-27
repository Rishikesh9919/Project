<?php
$id = $_GET['id'];
if (isset($_POST['Accept'])){
	require 'connection.php';
	$sql = "UPDATE website SET val = 2 WHERE id = '".$id."'";
    $query = mysqli_query($conn,$sql);
	header("Location:../admin-requests.php");
}
elseif(isset($_POST['Reject'])){
	require 'dbh.php';
	$sql = "DELETE FROM website WHERE id = '".$id."'";
    $query = mysqli_query($conn,$sql);
	header("Location:../admin-requests.php");
}
elseif(isset($_POST['Delete'])){
	require 'dbh.php';
	$sql = "DELETE FROM website WHERE id = '".$id."'";
    $query = mysqli_query($conn,$sql);
	header("Location:../admin-web.php");
}
?>