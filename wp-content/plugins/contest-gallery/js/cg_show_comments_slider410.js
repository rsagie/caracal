jQuery(document).ready(function($){
jQuery( document ).on( 'click', '[id*=cg_pngCommentsIcon]', function() {
	
//alert(3);
	
	// Haupthidden Feld, dass aktuell geöffnete comment image id zeigt
	//var cg_picture_id = $("#cg_slider_comment_picture_id").val();
	var cg_picture_id = $(this).attr("id");
	
	//alert(cg_picture_id);
	
	cg_picture_id = parseInt(cg_picture_id.substr(18));
	//alert(cg_picture_id);

	// Wird weiter gegeben, damit bei set comment gefunden werden kann
	$("#cg_slider_comment_picture_id").val(cg_picture_id);

	

	// device detection, damit elemente beim klicken auf imgContainer nicht verschwinden und rating und comment auf mobile funktionieren
		var check_mobile =  $( "#check_mobile" ).val();	
		
		
		var widthScreen = $('#cg_overlay').width();

		// Prüfen ob mobile Ansicht
		if(check_mobile=="true"){
		//	alert(2);
			//var test = widthScreen-200;
		$('#cg_comments_slider_div').css('left', 0);
		$('#cg_comments_slider_div').css('width', widthScreen);
		//alert(test);
		//padding-left ist 50px;
		var newCommentsElementsWidth = widthScreen-100;
		$('#cg_picture_comments_single_view').css('width', newCommentsElementsWidth);
		$('#cg_picture_comments_single_view_hr').css('width', newCommentsElementsWidth);
		$('#cg_your_comment_single_view').css('width', newCommentsElementsWidth);
		$('#cg_your_comment_comment_single_view').css('width', newCommentsElementsWidth);
		$('#cg_slider_comment').css('width', newCommentsElementsWidth);
		
		$('#cg_slider_comments_elemens_width').val(newCommentsElementsWidth);
		
		var cg_slider_comments_elemens_width = $("#cg_slider_comments_elemens_width").val();
			
			
		}
		
		else{
			
			
		var cg_slider_comments_elemens_width = 683;	
			
			
		}
		//alert(cg_slider_comments_elemens_width);
		
	
	

	
	$('#show_comments_slider').empty();
	
	
	
	var countCommentsQuantity = $("#countCommentsQuantity"+cg_picture_id).val();
	//alert(1);
	//alert(countCommentsQuantity);

if(countCommentsQuantity>=1){
	//alert(2);
	$("#cg_slider_top_hr_div").remove();
	//alert(2);
	
//	$("#cg_rate_stars_image").empty();
 var loadingSource = $('#cg_loadingGifSource').val();
	 $("#show_comments_slider").append("<img class='cg_loading_gif_img' src='"+loadingSource+"' width='19px' height='19px' style='display:hidden;'>");
	// $("#rating_cg").empty(); 
	$("#cg_loading_gif_img").load(function(){$(this).toggle();}); 
			
	jQuery.ajax({
		url : post_cg_show_comments_slider_wordpress_ajax_script_function_name.cg_show_comments_slider_ajax_url,
		type : 'post',
		data : {
			action : 'post_cg_show_comments_slider',
			action1 : cg_picture_id,		
			action2 : cg_slider_comments_elemens_width	
		},
		success : function( response ) {
			jQuery("#show_comments_slider").html( response );
		}
	});
		
}

})
})