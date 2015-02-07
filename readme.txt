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

The Bible Embed plugin for WordPress
Using an API from Biblia.Com this plugin embeds the bible right into your pages and posts, or anywhere you want.

Please note that this plugin requires an API Key from Biblia.Com.

[Click this link to register for a Biblia.Com API key!](http://api.biblia.com/v1/Users/SignIn)

##Shortcode Usage Example

###Simple Usage

<pre>
[bible passage="Jn 3:16"]
</pre>

###Advanced Usage

<pre>
[bible passage="John 3:15-18" version="KJV" shownum="no" 1vpl="no" versesep="div" sepclass="bible-verse"]
</pre>

###Parameters

* **passage** *(is the bible passage that you want to display.)*
* **version** *(is the bible translation that you want to use, default is KJV.)*
* **shownum** (show the verse numbers (yes or no), default is no.)*
* **1vpl** *(one verse per line (yes or no), default is yes.)*
* **versesep** *(is the html element that wraps a single verse, default is the ”&lt;p&gt;” tag.)*
* **sepclass** *(is the verse wrapper css class.)*

== Installation ==

1. Upload the `bible-embed.zip` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the Plugins Manager in WordPress
3. Register your website with Biblia.Com to recieve an API key.
4. Go to Dashboard > Settings > BibleEmbed and enter you API key.

== Screenshots ==

1. screenshot-1.jpg
2. screenshot-2.jpg
3. screenshot-3.jpg