/* scripts */
$(function() {
	// init arrays
	let names = [];
	let descs = [];
	let prices = [];	

	// delete item
    $(".iconButtonS").click(function (e) {
		// alert($(this).parent().parent().attr("id"));
		$($(this).parent().parent()).empty();
	});
	
	// update button clicked
	$("#updateBtn").click(function (e) {		
		e.preventDefault(); // alert('Update clicked: ');
		// get common resources
		var priceBeginning  = $("#priceBeginning").val();
		
		// copy price to all
		if(priceBeginning != '') { 
			for(var r=1; r<50; r++) {
				// if row exists 
				if ( $( "#row_"+r ).length ) { 
	 				$("#price_"+r).val(priceBeginning);
				}
			}
		}

	});

	$("#previewBtn").click(function (e) {
		// alert('previewBtn clicked: ');
		e.preventDefault();

		// get common resources
		var nameBeginning = $("#nameBeginning").val(); 
		var descBeginning = $("#descBeginning").val();
		var priceBeginning  = $("#priceBeginning").val();
		var nameEnding = $("#nameEnding").val();
		var descEnding = $("#descEnding").val();		
		// alert('resources: ' + nameBeginning + ' ' + descBeginning + ' ' + priceBeginning);

		// collect data in array
		for(var r=1; r<50; r++) {
			// if row exists 
			if ( $( "#row_"+r ).length ) { 
 				if(names[a] != "undefined") {
 					names.push( nameBeginning + $("#name_"+r).val() + nameEnding ); 
 					descs.push( descBeginning + $("#desc_"+r).val() + descEnding ); 
 					if(priceBeginning != '') { prices.push( $("#price_"+r).val() ); } else { prices.push(priceBeginning); }
 				}
			}
		}

		// display array elements
		var previewData = '';
		//alert('array length: ' + names.length);
		for(var a=0;a<names.length;a++) {	
			previewData += '<div class="row">';
			previewData += '<div class="col m2">' + names[a] + '</div>';
			previewData += '<div class="col m6">' + descs[a] + '</div>';
			previewData += '<div class="col m1">' + prices[a] + ' €</div>';
			previewData += '<div class="col m2">Images</div>';
			previewData += '<div class="col m1">&nbsp;</div>';
			previewData += '</div>';
		}
		$("#previewData").html(previewData);
	});
});





