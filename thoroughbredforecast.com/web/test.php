<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>

										<script language="javascript" src="http://www.thoroughbredforecast.com/wasp.js"></script>

											<?
											//Generate random 10-digit number to tag each iteration of the player seperately - a timestamp is a perfect fit
											$waspID = time();
											?>
											<div id="waspTarget<?=$waspID?>">
												<table border="0" align="center" class="bodyBlack">
												<tr>
													<td><img src="images/flash_player_50x50.gif" alt="" width="50" height="50" border="0"></td>
													<td align="center">
														<strong>Adobe Flash Player Plug-in Required<br>
														<a href="http://www.adobe.com/products/flashplayer/" class="bodyBlack">Click Here for Free Installation</a></strong>
													</td>
												</tr>
												</table>
											</div>
											<!-- WASP Player -->
											<script language="javascript">
											// <![CDATA[
												var waspConfigs<?=$waspID?> = new Object();
												waspConfigs<?=$waspID?>.instanceID="<?=$waspID?>";
												waspConfigs<?=$waspID?>.waspSwf="/wasp.swf";
												waspConfigs<?=$waspID?>.pageColor="000000";
												waspConfigs<?=$waspID?>.im="/images/WebcamSlate640.jpg";
												//waspConfigs<?=$waspID?>.fa="wiggles-wide.flv"; <- pre-roll
												waspConfigs<?=$waspID?>.tf="1";
												waspConfigs<?=$waspID?>.hp="Click%20to%20Play%20%2F%20Pause";
												waspConfigs<?=$waspID?>.v="75";
												waspConfigs<?=$waspID?>.f="/video/KentuckyDerbyShow2006.flv";
												waspConfigs<?=$waspID?>.a="1";
												waspConfigs<?=$waspID?>.me="0";
												waspConfigs<?=$waspID?>.s="0";
												waspConfigs<?=$waspID?>.pw="520";
												waspConfigs<?=$waspID?>.ph="414"; //+24px for controls
												waspConfigs<?=$waspID?>.waspSkin="sr_1|1|4^st_1|3|18|E8E8E8|000000^sg_1|3|22|D8D8D8|FFFFFF^sb_1|10|19|000000|FFFFFF|000000^sp_1|1|23|FFFFFF|FFFFFF|FFFFFF^sm_1|1|23|FFFFFF|FFFFFF|FFFFFF^sf_1|1^sa_1|1|1^sz_1|1|1";
												writeWasp(waspConfigs<?=$waspID?>);
											// ]]>
											</script>



</body>
</html>
