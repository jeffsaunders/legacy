<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>SWBH Kit Files</title>
</head>

<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// whitelist of valid file types (extension => display name)
$valid = array(
    'pdf' => 'PDF',
    'jpg' => 'Image'
);

$folders = array(
    'Big Brochure',
    'Business Card',
	'Divorce Folder',
	'Financing Brochure',
	'Flyers/Single Mom Flyer',
	'Flyers/Widowed Flyer',
	'Flyers/Young Single Flyer',
	'Letterhead',
	'Pocket Folder',
	'Poster',
	'PR Sheet',
	'Thank You Card',
	'Tri-Fold Intro Folder'
);

foreach($folders as $directory_path){
	$files = array();    
	$dir = new DirectoryIterator($directory_path);
	foreach($dir as $file){
		// filter out directories
		if($file->isDot() || !$file->isFile()) continue;
		// Use pathinfo to get the file extension
		$info = pathinfo($file->getPathname());
		// Check there is an extension and it is in the whitelist
		if(isset($info['extension']) && isset($valid[$info['extension']])){
			$files[] = array(
				'filename' => $file->getFilename(),
				'size' => $file->getSize(),
				'type' => $valid[$info['extension']], // 'PDF' or 'Word'
				'created' => date('Y-m-d H:i:s', $file->getCTime())
			);
		}
	}
	// Write out the links
	echo "<strong>" . $directory_path . "</strong>";
	echo "<ul>";
	foreach($files as $key => $value) {
		echo "<li><a href=\"$directory_path/" . $value['filename'] . "\">" . $value['filename'] . "</a></li>";
	}
	echo "</ul>";
}
?>

</body>
</html>
