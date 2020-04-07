<?php include_once('functions.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>ADMIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Desc here" name="description" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- <link rel="shortcut icon" href="../assets/images/favicon.ico">-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
        <script>
        $(function() {
        	
            //var url = 'https://www.leboncoin.fr/annonces/offres/centre/';
            //var url = 'https://www.prisjakt.nu/kategori.php?k=503';
	        //$("#page").html('<object id="site" data="' + url + '" style="width:100%; height:600px;" />');

            var url = 'https://www.prisjakt.nu/kategori.php?k=1919'; // se
            //var url = "https://hintaopas.fi/category.php?k=503"; // fi


	        $("body").on("click", "#btn", function(e){
                //var data = $("#page ._3Vcbh").html();
                //alert('clicked - returned:' + data);
	        	////// var data = $("object ._3Vcbh").html(); // #page ._3Vcbh 
				////$("#txt").text( $("#site").html() );				//////var res = $("#site ._3Vcbh").html();
				//////     alert('res: '+res);

                // prisjakt
                var startBlock = 'Inredning är en hel konst för den som vill välja rätt möbler, belysning'; // 'list-cat-images'; // 'contentblock'; // se
                // var startBlock = "category-page--categories"; // fi
                var res = $("#txt").text(); // code on page
            
                var start = res.indexOf("category-matrix");
                start = parseInt(start);
                start=start-parseInt(startBlock);
                alert('start: '+start);

                var end = res.indexOf('</ul>', start); 
                end = parseInt(end);
                alert('end: '+end);

                var part = res.substr(start, end-start+5);
                alert('part before: '+part);


            
                part = part.replace(/<(?:.|\n)*?>/gm, '');  // /<.*?>/g to /<[^>]*>?/g
                partArr = part.split('\n') .map(function(v) { return v.trim() }).filter(function(v) { 
                    //if(v.substr(0,9) != 'Visa alla') { 
                        return v != ''; 
                    //}
                    }); // remove empty lines
                part = partArr.filter( onlyUnique );
                part = part.join('\n');

                // alert('start: '+start+' end-start: '+end-start);
                // alert('part: '+part);
                $("#txt").text(part);
			});
			

			$.ajax({
			     //url: "https://www.leboncoin.fr/annonces/offres/centre/",
                 //url: "https://www.prisjakt.nu/kategori.php?k=503",
                 url: url,
			     dataType: 'text',
			     success: function(data) {
			     	//alert('loaded data:' + data);
			     	$("#txt").text(data);
			     	//var res = $("<div>").html(data)[0].html(); // #page ._3Vcbh 
					//alert('res: '+res); // .find("._3Vcbh")
			          var elements = $("<div>").html(data)[0].getElementsByClassName("_3Vcbh");
			          for(var i = 0; i < elements.length; i++) {
			               var theText = elements[i].firstChild.nodeValue;
			               alert('res: '+theText);
			          }
			     }
			});

	    }); // doc ready

        function onlyUnique(value, index, self) { 
            return self.indexOf(value) === index;
        }
        //// usage example:
        //var arr = ['a', 1, 'a', 2, '1'];
        //var uniqueArr = arr.filter( onlyUnique ); // returns ['a', 1, 2, '1']

		</script>
        <style>
        	#btn {
        		width: 100px;
        		padding: 10px 15px;
        		border: solid 1px gray;
        		border-radius: 6px;
        		margin: 10px;
        	}
        	#btn:hover {
        		cursor: pointer;
        	}
        	#txt {
        		width: 100%;
        		height: 600px;
        	}
        </style>   
</head>
<body>

<div id="btn">Get data</div>
<textarea id="txt"></textarea>
<div id="page"></div>







