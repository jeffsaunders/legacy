<!-- BEGIN INCLUDE News -->

<script>
// BEGIN FUNCTION SPAWNCHILD ---

//  This function spawns a child window 

//  SpawnChild(URL including fully qualified URL's,
//		 		Width of the spawned window in pixels,
//			 	Height of the spawned window in pixels,
//				Centered (no/0 or 1/yes, which overrides the positioning values below),
//				Netscape distance from left in pixels (unless Centered = 1/yes),
//				Netscape distance from top in pixels (unless Centered = 1/yes),
//				Internet Explorer distance from left in pixels (unless Centered = 1/yes),
//				Internet Explorer distance from top in pixels (unless Centered = 1/yes),
//				Is window resizable? (no/0 or yes/1 - either works),
//				Display scrollbars? (no/0 or yes/1),
//				Display menubar? (no/0 or yes/1),
//				Display toolbar? (no/0 or yes/1),
//				Display statusbar? (no/0 or yes/1)
//				)

// 	Example - SpawnChild('http://192.168.0.1/ChildWindowContent.html','500','200','150','no','200','150','200','yes','yes','no','0','1')
// 	Creates a window that is 500x200 pels located 150 pels from the left and 200 pels from the top (NOT centered) which loads a page from a server at 192.168.0.1 named ChildWindowContent.html, resizable, with scrollbars & statusbar on.

function SpawnChild(Content, ChildName, Width, Height, Centered, NSx, NSy, IEx, IEy, Resizable, ScrollBars, MenuBar, ToolBar, StatusBar){
	if (window.child && !(window.child.closed))	window.child.close();
	var URL=Content;
	var Name=ChildName;
	var WindowWidth=parseInt(Width);
	var WindowHeight=parseInt(Height);
	if ((Centered == "1")||(Centered == "yes")){
		Left=(screen.width/2)-(Width/2);
		Top=(screen.height/2)-(Height/2);
		NSx=Left;
		NSy=Top;
		IEx=Left;
		IEy=Top
	}
	var ScreenX=parseInt(NSx);
	var ScreenY=parseInt(NSy);
	var Left=parseInt(IEx);
	var Top=parseInt(IEy);
	var Resize=Resizable;
	var SB=ScrollBars;
	var MB=MenuBar;
	var TB=ToolBar;
	var Status=StatusBar;
  		child=window.open(URL, Name, "width=" + WindowWidth + ",height=" + WindowHeight + ",screenX=" + ScreenX + ",screenY=" + ScreenY + ",left=" + Left + ",top=" + Top + ",resizable=" + Resize + ",scrollbars=" + SB + ",menubar=" + MB + ",toolbar=" + TB + ",status=" + Status);
}

// END FUNCTION SPAWNCHILD ---
</script>

<?
// Build query
if ($cargo == "all"){
	// Get ALL 
	$query = "SELECT * FROM news WHERE active = 'T' ORDER BY date DESC, unique_id DESC";
}else{
	// Get 13 months' worth
	$query = "SELECT * FROM news WHERE active = 'T' AND DATE_SUB(CURDATE(),INTERVAL 25 MONTH) <= date ORDER BY date DESC, unique_id DESC";
}
// Execute it
$rs_news = mysql_query($query, $linkID);
?>

<table width="635" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td valign="top">
		<img src="images/spacer.gif" alt="" width="2" height="5" border="0"><br>
		<strong class="xbigBlack">Blind Center in the News<br></strong>
		<img src="images/spacer.gif" alt="" width="2" height="25" border="0"><br>
		<table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td>
				<span class="bodyBlack">This page contains links to news stories<br>
				and articles about, or mentioning<br>
				<strong>The Blind Center of Nevada</strong>.<br><br></span>
				<span class="bigBlack"><strong>&ndash; Enjoy!</strong></span>
			</td>
		</tr>
		</table>
	</td>
	<td width="265" align="right">
		<img src="images/spacer.gif" alt="" width="2" height="5" border="0"><br>
		<img src="images/news.jpg" alt="" width="245" height="165" border="0"><br>
		<img src="images/spacer.gif" alt="" width="2" height="5" border="0">
	</td>
</tr>
</table>

<table width="635" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
	<td>
		<?
		for ($counter=1; $counter <= mysql_num_rows($rs_news); $counter++){
			$row = mysql_fetch_assoc($rs_news);
			echo'
			<table width="100%" class="bodyBlack">
			<tr>
				<td width="150" valign="top">
					<strong>'.date("F j, Y",strtotime($row["date"])).'</strong>
			';
			if ($row["video"] != ""){
				if ($row["pop_video"] == "T"){
					echo'
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<a href="javascript:SpawnChild(\''.$row["video"].'\',\'child\',\'1020\',\'600\',\'yes\',\'\',\'\',\'\',\'\',\'1\',\'1\',\'1\',\'1\',\'1\');" child.focus();" onmouseover="window.status=\'Click Here For Video\'; return true" onmouseout="window.status=\'\'; return true"><img src="images/icon_video.gif" alt="" width="18" height="17" border="0"></a>
						</td>
						<td><img src="images/spacer.gif" alt="" width="3" height="25" border="0"></td>
						<td>
							<a href="javascript:SpawnChild(\''.$row["video"].'\',\'child\',\'1020\',\'600\',\'yes\',\'\',\'\',\'\',\'\',\'1\',\'1\',\'1\',\'1\',\'1\');" child.focus();" onmouseover="window.status=\'Click Here For Video\'; return true" onmouseout="window.status=\'\'; return true" class="smallBlack">Video</a>
						</td>
					</tr>
					</table>
					';
				}else{
					echo'
					<br>
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><a href="'.$row["video"].'" target="_blank"><img src="images/icon_video.gif" alt="" width="18" height="17" border="0"></a></td>
						<td><img src="images/spacer.gif" alt="" width="3" height="25" border="0"></td>
						<td><a href="'.$row["video"].'" target="_blank" class="smallBlack">Video</a></td>
					</tr>
					</table>
					';
				}
			}
			echo'
				</td>
				<td>
					<strong>'.$row["publication"].'</strong><br>
			';
			if ($row["pop_article"] == "T"){
				echo'
					<a href="javascript:SpawnChild(\''.$row["link"].'\',\'child\',\'1020\',\'600\',\'yes\',\'\',\'\',\'\',\'\',\'1\',\'1\',\'1\',\'1\',\'1\');" child.focus();" onmouseover="window.status=\'Click Here For Article\'; return true" onmouseout="window.status=\'\'; return true" class="bigBlack"><strong>'.$row["title"].'</a></strong><br>
				';
			}else{
				echo'
					<strong><a href="'.$row["link"].'" target="_blank" class="bigBlack">'.$row["title"].'</a></strong><br>
				';
			}
			echo'
					'.$row["sub-title"].'
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr align="left" width="98%" size="1" noshade style="border-top:1px dashed #000000; margin-bottom:10px;"></td>
			</tr>
			</table>
			';
		}
		if ($cargo != "all"){
			echo'
		<a href="?sec=news&cargo=all" title="Click for news archive" class="bodyBlack"><strong>Click Here</strong> for News Archive</a>
			';
		}else{
			echo'
		<a href="?sec=news" title="Click for most recent two year\'s news" class="bodyBlack"><strong>Click Here</strong> to See The Most Recent Two Year\'s News</a>
			';
		}
		?>
	</td>
	<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
</table>
<br>


<!-- END INCLUDE News -->
