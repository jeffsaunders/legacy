<?
error_reporting(E_ALL ^ E_NOTICE);
	if ($_SERVER["PHP_AUTH_USER"] && $_SERVER["PHP_AUTH_PW"] && ereg("^Basic ", $_SERVER["HTTP_AUTHORIZATION"])) {
		list($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]) = explode(":", base64_decode(substr($_SERVER["HTTP_AUTHORIZATION"], 6)));
	}
	$authenticated = false;
		if ($_SERVER["PHP_AUTH_USER"] || $_SERVER["PHP_AUTH_PW"]) {
		// Put the necessary code for checking u
		//     sername/passwords here.
		$authenticated = ($_SERVER["PHP_AUTH_USER"] == "dtobler" && $_SERVER["PHP_AUTH_PW"] == "access");
	}
	if(!$authenticated) {
		header("WWW-Authenticate: Basic realm=\"Cybermight-Authentication\"");
	if (ereg("Microsoft", $_SERVER["SERVER_SOFTWARE"])) {
		header("Status: 401 Unauthorized");
	} else {
		header("HTTP/1.0 401 Unauthorized");
		echo "Access denied";
		exit;
	}
}
?>
<?phpinfo();?>