/*
  --- menu items --- 
  note that this structure has changed its format since previous version.
  additional third parameter is added for item scope settings.
  Now this structure is compatible with Tigra Menu GOLD.
  Format description can be found in product documentation.
*/
var MENU_ITEMS = [
	['Home','/',{'sb' : 'JaggedEdgeLV.com Home Page'}],

	['Menu','',{'sb' : 'Salon Information'},
		['Services','services.php',{'sb' : 'Salon Services', 'tw' : 'bodyframe'}],
		['Staff','staff.php',{'sb' : 'Salon Staff', 'tw' : 'bodyframe'}],
		['Products','products.php',{'sb' : 'Products Used & For Sale', 'tw' : 'bodyframe'}],
		['Specials','specials.php',{'sb' : 'Monthly Specials', 'tw' : 'bodyframe'}],
		['News & Tips','newstips.php',{'sb' : 'News & Beauty Tips', 'tw' : 'bodyframe'}],
		['E-Mail/Contact','contact.php',{'sb' : 'Contact Us via E-Mail', 'tw' : 'bodyframe'}],
	],
	['Map/Directions','http://www.mapquest.com/maps/map.adp?country=US&countryid=250&addtohistory=&address=1923+Rock+Springs+Drive&city=Las+Vegas&state=NV&zipcode=89128&submit=Get+Map',{'sb' : 'Salon Services', 'tw' : '_blank'}],
];

