// --------------------------- gets single ads comments in index page  ---------------------------
function getComments(parentCommentElem='',getWhat='')
{
	// rwite comment: getComments(parentCommentElem, 'form');
	if($("#phpPageName").val() != 'index') return; // end execution if not index page

// NOT WORKING in showdate !!!
	var dateData = $("#dateData").html() + ',' + tr['weekdays'];
	// var dateData = '1903041227' + ',' + tr['weekdays']; // TESTING
	alert('xxxxxxxxxxx getComments - dateData:'+dateData);

	// listingLoader('show'); // show loading image

	// construct DB query attributes, leave default values out
	/*
	var searchData = '?tableStyle=' + 	 $("#tableStyle").val();
	var currentPage = $("#currentPage").val();
	searchData += currentPage != 1 ? '&page=' + currentPage : ''; // default=1

	// -------------------------------------------------------------------------------------------------
	searchData += $("#searchText").val() ? 		 		'&searchText=' + 	 $("#searchText").val()  	: '';
	searchData += $("#adType").val() != '0' ? 			'&adType=' + 		 $("#adType").val() 	    : ''; // default=0
	searchData += $("#advertiserType").val() != 'all' ? '&advertiserType=' + $("#advertiserType").val() : ''; // default=all
	searchData += $("#sortBy").val() == 'price' ? 		'&sortBy=price' 								: ''; // default=time
	
	searchData += 								 		'&countryGeoId=' + 	 $("#country").val();
	searchData += 								 		'&area=' + 	 	 	 $("#area").val();
	searchData += 								 		'&area0=' + 	 	 $("#area0").val();
	searchData += (area1 != -1 && area1 != null) ?  	'&area1=' + area1								: '';
	searchData += (area2 != -1 && area2 != null) ?  	'&area2=' + area2								: '';
	searchData += (area3 != -1 && area3 != null) ?  	'&area3=' + area3								: '';

	 url: "AJAX_getComments.php" + searchData,
*/
// AJAX_getComments.php?adId=1
	var adId = $("#singleAdPage").attr("adId");

	var dataType = "json"; // change to json text
	var urlData = commentForm = '';
	var listing = '';
	var parentCommentId = $(parentCommentElem).parent().parent().attr("id");
	alert('xxxxxxxxxxx WRITE COMMENT - parentCommentId:'+parentCommentId);
	if(getWhat != '') { urlData = '?commentForm=1'; commentForm = '1'; dataType = "text"; } // json
    $.ajax({
      url: "../AJAX_getComments.php",
      type: "GET",
      data: { adId: adId, commentForm: commentForm, parentCommentId: parentCommentId },
      dataType: dataType,
      success: function (jsonResult) { 
      	if(getWhat == 'form') { 
      		// show write comment form
      		if(parentCommentId != null) {
      			// place form beneath the parent comment
      			// alert('placing after id: #'+parentCommentId + ' data:'+jsonResult);
      			//$("#comment"+parentCommentId).after('<div style="color:red">TEST</div>'); // #comment"+parentCommentId
      			// $("#ajaxComments ul li:last").after('<li><span class="tab">Message Center</span></li>');
      			//$("#commentsPanelContent ul #comment"+parentCommentId).css("background-color","red");
      			// $('#commentsPanelContent #comment'+parentCommentId).css("background-color","red");
      			// $('li').attr('#comment'+parentCommentId).css("background-color","red");
      			// $('li').css("background-color","red");
      			//parentCommentElem.parent().parent().css("background-color","#ededed";padding-bottom:15px;);
      			parentCommentElem.parent().parent().addClass("parentElem");
      			parentCommentElem.parent().parent().after('' + jsonResult + '');
      			alert('222 here');
      		} else {
      			// return write comment form
      			$("#writeCommentPanel").html(jsonResult); // place in bottom of page
      			alert('3333 here');
      		}
      		return; 
      	} 
      	//else if(getWhat == 'showSaved') {
      	//	// savedCommentData
      	//	alert('cccccccccc showSaved:'+savedCommentData);
      	//}
 		//var result = jsonResult['data'];
 		var result = jsonResult;
 		console.log(result);
 		// the search returned nothing
		//if(result.status !== 200) {
		//	$("#allComments").html();
		//	buttonBlinking('stop'); // stop search button blinking
		//	listingLoader('hide');  // hide loader animation
		//	return;
		//}

		var dispImg = name = tabStyle = '';
      	if ( result.length == 0 ) { $("#ajaxComments").html('No ads were found with these search settings.<br>' + jsonResult['sql']); return; }
		
      	if(commentForm == '') {
		$.each(result, function (index,item) {
			// alert('comment id,text: '+item.id+' '+item.commentText);
			// listing += '<li id="com_'+item.id+'">'+item.commentText+' '+item.dateSaved+' '+item.userId+' '+item.commentText + '</li>';

			//listing += '<li id="com_'+item.id+'">';
			//listing += item.commentText+' '+item.dateSaved+' '+item.userId+' '+item.commentText + '</li>';

			// +displayDate(item.dateSaved,dateData)
		//	name = item.commenterName == '' ? item.name : item.commenterName;
		item.img = 'https://www.thehealthyhomeeconomist.com/wp-content/uploads/2018/02/Sarah-with-a-cup-of-tea-100x100.jpg'; // TEMP!!!
		if(item.hideProfileImg == '1') { dispImg = '<span class="commentIcon flipX"></span>'; } else { dispImg = '<a href="#"><img alt="" src="'+item.img+'" height="100" width="100"></a>'; }
		if(item.parentCommentId != 0) { tabStyle = ' style="margin-left:40px"'; }  else { tabStyle = ''; }	

		// TODO add displayStars(item.stars)
		// item.stars


			listing += '<li id="com_'+item.id+'"'+tabStyle+'>\
                		    <div class="comment-meta">\
                		       <span class="comment-stars averageGrade" style="padding: 2px 0 !important">'+displayStars(item.stars)+'</span>\
                		       <span class="comment-date">'+displayDate(item.dateSaved,dateData)+'</span>\
                		       <!--<span class="comment-time">9:11 am</span>-->\
                		        <a rel="nofollow" class="comment-reply-link">Reply</a>\
                		    </div>\
                		    <div class="comment-author"> \
                		    	'+dispImg+'\
                		    	<!-- <span class="commentIcon flipX"></span> -->\
                		    	<!-- <a href="#"><img alt="" src="$img" height="100" width="100"></a> -->\
                		    </div>\
                		    <div class="comment-content">\
                		    <h4>'+item.commenterName+'</h4>\
                		    <p>'+item.commentText+'</p>\
                		</li>';
			
	

		/*	listing += '<div id="'+item.id+'" class="item' + isSelectedItem + '">\
						<div class="imgPanel">'+item.img+'</div>\
						<div class="textPanel">'+isCompany+'\
							<span class="text">\
								<a class="cat autoUpdate" id="'+item.cat2+'">auto update</a>(category2), \
								<a class="location">b. '+getNameOfPlace(item.placeName, lang)+'(area1 or 2)</a></span>\
							<span class="time">c. '+item.startDate+'(startDate)</span>\
							<br><span class="title">d. '+item.adTitle+'(adTitle)</span>\
							<div class="price">e. '+item.price+' '+currency+' '+isFavorite+'</div>\
						</div>\
					  </div>'; */
		}); // each
		
	} // else { listing = result; } // commentForm

		/*
	listing += '<li>\
                    <div class="comment-meta">\
                       <span class="comment-date">May 18th, 2018</span>\
                       <span class="comment-time">9:11 am</span>    \
                        <a rel="nofollow" class="comment-reply-link">Reply</a>  \                                  
                    </div>\
                    <div class="comment-author"> \
                    	<span class="commentIcon flipX"></span>\
                    	<a href="#"><img alt="" src="$img" height="100" width="100"></a>\
                    </div>\
                    <div class="comment-content">\
                    <h4>Sarah</h4>\
                    <p>Cod liver oil offers a lot more than Vitamin D drops, which are an isolated vitamin with no  synergistic components...</p>\
                </li>';
*/

		
		$("#ajaxComments").html('<div class="card-box comments" style="text-align:left">' + listing + '</div>'); // show comments listing
	 	// $("#paginationPanel").html(getPagination(jsonResult['page'],jsonResult['totalPages'])); // show pagination (if exists)
	 	// $("#numOfItems").html(jsonResult['totalItems']); // show number of total found items in page title
	    },	
	    error: function (xhr, status, errorThrown) { 
	      alert('ERROR 1: Could not fetch comments: ' + errorThrown); 
	      alert('ERROR 2: Could not fetch comments: ' + xhr.responseText); 
	      alert('ERROR 3: Could not fetch comments: ' + status);
	    }, complete: function () {
	      // listingLoader('hide');  // hide loader animation
      	  pageLoader('hide');
	    } 
	  
    }); // END ajax
}; // END getComments 

function saveComment() //getWhat='')
{
	if($("#phpPageName").val() != 'index') return; // end execution if not index page
	var parentCommentId = $( "#parentCommentId").val();
	var adId = $("#currentSingleAd").val(); // $("#ajaxTable .selectedItem").attr("id");
	var adIdNEW = $("#ajaxTable .item .selected").attr("id");

	// alert('getting adIdNEW from List:' + adIdNEW);
	var userId = null; // if logged in - get user safe id ------------ TODO
	// sellerUserId is done in PHP
	var commentText =    $("#writeCommentForm #comment").val();
	//var commentCatId =   $("#writeCommentForm #commentCatId").val();
	var stars =   $("#writeCommentForm #starsId").val(); // starsId
	var commenterName =  $("#writeCommentForm #commenterName").val();
	var hideProfileImg = $("#writeCommentForm #hideProfileImg").val();

	// validate
	var err = lengthErr = '';
	//alert('ADID is this correct?:'+$("#currentSingleAd").val());
	if(adId == null) { err=1; } // getting adId from HIDDEN FIELD
	if(commentText == '') { err=1; }
	//if(commentCatId == '-1') { err=1; }
	if(stars == '-1') { err=1; }
/* comment these to test PHP validation */
	if(parseInt(commenterName.length) > 25) { lengthErr=1; } 
	if(parseInt(commentText.length) > 255)  { lengthErr=1; } 


	if(err != '') {
		// show errors
		alert('Please fill all fields'); 
		return;
	} else if(lengthErr != '') {
		alert('Your comment text or name is too long'); 
	} else {
		// save
		// dataType: 'json',
		$.ajax({
	      url: "AJAX_saveComment.php",
	      type: "GET",
	      data: {	parentCommentId: parentCommentId,
	      			adId: adId,
	      			userId: userId,
	      			commentText: commentText,
	      			stars: stars,
	      			commenterName: commenterName,
	      			hideProfileImg: hideProfileImg
	      },
	      dataType: 'text',
	      success: function (jsonResult) {
			closeCommentForm();		
			getComments('', ''); // reload comments list
			// update number of total comments
			var totalNumComments = parseInt($("#totalNumComments").html());
 			totalNumComments++;
 			$("#totalNumComments").html(totalNumComments);
		  },	
		  error: function (xhr, status, errorThrown) { 
		    // alert('ERROR 1: Could not save comment: ' + errorThrown); 
		    // alert('ERROR 2: Could not save comment: ' + xhr.responseText); 
		    alert('ERROR 3: Could not save comment: ' + status);
		  }, complete: function () {
	        // pageLoader('hide');
		  } 	  
	    }); // END ajax
    }
}	

// moved from main.js 755
function closeCommentForm() {
	$("#writeCommentForm").remove();
	$("#ajaxComments .parentElem").removeClass("parentElem"); 
}
function clearCommentForm() {
	$("#writeCommentForm #comment").val('');
	$("#writeCommentForm #commentCatId").val('-1');
	$("#writeCommentForm #commenterName").val('');
	$("#writeCommentForm #hideProfileImg").val('');
}
function writeComment(parentCommentElem='') {
	// scroll to bottom of screen
	$('html, body').animate({ scrollTop: $("#writeCommentPanelEnd").offset().top }, 1000);
    getComments(parentCommentElem, 'form'); // show comment form
	$("#writeCommentForm").css("background-color","#eee");
}
function commentFormActive() {
	return $("#commentFormActive").val() == null ? 0 : 1; // returns true / false if comment form is open
}


// takes current page and total pages -numbers and generates pagination HTML code
/*
function getPagination(currPage,totPages) {
	if(totPages == '0') { alert('totPages = 0'); }
	var start,end,links = 6; //  links is the number of visible page links when there are more than 6 pages
	if(totPages < 2) return;
	var data = '<ul class="pagination justify-content-end">';  
	// define start and end pages
	if(totPages > links) {
		if(currPage < links) {
			start = 1; 
			end = totPages;
		} else {			
			start = currPage-links/2;
			end = currPage+links/2;			
		}
	} else { start = 1; end = links; }

	if(start > 1) { data += addPage(1) + addPage('','','dots'); } // add first page link and dots

	// iterate pages and display number links	
	for(page=start; page <= end; page++)
	{
		isActive = currPage == page ? ' selected' : '';
		data += addPage(page,isActive);      	
    } 
    if(page < totPages) { data += addPage('','','dots') + addPage(totPages); } // add dots and last page link
  
	return data + '<ul>';
}

// returns pagination item with styling
function addPage(page,isActive='',dots='') {		
	if(dots!='') {
		return '<li><span>...</span></li>';
	} else {
		//  '<li class="page-item"><span class="page-link' . $activePage . '" page="' . $displayPageId . '">' . $displayPageId . '</span></li>';
		return '<li class="page-item"><span class="page-link'+isActive+'" id="'+page+'">'+page+'</span></li>'; 
	}
}
*/
/*
	linksVisibleTotal = 6;
	bigResultTreshold = 100; // display first or last button when number of pages exceeds this number

   
   	firstPageNum = 1; 
   	prevPageNum = nextPageNum = null;
   	lastPageNum = totalPages;
   	prevPageDisabled = nextPageDisabled = '';	

    if(page > 1) { prevPageNum = page-1; } else { prevPageDisabled = ' hidden'; } 
    if(page < totalPages) { nextPageNum = page+1; } else { nextPageDisabled = ' hidden'; }
    data = '';

	//page numbers
	var displayPageId = 1;
	var endDisplayPageId = linksVisibleTotal + 1;
	var visibleLinksCounter = 0;
	//page = (int)page;
	var totalPages = Math.ceil(totalPages);
	var linksVisibleTotal = linksVisibleTotal;
	var nextPageLink = '';

	// iterate display page number links
	for(displayPageId; displayPageId < endDisplayPageId; displayPageId++)
	{
		activePage = displayPageId == page ? activePage = ' selected' : '';
		data += '<li class="page-item"><span class="page-link' + activePage + '" page="' + displayPageId + '">' + displayPageId + '</span></li>';

		nextPageLink = '  <li class="page-item' + nextPageDisabled + '"><span id="nextPage" class="page-link" page="' + nextPageNum + '">' + 'nextPage' + '</span></li>';  // NEXT 
      	if(totalPages > bigResultTreshold) 
      	{ 
      	  data += nextPageLink;
      	  // last -button for big results
      	  data += ' <li class="page-item' + nextPageDisabled + '"><span id="lastPage" class="page-link" page="' + lastPageNum + '">' + 'lastPage' + '</span></li>'; // LAST
      	} else {
      	  // display last page as number link
      	  data += '<li class="page-item"><span class="page-link" id="dummy">...</span></li>'; // dots
      	  data += '<li class="page-item"><span class="page-link" page="' + totalPages + '">' + totalPages + '</span></li>';
      	  data += nextPageLink;
      	} 
    } // iterate
	return data + '</ul>';
}
	*/

/*

removed:  // display 3 numbers before and 3 after the current page number



// add first and pref links before pagination - note reverse order
    data = '  <li class="page-item' + prevPageDisabled + '"><span  id="previousPage" class="page-link" tabindex="-1" page="' + prevPageNum + '">' + 'prevPage' + '</span></li>' + data; // PREV
    if(totalPages > bigResultTreshold) { 
    // first -button for big results
    data = ' <li class="page-item' + prevPageDisabled + '"><span id="firstPage" class="page-link" page="' + firstPageNum + '">' + 'firstPage' + '</span></li>' + data; 
    } // FIRST 
    data = '<ul class="pagination listingFooter pagination">' + data;

data += '</ul>';
return data;


*/