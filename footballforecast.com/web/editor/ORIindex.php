<?
include ('../admin/session.php');
// SETUP:

// Change this to the physical file path to the folder containing the documents you want to edit:
$editable_files_directory = '/sites/acuriosity.com/vegasinfo/';

// Change this to the web path to the folder containing the documents you want to edit:
$editable_files_web_directory = '/vegsinfo/';

// CHECK THAT THESE INCLUDES POINT CORRECTLY:

include_once ('editor_functions.php');
include_once ('config.php');
include_once ('editor_class.php');


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
		echo "<p>Thank you. Your changes have been saved.</p>
		<p><a href=\"index.php\">Start Over</a></p>";
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
<html> 
<head> 
<title>Edit the page</title> 
</head> 
<body>

<h3>Edit the page</h3> 

<form id="editorForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<!-- begin PHP code for displaying the editor -->
<?php

// start a new wysiwygPro object
$editor = new wysiwygPro();

// insert the code into the editor
$editor->set_code($code = implode("", @file(stripslashes($_POST['working_file']))));

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
<input type="hidden" value="<?php echo stripslashes($_POST['working_file']); ?>" name="working_file">

</form>
</body> 
</html>
<?php
ob_end_flush();
// if no actions have been requested and no file has been requested for editing then display a form where the user can select a file to edit:
} else {
?>
<html> 
<head> 
<title>Choose a file to edit</title> 
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
<body> 

<h3>Choose a file to edit</h3> 

<p>Choose a page to edit and then hit the submit button:</p> 

<p> 

<form name="choose" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 

<table style="border: 1px solid #999999" width="100%" cellspacing="0" cellpadding="0">
	<tr bgcolor="#CCCCCC">
		<th align="left" style="border-right: 1px solid #999999" width="50">&nbsp;Pick&nbsp;</th>
		<th align="left" style="border-right: 1px solid #999999">&nbsp;Name&nbsp;</th>
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
<p><input type="submit" value="Submit"></p>
</form> 

</body> 
</html>
<?php } ?>