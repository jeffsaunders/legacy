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

// MODIFIED TO WORK SPECIFICALLY FOR THE PACIFIC TIME ZONE - JS

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
	var mypre_text = "&nbsp;&nbsp;";

	// Set the width of the clock (in pixels):
	var mywidth = 300;

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
	var mn = "th";
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
//		DaysOfWeek[0] = "Sun.";
//		DaysOfWeek[1] = "Mon.";
//		DaysOfWeek[2] = "Tue.";
//		DaysOfWeek[3] = "Wed.";
//		DaysOfWeek[4] = "Thu.";
//		DaysOfWeek[5] = "Fri.";
//		DaysOfWeek[6] = "Sat.";

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
//		MonthsOfYear[0] = "Jan.";
//		MonthsOfYear[1] = "Feb.";
//		MonthsOfYear[2] = "Mar.";
//		MonthsOfYear[3] = "Apr.";
//		MonthsOfYear[4] = "May";
//		MonthsOfYear[5] = "Jun.";
//		MonthsOfYear[6] = "Jul.";
//		MonthsOfYear[7] = "Aug.";
//		MonthsOfYear[8] = "Sep.";
//		MonthsOfYear[9] = "Oct.";
//		MonthsOfYear[10] = "Nov.";
//		MonthsOfYear[11] = "Dec.";

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

		// Determine if LV is under Daylight Saving Time
//		var gmt = new Date; // now
//		var fsa = new Date; // first Sunday in April
//		var lso = new Date; // last Sunday in October
//		var dst = 1; // is Daylight Saving Time unless found to not be
//		fsa.setMonth(3); // April
//		fsa.setDate(1); // 1st
//		var day = fsa.getDay();// day of week of 1st
//		fsa.setDate((1-day)+7); // first Sunday
//		lso.setMonth(9); // October
//		lso.setDate(31); // 31st
//		day = lso.getDay(); // day of week of 31st
//		lso.setDate(31-day); // last Sunday
//		if (gmt < fsa || gmt >= lso) dst = 0; //NOT Daylight Saving Time 

		// New DST as of 2006
		var gmt = new Date; // now
		var ssm = new Date; // second Sunday in March
		var fsn = new Date; // first Sunday in November
		var dst = 0; // is Daylight Saving Time, so offset by 0 hours, unless found to not be
		ssm.setMonth(2); // March
		ssm.setDate(1); // 1st
		var day = ssm.getDay();// day of week of 1st
		ssm.setDate((1-day)+14); // second Sunday
		fsn.setMonth(10); // November
		fsn.setDate(1); // 1st
		day = fsn.getDay(); // day of week of 1st
		fsn.setDate((1-day)+7); // first Sunday
		if (gmt < ssm || gmt >= fsn) dst = 1; //NOT Daylight Saving Time, offset by 1 hour
//alert(dst);
		var Digital = new Date();
		Digital.setHours(Digital.getHours()-(7+dst)) // Temporarily fool system into thinking it's on LV time. Need to make this smarter so it handles DST better...-7 vs. -8 hours.
//		var day = Digital.getDay();
//		var mday = Digital.getDate();
//		var month = Digital.getMonth();
//		var year = Digital.getFullYear();
//		var hours = Digital.getHours();
//		var minutes = Digital.getMinutes();
//		var seconds = Digital.getSeconds();

		var day = Digital.getUTCDay();
		var mday = Digital.getUTCDate();
		var month = Digital.getUTCMonth();
		var year = Digital.getUTCFullYear();
		var hours = Digital.getUTCHours();
		var minutes = Digital.getUTCMinutes();
		var seconds = Digital.getUTCSeconds();

	// Fix the "mn" variable if needed:
		if (mday == 1) { mn = "st"; }
		else if (mday == 2) { mn = "nd"; }
		else if (mday == 3) { mn = "rd"; }
		else if (mday == 21) { mn = "st"; }
		else if (mday == 22) { mn = "nd"; }
		else if (mday == 23) { mn = "rd"; }
		else if (mday == 31) { mn = "st"; }

	// Set up the hours for either 24 or 12 hour display:
		if (my12_hour) {
			dn = "AM";
			if (hours > 12) { dn = "PM"; hours = hours - 12; }
			if (hours == 0) { hours = 12; }
		} else {
			dn = "";
		}
		if (minutes <= 9) { minutes = "0"+minutes; }
		if (seconds <= 9) { seconds = "0"+seconds; }

	// This is the actual HTML of the clock. If you're going to play around
	// with this, be careful to keep all your quotations in tact.
		myclock = '';
//		myclock = '<div align="left">';
//		myclock += 'Las Vegas Time:&nbsp;&nbsp;';
//		myclock += '<font style="color:'+myfont_color+'; font-family:'+myfont_face+'; font-size:'+myfont_size+'pt;">';
		if (DisplayDate) { myclock += DaysOfWeek[day]+', '+MonthsOfYear[month]+' '+mday+mn+', '+year; }
		myclock += mypre_text;
		myclock += ' '+hours+':'+minutes;
		if ((myupdate < 2) || (myupdate == 0)) { myclock += ':'+seconds; }
		myclock += ' '+dn;
//		myclock += '</font>';
//		myclock += '</div>';

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
//alert(myclock);
			LiveClockIE.innerHTML = myclock;
		} else if (ns6){
			document.getElementById("LiveClockIE").innerHTML = myclock;
                }            

	if (myupdate != 0) { setTimeout("show_clock()",ClockUpdate[myupdate]); }
}

show_clock();
</script>