<script type="text/javascript">

/***********************************************
* Pausing updown message scroller- ? Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

//configure the below five variables to change the style of the scroller
var scrollerdelay='3000' //delay between msg scrolls. 3000=3 seconds.
var scrollerwidth='400px'
var scrollerheight='24px'
var scrollerbgcolor=''
//set below to '' if you don't wish to use a background image
var scrollerbackground=''

//configure the below variable to change the contents of the scroller
var messages=new Array()
messages[0]="<a href='?sec=vista-al-pacifico' class='bigWhite'><font size='+1'><strong>It's Your Time To Live In Paradise...</strong></font></a>"
messages[1]="<a href='?sec=vista-al-pacifico' class='bigWhite'><font size='+1'><strong>Vista al Pacifico Beach Condominiums</strong></font></a>"
messages[2]="<a href='?sec=vista-al-pacifico' class='bigWhite'><font size='+1'><strong>Playa Herradura, Costa Rica</strong></font></a>"
messages[3]="<a href='?sec=vista-al-pacifico' class='bigWhite'><font size='+1'><strong>Now Pre-Selling Phase One</strong></font></a>"
messages[4]="<a href='?sec=vista-al-pacifico' class='bigWhite'><font size='+1'><strong><blink>Click Here For More Information</blink></strong></font></a>"

///////Do not edit past this line///////////////////////

var ie=document.all
var dom=document.getElementById

if (messages.length>2)
i=2
else
i=0

function move1(whichlayer){
tlayer=eval(whichlayer)
if (tlayer.top>0&&tlayer.top<=5){
tlayer.top=0
setTimeout("move1(tlayer)",scrollerdelay)
setTimeout("move2(document.main.document.second)",scrollerdelay)
return
}
if (tlayer.top>=tlayer.document.height*-1){
tlayer.top-=5
setTimeout("move1(tlayer)",50)
}
else{
tlayer.top=parseInt(scrollerheight)
tlayer.document.write(messages[i])
tlayer.document.close()
if (i==messages.length-1)
i=0
else
i++
}
}

function move2(whichlayer){
tlayer2=eval(whichlayer)
if (tlayer2.top>0&&tlayer2.top<=5){
tlayer2.top=0
setTimeout("move2(tlayer2)",scrollerdelay)
setTimeout("move1(document.main.document.first)",scrollerdelay)
return
}
if (tlayer2.top>=tlayer2.document.height*-1){
tlayer2.top-=5
setTimeout("move2(tlayer2)",50)
}
else{
tlayer2.top=parseInt(scrollerheight)
tlayer2.document.write(messages[i])
tlayer2.document.close()
if (i==messages.length-1)
i=0
else
i++
}
}

function move3(whichdiv){
tdiv=eval(whichdiv)
if (parseInt(tdiv.style.top)>0&&parseInt(tdiv.style.top)<=5){
tdiv.style.top=0+"px"
setTimeout("move3(tdiv)",scrollerdelay)
setTimeout("move4(second2_obj)",scrollerdelay)
return
}
if (parseInt(tdiv.style.top)>=tdiv.offsetHeight*-1){
tdiv.style.top=parseInt(tdiv.style.top)-5+"px"
setTimeout("move3(tdiv)",50)
}
else{
tdiv.style.top=parseInt(scrollerheight)
tdiv.innerHTML=messages[i]
if (i==messages.length-1)
i=0
else
i++
}
}

function move4(whichdiv){
tdiv2=eval(whichdiv)
if (parseInt(tdiv2.style.top)>0&&parseInt(tdiv2.style.top)<=5){
tdiv2.style.top=0+"px"
setTimeout("move4(tdiv2)",scrollerdelay)
setTimeout("move3(first2_obj)",scrollerdelay)
return
}
if (parseInt(tdiv2.style.top)>=tdiv2.offsetHeight*-1){
tdiv2.style.top=parseInt(tdiv2.style.top)-5+"px"
setTimeout("move4(second2_obj)",50)
}
else{
tdiv2.style.top=parseInt(scrollerheight)
tdiv2.innerHTML=messages[i]
if (i==messages.length-1)
i=0
else
i++
}
}

function startscroll(){
if (ie||dom){
first2_obj=ie? first2 : document.getElementById("first2")
second2_obj=ie? second2 : document.getElementById("second2")
move3(first2_obj)
second2_obj.style.top=scrollerheight
second2_obj.style.visibility='visible'
}
else if (document.layers){
document.main.visibility='show'
move1(document.main.document.first)
document.main.document.second.top=parseInt(scrollerheight)+5
document.main.document.second.visibility='show'
}
}

//window.onload=startscroll

</script>


<ilayer id="main" width=&{scrollerwidth}; height=&{scrollerheight}; bgColor=&{scrollerbgcolor}; background=&{scrollerbackground}; visibility=hide>
<layer id="first" left=0 top=1 width=&{scrollerwidth};>
<script language="JavaScript1.2">
if (document.layers)
document.write(messages[0])
</script>
</layer>
<layer id="second" left=0 top=0 width=&{scrollerwidth}; visibility=hide>
<script language="JavaScript1.2">
if (document.layers)
document.write(messages[dyndetermine=(messages.length==1)? 0 : 1])
</script>
</layer>
</ilayer>

<script language="JavaScript1.2">
if (ie||dom){
document.writeln('<div id="main2" style="position:relative;width:'+scrollerwidth+';height:'+scrollerheight+';overflow:hidden;background-color:'+scrollerbgcolor+' ;background-image:url('+scrollerbackground+')">')
document.writeln('<div style="position:absolute;width:'+scrollerwidth+';height:'+scrollerheight+';clip:rect(0 '+scrollerwidth+' '+scrollerheight+' 0);left:0px;top:0px">')
document.writeln('<div id="first2" style="position:absolute;width:'+scrollerwidth+';left:0px;top:1px;">')
document.write(messages[0])
document.writeln('</div>')
document.writeln('<div id="second2" style="position:absolute;width:'+scrollerwidth+';left:0px;top:0px;visibility:hidden">')
document.write(messages[dyndetermine=(messages.length==1)? 0 : 1])
document.writeln('</div>')
document.writeln('</div>')
document.writeln('</div>')
}
</script>			
