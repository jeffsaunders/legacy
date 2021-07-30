	<script>
		// Ajax script to lookup available matching properties
		function Lookup(params){
			if (window.XMLHttpRequest){ // Code for IE7+, Firefox, Opera, Webkit (Chrome, Safari, Rockmelt)
				xmlhttp=new XMLHttpRequest();
			}else{ // Code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET","lookup.php?"+params);
			xmlhttp.send();
			xmlhttp.onreadystatechange = function(){
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
					document.getElementById("DynamicResults").innerHTML = xmlhttp.responseText;
				}
			}
		}
	</script>
	<!-- Results Content -->
	<div id="Content" style="position:relative; top:0px; left:0px; width:960px; height:1030px; z-index:1;">
		<img src="images/ResultsBG.png" alt="" width="960" height="1030">
		<!-- Top Section -->
		<div id="Header" style="position:absolute; top:25px; left:20px; z-index:2;">
			<!-- Logo Image -->
			<a href="/" title="Click for wmuhomes.com Home Page"><img src="images/Logo.png" alt="" width="54" height="62" style="border:none;" class="shadowSmall"></a>
			<!-- Text -->
			<div id="HeaderText" style="position:absolute; top:5px; left:70px; width:500px; z-index:2;">
				<span style="font-family:'Myvetica',sans-serif; font-size:36px; color:#FFFFFF;">wmuhomes.com</span><br>
				<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#FFFFFF;">Kalamazoo Michigan Luxury & Student Rental Homes</span><br><br>
			</div>
		</div>
		<!-- Bottom Section -->
		<!-- Results Box -->
		<![if (!IE)|(IE 9)]>
		<div id="ResultsBox" style="position:absolute; top:110px; left:60px; width:840px; height:840px; z-index:2;" class="frostWhite roundedCorners">
		<![endif]>
		<!--[if lt IE 9]>
		<div id="ResultsBox" style="position:absolute; top:110px; left:60px; width:840px; height:840px; background-image:url(images/WhiteFrostDot.png); z-index:2;" class="roundedCorners">
		<![endif]-->
			<!-- Box whose contents is to be replaced by code returned from Ajax call -->
			<div id="DynamicResults" style="position:absolute; top:0px; left:0px; width:840px; z-index:3;"></div>
		</div>
		<script type="text/javascript">
			// Ajax call to lookup page 1 results
				Lookup("Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=<?=$_REQUEST['Order'];?>");
		</script>
	</div>
