jQuery(document).ready(function($){
	
	
							//------------------------------------------------------------------------------//
							// Bereich vor dem Slider --- Anfang
							//------------------------------------------------------------------------------//	
	
	

// Kommentar Pop Up im Slider



	   $(document).on('click', '[id*=cg_pngCommentsIcon]', function(e){
		   
		//   alert("comment");

  var cg_slider_mouseup = $("#cg_slider_mouseup").val();
  

			// Overlay sichtbar machen
		   
		  // $('#cg_overlay').css('display', 'block');
		  // $('#cg_overlay').toggle();
		   
		  // $('#cg_overlay').css('opacity', '0.4');
		//   $('#cg_slider_arrow_right').toggle();

		//var widthScreen = $('#cg_overlay').width();
		var widthScreen = $(window).width();
//$(window).width(); 
		// Prüfen ob mobile Ansicht
		if(isMobile==true){
		//	alert(2);
			//var test = widthScreen-200;
		$('#cg_comments_slider_div').css('left', 0);
		$('#cg_comments_slider_div').css('top', 0);
		$('#cg_comments_slider_div').css('width', widthScreen);
		//alert(test);
		//padding-left ist 50px;
		var newCommentsElementsWidth = widthScreen-100;
		$('#cg_picture_comments_single_view').css('width', newCommentsElementsWidth);
		$('#cg_picture_comments_single_view_hr').css('width', newCommentsElementsWidth);
		$('#cg_your_comment_single_view').css('width', newCommentsElementsWidth);
		$('#cg_your_comment_comment_single_view').css('width', newCommentsElementsWidth);
		$('#cg_slider_comment').css('width', newCommentsElementsWidth);			
		
		// Close Slider Button ansonsten nicht sichtbar
		var closeSliderButtonLeft = widthScreen - 50;
		$('#close_slider_comments_button').css('left', 50);			
		$('#close_slider_comments_button').css('top', 10);		
			
		}
		
		else{
			
		var marginLeftCommentDiv = (widthScreen-800)/2;
		$('#cg_comments_slider_div').css('left', marginLeftCommentDiv);	
		var newCommentsElementsWidth = 683;
			
		}

		// Breite der Slider comment elemente wird hier gesetzt um jeder Zeit wieder aufgefunden zu werden		
		$('#cg_slider_comments_elemens_width').val(newCommentsElementsWidth);

		   $('#cg_comments_slider_div').toggle();
		   
		   $('#close_slider_comments_button').show();
		 //  var idImageForComment = $(this).attr('alt');
		   var cg_picture_id = $(this).attr("id");
		 
		   
		   cg_picture_id = parseInt(cg_picture_id.substr(18));
		   //  alert(cg_picture_id);
			// Haupthidden Feld, dass aktuell geöffnete comment image id zeigt
		   $('#cg_slider_comment_picture_id').val(cg_picture_id);
		   
		   
			$("#cg_user_input"+cg_picture_id+"").css("display","none");
		   
		   //$('#cg_actual_slider_class_value').val(idImageForComment);
		   // Funktion zur Ausführung der Berechnung
		   
		   
		   // Prüfen der Wordpress Session id
		   var check = $("#cg_check").val();
		   
			//alert(2);
			// I am not a robot checkbox soll auftauchen   
			if ($("#"+check+"").length > 0){
				
				//alert(3);
				
				
				var onlyCheck = 1;
			
			}
			else{
				//alert(4);
				var cg_language_i_am_not_a_robot = $('#cg_language_i_am_not_a_robot').val();
				$("#cg_i_am_not_a_robot").empty();
				$("#cg_i_am_not_a_robot").append("<input type='checkbox' value='"+check+"' name='"+check+"' id='"+check+"' '>"+cg_language_i_am_not_a_robot+"<br/><br/>");
				
			}
			 
			 
			$("#cg_open_slider_comment").click(); 
			  
			  //  $('#imgContainer').fadeIn('slow');
			   // $('#imgContainer').toggle();
		   
		  
		   
		   
		return false; 




});


// Kommentar Pop Up im Slider --- ENDE


	   $(document).on('click', '#close_slider_button', function(e){
		   

closeCGsliderFunction();


});


	   $(document).on('click', '#close_slider_comments_button', function(e){
		   

closeCGsliderCommentsFunction();


});


$(document).keydown(function(e) {
	
	//alert(2);
	
	if(e.which == 27) { // left 	
	


		
		if($('#close_slider_comments_button').is(':visible')) {
			
			closeCGsliderCommentsFunction();
			
		}
		
		else{
		
		
		if($('#close_slider_button').is(':visible')) {
			
			closeCGsliderFunction();
			
		}
			
			
		}
	

	}	
	
});


// Schließen von Kommentar Fenster im Slider und in der Gallerie
function closeCGsliderCommentsFunction(){

		//var cg_slider_comment_real_id = $('[id*=commentsCGslider]').find("#cg_slider_comment_real_id").val(); 


		var actual_slider_comments_id = $('#cg_slider_comment_picture_id').val();
		$('#show_comments_slider').empty();
		//alert(actual_slider_comments_id);



		//$('#cg_pngCommentsIcon'+actual_slider_comments_id+'').click(); 
		$('#close_slider_comments_button').css("display","none");
		$('#cg_comments_slider_div').css("display","none");

		//$('.cg_pngCommentsIcon').click();  
		
	}	

		
		// Wenn außerhalb des Slider Divs geklickt wird, dann schließen. Diese Funktion vorallem nützlich wenn "Comment out of gallery aktiviert ist" (release)
		$(document).mouseup(function (e)
		{
			var container = $("#cg_comments_slider_div");

			if (!container.is(e.target) // if the target of the click isn't the container...
				&& container.has(e.target).length === 0) // ... nor a descendant of the container
			{
				container.hide();
			}
		});	
		


	   $(document).on('click', '.cg_img_box', function(e){
		   

$('#cg_comments_slider_div').css("display","none");

});


// Schließen von Kommentar Fenster im Slider und in der Gallerie --- ENDE
  
  
  

	var cg_activate_gallery_slider = $("#cg_activate_gallery_slider").val();
	var cg_OnlyGalleryView = $("#cg_OnlyGalleryView").val();
	
	//Start Slider/Out of Gallery Script
	




//alert(cg_OnlyGalleryView);
							//------------------------------------------------------------------------------//
							// Bereich vor dem Slider --- ENDE
							//------------------------------------------------------------------------------//
							
							
	// Wenn nur gallery view aktiviert ist dann return false einfach immer						
	if(cg_OnlyGalleryView == 1){
	

	$(document).on('click', '[class*=cg_image]', function(e){
		
	//alert(cg_OnlyGalleryView);	
	return false;	
		
		
		
	});
	
	return false;	

	}		


	
	if(cg_activate_gallery_slider == 1){
		
	//$(".cg_href_image").attr("href", "#")	
	
	//alert(cg_activate_gallery_slider);
	/*
	ABLAUF
	1.  Durch klicken wird in der Hauptfunktion position berechnet
	2. Display none Elemente werden wieder visible
	3. Beim Wegklicken verschwinden Display none Elemente
	4. Beim Wiederklicken fängt es wieder bei 1 an  
	
	Aufteilung insgesamt:
	
	1. Hovern
	2. Resize
	3. Hauptfunktion
	4. Click Events
	
	
	
	*/
	
	// Zu tun: ins leere kicken comments block wird geschlossen, auf pfeil klicken comments block wird geschlossen, sliden bis zu gewisser stelle comments block wird geschlossen
	
	
	// Schließen (X) Buttons beim imgContainer und commentContainer einbauen
	
	// Beim Rating wird nicht gespeichert. Alle Infos wie bei Show_Image müssen gewonnen werden.
	
	// Wenn Bilder noch nicht geladen sind, dann soll Loading Gif erscheinen
	
	
	// Hidden input Feld wo aktuelles CG immer angezeigt wird, immer in Abhängigkeit von left.
	// Bei der Funktion r zur Orientierung nutzen
	// Formel beim Dragging berechnung
	// Bei Klicking dann später addieren und subtrahieren vom aktuellem

// Möglichkeiten die Bilder alle immer in gleicher größe als Thumb anzuzeigen

//Vollbild machen slider. Sowohl Verticale Pfeilfläche einbauen über die ganze Höhe. Wie auch Royal slider Funktion.


// Anzeigen, dass geklickt werden kann wenn man über Pfeile hovert

// Bewertungsmöglichkeit einbauen. Am besten da wo bewertungen in der Gallerie Ansicht drin sind, das Element klonen (clone).   

// Als nächstes Elemente in der Box zentrieren dann kommentare einbauen 

// Komplett ohne Slider, mit direktem bewerten und kommentieren

// Je nach dem bei welchem Bild man sich befindet sollte entsprechende Picture ID angezeigt werden


// Wichtige Variablen die man dauernd nutzt werden schon hier bestimmt 
var cg_hide_until_vote = $("#cg_hide_until_vote").val();
var cg_vote_in_gallery = $("#cg_vote_in_gallery").val();
var cg_comment_in_gallery = $("#cg_comment_in_gallery").val();
//var cg_shown_images = $("[id*=cg_image_id]").length;
var cg_shown_images = $(".show").length;
 var cg_allow_comments = $("#cg_allow_comments").val();
var cg_allow_rating = $("#cg_allow_rating").val();
//alert(cg_allow_rating);
 var cg_slider_mouseup = $("#cg_slider_mouseup").val();
 var cg_Use_as_URL = $("#cg_Use_as_URL").val();
 var cg_ForwardToURL = $("#cg_ForwardToURL").val();
 var cg_ForwardFrom = $("#cg_ForwardFrom").val();
 var cg_ForwardType = $("#cg_ForwardType").val();
 var cg_FbLike = $("#cg_FbLike").val();
 var cg_FbLike = $("#cg_FbLike").val();
 var cg_FbLikeGallery = $("#cg_FbLikeGallery").val();
 		 var cg_pngCommentsIconImg = $('#cg_pngCommentsIconImg').val();
		 var cg_pngUrlIconImg = $('#cg_pngUrlIconImg').val();
		 var cg_hide_info_png = $('#cg_hide_info_png').val();
		// alert(cg_hide_info_png);
		 var cg_show_info_png = $('#cg_show_info_png').val();
		 var cg_ShowAlwaysInfoSlider =  $("#cg_ShowAlwaysInfoSlider").val();
 //var cg_slider_mouseup = $("#cg_slider_mouseup").val();

 
 //alert(cg_allow_rating);
 //alert(cg_FbLikeGallery);
 /*
var highest = -999;

$("*").each(function() {
    var current = parseInt($(this).css("z-index"), 10);
    if(current && highest < current) highest = current;
});*

//alert(highest);



var highestElement = $('body').find('div:visible:first').hasClass();

alert(highestElement);/
	
	

//alert(cg_shown_images);
/*
$( '#imgContainer' ).find('.cg_img_box').hover(function() {
		 $(this).css("cursor","pointer");	 
	 // $("#imgContainer").off( "mousedown" )
});*/


   // Inhalt beim hovern aufdecken
   

	  $( '[id*=cg_slider_arrow]' ).hover(function() {
	  $(this).css("cursor","pointer");	  
});

if(cg_hide_until_vote==1 && cg_vote_in_gallery==1){
	
$( '.rating_cg' ).hover(function() {
	  $(this).css("cursor","pointer");	  
});


	
}

if(cg_comment_in_gallery==1 && cg_vote_in_gallery==1){
	
$( '[id*=rating_cgc]' ).hover(function() {
	  $(this).css("cursor","pointer");	  
});
	
}

// Achtung! Aktuell ist gleicher zeiger überall festgelegt!
//var cg_slider_mousedown = $("#cg_slider_mousedown").val();

/*
if(typeof cg_slider_mousedown === 'undefined'){
	
	$( '#imgContainer' ).hover(function() {
	  $(this).css("cursor","move");	  
});


};*/



		// device detection, damit elemente beim klicken auf imgContainer nicht verschwinden und rating und comment auf mobile funktionieren
		var isMobile = false; //initiate as false
		
		
		// device detection, damit elemente beim klicken auf imgContainer nicht verschwinden und rating und comment auf mobile funktionieren
		if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
			|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;		  
													  
		
		// Pfeile verstecken bei der Mobile Version
		
		if(isMobile==true){
			$( "#cg_slider_arrow_left" ).hide();
			$( "#cg_slider_arrow_right" ).hide();
		}
		
		
		/*
		if(isMobile==true){
			
			var cg_slider_arrow_left_img = $( "#cg_slider_arrow_left_img" ).attr("src");
			var cg_slider_arrow_right_img = $( "#cg_slider_arrow_right_img" ).attr("src");
			
			cg_slider_arrow_left_img = cg_slider_arrow_left_img.substr(0,cg_slider_arrow_left_img.length-4)+"_mobile.png";
			$( "#cg_slider_arrow_left_img" ).attr("src",cg_slider_arrow_left_img);
			
			cg_slider_arrow_right_img = cg_slider_arrow_right_img.substr(0,cg_slider_arrow_right_img.length-4)+"_mobile.png";
			$( "#cg_slider_arrow_right_img" ).attr("src",cg_slider_arrow_right_img);
		
			 $("#check_mobile").val("true");
			 $('#close_slider_button').css('top','10px');
			 
			 			// Einstellen von Pfeilen Größe
			 
				var widthDevice = $(window).width();
				var heightDevice = $(window).height();		
			
			//Vertical gehalten
			if(widthDevice/heightDevice < 1){
					
				$('#cg_slider_arrow_left_img').width('7%');
				$('#cg_slider_arrow_right_img').width('7%');
				$('#cg_slider_arrow_left_img').height('20%');
				$('#cg_slider_arrow_right_img').height('20%');
				
			}
			//Horizontal gehalten
			else{
			
				$('#cg_slider_arrow_left_img').width('5%');			
				$('#cg_slider_arrow_right_img').width('5%');
				$('#cg_slider_arrow_left_img').height('10%');
				$('#cg_slider_arrow_right_img').height('10%');				

			}
			
		}
		else{
			
		 $( "#check_mobile" ).val("false");	
			
		}*/
		





	
		$( window ).resize(function() {
			
 var checkCGcontainerVisiblity = $( "#imgContainer" ).is(':visible');
 
 //alert(checkCGcontainerVisiblity);

 if(checkCGcontainerVisiblity){

	  var cg_slider_position = $( "#imgContainer" ).position();
 var CGdistanceX = cg_slider_position.left;	
 
 // Aller Slider Boxen werden entfernt. Der Aufbau kann von vorne beginnen
 $( ".cg_img_box" ).remove();

var classCGimageNumber = $('#cg_actual_slider_class_value').val(); 
$('#cg_slider_resize').val(1); 

//alert(classCGimageNumber);


cgSliderIMGdistanceCounting(classCGimageNumber,'');

		// Pfeile verstecken bei der Mobile Version
		if(isMobile==true){
			$( "#cg_slider_arrow_left" ).hide();
			$( "#cg_slider_arrow_right" ).hide();
		}
		

		
   var cgWindowHeight = $(window).height(); 
   var cgMarginTop = (cgWindowHeight-(cgWindowHeight/100*10))/2;
		
   $('#cg_slider_arrow_right').css("top",cgMarginTop);
   $('#cg_slider_arrow_left').css("top",cgMarginTop);
   //$('#cg_slider_arrow_right').toggle();
 //  $('#cg_slider_arrow_left').toggle(); 


/*
 $('#cg_slider_arrow_left').width('2%');
 $('#cg_slider_arrow_right').width('2%');
 
 
 		// Pfeile Ändern bei der Mobile Version
		
		if(isMobile==true){
			
			
			// Prüfen ob Verticale oder Horizontale Mobile Ansicht
				var widthDevice = $(window).width();
				var heightDevice = $(window).height();
			
		
						
			if(widthDevice/heightDevice < 1){
					
				$('#cg_slider_arrow_left').width('7%');
				$('#cg_slider_arrow_right').width('7%');	
				
			}			
			
			else{

			
				$('#cg_slider_arrow_right').width('5%');			
				$('#cg_slider_arrow_right').width('5%');			
			

			}
			
			
			
		}
		
		else{
			
		$('#cg_slider_arrow_left').width('2%');
		$('#cg_slider_arrow_right').width('2%');	
			
		}

 
 
 
 $('#cg_slider_arrow_left').height('100%');
 $('#cg_slider_arrow_right').height('100%');*/

	 
	 
 }	
 
 
 
 


		// Prüfen ob mobile Ansicht
		if(isMobile==true){
			 var widthScreen = $(window).width(); 
		//	alert(2);
			//var test = widthScreen-200;
			var newCommentsElementsWidth = widthScreen-100;
		$('#cg_comments_slider_div').css('left', 0);
		$('#cg_comments_slider_div').css('top', 0);
		$('#cg_comments_slider_div').css('width', newCommentsElementsWidth);
		$('#cg_comments_hr').css('width', newCommentsElementsWidth);

		//alert(test);
		//padding-left ist 50px;
		
		$('#cg_picture_comments_single_view').css('width', newCommentsElementsWidth);
		$('#cg_picture_comments_single_view_hr').css('width', newCommentsElementsWidth);
		$('#cg_your_comment_single_view').css('width', newCommentsElementsWidth);
		$('#cg_your_comment_comment_single_view').css('width', newCommentsElementsWidth);
		$('#cg_slider_comment').css('width', newCommentsElementsWidth);			
		$('#close_slider_button').css('top', "30px");	

	
		// Close Slider Button ansonsten nicht sichtbar
		var closeSliderButtonLeft = widthScreen-50;
		$('#close_slider_comments_button').css('left', 10);			
		$('#close_slider_comments_button').css('top', 10);			
			
		} 
	
});


	   /*$(document).on('click', '#imgContainer', function(e){
alert(2);
	



	   });*/


	   
	   
// Reaktion auf touch
/*
$(document).on('touchstart', '#imgContainer', function(e) {
	//alert(1);
  var xPos = e.originalEvent.touches[0].pageX;
 // alert(xPos);
  //$("[id*=ratingCGslider]").css("display","inline");
  
});*/

/*
document.addEventListener('touchmove', function(e) {
	
	//var start_x = e.pageX;
	
	//alert(start_x);
	
//var xPos = e.originalEvent.touches[0].pageX;
	
//	alert(xPos);
   // e.preventDefault();
    var touch = e.touches[0];
//    alert(touch.pageX + " - " + touch.pageY);
	
	
	
	
}, false);*/

//alert(3);












$(document).on('touchstart', '#imgContainer', function(e) {
		var start_x = e.originalEvent.touches[0].pageX;
		
		

	 // Zur Prüfung ob touch gestartet wurde
	 $("#cg_slider_release_toch").val(1);
			
			// Bestimmung aktuelle ID des angezeiten Images
			var realId = $("#cg_actual_slider_img_id").val();	

	  
	  $('.cg_slider_image').bind('contextmenu', function(e) {
      return false;
	  }); 
	  
	  // Font Size der Input Felder je nach größe anpassen
	  var widthScreen = $(window).width();   
	  
	 
	  if(widthScreen<=800){$("#cg_user_input"+realId+"").css("font-size","12px");}	
	  if(widthScreen>800 && widthScreen<=1280){$("#cg_user_input"+realId+"").css("font-size","14px");	}
	  if(widthScreen>1280 && widthScreen<=1600){$("#cg_user_input"+realId+"").css("font-size","16px");	}
	  if(widthScreen>1600 && widthScreen<=1900){$("#cg_user_input"+realId+"").css("font-size","18px");	}
	  if(widthScreen>1900){$("#cg_user_input"+realId+"").css("font-size","20px");	}

	 
	 
	  if(cg_ShowAlwaysInfoSlider!=1){
	  
	  				 setTimeout(function(){
						 
						 // Nur dann anzeigen wenn immer noch gehalten wird
						 var cg_slider_release_toch = $("#cg_slider_release_toch").val();						 
						 
						if(cg_slider_release_toch==1){						  	
						  $("#cg_user_input"+realId+"").css("display","block");				 
						}
				 }, 200);
		}		 
				 

	  
	//   var realId = $("#cg_actual_slider_img_id").val();	
	 // $("#cg_user_input"+realId+"").css("display","block");	
	  //alert(widthScreen);
	  
	  $("#cg_slider_touchstart").val(start_x);
  
});


document.addEventListener('touchmove', function(e) {
	
var xPos = e.changedTouches[0].pageX;
	

	$("#cg_slider_touchend").val(xPos);
	
	
	
}, false);




$(document).on('touchend', '#imgContainer', function(e) {
		//var end_x_2 = e.changedTouches[0].pageX;
		//var end_xd = e.changedTouches[0].pageX;
		
				//alert("end x 1"+end_xd);
//	alert(4);
		
	 var realId = $("#cg_actual_slider_img_id").val();			
    $("#cg_user_input"+realId+"").css("display","none");
	 
	 	  				 /* setTimeout(function(){

	 var realId = $("#cg_actual_slider_img_id").val();			
     $("#cg_user_input"+realId+"").css("display","none");		 
				 
				 }, 150);*/
	 
	 // Zur Prüfung ob losgelassen wurde
	 $("#cg_slider_release_toch").val(0);
	 var start_x = $("#cg_slider_touchstart").val();
	 var end_x = $("#cg_slider_touchend").val();
		
		//alert("start "+start_x);
		//alert(end_x);
	//	alert("end "+end_x_2);
		
		//var touchDistance = end_x-start_x;
		
		
									 var classCGimage = $('#cg_actual_slider_class_value').val();
								   
									 classCGimage = parseInt(classCGimage.substr(8));
									 
							// Damit sofort wieder reagiert wenn man nach rechts klickt								
							//	if(classCGimage<1){classCGimage=1;}
							
							//if (typeof end_x == 'undefined') {var touchDistance = 0;}
							if (end_x.length === 0) {var touchDistance = 0;}
							else{var touchDistance = end_x-start_x;}
									
									
									
										//	alert(start_x);
										//	alert(end_x);
										//	alert(touchDistance);
									
									// Beim Zug nach rechts wird die Klassen zurück geslidet
									if(touchDistance>70){
									classCGimage = classCGimage-1;
									var goSliderAnimation = true;
								    }
									/*
									if(touchDistance>200&&touchDistance<=300){
									classCGimage = classCGimage-2;
									var goSliderAnimation = true;									
								    }
									
									if(touchDistance>300&&touchDistance<=400){
									classCGimage = classCGimage-3; 	
									var goSliderAnimation = true;									
								    }
									
									if(touchDistance>400&&touchDistance<=500){
									classCGimage = classCGimage-4; 
									var goSliderAnimation = true;									
								    }
									
									if(touchDistance>500){
									classCGimage = classCGimage-4; 	 
									var goSliderAnimation = true;									
								    }*/
									
									// Beim Zug nach links wird die Klassen nach vorne geslidet
									if(touchDistance<-70){
									classCGimage = classCGimage+1; 	  
									var goSliderAnimation = true;									
								    }
									
									/*
									if(touchDistance<-200&&touchDistance>=-300){
									classCGimage = classCGimage+2; 	
									var goSliderAnimation = true;									
								    }
									
									if(touchDistance<-300&&touchDistance>=-400){
									classCGimage = classCGimage+3; 
									var goSliderAnimation = true;									
								    }
									
									if(touchDistance<-400&&touchDistance>=-500){
									classCGimage = classCGimage+4; 
									var goSliderAnimation = true;									
								    }
									
									if(touchDistance<-500){
									classCGimage = classCGimage+4; 	 
									var goSliderAnimation = true;									
								    }
									*/
									//alert(classCGimage);
									//alert(cg_shown_images);
									// Prüfen ob Slider am Ende oder am Anfang ist
									if(classCGimage<1){classCGimage=1;}
									if(classCGimage>cg_shown_images){classCGimage=cg_shown_images;}
									
									var real_picture_id = parseInt($(".cg_image"+classCGimage).attr("data-cg_image_id"));
									//alert(real_picture_id);
					   
									
									classCGimage = "cg_image"+classCGimage;
								   
								   $('#cg_actual_slider_class_value').val(classCGimage);
								   
								   	// Echte ID wird vergeben  
									//var real_picture_id = $("cg_show"+classCGimage).attr("id");
									
									
									//real_picture_id = parseInt(real_picture_id.substr(7));
									$('#cg_actual_slider_img_id').val(real_picture_id);
									
									
									// Picture ID crypten und oben einfügen
									//  var crypted_picture_id =(real_picture_id+8)*2+100000;
									  		 // document.location.hash = "img"+crypted_picture_id;						  
										  
											  
									//var isMobile = false; //initiate as false
									
									//alert(classCGimage);
									// device detection, damit elemente beim klicken auf imgContainer nicht verschwinden und rating und comment auf mobile funktionieren
									if(isMobile==true && goSliderAnimation == true){
																		   
																	   // Funktion zur Ausführung der Berechnung
																	   // !!! SEHR WICHTIG !!! SetTimeOut hat gesetzt zu werden damit click event auf rating und comment div reagiert!!!
																	   setTimeout(function(){  cgSliderIMGdistanceCounting(classCGimage,''); }, 10);
									}
		
		
		
									// Muss wieder auf normal gesetzt werden. Ansonsten wiederholt sich die zuletzt ermittelte Position
									$("#cg_slider_touchend").val("");
		
		
		
		
		

  
});





/*
    $("#imgContainer").bind('touchstart', function(e){
		

	  
    }).bind('touchend', function(e){
		

    });*/






// Reaktion auf touch --- ENDE 


//---------------------- Mousedown Mouseup Events für Image Container --------------------------------
//----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------
	  
/*	  
	  
 $('#imgContainer').mousedown(function(e) {
	 
	   
  // Aktuelle User-Info wird angezeigt falls gegeben
  

  
			var realId = $("#cg_actual_slider_img_id").val();
		  //$("#cg_user_input"+realId+"").css("display","block");
		  
		  
		  	// Font Size der Input Felder je nach größe anpassen
		  var widthScreen = $('#cg_overlay').width();  
		  
		 
		  if(widthScreen<=800){$("#cg_user_input"+realId+"").css("font-size","12px");}	
		  if(widthScreen>800 && widthScreen<=1280){$("#cg_user_input"+realId+"").css("font-size","14px");	}
		  if(widthScreen>1280 && widthScreen<=1600){$("#cg_user_input"+realId+"").css("font-size","16px");	}
		  if(widthScreen>1600 && widthScreen<=1900){$("#cg_user_input"+realId+"").css("font-size","18px");	}
		  if(widthScreen>1900){$("#cg_user_input"+realId+"").css("font-size","20px");	}

			//  var cg_slider_mouseup = $("#cg_slider_mouseup").val();
			
			// Prüfen ob nur Klick event war oder Maus auch gehalten wurde
			
			var cg_allow_mouse_release = 0;
			$("#cg_allow_mouse_release").val(cg_allow_mouse_release);
		  
		    setTimeout(function(){  var cg_allow_mouse_release = 1; $("#cg_allow_mouse_release").val(cg_allow_mouse_release);}, 80);// 80 hat sich als der beste Wert herausgestellt
			
			// Prüfen ob nur Klick event war oder Maus auch gehalten wurde --- ENDE
			

			// Damit hidden User Felder nicht sofort erscheinen sondern erstmal die Events statt finden können
			
			if(cg_ShowAlwaysInfoSlider!=1){
			
				if(isMobile==false){
								
								
					 setTimeout(function(){  


					var cg_slider_mousedown = $("#cg_slider_mousedown").val();


					if(cg_slider_mousedown==1){
						
						 
					 $("#cg_user_input"+realId+"").css("display","block");
					 
					 }
					 
					 
					 }, 150);
				 
				 }
				 
			}	 
			// Damit hidden User Felder nicht sofort erscheinen sondern erstmal die Events statt finden können
 
 
  // Aktuelle User-Info wird angezeigt falls gegeben --- ENDE
	 
	 
	 
	// alert(3);
	
	//setTimeout(function(){  draggableElement(); }, 10);
	
//draggableElement();
	

//$( "#imgContainer" ).draggable( "enable" );
	//setTimeout(function(){ $( "#imgContainer" ).draggable( "enable" ); }, 100);
	
	
	 
	 var start_x = e.pageX;
	 
	 	
//$( "#imgContainer" ).draggable( "enable" );
	 
	$("#cg_slider_mouseup").val(0);
  $("#cg_slider_mousedown").val(1);
  
  var cg_slider_mousedown = $("#cg_slider_mousedown").val();
  
  if (cg_slider_mousedown==1){
  
   $("#cg_x_value_mousedown_e_page").val(start_x);
   	// Achtung am Anfang wird move gezeigt! Ist Am Anfang der Datei definiert.
      $(this).css("cursor","e-resize");
	 // $('#cg_x_value_mousedown_left_margin').val(cg_slider_position_left);
	  
	  return false;
	  
	  }
 return false;
  });
  
  $('#imgContainer').mouseup(function(e) {
	  
	  


	  //$( "#imgContainer" ).draggable({ disabled: true });
	  	var cg_slider_mousedown = $("#cg_slider_mousedown").val();
		  //setTimeout(function(){    $("#cg_user_input"+realId+"").css("display","block");}, 10);
		    var realId = $("#cg_actual_slider_img_id").val();
			
		if(cg_ShowAlwaysInfoSlider!=1){	
			if(isMobile==false){	
				
			$("#cg_user_input"+realId+"").css("display","none");
			}		
		}
// Ansonsten funktioniert draggan nach nur einem Mausklick		
//$( "#imgContainer" ).draggable( "disable" );
  
 if (cg_slider_mousedown==1){
	 
	 			// Hier muss schon geprüft werden ob Rating geklickt wurde oder nicht, damit die Animation vorher nicht startet


				/*jQuery( document ).on( 'click', 'img[id*=cg_rate]', function(e) {

							$("#cg_rating_ajax_call").val(1);
							

				});*/
				/*
				if (event.target === this) {
        alert($(this).attr("id"));
    }
				
				if ($(e.target).hasClass('ratingCGslider]')) {
				alert("ajax call insert 1");
				}
				
				if ($(this).hasClass('imgContainer')) { 
				alert("ajax call insert 2");
				return False;
				}*/


		// Hier muss schon geprüft werden ob Rating geklickt wurde oder nicht, damit die Animation vorher nicht startet --- ENDE
	 
	 
/*	  
	  	$("#cg_slider_mouseup").val(1);
  $("#cg_slider_mousedown").val(0);
  
  // Prüfen ob Rating geklickt wurde und AJAX call lädt
 

	  var end_x = e.pageX;
	  
	   $("#cg_x_value_mouseup_e_page").val(end_x);
	  var start_x = $("#cg_x_value_mousedown_e_page").val();
	   
	   
	   if(cg_ShowAlwaysInfoSlider!=1){
			$("#cg_user_input"+realId+"").css("display","none");
	   }
	 
	  $("#cg_slider_mouseup").val(1);
		$("#cg_slider_mousedown").val(0);
			// Achtung am Anfang wird move gezeigt! Ist Am Anfang der Datei definiert.
	   $(this).css("cursor","move");    
	   
	   
	  
									 var classCGimage = $('#cg_actual_slider_class_value').val();
									   
										 classCGimage = parseInt(classCGimage.substr(8));
										 
								// Damit sofort wieder reagiert wenn man nach rechts klickt								
								//	if(classCGimage<1){classCGimage=1;}
								
										var mouseDistance = end_x-start_x;
										
										// Beim Zug nach rechts wird die Klassen zurück geslidet
										if(mouseDistance>1&&mouseDistance<=300){
										classCGimage = classCGimage-1; 	  	   
										}
										
										if(mouseDistance>300&&mouseDistance<=500){
										classCGimage = classCGimage-2; 	  	   
										}
										
										if(mouseDistance>500&&mouseDistance<=700){
										classCGimage = classCGimage-3; 	  	   
										}
										
										if(mouseDistance>700&&mouseDistance<=900){
										classCGimage = classCGimage-4; 	  	   
										}
										
										if(mouseDistance>900){
										classCGimage = classCGimage-4; 	  	   
										}
										
										// Beim Zug nach links wird die Klassen nach vorne geslidet
										if(mouseDistance<-1&&mouseDistance>=-300){
										classCGimage = classCGimage+1; 	  	   
										}
										
										if(mouseDistance<-300&&mouseDistance>=-500){
										classCGimage = classCGimage+2; 	  	   
										}
										
										if(mouseDistance<-500&&mouseDistance>=-700){
										classCGimage = classCGimage+3; 	  	   
										}
										
										if(mouseDistance<-700&&mouseDistance>=-900){
										classCGimage = classCGimage+4; 	  	   
										}
										
										if(mouseDistance<-900){
										classCGimage = classCGimage+4; 	  	   
										}
										
										// Prüfen ob Slider am Ende oder am Anfang ist
										if(classCGimage<1){classCGimage=1;}
										if(classCGimage>cg_shown_images){classCGimage=cg_shown_images;}
						   
										
										classCGimage = "cg_image"+classCGimage;
									   
									   $('#cg_actual_slider_class_value').val(classCGimage);
									   
										// Echte ID wird vergeben 
										var real_picture_id = $("img."+classCGimage).attr("id");
										real_picture_id = parseInt(real_picture_id.substr(11));	
										$('#cg_actual_slider_img_id').val(real_picture_id);
										
										
										// Picture ID crypten und oben einfügen
										  var crypted_picture_id =(real_picture_id+8)*2+100000;
												  document.location.hash = "img"+crypted_picture_id;	
												  
												  
												  
										//var isMobile = false; //initiate as false
										
										
										// device detection, damit elemente beim klicken auf imgContainer nicht verschwinden und rating und comment auf mobile funktionieren
										if(isMobile==false){
											
											 
																			   
									   // Funktion zur Ausführung der Berechnung
									   // !!! SEHR WICHTIG !!! SetTimeOut hat gesetzt zu werden damit click event auf rating und comment div reagiert!!!  
																		   
																		   
											// Prüfen ob nur Klick event war oder Maus auch gehalten wurde			
											var cg_allow_mouse_release = $("#cg_allow_mouse_release").val();  
											
											// Und nur dann schießen, wenn es außerhalb des rating Bereichs losgelassen wurde (release). Ansonsten bedeutet es dass der User geratet hat.

											var containerMouseUp = $("[id*=ratingCGslider]");

											//if (!container.is(e.target) // if the target of the click isn't the container...
											//	&& container.has(e.target).length === 0) // ... nor a descendant of the container
											//{											containerMouseUp.hide();										}
											if(cg_allow_mouse_release==1 && (!containerMouseUp.is(e.target) && containerMouseUp.has(e.target).length === 0)){								  
																		   setTimeout(function(){  cgSliderIMGdistanceCounting(classCGimage,''); }, 20);
											}							   
																		   
										}
									

	  //$( "#imgContainer" ).draggable( "disable" );
			return false;
		
  }
  
return false;

  });

  
  $(document).mouseup(function(e) {
	
	//alert(3);
	   
	var cg_slider_mousedown = $("#cg_slider_mousedown").val();
	

  
 if (cg_slider_mousedown==1){

 var end_x = e.pageX;
  
   $("#cg_x_value_mouseup_e_page").val(end_x);
  var start_x = $("#cg_x_value_mousedown_e_page").val();
   
   var mouseDistance = end_x-start_x;
   
   
 
  $("#cg_slider_mouseup").val(1);
    $("#cg_slider_mousedown").val(0);
	
	

   
   
   
  
								 var classCGimage = $('#cg_actual_slider_class_value').val();
								   
									 classCGimage = parseInt(classCGimage.substr(8));
									 
							// Damit sofort wieder reagiert wenn man nach rechts klickt								
							//	if(classCGimage<1){classCGimage=1;}
									
									// Beim Zug nach rechts wird die Klassen zurück geslidet
									if(mouseDistance>1&&mouseDistance<=300){
									classCGimage = classCGimage-1; 	  	   
								    }
									
									if(mouseDistance>300&&mouseDistance<=500){
									classCGimage = classCGimage-2; 	  	   
								    }
									
									if(mouseDistance>500&&mouseDistance<=700){
									classCGimage = classCGimage-3; 	  	   
								    }
									
									if(mouseDistance>700&&mouseDistance<=900){
									classCGimage = classCGimage-4; 	  	   
								    }
									
									if(mouseDistance>900){
									classCGimage = classCGimage-4; 	  	   
								    }
									
									// Beim Zug nach links wird die Klassen nach vorne geslidet
									if(mouseDistance<-1&&mouseDistance>=-300){
									classCGimage = classCGimage+1; 	  	   
								    }
									
									if(mouseDistance<-300&&mouseDistance>=-500){
									classCGimage = classCGimage+2; 	  	   
								    }
									
									if(mouseDistance<-500&&mouseDistance>=-700){
									classCGimage = classCGimage+3; 	  	   
								    }
									
									if(mouseDistance<-700&&mouseDistance>=-900){
									classCGimage = classCGimage+4; 	  	   
								    }
									
									if(mouseDistance<-900){
									classCGimage = classCGimage+4; 	  	   
								    }
									
									// Prüfen ob Slider am Ende oder am Anfang ist
									if(classCGimage<1){classCGimage=1;}
									if(classCGimage>cg_shown_images){classCGimage=cg_shown_images;}
					   
									
									classCGimage = "cg_image"+classCGimage;
								   
								   $('#cg_actual_slider_class_value').val(classCGimage);
								   
								   	// Echte ID wird vergeben 
									var real_picture_id = $("img."+classCGimage).attr("id");
									real_picture_id = parseInt(real_picture_id.substr(11));	
									$('#cg_actual_slider_img_id').val(real_picture_id);
									
									
									// Picture ID crypten und oben einfügen
									  var crypted_picture_id =(real_picture_id+8)*2+100000;
									  		  document.location.hash = "img"+crypted_picture_id;	
								   
								   // Funktion zur Ausführung der Berechnung
								   
								 cgSliderIMGdistanceCounting(classCGimage,'');
								 // Achtung am Anfang wird move gezeigt! Ist Am Anfang der Datei definiert.
  $('#imgContainer').css("cursor","move"); 
  //$( "#imgContainer" ).draggable( "disable" );
      	return false;
		
  }

  });
  
*/

//---------------------- Mousedown Mouseup Events für Image Container --- ENDE --------------------------------
//----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------




	

	
	// DRAGGABLE HIER!!!!
	
	function draggableElement(){
		//alert(1);
		
		
	  var cg_slider_mousedown = $("#cg_slider_mousedown").val();
  
  if (cg_slider_mousedown==1){	
		
		
		
		
		
	$( "#imgContainer" ).draggable({axis: "x",  drag: function( event, ui ) {
 
    // Keep the left edge of the element
    // at least 100 pixels from the container (accept only left!)
  //  ui.position.left = Math.min( 100, ui.position.left );   
  
  // Variable wird oben am Anfang bestimmt


  // Animation muss gestopt werden falls gerade in eine bestimmte Richtugn ein Slide erfolgt.
  $( "#imgContainer" ).stop();
  
 var cg_slider_position = $( "#imgContainer" ).position();
 var cg_slider_position_left = cg_slider_position.left;
 

 
 var widthCGoverlay = $(window).width();   
 var widthIMGcontainer = $('#imgContainer').width();
 var widthIMGcontainerMinus = parseInt("-"+widthIMGcontainer);
var cg_max_slider_left_position = widthCGoverlay-widthCGoverlay/3;
var cg_max_slider_right_position = widthIMGcontainerMinus+widthCGoverlay/3;


 var allCGimages = $('.show').length;
 
 var avarageCGdivWidth = widthIMGcontainer/allCGimages;
 
 var actualIMGid = (Math.round(cg_slider_position_left/avarageCGdivWidth)*(-1))+1;
 
 

  
 
 
 	 // $( "#imgContainer" ).animate({ left: 100}, 400 );
 
 
   if(actualIMGid<2){
	
$("#cg_slider_arrow_left").hide();
	 
 }
 
 else{
	 
$("#cg_slider_arrow_left").show();	 
	 
 }
 
 if(actualIMGid>=allCGimages ){
	
$("#cg_slider_arrow_right").hide();
	 
 }
 
 if(actualIMGid<allCGimages && $('#imgContainer').is(':visible')){
	 
$("#cg_slider_arrow_right").show();	 

	 
 }
 
 								   

  
 
 if(actualIMGid < 1){
	 
	 // Echte ID wird vergeben
	 	  var real_picture_id = $('.cg_image1').attr("id");
		   real_picture_id = parseInt(real_picture_id.substr(11));	
		   $('#cg_actual_slider_img_id').val(real_picture_id);
		   
				// Picture ID crypten und oben einfügen
		  var crypted_picture_id =(real_picture_id+8)*2+100000;
		  document.location.hash = "img"+crypted_picture_id;	
	  
	 
	 // ID 1 bis x für Slider zur Orientierung wird vergeben
	 actualIMGid = "cg_image"+1;									   

	  $('#cg_actual_slider_class_value').val(actualIMGid);

	  

	  
	 
	  
	  
 }
 
  else if(actualIMGid > allCGimages){
	  
	  actualIMGid = actualIMGid-1;
	  
	  // Echte ID wird vergeben
	 	  var real_picture_id = $('.cg_image'+actualIMGid).attr("id");
		   real_picture_id = parseInt(real_picture_id.substr(11));	
		  $('#cg_actual_slider_img_id').val(real_picture_id);
		  
				// Picture ID crypten und oben einfügen
		  var crypted_picture_id =(real_picture_id+8)*2+100000;
		  document.location.hash = "img"+crypted_picture_id;	
	 
	 // ID 1 bis x für Slider zur Orientierung wird vergeben
	 actualIMGid = "cg_image"+actualIMGid;
	  $('#cg_actual_slider_class_value').val(actualIMGid);
	  

	  
 }
 
 
 
 else{
	 
	 // Echte ID wird vergeben
	 	  var real_picture_id = $('.cg_image'+actualIMGid).attr("id");
		   real_picture_id = parseInt(real_picture_id.substr(11));	
		   $('#cg_actual_slider_img_id').val(real_picture_id);
		   
		   
			// Picture ID crypten und oben einfügen
	  var crypted_picture_id =(real_picture_id+8)*2+100000;
		  document.location.hash = "img"+crypted_picture_id;	

		   // ID 1 bis x für Slider zur Orientierung wird vergeben
	 actualIMGid = "cg_image"+actualIMGid; 
 $('#cg_actual_slider_class_value').val(actualIMGid);
 

	  

 }
 
 
 


//alert(widthIMGcontainerMinus);
//alert(cg_max_slider_right_position); 

//var cg_first_left_slider = $("#cg_first_left_slider").val(); 


 if(cg_slider_position_left>=cg_max_slider_left_position){
	 


	 $("#cg_overlay").click();


}

 if(cg_slider_position_left<=cg_max_slider_right_position){


	 $("#cg_overlay").click();

	
}


  } });
  
  }
	
}
	
	
	 // Funktion zur Ausführung der Berechnung
	
	//Merke sobald Pfeil oder Bild im Slider geklickt wurde. Geht diese Funktion immer von vorne los!
	  function cgSliderIMGdistanceCounting(CGclickedClass,CGdistanceX){
		  
	var cg_show_hide_info_button = 0;
		  
		  // 2 Varianten!!!!
		  // 1ste: direkter Klick auf ein Image mit einer Klasse 
		  // 2ter: Resize. Übergabe von bereits getaner Verschiebung.
   
   // Ganz wichtig img davor stellen! Input Felder haben zwecks Klick event auch diese Klasse.
//var allCGimages = $('img[class*=cg_image]').length;
var allCGimages = $('.show').length;


	//var classCGimageNumber = parseInt(CGclickedClass.substr(CGclickedClass.length - 1));	
	var classCGimageNumber = parseInt(CGclickedClass.substr(8));	
	
//alert("allCGimages:" +allCGimages);
//alert("allCGimagesShowContainer:" +allCGimagesShowContainer);

   
   var cgCountImages = $('#cg_count').val();

   
   var heightCGoverlay = $(window).height();  
  // var heightIMGcontainer = $("#imgContainer").height();
   var widthCGoverlay = $(window).width(); 

//Vorherige Breite zum Vergleich hernehmen
 var get_widthCGoverlay_old = $("#widthCGoverlay_old").val();   

   var widthBorder = 0;// 2px, jeweils innen und außen
   

   //Relation überprüfen von width height, wird später unten in der Schleife angwendet
   
   var heightDivBox = heightCGoverlay; // 2px, jeweils innen und außen
   var widthDivBox = widthCGoverlay-widthBorder; // 2px, jeweils innen und außen

 //  alert(widthDivBox);
   var cgIMGcontainerRelation = widthDivBox/heightDivBox;
   
   
   // Berechnung des Close Button position (close button befindet sich 30px rechts vom rechten arrow_image)
   var closeButtonPosition = widthCGoverlay-widthCGoverlay/100*3-20;
   
      // Berechnung des Close Button position (close button befindet sich 30px rechts vom rechten arrow_image)
  // var closeButtonCommentsPosition = widthCGoverlay-((widthCGoverlay-800)/2)-60;
   
   // Prüfen ob plz vote oder rating gezeigt werden sollen
   var cg_ip_check = $('#cg_ip_check').val();
   
   // Plz vote language platzhalter
   var cg_plz_vote = $('#cg_plz_vote').val();

   //Zum Anzeigen des GIFs before die Images geladen werden
   var loadingSource = $('#cg_loadingGifSource').val();
   var margin_top_loadingSource = heightCGoverlay/2-12;//-9, damit es soch mittig wie möglich wird, wegen 19px breite und höhe des gifs
   var margin_left_loadingSource = widthCGoverlay/2-12;//-9, damit es soch mittig wie möglich wird, wegen 19px breite und höhe des gifs


  
  //var widthCGimgContainerAggregated = 0;
  
   
  var r = 0;
  var e = 0;
  
  
  var marginLeftSlider = 0;
  var aggregateWholeWidth = 0;
  
  
 var rLeft = classCGimageNumber-2; // Weniger als 2 nicht möglich bei der Logik
 var rRight = classCGimageNumber+2; // Weniger als 2 nicht möglich bei der Logik
 
 //Prüfen ob rechter oder Linker Pfeil geklickt wurde
 //var cg_check_arrow_right_click = $('#cg_check_arrow_right_click').val();
// var cg_check_arrow_left_click = $('#cg_check_arrow_left_click').val();
 
// alert("classCGimageNumber: "+classCGimageNumber);
 
  //alert(classCGimageNumber);
  //Merke sobald Pfeil oder Bild im Slider geklickt wurde. Geht diese Funktion immer von vorne los!
  $( ".show" ).each(function( i ) {
	  
	  r++;
	 
	 cg_show_hide_info_button=0;
	  
	  
	if(rLeft<r && r<=rRight){
	 
	 e++;
	 
		//alert("r: "+r);	
	
	var count_cg_img_box = $(".cg_img_box").length;
	 
	//alert(count_cg_img_box);
	
	// Dies ist notwendige damit die richtige Gesamtwidth entsprechend der Anzahl der Inhaltsboxen geschaffen wird
	if(count_cg_img_box<=6){
	var cg_count_cg_img_box_multiplicator = 1;
	}	
	else{
	var cg_count_cg_img_box_multiplicator = 0;		
	}
	var widthCGimgContainerAggregated = (widthDivBox+widthBorder)*(count_cg_img_box+cg_count_cg_img_box_multiplicator);  
	
	$("#widthCGimgContainerAggregated").val(widthCGimgContainerAggregated);
	
	//alert(widthCGimgContainerAggregated);

	
	// Extra Rechnung für Slider draggable. Wie wenn erstes Bild geklickt wäre.	
	var marginLeftSliderSaveValue = (widthCGoverlay-widthCGimgSliderBox-widthBorder)/2-marginSliderIMGleft;
	$("#cg_first_left_slider").val(marginLeftSliderSaveValue);
	
	if(classCGimageNumber==r){
		
	//alert("classCGimageNumber: "+classCGimageNumber); 
	//alert("r: "+r); 
	
	// r wird oben bestimmt
	//*negative left muss bestimmt werden deswegen -1 
	
	if(r==1){
		
	marginLeftSlider = 0;	
		
	}
	
	else if(r==2){
		
		marginLeftSlider = -1*widthDivBox;
	//	alert("r2: "+marginLeftSlider);
	}
	
	else{
		
		//Ausführen wenn im Slider nach rechts geklickt wurde	
			
		//var r1=rRight-3;
		//if(cg_check_arrow_right_click==1){
		//marginLeftSlider = widthDivBox*(classCGimageNumber)*-1;
		
		
			var cg_check_id_first_img_slider_box = $(".cg_img_box").attr('id');
			//alert(cg_check_id_first_img_slider_box);
			//var classCGimageNumber = parseInt(CGclickedClass.substr(CGclickedClass.length - 1));	
			var cg_check_id_first_img_slider_box = parseInt(cg_check_id_first_img_slider_box.substr(11));
				//alert(cg_check_id_first_img_slider_box);
			marginLeftSlider = widthDivBox*(classCGimageNumber-cg_check_id_first_img_slider_box)*-1;		

	}

		
	}
	
	
	//Hier muss geprüft werden ob outside von Galerie geratet wurde
	var realId = $(this).find('.realId').val();
	var ratingImage = $(this).find(".averageStarsRounded").val();
	var countRatingQuantity = $(this).find("#countRatingQuantity"+realId+"").val();
	var countRatingSQuantity = $(this).find("#countRatingSQuantity"+realId+"").val();
	var countCommentsQuantity = $(this).find("#countCommentsQuantity"+realId+"").val();
	var cg_check_voted = $("#cg_check_voted"+realId+"").val();
	//alert(realId);
	
	//alert(get_widthCGoverlay_old);
	//alert(widthCGoverlay);
	//alert(cg_vote_in_gallery);
	
	if(get_widthCGoverlay_old==widthCGoverlay && cg_vote_in_gallery==1){
	//alert(1);
	// Wenn der Werte Vergleich nicht übereinstimmt dann muss der inhalt des slider rating divs neu geladen werden
	
	var cg_slider_rating_count_value = $("#cg_slider_rating_count_value"+realId+"").val();
	var cg_slider_rating_avarage_value = $("#cg_slider_rating_avarage_value"+realId+"").val();
	
	
	/*
		if(countRatingQuantity>cg_slider_rating_count_value){
		//alert(2);
		//alert(countRatingQuantity);
		//alert(cg_slider_rating_count_value);
		
		
			var starOnUrl = $("#cg_star_on_slider").val();
			var starOffUrl = $("#cg_star_off_slider").val();
			//alert(cg_check_voted);
		
			//if(cg_ip_check!=1 || (cg_ip_check==1 && cg_check_voted==1)){
			if(cg_check_voted==1 || cg_check_voted==2){
				if(ratingImage>=1){var star1url = starOnUrl;}
				else{var star1url = starOffUrl;}
				if(ratingImage>=2){var star2url = starOnUrl;}
				else{var star2url = starOffUrl;}
				if(ratingImage>=3){var star3url = starOnUrl;}
				else{var star3url = starOffUrl;}
				if(ratingImage>=4){var star4url = starOnUrl;}
				else{var star4url = starOffUrl;}
				if(ratingImage>=5){var star5url = starOnUrl;}
				else{var star5url = starOffUrl;}

			var ratingBlock = "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star1url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='1' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star2url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='2' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star3url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='3' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star4url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='4' id='cg_rate_star"+realId+"'></div>"+
			   "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star5url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='5' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;font-size:22px;line-height:22px;color:#fff;padding:0px;margin:0px;' id='rating_cg-"+realId+"' class='rating_cg_slider"+realId+"'><b>&nbsp;("+countRatingQuantity+")</b></div>";
			  
				if(document.readyState === "complete"){ 
					$("#ratingCGslider"+realId+"").empty();
					$("#ratingCGslider"+realId+"").append("<input type='hidden' id='cg_slider_rating_count_value"+realId+"' value='"+countRatingQuantity+"'>"+
					"<input type='hidden' id='cg_slider_rating_avarage_value"+ratingImage+"' value='"+ratingImage+"'>"+			
					""+ratingBlock+""+
					"<input type='hidden' class='cg_real_id' value='"+realId+"'>");
				}

			  
			  			}
			
		}*/

		
	}
	
	
	/*		if($("#cg_img_box_"+r+"").length>0)
		{
			var cg_img_box_not_exists=0;  
		}
		else
		{
			 var cg_img_box_not_exists=1;
			 alert(r);
		}*/
	
	//Prüfen ob die Breite des Fensters sich überhaupt verändert hat, ob Boxen neu auftauchen müssen
	//alert(r);
	if(get_widthCGoverlay_old!=widthCGoverlay || $("#cg_img_box_"+r+"").length==0){
		
		
								var width = $(this).find(".widthOriginalImg").val();
				var height = $(this).find(".heightOriginalImg").val();

				
				var cgIMGsourceRelation = width/height;
				
			//	alert("cgIMGsourceRelation: "+cgIMGsourceRelation);
			//	alert("cgIMGcontainerRelation: "+cgIMGcontainerRelation);
				
				// hochformatigere Bilder
				if(cgIMGsourceRelation<cgIMGcontainerRelation){
					
						var newHeightSrc = heightDivBox;
				var newHeightSrcPercentage = heightDivBox/height;
					
				var newWidthSrc	= width*newHeightSrcPercentage;	
				
				var widthCGimgSliderBox = newWidthSrc;
				
				//alert(widthDivBox);
				//alert(newWidthSrc);
				
				var marginSliderIMGleft = (widthDivBox-newWidthSrc)/2;
				//	alert(marginSliderIMGleft);
					
				//	alert("Height relation "+r);
				}
				
				// breitformatigere Bilder
				if(cgIMGsourceRelation>=cgIMGcontainerRelation){
					
							
				//var newWidthSrc = widthDivBox;
				//var newWidthSrcPercentage = widthDivBox*100/width;
					
				//var newHeightSrc = height*newWidthSrcPercentage;	
				
				var widthCGimgSliderBox = widthDivBox;
				
				var marginSliderIMGleft = 0;
				
				
				var heightIMGdivBox = widthDivBox*height/width;
				
				var paddingTop = (heightDivBox-heightIMGdivBox)/2;
				
				//alert(heightIMGdivBox);

				
				//alert("Width relation "+r);
					
					//alert(newWidthSrc);
				}	
		
		
	// Options relevante Werte	
		//eventuell alles nach diesem Height anpassen? 
	//  alert(heightCGimgBox);
	

		// alert(cg_pngCommentsIconImg);
		 
		 var srcOriginalImg = $(this).find('.srcOriginalImg').val();
		// alert(srcOriginalImg);
	 var src1920width = $(this).find('.src1920width').val();
	 var src1600width = $(this).find('.src1600width').val();
	 var src1024width = $(this).find('.src1024width').val();
	 var src624width = $(this).find('.src624width').val();
	 var src300width = $(this).find('.src300width').val();
	//  var hrefCGpic = $(this).find('.hrefCGpic').val();
	  

	

	var urlForFacebook = $(this).find(".urlForFacebook").val();
	

	
	//Prüf ob wenn Hide Until Vote an ist schon gewotet wurde oder nicht
	//var cg_check_voted = $(this).find(".cg_hide").find(".cg_check_voted").val();

//	alert(cg_check_voted);	
		
		
	// Options relevante Werte	--- ENDE	
		
		
		
	
	// id's einfügen

	var cg_img_box_id = "cg_img_box_"+r;
	
	if ($("#"+cg_img_box_id+"").length > 0){
	$("#"+cg_img_box_id+"").remove();
	}	
	
	// Abstand bestimmen von rating und comments div und url div
	
	var marginLeftCGratingSlider = marginSliderIMGleft+37;
	// +150 als breite von Rationg div und + 30 Abstand
	var marginLeftCGcommentsSlider = marginSliderIMGleft+37;	
	var marginLeftcgFacebookDiv = marginSliderIMGleft+37;	
	
	
	if (typeof paddingTop == 'undefined') {		

	var paddingTop = 0;

			if(cg_Use_as_URL==1){
				
				if(cg_allow_comments==1 && cg_FbLike==1 && (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomUrlDiv = 135;}
				else if(cg_FbLike==1 && (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomUrlDiv = 100;}
				else if(cg_FbLike==1 &&  cg_allow_comments==1){var marginBottomUrlDiv = 100;}
				else if(cg_allow_comments==1 &&  (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomUrlDiv = 100;}
				else if(cg_allow_comments==1 ||  (cg_allow_rating==1 || cg_allow_rating==2) ||  cg_FbLike==1){var marginBottomUrlDiv = 100;}
				else { var marginBottomUrlDiv = 30;	}// Wenn die anderen praktisch ausgeschaltet sind

			}

			if(cg_allow_comments==1){	
			
						
				if(cg_FbLike==1 && (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomCGcommentsSlider = 100;}
				else if(cg_FbLike==1 ||  (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomCGcommentsSlider = 65;}
				else { var marginBottomCGcommentsSlider = 30;	}// Wenn die anderen praktisch ausgeschaltet sind
				
				
			}
		
		
			if(cg_allow_comments==1){	
			
						
				if(cg_FbLike==1 && (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomCGcommentsSlider = 100;}
				else if(cg_FbLike==1 ||  (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomCGcommentsSlider = 65;}
				else { var marginBottomCGcommentsSlider = 30;	}// Wenn die anderen praktisch ausgeschaltet sind
				
				
			}
			
			if(cg_allow_rating==1 || cg_allow_rating==2){	
			
						
				if(cg_FbLike==1 && cg_allow_comments==1){var marginBottomCGratingSlider = 65;}
				else{
				if(cg_FbLike==1 ||  cg_allow_comments!=1){var marginBottomCGratingSlider = 65;}
				else if(cg_allow_comments=1 || cg_FbLike!=1){var marginBottomCGratingSlider = 30;}
				else {var marginBottomCGratingSlider = 30;	}// Wenn die anderen praktisch ausgeschaltet sind
				}
				
			}
			
			if(cg_FbLike==1){	
			
						
				var marginBottomcgFacebookDiv = 30;	// Diese Div ist immer ganz unten
				
				
			}	
		
	}
		
	else {
		
			if(cg_Use_as_URL==1){
				
				if(cg_allow_comments==1 && cg_FbLike==1 && (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomUrlDiv = paddingTop+135;}
				else if(cg_FbLike==1 && (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomUrlDiv = paddingTop+100;}
				else if(cg_FbLike==1 &&  cg_allow_comments==1){var marginBottomUrlDiv = paddingTop+100;}
				else if(cg_allow_comments==1 && (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomUrlDiv = paddingTop+100;}
				else if(cg_allow_comments==1 || (cg_allow_rating==1 || cg_allow_rating==2) ||  cg_FbLike==1){var marginBottomUrlDiv = paddingTop+100;}
				else { var marginBottomUrlDiv = paddingTop+30;	}// Wenn die anderen praktisch ausgeschaltet sind

			}
		
		
		
			if(cg_allow_comments==1){	
			
						
				if(cg_FbLike==1 && (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomCGcommentsSlider = paddingTop+100;}
				else if(cg_FbLike==1 || (cg_allow_rating==1 || cg_allow_rating==2)){var marginBottomCGcommentsSlider = paddingTop+65;}
				else { var marginBottomCGcommentsSlider = paddingTop+30;	}// Wenn die anderen praktisch ausgeschaltet sind
				
				
			}
			
			if(cg_allow_rating==1 || cg_allow_rating==2){	
			
						
				if(cg_FbLike==1 && cg_allow_comments==1){var marginBottomCGratingSlider = paddingTop+65;}
				else{
				if(cg_FbLike==1 ||  cg_allow_comments!=1){var marginBottomCGratingSlider = paddingTop+65;}
				else if(cg_allow_comments=1 || cg_FbLike!=1){var marginBottomCGratingSlider = paddingTop+30;}
				else {var marginBottomCGratingSlider = paddingTop+30;	}// Wenn die anderen praktisch ausgeschaltet sind
				}
				
			}
			
			if(cg_FbLike==1){
			
						
				var marginBottomcgFacebookDiv = paddingTop+30;	// Diese Div ist immer ganz unten
				
				
			}

		
		
		}
		
		// Hide Info Abstand nach Links
		var marginLeftHideInfoDivSlider = marginSliderIMGleft;
		var marginBottomHideInfoDivSlider = paddingTop;
		
	
	// Abstand bestimmen von rating div --- ENDE
	
	
	
	//URL div bestimmen ob angezeigt werden soll oder nicht
	
			
	// Prüfen ob überhaupt eine URL eingetragen wurde	  	
	var cg_img_url_entry_slider = $("#cg_img_url"+realId+"").val();
	//alert(cg_img_url_entry_slider);
	
	//alert(cg_Use_as_URL);
	//alert(cg_ForwardToURL); 
	//alert(cg_ForwardFrom);
	//alert(cg_img_url_entry_slider);
	
	
	if(cg_Use_as_URL==1 && cg_ForwardToURL==1 && cg_ForwardFrom==1 && cg_img_url_entry_slider){
		

		//Prüfen ob vom user ein http bei entries der url mit eingetragen wurde, wenn nicht dann hinzufügen
		if (typeof cg_img_url_entry_slider === 'undefined') { }
		else if(cg_img_url_entry_slider.indexOf("http") > -1) { cg_img_url_entry_slider = cg_img_url_entry_slider; }	
		else{ cg_img_url_entry_slider = "http://"+cg_img_url_entry_slider}
		
		
		 var cg_a_href_img = "href='"+cg_img_url_entry_slider+"'";
		
		
		// Prüfung auf welche Art weitergeleitet werden soll
		if(cg_ForwardType==2){var targetStyle = "target = '_blank'";}
		else{var targetStyle = "";}		
		
		
		
		var marginLeftUrlDiv = marginSliderIMGleft+37+150+30+90;

		var urlDiv = "<div class='cg_url_slider_div' id='cg_url_slider_div"+realId+"' style='margin-left:"+marginLeftCGratingSlider+"px;margin-bottom:"+marginBottomUrlDiv+"px !important;background: rgba(0, 0, 0, 0.8);width:21px;height:21px;'>"+
					 "<a href='"+cg_img_url_entry_slider+"' "+targetStyle+" ><img src='"+cg_pngUrlIconImg+"'></a></div>";
		
		cg_show_hide_info_button = 1;
		
		}
	
		else{
		
		var urlDiv = "";	
			
		}
	
	
	
	//URL div bestimmen ob angezeigt werden soll oder nicht --- ENDE
	
	
	
	// Rating bestimmen	
	
	// cg_allow_rating wird am Anfang der Datei bestimmt
	
	//alert("cg_allow_rating: "+cg_allow_rating);
	//alert("cg_check_voted: "+cg_check_voted);
	//alert("ratingImage: "+ratingImage);
	if(cg_allow_rating==1){
	
			var starOnUrl = $("#cg_star_on_slider").val();
			var starOffUrl = $("#cg_star_off_slider").val();
			
			//if(cg_ip_check!=1 || (cg_ip_check==1 && cg_check_voted==1)){
			if(cg_check_voted==1 || cg_check_voted==2){
				if(ratingImage>=1){var star1url = starOnUrl;}
				else{var star1url = starOffUrl;}
				if(ratingImage>=2){var star2url = starOnUrl;}
				else{var star2url = starOffUrl;}
				if(ratingImage>=3){var star3url = starOnUrl;}
				else{var star3url = starOffUrl;}
				if(ratingImage>=4){var star4url = starOnUrl;}
				else{var star4url = starOffUrl;}
				if(ratingImage>=5){var star5url = starOnUrl;}
				else{var star5url = starOffUrl;}

			var ratingBlock = "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star1url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='1' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star2url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='2' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star3url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='3' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star4url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='4' id='cg_rate_star"+realId+"'></div>"+
			   "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star5url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='5' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;font-size:22px;line-height:22px;color:#fff;padding:0px;margin:0px;' id='rating_cg-"+realId+"' class='rating_cg_slider"+realId+"'><b>&nbsp;("+countRatingQuantity+")</b></div>";
			 //alert(ratingBlock);
			  var ratingDivStyle = "";
			  
			 
			  
			}
			
			else if(cg_ip_check==1 && cg_check_voted==0){
			var ratingBlock = "<div id='cg_plz_vote"+realId+"'><u>"+cg_plz_vote+"...</u></div>";
			var ratingDivStyle = "width:150px;color:#fff;font-size:21px;vertical-align: middle;line-height: 21px;cursor:pointer;";
			}			
			
			
			// Rating bestimmen --- ENDE
			
			// Rating div kreieren
			
			var ratingDIV = "<div id='ratingCGslider"+realId+"' class='ratingCGslider' style='margin-left:"+marginLeftCGratingSlider+"px;margin-bottom:"+marginBottomCGratingSlider+"px !important;background: rgba(0, 0, 0, 0.8);"+ratingDivStyle+"'>"+
				"<input type='hidden' id='cg_slider_rating_count_value"+realId+"' value='"+countRatingQuantity+"'>"+
				"<input type='hidden' id='cg_slider_rating_avarage_value"+realId+"' value='"+ratingImage+"'>"+
			  ratingBlock+
			  "<input type='hidden' class='cg_real_id' value='"+realId+"'>"+
			  "</div>";
			// Rating div kreieren --- ENDE 
			
			cg_show_hide_info_button = 1;
	
	}
	
	else if(cg_allow_rating==2){
	
			var starOnUrl = $("#cg_star_on_slider").val();
			var starOffUrl = $("#cg_star_off_slider").val();
			
			//if(cg_ip_check!=1 || (cg_ip_check==1 && cg_check_voted==1)){
			if(cg_check_voted==1 || cg_check_voted==2){
				if(countRatingSQuantity>0){var star6url = starOnUrl;}
				else{var star6url = starOffUrl;}

			var ratingBlock = "<div style='display:inline-block;float:left;vertical-align: middle;'><img src='"+star6url+"' class='cg_slider_star' style='float:left;cursor:pointer;width:21px;height:21px;' alt='6' id='cg_rate_star"+realId+"'></div>"+
			  "<div style='display:inline-block;float:left;font-size:22px;line-height:22px;color:#fff;padding:0px;margin:0px;' id='rating_cg-"+realId+"' class='rating_cg_slider"+realId+"'><b>&nbsp;("+countRatingSQuantity+")</b></div>";
			 //alert(ratingBlock);
			  var ratingDivStyle = "";
		//	  alert(ratingBlock);
			}
			
			else if(cg_ip_check==1 && cg_check_voted==0){
				
			var ratingBlock = "<div id='cg_plz_vote"+realId+"'><u>"+cg_plz_vote+"...</u></div>";
			var ratingDivStyle = "width:150px;color:#fff;font-size:21px;vertical-align: middle;line-height: 21px;cursor:pointer;";
			}
			
			
			
			// Rating bestimmen --- ENDE
			
			// Rating div kreieren
			
			var ratingDIV = "<div id='ratingCGslider"+realId+"' class='ratingCGslider' style='margin-left:"+marginLeftCGratingSlider+"px;margin-bottom:"+marginBottomCGratingSlider+"px !important;background: rgba(0, 0, 0, 0.8);"+ratingDivStyle+"'>"+
				"<input type='hidden' id='cg_slider_rating_count_value"+realId+"' value='"+countRatingSQuantity+"'>"+
				"<input type='hidden' id='cg_slider_rating_avarage_value"+realId+"' value='"+countRatingSQuantity+"'>"+
			  ratingBlock+
			  "<input type='hidden' class='cg_real_id' value='"+realId+"'>"+
			  "</div>";
			// Rating div kreieren --- ENDE  
			
			cg_show_hide_info_button = 1;
	
	}
	
	else{	
			ratingDIV = "";		
	}
	
	
	// cg_allow_comments wird am Anfang der Datei bestimmt
	if(cg_allow_comments==1){ 
	  	var commentsDIV = "<div id='commentsCGslider"+realId+"' class='ratingCGslider' style='margin-left:"+marginLeftCGcommentsSlider+"px;margin-bottom:"+marginBottomCGcommentsSlider+"px !important;background: rgba(0, 0, 0, 0.8);'>"+
		"<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;' class='cg_commentsIcon_div'><img src='"+cg_pngCommentsIconImg+"' id='cg_pngCommentsIcon"+realId+"' style='float:left;cursor:pointer;' alt='"+realId+"'>"+
		"<input type='hidden' class='countCommentsQuantity' value='"+countCommentsQuantity+"'></div>"+
		"<div style='display:inline-block;float:left;font-size:22px;line-height: 22px;color:#fff;padding:0px;margin:0px;' class='comments_cg_slider"+realId+"'><b>&nbsp;("+countCommentsQuantity+")</b></div>"+		
		"<input type='hidden' id='cg_slider_comment_real_id' value='"+realId+"' >"+		
	  "</div>";
	  
	  cg_show_hide_info_button = 1;
  
	}
	
		else{
		
			commentsDIV = "";
		
	}
	
	
	
	
	// User input div kreieren
	
	//if(typeof cg_user_input == 'undefined'){
//	var cg_user_input = $(this).find("p").html();
  //  alert(cg_user_input);	
	if ($(this).find("p").length == 0){
	var userInputDiv = '';		
	var cg_ShowMeUserInfoOnLeftMouseHold = '';		
	//alert(1);
	
	var cg_ShowAlwaysInfoSliderDisplay = "display:none";
	
	
	}
	
	else{
		
	// Hier erfolgt die Prüfung ob überhaupt irgendwelche Info in dem Fled ist. In der PHP Datei erfolgt die Prüfung der einzelnen eingegebenen values.
	var cg_user_input = $(this).find(".cg_user_input").html();
	var cg_user_input_height = $(this).find(".cg_user_input").height();
	cg_user_input_height = cg_user_input_height-16;	
	
	//User info zeigen, welches versteckt ist in php  
   
   // if(cg_ShowAlwaysInfoSlider==1){var cg_ShowAlwaysInfoSliderDisplay = "display:block";}
//	else{var cg_ShowAlwaysInfoSliderDisplay = "display:none";}

	var cg_ShowAlwaysInfoSliderDisplay = "display:block";
   
   //User info zeigen, welches versteckt ist in php --- ENDE	
		
	//if(cg_user_input==false){}
	//else{cg_ShowAlwaysInfoSliderDisplay}
		
	var userInputDiv = "<div  id='cg_user_input"+realId+"' style='padding-bottom:20px;"+cg_ShowAlwaysInfoSliderDisplay+";font-size:21px;color:#fff;top:0px;background-color:#000;position:absolute;opacity:0.8;width:"+widthCGimgSliderBox+"px;'>"+cg_user_input+"</div>";
	var cg_ShowMeUserInfoOnLeftMouseHold = $("#cg_ShowMeUserInfoOnLeftMouseHold").val();
	
	cg_show_hide_info_button = 1;
	
		if(cg_ShowAlwaysInfoSlider!=1){
			cg_ShowMeUserInfoOnLeftMouseHold = "title='"+cg_ShowMeUserInfoOnLeftMouseHold+"'";
		}
		else{cg_ShowMeUserInfoOnLeftMouseHold = "";}

	}
	// User input div kreieren --- ENDE
	
	// Fb Like Div kreireren
		
	if(cg_FbLike==1){ 
	  
	 // var marginLeftcgFacebookDiv = marginLeftCGcommentsSlider+100;
	 // var marginBottomcgFacebookDiv = marginBottomCGcommentsSlider+300;
	  
	//  var cg_fb_like_div = $("#cg_fb_like_div"+realId+"").html();
	  
	  var cgFacebookDivSlider = "<div id='cgFacebookDiv"+realId+"' class='cgFacebookDiv' style='margin-left:"+marginLeftcgFacebookDiv+"px;margin-bottom:"+marginBottomcgFacebookDiv+"px !important;background: rgba(0, 0, 0, 0.8);width:155px;height:30px;overflow:hidden;'>"+
	   //""+cg_fb_like_div+""+
	   "<iframe src='"+urlForFacebook+"'  style='border:none;width:180px;height:50px;overflow:hidden;margin-top:5px;' scrolling='no' id='cg_fb_like_iframe_gallery"+realId+"'  name='cg_fb_like_iframe_gallery"+realId+"'></iframe>"+
	   "</div>";
	   
	   cg_show_hide_info_button = 1;
	  
	}
	
	else{
		
			cgFacebookDivSlider = "";
		
	}
	
	
	
	// Fb Like Div kreireren --- ENDE
	
	
	if(cg_show_hide_info_button==1){
	// Hide Info Div
	
		var cg_hide_info_div = "<div class='cg_hide_info_div_yes' id='cg_hide_info_div"+realId+"' style='margin-left:"+marginLeftHideInfoDivSlider+"px;margin-bottom:"+marginBottomHideInfoDivSlider+"px;background: rgba(0, 0, 0, 0.8);"+
								"background-image:url("+cg_show_info_png+");background-position:center;background-repeat:no-repeat;width:21px;height:21px;'></div>";
								//"<img class='cg_hide_info_img' src='"+cg_hide_info_png+"' style='padding:0px !important;margin: 0px !important;'></div>";	
	
	// Hide Info Div --- ENDE
	}
	else{
		var cg_hide_info_div = '';
		
	}
	
	
	
	
	
	
	
	
	
	
	var r1 = r+1;
	
	if ($("#cg_img_box_"+r1+"").length>0){
		
		//alert(0);
					if(widthCGimgSliderBox<=300){//alert("300");
				$("#imgContainer").prepend("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src300width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
			"</div>"+
			"</div>");}
			else if(widthCGimgSliderBox<=624){//alert("624");
				$("#imgContainer").prepend("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src624width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
			"</div>");}
			else if(widthCGimgSliderBox<=1100){//alert("1024"); Puffer bis 1100 ist gegeben
				$("#imgContainer").prepend("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src1024width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
			"</div>");}
			else if(widthCGimgSliderBox<=1700){//alert("origin");
					
					if(src1600width==0){src1600width = srcOriginalImg;}
					//alert(src1600width);
					
				$("#imgContainer").prepend("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src1600width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
				"</div>"+
			"</div>");
			
			}
			
			else if(widthCGimgSliderBox<=2120){//alert("origin");//Puffer bis 2120 ist gegeben von 1920 aus
			
					if(src1920width==0){src1920width = srcOriginalImg;}
	//alert(src1920width);
				$("#imgContainer").prepend("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src1920width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
				"</div>"+
			"</div>");
			
			}
			
			else if(widthCGimgSliderBox>2120){//alert("origin");//Puffer von 200px noch erlaubt, damit nicht zu große Bilder geladen werden
				$("#imgContainer").prepend("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+srcOriginalImg+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
				"</div>"+
			"</div>");
			
			}
		
		
		
	}
	

	else {

			if(widthCGimgSliderBox<=300){//alert("300");
				$("#imgContainer").append("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src300width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
			"</div>"+
			"</div>");}
			else if(widthCGimgSliderBox<=624){//alert("624");
				$("#imgContainer").append("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src624width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
			"</div>");}
			else if(widthCGimgSliderBox<=1100){//alert("1024"); Puffer bis 1100 ist gegeben
				$("#imgContainer").append("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src1024width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
			"</div>");}
			else if(widthCGimgSliderBox<=1700){//alert("origin");
					
					if(src1600width==0){src1600width = srcOriginalImg;}
					//alert(src1600width);
					
				$("#imgContainer").append("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src1600width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
				"</div>"+
			"</div>");
			
			}
			
			else if(widthCGimgSliderBox<=2120){//alert("origin");//Puffer bis 2120 ist gegeben von 1920 aus
			
					if(src1920width==0){src1920width = srcOriginalImg;}
	//alert(src1920width);
				$("#imgContainer").append("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+src1920width+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
				"</div>"+
			"</div>");
			
			}
			
			else if(widthCGimgSliderBox>2120){//alert("origin");//Puffer von 200px noch erlaubt, damit nicht zu große Bilder geladen werden
				$("#imgContainer").append("<div style='width:"+widthDivBox+"px;' class='cg_img_box' id='"+cg_img_box_id+"'>"+
				"<img  class='cg_loading_gif_img' id='cg_loading_gif_img_"+realId+"'  src='"+loadingSource+"' width='24px' height='24px' style='z-index:1000006;position:absolute;margin-left:"+margin_left_loadingSource+"px;margin-top:"+margin_top_loadingSource+"px;display:inline;width:19px !important;height:19px !important;'>"+
				""+ratingDIV+""+
				""+commentsDIV+""+
				""+cgFacebookDivSlider+""+
				""+urlDiv+""+
				""+cg_hide_info_div+""+
			// $("#show_comments_slider").append("<img class='cg_loading_gif_img' id='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
			// $("#rating_cg").empty(); 
			//$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
						"<div style='padding-left:"+marginSliderIMGleft+"px;padding-top:"+paddingTop+"px;' class='cg_slider_image_div' width='"+widthCGimgSliderBox+"px'>"+
			"<img "+cg_ShowMeUserInfoOnLeftMouseHold+" src='"+srcOriginalImg+"' width='"+widthCGimgSliderBox+"px' class='cg_slider_image' id='cg_slider_image_"+realId+"' style='visibility:hidden;' />"+
			""+userInputDiv+""+
				"</div>"+
			"</div>");
			
			}
		
	}
		
		//$("#cg_slider_image"+realId).load(function(){$(this).toggle();});
	//	$(".cg_slider_image").load(function(){$(this).show();});   

	//	$("#cg_slider_image_"+realId).load(function(){$("#cg_loading_gif_img_"+realId).display("visibility","hidden");});
				$('#cg_slider_image_'+realId).on('load', function(){
  // hide/remove the loading image
  $("#cg_loading_gif_img_"+realId).hide();
  $(this).css("visibility","visible");
});
	  }
	 
/*	 
if(r==cgCountImages){
	
$("#cg_sliderDOMloaded").val(1);	
$('#cg_leftPositionImgContainer').val(marginLeftSlider);
	
}*/
	}
	  
	  });
	  
	  //  alert(r);
	  
	 
	 // falls CGdistanceX übergeben wurde dann ist marginLeftSlider ein anderer

	// if (CGdistanceX){
		 
//	marginLeftSlider = CGdistanceX;
		 
	// }

	  
	
	  
	  //alert(widthCGimgContainerAggregated);
	  

	    	//   $('div#imgContainer').css('width', widthCGimgContainerAggregated);
			//   	 $('div#imgContainer').css('left', marginLeftSlider);
	 //  $('div#imgContainer').css('height', '80%');
	 
	 
	 
	 // Close button ist immer in der selben Poistion
	 
//	 $('div#close_slider_button').css('left', "0px");
	 
	 // Close button comments ist immer in der selben Poistion
	// $('div#close_slider_comments_button').css('left', closeButtonCommentsPosition);
	 
	 
	 // Check if function was done after resizing
	 
	 var cg_slider_resize = $('#cg_slider_resize').val();
	 
	 var widthCGimgContainerAggregated = $("#widthCGimgContainerAggregated").val();
	//alert(widthCGimgContainerAggregated);
	 
	 
	 if(cg_slider_resize==1){	 
	 
	$('#cg_slider_resize').val(0);	 
	
	 $('div#imgContainer').css('width', widthCGimgContainerAggregated);
$('div#imgContainer').css('left', marginLeftSlider);	 
		 
	 }

	/* else{
	  $( "#imgContainer" ).animate({
    width: widthCGimgContainerAggregated,
    left: marginLeftSlider}, 400 );
	
	 }*/
	 
	 $( "#imgContainer" ).css("width",widthCGimgContainerAggregated);
	 $( "#imgContainer" ).css("left",marginLeftSlider);
	
	//alert(classCGimageNumber); 
	//alert(allCGimages); 
  //alert(isMobile);
 if(classCGimageNumber<2){
	
$("#cg_slider_arrow_left").hide();
	 
 }
 

else{
	
	if(isMobile!=true){
	$("#cg_slider_arrow_left").show();
	}
	 
 }
 
 if(classCGimageNumber>=allCGimages ){
	
$("#cg_slider_arrow_right").hide();
	 
 }
 
 else{
	 if(isMobile!=true){
$("#cg_slider_arrow_right").show();	 
	 }
 }
 
 var real_picture_id = parseInt($(".cg_image"+classCGimageNumber).attr("data-cg_image_id"));
 var crypted_picture_id =(real_picture_id+8)*2+100000;
document.location.hash = "img"+crypted_picture_id;	
 
 
 $("#widthCGoverlay_old").val(widthCGoverlay);
 
 
//Pfeile Klicks werden wieder zurückgesetzt
//$('#cg_check_arrow_right_click').val(0);
//$('#cg_check_arrow_left_click').val(0);

return false;

	 
	   }
	   
	   
	   // Funktion zur Ausführung der Berechnung --- ENDE
	   
	   
	 
	   
	   
	   
	    // Funktion zur Ausführung der Berechnung --- ENDE
	





// Show/Zeige ImgContainer für Slider   


		// Wenn Picture ID Parameter mitgeschickt wird und gallery Script aktiviert ist
		
		
		// Zum Testen: https://www.contest-gallery.com/test-cg-1/?picture_id=100752#cg-begin

		// 1. Picture ID herausfiltern, ob mit # oder ohne geschickt wird
		// 2. Prüfen ob die mitgesendet ID aktiviert ist und an welchem Platz sich diese in der Reihenfolge befindet
		// 3. Sollte die ID auf einer Seite weiterhinten sein muss an diese weitergeleitet werden
		// 4. Click ID
		
		
		// Aktion wird aus geführt wenn User z.B. aus Ihren Bestätigungsmails klicken
		
			if(window.location.href.indexOf("?picture_id=") > -1) {
			//	alert(4);
					// 1. Picture ID herausfiltern, ob mit # oder ohne geschickt wird
							
					// Prüfung einbauen ob Raute beinhaltet! Und ohne Raute Verarbeitung auch einbauen.
					var site_str = window.location.href;
					//alert(test_str);
					var start_pos = site_str.indexOf('picture_id=') + 11;//+11 weil immer der erste buchstabe des searchvalue als position gilt
					//alert(start_pos);

					
					if(site_str.indexOf('#') === -1){
						//alert("no");
						var picture_id_to_get = parseInt(site_str.substring(start_pos));	
						
					}
					
					else{
						//alert("yes");
						var end_pos = site_str.indexOf('#',start_pos);
						var picture_id_to_get = parseInt(site_str.substring(start_pos,end_pos));	
						//alert(picture_id_to_get);
					}

					//alert(picture_id_to_get);

					var realImgId = parseInt((picture_id_to_get-100000)/2-8);
					
					//alert(realImgId);
					if ( $( "#cg_check_all_acitvated_ids"+realImgId ).length ) {
						
					// 2. Prüfen ob die mitgesendet ID aktiviert ist und an welchem Platz sich diese in der Reihenfolge befindet
			  // alert(realImgId);
					var r=0;
					  $( ".cg_check_all_acitvated_images" ).each(function( i ) {
						  
						  r++;
						  
						  var check_id = $(this).val();
						  check_id = parseInt(check_id);
						  //alert(check_id);
						  
						  if(check_id==realImgId){
							//alert(4);  
							  return false;
							  
						  }
						  
						  
						});
					
					// Maximale Anzahl der Bilder die angezeigt wird pro Gallerie Ansicht					
					var check_step = $("#cg_step").val();
					//alert(r);alert(check_step);
					var quotient = r/check_step;
					
					var floorQuotioent = Math.floor(quotient);
					
					var check_step_on_site = check_step*floorQuotioent;
					
				//alert(quotient);
					
					// 3. Sollte die ID auf einer Seite weiterhinten sein muss an diese weitergeleitet werden
					
							if(quotient>1){
							//	alert(1);
								quotient = Math.floor(quotient);							
								var step = quotient * check_step;
								
								var site_url = $("#cg_siteURL").val();
								
								var look = $("#cg_look").val();
								if(look=="thumb"){look=1;}
								else if(look=="height"){look=2;}
								else if(look=="row"){look=3;}
								else{look=1;}
								
								var order = $("#cg_order").val();
								if(order=="desc"){order=1;}
								else if(order=="asc"){order=2;}
								else{order=1;}
							
							
								// Zwei Varianten von Seiten Urls sind möglich: mit und ohne ?									
								if(site_url.indexOf('?') === -1)
								{
								window.location.href = site_url+"?1="+look+"&2="+order+"&3="+check_step_on_site+"#img"+picture_id_to_get;
								}
								else{
									
								window.location.href = site_url+"&1="+look+"&2="+order+"&3="+check_step_on_site+"#img"+picture_id_to_get;
									
								}

								
							}
							
							// 4. Click ID
							else{
								
								//alert(2);
								
								
							var class_of_element = $("#cg_image_id"+realImgId).attr("class");

							$("."+class_of_element+"").load(function(){$(this).click();});
							
							//https://www.contest-gallery.com/test-cg-1/?picture_id=100752#cg-begin	 
								
								
								
							}
					
					}
					
					else{
						
					return false;
						
					}
					
					


			   
			}
			
			// Aktion wird aus geführt wenn User z.B. aus Ihren Bestätigungsmails klicken
			
			// Aktion wird ausgeführt User URLs dieser Art teilen #img
			
					
				else if (window.location.href.indexOf("#img") > -1) {
			//	alert(3);
					// 1. Picture ID herausfiltern, ob mit # oder ohne geschickt wird
							
					// Prüfung einbauen ob Raute beinhaltet! Und ohne Raute Verarbeitung auch einbauen.
					var site_str = window.location.href;
					//alert(test_str);
					var start_pos = site_str.indexOf('#img') + 4;//+11 weil immer der erste buchstabe des searchvalue als position gilt
					//alert(start_pos);

					var picture_id_to_get = parseInt(site_str.substring(start_pos));
					//alert(picture_id_to_get);


					//alert(picture_id_to_get);
				//	alert(picture_id_to_get);
					var realImgId = parseInt((picture_id_to_get-100000)/2-8);
					//alert(realImgId);
					
					if ( $( "#cg_check_all_acitvated_ids"+realImgId ).length ) {
						
					// 2. Prüfen ob die mitgesendet ID aktiviert ist und an welchem Platz sich diese in der Reihenfolge befindet
			  // alert(realImgId);
					var r=0;
					  $( ".cg_check_all_acitvated_images" ).each(function( i ) {
						  
						  r++;
						  
						  var check_id = $(this).val();
						  check_id = parseInt(check_id);
						  //alert(check_id);
						  
						  if(check_id==realImgId){
							//alert(4);  
							  return false;
							  
						  }
						  
						  
						});
					
					// Maximale Anzahl der Bilder die angezeigt wird pro Gallerie Ansicht					
					var check_step = $("#cg_step").val();
					//alert(r);alert(check_step);
					var quotient = r/check_step;
					
					var floorQuotioent = Math.floor(quotient);
					
					var check_step_on_site = check_step*floorQuotioent;
					
				//alert(quotient);
					
					// 3. Sollte die ID auf einer Seite weiterhinten sein muss an diese weitergeleitet werden
					
					if(window.location.href.indexOf("picture_id") > -1) {
						//alert("action");
    
					
							if(quotient>1){
								//alert(1);
								quotient = Math.floor(quotient);							
								var step = quotient * check_step;
								
								var site_url = $("#cg_siteURL").val();
								
								var look = $("#cg_look").val();
								if(look=="thumb"){look=1;}
								else if(look=="height"){look=2;}
								else if(look=="row"){look=3;}
								else{look=1;}
								
								var order = $("#cg_order").val();
								if(order=="desc"){order=1;}
								else if(order=="asc"){order=2;}
								else{order=1;}
							
							
								// Zwei Varianten von Seiten Urls sind möglich: mit und ohne ?									
								if(site_url.indexOf('?') === -1)
								{
								window.location.href = site_url+"?1="+look+"&2="+order+"&3="+check_step_on_site+"#img"+picture_id_to_get;
								}
								else{
									
								window.location.href = site_url+"&1="+look+"&2="+order+"&3="+check_step_on_site+"#img"+picture_id_to_get;
									
								}

								
							}
							
							}
							
							// 4. Click ID
							else{
								
								//alert(2);
								
								
							var class_of_element = $("#cg_image_id"+realImgId).attr("class");

							$("."+class_of_element+"").load(function(){$(this).click();});
							
							//https://www.contest-gallery.com/test-cg-1/?picture_id=100752#cg-begin	 
								
								
								
							}
					
					}
					
					else{
						
					return false;
						
					}
					
					


			   
			}
			
			
			// Aktion wird ausgeführt User URLs dieser Art teilen #img --- ENDE
			
			
			
	


		// Wenn Picture ID Parameter mitgeschickt wird und gallery Script aktiviert ist --- ENDE




	
	
	   $(document).on('click', '[class*=cg_image]', function(e){
		   
//alert("cg_activate_gallery_slider: "+cg_activate_gallery_slider);
	
	// Overlay sichtbar machen
    
  // Achtung! Vorher diese Prüfung notwendig falls hide until vote und vote out gallery aktiviert sind! Der Klickevent von Children Element wird von der Jquery Bibliothek als erstes bearbeitet.
  // Auch wenn dieser weiter unten im Script passiert.  
  
 if(cg_FbLikeGallery==1){
	
//	$('iframe').each(function() {
	//  this.contentWindow.location.reload(true); 
	//});	
	
	//$('iframe #cg_fb_like_iframe_gallery983').contentWindow.location.reload(true);
	//document.getElementById("cg_fb_like_iframe_gallery983").contentWindow.location.reload(true);
	
	//var iframe = document.getElementById('cg_fb_like_iframe_gallery983');
//iframe.src = iframe.src;


//document.getElementById('cg_fb_like_iframe_gallery983').contentWindow.location.reload();
//alert(3);

 ///var test_lala = $('#cg_fb_like_iframe_gallery983').attr('src', $('#url').val());
//alert(test_lala);

//reload all iFrames


$('iframe').each(function() {
  this.contentWindow.location.reload(true);
});


}
  
  
  
  
   var checkContainer = $("#cg_hide_until_vote_actual").val();
  // alert(checkContainer); 
  // alert(0);
   if(checkContainer!=1){
   

  // $('#cg_overlay').css('display', 'block');
   $('#cg_overlay').toggle();
   
   $('#cg_overlay').css('opacity', '0.4');
   
   // Pfeile verstecken bei der Mobile Version
  // alert(1);
   //alert(isMobile);
   
		if(isMobile==true){
			$( "#cg_slider_arrow_left" ).hide();
			$( "#cg_slider_arrow_right" ).hide();
		}
	else{
		
  var cgWindowHeight = $(window).height();  
  // var heightIMGcontainer = $("#imgContainer").height();
  // var cgWindowWidth = $(window).width();
   
   // Abstand von oben
   var cgMarginTop = (cgWindowHeight-(cgWindowHeight/100*10))/2;
		
   $('#cg_slider_arrow_right').css("top",cgMarginTop);
   $('#cg_slider_arrow_left').css("top",cgMarginTop);
   //$('#cg_slider_arrow_right').toggle();
   //$('#cg_slider_arrow_left').toggle();   
   
   }
   
   
   
   
   // Schließen des Comments Slider Div falls offen
   $('#cg_comments_slider_div').css("display","none");
   $('#close_slider_comments_button').css("display","none");
   
   
   var classCGimage = $(this).attr('class');
   

   
   
   
   	// Echte ID wird vergeben
	 	  var real_picture_id = parseInt($(this).attr("data-cg_image_id"));
		 // alert(real_picture_id);
		 // real_picture_id = parseInt(real_picture_id.substr(11));	
		  $('#cg_actual_slider_img_id').val(real_picture_id);
		//  alert(real_picture_id);
		 // alert(real_picture_id);
		     	//var cg_check_voted = $("#cg_check_voted"+real_picture_id).val();
	//alert(real_picture_id);
		  
		  
	// Picture ID crypten und oben einfügen
	      //var crypted_picture_id =(real_picture_id+8)*2+100000;
		  //alert(crypted_picture_id);
		  //document.location.hash = "img"+crypted_picture_id;	
		  //var cg_real_site_url = $('#cg_real_site_url').val();	
		  	  
		  //window.location.href = cg_real_site_url+"?picture_id="+crypted_picture_id;
		  //alert(real_picture_id);
		  

	 
   
   $('#cg_actual_slider_class_value').val(classCGimage);
   // Funktion zur Ausführung der Berechnung
   
   // Aller Slider Boxen werden entfernt. Der Aufbau kann von vorne beginnen. Kann sein, dass vorher Resize wurde. Dann sollte der Aufbau von vorne starten.
   $( ".cg_img_box" ).remove();
   
 cgSliderIMGdistanceCounting(classCGimage,'');
 
 
	 
	 $('#close_slider_button').show();
	 
	 
// Slider wurde geöffnet wird aktualisiert
   $('#cg_vote_in_slider').val(1);
	 
	  
	    $('#imgContainer').fadeIn('slow');
		
		
		return false; 
		
	   // $('#imgContainer').toggle();
	   
	   
	  //  var loadingSource = $('#cg_loadingGifSource').val();
	// $(".cg_commentsIcon_div").append("<img class='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
	// $("#rating_cg").empty(); 
	//$("[id*=cg_pngCommentsIcon]").load(function(){$(this).toggle();});   
   
   

}

$("#cg_hide_until_vote_actual").val(0);
return false; 




});	 




// Show/Zeige ImgContainer für Slider   ---- ENDE





//var checkClicks = 0;
//var endClickQueue = 0;
//Timeout stellen, prüfen wie viel Clicks in der Zeit vergangen sind	  
  // if(checkClicks==0){setTimeout(function(){ endClickQueue = 1; }, 2000);}
 //checkClicks++;
 
 /*
 	   $(document).on('dblclick', '[id*=cg_slider_arrow]', function(e){
   
      var classCGimage = $('#cg_actual_slider_class_value').val();
   
       classCGimage = parseInt(classCGimage.substr(8));
	
   var leftORright = $(this).attr('id');	
   //alert(leftORright);
	   leftORright = leftORright.substr(16);
	  // alert(leftORright);
   if(leftORright=='left_img'){
	classCGimage = classCGimage-2; 	  	   
   }
   else{	
   classCGimage = classCGimage+2;
   }	   
	
	classCGimage = "cg_image"+classCGimage;
   
   $('#cg_actual_slider_class_value').val(classCGimage);
   
   // Funktion zur Ausführung der Berechnung
   
 cgSliderIMGdistanceCounting(classCGimage,'');
   
 // Damit sich die Image Seite nicht öffnet  
return false; 
});	 
 
 
 
 
	   $(document).on('click', '[id*=cg_slider_arrow]', function(e){
   
      var classCGimage = $('#cg_actual_slider_class_value').val();
   
       classCGimage = parseInt(classCGimage.substr(8));
	
   var leftORright = $(this).attr('id');	
   //alert(leftORright);
	   leftORright = leftORright.substr(16);
	  // alert(leftORright);
   if(leftORright=='left_img'){
	classCGimage = classCGimage-1; 	  	   
   }
   else{	
   classCGimage = classCGimage+1;
   }	   
	
	classCGimage = "cg_image"+classCGimage;
   
   $('#cg_actual_slider_class_value').val(classCGimage);
   
   // Funktion zur Ausführung der Berechnung
   
 cgSliderIMGdistanceCounting(classCGimage,'');
   
 // Damit sich die Image Seite nicht öffnet  
return false; 
});	 */


// Images swipen

/*
$(function(){
  // Bind the swipeHandler callback function to the swipe event on div.box
  $( "#imgContainer" ).on( "swipe", swipeHandler );
 
  // Callback function references the event target and adds the 'swipe' class to it
  function swipeHandler( event ){
    //$( event.target ).addClass( "swipe" );
    $( event.target ).alert(2);
	
  }
});*/

  /*  $( document ).on( "swipeleft", "#imgContainer", function( event ) {
        // Get the filename of the next page. We stored that in the data-next
        // attribute in the original markup.
alert(2);
    });*/
	
	  /*  $( "#cg_swipe_test" ).bind( "swipe", function( event ) {
        // Get the filename of the next page. We stored that in the data-next
        // attribute in the original markup.
alert(3);
    });*/

	
	
// Keypress animation


   
//var event = new KeyboardEvent('keydown');

$(document).keydown(function(e) {
	 
	
	
	if($('#cg_overlay').is(':visible')) {
		
	// Animation muss gestopt werden falls jemand zu oft in eine Richtung klickt dass er dann nicht abwarten muss	
	//$( "#imgContainer" ).stop();
	
  if(e.which == 37) { // left 
  
  		//Eintragen das linker Pfeil gerade geklickt wurde (Ausgetragen wird am Ende in der Funktion)
		//$('#cg_check_arrow_left_click').val(1);

   //alert(1);	  
	  
   									 var classCGimage = $('#cg_actual_slider_class_value').val();
							//	alert(classCGimage);
									 classCGimage = parseInt(classCGimage.substr(8));									 
									 
									 
								//	 alert(classCGimage);
									 if(classCGimage>1){
										 // Nur dann Stop verursachen, wenn danach Animation ausgeführt wird, ansonsten bleibt das Fenster stecken bei zu schnellem öfteren drücken nach links oder rechts am Ende. 
										 $( "#imgContainer" ).stop();
										 
											 var allCGimages = $('.show').length;
											 // Damit sofort wieder reagiert wenn man nach links klickt								
											if(classCGimage>allCGimages){classCGimage=allCGimages;}
											
						
											classCGimage = classCGimage-1; 	  

											classCGimage = "cg_image"+classCGimage;
										   
											$('#cg_actual_slider_class_value').val(classCGimage);
										 //  alert(classCGimage);
										  
											// Echte ID wird vergeben
											var real_picture_id = $("."+classCGimage+"").attr("id");
										//	alert(real_picture_id);
											real_picture_id = parseInt(real_picture_id.substr(11));
										//	alert(real_picture_id);
											$('#cg_actual_slider_img_id').val(real_picture_id);
											
											// Picture ID crypten und oben einfügen
											 // var crypted_picture_id =(real_picture_id+8)*2+100000;
											//  alert(crypted_picture_id);
												//document.location.hash = "img"+crypted_picture_id;	
		   
								
										cgSliderIMGdistanceCounting(classCGimage,'');
										 
										 
								   
								}
	
	
  }
  else if(e.which == 39) { // right     
      //alert(2);	  
	  
	    //Eintragen das rechter Pfeil gerade geklickt wurde (Ausgetragen wird am Ende in der Funktion)
		//$('#cg_check_arrow_right_click').val(1);
	  
	  									 var classCGimage = $('#cg_actual_slider_class_value').val();
								//    alert(classCGimage);
									 classCGimage = parseInt(classCGimage.substr(8));
									 
									 var allCGimages = parseInt($('.show').length);
									 
									 // Aktuelle Anzahl der sichtbaren Bilder
									// var cg_count = $('#cg_count').val();
									 
									// alert(allCGimages);
									// alert("classCGimage: "+classCGimage);
									 
									 if(classCGimage<allCGimages){
										// alert("action");
										// Nur dann Stop verursachen, wenn danach Animation ausgeführt wird, ansonsten bleibt das Fenster stecken bei zu schnellem öfteren drücken nach links oder rechts am Ende. 
									  $( "#imgContainer" ).stop();
									   //alert(classCGimage);
							// Damit sofort wieder reagiert wenn man nach rechts klickt								
								//if(classCGimage==1){classCGimage=1;}
									
				// alert(classCGimage);
									classCGimage = classCGimage+1; 	  	   
								
					   // alert(classCGimage);
									
									classCGimage = "cg_image"+classCGimage;
				
								   $('#cg_actual_slider_class_value').val(classCGimage);
								   
								   	// Echte ID wird vergeben
									var real_picture_id = $("."+classCGimage).attr("id");
						
									real_picture_id = parseInt(real_picture_id.substr(11));	
									$('#cg_actual_slider_img_id').val(real_picture_id);
									
									
									// Picture ID crypten und oben einfügen
									//  var crypted_picture_id =(real_picture_id+8)*2+100000;
					
									  		// document.location.hash = "img"+crypted_picture_id;	
								   
								   // Funktion zur Ausführung der Berechnung
								  // alert(classCGimage);
								 cgSliderIMGdistanceCounting(classCGimage,'');			 
								 
								 
								 
									 }
	  
  }
  
  }
  
});



// Keypress animation --- ENDE

	
	
	
	
	
	
	
	
	
	
	

// Pfeilimages klicken rechts links

var DELAY = 200, clicks = 0, timer = null;




$(function(){

    $("#cg_slider_arrow_left_img").on("click", function(e){
		
		//Eintragen das linker Pfeil gerade geklickt wurde (Ausgetragen wird am Ende in der Funktion)
		//$('#cg_check_arrow_left_click').val(1);
		
			// Comments Slider soll ausgeblendet werden falls an
		$('#cg_comments_slider_div').css("display","none");
		$('#close_slider_comments_button_img').css("display","none");
		
		
				if( $("#imgContainer").is(':animated') ) {return false;}
				else{
				$(this).fadeTo(100, 0.5).fadeTo(100, 1.0);
				
				}

        clicks++;  //count clicks 
//alert(clicks);
      //  if(clicks === 1) {

            timer = setTimeout(function() {

									 var classCGimage = $('#cg_actual_slider_class_value').val();
								   
									 classCGimage = parseInt(classCGimage.substr(8));
									 
									 var allCGimages = $('.show').length;
									 // Damit sofort wieder reagiert wenn man nach links klickt								
								    if(classCGimage>allCGimages){classCGimage=allCGimages;}
									
				
									classCGimage = classCGimage-1; 	  

									classCGimage = "cg_image"+classCGimage;
								   
								    $('#cg_actual_slider_class_value').val(classCGimage);
								   
								   
								   	// Echte ID wird vergeben
									var real_picture_id = $("img."+classCGimage).attr("id");
									real_picture_id = parseInt(real_picture_id.substr(11));	
									$('#cg_actual_slider_img_id').val(real_picture_id);
									
									// Picture ID crypten und oben einfügen
									  //var crypted_picture_id =(real_picture_id+8)*2+100000;
									 	//document.location.hash = "img"+crypted_picture_id;	
									
								   
								   
								   
								   // Funktion zur Ausführung der Berechnung
								   
								 cgSliderIMGdistanceCounting(classCGimage,'');
								   
								 // Damit sich die Image Seite nicht öffnet  
								//return false;  
                clicks = 0;             //after action performed, reset counter

            }, DELAY);

     /*   } else {

            clearTimeout(timer);    //prevent single-click action
											  var classCGimage = $('#cg_actual_slider_class_value').val();
							   
								   classCGimage = parseInt(classCGimage.substr(8));
								   
								   	var allCGimages = $('[class*=cg_image]').length;
									 // Damit sofort wieder reagiert wenn man nach links klickt								
								    if(classCGimage>allCGimages){classCGimage=allCGimages;}


								classCGimage = classCGimage-2; 	  	   
											
					
								classCGimage = "cg_image"+classCGimage;
							   
							   $('#cg_actual_slider_class_value').val(classCGimage);
							   
							   
								   	// Echte ID wird vergeben
									var real_picture_id = $("img."+classCGimage).attr("id");
									real_picture_id = parseInt(real_picture_id.substr(11));	
									$('#cg_actual_slider_img_id').val(real_picture_id);
									
									// Picture ID crypten und oben einfügen
									  var crypted_picture_id =(real_picture_id+8)*2+100000;
									  		  document.location.hash = "img"+crypted_picture_id;		
							   
							   // Funktion zur Ausführung der Berechnung
							   
							 cgSliderIMGdistanceCounting(classCGimage,'');
							   
							 // Damit sich die Image Seite nicht öffnet   
							//return false; 
            clicks = 0;             //after action performed, reset counter
        }

    })
    .on("dblclick", function(e){
        e.preventDefault();  //cancel system double-click event*/
    });

});





$(function(){

    $("#cg_slider_arrow_right_img").on("click", function(e){
		
		//Eintragen das rechter Pfeil gerade geklickt wurde (Ausgetragen wird am Ende in der Funktion)
		//$('#cg_check_arrow_right_click').val(1);
		
		
						if( $("#imgContainer").is(':animated') ) {return false;}
				else{
				$(this).fadeTo(100, 0.5).fadeTo(100, 1.0);
				}

        clicks++;  //count clicks
//alert(clicks);
     //   if(clicks === 1) {

            timer = setTimeout(function() {

									 var classCGimage = $('#cg_actual_slider_class_value').val();
								   
									 classCGimage = parseInt(classCGimage.substr(8));
									 
							// Damit sofort wieder reagiert wenn man nach rechts klickt								
								if(classCGimage<1){classCGimage=1;}
									
				
									classCGimage = classCGimage+1; 	  	   
								
					   
									
									classCGimage = "cg_image"+classCGimage;
								   
								   $('#cg_actual_slider_class_value').val(classCGimage);
								   
								   	// Echte ID wird vergeben
									var real_picture_id = $("."+classCGimage).attr("id");
									real_picture_id = parseInt(real_picture_id.substr(11));	
									$('#cg_actual_slider_img_id').val(real_picture_id);
									
									
									// Picture ID crypten und oben einfügen
									 // var crypted_picture_id =(real_picture_id+8)*2+100000;
									  		  //document.location.hash = "img"+crypted_picture_id;	
								   
								   // Funktion zur Ausführung der Berechnung
								   
								 cgSliderIMGdistanceCounting(classCGimage,'');
								   
								 // Damit sich die Image Seite nicht öffnet  
								//return false;  
                clicks = 0;             //after action performed, reset counter

            }, DELAY);

      /*  } else {

            clearTimeout(timer);    //prevent single-click action
											  var classCGimage = $('#cg_actual_slider_class_value').val();
							   
								   classCGimage = parseInt(classCGimage.substr(8));
								   
								   // Damit sofort wieder reagiert wenn man nach rechts klickt								
								if(classCGimage<1){classCGimage=1;}
								

								classCGimage = classCGimage+2; 	  	   
											
					
								classCGimage = "cg_image"+classCGimage;
							   
							   $('#cg_actual_slider_class_value').val(classCGimage);
							   
								   	// Echte ID wird vergeben
									var real_picture_id = $("."+classCGimage).attr("id");
									real_picture_id = parseInt(real_picture_id.substr(11));	
									$('#cg_actual_slider_img_id').val(real_picture_id);
									
									
									// Picture ID crypten und oben einfügen
									  var crypted_picture_id =(real_picture_id+8)*2+100000;
									  		  document.location.hash = "img"+crypted_picture_id;	
							   
							   // Funktion zur Ausführung der Berechnung
							   
							 cgSliderIMGdistanceCounting(classCGimage,'');
							   
							 // Damit sich die Image Seite nicht öffnet  
							//return false; 
            clicks = 0;             //after action performed, reset counter
        }

    })
    .on("dblclick", function(e){
        e.preventDefault();  //cancel system double-click event*/
    });

});







// Kommentar in Gallery

if(cg_comment_in_gallery==1){


	   $(document).on('click', '[id*=rating_cgc-]', function(e){
		   

		   

	// Overlay sichtbar machen
   
  // $('#cg_overlay').css('display', 'block'); 
  // $('#cg_overlay').toggle();
   
  // $('#cg_overlay').css('opacity', '0.4');
//   $('#cg_slider_arrow_right').toggle();

var widthScreen = $('body').width();
var marginLeftCommentDiv = (widthScreen-800)/2;

$('#cg_comments_slider_div').css('left', marginLeftCommentDiv);


   $('#cg_comments_slider_div').toggle();
   var marginLeftCommentCloseDiv = (widthScreen-800)/2+727;
   
   
   // $('#close_slider_comments_button').css('left', marginLeftCommentCloseDiv);  
 $('#cg_comments_slider_div').css('left', marginLeftCommentDiv);  
   $('#close_slider_comments_button').toggle();
   var idImageForComment =  parseInt(this.id.substr(11));	
   	// Haupthidden Feld, dass aktuell geöffnete comment image id zeigt
   $('#cg_slider_comment_picture_id').val(idImageForComment);
   
   //$('#cg_actual_slider_class_value').val(idImageForComment);
   // Funktion zur Ausführung der Berechnung
   
   
   // Prüfen der Wordpress Session id
   var check = $("#cg_check").val();
   
	//alert(2);
	// I am not a robot checkbox soll auftauchen   
   	if ($("#"+check+"").length > 0){
		
		//alert(3);
		
		
		var onlyCheck = 1;
	
	}
	else{
		//alert(4);
		var cg_language_i_am_not_a_robot = $('#cg_language_i_am_not_a_robot').val();
		$("#cg_i_am_not_a_robot").append("<input type='checkbox' value='"+check+"' name='"+check+"' id='"+check+"' '>"+cg_language_i_am_not_a_robot+"<br/><br/>");
		
	}
	 
	 
	$("#cg_open_slider_comment").click(); 
	  
	  //  $('#imgContainer').fadeIn('slow');
	   // $('#imgContainer').toggle();
   
  
   
   
return false; 
});

// Kommentar in Gallery --- ENDE

}




// Rating Pop Up im Slider, bei hide until vote



if(cg_hide_until_vote==1){

	   $(document).on('click', '[id*=cg_plz_vote]', function(e){
		   
//var cg_real_id = $(this).find(".cg_real_id").val();
var cg_real_id =  parseInt(this.id.substr(11));	



//alert(cg_real_id);

	//var starOnUrl = $("#cg_star_on_slider").val();
	var starOffUrl = $("#cg_star_off_slider").val();
	
		if(cg_allow_rating==1){

			var ratingBlock = "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star"+cg_real_id+"'></div>"+
			  "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star"+cg_real_id+"'></div>"+
			  "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star"+cg_real_id+"'></div>"+
			  "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star"+cg_real_id+"'></div>"+
			  "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star"+cg_real_id+"'></div>";
			   
		}
	   
	   	if(cg_allow_rating==2){
			
			var ratingBlock = "<input type='hidden' class='cg_check_voted' value='0' id='cg_check_voted"+cg_real_id+"'>"+
			"<div style='display:inline-block;float:left;width:17px;height:17px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star1' style='float:left;cursor:pointer;' alt='6' id='cg_rate_star"+cg_real_id+"'></div>";
			   
		}
	   
	    $("#ratingCGslider"+cg_real_id).empty();

 $("#ratingCGslider"+cg_real_id).append(ratingBlock);


});



}

/*
if(cg_hide_until_vote==1 && cg_vote_in_gallery==1){

	   $(document).on('click', '[class*=cg_hide_until_vote_rate]', function(e){
		   
//var cg_real_id = $(this).find(".cg_real_id").val(); 
var cg_real_id =  $(this).parent().attr("id"); 
    cg_real_id =  parseInt(cg_real_id.substr(21));	

var cg_ShowAlways =  $("#cg_ShowAlways").val();

	
	
var	cg_real_row = $(this).attr("class");
	cg_real_row = parseInt(cg_real_row.substr(23));	
	//alert(cg_vote_in_gallery);
	//alert(cg_real_row);
	//Show always vote, comments and info in gallery view:
	if(cg_ShowAlways!=1){
	$("#cg_hide"+cg_real_row).hide();
	}
//alert(cg_real_row);



	//var starOnUrl = $("#cg_star_on_slider").val();
	var starOffUrl = $("#cg_star_off_slider").val();
	
	// Achtung! Vorher diese Prüfung notwendig falls hide until vote und vote out gallery aktiviert sind! Der Klickevent von Children Element wird von der Jquery Bibliothek als erstes bearbeitet.
  // Auch wenn dieser weiter unten im Script passiert.  
	$("#cg_hide_until_vote_actual").val(1);
	
	


	var ratingBlock = "<input type='hidden' class='cg_check_voted' value='0' id='cg_check_voted"+cg_real_id+"'>"+
	"<div style='display:inline-block;float:left;width:17px;height:17px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star"+cg_real_id+"'></div>"+
	  "<div style='display:inline-block;float:left;width:17px;height:17px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star"+cg_real_id+"'></div>"+
	  "<div style='display:inline-block;float:left;width:17px;height:17px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star"+cg_real_id+"'></div>"+
	  "<div style='display:inline-block;float:left;width:17px;height:17px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star"+cg_real_id+"'></div>"+
	   "<div style='display:inline-block;float:left;width:17px;height:17px;vertical-align: middle;'><img src='"+starOffUrl+"' class='cg_slider_star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star"+cg_real_id+"'></div>";
	   
	    $("#cg_gallery_rating_div"+cg_real_id).empty();

 $("#cg_gallery_rating_div"+cg_real_id).append(ratingBlock);


});



}*/


// Rating Pop Up im Slider, bei hide until vote --- ENDE




// Schließen Layer 


function closeCGsliderFunction(){
	
	
	
	//var classCGimage = $(this).attr('class');	

//	var classCGimageNumber = parseInt(classCGimage.substr(classCGimage.length - 1));	
	
	//alert(classCGimageNumber);
	
	//alert("test");

if(cg_FbLikeGallery==1){
	
//	$('iframe').each(function() {
	//  this.contentWindow.location.reload(true);
	//});	
	
	//$('iframe #cg_fb_like_iframe_gallery983').contentWindow.location.reload(true);
	//document.getElementById("cg_fb_like_iframe_gallery983").contentWindow.location.reload(true);
	
	//var iframe = document.getElementById('cg_fb_like_iframe_gallery983');
//iframe.src = iframe.src;


//document.getElementById('cg_fb_like_iframe_gallery983').contentWindow.location.reload();
//alert(3);

 ///var test_lala = $('#cg_fb_like_iframe_gallery983').attr('src', $('#url').val());
//alert(test_lala);

//reload all iFrames


	
	
$('iframe').each(function() {
  this.contentWindow.location.reload(true);
});



}
	
	
// Hash soll entfernt werden beim schließen des Sldiers	
history.pushState("", document.title, window.location.pathname);



	
			// Werte der gevoteten Bilder sollen sich ändern
			// Plz vote language platzhalter
			var cg_plz_vote = $('#cg_plz_vote').val();
			
			
			var r=0;
			
			$( ".show" ).each(function( i ) {
			  
			  r++;

					//eventuell alles nach diesem Height anpassen? 
					//  alert(heightCGimgBox);
					
						 var cg_pngCommentsIconImg = $('#cg_pngCommentsIconImg').val();
						// alert(cg_pngCommentsIconImg);
						 var realId = $(this).find('.realId').val();
						 var srcOriginalImg = $(this).find('.srcOriginalImg').val();
						// alert(srcOriginalImg);
					 var src1024width = $(this).find('.src1024width').val();
					 var src624width = $(this).find('.src624width').val();
					 var src300width = $(this).find('.src300width').val();
					//  var hrefCGpic = $(this).find('.hrefCGpic').val();
					  
					var width = $(this).find(".widthOriginalImg").val();
					var height = $(this).find(".heightOriginalImg").val();
					
					var ratingImage = $(this).find(".averageStarsRounded").val();
					var countRatingQuantity = $(this).find("#countRatingQuantity"+realId+"").val();
					var countRatingSQuantity = $(this).find("#countRatingSQuantity"+realId+"").val();
					var countCommentsQuantity = $(this).find("#countCommentsQuantity"+realId+"").val();
					
					//Prüf ob wenn Hide Until Vote an ist schon gewotet wurde oder nicht
					//var cg_check_voted = $(this).find(".cg_hide").find(".cg_check_voted").val();
					var cg_check_voted = $("#cg_check_voted"+realId).val();
					//alert(cg_check_voted);
					
					var cgIMGsourceRelation = width/height;
					
				//	alert("cgIMGsourceRelation: "+cgIMGsourceRelation);
				//	alert("cgIMGcontainerRelation: "+cgIMGcontainerRelation);				
					
						
					// Rating bestimmen
					
					var starOnUrl = $("#cg_star_on_slider").val();
					var starOffUrl = $("#cg_star_off_slider").val();

			if(cg_allow_rating==1){	
				//	alert(cg_check_voted);
					
					if(cg_check_voted==1 || cg_check_voted==2){
						if(ratingImage>=1){var star1url = starOnUrl;}
						else{var star1url = starOffUrl;}
						if(ratingImage>=2){var star2url = starOnUrl;}
						else{var star2url = starOffUrl;}
						if(ratingImage>=3){var star3url = starOnUrl;}
						else{var star3url = starOffUrl;}
						if(ratingImage>=4){var star4url = starOnUrl;}
						else{var star4url = starOffUrl;}
						if(ratingImage>=5){var star5url = starOnUrl;}
						else{var star5url = starOffUrl;}
						
					// Cursor Style bestimmen, je nach dem ob es erlaubt ist aus der Gallerie zu voten oder nicht
					var cg_vote_in_gallery = $("#cg_vote_in_gallery").val();

					if(cg_vote_in_gallery==1){	
					var cg_ratingStar = "cg_rate_star"+realId+"";	
					var cg_ratingStarCursorStyle = "cursor:pointer;";
					}
					else{						
					var cg_ratingStar = "";
					var cg_ratingStarCursorStyle = "cursor:default;";				
					}

					// Cursor Style bestimmen, je nach dem ob es erlaubt ist aus der Gallerie zu voten oder nicht --- ENDE

					var ratingBlock = '<input type="hidden" class="cg_check_voted" id="cg_check_voted'+realId+'" value="1">'+
					"<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='"+star1url+"' class='cg_slider_star1' style='float:left;"+cg_ratingStarCursorStyle+"' alt='1' id='"+cg_ratingStar+"'></div>"+
					  "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='"+star2url+"' class='cg_slider_star2' style='float:left;"+cg_ratingStarCursorStyle+"' alt='2' id='"+cg_ratingStar+"'></div>"+
					  "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='"+star3url+"' class='cg_slider_star3' style='float:left;"+cg_ratingStarCursorStyle+"' alt='3' id='"+cg_ratingStar+"'></div>"+
					  "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='"+star4url+"' class='cg_slider_star4' style='float:left;"+cg_ratingStarCursorStyle+"' alt='4' id='"+cg_ratingStar+"'></div>"+
					   "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='"+star5url+"' class='cg_slider_star5' style='float:left;"+cg_ratingStarCursorStyle+"' alt='5' id='"+cg_ratingStar+"'></div>"+
					  "<div style='display: inline; float: left; font-size: 18px; line-height: 18px; height: 18px; color: rgb(255, 255, 255); font-weight: bold;' id='rating_cg-' class='rating_cg'><b>&nbsp;("+countRatingQuantity+")</b></div>";
					  
					  var ratingDivStyle = "";
					  
					}
					
					else if(cg_check_voted==0){
					var ratingBlock = '<input type="hidden" class="cg_check_voted" id="cg_check_voted'+realId+'" value="0">'+
					'<div style="display: inline; float: left; font-size: 18px; line-height: 18px; height: 18px; color: rgb(255, 255, 255); font-weight: bold;cursor:pointer;" class="cg_hide_until_vote_rate'+r+'"><u>'+cg_plz_vote+'...</u></div>';

					}				
					
					// Rating bestimmen --- ENDE
					
			}
			
			if(cg_allow_rating==2){
				//	alert(cg_check_voted);
					
					if(cg_check_voted==1 || cg_check_voted==2){
						if(countRatingSQuantity>0){var star6url = starOnUrl;}
						else{var star6url = starOffUrl;}

						
					// Cursor Style bestimmen, je nach dem ob es erlaubt ist aus der Gallerie zu voten oder nicht
					var cg_vote_in_gallery = $("#cg_vote_in_gallery").val();

					if(cg_vote_in_gallery==1){	
					var cg_ratingStar = "cg_rate_star"+realId+"";	
					var cg_ratingStarCursorStyle = "cursor:pointer;";
					}
					else{						
					var cg_ratingStar = "";
					var cg_ratingStarCursorStyle = "cursor:default;";				
					}

					// Cursor Style bestimmen, je nach dem ob es erlaubt ist aus der Gallerie zu voten oder nicht --- ENDE

					var ratingBlock = '<input type="hidden" class="cg_check_voted" id="cg_check_voted'+realId+'" value="1">'+
					"<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='"+star6url+"' class='cg_slider_star1' style='float:left;"+cg_ratingStarCursorStyle+"' alt='6' id='"+cg_ratingStar+"'></div>"+
					  "<div style='display: inline; float: left; font-size: 18px; line-height: 18px; height: 18px; color: rgb(255, 255, 255); font-weight: bold;' id='rating_cg-' class='rating_cg'><b>&nbsp;("+countRatingSQuantity+")</b></div>";
					  
					  var ratingDivStyle = "";
					  
					}
					
					else if(cg_check_voted==0){
					var ratingBlock = '<input type="hidden" class="cg_check_voted" id="cg_check_voted'+realId+'" value="0">'+
					'<div style="display: inline; float: left; font-size: 18px; line-height: 18px; height: 18px; color: rgb(255, 255, 255); font-weight: bold;cursor:pointer;" class="cg_hide_until_vote_rate'+r+'"><u>'+cg_plz_vote+'...</u></div>';
					}				
					
					// Rating bestimmen --- ENDE
					
			}		
			
					
					// Reload von rating Div
						$("#cg_gallery_rating_div"+realId).empty();
						$("#cg_gallery_rating_div"+realId).append(ratingBlock);
						
					// Reload von rating Div --- ENDE
			
			});
			
			// Werte der gevoteten Bilder sollen sich ändern --- ENDE
	
			// Comments Slider soll ausgeblendet werden falls an
		$('#cg_comments_slider_div').css("display","none");
		$('#close_slider_comments_button').css("display","none");
	   
    $('#cg_slider_arrow_left').hide();
   $('#cg_slider_arrow_right').hide();
   $('#close_slider_button').hide();
   
   // Slider wurde geschlossen wird aktualisiert
   $('#cg_vote_in_slider').val(0);
   
//   $(this).css('display', 'hidden');
   $('#cg_overlay').hide();
   //$('div#imgContainer').css('display', 'hidden');
   $('#imgContainer').hide();
   
   // Rating Bereich wird dadurch wieder gehovert
   var cg_vote_in_gallery = $("#cg_vote_in_gallery").val();
var cg_comment_in_gallery = $("#cg_comment_in_gallery").val();
   
if(cg_hide_until_vote==1 && cg_vote_in_gallery==1){
	
$( '.rating_cg' ).hover(function() {
	  $('#cg_overlay').css("cursor","pointer");	  
});

}	
	
	
	
	
}

	
	
		$(document).on('mouseup', '[class*=cg_hide_info_div]', function(e){
			
			//alert(1);
			
				var cg_realId = $(this).attr("id");
				var cg_class_hide_show_info = $(this).attr("class");
				var cg_realId = parseInt(cg_realId.substr(16));
				
				// Achtung. visible check reagiert nur auf display none, nicht auf visiblity css
				if(cg_class_hide_show_info=="cg_hide_info_div_yes") {
					//alert(2);
					$(this).css("background-image","url("+cg_hide_info_png+")");
					$(this).attr("class","cg_hide_info_div_no");
					$("#cgFacebookDiv"+cg_realId+"").css("display","none");
					$("#commentsCGslider"+cg_realId+"").css("display","none");
					$("#ratingCGslider"+cg_realId+"").css("display","none");									
					$("#cg_url_slider_div"+cg_realId+"").css("display","none");									
					$("#cg_user_input"+cg_realId+"").css("display","none");					
					
				}				
				else{
					//alert(3);
					$(this).css("background-image","url("+cg_show_info_png+")");
					$(this).attr("class","cg_hide_info_div_yes");
					//$(this).find(".cg_hide_info_img").css("display","inline");
					$("#cgFacebookDiv"+cg_realId+"").css("display","inline");
					$("#commentsCGslider"+cg_realId+"").css("display","inline");
					$("#ratingCGslider"+cg_realId+"").css("display","inline");				
					$("#cg_url_slider_div"+cg_realId+"").css("display","inline");				
					$("#cg_user_input"+cg_realId+"").css("display","block");	
					
				}			
		
		
			
		});
	

	
		




/*	   $(document).on('click', '#cg_overlay', function(e){
		   



});*/



// Schließen Layer --- ENDE







}// End Slider/Out of Gallery Script

  
});