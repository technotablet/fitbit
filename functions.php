<?php

// Fetch Information through curl
function curl($url,$headers) {

	$options = array(
		CURLOPT_RETURNTRANSFER => true,         // return web page
		CURLOPT_HEADER         => false,        // don't return headers
		CURLOPT_FOLLOWLOCATION => true,         // follow redirects
		CURLOPT_ENCODING       => false,           // handle all encodings
		CURLOPT_USERAGENT      => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:45.0) Gecko/20100101 Firefox/45.0",
		CURLOPT_AUTOREFERER    => true,         // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
		CURLOPT_TIMEOUT        => 120,          // timeout on response
		CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
		CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
		CURLOPT_SSL_VERIFYPEER => false,        //

		CURLOPT_HTTPHEADER => $headers,
	);

	$ch = curl_init ($url);

	curl_setopt_array($ch,$options);

	$BodyText = (curl_exec($ch));

	if (trim($BodyText) == '')  {
		$BodyText = 'No Content';
	}

	curl_close($ch);

	return $BodyText;
}

// Convert object to array  
function objectToArray($d) {
	if (is_object($d)) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars($d);
	}

	if (is_array($d)) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
}

// To Validate Date
function validateDate($date, $format = 'Y-m-d H:i:s')
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

// To sanitize MySQL input
function safe($data) {
	global $config_conn;
	return mysqli_real_escape_string($config_conn,$data);
}  
?>