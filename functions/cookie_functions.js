function collectCookieData() {
	cookieArr = [];
	cookieArr.push( $("#timeZone").val() );
	cookieArr.push( $("#currencyCode").val() );
	cookieArr.push( $("#languages").val() );
	cookieArr.push( $("#langCode").val() );
	cookieArr.push( $("#siteCountryCode").val() );
	cookieArr.push( $("#usersGeoLocation").val() );
	//alert('setCookieData:'+ cookieArr.join(' ')); // Sweden/Stockholm SEK sv-SE,se,sma,fi-SE sv SE 6295630,6255148,2661886,2673722,2696046,
	//$("#cookieData").val(cookieArr);
	var jsonArr = JSON.stringify(cookieArr);
	return jsonArr;
}

// setCookie('location', collectCookieData(), 30);
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
} // null#Säljes, Barnkläder & skor (167) <br> Stockholms stad (2673723)<br>[Säljare typ]: Alla annonser<br>[Sortering]: Senaste

function returnCookieData(jsonArr) {
	//alert('DOES ');
	//if($("#cookieData").val() == '') { return null; }
	//cookieArr = $("#cookieData").val();
	//alert('return CookieData:'+ cookieArr.join(' '));
	al('COOKIE: now populating hidden fields');
	var cookieArr = JSON.parse(jsonArr);
	var i = 0;
	$("#timeZone").val(cookieArr[i]); i++;
	$("#currencyCode").val(cookieArr[i]); i++;
	$("#languages").val(cookieArr[i]); i++;
	$("#langCode").val(cookieArr[i]); i++;
	$("#siteCountryCode").val(cookieArr[i]); i++;
	$("#usersGeoLocation").val(cookieArr[i]);
}

// returnCookieData(returnCookie('location'));
function returnCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  //alert('cookie '+name+' fetched:'+document.cookie); // cookie fetched:location=["Sweden/Stockholm","SEK","sv-SE,se,sma,fi-SE","sv","SE","6295630,6255148,2661886,2673722,2673723,6620873,"]; PHPSESSID=h7rdc5t17u3t45o9ff64jn77rn
  return null;
}
/*
function returnCookie(cname) {
	alert('returnCookie cname: '+cname);
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
	alert('returnCookie decodedCookie: '+decodedCookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
    	alert('THE COOKIE IS: '+ c.substring(name.length, c.length));
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
*/