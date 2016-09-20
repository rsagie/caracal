jQuery(document).ready(function($){
	
	
	 var countChildren = $('#ausgabe1').children().size()+1;
	 
	 //alert(countChildren);
	
	//alert("works");


		  $("#ausgabe1").css('visibility','visible');   // Document is ready



/*
Notwendige Formularprüfung

1. Prüfen der Bilder

- Prüfen ob Bild ausgewählt wurde >>> submit
- Prüfen ob der Größe der Bilder in MB >>> change und submit
- Prüfen ob das berechtigte Bildformat übergeben wurde >>> change und submit
- Prüfen ob die Auflösung der Bilder zu hoch ist >>> change und submit


2. Prüfen der Textfelder
- Prüfen ob E-Mail richtig geschrieben wurde >>> submit
- Prüfen wie viel Buchstaben eingegeben worden sind >>> submit


*/

// 1. Prüfen der Bilder

//- Prüfen ob das berechtigte Bildformat übergeben wurde
//- Funktion bilden

function checkPic(e) {
	
//	alert("pic will be checked");
	
		// Validate Emailadress

		  /*var emailRegex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

		  $( ".ef" ).each(function( i ) {
		  
		  var email = $(this).val();
		  
		  alert("email:"+email);
		  
		  if (!emailRegex.test(email)){var check = 1;
		  $( this ).parent().find('.append').append('<p>E-Mail address hast to be valid</p>');
		  }
		  
		  }); */
		  
// Validate Emailadress --- ENDE
	
	
	
	
	


// Bereits versendete Meldungen wieder löschen	
$(".bh").parent().find('.append').empty();

//var checkSelected = (".bh").val().size();

//alert("checkSelected"+checkSelected);
/*
if(checkSelected==0){
	$(".bh").parent().find('.append').append('<b>No picture is choosed</b>');
	 e.preventDefault();
}*/

var cg_ContestEnd = $("#cg_ContestEnd").val();
//alert(cg_ContestEnd);




var cg_ContestEndTime = $("#cg_ContestEndTime").val();
if(cg_ContestEnd==1 && cg_ContestEndTime != 0){
	
	var ActualTimeSeconds = Math.round((new Date).getTime()/1000);
	//alert(actualTime);
	
	//alert(cg_ContestEndTime);
	
	if(ActualTimeSeconds>cg_ContestEndTime){
		
		var cg_photo_contest_over = $("#cg_photo_contest_over").val();	
		alert(cg_photo_contest_over);
		e.preventDefault();
		
	} 
	
}


		
		
		


//var filename = $('input[type=file]')[0].files[0].name;
var filename = filename = $('input[type=file]').val().split('\\').pop();
// alert('filename: '+filename);


var modal = document.getElementsByClassName("modal")[0];
var upload_div = document.getElementById('upload_div');
var close_span = document.getElementsByClassName("close")[0];


// When the user clicks on <span> (x), close the modal
close_span.onclick = function() {
    modal.style.display = "none";
	upload_div.style.display = "none";
}


if(!filename){
	$( this ).parent().find('.append p').remove();
	var cg_no_picture_is_choosed = $("#cg_no_picture_is_choosed").val();
	$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_no_picture_is_choosed+'</p>');
	 e.preventDefault();
}else{
	upload_div.style.display = 'block'; 
	modal.style.display = 'block';
	document.getElementsByTagName("body")[0].setAttribute( 'class',"modal-open");

}



//var ext = filename.match(/\.(.+)$/)[1];
//var ext = filename.match(/\.(.+)$/)[1].toLowerCase();
// alert('ext: '+ext);
//var fileType = ext;	 
var fileType = document.getElementById('cg_bh').files[0].type;


var testcheck = 1;

var restrictJpg = $("#restrictJpg").val();
var restrictPng = $("#restrictPng").val();
var restrictGif = $("#restrictGif").val();
//var restrictPng = <?php echo json_encode($MaxResPNGon);?>;
//var restrictGif = <?php echo json_encode($MaxResGIFon);?>;


if (restrictJpg==1) {var MaxResJPGwidth = $("#MaxResJPGwidth").val();var MaxResJPGheight = $("#MaxResJPGheight").val();}
if (restrictPng==1) {var MaxResPNGwidth = $("#MaxResPNGwidth").val();var MaxResPNGheight = $("#MaxResPNGheight").val();}
if (restrictGif==1) {var MaxResGIFwidth = $("#MaxResGIFwidth").val();var MaxResGIFheight = $("#MaxResGIFheight").val();}

//alert(restrictPng);
//alert(MaxResPNGwidth);
//alert(MaxResPNGheight);



//alert(wrongType);
		if (fileType != 'image/jpeg' && fileType != 'image/png' && fileType != 'image/gif') 
		{ 
	// alert("wrongt type"+wrongType);
	
	var cg_file_not_allowed = $("#cg_file_not_allowed_1").val();
			//alert(cg_file_not_allowed);
		
			$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_file_not_allowed+'</p>');
			e.preventDefault();
		}
			
	
		
		
//- Prüfen ob das berechtigte Bildformat übergeben wurde   --- ENDE

//- Prüfen ob der Größe der Bilder in MB	



// Überprüfen ob der File größer ist als vorgegebene Uploadgröße

		var post_max_size_php_ini = $("#post_max_size_php_ini").val();
		var post_max_size_user_config = $("#post_max_size_user_config").val();
//alert(post_max_size_php_ini);
//alert(post_max_size_user_config);
		// PHP ini configuration will be always prefered
		if(post_max_size_php_ini < post_max_size_user_config){	
			var post_max_size = post_max_size_php_ini;	
		}
		else{
			var post_max_size = post_max_size_user_config;
		}
		
		//alert(post_max_size);
		// Wenn Null dann sozusagen unlimited
		if(post_max_size==0){post_max_size=post_max_size_php_ini;}
//alert(post_max_size);

		// alert("Post max size:"+post_max_size); 

		//alert(post_max_size);

			var file = $(".bh")[0].files[0];
			
			// alert('file: '+file);
			var sizePic = file.size;
			
			//Umwandeln in MegaByte
			sizePic = sizePic/1000000;
			
			
			// alert(all_files.length);
			//alert("Aktuelle Größe: "+sizePic);
			
			
			if (sizePic >= post_max_size) {
			
			var cg_file_size_to_big = $("#cg_file_size_to_big").val();
			//var cg_post_size = $("#cg_post_size").val();
			
			$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_file_size_to_big+': '+post_max_size+'MB</p>');
			 e.preventDefault();
			
			}
	
// Überprüfen ob der File größer ist als vorgegebene Uploadgröße --- ENDE 


// Überprüfen ob Bulk Upload aktiviert ist und die Anzahl wieviel Bilder hochgeladen werden können

		var ActivateBulkUpload = $("#ActivateBulkUpload").val();		
		

		
		if(ActivateBulkUpload==1){
			
		var all_files = $(".bh")[0].files;
			all_files = all_files.length;
		var BulkUploadQuantity = $("#BulkUploadQuantity").val();
		var BulkUploadMinQuantity = $("#BulkUploadMinQuantity").val();
		//alert(BulkUploadQuantity);
		// Wenn Null dann sozusagen unlimited
		if(BulkUploadQuantity==0){BulkUploadQuantity=1000;}
		if(BulkUploadMinQuantity==0){BulkUploadMinQuantity=1;}
		//alert("all_files "+all_files);
		//alert("BulkUploadQuantity "+BulkUploadQuantity);
		
		
			if(all_files>BulkUploadQuantity){
			
			var cg_language_BulkUploadQuantityIs = $("#cg_language_BulkUploadQuantityIs").val();
			$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_language_BulkUploadQuantityIs+': '+BulkUploadQuantity+'</p>');
			 e.preventDefault();
				
			}
			
			if(all_files<BulkUploadMinQuantity){
			
			var cg_language_BulkUploadLowQuantityIs = $("#cg_language_BulkUploadLowQuantityIs").val();
			$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_language_BulkUploadLowQuantityIs+': '+BulkUploadMinQuantity+'</p>');
			 e.preventDefault();
				
			}
			
			
		}


// Überprüfen ob Bulk Upload aktiviert ist und die Anzahl wieviel Bilder hochgeladen werden können --- ENDE



// überprüfen auflösung für jpg
// Check the resolution of a pic
	
	if (fileType == 'image/jpeg' && restrictJpg == 1) {
	
	 //alert('test');
	
var _URL = window.URL || window.webkitURL;

    var file, img;
    if (file = $(".bh")[0].files[0]) {
        img = new Image();
		// Aufgrund onload findet diese Prüfung als aller letztens staat!
        img.onload = function () {
        //    alert("testRES"+this.width + " " + this.height);	

			 
   		if (this.width > MaxResJPGwidth && MaxResJPGwidth!=0) {
	
		//var cg_to_high_resolution = $("#cg_to_high_resolution").val();
		//var cg_max_allowed_resolution_jpg = $("#cg_max_allowed_resolution_jpg").val();
		var cg_max_allowed_width_jpg = $("#cg_max_allowed_width_jpg").val();
		//alert(cg_max_allowed_width_jpg);
		$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_max_allowed_width_jpg+' '+MaxResJPGwidth+'px.</p>');
		 $("#cg_e_prevent_default").val(1);

		 e.preventDefault();
		
		 // alert('geklappt!res');	
		}
		
		  if (this.height > MaxResJPGheight && MaxResJPGheight!=0) {
		

		var cg_max_allowed_height_jpg = $("#cg_max_allowed_height_jpg").val();
		//alert(cg_max_allowed_height_jpg);
		$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_max_allowed_height_jpg+' '+MaxResJPGheight+'px.</p>');
		 $("#cg_e_prevent_default").val(1);

		 e.preventDefault();
		
		 // alert('geklappt!res');	
		}

        };
		
       img.src = _URL.createObjectURL(file);
	   
    }
	
	}

// überprüfen auflösung für png	
if (fileType == 'image/png' && restrictPng == 1) {
	
var _URL = window.URL || window.webkitURL;

    var file, img;
    if (file = $(".bh")[0].files[0]) {
        img = new Image();
		// Aufgrund onload findet diese Prüfung als aller letztens staat!
        img.onload = function () {
            //alert("testRES"+this.width + " " + this.height);	
			
			if (this.width > MaxResPNGwidth  && MaxResPNGwidth!=0) {
			
			var cg_max_allowed_width_png = $("#cg_max_allowed_width_png").val();
			$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_max_allowed_width_png+' '+MaxResPNGwidth+'px.</p>');
			$("#cg_e_prevent_default").val(1);
			 e.preventDefault();
			//alert('geklappt!res');
			
		
			}
			
			
			if (this.height > MaxResPNGheight  && MaxResPNGheight!=0) {
			
			var cg_max_allowed_height_png = $("#cg_max_allowed_height_png").val();
			$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_max_allowed_height_png+' '+MaxResPNGheight+'px.</p>');
			$("#cg_e_prevent_default").val(1);
			 e.preventDefault();
			//alert('geklappt!res');			
		
			}

        };
		
       img.src = _URL.createObjectURL(file);
	   
    }
	
	}
	
// überprüfen auflösung für gif	
if (fileType == 'image/gif' && restrictGif == 1) {
	
var _URL = window.URL || window.webkitURL;

    var file, img;
    if (file = $(".bh")[0].files[0]) {
        img = new Image();
		// Aufgrund onload findet diese Prüfung als aller letztens staat!
        img.onload = function () {
            //alert("testRES"+this.width + " " + this.height);	
			
			if (this.width > MaxResGIFwidth && MaxResGIFwidth!=0) {
			
			var cg_max_allowed_width_gif = $("#cg_max_allowed_width_gif").val();
			$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_max_allowed_width_gif+' '+MaxResGIFwidth+'px.</p>');
			$("#cg_e_prevent_default").val(1);
			 e.preventDefault();
			//alert('geklappt!res');
			
		
			}
			
			
			if (this.height > MaxResGIFheight && MaxResGIFheight!=0) {
			
			var cg_max_allowed_height_gif = $("#cg_max_allowed_height_gif").val();
			$(".bh").parent().find('.append').append('<p style="font-size:14px;">'+cg_max_allowed_height_gif+' '+MaxResGIFheight+'px.</p>');
			$("#cg_e_prevent_default").val(1);
			 e.preventDefault();
			//alert('geklappt!res');
			
		
			}
			
			

        };
		
       img.src = _URL.createObjectURL(file);
	   
    }
	
	}	
	
    //var check = 1;
}






   	$('INPUT[type="file"]').change(function (e) {
	

	checkPic(e);



});

// <<< Ende überprüfen der Change() Funktion



//$( "#cg_users_upload_submit" ).click(function() {
	
	 $(document).on('click', '#cg_users_upload_submit', function(e){

	//alert('submitted1');
	
 // $( "form" ).submit(function( e ) {

	//alert('submitted2');
	
	  		  $( ".cg-check-f" ).each(function( i ) {
					$( this ).parent().find('.append').empty();	  
		  }); 
		  
		  	  		  $( ".ef" ).each(function( i ) {
					$( this ).parent().find('.append').empty();	  
		  }); 
		  
		  	  		  $( ".nf" ).each(function( i ) {
					$( this ).parent().find('.append').empty();		  
		  }); 
		  
		  	  		  $( ".kf" ).each(function( i ) {
					$( this ).parent().find('.append').empty();		  
		  }); 
	

	

  var emailRegex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  
  
  
  
  
  		  $( ".cg-check-f" ).each(function( i ) {
			  
			  // alert('cf');
			 
				if(!$(this).prop('checked')){
					// alert('cf 1');
					$( this ).parent().find('.append p').remove();
					var cg_check_agreement = $("#cg_check_agreement").val();
					//alert(cg_check_agreement);
					$( this ).parent().find('.append').append('<p style="font-size:14px;">'+cg_check_agreement+'</p>');	
					var check = 1;
					e.preventDefault();
				}



		  
		  }); 
  
  
  
  
		  

		  $( ".ef" ).each(function( i ) {
			  
			 
			  
			
		  
		  var email = $(this).val();
		  			//   alert('ef');
		 var checkIfNeed = $( this ).parent().find(".checkIfNeed").val();
		  
		  //alert(email);
		  
		  if (checkIfNeed == 'on' || email.length > 0) {
		  
			  if (!emailRegex.test(email)){
						// 	  alert('ef 1');
				//   alert('remove yes');
			  $( this ).parent().find('.append p').remove();
			  var cg_check_email_upload = $("#cg_check_email_upload").val();
			  $( this ).parent().find('.append').append('<p style="font-size:14px;">'+cg_check_email_upload+'</p>');
			  
			  var check = 1;
		//	  alert("check: "+check);
			  e.preventDefault();
			  }
		  
		  }
		  
		  //alert('check: '+check);
		  
		  }); 
		  
// Validate Emailadress --- ENDE



// Überprüfen ob die Anzahl der Buchstaben in den Feldern stimmt
		  
		  $( ".nf" ).each(function( i ) {
		   // $(this).attr( "width", "200px" );
		   
		 var minsize = $( this ).parent().find(".minsize").val();
		 var maxsize = $( this ).parent().find(".maxsize").val();
		 var checkIfNeed = $( this ).parent().find(".checkIfNeed").val();
		 
		 var realsize = $( this ).val().length;
		 
		 		// 	  alert('nf');
		 
		 		 var cg_min_characters_text = $("#cg_min_characters_text").val();
		 var cg_max_characters_text = $("#cg_max_characters_text").val();				 
		 if (checkIfNeed == 'on') {
			 
			 		// 	  alert('nf 1');
		 
	 
		 		 if (realsize<minsize) {
				 
			 
				 $( this ).parent().find('.append p').remove();
	

				 $( this ).parent().find('.append').append('<p style="font-size:14px;">'+cg_min_characters_text+': '+minsize+'</p>');
				 
				var check = 1;
		//		alert("check: "+check);
				e.preventDefault();
						}
						
				
				else if (realsize>maxsize) {
				 
			 
				 $( this ).parent().find('.append p').remove();
	

				 $( this ).parent().find('.append').append('<p style="font-size:14px;">'+cg_max_characters_text+': '+maxsize+'</p>');
				 
				var check = 1;
		//		alert("check: "+check);
				e.preventDefault();
						}
		 
		 }
		 


   
		   }); 
		   
		   
// Überprüfen ob die Anzahl der Buchstaben in den Kommentar-Feldern stimmt
		  
		  $( ".kf" ).each(function( i ) {
		   // $(this).attr( "width", "200px" );
		   
		 var minsize = $( this ).parent().find(".minsize").val();
		 var maxsize = $( this ).parent().find(".maxsize").val();
		 var checkIfNeed = $( this ).parent().find(".checkIfNeed").val();
		 
		 var realsize = $( this ).val().length;

		var cg_min_characters_text = $("#cg_min_characters_text").val();
		 var cg_max_characters_text = $("#cg_max_characters_text").val();	
		 //  alert(realsize);
		 			//  alert(maxsize);
			 				 
		 if (checkIfNeed == 'on') {
			 
			 // 			  alert('kf 1');
	 
	 
		 		 if (realsize<minsize) {
				 
		 
				 $( this ).parent().find('.append p').remove();
				 
			
				 
				 $( this ).parent().find('.append').append('<p style="font-size:14px;">'+cg_min_characters_text+': '+minsize+'</p>');
				 var check = 1;
				// alert("check: "+check);
				 e.preventDefault();

						}
						
				else if (realsize>maxsize) {
				// alert(2);
		 
				 $( this ).parent().find('.append p').remove();
				 
			
				 
				 $( this ).parent().find('.append').append('<p style="font-size:14px;">'+cg_max_characters_text+': '+maxsize+'</p>');
				 var check = 1;
				// alert("check: "+check);
				 e.preventDefault();

					}
		 
		 }
		 
  
		   });
		   
		   			//alert("check: "+check);
		   
		   		 // alert('end');
				  
				 //Funktion zum Überprüfen des Bildes
				checkPic(e);
 
		// Falls das Bild in der Funktion nicht zugelassen wird, wird da der Wert für prevent default auf 1 gesetzt.
		 var cg_e_prevent_default = $("#cg_e_prevent_default").val();

		 if(cg_e_prevent_default==1){
		 e.preventDefault(); 
		 }
		   
// Überprüfen ob die Anzahl der Buchstaben in den Feldern stimmt --- ENDE 
  
		   /*if (check == 1) {
		   alert('Form has to be blocked');

		  
		  
		   e.preventDefault();
		   } */






//});

});




 });