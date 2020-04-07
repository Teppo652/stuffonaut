<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Learn chinese for free</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="keywords" content="chinese,learn chinese,characters,words,mandarin,free,online,game" />
        <meta name="description" content="Learn chinese words for free" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- <link rel="shortcut icon" href="../assets/images/favicon.ico">
        <link rel="icon" href="http://example.com/favicon.png">-->
        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">

		<!-- beauter styles -->
		<link rel="stylesheet" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"> 
		
		<!-- charset -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<style>
		.container { margin-top: -50px; }
			.centered {
			  	position: relative;
    			left: 50%;
    			margin-left: -200px;
			}
		/*
			#showItem { font-size: 200px; }
			#buttons {
			}
			#buttons .row {
				position: relative;
				max-width: 600px;
			}
			#buttons .col {
				padding: 0 15px;
				margin: 5px 0;
				display: contents;
			}
			#buttons button {
				height: 120px;
				margin: 0;
   				position: absolute;            
   				top: 50%;                      
   				transform: translate(0, -50%);
			}
			#buttons .pinyin {
				clear: left;
				font-size: 15px;
			}
		*/
			#backBtn, #startBtn {
				margin-top: 20px;
			    font-size: 56px;
			    padding: 0 0 0 5px;
			    height: 60px;
			    border: none;
			    border-radius: 50% !important;
			    width: 60px;
			    background-color: #8fb3d1;
			    color: #fff;
			}
			.tooltiptext {
				font-size: 26px;
				margin-top: 13px;
			}
			#showItem {
				font-size: 180px;
			    text-align: center;
			    line-height: 180px;
			    padding-left: 55px !important;
			    margin-top:-20px !important;
			}
		/*
			@media only screen and (max-width: 590px) {
				button {
					font-size: 60% !important;
    				padding: 7px 10px !important;
				}
			}
		*/

			select { 
				min-width: 150px;
   				border: solid 3px #5a85aa;
   				border-radius: 12px;
   				height: 45px;
   				margin-top: -13px;
   				font-size: 24px;
   				padding: 0 3px;
   				font-weight: bold;
   				background-color: #8fb3d1;
   				color: #34526c;
			}
			option { 
   				font-size: 24px;
   				font-weight: bold;
			}
			.row {
				margin-left: auto;
    			margin-right: auto;
			}
			.grid-container {
			  display: grid;
			  grid-gap: 10px;
			  grid-template-columns: auto auto auto;
			  background-color: #8fb3d1;
			  border-color: #5a85aa;
			  color: #34526c;
			  padding: 10px;
			  border-radius: 12px;
			}
			
			.grid-item {
			  background-color: rgba(255, 255, 255, 0.8);
			  padding: 20px;
			  font-size: 30px;
			  text-align: center;
			  border: 3px solid rgb(98, 139, 173);
			  border-radius: 24px;
			}
			.grid-item:hover {
				cursor: pointer;
				background-color: rgb(181, 207, 228);
			}
			footer {
				text-align: center;
				margin-top: 10px;
				font-size: 11px;
			}

@media only screen and (max-width: 900px) {
	#showItem {
    	font-size: 160px;
	
}
@media only screen and (max-width: 730px) {
	#showMe {
		margin-left: 20px;
	}
}
@media only screen and (min-width: 550px) {
	.grid-container {
		/* grid-template-columns: 133px 133px 133px; */
	}
	.grid-container {
		/* max-width: 450px; */
	}
}
@media only screen and (max-width: 550px) {
	.col { padding: 0; }
	.container { padding: 0 2px; }
	#showItem {
		font-size: 110px;
	}
	label[for=showMe] {
		float: left;
	}
	#startBtn {
		/*
		position: fixed;
    	top: -48px;
*/
    	position: absolute;
    	top: -8px;

    	float: right;
    	right: 50px;
	}
	#showItem { 
		margin: -20px 0 -15px -55px !important;
	}
	/* button width 100% */
	.grid-container {
    	display: inline;
    	background-color: unset !important;
    }
    .grid-item {
    	margin-bottom: 6px;
    }
    #buttons {
    	background-color: #8fb3d1;
    	border-radius: 12px;
    }
}
@media only screen and (max-width: 330px) {
	.grid-item {
		padding: 10px;
	}	
	#startBtn {
		right: 10px;
	}	
}
@media only screen and (max-width: 280px) {
	.grid-container {
		grid-gap: 4px;
		padding: 2px;
	}
	.grid-item {
		padding: 5px 10px;
	}
	#showItem {
		font-size: 100px;
		margin: -60px 0 -50px -60px !important;
	}
	select {
		height: unset;
		font-size: unset;
	}	
	#backBtn, #startBtn {
	    font-size: 28px;
	    padding:2px 2px 0 5px;
	    height: 32px;
	    width: 32px;
	}	
	#showItem {
    	font-size: 70px;
    	margin: 0 0 -56px -60px;
	}
	footer {
    	font-size: 9px;
	}
}
@media only screen and (max-width: 230px) {
	.grid-container {
		grid-gap: 0px;
		padding: 0px;
	}
	.grid-item {
		padding: 2px 5px;
		max-height: 40px;
    	font-size: 22px;
	}
}

.container {
    width: 100% !important;
}
		</style>
		<script>
		<!-- https://www.digmandarin.com/hsk-2-vocabulary-list.html -->
		var chars =  '我_我们_你_你们_他_她	_他们_她们_这 _那_哪_谁_什么_多少_几_怎么_怎么_样_您_它_大家_每_为什么';
		var pinyin = 'wǒ_wǒmen_nǐ_nǐmen_tā_tā_tāmen_tāmen_zhè_nà_nǎ_shéi_shénme_duōshǎo_jǐ_zěnme_zěnmeyàng_nín_tā_dàjiā_měi_wèishénme';
		var local =  'I,me_we, us（pl._you_you (pl.)_he, him_she,her_they (male+female / male，pl.)_they (females, pl.)_here,this_there, that_where_who_what,why_how many,how much_a few,how many_how_how about_you_it_everyone_every_why';

		</script>
</head>
<body>

<!-- ==================== header ============================= -->

<div class="container">

	<div class="col m12">
	<?php
	// echo html_entity_decode('bÄ', ENT_COMPAT, 'UTF-8');
	//echo setlocale(LC_CTYPE, 'bÄ');
	?>
	</div>

	<div class="col m3">
		<!--<button id="backBtn" class="_alignLeft" style="margin-top:43px" >&#8630;</button>-->
		<button id="backBtn" class="_alignLeft tooltip -tooltip-right" style="margin-top:43px">&#8630;
		  <span class="tooltiptext">Quit</span>
		</button>
		

    </div>
    <div class="col m6">
	    <div class="col m6" style="text-align:right">
	      <label for="showMe" style="margin-right:12px">
	      	<svg height="30px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M508.7 246c-4.6-6.3-113.6-153.2-252.7-153.2S7.8 239.8 3.2 246c-4.3 5.9-4.3 14 0 19.9 4.6 6.3 113.6 153.2 252.7 153.2s248.2-146.9 252.7-153.2C513.1 260 513.1 252 508.7 246zM256 385.4c-102.5 0-191.3-97.5-217.6-129.4 26.3-31.9 114.9-129.4 217.6-129.4 102.5 0 191.3 97.5 217.6 129.4C447.4 287.9 358.7 385.4 256 385.4z"/><path d="M256 154.7c-55.8 0-101.3 45.4-101.3 101.3s45.4 101.3 101.3 101.3 101.3-45.4 101.3-101.3S311.8 154.7 256 154.7zM256 323.5c-37.2 0-67.5-30.3-67.5-67.5s30.3-67.5 67.5-67.5 67.5 30.3 67.5 67.5S293.2 323.5 256 323.5z"/></svg>


	      </label>
	      <select class="_width100" id="showMe" style="float: right">
	      	
	      	 <option value="0">我 + wǒ</option>
	        <option value="1">我</option>
	        <option value="2">wǒ</option>
	        <option value="3">I (English)</option>
	        <!--
	        <option value="0">character + pinyin</option>
	        <option value="1">character</option>
	        <option value="2">pinyin</option>
	        <option value="3">local</option>-->
	      </select>
	      </div>
	    <div class="col m6">
	      <label for="iSelect" style="margin:-3px 0 7px 18px">
			<svg height="30px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m318.917969 187.566406h-.667969c-9.121094-.050781-17.933594 3.300782-24.71875 9.398438-5.492188-15.199219-19.449219-26.125-35.796875-26.125-10.019531.070312-19.589844 4.183594-26.53125 11.414062-6.382813-12.921875-19.1875-21.6875-33.910156-21.6875h-.710938c-7.890625-.121094-15.589843 2.445313-21.832031 7.273438v-92.121094c0-22.261719-17.332031-40.371094-38.414062-40.371094-21.058594 0-38.300782 18.097656-38.3125 40.34375l-.175782 182.773438-10.34375-12.5625c-9.070312-11.292969-22.421875-18.304688-36.867187-19.363282-14.148438-.96875-28.066407 3.953126-38.457031 13.609376l-9 7.457031c-2.902344 2.40625-3.730469 6.507812-1.992188 9.851562l87.503906 168.199219c16 30.738281 46.441406 49.914062 79.445313 49.914062h98.613281v-.085937c50 0 90.539062-43.386719 90.589844-96.660156.019531-23.835938-.070313-41.601563-.054688-56 .050782-38.523438.011719-52.738281-.085937-95.179688-.050781-22.210937-17.257813-40.078125-38.28125-40.078125zm22.25 135.203125c-.015625 14.402344-.039063 32.238281-.0625 56.074219-.042969 44.464844-33.609375 80.722656-74.824219 80.722656h-98.140625c-27.015625 0-52.019531-15.878906-65.25-41.300781l-84.527344-162.425781 4.171875-3.480469c.105469-.085937.207032-.1875.308594-.277344 7.175781-6.753906 16.832031-10.222656 26.664062-9.578125 10.050782.769532 19.324219 5.683594 25.609376 13.5625l24.488281 29.796875c2.140625 2.613281 5.695312 3.59375 8.875 2.457031 3.179687-1.136718 5.304687-4.152343 5.304687-7.527343l.144532-205.09375c.007812-13.429688 10.164062-24.355469 22.414062-24.355469s22.40625 10.9375 22.40625 24.375v123.660156c0 .429688-.019531.863282-.019531 1.300782 0 .1875.019531.378906.019531.5625v52.871093c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-54.464843c0-12.957032 9.898438-23.082032 21.832031-23.082032h.710938c12.257812 0 22.457031 10.683594 22.457031 24.121094v48.378906c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-37.957031c0-13.441406 9.710938-24.375 22.035156-24.375 12.253906 0 21.964844 10.929687 21.964844 24.375v35.808594c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-19.390625c0-13.441406 10.242188-23.960938 22.5-23.960938h.667969c12.226562 0 22.191406 10.699219 22.222656 24.097656.097656 42.410157.078125 56.609376.027344 95.105469zm0 0"/><path d="m72.609375 79.171875c4.417969 0 8-3.582031 8-8 .128906-30.527344 24.914063-55.203125 55.4375-55.203125 30.527344 0 55.308594 24.675781 55.4375 55.203125 0 4.417969 3.582031 8 8 8s8-3.582031 8-8c-.148437-39.351563-32.085937-71.171875-71.4375-71.171875-39.347656 0-71.289063 31.820312-71.4375 71.171875 0 4.417969 3.582031 8 8 8zm0 0"/></svg>
	      </label>
	      <select class="_width100" id="iSelect">	        
	        <option value="0">I (English)</option>
	        <option value="1">wǒ</option>
	        <option value="2">我</option>
	        <option value="3">我+wǒ</option>
	        <!--
	        <option value="0">local</option>
	        <option value="1">pinyin</option>
	        <option value="2">character</option>
	        <option value="3">character+pinyin</option>-->
	      </select>
	    </div>
	</div>

    <div class="col m3">
			<!--<button style="margin-top:43px">&#x27B2;</button>-->
			<button id="startBtn" class="_alignRIght tooltip -tooltip-left" style="float:right;margin-top:43px">&#8631;
			  <span class="tooltiptext">Play</span>
			</button>
	</div>
</div>

<!-- ======================== content ========================= -->

<div class="container">
	<div class="row">
	    <div class="col m11">
		  <div id="showItem">我</div>
		</div>
	</div>

  <div id="buttons">
	<div class="row">
		<!--
		<button class="_xlarge">I<div class="pinyin">pinyin</div></button>
		<button class="_xlarge">Me<div class="pinyin">pinyin</div></button>
		<button class="_xlarge">Us<div class="pinyin">pinyin</div></button>

		<button class="_xlarge">I<div class="pinyin">pinyin</div></button>
		<button class="_xlarge">Me<div class="pinyin">pinyin</div></button>
		<button class="_xlarge">Us<div class="pinyin">pinyin</div></button>

		<button class="_xlarge">I<div class="pinyin">pinyin</div></button>
		<button class="_xlarge">Me<div class="pinyin">pinyin</div></button>
		<button class="_xlarge">Us<div class="pinyin">pinyin</div></button>
<br><br>-->
		<div class="grid-container">
		  <div class="grid-item">dog</div>
		  <div class="grid-item">Chinese language</div>
		  <div class="grid-item">good, nice</div>  
		  <div class="grid-item">to drink</div>
		  <div class="grid-item">and, union, peace</div>
		  <div class="grid-item">very quite</div>  
		  <div class="grid-item">back, behind</div>
		  <div class="grid-item">to come back, to answer, to return</div>
		  <div class="grid-item">can, be able to</div>  
		</div>
	</div>
<!--
	<div class="row">
		<div class="col m2">&nbsp;</div>
		<div class="col m2">
			<button class="_xlarge">Button</button>
		</div>
		<div class="col m2">&nbsp;</div>
		<div class="col m2">		
			<button class="_xlarge">Button</button>
		</div>
		<div class="col m4">&nbsp;</div>	
	</div>
	
	<div class="row">
		<div class="col m4">
			<button class="_xlarge">Button</button>
		</div>
		<div class="col m4">
			<button class="_xlarge">Button</button>
		</div>
		<div class="col m4">
			<button class="_xlarge">Button</button>
		</div>
	</div>
-->








  </div>
  <!-- Show character+pinyin,character,pinyin,local -->
  <!-- Select local,pinyin,character,character+pinyin -->

</div> <!-- container -->

<footer>
	<div>Icons made by <a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
</footer>