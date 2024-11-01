=== VideoSurf Video Link Enhancer ===
Contributors: videosurf 
Tags: video, links, enhance, embed, player, link, improve, automatic, easy, videos, youtube, metacafe, dailymotion, hulu
Requires at least: 2.0.2
Tested up to: 2.8
Stable tag: trunk

This plugin enhances links to videos with the ability to play the video inline on hover without the reader leaving your page.

== Description ==

Turn video links in your posts and comments into playable inline videos, right in your blog! With the VideoSurf Video Link Enhancer, when your readers hover their mouse over links to videos, an in-line player appears that allows them to watch the linked video without having to leave your page. Videos from hundreds of sites are supported, including Hulu, Youtube, Metacafe, Dailymotion, Comedy Central, Yahoo! Video, Google Video, Fancast, and many, many more.

== Installation ==

1. Upload `videosurf_video_link_enhancer.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Does this work for all videos? =

We support videos from hundreds of sites and the list is growing every day.  We can only support video sites that have embeddable players.  Our index does not contain every video from every site, but our coverage is quite good and we are constantly adding more so if it doesn't work for a particular link, check again later and it will most likely be there.  

= Can I customize it at all? =

Yes!  There are a bunch of options you can append to this url.  
For more info, visit: http://www.videosurf.com/tools/video-link-enhancer

Highlights include:

 * link\_selector\_prefix: By default, the script acts on all links on the page. To limit it to only certain areas of your page, you can add a css selector here. This may also have performance benefits. Make sure to url encode any #'s. e.g. link\_selector\\_prefix=%23content will limit it to only links inside the container on your page with id of "content", or link\_selector\_prefix=p will limit it to only links inside p tags. We're using JQuery's selector syntax here and will be appending " a" to whatever you provide.
 * link\_selector\_suffix: In addition to the prefix, you can optionally add a suffix to the link selector. This may be useful if you want to limit the script to act on only links with a certain class or that contain certain text.  Again, this uses JQuery's selector syntax.  
 * overlay\_bg\_color: Hex code of what you want the background color to be behind the embed.
 * overlay\_text\_color: Text color inside the overlay, useful if you change the bg color.
 * add\_link\_icon: Should we add the little videosurf icon next to each enhanced link? You can change this to "false" to remove it.

== Screenshots ==

1. A Hulu video's inline popup
1. A Youtube video's inline popup
1. The plugin in action on a wordpress blog.  Hovering over the link causes the video to show up.

== Changelog ==

= 1.0 =
* Initial Version

= 1.1 = 
* Add settings page with easily editable options
