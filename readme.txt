=== Bible Embed ===
Contributors: jd7777
Tags: bible, embed, text
Donate link: http://www.joshuawieczorek.com/donate
Requires at least: 2.0
Tested up to: 4.1
Stable tag: 4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to display bible verses and passages directly in your posts and pages through the use of a shortcode.

== Description ==

= Coming Soon!!!! Version 2.0. =

With 2.0 you will have the ability to install the bible directly into your website, no external API calls.

And better yet, no more API keys!!!!

Yea!!!!!

The Bible Embed plugin for WordPress
Using an API from Biblia.Com this plugin embeds the bible right into your pages and posts, or anywhere you want.

Please note that this plugin requires an API Key from Biblia.Com.

1. If you don’t already have an account with Logos.Com [click here to register with Logos.](https://www.logos.com/register) You will need it to register you website with Biblia.com.
2. [Click this link to register for a Biblia.Com API key!](http://api.biblia.com/v1/Users/SignIn)

= Shortcode Usage Example =

Here I will demonstrate how to use the shortcode.
 
= Simple Usage =

<pre>
[bible passage="Jn 3:16"]
</pre>

= Advanced Usage =

<pre>
[bible passage="John 3:15-18" version="KJV" shownum="no" 1vpl="no" versesep="div" sepclass="bible-verse"]
</pre>

= Parameters =

* **passage** *(is the bible passage that you want to display.)*
* **version** *(is the bible translation that you want to use, default is KJV.)*
* **shownum** *(show the verse numbers (yes or no), default is no.)*
* **1vpl** *(one verse per line (yes or no), default is yes.)*
* **versesep** *(is the html element that wraps a single verse, default is the ”&lt;p&gt;” tag.)*
* **sepclass** *(is the verse wrapper css class.)*

= Lang = 

Currently this plugin is only in English, however, if anyone would like to translate it into another language please contact me at josh@joshuawieczorek.com. The contribution would be greatly appreciated.

== Installation ==

1. Upload the `bible-embed.zip` file  to the `/wp-content/plugins/` directory
2. Activate the plugin through the Plugins Manager in WordPress
3. Register your website with Biblia.Com to recieve an API key.
4. Go to Dashboard > Settings > BibleEmbed and enter your API key.

== Screenshots ==

1. screenshot-1.jpg
2. screenshot-2.jpg
3. screenshot-3.jpg

== Changelog ==

= Version 0.0.4 = 
Changed output text on archive pages.

= Version 0.0.3 = 
Speed up pageload by restricting API calls to only single pages and posts, it will just display the passage reference on archive pages.

= Version  0.0.2 = 

Initial plugin release.

