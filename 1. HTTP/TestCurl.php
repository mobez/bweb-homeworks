<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Example of using curl</title>
</head>

<body>
<?php

// URL of the page you want to retrieve the content (more precisely : the source code)
$url = 'https://ru.wikipedia.org/wiki/CURL';
//$url = 'www.google.com';
// Initialize a cURL session
$ch = curl_init();


$options = array(
  CURLOPT_URL            => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER         => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_ENCODING       => "",
  CURLOPT_AUTOREFERER    => true,
  CURLOPT_CONNECTTIMEOUT => 120,
  CURLOPT_TIMEOUT        => 120,
  CURLOPT_MAXREDIRS      => 10,
);
curl_setopt_array( $ch, $options );

// Set some options
// - Specifies the URL which curl will access
curl_setopt($ch, CURLOPT_URL, $url);
// - Return the content by the curl_exec function instead of displaying content directly recovered
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// - Set a user-agent to send to the server. For example, you can send a user-agent of an Android phone, iPhone, ... to try to recover the contents of a mobile version of a website
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:21.0) Gecko/20100101 Firefox/21.0');
// - Execute the cURL session and stores the retrieved content in the variable $ result (through CURLOPT_RETURNTRANSFER optional)
$resultat = curl_exec ($ch);
$info = curl_getinfo($ch);
echo $info['http_code'];
// - Close a cURL session and thus the connection to the remote server
curl_close($ch);

// Displays the contents recovered by curl
echo $resultat;
?>
</body>
</html>