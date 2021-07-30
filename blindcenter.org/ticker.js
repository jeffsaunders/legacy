	<!-- Animated Phrases -->
<!--	<SCRIPT LANGUAGE="JavaScript">-->
	// Set Things Up...
	// Delay in milliseconds for the typewriting headliner
	typeWriterWait=120
	// Delay in milliseconds for displaying the text for the blinking headliner
	blinkTextWait=1000
	// Delay in milliseconds for displaying nothing for the blinking headliner
	blinkSpacesWait=300
	// Number of times to blink
	blinkMax=1
	// Delay in milliseconds per character for the expanding headliner
	expandWait=75
	// Delay in milliseconds per character for the scrolling headliner
	scrollWait=90
	// Number of characters in scrolling zone for the scrolling headliner
	scrollWidth=35
	// Should the lines be chosen randomly (true or false)
	randomLines=true
	// Number of lines, specify as much as you want to use
	lineMax=6

	// Define the lines as follows (text to display, url or mailto, frame name, which effect, time to wait after displaying)
	lines=new Array(lineMax)
	lines[1]=new Line("Anti-Aging Naturally", "", "", Static, 3000)
	lines[2]=new Line("Changing Your Life A Lot By Simply Changing A Little", "", "", Scroll, 1500)
	lines[3]=new Line("Growing Younger & Stronger Every Day", "", "", Expand, 3000)
	lines[4]=new Line("Higher Vibration, Lower Maintenance", "", "", Static, 3000)
	lines[5]=new Line("Helping You Discover The Vibrant You!", "", "", TypeWriter, 3000)
	lines[6]=new Line("Recapture Vitality", "", "", Static, 3000)

	// Some other variables (do not change!)
	lineText=""
	timerID=null
	timerRunning=false
	spaces=""
	charNo=0
	charMax=0
	charMiddle=0
	lineNo=0
	lineWait=0

	// ************************************************************
	// The functions to get things going
	// ************************************************************

	// Define a line object
	function Line(text, url, frame, type, wait) {
		this.text=text
		this.url=url
		this.frame=frame
		this.Display=type
		this.wait=wait
	}

	// Fill a string with n chars c
	function StringFill(c, n) {
		var s=""
		while (--n >= 0) {
			s+=c
		}
		return s
	}

	// Returns a integer number between 1 and max that differs from the old one
	function getNewRandomInteger(oldnumber, max)
	{
		var n=Math.floor(Math.random() * (max - 1) + 1)
		if (n >= oldnumber) {
			n++
		}
		return n
	}

	// Returns an integer number between 1 and max
	function getRandomInteger(max)
	{
		var n=Math.floor(Math.random() * max + 1)
		return n
	}

	// Jump to the specified url in the specified frame
	function GotoUrl(url, frame) {
		if (frame != '') {
			if (frame == 'self') self.location.href=url
			else if (frame == 'parent') parent.location.href=url
			else if (frame == 'top') top.location.href=url
			else {
				s=eval(top.frames[frame])
				if (s != null) top.eval(frame).location.href=url
				else window.open(url, frame, "toolbar=yes,status=yes,scrollbars=yes")
			}
		}
		else window.location.href=url
	}

	function Static() {
		document.formDisplay.buttonFace.value=this.text
		timerID=setTimeout("ShowNextLine()", this.wait)
	}

	function TypeWriter() {
		lineText=this.text
		lineWait=this.wait
		charMax=lineText.length
		spaces=StringFill(" ", charMax)
		TextTypeWriter()
	}

	function TextTypeWriter() {
		if (charNo <= charMax) {
			document.formDisplay.buttonFace.value=lineText.substring(0, charNo)+spaces.substring(0, charMax-charNo)
			charNo++
			timerID=setTimeout("TextTypeWriter()", typeWriterWait)
		}
		else {
			charNo=0
			timerID=setTimeout("ShowNextLine()", lineWait)
		}
	}

	function Blink() {
		lineText=this.text
		charMax=lineText.length
		spaces=StringFill(" ", charMax)
		lineWait=this.wait
		TextBlink()
	}

	function TextBlink() {
		if (charNo <= blinkMax * 2) {
			if ((charNo % 2) == 1) {
				document.formDisplay.buttonFace.value=lineText
				blinkWait=blinkTextWait
			}
			else {
				document.formDisplay.buttonFace.value=spaces
				blinkWait=blinkSpacesWait
			}
			charNo++
			timerID=setTimeout("TextBlink()", blinkWait)
		}
		else {
			charNo=0
			timerID=setTimeout("ShowNextLine()", lineWait)
		}
	}

	function Expand() {
		lineText=this.text
		charMax=lineText.length
		charMiddle=Math.round(charMax / 2)
		lineWait=this.wait
		TextExpand()
	}

	function TextExpand() {
		if (charNo <= charMiddle) {
			document.formDisplay.buttonFace.value=lineText.substring(charMiddle - charNo, charMiddle + charNo)
			charNo++
			timerID=setTimeout("TextExpand()", expandWait)
		}
		else {
			charNo=0
			timerID=setTimeout("ShowNextLine()", lineWait)
		}
	}

	function Scroll() {
		spaces=StringFill(" ", scrollWidth)
		lineText=spaces+this.text
		charMax=lineText.length
		lineText+=spaces
		lineWait=this.wait
		TextScroll()
	}

	function TextScroll() {
		if (charNo <= charMax) {
			document.formDisplay.buttonFace.value=lineText.substring(charNo, scrollWidth+charNo)
			charNo++
			timerID=setTimeout("TextScroll()", scrollWait)
		}
		else {
			charNo=0
			timerID=setTimeout("ShowNextLine()", lineWait)
		}
	}

	function StartHeadliner() {
		StopHeadliner()
		timerID=setTimeout("ShowNextLine()", 2000)
		timerRunning=true
	}

	function StopHeadliner() {
		if (timerRunning) { 
			clearTimeout(timerID)
			timerRunning=false
		}
	}

	function ShowNextLine() {
		if (randomLines) lineNo=getNewRandomInteger(lineNo, lineMax)
		else (lineNo < lineMax) ? lineNo++ : lineNo=1
		lines[lineNo].Display()
	}

	function LineClick(lineNo) {
		document.formDisplay.buttonFace.blur()
		if (lineNo > 0) GotoUrl(lines[lineNo].url, lines[lineNo].frame)
	}

	// Do not change the name of the form or the button!
	with (document) {
		write('<center><form name="formDisplay"><input class="stHeadliner" type="button"')
		write('name="buttonFace" value="www.vibranceinc.biz"')
		write('onClick="LineClick(lineNo)"></input></form></center>')
	}
<!--	</script>-->
