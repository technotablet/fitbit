<?php
include_once("config.php");

// If Client ID is provided, save it in session and try to authenticate
$fb_client_id = '';
if (isset($_POST['client_id']) && trim($_POST['client_id']) != "") {

	// Register Client ID in the Session
	$fb_client_id = safe(trim($_POST['client_id']));
	$_SESSION['fb_client_id'] = $fb_client_id;

	// Redirect to Fitbit for OAuth2
	header("Location: $config_oauth_url?response_type=token&scope=$config_scope&redirect_url=$config_redirect_uri&expires_in=$config_expires_sec&client_id=$fb_client_id");
	exit;
}


if (isset($_SESSION['fb_client_id'])) {
	$fb_client_id = $_SESSION['fb_client_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Fitbit Heart Rate Intraday Data</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Bootstrap Script -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
<body>

<!-- header -->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
		<a class="navbar-brand" href="./"><strong>Fitbit Heart Rate Intraday Data</strong></a>
		</div>
	</div>
</nav> <!-- /header -->

<div style='height:100px;'>
</div>

<div class="container">

	<div class="row">

		<div class="col-md-3 bg-info">

			<form action="index.php" method="post">
			<div class="form-group">
				<label for="exampleInputEmail1">Fitbit Client ID</label>
				<input type="text" class="form-control" name="client_id" id="client_id"  placeholder="Enter Fitbit Client ID" value="<?php echo $fb_client_id; ?>">
			</div>
			<button type="submit" class="btn btn-primary">Connect with Fitbit</button>
			</form>

			<div>
				<P>&nbsp;</P>
				<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
				<a href='https://youtu.be/_H5fFtsrfeU' target=_blank><strong>How to get Client ID?</strong></a>
			</div>

			<hr>

			<div class="well">
				<h4><span class="label label-default">Configuration Used</span></h4>
				<dl>
					<dt>Scope</dt>
					<dd><?php echo $config_scope; ?><BR><BR></dd>

					<dt>Redirect URL</dt>
					<dd><?php echo $config_redirect_uri; ?><BR><BR></dd>

					<dt>Expires in</dt>
					<dd><?php echo $config_expires_sec; ?> Seconds</dd>
				</dl>
			</div> <!-- /well -->

		</div> <!-- /col-md-3 client id form -->


		<div class="col-md-9 ">
			<h4>About Fitbit Intraday Heart Rate Service</h4>
			Through the Fitbit App, you can view heartrate information only in 5-minute intervals. However, your tracker is capturing your heartrate every few seconds.
			<P>
			The service available on this website allows you to connect to the Fitbit website and get your Intraday Heart Rate Data. You can:
			<ul>
				<li> Get detailed heartrate data from Fitbit Website
				<li> View the data on a chart and export it to an image
				<li> Export the data in Excel format
			</ul>
			<P>More information on why this service was created is available at 
			<ul>
				<li> <a href="https://exain.wordpress.com/2017/07/26/fitbit-intraday-heartbeat-tracking-with-code">https://exain.wordpress.com/2017/07/26/fitbit-intraday-heartbeat-tracking-with-code</a>
			</ul>
			</P>
			
			<P>
			The code is open source and you can setup a service for yourself on your server. Download it from GitHub at
			<ul>
				<li> <a href="https://github.com/technotablet/fitbit">https://github.com/technotablet/fitbit</a>
			</ul>
			</p>

			<hr>

			<h4>Privacy Information</h4>
			<p>
			The heartrate information is sensitive and not something you would want to disclose to anyone. Fitbit also prevents third party developers from accessing the heartrate data. By using this service, you
			<ul>
				<li> Setup a special developer account at Fitbit and generate your own credentials.
				<li> Do not provide any identifiable information except a 'Client ID', which cannot be linked to your account, and you can also delete it from the Fitbit Website.
				<li> Authenticate only through your Fitbit credentials.
				<li> Save the heartrate data along with your Client ID on this website, also to enable historical data review.
				<li> Have an option to setup your own service on your server without sharing data with anyone.
			</ul>
			</P>
		</div> <!-- /col-md-9 about -->

	</div> <!-- /row -->


	<hr>
	&copy; 2017 Vivek Kapoor, <a href='https://exain.wordpress.com'>https://exain.wordpress.com</a>

</div> <!-- /container -->


<script>
	$("#client_id").focus();
</script>

</body>
</html>


