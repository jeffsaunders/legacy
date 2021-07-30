<table width="900" cellspacing="20" cellpadding="0" align="center">
<tr>
	<td colspan="2" align="center" class="xbigDarkGray"><br>CellBenefits/PhoneBenefits/VoiceBenefits Mobile Phone Affinity Sales Sites</td>
</tr>
<tr>
	<td colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
</tr>
<tr>
	<td align="center" valign="top" class="bodyDarkGray">
		<a href="http://apple.cellbenefits.nr.net/" target="_blank" class="bodyDarkGray"><img src="images/CellbenefitsThumb.jpg" alt="" title="Click to Visit Active Sprint Demo Site" 
width="500" border="1"><br>Click to Visit Active Sprint Demo Site</a><br><br>
		<a href="http://yahoo.phonebenefits.nr.net/" target="_blank" class="bodyDarkGray"><img src="images/PhonebenefitsThumb.jpg" alt="" title="Click to Visit Active AT&T Demo Site" 
width="500" border="1"><br>Click to Visit Active AT&T Demo Site</a><br><br>
		<a href="http://palm.voicebenefits.nr.net/" target="_blank" class="bodyDarkGray"><img src="images/VoicebenefitsThumb.jpg" alt="" title="Click to Visit Active Verizon Demo Site" 
width="500" border="1"><br>Click to Visit Active Verizon Demo Site</a>
	</td>
	<td valign="top" class="bigDarkGray">
		Mobile device sales system targeting benefits programs for groups.  Primarily aimed at employee benefits for mid to large size companies, but any organization is eligible, much like a 
Credit Union.<br><br>The system is entirely data-driven and is customized via a simple configuration specifying the particular benefits afforded each organization, such as their monthly discount from 
the carrier, the device price level, discounts and rebates, etc., as well as the organizations logo and contact information.<br><br>Some member organizations we developed sites for include:
		<br>
		<table border="0" cellspacing="10" cellpadding="0">
		<?
		function myglob ($pattern) {
			$path_parts = pathinfo ($pattern);
			$pattern = '^' . str_replace (array ('*',  '?'), array ('(.+)', '(.)'), $path_parts['basename'] . '$');
			$dir = opendir ($path_parts['dirname']);
			while ($file = readdir ($dir)) {
				if (ereg ($pattern, $file)) $result[] = "{$path_parts['dirname']}/$file";
			}
			closedir ($dir);
			if (isset($result))return $result;
			return (array) null;
		}
		
		// Sort by filename
		function SortByFilename($a, $b) {
			return strnatcasecmp($a[0], $b[0]);
		}
		
		$files = array();
		// Remove (pop off) the annoying empty element that creates
		$pop = array_pop($files);
		foreach(myglob("/var/www/html/bullseyecreations.com/httpdocs/images/logos/*.*") as $filename) {
			$path = explode('/',$filename);
			array_push($files,array($path[8]));
		}
		usort($files, "SortByFilename");
		// Jump to the top of the array
		reset($files);
		// Step through it
		echo '<tr>';
		for ($Counter=1; $Counter <= sizeof($files); $Counter++){
			echo '<td><img src="images/logos/'.$files[$Counter-1][0].'" width="100" border="0"></td>';
			if ($Counter % 3 == 0){
				echo '</tr><tr>';
			}
		}
		?>
		</tr>
		</table>
	</td>
</tr>
</table>

