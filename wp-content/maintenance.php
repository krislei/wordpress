<?php

/**
 * maintenance-switch
 *
 * @author    Fugu <info@fugu.fr>
 * @license   GPL-2.0+
 * @copyright 2015 Fugu
 */

// Displaying this page during the maintenance mode
$protocol = $_SERVER["SERVER_PROTOCOL"];

if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
    $protocol = 'HTTP/1.0';    

// Return 503 status code?
$return503 = '1';

if ( $return503 == '1' ) {
	header( "$protocol 503 Service Unavailable", true, 503 );
	header( 'Retry-After: 600' );
}

// Standards headers
header( 'Content-Type: text/html; charset=utf-8' );

$theme_file = '/data/wwwroot/default/wp-content/themes/Divi/maintenance.php';
$use_theme = '';

if ( $use_theme == '1' && file_exists( $theme_file ) ) {
	require_once $theme_file;
	die();
}

// Get the HTML code from plugin options ?>
<!DOCTYPE html><html lang="fr-FR">
<head>
	<meta charset="UTF-8">
	<title>康赛在线服务中心</title>
	<style>
		body { font-family: Helvetica, Arial, sans-serif; font-size:16px; color: #000; font-weight:normal; }
		#container { width: 600px; padding: 70px 0; text-align:center; position:absolute; left:50%; top:50%; -webkit-transform: translate(-50%, -50%);  -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%); }
		h1 { font-size: 36px; font-weight:normal; }
	</style>
</head>
<body class="home">
	<div id="container">
		<h1>康赛在线服务中心</h1>
		<p>
			In a permanent effort to improve our services, we currently are performing upgrades on our website.<br />
			We apologize for the inconvenience, but we will be pleased to see you back in a very few minutes.
		</p>
		<p>The maintenance team.</p>
	</div>
</body>
</html>

<?php 
// end
die(); 

?>