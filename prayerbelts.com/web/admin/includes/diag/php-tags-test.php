<b>PHP Tags Test</b>

<p>This file runs several tests to see if the normal methods of using "PHP tags" are working correctly on your server.

<p>You should see a "<font color='green'><b>YES</b></font>" next to each test. If a "<font color='green'><b>YES</b></font>" is missing after any test, then there is a problem and you should give the location of this test script to your web hosting provider to fix. (It should take them only a few seconds -- they just need to "turn on" the "short_open_tag" setting.)

<p>1. Testing if &quot;<b>&lt;?php</b>&quot; php tags are working: 

<?php
$yes = "<font color='green'><b>YES</b></font>";
echo $yes;
?>

<p>2. Testing if &quot;<b>&lt;?</b>&quot; php tags are working: 

<?
echo $yes;
?>

<p>3. Testing if &quot;<b>&lt;?=$var?&gt;</b>&quot; php tags are working: 

<?=$yes?>

<p>End of testing.