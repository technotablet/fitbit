## What is Fitbit Intraday Heart Rate Data?
Fitbit Trackers which have Heart Rate sensors in them capture the Heart Rate every few seconds. However, Fitbit's App provides the Heart Rate information in 5-minute intervals.

This code allows you to download the detailed data from Fitbit's website and either see it on a chart, or download it in an Excel.

## Why was this created?
I was quite emotionally charged up during a work seminar. Though I was sitting, I could feel my heart rate rising up. The Fitbit App was showing minimal heart rate increase, but I wanted to delve into more details. Since I could not find the detailed information easily available from the Fitbit App & Website, I used the Fitbit APIs to retrieve the data.

Learn more on how it looks at https://exain.wordpress.com/2017/07/26/fitbit-intraday-heartbeat-tracking-with-code

## Tutorial on doing Fitbit OAuth2
I created a YouTube tutorial to showcase how you can configure your Fitbit Developer account to do OAuth2, and then get a "Client ID", which you can use in the code.

https://youtu.be/_H5fFtsrfeU

## Demo Version
You can use https://exain.com/fitbit service to see a demo.

## How to Install
* You require PHP with MySQL Support and a publicly accessible server. **https** access is preferred.
* Download/Clone the code on your machine
* Create the database. The schema is available at `sql/default.sql`
* Provide the following values in `config.php`
  * Database Details (`$host`, `$user`, `$pass`, `$dbname`)
  * `$config_redirect_uri` - this will be the URL that is publicly accessible and hosted on your setup (e.g. `https://yourdomain.com/fitbit/token.php`
* Access the service through your URL