<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>


<!--
HTML setup
You need to include two things on your web page. The Flowplayer JavasScript component and a container for the player which is a Flash component.
-->

<!-- 1. load the Flowplayer JavaScript component
<script src="/your/server/flowplayer-3.2.6.min.js"></script>
 -->
<!-- 2. the player container. Supply desired video dimensions with CSS
<div id="player" style="width:640px;height:360px;"></div>
 -->
<!--
Both of thsese can be placed anywhere on the page. You can download the JavaScript file here.

Player installation
After these it's time to install the player. It happens with a single JavaScript call as follows

<script>
flowplayer("player", "http://builds.flowplayer.netdna-cdn.com/86101/47518/flowplayer-3.2.7-0.swf",  {
		
	// player configuration goes here
	clip: 'my/video/file.mp4'
	
});
</script>
-->
<!--
flowplayer() is a JavaScript function that accepts three arguments:

id of the player container. here we use a value "player" and the player container is a DIV tag
path to your custom player
Flowplayer configuration. This will override the configuration that was build inside the player upon setup. Here is where you can do many, many different things. Look for a minimal configuration example or large demo area for the possibilities.
Video file
Your videos are typically MPG, AVI, MOV or WMV files and web files must be in FLV or H.264 format. A conversion is needed. You can use tools such as ffmpeg for the conversion but it's complex and time consuming. Flowplayer Setup is integrated with encoding.com. We want to give this dirty job to the specialists.

After you have successfully encoded your video you can supply different video file from the configuration like this
-->

				<script src="/video/flowplayer-3.2.6.min.js"></script>
				<div id="player" style="width:320px;height:240px;"></div>
				<script>
					flowplayer("player", "/video/flowplayer-3.2.7-0.swf", {
						clip: {
							url: "/video/KentuckyDerbyShow2006.flv",
							autoBuffering: true,
							autoPlay: false
							}
						}
					);
				</script>

<!--

Clip properties
The following clip properties can be set in the configuration. Properties of a Clip specified in the Playlist override those of the Common Clip.

property / datatype	default	description
accelerated
boolean
false	 Flag indicating whether Flash 9 (and above) hardware-accelerated full screen mode should be used.
autoBuffering
boolean
false	 Flag indicating whether loading of clip into player's memory should begin straight away. When this is true and autoPlay is false then the clip will automatically stop at first frame of the video.
autoPlay
boolean
true	 Flag indicating whether the player should start playback immediately upon loading.
baseUrl
string
The first part of the URL of the video's location. This property is prepended in front of the url property (for relative URLs). If not specified, the video file is loaded from the same directory as the enclosing HTML file.
bufferLength
integer
3	 The amount of video data (in seconds) which should be loaded into Flowplayer's memory in advance of playback commencing.
connectionProvider
string
Sets a connection provider to be used for this clip. Connection providers can be used to create a connection to a streaming server or to a CDN network. An example is our secure streaming plugin that is configured as a connection provider when used with the Wowza server. The value of this property should be the name of a configured plugin.
cuepointMultiplier
integer
1000	 The times of embedded cuepoints are multiplied by this value before being used. Some encoding tools embed cuepoints in seconds but Flowplayer processes cuepoints in milliseconds. Note that the times are also rounded to the nearest 100 milliseconds. For example, if a file has a cuepoint at 5.535 seconds, the cuepoint is fired at 5500 milliseconds (assuming the default multiplier value of 1000).
cuepoints
array
The cuepoint objects of this clip. The property contains all embedded cuepoints, cuepoints specified in the configuration and also all cuepoints added dynamically using the addCuepoint() method.
controls
object
since 3.1.1.. Alternate controlbar configuration for this clip. This overrides the settings specified for the controlbar plugin. This is mainly used when you have multiple clips on the playlist and you want to tweak the controlbar looks for a specific clip. All controlbar properties can be tweaked with the exception to the url and positioning properties. You can see this feature in action in this instream playlist demo.
duration
number
0	 The time, in seconds and fractions of a second, for which a video clip should be played until playback ceases. This must always be less than or equal to the total length of the clip. Zero means to play the whole clip.
extension
string
The file extension extracted from the url property.
fadeInSpeed
integer
1000	 Time in milliseconds to fade from zero to full opacity upon commencement of video playback.
fadeOutSpeed
integer
1000	 Time in milliseconds to fade from full to zero opacity upon completion of video playback.
image
boolean
Is the previous clip being used as a splash image for this audio clip? Only relevant to audio clips.
linkUrl
string
The URL to direct users to when clicking the video screen.
linkWindow
string
_self	
Defines where the page defined by linkUrl is opened. Available options are:

_self specifies the current frame in the current window.
_blank specifies a new window.
_parent specifies the parent of the current frame.
_top specifies the top-level frame in the current window.
_popup a popup browser window.
live
boolean
RTMP streaming servers support live streaming, which means that it is possible to setup a video camera or other live video source to stream live video data to Flowplayer. If you have an RTMP server which is providing a live video stream, you should set this property to true.
metaData
object
Normally the player shows the video only when it has read the dimensions metadata from the video file. If the file does not have metadata at all the video will not be shown at all. By setting this to property to false, the player will display the video even when the metadata is not available in the file.
originalUrl
string
The original URL of this clip before it has been updated by any URL resolver, like the bandwidth check plugin that changes the URL to reflect the chosen bitrate.
position
integer
since 3.1.1. If the clip is contained within an instream playlist this property defines when the clip will start in relation to the parent clip. If position is 0 then the clip will be played before the parent clip and if the position is -1 then the instream clip will be played after the main clip.
playlist
array
since 3.1.1. The instream playlist of this clip.
provider
string
http	 The type of video source. By default, Flowplayer assumes that the source is a regular web server (with the provider name http). To use another provider, you must�also configure the provider in your configuration specification. This page describes how to do that.
Flowplayer comes packaged with pseudostreaming and RTMP providers, and you can also build your own.

scaling
string
scale	
Setting which defines how video is scaled on the video screen. Available options are:

fit: Fit to window by preserving the aspect ratio encoded in the file's metadata.
half: Half-size (preserves aspect ratio)
orig: Use the dimensions encoded in the file. If the video is too big for the available space, the video is scaled using the 'fit' option.
scale: Scale the video to fill all available space. Ignores the dimensions in the metadata. This is the default setting.
seekableOnBegin
boolean
Can we seek this clip when it's paused in the first frame. When true the scrubber becomes disabled when the palyer is paused on the first frame. By default the scrubber is enabled when the clip url has one of the filename extensions that are used for Flash video 'f4b', 'f4p', 'f4v', 'flv'.
start
integer
0	 The time (in seconds) at which playback should commence. This is only supported when you have a streaming server.
url
string
The URL of the video file to be loaded. You can specify an absolute URL here, or one that is relative to the current HTML file. Supported file formats are FLV and H.264-encoded MP4 and M4V for video, and JPG, GIF and PNG for images. The URL can also be given as the href attribute of the player container. If both are given then the configuration property overrides the href attribute.
urlEncoding
boolean
If true the clip's url will be url-encoded. Use this if the url contains international characters, for example chinese characters.
urlResolvers
string/list
Sets a URL resolver to be used for this clip. URL resolvers are used to resolve the final URL for the clip before it gets played. Examples are our bandwidth detection and secure streaming plugins that are both URL resolvers. The value of this property should be the name of a configured plugin. It's possible to use several URL resolvers and in this case the value is a list, for example ['bwcheck', 'secure']. See this demo that shows how to combine two URL resolvers.. NOTE: URL resolvers are applied automatically if this property is not present and there are URL resolver plugins in the configuration. You can specify urlResolvers: null if you want insure that no urlResolvers are applied for this clip.
Custom properties
You can also create custom properties for a clip. You give them a name and they can have any value, which can even be an object in json. Flowplayer stores these custom properties with the Clip object so when you refer to the Clip or receive it in an event listener, all these properties are available to you. Specifying such properties in the Common Clip makes them available for all clips; specifying them only for a single Clip makes them available only for that Clip. Here is an example:

playlist: [
    {
		// "standard" flowplayer properties
		url: 'path/to/movie.flv',
		autoPlay: false,

		// custom property
		title: 'Swimming on ice at Lapland',

		// custom properties can also be objects such as here
		details: {
			date: '03/24/2008',
			creator: 'John Doe',
			subject: ['culture', 'traveling', 'scandinavia']
		}
    }
]
Clip events
When inside a Player or Clip object a situation occurs that might be of interest to you, we have defined an event for that situation. If you want to know the situation occurs, you register an event listener, a function that you provide (write), that will be called when the particular situation occurs. For example, the onStart event of a Clip informs you the Clip has started playing and you may want to set the clip's title below the Player.

You can register Clip event listeners directly in the root of the configuration and Flowplayer will register them with the Common Clip so that they will be called when the event ocurrs for each Clip in the Player. Each Clip can also have own event listeners that will be called before the corresponsing event listener of the Common Clip. If you return false from an event listener, no other event listener will be called.

Note: Although an event listener registerd in the root level is registererd with the Common Clip, it does not replace an event listener that is set in the Common Clip. An event listener provided in the root will be called last.

The following example shows the three ways of providing an event listener in the configuration:

<SCRIPT>
flowplayer("player", "flowplayer.swf", {
    clip: {
        onStart: function() {
            msgs.innerHTML += "Common Clip event listener called<br>";
        }
    },
    playlist: [
        {
            url: 'KimAronson-TwentySeconds58192.flv',
            onStart:function() {
                msgs.innerHTML += "Playlist's Clip event listener called<br>";
            }
        },
        'KimAronson-TwentySeconds63617.flv'
    ],
    onStart: function() {
	    msgs.innerHTML += "Root's Clip event listener called<br>";
    }
});
</SCRIPT>
<div id='msgs'></div>
The output of the above code, when the first clip starts playing, is:

    Playlist's Clip event listener called
    Common Clip event listener called
    Root's Clip event listener called

Basic clip events
Listeners to clip events have their this variable set to the current Player object and receive as their first argument a reference to the Clip on which the event fires.

For some events, there is also an onBefore version of the event, e.g. onBeforePause and onPause. Returing false from an onBefore event will cancel the event, i.e. the action is not performed and its on version will not be called.

Event	When does it fire?	If the action is cancelled
onBegin 
onBeforeBegin	 This is always the first event to fire during the 'lifecycle' of a clip, and it does so as soon as the clip's video file has started buffering. Playback of the clip has not yet commenced, but streaming/downloading has been successfully initiated.	Playback will not start.
onFinish 
onBeforeFinish	This fires when the clip reaches the end and the "Play again" button appears.	 In the case of a single clip, the player will start from the beginning of the clip. In the case of an ordinary clip in a playlist, the "Play again" button will appear. In the case of the final clip in a playlist, the player will start from the beginning of the playlist.
onLastSecond	 This is a convenience handler for performing actions in the last second of playback. The same thing can be accomplished with a so-called "negative cuepoint", but because this is such a common scenario we have added an easy-to-use event handler.	
onMetaData	 This fires after onBegin, once the video file's metadata has been received. The clip object is provided as an argument to the handler, with the metadata included as a property of the object.	
onPause 
onBeforePause	This fires when playback is paused.	The pause action is cancelled.
onResume 
onResized	This fires when the clip has been resized. Clip is resized for example when the screen size changes.	
onResume 
onBeforeResume	This fires when playback is resumed after having been paused.	The player will remain paused.
onSeek 
onBeforeSeek	 This fires when the playhead is seeked forward or backward. This happens when the user clicks on the controlbar's timeline (i.e., uses the "scrubber"). The second argument to this event is the target time where the seek ended at. In the case of onBeforeSeek, the argument is the time where the user is intending to seek to and can be slightly different from the value where the seek actually ends up (because of keyframe positions).	 The seek action is cancelled. This is useful for critical video content, the playback of which needs to be forced.
onStart	 This fires at the point at which playback commences.	
onStop 
onBeforeStop	This fires when playback is stopped.	The stop action is cancelled.
onUpdate	 This fires when clip properties are updated using the clip object's update() method. The argument which is passed to the handler is the newly modified clip object.	
Advanced clip events
These events are rarely needed by developers and are mostly used internally by the controlbar plugin. However, they may be of interest if your particular application needs to know the status of the buffer.

Event	When does it fire?
onBufferEmpty	 This fires when playback has consumed all the buffered video data and the playhead cannot proceed, resulting in a temporary stop in playback. This is more likely to occur with lower connection speeds and may happen multiple times during a clip's lifecycle.
onBufferFull	 This fires when the video buffer has reached capacity (i.e. all currently required video data has been downloaded into the player's memory). The buffer size is determined by a clip's bufferLength property, which, by default, has a value of 3 seconds. This event may fire multiple times during a clip's lifecycle, depending on the size of the buffer and the user's connection speed.
onBufferStop	 This fires when the stopBuffering API call is invoked.
onNetStreamEvent	 Fired when an event is triggered on the NetStream object. The second argument in this event is the type of NetStream event type triggered and it is one of following: 'onXMPData', 'onCaption', 'onCaptionInfo', 'onPlayStatus', 'onImageData', 'RtmpSampleAccess', 'onTextData'. You can register a listener for this event if you are interested in any of the event types listed previously. The third argument of this event is an info object related to the event type in question.
For Users
introduction
installation
configuration
skinning & branding
events
scripters' guide
javascript API
For Developers
Writing JavaScript plugins
Flash development setup
Writing Flash plugins
Writing Streaming plugins
Build plugins inside player
The Flash API

Tutorials
Technical Facts
Version History


-->

</body>
</html>
