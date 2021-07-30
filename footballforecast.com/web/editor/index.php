<?
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once ('editor_functions.php');
include_once ('config.php');
include_once ('editor_class.php');
// start a new wysiwygPro object
$editor = new wysiwygPro();

/*
	if ($_SERVER["PHP_AUTH_USER"] && $_SERVER["PHP_AUTH_PW"] && ereg("^Basic ", $_SERVER["HTTP_AUTHORIZATION"])) {
		list($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]) = explode(":", base64_decode(substr($_SERVER["HTTP_AUTHORIZATION"], 6)));
	}
	$authenticated = false;
		if ($_SERVER["PHP_AUTH_USER"] || $_SERVER["PHP_AUTH_PW"]) {
		// Put the necessary code for checking u
		//     sername/passwords here.
		$authenticated = ($_SERVER["PHP_AUTH_USER"] == "dtobler" && $_SERVER["PHP_AUTH_PW"] == "editor");
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
*/
//handle login
if(isset($_POST['login'])) {
    if($_POST['login']=='dtobler' && $_POST['password']=='editor') {
        $_SESSION['login']='dtobler';
    }
    else {
        unset($_SESSION['login']);
    }
}
if(!isset($_SESSION['login']) || $_SESSION['login']<>'dtobler') {
    //display login box
    echo '<form name="form1" method="post" action="index.php">
  <div align="center">Login ID<br>
    <input name="login" type="text" id="login" size="20">
    <br>
  Password<br>
  <input name="password" type="password" id="password" size="20">
  <br>
  <input type="submit" name="Submit" value="Login">
  </div>
</form>';
die();
}

include("header.php");
// SETUP:

// Change this to the physical file path to the folder containing the documents you want to edit:
$editable_files_directory = '/home/content/d/t/o/dtobler/html/files';

// Change this to the web path to the folder containing the documents you want to edit:
$editable_files_web_directory = '/files/';

// CHECK THAT THESE INCLUDES POINT CORRECTLY:



// NO NEED TO CHANGE ANYTHING BEYOND HERE -------------------------------------------------------------------

// checks whether to perform a save or not
if ((isset($_POST['htmlCode'])) && (isset($_POST['htmlCode'])) && (!isset($_POST['return_from_preview']))) { 
		
	// Perform Save:
	
	// put the HTML code in a variable for processing
	$code = stripslashes($_POST['htmlCode']);
	
	// break apart excessively long words
	$code = longwordbreak ($code, 40, ' ');
	
	// remove unwanted tags
	// Uncomment the block of code to remove unwanted tags. You can change the tags that are removed.
	/*
	$code = remove_tags ($code, array(
		'object' => true,
		'embed' => true,
		'applet' => true,
		'script' => true
	));
	*/
	
	// If we were editing a PHP file convert PHP tags back into PHP tags
	$extension = strrchr(strtolower($_POST['working_file']),'.');
	if ($extension == '.php') {
		$code = comm2php($code);
	} else
	// If we were editing an ASP file convert ASP tags back into ASP tags
	if ($extension == '.asp' || $extension == '.aspx') {
		$code = comm2asp($code);
	}
	
	// encode special characters
	$code = fixcharacters($code);
	
	// encode and protect email addresses
	$code = email_encode($code);
	
	// open the file
	$writeme=fopen(stripslashes($_POST['working_file']),"w"); 

	// write to the file
	// include the save action in an 'if' statement so we can check if it worked:
	if (fputs($writeme, $code)) {
		echo "<br><center><font face=verdana style='font-size:14pt' color='#333333'>Changes saved.</font><center>
		<p><center><a href=\"index.php\"><font face=verdana style='font-size:10pt' color='#0000ff'>Edit more...</font></a></p>";
	} else {
		echo "<p>An error occured while attempting to save changes.</p>
		<p>Check you have permission to modify the 'editable_files' directory</p>
		<p><a href=\"index.php\">Start Over</a></p>";
	}
	
	// close the file
	fclose($writeme); 
		
	// if no actions were requested but a file has beeen requested for editing then generate the editor:
} else if (isset($_POST['working_file'])) {

// -----------------------------------------------------
// Generate the editor page:
// -----------------------------------------------------

// note the use of 'ob_start();' and 'ob_end_flush();' and also note the onSubmit event handler on the form tag.

ob_start();
?>

<form id="editorForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<font style='font-size:10pt' face="Verdana">

<!-- begin PHP code for displaying the editor -->
<?php


// insert the code into the editor
$editor->set_code($code = @implode("", @file(stripslashes($_POST['working_file']))));

// add a save button to the toolbar:
$editor->set_savebutton('save');

// add a custom cancel button:
$editor->addbutton('Cancel', 'before:print', "document.location.replace('".$_SERVER['PHP_SELF']."')", 'cancel.gif', 22, 22, 'undo');

// add a spacer:
$editor->addspacer('', 'after:cancel');

// uncomment if you want to use XHTML:
//$editor->usexhtml(true, "iso-8859-1", "en");

// dynamically generate links for the hyperlink window
// this is a recursive function for automatically generating links to files and subdirectories!
function build_link_array($file_directory='', $web_directory='', $level=0, $links=array()) {
	$handle=opendir($file_directory);
	while (false!==($file = readdir($handle))) {  
		if ($file != "." && $file != "..") {   
			if (file_exists($file_directory.$file) && !is_file($file_directory.$file)) {
				$foo = array($level, 'folder', $file);
				array_push($links, $foo);
				$links = build_link_array($file_directory.$file.'/', $web_directory.$file.'/', $level+1, $links );
			} else {
				$foo = array($level, $web_directory.$file, $file);
				array_push($links, $foo);
			}
		}     
	} 
	closedir($handle); 
	return $links;
}
$editor->set_links(build_link_array($editable_files_directory, $editable_files_web_directory));

// specify fonts for the font menu
$editor->set_fontmenu('Arial; Arial Black; Times New Roman; Courier New; Georgia; Verdana; Geneva; Tahoma; Wingdings');

// print the editor 
$editor->print_editor('100%', 500);

?>
<!-- record which file we are editing so that when we come to save we know what we are saving!!!! -->
</font><font face="Verdana">
<input type="hidden" value="<?php echo stripslashes($_POST['working_file']); ?>" name="working_file">
</font>

</form>

<font style='font-size:10pt' face="Verdana">
<?php
ob_end_flush();
// if no actions have been requested and no file has been requested for editing then display a form where the user can select a file to edit:
} else {
?>
<html> 
<head> 
<title>Cybermight Editor</title> 
<script type="text/javascript">
// this function powers the expanding tree menu
function clickHandler(src) {
	if (document.getElementById('d_'+src.id)) {
		var targetElement = document.getElementById('d_'+src.id);
		if (targetElement.style.display == "none") {
			targetElement.style.display = "";
			src.src = 'open.gif';
		} else {
			var bods = targetElement.getElementsByTagName('TBODY')
			for (i=0; i>bods.length; i++) {
				bods[i].style.display = "none";
			}
			targetElement.style.display = "none";
			src.src = 'closed.gif';
		}
	}
}
</script>
</head> 
</font> 
<body topmargin="2" leftmargin="2" rightmargin="2" bottommargin="2">
<div align="center">
<table border="0" width="100%" cellspacing="1" cellpadding="0" id="table2">
<tr>
<td>
<p align="center"><font color="#C80000" style='font-size:10pt; font-weight:700' face="Arial">Licensed for 
footballforecast.com A-225632IL019</font><br>
<font color="#666666" style='font-size:10pt' face="Verdana">Select a page to edit and then hit the Edit button:</font></td>
</tr>
</table>
</div> 

<form name="choose" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 

<table style="border: 1px solid #999999" width="100%" cellspacing="0" cellpadding="0">
	<tr bgcolor="#CCCCCC">
		<th align="left" width="251" bgcolor="#EBEBEB">
		<font style='font-size:10pt' face="Arial">&nbsp;Select&nbsp;</font></th>
		<th align="left" bgcolor="#EBEBEB">
		<font style='font-size:10pt' face="Arial">&nbsp;Name&nbsp;</font></th>
	</tr>
<?php 
// open the directory
// this is a recursive function that builds the list of files including subfolders so that you can select a file to edit
function build_file_list($file_directory, $web_directory, $level = 0) {
	$handle=opendir($file_directory);
	// loop through the files in the directory generating a list of files 
	$i=0;
	while (false!==($file = readdir($handle))) {  
		$extension = strrchr(strtolower($file),'.');
		if ($file != "." && $file != "..") {
			if (file_exists($file_directory.$file) && !is_file($file_directory.$file)) {
				$type = 'folder';
			} else {
				$type = 'file';
			}
			$padding = $level*22;
			echo "<tr>";
			if ($type == 'folder') {
				echo "	<td style=\"border-bottom: 1px solid #eeeeee;\" width=\"50\">&nbsp;</td>";
			} else if ($extension == '.htm' || $extension == '.html' || $extension == '.php') {
				echo "	<td style=\"border-bottom: 1px solid #eeeeee\" width=\"50\"><input type=\"radio\" value=\"$file_directory$file\" name=\"working_file\"></td>";
			}
			if ($type == 'folder') {
				echo " <td style=\"border-bottom: 1px solid #eeeeee;\">
					<div style=\"margin-left:".$padding."px; cursor: pointer: cursor: hand\"><img id=\"".$level."_$i\" onclick=\"clickHandler(this)\" src=\"closed.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" alt=\"\"><img src=\"".WP_WEB_DIRECTORY."images/folder.gif\" width=\"22\" height=\"22\" align=\"absmiddle\" alt=\"\">$file</div>
				</td>";
			} else {
				echo "	<td style=\"border-bottom: 1px solid #eeeeee\">
					<div style=\"margin-left:".($padding+16)."px\"><img src=\"".WP_WEB_DIRECTORY."images/htm_icon.gif\" width=\"22\" height=\"22\" align=\"absmiddle\" alt=\"\">$file</div>
				</td>";
			}
			echo "
			</tr>"; 
			if ($type == 'folder') {
				echo "<tr id=\"d_".$level."_$i\" style=\"display:none\"><td colspan=\"2\">";
				echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
				build_file_list($file_directory.$file.'/', $web_directory.$file.'/', $level + 1) ;
				echo "</table></td></tr>";
			}
			$i ++;
		}     
	} 
	closedir($handle); 
}
build_file_list($editable_files_directory, $editable_files_web_directory);
?>
</table>

<br><center><input type="submit" value=" E d i t "></center>
</form> 

<?php } ?>
<hr color=#c0c0c0>
<center>
<a style="font-family: Verdana; font-size:8pt; color: #0000ff" target="_blank" href="http://cybermight.com">
Cybermight Network &amp; Web Development
</a>
</center>
