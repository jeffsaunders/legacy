<?
include("../dbconnect.php");

switch($_REQUEST['task']){
	case "savepick":
		$adate = explode("/",$_REQUEST['race_date']);
		$sdate = "20".$adate[2]."-".$adate[0]."-".$adate[1];
		$query = 
			"UPDATE freepicks SET
			race_date = '".$sdate."',
			track_name = '".addslashes($_REQUEST['track_name'])."',
			race_num = '".$_REQUEST['race_num']."',
			race_name = '".addslashes($_REQUEST['race_name'])."',
			win_num = '".$_REQUEST['win_num']."',
			win_name = '".addslashes($_REQUEST['win_name'])."',
			place_num = '".$_REQUEST['place_num']."',
			place_name = '".addslashes($_REQUEST['place_name'])."',
			show_num = '".$_REQUEST['show_num']."',
			show_name = '".addslashes($_REQUEST['show_name'])."',
			race_note = '".addslashes($_REQUEST['race_note'])."',
			note = '".addslashes($_REQUEST['note'])."',
			sponsor = '".addslashes($_REQUEST['sponsor'])."',
			sponsor_link = '".addslashes($_REQUEST['sponsor_link'])."',
			timestamp = NOW()
			WHERE timestamp = '".$_REQUEST['timestamp']."'";
		//echo $query;
		$rs_update = mysql_query($query, $linkID) or die(mysql_error());
		echo '<script>window.location = "freepicks.php?message=Changes Saved"</script>';
//		header("Location: freepicks.php?message=Changes Saved");
//		break;
		exit;

	case "addroster":
		$adate = explode("/",$_REQUEST['race_date']);
		$sdate = "20".$adate[2]."-".$adate[0]."-".$adate[1];
		if ($_REQUEST['date_tba'] == "T"){$sdate = "";}
		$query = 
			"INSERT INTO roster (
			horse_name,
			horse_type,
			date_tba,
			race_date,
			race_detail,
			race_track,
			race_result,
			display,
			timestamp)
			VALUES (
			'".addslashes($_REQUEST['horse_name'])."',
			'".addslashes($_REQUEST['horse_type'])."',
			'".$_REQUEST['date_tba']."',
			'".$sdate."',
			'".addslashes($_REQUEST['race_detail'])."',
			'".addslashes($_REQUEST['race_track'])."',
			'".addslashes($_REQUEST['race_result'])."',
			'".$_REQUEST['display']."',
			NOW())";
		//echo $query;
		$rs_insert = mysql_query($query, $linkID) or die(mysql_error());
		echo '<script>window.location = "rosteredit.php?message=Roster Entry Added"</script>';
//		header("Location: rosteredit.php?message=Roster Entry Added");
//		break;
		exit;

	case "editroster":
		$adate = explode("/",$_REQUEST['race_date']);
		$sdate = "20".$adate[2]."-".$adate[0]."-".$adate[1];
		if ($_REQUEST['date_tba'] == "T"){
			$bdate_tba = "T";
		}else{
			$bdate_tba = "F";
		}
		if ($_REQUEST['date_tba'] == "T"){$sdate = "";}
		$query = 
			"UPDATE roster SET
			horse_name = '".addslashes($_REQUEST['horse_name'])."',
			horse_type = '".addslashes($_REQUEST['horse_type'])."',
			date_tba = '".$bdate_tba."',
			race_date = '".$sdate."',
			race_detail = '".addslashes($_REQUEST['race_detail'])."',
			race_track = '".addslashes($_REQUEST['race_track'])."',
			race_result = '".addslashes($_REQUEST['race_result'])."',
			display = '".$_REQUEST['display']."',
			timestamp = NOW()
			WHERE unique_id = '".$_REQUEST['unique_id']."'";
		//echo $query;
		$rs_update = mysql_query($query, $linkID) or die(mysql_error());
		echo '<script>window.location = "rosteredit.php?message=Changes Saved"</script>';
//		header("Location: rosteredit.php?message=Changes Saved");
//		break;
		exit;

	case "deleteroster":
		$query = 
			"DELETE FROM roster
			WHERE unique_id = '".$_REQUEST['unique_id']."'";
		//echo $query;
		$rs_update = mysql_query($query, $linkID) or die(mysql_error());
		echo '<script>window.location = "rosteredit.php?message=Roster Entry Deleted"</script>';
//		header("Location: rosteredit.php?message=Roster Entry Deleted");
//		break;
		exit;

	case "addopportunity":
		$query = 
			"INSERT INTO opportunities (
			headline,
			body,
			priority,
			display,
			timestamp)
			VALUES (
			'".addslashes($_REQUEST['headline'])."',
			'".addslashes($_REQUEST['body'])."',
			'".$_REQUEST['priority']."',
			'".$_REQUEST['display']."',
			NOW())";
		//echo $query;
		$rs_insert = mysql_query($query, $linkID) or die(mysql_error());
		echo '<script>window.location = "opportunities.php?message=Investment Opportunity Added"</script>';
//		header("Location: opportunities.php?message=Investment Opportunity Added");
//		break;
		exit;

	case "editopportunity":
		$query = 
			"UPDATE opportunities SET
			headline = '".addslashes($_REQUEST['headline'])."',
			body = '".addslashes($_REQUEST['body'])."',
			priority = '".$_REQUEST['priority']."',
			display = '".$_REQUEST['display']."',
			timestamp = NOW()
			WHERE unique_id = '".$_REQUEST['unique_id']."'";
		//echo $query;
		$rs_update = mysql_query($query, $linkID) or die(mysql_error());
		echo '<script>window.location = "opportunities.php?message=Changes Saved"</script>';
//		header("Location: opportunities.php?message=Changes Saved");
//		break;
		exit;

	case "deleteopportunity":
		$query = 
			"DELETE FROM opportunities
			WHERE unique_id = '".$_REQUEST['unique_id']."'";
		//echo $query;
		$rs_update = mysql_query($query, $linkID) or die(mysql_error());
		echo '<script>window.location = "opportunities.php?message=Investment Opportunuty Deleted"</script>';
//		header("Location: opportunities.php?message=Investment Opportunuty Deleted");
//		break;
		exit;
}
?>
