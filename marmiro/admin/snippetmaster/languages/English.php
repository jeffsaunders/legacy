<?php
//-----------------------------------------------------------------
// ENGLISH language translation
// Henri Straforelli (henri@snippetmaster.com)
//
// If you translate the program into another language, please be sure to send
// the new translation file to henri@snippetmaster.com so I can add it to the 
// list of available languages. As a thank you, I will give you a FREE 
// license. Thank you!
//-----------------------------------------------------------------


//=================================================================
// INSTRUCTIONS FOR MODIFYING OR CREATING A TRANSLATION FILE
//=================================================================
//
// Follow each step, outlined below.
//
// CAUTION: You *must* be sure the language file contains only valid PHP 
// code. You can easily test if the file is correct by "calling" it directly 
// from your browser like this:
//
// http://www.yourwebsite.com/program/languages/NewLanguage.php
//
// If you see ANYTHING (text or errors) in the browser window, then you have 
// not modified or created the file correctly and you must fix the problem.


//-----------------------------------------------------------------
// STEP 1 - Specify the ISO code for the language.
//
// You MUST specify the correct two-character "ISO 639.1" code for this language.
// (http://www.loc.gov/standards/iso639-2/php/English_list.php)
// ie: en, fr, es, nl
//-----------------------------------------------------------------

$text['ISO639.1_code'] = "en";

//-----------------------------------------------------------------
// STEP 2 - Specify the meta tag "charset" for the language.
//
// For example, the following meta tag uses "iso-8859-1" as the charset value:
//
// <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
// 
// More information about "charset" is here:
//      http://www.w3.org/International/O-charset.html
//      http://www.w3.org/TR/REC-html40/charset.html
//-----------------------------------------------------------------

$text['HTML_charset'] = "iso-8859-1";

//-----------------------------------------------------------------
// STEP 3 - Make the translations.
// 
// The format is like this:
//
// $text['do_not_touch_this'] = "<b>Your</b> translated {0} text goes here.";
//
// NOTE 1: If you see the "{0}" inside a text string, please be sure to leave
// it alone. (Don't remove it!)  The "{0}" is a "placeholder" for some value 
// that will be automatically inserted when the program runs.
// NOTE 2: Some of the text will contain HTML code. Do not remove the HTML.
//-----------------------------------------------------------------

//
// Login Page
//
$text['username'] = "Username";
$text['password'] = "Password";
$text['language'] = "Language";
$text['auto_login'] = "Login automatically each visit";
$text['error_login'] = "*** Invalid username and/or password! ***";
$text['login_button'] = "Login";


// Misc messages for LITE version restrictions.
$text['free_trial_available'] = " (A free trial version is available.)";
$text['lite_only1'] = "Sorry, but this feature is not enabled in the free LITE version."; 
$text['lite_only2'] = "To enable this feature, please support the software by purchasing the PRO version. ".$text['free_trial_available'];
$text['lite_only3'] = "Thank you!";
$text['pro_version_only'] = "(PRO Version Only)";
$text['preview_not_enabled'] = "Please consider purchasing the PRO version if you would like the ability to preview your changes before saving. ".$text['free_trial_available'];
$text['LITE_invalid_prog_name'] = "Sorry, but you may not change the program name when using the free LITE version. Please support the sofware by purchasing the PRO version if you want to change the program name.  ".$text['free_trial_available'];
$text['LITE_list_group_max'] = "Sorry, but the free LITE version is restricted to only one List Group. Please support the sofware by purchasing the PRO version if you want to have unlimited List Groups.  ".$text['free_trial_available'];
$text['LITE_list_group_no_image_or_links_list'] = "Sorry, but the free LITE version does not include the ability to use an include/exclude list when browsing for images or links. Please support the sofware by purchasing the PRO version if you want to use an include/exclude list when browsing for images or links.";
$text['LITE_upload_group_max'] = "Sorry, but the free LITE version is restricted to only one Upload Group. Please support the sofware by purchasing the PRO version if you want to have unlimited Upload Groups.  ".$text['free_trial_available'];
$text['LITE_editor_group_max'] = "Sorry, but the free LITE version is restricted to only one Editor Group. Please support the sofware by purchasing the PRO version if you want to have unlimited Editor Groups.  ".$text['free_trial_available'];
$text['LITE_editor_group_defaults'] = "Sorry, but you may not change the default Editor Group values with the free LITE version. Please support the sofware by purchasing the PRO version if you want to change Editor Group values or create unlimited Editor Groups. ".$text['free_trial_available'];
$text['LITE_english_only'] = "Sorry, but the free LITE version is restricted to only the English language. Please support the software by purchasing the PRO version if you want to use a different language.";
 $text['LITE_user_type_max'] = "Sorry, but the free LITE version is restricted to only one user for each Privilege Type. Please support the software by purchasing the PRO version if you want to add more users with the selected  Privilege Type.";

//
// Main Page - navigation area
//
$text['open_button'] = "open";
$text['current_folder'] = "Current folder";
$text['select_folder'] = "Select a different folder";
$text['select_file'] = "Select a file";
$text['folder_drop_down-select_a_folder'] = "Select a folder";
$text['folder_drop_down-no_change'] = "NO CHANGE";
$text['folder_drop_down-up_one_level'] = "UP ONE LEVEL";
$text['file_select_snippets'] = "SNIPPETS";
$text['file_select_whole_files'] = "WHOLE FILES";


//
// Main Page - editor area
//
$text['select_file_to_edit'] = "Please select a folder or file from the drop down menus above."; 
$text['no_snippet_tags'] = "A complete set of Snippet tags were not found in the selected file";
$text['proper_usage'] = "Here is an example of correct Snippet tag use";
$text['current_file'] = "Current File";
$text['snippet_name'] = "Snippet Name";
$text['save_button'] = "Save";
$text['preview_button'] = "Preview";
$text['file_saved'] = "The file has been saved!";
$text['view_in_new_window_button'] = "View in new window";
$text['re-edit_button'] = "Go back and re-edit";
$text['last_saved_on'] = "Last saved on";
$text['last_saved_by'] = "by";
$text['last_saved_no_info'] = "(no info)";

//
// WYSIWYG Editor - error messages
//
$text['invalid_selection'] = "Invalid Selection";
$text['error1'] = "You can not edit an image AND text at the same time.";
$text['instruct1'] = "To select an image for editing, be sure to click only the image with your mouse.";
$text['instruct2'] = "To insert or modify an image hyperlink, click the Insert or Modify Image icon on the top-right side of the editor toolbar.";
$text['error2'] = "You are trying to add a link to a selection that already includes a link.";
$text['instruct3'] = "If you want to make your selection into a link, you must first remove any existing links in the selection.";
$text['error3'] = "You are trying to add a link to a selection that already includes at least one link."; 


//
// Common Text
//
$text['submit_button'] = "   OK   ";
$text['cancel_button'] = "Cancel";
$text['back_button'] = "Back";
$text['close_button'] = "Close";
$text['target_self'] = "In same page";
$text['target_top'] = "Top of new page";
$text['target_blank'] = "A new window";
$text['close_preview'] = "Click here to close this preview window";

//
//File Browser (located inside Link and Image browser windows)
//
$text['FileBrowser_close_folder'] = "Close this folder";
$text['FileBrowser_current_folder'] = "Current folder";
$text['FileBrowser_open_folder'] = "Open this folder";

$text['FileBrowser_window_title'] = "File Browser";
$text['FileBrowser_browse'] = "Browse";
$text['FileBrowser_browse_help'] = "You can browse your website and its folders to find the desired file. Click on the file you want to link to and the correct URL will be automatically filled in.";
$text['FileBrowser_url'] = "URL";
$text['FileBrowser_url_help'] = "This is the internet location of the selected file.";
$text['FileBrowser_error1'] = "You did not select a valid file. Click the Cancel button if you do not want to select a file.";
$text['FileBrowser_image_preview'] = "Image Preview";


//
//Upload Utility
//
$text['upload_error'] = "ERROR";
$text['upload_success'] = "SUCCESS";
$text['upload_success_msg'] = "The file was uploaded!";
$text['upload_error1'] = "The file was not uploaded.";
$text['upload_error2'] = "The selected destination folder is not writeable or does not exist. Make sure the destination folder exists and has write permissions of 777.";
$text['upload_error3'] = "A file with the same name already exists at the selected destination. You must first rename the file you want to upload or select a different destination.";
$text['upload_error4'] = "A file with the same name already exists at the selected destination. The existing file will be overwritten by the new file.";
$text['upload_error5'] = "The file you are trying to upload is larger than the maximum size allowed.";
$text['upload_file_size'] = "Your file size";
$text['upload_file_size_max'] = "Maximum File Size Allowed";
$text['upload_attempt'] = "Attempting to upload...";
$text['upload_error6'] = "The file you are trying to upload could not be copied to the server.";
$text['upload_to'] = "Uploaded to";
$text['upload_error7'] = "Click the Cancel button if you do not want to upload a new file.";
$text['upload_error8'] = "You must select a destination for your file.";
$text['upload_error9'] = "You must select a file from your computer.";
$text['upload_error10'] = "The webmaster has specified that files with the following extension may *not* be uploaded: ";
$text['upload_error_chmod'] = "However, I was unable to change permissions to make it readable. You will need to manually change permissions for the file to make it readable.";
$text['upload_wait'] = "  Wait...  ";
$text['upload_dest'] = "Destination";
$text['upload_dest_help'] = "Select the target destination location.";
$text['upload_dest_none_defined'] = "There are no upload locations defined for this Upload Group.";
$text['upload_file'] = "File";
$text['upload_file_help'] = "Select a file from your local computer.";
$text['upload_overwrite_enabled'] = "Existing files will be overwritten.";
$text['upload_chmod_attempt1'] = "The server did not give read permissions to the file!";
$text['upload_chmod_attempt2'] = "Attempting to give read permissions...";
$text['upload_chmod_attempt3'] = "Permissions were changed!";

$text['demo_mode1'] = "** Demonstration Mode **";
$text['demo_mode2'] = "This feature is not enabled in Demonstration Mode.";
$text['demo_mode3'] = "Any changes will not be saved.";
$text['welcome_user_text'] = "Welcome";
$text['sessions_expired'] = "Your session has expired...";
$text['sessions_expired_explain'] = "For security purposes, user sessions expire after approximately 25 minutes of inactivity.";
$text['sessions_expired_re-login'] = "Please log back in by clicking here. (You will be automatically logged back in if you previously chose to remember your login details.)";
$text['logout_redirect'] = "You are now being logged out.";
$text['logout_redirect_click_here'] = "Click here if you do not want to wait any longer<br>or if your browser does not automatically forward you.";
$text['file_is_not_writable1'] = "*** Warning: The selected file is not writable! ***";
$text['file_is_not_writable2'] = "The Save button has been disabled. The file must be writable to enable the Save button.";
$text['login_error_user_disabled'] = "*** This user has been disabled ***";
$text['login_contact_admin'] = "(Please contact admin for assistance)";
$text['password_reminder_heading'] = "Password Reminder";
$text['password_reminder_button'] = "Send";
$text['password_reminder_close_window'] = "Close this window";
$text['forgot_password'] = "Forgot your password?";
$text['password_reminder_sent_to'] = "Your password was sent to";
$text['password_reminder_email'] = "As requested, here is your password:";
$text['password_reminder_blank_email'] = "** Email address not found! ***";
$text['password_reminder_user_not_found'] = "*** Specified user does not exist! ***";
$text['save_error_file_was_modified_during_editing1'] = "*** ERROR: Your changes were NOT saved! ***";
$text['save_error_file_was_modified_during_editing2'] = "The file was modified while you were making changes, and overwriting the file with your changes would corrupt the file. You must go back and re-edit the file again. Please make sure nobody else modifies the file while you are editing it.";
$text['powered_by'] = "Powered by";
$text['please_log_in'] = "Please log in";

// Top Menu Links
$text['home_menu_link'] = "home";
$text['admin_menu_link'] = "admin";
$text['upload_menu_link'] = "upload";
$text['help'] = "help";
$text['logout'] = "logout";

//Admin area - tab links
$text['setup_options'] = "Admin Area";
$text['general'] = "General";
$text['user_accounts'] = "Users";
$text['list_groups'] = "List Groups";
$text['upload_groups'] = "Upload Groups";
$text['editor_groups'] = "Editor Groups";

//Admin area - Misc
$text['description'] = "Description";
$text['used_by_user'] = "In Use?";
$text['___Save___'] = "   Save   ";
$text['___New___'] = "   New   ";
$text['_Cancel_'] = " Cancel ";

//Admin area  - initial page
$text['choose_one_tab'] = "Choose an area from the tabbed links above";
$text['admin_general_desc'] = "Misc program settings and options.";
$text['admin_users_desc'] = "Add/modify/remove users and user settings.";
$text['admin_listgroups_desc'] = "Create/modify/remove groups of folders to exclude/include from the File Explorer or when browsing for images or links. (Users can be assigned to any List Group.)";
$text['admin_uploadgroups_desc'] = "Create/modify/remove groups of upload settings and locations. (Users can be assigned to any upload group.)";
$text['admin_editorgroups_desc'] = "Create/modify/remove groups of editor functions. (Users can be assigned to any editor group.)";

//Admin area - general settings page
$text['license_key'] = "License Key";
$text['license_key-popup'] = "This is where you can specify your license key to activate various options within the program.";
$text['program_options'] = "Program Options";
$text['program_name'] = "Program Name";
$text['program_name-popup'] = "What is the program name to display in the top left corner of every page?";
$text['default_language'] = "Default Language";
$text['default_language-popup'] = "Select the default language to be used when a user has not selected a language.";
$text['admin_email'] = "Admin Email";
$text['admin_email-popup'] = "Set the admin <b>from</b> email address that is used when sending lost passwords, error reporting, etc.";
$text['error_emails'] = "Email Errors To Admin?";
$text['error_emails-popup'] = "Turn on or off any program errors from being sent to the Admin email inbox.";
$text['yes'] = "Yes";
$text['no'] = "No";
$text['demo_mode'] = "Enable Demo Mode?";
$text['demo_mode-popup'] = "Demo Mode is useful if you want to demonstrate the program capabilities without actually allowing users to save files or change settings.  <p>If Demo Mode is activated, then users will not be able to:<p>- save changes to edited files<br>- change Program Settings<br>- modify/add/delete Users<br>- modify/add/delete List Groups<br>- modify/add/delete Upload Groups<br>- modify/add/delete Editor Groups <p><b>Note:</b> Once you enable Demo Mode, the only way to disable it is to manually edit the <i>Demo Mode</i> setting in the database. (Open the <b>/program_settings.php</b> file and change &quot;<i>demo_mode#1</i>&quot; to &quot;<i>demo_mode#0</i>&quot;.)";
$text['demo_mode-alert'] = "Are you SURE you want to activate Demo Mode?\\n\\nOnce you enable Demo Mode, the only way to disable it is to manually edit the Demo Mode setting in the database. (See the help tooltip popup for instructions.) ";
$text['file_types'] = "Valid File Types";
$text['valid_editable'] = "Editable Files";
$text['valid_editable-popup'] = "What kind of files should be scanned for snippets or allowed to be opened and edited with the WYSIWYG editor?<br /><br /><i>If you add any file types, please be sure to let me know so that I can update the program.</i>";
$text['one_extension'] = "(One extension per line)";
$text['valid_image'] = "Image Files";
$text['valid_image-popup'] = "What kind of files should be displayed when browsing for images using the WYSIWYG editor?<br /><br /><i>Any file extensions you specify <b>must</b> be for a valid image filetype or you will get javascript errors.</i>";
$text['valid_link'] = "Link Files";
$text['valid_link-popup'] = "What kind of files should be displayed when browsing for links using the WYSIWYG editor?";
$text['reseller_information_only'] = "Reseller Information (Only Available for Reseller Licenses)";
$text['powered_by'] = "Powered By";
$text['powered_by_URL'] = "Powered By URL";
$text['copyright_text'] = "Copyright Text";
$text['system_configuration_overwrite'] = "Enable Override Settings";
$text['system_configuration_overwrite-popup'] = "<i>Do not adjust this value unless instructed by your support technician.</i><br /><br />Enabling this option will force the program to use the values below. In most installations, this is not necessary and you will break the program if you enable this option.";
$text['enable_overwrite_settings'] = "Enable Overwrite Settings";
$text['enable_overwrite_settings-popup'] = "";
$text['script_path'] = "Program Path";
$text['script_path-popup'] = "<i>Do not adjust this value unless instructed by your support technician.</i><br /><br />This value is usually used only if  your server is reporting an incorrect document root or a document root that is a soft link rather then the correct path. Do not include the trailing slash.";
$text['script_URL'] = "Program URL";
$text['script_URL-popup'] = "<i>Do not adjust this value unless instructed by your support technician.</i><br /><br />If you need to force the program to use a certain URL to find itself in a browser, then this is where you can specify it. In most installations, this is not necessary to be enabled.";
$text['welcome_display_text'] = "Welcome Text";
$text['welcome_display_text-popup'] = "At the top of each page, you can choose how (or if) you want to Welcome the user.";
$text['welcome_display_text-username'] = "username";
$text['welcome_display_text-first_name'] = "first name";
$text['welcome_display_text-disabled'] = "do not use";
$text['license_saved'] = "The new license information has been saved.<p>You must now logout and then log back in to activate the new license.<p><button onClick=\"parent.location='index.php?action=logout'\">Click Here To Log Out Now</button>";
$text['license_is_same'] = "The new license key you entered is the same as the current license key. No change was made.";
$text['no_downgrade_to_lite'] = "You need to enter a license key. Please contact support for assistance to modify your license details.";
$text['require_unique_email'] = "Require Unique Email?";
$text['require_unique_email-popup'] = "Should each user be required to have a unique email address? <p>If you enable this setting, then every user will be required to have a unique email address.";
$text['time_format'] = "Default Time Format";
$text['time_format-popup'] = "Enter the desired formatting for the time. This formatting will be used in any place where time is displayed.";
$text['date_format'] = "Default Date Format";
$text['date_format-popup'] = "Enter the desired formatting for the date. This formatting will be used in any place where a date is displayed.";
$text['time_explain'] = "Uses PHP date() formatting.";
$text['time_explain-link'] = "more info";
$text['time_offset'] = "Default Offset From GMT";
$text['time_offset-popup'] = "The number of hours to offset from Greenwich Mean Time (GMT) in order to make the displayed time equal to your local time.<p>Example:<p> If you live in Seattle then you would enter <b>-8</b>.";
$text['time_offset-current_time'] = "Current time";
$text['html_validation'] = "HTML Code Validation & Cleanup Rule Sets";
$text['html_validation-popup'] = "You can determine the type of HTML code validation and cleanup that is automatically done by the wysiwyg visual editor.";
$text['html_validation_explain'] = "The wysiwyg visual editor is equipped with a very powerful <b>html code validation</b> system that enables you to specify what HTML elements and attributes are allowed, and how HTML content should be generated. There is also a cleanup system that will automatically filter out any html elements and attributes that are not included in the option you have selected below.<p>If you find that your web pages do not look correct after saving (ie: some html code is being removed or changed) then you should select different options below until you find the one that works for you.)";
$text['html_validation_default'] = "Use limited XHTML rule set"; 
$text['html_validation_default-popup'] = "This option is the fastest because it uses only a basic list of the most common XHTML elements and attributes. It does not use the full xhtml rule set, but should work for most situations.";
$text['html_validation_full_xhtml'] = "Use full XHTML rule set";
$text['html_validation_full_xhtml-popup'] = "Selecting this option will slow down the loading time of the editor. However, it will make sure that any HTML code in the wysiwyg editor <b>fully</b> validates with the XHTML strict specification. <p>This option is the slowest to use because there is a lot of validation to perform. However, it is the most accurate if you want your HTML code to be fully xhtml compliant.<p>(The full xhtml list of valid attributes and elements used for tihs option is located in the <i>/includes/xhtml-full.inc</i> file.)";
$text['html_validation_allow_all'] = "Allow <b>all</b> elements and <b>all</b> attributes (even if they are invalid)";
$text['html_validation_allow_all-popup'] = "This option will allow all elements and all attributes to exist -- even if they are invalid! <p>Uses *[*] as the validation rule set.";
$text['html_validation_custom'] = "Use a custom HTML rule set";
$text['html_validation_custom-popup'] = "If this option is selected, the editor will allow <b>only</b> the list of  HTML elements and attributes that are specified in the <b>Custom HTML Rule Set</b> textbox. <p><b>Note:</b> Any elements and attributes that are NOT specified in the <b>Custom HTML Rule Set</b> textbox will be removed from your web page or snippets! <p>See the documentation for more information about how to create and use your own custom html validation rule set.)";
$text['custom_html_validation_ruleset'] = "Custom HTML Rule Set";
$text['custom_html_validation_ruleset-popup'] = "This is where you may enter your <i>custom html validation and cleanup rules</i>. <p>Note: <b>Only</b> the list of HTML elements and attributes that are specified in this box will be allowed. (Any elements and attributes that are NOT specified here will be removed from your web page or snippets!)<p>See the documentation for more information about how to create and use your own custom html validation rule set.";
$text['html_validation_extended_ruleset'] = "Extended Valid Elements";
$text['html_validation_extended_ruleset-popup'] = "Anything you specify here will be added to the validation & cleanup rule set you have selected above. <p>This can be very useful if the selected rule set is suitable, but you want to add a new elements or attributes that also should be valid. <p><b>WARNING:</b>If you specify an element that <i>already</i> exists in your selected rule set, then whatever you specify here will <b>override</b> the rule set value.<p>See the documentation for more information about how to create and use your own extended elements rule set.";
$text['html_validation_extended_ruleset-example'] = "Example: The <b>default XHTML rule set</b> does not allow the &quot;id&quot; attribute for the &quot;ul&quot; element, so if your HTML code has something like <i>&lt;ul id=&quot;navlist&quot;&gt;</i> then the id attribute will get &quot;cleaned&quot; and the output code will become <i>&lt;ul&gt;</i>. <p>However, if you enter <b>ul[id|zerk]</b> into this textbox, then the &quot;id&quot; and &quot;zerk&quot; attributes will be <i>added</i> to the list of allowed attributes for the &quot;ul&quot; tag... and the <i>id=&quot;navlist&quot;</i> attribute will no longer be &quot;cleaned&quot;.";
$text['whole_file_edit_mode'] = "Start &quot;Whole File Editing&quot; With";
$text['whole_file_edit_mode-popup'] = "When editing a &quot;whole file&quot; (not a snippet) should the program initially display the WYSIWYG visual editor or a regular textbox?";
$text['whole_file_edit_mode_wysiwyg'] = "WYSIWYG Editor";
$text['whole_file_edit_mode_textbox'] = "Textbox";
$text['enable_gzip_compressor'] = "Enable Editor Compression";
$text['enable_gzip_compressor-popup'] = "If this is selected, the visual editor will be compressed with GZip and also cached. It will load much faster, especially on subsequent visits to the editing page. <p>You should disable this option if you have any problems using the visual editor.<p>Note: Your web server needs to have the GZip system installed and turned on for this feature to work. Ask your web host to enable it if you are not sure.";
$text['link_type_absolute_relative'] = "Editor Link Type";
$text['link_type_absolute_relative-popup'] = "This setting determines what type of links the editor will use. (Note: All <i>existing</i> links in the HTML being edited will be converted to the option you select.) <p><b>Relative</b><br>All links will be relative URLs.<p><b>Absolute /</b><br>All links will be absolute URLs using a forward slash.<p><b>Absolute http://</b><br>All links will be absolute URLs using a full http:// hostname.";
$text['link_type_relative'] = "Relative";
$text['link_type_absolute_slash'] = "Absolute /";
$text['link_type_absolute_http'] = "Absolute http://";
$text['regular_user_privs'] = "Regular User Privileges (When Can Regular Users Edit Snippets?)";
$text['regular_user_privs-popup'] = "This setting determines how users with <b>Regular</b> privileges will be restricted to editing of snippets.<p>This setting is very important!<p>You must be <i>extremely</i> careful if you change this setting after you have created any access control lists for your Snippets.";
$text['regular_user_privs_option_acl_only'] = "Only if user is listed in the Snippet Tag access control list (ACL)";
$text['regular_user_privs_option_in_acl_or_no_acl'] = "If user is listed in Snippet Tag ACL <b>or</b> if no ACL exists for the Snippet Tag";
//$text['regular_user_privs'] = "The type of access allowed to Snippets for Regular Users can be changed by setting this option. <i>User Privileges</i> option in the General tab of the Admin Area.)";

//Admin area - user account list
$text['user_name'] = "Username";
$text['user_real_name'] = "Real Name";
$text['enabled'] = "Enabled?";
$text['user_type_listing'] = "User Type";
$text['action'] = "Action";
$text['modify'] = "Modify";
$text['delete'] = "Delete";
$text['confirm_delete_user'] = "Are you sure you want to delete this user?";
$text['cannot_delete_last_user'] = "You are not allowed to delete the last user. There must be at least one user for the program to work.";
$text['cannot_delete_own_user'] = "You are not allowed to delete your own user.";

//Admin area - new/edit user account
$text['UserID'] = "UserID";
$text['username-popup'] = "The username you specify here must be unique. (ie: It can not be used already by another user.) Usernames are <b>not</b> case sensitive.";
$text['password-popup'] = "Passwords are case sensitive.";
$text['Password_Re'] = "Re-enter Password";
$text['first_name'] =  "First Name";
$text['first_name-popup'] =  "Specify the first name for this user.";
$text['last_name'] =  "Last Name";
$text['last_name-popup'] =  "Specify the last name for this user.";
$text['email'] = "Email";
$text['email-popup'] = "Specify the email address for this user.  This is used if the user forgets his password and needs to have it resent.";
$text['enabled'] = "Enabled?";
$text['enabled-popup'] = "If the user is not enabled, then they will not be allowed to log in.";

$text['user_type'] = "User Privileges";
$text['user_type-admin'] = "Admin";
$text['user_type-admin_detail'] = "User has access to all Admin Areas. User can edit all files and all snippets.";
$text['user_type-super'] = "Super";
$text['user_type-super_detail'] = "User can edit all files and all snippets.";
$text['user_type-power'] = "Power";
$text['user_type-power_detail'] = "User can edit all snippets.";
$text['user_type-normal'] = "Regular";
$text['regular_user_privs-onlyif_in_acl_and_if_no_acl'] = "User can edit snippets if they are listed in the <i>Users</i> access control list of the Snippet Tag <b>OR</b> if there is no access control list specified for the Snippet Tag.";
$text['regular_user_privs-onlyif_in_acl'] = "User can only edit snippets if they are listed in the <i>Users</i> access control list of the Snippet Tag.";
$text['user_type-normal_can_be_changed_by_admin'] = "(Privilege scheme for Regular Users can be changed in the General settings area.)";


$text['start_URL'] = "Starting URL";
$text['start_URL-popup'] = "What is the starting URL for this user?  This value is the &quot;browser URL&quot; equivalent of the Starting Folder you specified. (ie: Using a browser, how would the user access the folder you specified as the Starting Folder.)";
$text['start_folder'] = "Starting Folder";
$text['start_folder-popup'] = "What is the starting folder for this user?  This is the folder that the user will initially &quot;be in&quot; when using the File Explorer navigation system. The user will not be able to navigate &quot;above&quot; this folder.<br /><br />Note: You must specify a full valid path here.  (Do not include the trailing slash character.)";
$text['language-popup'] = "What language should be used for this user?";
$text['allow_uploads'] = "Allow Uploads?";
$text['allow_uploads-popup'] = "Do you want this user to be allowed to use the Upload Utility to upload files?<br /><br /><i>Note: You can easily restrict what specific upload locations and settings are allowed for this user by creating a new Upload Group and then assigning it to this user. See the <b>Upload Groups</b> admin section for more information.</i>";
$text['use_upload_group'] = "Use This Upload Group";
$text['use_upload_group-popup'] = "What Upload Group should be assigned to this user.<br /><br />Upload Groups are used to specify a list of allowed upload locations and settings. You can create/modify/remove Upload Groups by clicking the Upload Group tab in the admin area.";
$text['use_list_group'] = "Use This List Group";
$text['use_list_group-popup'] = "What List Group should be assigned to this user?<br /><br />List Groups are used to specifiy a list of folders to include/exclude when using the File Explorer or browsing for images and links. You can create/modify/remove List Groups by clicking the List Group tab in the admin area.";
$text['use_editor_group'] = "Use This Editor Group";
$text['use_editor_group-popup'] = "hat Editor Group should be assigned to this user.<br /><br />Editor Groups are used to specify a list of editor options and functionality. You can create/modify/remove Editor Groups by clicking the Editor Group tab in the admin area.";
$text['notes'] = "Private Notes";
$text['notes-popup'] = "You can add any notes or details for this user. These notes are not displayed anywhere else except this box.";

#error messages
$text['password_not_same'] = "The two passwords you entered are not the same. The Password and Verification Password must be the same.";
$text['username_not_empty'] = "You must enter a username.";        
$text['password_not_empty'] = "You must enter a password.";        
$text['email_not_empty'] = "You must enter an email address.";
$text['start_root_not_empty'] = "You must enter a Starting Folder.";    
$text['start_url_not_empty'] = "You must enter a Starting URL.";      
$text['list_group_not_empty'] = "You must select a List Group for this user.";    
$text['upload_group_not_empty'] = "You must select an Upload Group for this user.";
$text['editor_group_not_empty'] = "You must select an Editor Group for this user.";
$text['time_format_not_empty'] = "You must enter a default time format.";        
$text['date_format_not_empty'] = "You must enter a default date format.";        
$text['time_offset_not_empty'] = "You must enter a time offset.";        
$text['username_not_unique'] = "The username you entered is already used by another user. Please enter a different one.";
$text['email_not_unique'] = "The program administrator has specified that every user must have a unique email address, and the email address you entered is already in use by another user. Please enter a different one.";
$text['cannot_disable_own_user'] = "You can not disable your own user.";
$text['cannot_remove_admin_privileges_from_own_user'] = "You can not remove admin privileges from your own user.";

//Admin area - list groups list
$text['list_name'] = "List Name";
$text['confirm_delete_listgroup'] = "Are you sure you want to delete this List Group?";
$text['cannot_delete_last_listgroup'] = "You can not delete the last List Group. There must be at least one List Group for the program to work.";
$text['cannot_delete_list_group_in_use'] = "The ListGgroup can not be deleted because it is currently used by at least one user.";

//Admin area - new list group
$text['list_group_name'] = "Short Name";
$text['list_group_name-popup'] = "What is a short a descriptive name for this list?  It is recommended to keep this value short and simple because it is used in various drop-down list boxes when selecting or displaying available List Groups.";
$text['description-popup'] = "You can enter a more detailed description here.";
$text['file_explorer'] = "File Explorer";
$text['file_explorer-popup'] = "Do you want to enable a list of folder names that can be excluded or included when using the File Explorer to find a file for editing?";
$text['use_list'] = "Use List";
$text['do_not_use'] = "Do not use list";
$text['list_type'] = "List Type";
$text['list_type-popup'] = "Do you want this list to be an <b>include</b> or <b>exclude</b> list type?<br /><br /><b>Exclude:</b> Any folder that matches a name in this list will <b>not</b> be displayed to the user.<br /><br /><b>Include:</b> Only folders that match a name in this list <b>will</b> be displayed to the user.";
$text['folder_names'] = "Folder Names";
$text['folder_names-popup'] = "This is the list of folder names that will be either excluded or included. You can add or remove any folder names. <p>(Do not enter a file <i>path</i>. Just the folder <b>name</b> is allowed.)<p>Any folder that matches a name you have entered here will either be included or excluded, depending on what List Type you have specified this to be.";
$text['one_folder_per_line'] = "(One folder name per line. Names are case-sensitive.)";
$text['exclude'] = "Exclude";
$text['include'] = "Include";
$text['WYSIWYG_editor_images'] = "Editor Image Browser";
$text['WYSIWYG_editor_images-popup'] = "Do you want to enable a list of folder names that can be excluded or included when using the WYSIWYG editor to find an image file?";
$text['WYSIWYG_editor_hyperlinks'] = "Editor Link Browser";
$text['WYSIWYG_editor_hyperlinks-popup'] = "Do you want to enable a list of folder names that can be excluded or included when using the WYSIWYG editor to find a hyperlink?";
$text['group_assigned_to'] = "Users Using This Group";
$text['group_assigned_to-popup'] = "This is a list of all users who have been assigned to use this group.";
//error messages
$text['listname_not_empty'] = "You must enter a name for the new List Group.";
$text['listname_not_unique'] = "The List Group name you entered is already assigned to another List Group. Please enter a different name.";

//Admin area - upload group list
$text['group_name'] = "Group Name";
$text['confirm_delete_uploadgroup'] = "Are you sure you want to delete this upload group?";
$text['cannot_delete_last_uploadgroup'] = "You can not delete the last upload group. There must be at least one upload group for the program to work.";
$text['cannot_delete_upload_group_in_use'] = "The upload group can not be deleted because it is currently used by at least one user.";

//Admin area - new upload group
$text['upload_group_name'] = "Upload Group Name";
$text['upload_group_name-popup'] = "What is the short name for this list.  It is recommended to keep this value short and simple because it is used in various drop-down list boxes when selecting or displaying available Upload Groups.";
$text['general_information'] = "General Settings";
$text['limit_file_types'] = "Limit File Types?";
$text['limit_file_types-popup'] = "Do you want to limit the types of files (file extensions) that are allowed to be uploaded for this Upload Group?";
$text['valid_file_types'] = "Allowed File Types";
$text['valid_file_types-popup'] = "What are the file types that are allowed to be uploaded for this Upload Group?";
$text['limit_file_size'] = "Limit File Size?";
$text['limit_file_size-popup'] = "Do you want to set a size limit for files uploaded using this Upload Group?";
$text['file_size_limit'] = "File Size Limit";
$text['file_size_limit-popup'] = "What is the maximum file size that will be allowed with this Upload Group?";
$text['bytes'] = "(bytes)";
$text['upload_locations'] = "Upload Locations";
$text['upload_locations-popup'] = "You can specify an unlimited number of upload locations for this Upload Group.";
$text['location_name'] = "Name";
$text['location_name-popup'] = "What is the user-friendly name for this location?  Users will see this name listed in the Upload Locations drop-down list, so you should be sure to make it short but descriptive.";
$text['location'] = "Path To Location";
$text['location-popup'] = "What is the <b>full file path</b> to this upload location? Do not add a trailing slash.<br /><br />This path <b>must</b> already exist and have write permissions enabled so that the program can write files into it.  This usually means you must first create the folder (your FTP client) and then &quot;chmod&quot; it to permissions of 666 or 777.";
$text['overwrite'] = "Overwrite?";
$text['overwrite-popup'] = "If the user attempts to upload a file with a name that already exists in this upload location, do you want the existing file to be overwritten?";
$text['___Add___'] = "   Add   ";
$text['upload_size_limit_name'] = "Kb";
$text['uploadgroup_assigned_to'] = "Users Using This Group";
$text['convert_uppercase_to_lower'] = "Auto-convert To Lowercase?";
$text['convert_uppercase_to_lower-popup'] = "If this option is enabled, the program will automatically convert any UPPERCASE FILENAMES to lowercase.<p>ie: If you upload a file called <b>FILENAME.JPG</b> then it will be renamed (after uploading) to <b>filename.jpg</b>.";

//error messages
$text['groupname_not_empty'] = "You must enter an upload group name.";
$text['groupname_not_unique'] = "The upload group name you entered is already assigned to another upload group. Please enter a different name.";
$text['filesize_not_number'] = "Please enter a valid number in the File Size Limit field.";
$text['location_name_not_unique'] = "The upload location <b>name</b> you entered ({0}) exists more then once in this upload group. Please enter a different name.";
$text['path_not_readable'] = "The path you entered either does not exist or it is not readable. ({0}) Please check that the folder exists and read permissions are set.";
$text['path_not_writable'] = "The path you entered is not writable. ({0}). Please make sure this folder exists and has write permissions enabled.";
$text['enter_uploadlocation_name'] = "You must enter a name for the new Upload Location..";
$text['locations_duplicated'] = "The upload location <b>path</b> you entered ({0}) exists more then once for in this upload group. You can not have more then one upload location with the same path.";

// Editor Groups
$text['editor_group_name'] = "Editor Group Name";
$text['editor_group_name-popup'] = "What is a short name for this Editor Group.  It is recommended to keep this value short and simple because it is used in various drop-down list boxes when selecting or displaying available Editor Groups.";
$text['editorgroup_misc'] = "General Options";
$text['editorgroup_misc-popup'] = "The default values below will be used unless the Snippet Tag specifies a different value.";
$text['editorgroup_width'] = "Default Editor Width";
$text['editorgroup_width-popup'] = "This is the default width. <p>You can specify a percentage by adding the % sign. ie: 100%</p><p><b>Note:</b> You can override this value by specifying a <i>width</i> attribute in the Snippet Tag. " .$text['pro_version_only'];
$text['editorgroup_height'] = "Default Editor Height";
$text['editorgroup_height-popup'] = "This is the default editor height. <p>You can specify a percentage by adding the % sign. ie: 100%</p><p><b>Note:</b> You can override this value by specifying a <i>height</i> attribute in the Snippet Tag. ".$text['pro_version_only'];
$text['editorgroup_resizing'] = "Allow User To Resize?";
$text['editorgroup_resizing-popup'] = "This will allow users to resize the editing window by using the resize button located at the bottom right corner of the editing window. <p>ie: Windows resize/drag style</p>";
$text['editorgroup_auto_resize'] = "Enable Auto Resize?";
$text['editorgroup_auto_resize-popup'] = "If this option is enabled, the editor window will try to automatically resize itself based on the content that is inside the editor.<p><b>Note:</b> This feature is <i>experimental</i> and may result in an editing window that is too small or too big. Do not leave this option enabled unless you have tested to see it works well for you in various browsers.";
$text['editorgroup_resizing_use_cookie'] = "Remember Last Resize?";
$text['editorgroup_resizing_use_cookie-popup'] = "This option allows you to &quot;remember&quot; the editor size by storing its last value in a cookie. This is helpful if you resize the editor window and want your changes to be &quot;remembered&quot;.";
$text['editorgroup_resize_horizontal'] = "Allow Horizontal Resize?";
$text['editorgroup_resize_horizontal-popup'] = "This option gives you the ability to enable/disable the horizontal resizing.<p><b>Note:</b> This option is only enabled if the <i>".$text['editorgroup_resizing']."</i> option is also enabled. ";
$text['editorgroup_visual'] = "Table Visual Aid?";
$text['editorgroup_visual-popup'] = "Turns on or off the visual aid for borderless tables. If the border of a table is set to 0, the editor will automatically display a dotted line around the table.";
$text['editorgroup_accessibility_warnings'] = "Accessibility Warnings?";
$text['editorgroup_accessibility_warnings-popup'] = "If this option is set to yes, then some accessibility warnings will be displayed to the user if they forget to add certain elements like an image <i>alt</i> tag. <p>This option is set to true default, since we should all try to make this world a better place for disabled people. But if you are annoyed with the warnings, set this option to false.</p>";
$text['editorgroup_wysiwyg_enable'] = "Enable WYSIWYG Editor?";
$text['editorgroup_wysiwyg_enable-popup'] = "If you disable this option, a normal textbox will be used for editing. (The WYSIWYG editor will not be used.)<p><b>Note:</b> You can override this value by specifying a <i>wysiwyg</i> attribute in the Snippet Tag. ".$text['pro_version_only'];
$text['editorgroup_blockformats'] = "Block Format Dropdown";
$text['editorgroup_blockformats-popup'] = "You can specify a <b>comma separated</b> list of <i>valid block formats</i> you want to display in the <b>-- Format --</b> dropdown list. <p>The formats you specify here will <i>replace</i> the default values. Leave this option empty to use the defaults: &quot;p,div,address,pre,h1,h2,h3,h4,h5,h6&quot;</p><p><b>Note:</b> If you enter a block type here and it is not displayed in the dropdown list, it is probably because the block type you entered is not a <i>valid</i> HTML block type.";
$text['editorgroup_fonts'] = "Font Family Dropdown";
$text['editorgroup_fonts-popup'] = "You can specify a <b>semicolon separated</b> list of font titles and font families separated by the <b>=</b> character. <p>Anything you specify here will <i>replace</i> the default values in the <b>-- Font family --</b> dropdown list. Leave blank to use the defaults. <p>The font titles will be dislayed in the fonts dropdown list and the font family names will be the string that gets inserted into the fontFamily CSS style of the selected text. <p>Example value: <p>Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace";
$text['editorgroup_use_custom_toolbar'] = "Use Custom Toolbar?";
$text['editorgroup_use_custom_toolbar-popup'] = "Choose <b>yes</b> if you want to specify your own custom toolbar options. <p>The button values you enter here will <i>replace</i> the default toolbar.";
$text['editorgroup_toolbar_default'] = "Default Value";
$text['editorgroup_toolbar_custom_instructions'] = "To create your own custom toolbar button rows, first copy the default value for each row into the textbox, and then remove/add the desired buttons.";
$text['editorgroup_toolbar_row1'] = "First Row Buttons";
$text['editorgroup_toolbar_row2'] = "Second Row Buttons";
$text['editorgroup_toolbar_row3'] = "Third Row Buttons";
$text['editorgroup_styleselect'] = "CSS styles dropdown";
$text['editorgroup_formatselect'] = "Block format dropdown";
$text['editorgroup_fontselect'] = "Font format dropdown";
$text['editorgroup_fontsizeselect'] = "Font size dropdown";
$text['editorgroup_bold'] = "Bold";
$text['editorgroup_italic'] = "Italic";
$text['editorgroup_underline'] = "Underline";
$text['editorgroup_strikethrough'] = "Strikethrough";
$text['editorgroup_forecolor'] = "Foreground color";
$text['editorgroup_backcolor'] = "Background color";
$text['editorgroup_sub'] = "Subscript";
$text['editorgroup_sup'] = "Supperscript";
$text['editorgroup_removeformat'] = "Remove all formatting";
$text['editorgroup_selectall'] = "Select all";
$text['editorgroup_cut'] = "Cut";
$text['editorgroup_copy'] = "Copy";
$text['editorgroup_paste'] = "Paste";
$text['editorgroup_pastetext'] = "Paste as plain text";
$text['editorgroup_pasteword'] = "Paste from Word";
$text['editorgroup_search'] = "Find";
$text['editorgroup_replace'] = "Find/Replace";
$text['editorgroup_undo'] = "Undo";
$text['editorgroup_redo'] = "Redo";
$text['editorgroup_bullist'] = "Unordered (bulleted) list";
$text['editorgroup_numlist'] = "Ordered (numbered) list";
$text['editorgroup_outdent'] = "Outdent";
$text['editorgroup_indent'] = "Indent";
$text['editorgroup_justifyleft'] = "Align left";
$text['editorgroup_justifycenter'] = "Align center";
$text['editorgroup_justifyright'] = "Align right";
$text['editorgroup_justifyfull'] = "Align full";
$text['editorgroup_advhr'] = "Horizontal rule";
$text['editorgroup_charmap'] = "Insert customer character";
$text['editorgroup_tablecontrols'] = "Table controls";
$text['editorgroup_anchor'] = "Insert/edit anchor";
$text['editorgroup_link'] = "Insert/edit link";
$text['editorgroup_unlink'] = "Remove link";
$text['editorgroup_image'] = "Insert/edit image";
$text['editorgroup_visualaid'] = "Toggle visual table guide";
$text['editorgroup_cleanup'] = "Cleanup messy code";
$text['editorgroup_code'] = "Show HTML source code";
$text['editorgroup_fullscreen'] = "Toggle fullscreen edit mode";
$text['editorgroup_help'] = "Help";

//Editor groups errors
$text['editorgroup_confirm_delete'] = "Are you sure you want to delete this Editor Group?";
$text['editorgroup_cannot_delete_last'] = "You can not delete the last Editor Group. There must be at least one Editor Group for the program to work.";
$text['editorgroup_cannot_delete_in_use'] = "This Editor Group can not be deleted because it is currently used by at least one user.";
$text['editorgroup_name_empty'] = "You must enter a name for this Editor Group.";
$text['editorgroup_name_not_unique'] = "The name you entered for the Editor Group is already used by another Editor Group. Please try a different name.";
$text['editorgroup_height_empty'] = "You must enter a default height for this Editor Group. (If you are not sure, try a value of 450.)";
$text['editorgroup_width_empty'] = "You must enter a default width for this Editor Group. (If you are not sure, try a value of 100%.)";

//Misc errors
$text['please_enter_license'] = "Please enter a license key or leave it blank if you want to use the free LITE version.";
$text['license_invalid'] = "The license key you entered is either not valid or a connection to the licensing server was not possible.";
$text['license_suspended'] = "The license key you entered is suspended and may not be used. Please contact support for assistance.";
$text['license_expired'] = "The license key you entered is expired. To use this key you must renew your support.";
$text['license_pending'] = "The license key you entered is still pending approval.";
$text['unable_to_write_local_keyfile'] = "I was unable to write license information to the local license key file.";
$text['please_enter_script_path'] = "You must enter a Program Path.";
$text['please_enter_script_url'] = "You must enter the Program URL.";
$text['please_enter_username'] = "You must enter a username.";
$text['please_enter_password'] = "You must enter a password for this user.";
$text['please_enter_password2'] = "You must enter a verification password.";
$text['password_mismatch'] = "The two passwords you entered did not match. They must be the same.";
$text['please_enter_fullname'] = "You must enter a first and last name for this user.";
$text['please_enter_language'] = "You must choose a language for this user.";
$text['please_enter_email'] = "You must enter an email address for this user.";
$text['please_enter_start_root'] = "You must enter a Starting Folder for this user.";
$text['please_enter_start_url'] = "You must enter a Starting URL for this user.";
$text['script_path_not_readable'] = "I was not able to find the Program Path you entered. ({0}) Please check that the path exists and read permissions are set.";
$text['start_root_not_readable'] = "I was not able to find the Starting Folder you entered. ({0}). Please check that the path exists and read permissions are set.";

//success messages
$text['general_saved'] = "The settings were saved.";
$text['user_added'] = "The new user was added.";
$text['user_saved'] = "The user details were saved.";
$text['user_deleted'] = "The user was deleted.";
$text['listgroup_added'] = "The new List Group was added.";
$text['listgroup_saved'] = "The List Group details were saved.";
$text['listgroup_deleted'] = "The List Group was deleted.";
$text['uploadgroup_saved'] = "The Upload Group details were saved.";
$text['uploadgroup_added'] = "The new Upload Group was added.";
$text['uploadgroup_deleted'] = "The Upload Group was deleted.";
$text['editorgroup_added'] = "The new Editor Group was added.";
$text['editorgroup_saved'] = "The Editor Group details were saved.";
$text['editorgroup_deleted'] = "The Editor Group was deleted.";

// Misc messages.
$text['coming_soon'] = "More features will be coming soon!";
$text['reserved'] = "Reserved for future feature.";
$text['please_wait'] = "Loading the WYSIWYG editor... (please wait)";
$text['toggle_editor'] = "Toggle WYSIWYG/Textbox Editor";
$text['maximum_users_reached'] = "Sorry, but you have reached the maximum number of users allowed for your license. Please purchase an additional block of users if you need to add more.";


// Version 2.2
$text['confirm_file_delete'] = "Are you SURE you want to delete this file?";
$text['delete_file_success'] = "The file was deleted successfully.";
$text['delete_file_fail'] = "I was not able to delete the file.<br>(Check file ownership and try again.)";
$text['rename'] = "Rename";
$text['rename_file_prompt'] = "Enter the new name for this file:";
$text['rename_file_success'] = "The file was renamed successfully.";
$text['rename_same_name'] = "The new name you entered is the same as the old name. No change was made.";
$text['rename_file_already_exists'] = "A file with the new name already exists.<br>(You must first delete the existing file or try again with a different name.)";
$text['rename_file_fail'] = "I was not able to rename the file.<br> - Be sure the new name does not contain any invalid characters.<br> - Verify file permissions & ownership are correct.";

$text['manage_files'] = "Can Manage Files?";
$text['manage_files-popup'] = "If enabled, this user will be able to perform file management tasks (ie: delete and rename) for files in any of the upload locations specified in their Upload Group.<p><b>Note:</b> This option is only applicable to users with Power or Regular User permissions. (Users with Admin or Super User privileges will always have full file management permissions.)";

$text['disk_quota'] = "Disk Space Quota";
$text['disk_quota-popup'] = "You can specify a maximum disk space allowed. This limit will include files from all upload locations in this Upload Group.";
$text['user_disk_quota-popup'] = "<b>Note:</b> Any disk space quota specified here for this user will <b>override</b> the disk space quota for the Upload Group.";
$text['upload_group_disk_quota-popup'] = "<b>Note:</b> You can override this value on a per-user basis.";
$text['megabytes'] = "Mb";
$text['disk_quota_unlimited'] = "(Use -1 for unlimited)";
$text['disk_quota_is_blank'] = "The disk space quota may not be blank. ".$text['disk_quota_unlimited'];
$text['disk_quota_not_numeric'] = "You entered an invalid disk quota. (The value must be a number.)";
$text['disk_space_used'] = "Total Disk Space Used";
$text['disk_space_allowed'] = "Total Disk Space Allowed";
$text['quota_exceeded_error'] = "You are over your disk space quota.<p>You must delete some files in your upload destination folder(s) or ask the program administrator to increase your disk space quota.";

$text['backup_database'] = "Database Backup";
$text['backup_database_button'] = "Download Now";
$text['backup_database-popup'] = "Click the button to download a backup file of your program database.";
$text['encoding_type'] = "Software Encoding Type";


// Version 2.3
$text['change_license_key'] = "Click here to change your license key";
$text['unable_to_open_popup'] = "I was unable to open the File Browser window.";
$text['disable_popup_blocker'] = "You must disable your popup blocker software and try again.";
?>