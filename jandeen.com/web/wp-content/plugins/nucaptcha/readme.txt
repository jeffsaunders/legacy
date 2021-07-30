=== NuCaptcha WordPress Plugin  ===
Contributors: Christopher Bailey, Gary Richardson, Randy Lukashuk
Donate link: http://www.nucaptcha.com/
Tags: Akismet, best captcha, capatcha, capcha, captcha puzzle, captsha, comment, contact form, security, security captcha, spam protection, comments, registration, recaptcha, captcha, nucaptcha, spam, antispam, login, bots, protection, spammers, plugin

Requires at least: 2.7
Tested up to: 3.5
Stable tag: trunk

Protect your site with a video CAPTCHA solution that provides better security and is easier to read for your visitors.  

== Description ==

Publishers have a choice between old style, static CAPTCHA security that is easily broken and frustrating to users OR NuCaptcha. 

[NuCaptcha Free](http://www.nucaptcha.com/publishers "NuCaptcha Free") is a free, easy to use, service for Wordpress users.

[NuCaptcha Free](http://www.nucaptcha.com/publishers "NuCaptcha Free") provides a complete video CAPTCHA solution with:

* High quality video [NuCaptchas](http://www.nucaptcha.com "NuCaptcha -- Better Security, Easier to Use")
* Enhanced security
* Greater usability for users
* Better conversions
* Piece of mind

Add captchas to your contact forms, registration pages, comments, login and password reset forms.  The NuCaptcha WordPress plugin is fully compatible with [BuddyPress](http://buddypress.org) and [Contact Form 7](http://contactform7.com). 

For more information please view the [plugin page](http://docs.nucaptcha.com/plugins/wordpress "WordPress NuCaptcha Plugin Page")

See a NuCaptcha in action and find out more at:
http://www.nucaptcha.com/

== Installation ==

Installation is easy! Simply click the Download/Install button on the right hand side of this page.

You can also install manually with FTP or the WordPress Plugin Uploader.  See the [documentation](http://docs.nucaptcha.com/plugins/wordpress "WordPress NuCaptcha Plugin Install Instructions") for For more information on these methods.

== Requirements ==

* [NuCaptcha](http://www.nucaptcha.com "NuCaptcha -- Better Security, Easier to Use") requires your web server to have the [mcrypt](http://php.net/mcrypt "mcrypt") PHP module loaded (*Most servers do*)
* PHP 5.1 or newer
* Your theme must have a `do_action('comment_form', $post->ID);` call right before the end of your form (*Right before the closing form tag*). Most themes do.

== ChangeLog ==
 
= Version 1.0.15788 =

* Updated NuCaptcha PHP Client library to 1.0.16383

= Version 1.0.15788 =

* Updated NuCaptcha PHP Client library to 1.0.13738

= Version 1.0.12405 =

* Fixed a minor issue with NuCaptcha Create Account

= Version 1.0.11963 =

* Improved error handling in NuCaptcha config page

= Version 1.0.11936 =

* CSS fix in NuCaptcha config panel
* Fixing a bad API url that was submitted to the WP plugin repository

= Version 1.0.11256 =

* Documentation update


= Version 1.0.10906 =

* Windows host minimum PHP requirements is now 5.1 (down from 5.3)

= Version 1.0.10695 =

* Support for BuddyPress registration page
* Support for Contact Form 7 forms

= Version 1.0.10605 =

* Create account is now done at https://console.nucaptcha.com
* Added custom skin option
* NuCaptcha resources served over SSL for WP sites on https
* Re-organized the options into basic and advanced
* Improved Sign In UI
* Updated NuCaptcha Client library to 1.0.10543

= Version 1.0.9251 =

* Fixes minor incompatibility with themes that have multiple elements with id="comment" on the page.

= Version 1.0.9204 =

* Updated NuCaptcha Client library to 1.0.9158
* NuCaptcha is now visible by default on comment form

= Version 1.0.8979 =

* Fixes an issue with NuCaptcha showing up when replying to comments in the admin dashboard.

= Version 1.0.8395 =

* NuCaptcha WordPress plugin now works with caching plugins such as wp-cache and wp-super-cache!
* Improved theme compatibility
* Fixed some PHP warnings that would show up on certain configurations
* Automatically detects incompatible plugins

= Version 1.0.8256 =

* Upgraded php clientlib to 1.0.8186
* Public persistent data validation less strict.  The NuCaptcha platform handles this at the validate server.

= Version 1.0.7813 =

* Fixed an issue with ValidateOnError.  It now only validates for errors that occur during the token request.

= Version 1.0.7435 =

* Fixed a validation error that could occur in rare instances on older browsers (IE 6, Opera 8 etc)

= Version 1.0.7379 =

* Added ValidateOnError, enabled by default

= Version 1.0.7149 =

* Fixed a PHP pass by reference warning

= Version 1.0.6925 =

* Fixed 'Invalid Key, cannot decipher' messages that occurred on certain systems.

= Version 1.0.6781 =

* Fixed an incompatibility with other login/registration form plugins.

= Version 1.0.6609 =

* Upgraded php clientlib to 1.0.6593.
* Improved handling of poor connections.
* Improved error handling.

= Version 1.0.6581 =

* Added an option to 'Ignore Admin Login'.
* Added a notice for admin users when their answers are ignored.
* Fixed an account creation bug when WordPress address and Blog address were different.

= Version 1.0.6454 =

* Upgraded php clientlib to 1.0.6448.

= Version 1.0.5982 =

* Plugin is more compatible with custom themes.
* Fixed a bad url in the admin page when blog url is different than site url.

= Version 1.0.5958 =

* Upgraded to php clientlib 1.0.5951.
* Added login form nucaptcha back in (ignores validate for admin users)
* SSL Verify Enable is now an option.  Improved error handling when SSL cert bundles aren't configured correctly.
* Fixed an error in WP http_streams implementation when running without lib curl.
* Improved help text in config settings page.

= Version 1.0.5936 =

* Fixed an error in the update account page.

= Version 1.0.5928 =

* Better dependency checking before the plugin attempts to activate.

= Version 1.0.5907 =

* Updated to clientlib 1.0.5907
* Better handling of DNS records.

= Version 1.0.5892 =

* PHP requirement on Windows bumped up to 5.3
* Removed the login captcha because it was locking people out when there were incompatibilities in their configuration.

= Version 1.0.5857.1 =

* Fixed an exception that occurred when your server environment didn't have SSL certs configured correctly (example: Base install of MAMP on OSX).

= Version 1.0.5857 =

* Initial [NuCaptcha](http://www.nucaptcha.com "NuCaptcha -- Better Security, Easier to Use") release.

== Frequently Asked Questions ==

Refer to [our support](http://questions.nucaptcha.com/ "WordPress NuCaptcha Plugin FAQ") page for answers to Frequently Asked Questions.

== Screenshots ==

1. The NuCaptcha Comment Form
2. The NuCaptcha Registration Form
3. The NuCaptcha Settings
