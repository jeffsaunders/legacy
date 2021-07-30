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
if ($task == "all"){
	// Get ALL 
	$query = "SELECT * FROM news WHERE active = 'T' ORDER BY date DESC, unique_id DESC";
}else{
	// Get 13 months' worth
	$query = "SELECT * FROM news WHERE active = 'T' AND DATE_SUB(CURDATE(),INTERVAL 13 MONTH) <= date ORDER BY date DESC, unique_id DESC";
}
// Execute it
$rs_news = mysql_query($query, $linkID);
?>

<br>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/900IvoryBGTop.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
<tr>
	<td background="images/900IvoryBGMiddle.gif">



<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Main Body -->
	<td valign="top" class="bodyBlack">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td colspan="3" class="bodyBlack">
				<!-- Image -->
				<table width="340" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
					<!-- Foreign Papers -->
					<td align="right"><img src="images/News.jpg" alt="" width="300" height="200" border="1"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
				<!-- Text -->
				<strong class="xbigBlack">The Little Church of the West In The News<br><br>
				<p>
				<ul>
					<strong class="bodyBlack">The World Famous Little Church of the West is, well ... <em>World Famous!</em><br><br>
					This page contains links to news and magazine articles about, or mentioning The Little Church of the West.<br><br>
					<span class="bigBlack">&ndash; Enjoy!</span></strong>
				</ul>
				</p>
				<br>
			</td>
		</tr>
		<tr>
			<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
			<td>
				<?
				for ($counter=1; $counter <= mysql_num_rows($rs_news); $counter++){
					$row = mysql_fetch_assoc($rs_news);
					echo'
					<table width="100%" class="bodyBlack">
					<tr>
						<td width="150" valign="top"><strong>'.date("F j, Y",strtotime($row["date"])).'</strong></td>
						<td>
							<strong>'.$row["publication"].'</strong><br>
					';
					if ($row["popit"] == "T"){ //Display article in popup window
						echo'
							<a href="javascript:SpawnChild(\''.$row["link"].'\',\'child\',\'1020\',\'600\',\'yes\',\'\',\'\',\'\',\'\',\'1\',\'1\',\'1\',\'1\',\'1\');" child.focus();" onmouseover="window.status=\'Click Here For Article\'; return true" onmouseout="window.status=\'\'; return true" class="bigBlack"><strong>'.$row["title"].'</a></strong><br>
						';
					}else{ // Display articel in fresh browser
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
				if ($task != "all"){
					echo'
				<a href="/index/experience/news/all" title="Click for news archive" class="bodyBlack"><strong>Click Here</strong> for News Archive</a>
					';
				}else{
					echo'
				<a href="/index/experience/news" title="Click for most recent year\'s news" class="bodyBlack"><strong>Click Here</strong> to See The Most Recent Year\'s News</a>
					';
				}
				?>
			</td>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
		</table>
	</td>
</tr>
</table>
	

	</td>
</tr>
<tr>
	<td background="images/900IvoryBGBottom.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
</table>

<!-- END INCLUDE News -->
