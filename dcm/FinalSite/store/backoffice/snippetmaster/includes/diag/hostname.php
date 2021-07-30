<?php
echo "Operating System: <b>" . PHP_OS . "</b><br>";	
echo "Virtual Website Hostname: <b>" . getVirtualHostname() . "</b><br>";
echo "Real Server Hostname: <b>" . getCananonicalHostname() . "</b><br>";



	function getVirtualHostname() {

		if(!minimum_php_version("4.1.0")) {
			$hostname = $_SERVER["SERVER_NAME"];
		}
		else {
			global $HTTP_SERVER_VARS;
			$hostname = $HTTP_SERVER_VARS["SERVER_NAME"];
		}

		if(substr($hostname,0,4) == "www.") {
			$hostname = substr($hostname,4);
		}
		return $hostname;
	}


	function getCananonicalHostname() {	

		$debug = true;

		if ($debug) { echo "Getting real server name...<br>"; }

		$IP = gethostbyname ($_SERVER["SERVER_NAME"]);
		$hostname = gethostbyaddr($IP);
		if ($debug) { 
			echo "Server IP: <b>" . $IP . "</b><br>";
			echo "Server Name: <b>" . $hostname . "</b><br>";
		}

		// Test to see if we have only numbers.  (We want the actual hostname and not the IP.)
		if (!preg_match("/[0-9]{1,3}\.[0-9]{1,3}/", $hostname)) {
			return $hostname;
		}
		else {
			if ($debug) {  echo "We have IPs only so let's try an alternate method to get real server name...<br>"; }
			
			//if ($hostname = `hostname`)) {
			if ($hostname = exec("hostname")) { 
				return $hostname;
			}
			else { 
				$hostname = "Couldn't get real (cananonical) server name for license verification.";
				return $hostname;
			}
		}
	}


		function minimum_php_version( $vercheck ) {
		$minver = explode(".", $vercheck);
		$curver = explode(".", phpversion());
		if (($curver[0] <= $minver[0]) 
			|| (($curver[0] == $minver[0]) && ($curver[1] < $minver[1]))
			|| (($curver[0] == $minver[0]) && ($curver[1] == $minver[1]) && ($curver[2][0] < $minver[2][0])))
			return true;
		else
			return false;
	}    
?>