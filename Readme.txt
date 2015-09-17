=== NS Author Widget ===
Contributors: Miodrag Rasic
Tags: author widget, author box, netscripter, wordpress, widget, plugin,
Requires at least: 3.0
Tested up to: 4.3.1
Stable tag: trunk
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0-standalone.html

NS Author Widget is a sidebar or footer widget that displays on single posts with Post Author\'s name, avatar, description, link to all posts and social profiles.

== Description ==
NS Author Widget is a sidebar or footer widget that displays on single posts with Post Author\'s name, avatar, description, link to all posts and social profiles. This plugin adds five extra fields to user\'s profile page (Dashboard/Users > Your Profile), where you can enter your Social Profiles URL.
If your Email address is registered in gravatar, then the author's gravatar image will be displayed.

== Installation ==
 - From The WordPress Dashboard

    Navigate to the \'Add New\' in the plugins dashboard
    Search for \'NS Author Widget\'
    Click \'Install Now\'
    Activate the plugin on the Plugin dashboard.

 - Uploading to your WordPress Dashboard

    Navigate to the \'Add New\' in the plugins dashboard
    Navigate to the \'Upload\' area
    Select ns-author-widget.zip from your PC or Lap Top
    Click \'Install Now\'
    Activate the plugin in the Plugin dashboard.

 - Using FTP Client

    Download ns-author-widget.zip
    Extract the ns-author-widget directory to your PC or Lap Top
    Upload directory to the /wp-content/plugins/ directory
    Activate the plugin in the Plugin dashboard.

 - IMPORTANT:
    Go to the Dashboard/Users > Your Profile > Social Profiles: enter necessary data.

== Frequently Asked Questions ==
= Does the plugin support localization? =

Yes, you can find .POT file in a folder \"languages\".

Please send your localization files (.mo и .po) to admin@netscripter.info

== Screenshots ==
1. Five new added fields in User's profile page.
2. front end look with social icons.
3. Front end look without social icons.
4. Widget Panel.

== Changelog ==

= 1.3 =
* Changed WP_Widget that is deprecated since version 4.3.0, to __construct.

= 1.2 =
* A change of style and some css class names so there could not be any conflict and overrides with Font Awesome styles already added in themes.

= 1.1 =
* 1.3
* 1.2
* 1.1

== Upgrade Notice ==

= 1.3 =
This version makes NS Author Widget compatibile with 4.3.0 release and remove  WP_Widget is deprecated since version 4.3.0! Use __construct() Notice. Upgrade immediately.

= 1.2 =
This version fixes potential css style conflicts and overrides.  Upgrade immediately.
