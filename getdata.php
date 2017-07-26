<?php
// Get data from Fitbit Website through its API

include_once("config.php");


// VALIDATE THE VARIABLES
// Step 1 - Validation of Date Availability
if (isset($_GET['date'])) {
	$date = $_GET['date'];
}
else {
	exit("No date information is provided. Please provide date in YYYY-MM-DD format.");
}

// Step 2 - Validation of Date Format
if (!validateDate($date . ' 00:00:00')) {
	exit("Date is not in a valid format. Please use YYYY-MM-DD Format. Sorry.");
}

// Step 3 - Validation of Access Token
if (!isset($_SESSION['fb_access_token']) || trim($_SESSION['fb_access_token']) == "") {
	exit("No access token available. Please <a href='./index.php'>try again</a>.");
} else {
	$access_token = trim($_SESSION['fb_access_token']);
}

// Step 4 - Validation of Client ID
if (!isset($_SESSION['fb_client_id']) || trim($_SESSION['fb_client_id']) == "") {
	exit("No access token available. Please <a href='./index.php'>try again</a>.");
} else {
	$fb_client_id = trim($_SESSION['fb_client_id']);
}

// GET DATA FROM FITBIT
// Step 1 - Prepare URL
$url = "$config_api_url/$date/1d/1sec/time/00:00/23:59.json";
$headers = array("Authorization: Bearer $access_token");

// Step 2 - Get from Fitbit
$data = curl($url,$headers);

// Step 3 - Sanitize
$date = safe($date);
$user = safe($fb_client_id);
$data = safe($data);

// Step 4 - Insert into database
$q = "insert into `data_raw` set fbuser = '$user', fbdate='$date', fbjsondata='$data'
ON DUPLICATE KEY update fbjsondata='$data'";
if (mysqli_query($config_conn, $q)) {
	header("Location: data.php?date=$date&rand=".rand());
} else {
	exit("There was an error synchronising with Fitbit");
}

?>