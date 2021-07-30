function showbuttons() {   

    var agt       = navigator.userAgent.toLowerCase();
    var IEMAC     = ((agt.indexOf("msie") != -1) && agt.indexOf("mac")!=-1);
    var N6        = (agt.indexOf("netscape6") != -1 || (agt.indexOf("netscape/6") !=-1 ));

    if ( IEMAC || N6 ) {
      return "<P>";
    }

    return "<P><FORM><INPUT TYPE='button' value='Calculate' Name='btnCallCalc' onClick='document.calculator.calculate()'><INPUT TYPE='button' value='View Report' Name='btnOpenNote' onClick='openNote()'></FORM>";
}

function openNote() {  
     var agt=navigator.userAgent.toLowerCase(); 
     var is_aol   = (agt.indexOf("aol") != -1);
    
     leftpos=0;
     if (screen) {
       leftpos=screen.width/2 - 300;
     } 
    
     if (is_aol) {
       var s = " ";
       s=document.calculator.sJavaScriptReport('HTML');
        document.write(s);
     }
     else {
       var OpenWindow=window.open("","newwin","toolbar=yes,menubar=yes,location=no,directories=no,status=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=380,left="+leftpos+",top=20");
       var s = " ";
       s=document.calculator.sJavaScriptReport('HTML');
       OpenWindow.document.write(s);
       OpenWindow.document.close(); 
       OpenWindow.focus();
     }
 }
 
 function ShowCalc(nCalc) {
    var szURL;
    switch(nCalc) {
        case 1:
            szURL="/scripts/Biweekly.html";
            break;
        case 2:
            szURL="/scripts/MortgageAdjustable.html";
            break;
        case 3:
            szURL="/scripts/MortgageApr.html";
            break;
        case 4:
            szURL="/scripts/MortgageArmvsFixed.html";
            break;
        case 5:
            szURL="/scripts/MortgageBalloon.html";
            break;
        case 6:
            szURL="/scripts/MortgageLoan.html";
            break;
        case 7:
            szURL="/scripts/MortgageCompare.html";
            break;
        case 8:
            szURL="/scripts/MortgageIncome.html";
            break;
        case 9:
            szURL="/scripts/MortgageMax.html";
            break;
        case 10:
            szURL="/scripts/MortgagePayoff.html";
            break;
        case 11:
            szURL="/scripts/MortgagePoints.html";
            break;
        case 12:
            szURL="/scripts/MortgageQualifier.html";
            break;
        case 13:
            szURL="/scripts/MortgageRefinance.html";
            break;
        case 14:
            szURL="/scripts/MortgageRentvsBuy.html";
            break;
        case 15:
            szURL="/scripts/MortgageTaxes.html";
            break;
        case 16:
            szURL="/scripts/ShouldIRefi.html";
            break;
        case 17:
            szURL="/scripts/MortgageInterestOnly.html";
            break;
        case 18:
			szURL="/Java/MortgageFixedvsNegAm.html";
    }
    
    var intTop = (screen.availHeight - 480) / 2;
    var intLeft = (screen.availWidth - 640) / 2;
    window.open(szURL, "Calc", "toolbar=no,  top=" + intTop + ", left=" + intLeft + ", location=no, directories=no, menubar=no, status=no, scrollbars=yes, resizable=1, width=730, height=400");				  
 }