<?php

error_reporting (E_ALL ^ E_NOTICE);

//////////////////////////////////////////////////////////////////////////////////
// CONSTANTS  
//////////////////////////////////////////////////////////////////////////////////

// -------------------------------------------------------------------------------
// DEFAULT_LANG
// This should be the default language file to use.
// Language files are stored in [installation directory]/editor_files/lang

define('DEFAULT_LANG', 'en-us.php');

// -------------------------------------------------------------------------------
// DOMAIN_ADDRESS
// This should be the address of the domain under which you are running WysiwygPro, e.g 'http://www.mywebsite.com'
// The code below should automatically detect and set this for you, but if it doesn't you can set it manually

define('DOMAIN_ADDRESS', strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strpos($_SERVER['SERVER_PROTOCOL'],'/')) . ($_SERVER['HTTPS'] == "on" ? 's://' : '://') . $_SERVER['SERVER_NAME'] ) );

// -------------------------------------------------------------------------------
// The following two variables tell WysiwygPro the location of your 'editor_files' folder.
// The first variable sets the file system address of the folder and the second sets the web address of the folder.

// WP_FILE_DIRECTORY ++
// This should be set to the full file path to the 'editor_files' folder.
// This value must end in a '/'
// Examples (actual file paths will vary between servers, check with you hosting company if unsure):
// Windows:
// define('WP_FILE_DIRECTORY', 'c:/html/users/mywebsite/html/editor_files/');
// Linux:
// define('WP_FILE_DIRECTORY', '/var/httpd/htdocs/www.mywebsite.com/editor_files/');
// Autodetect (some apache servers only):
// define('WP_FILE_DIRECTORY', $_SERVER['DOCUMENT_ROOT'].'/editor_files/');

define('WP_FILE_DIRECTORY', '/home/content/d/t/o/dtobler/html/editor/');

// WP_WEB_DIRECTORY ++
// This should be set to the web address of the 'editor_files' folder
// This value must end in a '/'
// This can be either a full web address or addressed from the server root. In most cases it is best to address this from the server root.
// IMPORTANT: if the documents you will be editing reside under a different domain to the editor then this value should be set to a full web address!
// Examples:
// define('WP_WEB_DIRECTORY', '/editor_files/');

define('WP_WEB_DIRECTORY', '/editor/');

// -------------------------------------------------------------------------------
// The following two variables tell WysiwygPro where your directory for storing images is. 
// This enables WysiwygPro to manage your images. 
// Setting either of these variables to null will disable this feature.

// IMAGE_FILE_DIRECTORY +
// the full file path to the directory containing your site's image files
// make sure that the file permissions for this directory have been set to read write.
// This value must end in a '/'
// Examples (actual file paths will vary between servers, check with you hosting company if unsure):
// Windows:
// define('WP_FILE_DIRECTORY', 'c:/html/users/mywebsite/html/images/');
// Linux:
// define('WP_FILE_DIRECTORY', '/var/httpd/htdocs/www.mywebsite.com/images/');
// Autodetect (some apache servers only):
// define('IMAGE_FILE_DIRECTORY', $_SERVER['DOCUMENT_ROOT'].'/images/');

define('IMAGE_FILE_DIRECTORY', '/home/content/d/t/o/dtobler/html/images/');

// IMAGE_WEB_DIRECTORY +
// The web address to the directory you specified above
// WysiwygPro will use this value to corectly address and display images.
// This value must end in a '/'
// This can be either a full web address or addressed from the server root.
// IMPORTANT: if the documents you will be editing reside under a different domain to the editor then this value may need to be set to a full web address!
// Examples:
// addressed from the server root:
// define('IMAGE_WEB_DIRECTORY', '/images/');
// Full web address:
// define('IMAGE_WEB_DIRECTORY', 'http://www.mywebsite.com/images/');

define('IMAGE_WEB_DIRECTORY', '/images/');

// -------------------------------------------------------------------------------
// The following variables tell WysiwygPro where your directory of downloadable documents such as PDF and word files reside.
// This enables WysiwygPro to manage your downloadable documents.
// Setting either of these variables to null will disable this feature.

// DOCUMENT_FILE_DIRECTORY +
// the full file path to the directory containing your site's downloadable documents
// make sure that the file permissions for this directory have been set to read write.
// WysiwygPro will use this value to access the downloadable documents on your server so that you can rename, delete, and upload downloadable documents.
// This value must end in a '/'
// Examples (actual file paths will vary between servers, check with you hosting company if unsure):
// Windows:
// define('WP_FILE_DIRECTORY', 'c:/html/users/mywebsite/html/downloads/');
// Linux:
// define('WP_FILE_DIRECTORY', '/var/httpd/htdocs/www.mywebsite.com/downloads/');
// Autodetect (some apache servers only):
// define('DOCUMENT_FILE_DIRECTORY', $_SERVER['DOCUMENT_ROOT'].'/downloads/');

define('DOCUMENT_FILE_DIRECTORY', null);

// DOCUMENT_WEB_DIRECTORY +
// The web address to the directory you specified above
// WysiwygPro will use this value to corectly address and display documents.
// This value must end in a '/'
// This can be either a full web address or addressed from the server root.
// IMPORTANT: if the documents you will be editing reside under a different domain to the editor then this value may need to be set to a full web address!
// Examples:
// addressed from the server root:
// define('DOCUMENT_WEB_DIRECTORY', '/downloads/');
// Full web address:
// define('DOCUMENT_WEB_DIRECTORY', 'http://www.mywebsite.com/downloads/');

define('DOCUMENT_WEB_DIRECTORY', null);

// Dont forget that you can specify whether the insert image or link to a document buttons are enabled when calling the editor.
// You can also disable the image manager without completely disabeling the insert image features. read the manual for more information.

// -------------------------------------------------------------------------------
// TRUSTED_DIRECTORIES
// You can override the file directories above at runtime using the set_image_dir and set_doc_dir API commands, but only if the directory is in the trusted directory array below!
// You could dynamically generating this array based on session variables.
// Or you could define the constants above based on session variables and then you wouldn't need to use this feature.
// If you intend to set these variables based on a session the routine for grabbing the session info and setting the variables should be added to this file so that it will be available to WysiwygPro's dialog windows.

// Note: even if you are not using the default directory constants above they must still point to a directory!

$trusted_directories = array(
	// Follow this format:
	// 'unique id' => array('file dir', 'web dir'),
	// Examples:
	'foo.com_images' => array('c:/html/users/foo.com/html/images/', 'http://www.foo.com/images/'), 
	'bar.com_images' => array($_SERVER['DOCUMENT_ROOT'].'/bar/', '/bar/'),

);

// -------------------------------------------------------------------------------
// If the following variables are set then WP will populate the insert smiley dialoge with smileys from the specified directory.
// Smiley images must be less than 32x32 in GIF or PNG format.
// Leave either of these variables null to use the default smiley set.
// SMILEY_FILE_DIRECTORY
// the full file path to the directory containing your smileys

define('SMILEY_FILE_DIRECTORY', null);

// SMILEY_WEB_DIRECTORY
// The web address to the directory you specified above

define('SMILEY_WEB_DIRECTORY', null);

// -------------------------------------------------------------------------------
// NOCACHE 
// Should be set either true or false, If true headers will be sent to prevent caching by proxy servers.
// This is important because WYSIWYG PRO outputs different data depending on the client browser, if the output is cached by a proxy, browsers behind this proxy may be delivered the wrong data.
// You are advised against changing this variable.
// This has nothing to do with WYSIWYG PRO's configuration saving features.

define('NOCACHE', true);

// -------------------------------------------------------------------------------
// SAVE_DIRECTORY 
// The full file path to the dirctory you want WYSIWYG PRO to save configuration data.
// make sure that the file permissions for this directory have been set to read write.
// Note that the use of this feature is optional, but recommended for high load applications. See the manual for more info.

define('SAVE_DIRECTORY', WP_FILE_DIRECTORY.'save/');

// SAVE_LENGTH The length of time in seconds to save a configuration before re-generation.

define('SAVE_LENGTH', 9000);

// If you are using configuration saving during the development of your project be aware that if you make a configuration change this change will not be visible until the configuration file has expired!
// For the above reason we recommend against using configuration saving during development.


// -------------------------------------------------------------------------------
// All of the following variables affect file management in the image and document windows:
// -------------------------------------------------------------------------------

////////////////////////////
// File Types  
////////////////////////////

// These variables decide what types of files users are allowed to upload using the image or document management windows

// What types of images can be uploaded? Separate with a comma.
$image_types = '.jpg, .jpeg, .gif, .png';

// What types of documents can be uploaded? Separate with a comma.
$document_types = '.html, .htm, .pdf, .doc, .rtf, .txt, .xl, .xls, .ppt, .pps, .zip, .tar, .swf, .wmv, .rm, .mov, .jpg, .jpeg, .gif, .png';

////////////////////////////
// File Sizes
////////////////////////////

// maximum width of uploaded images in pixels set this to ensure that users don't destroy your site's design!!
$max_image_width = 500;

// maximum height of uploaded images in pixels set this to ensure that users don't destroy your site's design!!
$max_image_height = 500;

// maximum image filesize to upload in bytes
$max_file_size = 25000;

// maximum size of documents to upload in bytes
$max_documentfile_size = 200000;

//////////////////////////
// User Permissions
//////////////////////////

// if you have a user authentication system you might want to dynamically generate values for the following variables based on user permissions:
// the following must be set either true or false.

// can users delete files? (be very careful with this one)
$delete_files = false;

// can users delete directories? (be even more careful with this one)
$delete_directories = false;

// can users create directories?
$create_directories = false;


// can users re-name files?
$rename_files = false;

// can users rename directories?
$rename_directories = false;

// can users upload files??
$upload_files = true;

// If users can upload and they upload a file with the same name as an existing file are they allowed to overwrite the existing file?
$overwrite = true;

// end variables, do not change naything below
// ----------------------------------------
define('WP_CONFIG', true);
global $wp_has_been_previous;
$wp_has_been_previous = false;
// ----------------------------------------
?>
