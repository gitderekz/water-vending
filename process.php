<?php

session_start();
$id = 0;
$name = '';
$card = '';
$volume = '';
$balance = '';
$amount = '';
$update = false;
date_default_timezone_set('Africa/Nairobi');
$datetime = new DateTime();
$date = $datetime->format('Y-m-d H:i:s');

$mysqli = new mysqli('localhost', 'root', '', 'water_vending') or die(mysqli_error($mysqli));
if (isset($_POST['save_clients'])) {
	$name = $_POST['name'];
	$card = $_POST['card'];
	$balance = $_POST['balance'];

	$mysqli->query("INSERT INTO clients (name,card,balance) VALUES('$name','$card','$balance')") or die($mysqli->error);

	$_SESSION['message'] = "ONE RECORD SAVED!";
	$_SESSION['msg_type'] = "success";

	header("location: clients.php");
}
if (isset($_POST['sales'])) {
	// $date = $date->format('Y-m-d H:i:s');
	$card = $_POST['card'];
	$volume = $_POST['volume'];
	$amount = $_POST['amount'];

	$mysqli->query("INSERT INTO sales (date_now,card,volume,amount) VALUES('$date','$card','$volume','$amount')") or die($mysqli->error);

	$_SESSION['message'] = "ONE RECORD SAVED!";
	$_SESSION['msg_type'] = "success";

	header("location: index.php");
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$mysqli->query("DELETE FROM clients WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "ONE RECORD DELETED!";
	$_SESSION['msg_type'] = "danger";

	header("location: clients.php");
}
if (isset($_GET['disable'])) {
	$id = $_GET['disable'];

	$mysqli->query("SELECT * FROM clients WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "ONE CARD DISABLED!";
	$_SESSION['msg_type'] = "warning";

	header("location: clients.php");
}

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;

	$result = $mysqli->query("SELECT * FROM clients WHERE id=$id") or die($mysqli->error());
	// if (count($result)==1) {
	// if ($result->num_rows) {
	if (mysqli_num_rows($result)) {
		$row = $result->fetch_array();
		$name = $row['name'];
		$card = $row['card'];
		$balance = $row['balance'];
	}

	$_SESSION['message'] = "YOU ARE ABOUT TO EDIT ONE ECORD!";
	$_SESSION['msg_type'] = "warning";

	
}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$card = $_POST['card'];
	$balance = $_POST['balance'];
	$mysqli->query("UPDATE clients SET date_now='$date', name='$name',card='$card', balance='$balance' WHERE id=$id") or die($mysqli->error);

	$_SESSION['message'] = "ONE RECORD EDITED!";
	$_SESSION['msg_type'] = "success";

	header("location: clients.php");
}