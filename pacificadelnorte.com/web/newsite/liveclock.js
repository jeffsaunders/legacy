<script type="text/javascript">
///////////////////////////////////////////////////////////
// "Live Clock Advanced" script - Version 1.0
// By Mark Plachetta (astroboy@zip.com.au)
//
// Get the latest version at:
// http://www.zip.com.au/~astroboy/liveclock/
//
// Based on the original script: "Upper Corner Live Clock"
// available at:
// - Dynamic Drive (http://www.dynamicdrive.com)
// - Website Abstraction (http://www.wsabstract.com)
// ========================================================
// CHANGES TO ORIGINAL SCRIPT:
// - Gave more flexibility in positioning of clock
// - Added date construct (Advanced version only)
// - User configurable
// ========================================================
// Both "Advanced" and "Lite" versions are available free
// of charge, see the website for more information on the
// two scripts.
///////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////
/////////////// CONFIGURATION /////////////////////////////

	// Set the clock's font face:
	var myfont_face = "Verdana,Arial,Helvetica,sans-serif";

	// Set the clock's font size (in point):
	var myfont_size = "9";

	// Set the clock's font color:
	var myfont_color = "#000000";
	
	// Set the clock's background color:
	var myback_color = "";

	// Set the text to display before the clock:
	var mypre_text = "&nbsp;&nbsp;&nbsp;";

	// Set the text to display after the clock:
	var mypost_text = "&nbsp;&nbsp;&nbsp;&nbsp;";

	// Set the width of the clock (in pixels):
	var mywidth = 250;

	// Display the time in 24 or 12 hour time?
	// 0 = 24, 1 = 12
	var my12_hour = 1;

	// How often do you want the clock updated?
	// 0 = Never, 1 = Every Second, 2 = Every Minute
	// If you pick 0 or 2, the seconds will not be displayed
	var myupdate = 1;

	// Display the date?
	// 0 = No, 1 = Yes
	var DisplayDate = 1;

/////////////// END CONFIGURATION /////////////////////////
///////////////////////////////////////////////////////////

// Browser detect code
        var ie4=document.all
        var ns4=document.layers
        var ns6=document.getElementById&&!document.all

// Global varibale definitions:

	var dn = "";
	var crdn = "";
	var mn = "th";
	var crmn = "th";
	var old = "";

// The following arrays contain data which is used in the clock's
// date function. Feel free to change values for Days and Months
// if needed (if you wanted abbreviated names for example).
	var DaysOfWeek = new Array(7);
		DaysOfWeek[0] = "Sunday";
		DaysOfWeek[1] = "Monday";
		DaysOfWeek[2] = "Tuesday";
		DaysOfWeek[3] = "Wednesday";
		DaysOfWeek[4] = "Thursday";
		DaysOfWeek[5] = "Friday";
		DaysOfWeek[6] = "Saturday";

	var MonthsOfYear = new Array(12);
		MonthsOfYear[0] = "January";
		MonthsOfYear[1] = "February";
		MonthsOfYear[2] = "March";
		MonthsOfYear[3] = "April";
		MonthsOfYear[4] = "May";
		MonthsOfYear[5] = "June";
		MonthsOfYear[6] = "July";
		MonthsOfYear[7] = "August";
		MonthsOfYear[8] = "September";
		MonthsOfYear[9] = "October";
		MonthsOfYear[10] = "November";
		MonthsOfYear[11] = "December";

// This array controls how often the clock is updated,
// based on your selection in the configuration.
	var ClockUpdate = new Array(3);
		ClockUpdate[0] = 0;
		ClockUpdate[1] = 1000;
		ClockUpdate[2] = 60000;

// For Version 4+ browsers, write the appropriate HTML to the
// page for the clock, otherwise, attempt to write a static
// date to the page.
	if (ie4||ns6) { document.write('<span id="LiveClockIE" style="width:'+mywidth+'px; background-color:'+myback_color+'"></span>'); }
	else if (document.layers) { document.write('<ilayer bgColor="'+myback_color+'" id="ClockPosNS" visibility="hide"><layer width="'+mywidth+'" id="LiveClockNS"></layer></ilayer>'); }
	else { old = "true"; show_clock(); }

// The main part of the script:
	function show_clock() {
		if (old == "die") { return; }
	
	//show clock in NS 4
		if (ns4)
                document.ClockPosNS.visibility="show"
	// Get all our date variables:
	// local
		var Digital = new Date();
		var day = Digital.getDay();
		var mday = Digital.getDate();
		var month = Digital.getMonth();
		var year = Digital.getFullYear();
		var hours = Digital.getHours();
		var minutes = Digital.getMinutes();
		var seconds = Digital.getSeconds();

	// Costa Rica
		var CostaRica = new Date();
		CostaRica.setHours(CostaRica.getHours()-6) // Temporarily fool system into thinking it's on CR time.
		var crday = CostaRica.getUTCDay();
		var crmday = CostaRica.getUTCDate();
		var crmonth = CostaRica.getUTCMonth();
		var cryear = CostaRica.getUTCFullYear();
		var crhours = CostaRica.getUTCHours();
		var crminutes = CostaRica.getUTCMinutes();
		var crseconds = CostaRica.getUTCSeconds();

	// Fix the "mn" variable if needed:
		if (mday == 1) { mn = "st"; }
		else if (mday == 2) { mn = "nd"; }
		else if (mday == 3) { mn = "rd"; }
		else if (mday == 21) { mn = "st"; }
		else if (mday == 22) { mn = "nd"; }
		else if (mday == 23) { mn = "rd"; }
		else if (mday == 31) { mn = "st"; }
		if (crmday == 1) { crmn = "st"; }
		else if (crmday == 2) { crmn = "nd"; }
		else if (crmday == 3) { crmn = "rd"; }
		else if (crmday == 21) { crmn = "st"; }
		else if (crmday == 22) { crmn = "nd"; }
		else if (crmday == 23) { crmn = "rd"; }
		else if (crmday == 31) { crmn = "st"; }

	// Set up the hours for either 24 or 12 hour display:
		if (my12_hour) {
			dn = "AM";
			crdn = "AM";
			if (hours > 12) { dn = "PM"; hours = hours - 12; }
			if (hours == 0) { hours = 12; }
			if (crhours > 12) { crdn = "PM"; crhours = crhours - 12; }
			if (crhours == 0) { crhours = 12; }
		} else {
			dn = "";
			crdn = "";
		}
		if (minutes <= 9) { minutes = "0"+minutes; }
		if (crminutes <= 9) { crminutes = "0"+crminutes; }
		if (seconds <= 9) { seconds = "0"+seconds; }
		if (crseconds <= 9) { crseconds = "0"+crseconds; }

	// This is the actual HTML of the clock. If you're going to play around
	// with this, be careful to keep all your quotations in tact.
		myclock = '';
//		myclock += '<font style="color:'+myfont_color+'; font-family:'+myfont_face+'; font-size:'+myfont_size+'pt;">';
		if (DisplayDate) { myclock += DaysOfWeek[day]+', '+MonthsOfYear[month]+' '+mday+mn+', '+year; }
		myclock += mypre_text;
		myclock += hours+':'+minutes;
		if ((myupdate < 2) || (myupdate == 0)) { myclock += ':'+seconds; }
		myclock += ' '+dn;
		myclock += mypost_text;

		// Now Costa Rica time
		myclock += '<br>';
		if (DisplayDate) { myclock += DaysOfWeek[crday]+', '+MonthsOfYear[crmonth]+' '+crmday+crmn+', '+cryear; }
		myclock += mypre_text;
		myclock += crhours+':'+crminutes;
		if ((myupdate < 2) || (myupdate == 0)) { myclock += ':'+crseconds; }
		myclock += ' '+crdn;
		myclock += mypost_text;
//		myclock += '</font>';

		if (old == "true") {
			document.write(myclock);
			old = "die";
			return;
		}

	// Write the clock to the layer:
		if (ns4) {
			clockpos = document.ClockPosNS;
			liveclock = clockpos.document.LiveClockNS;
			liveclock.document.write(myclock);
			liveclock.document.close();
		} else if (ie4) {
			LiveClockIE.innerHTML = myclock;
		} else if (ns6){
			document.getElementById("LiveClockIE").innerHTML = myclock;
                }            

	if (myupdate != 0) { setTimeout("show_clock()",ClockUpdate[myupdate]); }
}
</script>
