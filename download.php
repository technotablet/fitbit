<?php
include_once("config.php");

// Get date or set default for today
$date = date("Y-m-d");
if (isset($_GET['date'])) {
	$date = $_GET['date'];
}

// VALIDATION
// Step 1 - Date Validation
if (!validateDate("$date 00:00:00")) {
	exit("Date is not valid. Please use YYYY-MM-DD format.");
}

// Step 2 - Do not proceed if Client ID is not set
if (!isset($_SESSION['fb_client_id']) || $_SESSION['fb_client_id'] == '') {
	exit("Client ID not available. Please <a href='index.php'>try again</a>");
} else {
	$fb_client_id = $_SESSION['fb_client_id'];
}

// filename for download
$filename = "Fitbit-Intraday-Heartrate-$fb_client_id-$date.xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

// Query the data
$q = "select id, fbjsondata from `data_raw` where fbdate='$date' and fbuser='$fb_client_id'";
$result = mysqli_query($config_conn, $q);

$seriesarr = array();
if (mysqli_num_rows($result) > 0) {

	$series_raw = mysqli_fetch_row($result);
	$series = objectToArray(json_decode($series_raw[1]));

	foreach ($series['activities-heart-intraday']['dataset'] as $key=>$value) {
		$time = $value['time'];
		$hb = $value['value'];

		$timearr = explode(":",$time);
		$datearr = explode("-",$date);
		$seriesarr[] = "[Date.UTC($datearr[0],$datearr[1]-1,$datearr[2],$timearr[0],$timearr[1],$timearr[2]), $hb]";
	}

}

?>

<table class="table table-bordered" id='hrdata'>
<thead>
	<th>Date &amp; Time</th>
	<th>Heart Rate</th>
</thead>


<?php

if (mysqli_num_rows($result) == '0') {
	echo "<tr><td colspan=2 style='height:200px;'>No data available</td></tr>\n";
}

foreach ($series['activities-heart-intraday']['dataset'] as $key=>$value) {
	echo "<tr><td>$date $value[time]</td><td>$value[value]</td></tr>\n";
}

?>

</table>
