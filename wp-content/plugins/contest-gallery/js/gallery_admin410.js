jQuery(document).ready(function($){


$("#cg_changes_saved").fadeOut(3000);



//Check if the current URL contains '#'


/*
alert(window.location.href);
if(window.location.href.indexOf("#img") > -1) {
alert(window.location.href);
alert(1);
history.pushState("", document.title, window.location.pathname);
	
location.reload(true);

	
}
else{
	
alert(2);
	
}*/


// Nicht löschen, wurde ursprünglich dazu markiert alle Felder auswählen zu lassen die im Slider gezeigt werden sollen, Logik könnte noch nützlich sein!

/*	
	$( "[class*=cg_field]" ).hover(function() {
   $('#cg_answerJPG').toggle();
    $(this).css('cursor','pointer');
});




	//header("Cache-Control: private, must-revalidate,max-age=0, no-store, no-cache, must-revalidate, post-check=0, pre-check=0" );

	
	var allFieldClasses = $( "#cg_fields_div" ).children();
	var r=0;
	 $( "#cg_fields_div").children('div').each(function( i ) {
		r++;
	 var getClass = $(this).find("[class*=cg_field_]").attr("class");
	// alert(getClass);
	//	alert(r);
	//	alert(r);
	});
	


// Bestimmung welche Felder im Slider angezeigt werden sollen, wenn Slider Funktion gewählt ist.	
	/*$('[class*=cg_field]').attr('title', function(){
    return $(this).prev('input').val();
});*/

/*
$(document).on('click', '[class*=cg_field]', function(e){
	
	//alert(2);
	var getClass = $(this).attr("class");
	
	if($(this).is( ":checked" )){
			$("."+getClass+"").each(function( i ) {
			$(this).prop('checked',true);
		//alert(1);
			});

	}

	else{
		
		$("."+getClass+"").each(function( i ) {
		$(this).prop('checked',false);
//	alert(2);
			});
		
		
	}
	
});*/

	
// Nicht löschen, wurde ursprünglich dazu markiert alle Felder auswählen zu lassen die im Slider gezeigt werden sollen, Logik könnte noch nützlich sein! --- ENDE	
	
	
	
	//alert(allFieldClasses);
	
      function countChar(val) {
        var len = val.value.length;
        if (len >= 1000) {
          val.value = val.value.substring(0, 1000);
        } else {
          $('#charNum').text(1000 - len);
        }
      };
	  
	  
	  // Verstecken weiterer Boxen

    $('.mehr').hide();
    $('.clickBack').hide();


    $('.clickMore').click( function() {
         // Zeigen oder Verstecken:

         $(this).next().slideDown('slow');
	     $(this).next(".mehr").next(".clickBack").toggle();
		 $(this).hide();		 

		 
    })
	
	    $('.clickBack').click( function() {
		 $(this).prev().slideUp('slow');
	     $(this).prev(".mehr").prev(".clickMore").toggle();
		 $(this).hide();		
		 
		 
    })

// Verstecken weiterer Boxen ---- ENDE

// Change Daten ändern oder löschen

//$( "#chooseAction1" ).change(function() {

//var chooseAction = $( "#chooseAction1 option:selected" ).val();

//alert('test');
  //alert(chooseAction);
  
  //if ($( "#chooseAction1 option:selected" ).val()==1) {
	
	//$("#chooseAction").remove();
    //$( "#sortable1" ).append('<input type="text" id="chooseAction" name="chooseAction" value="showPics">');
 // alert( "Handler for .change() called.234" ); 
  
  //}
  
    //if ($( "#chooseAction1 option:selected" ).val()==2) {
  
	//$("#chooseAction").remove();
    //$( "#sortable3" ).append("<input type='text' id='chooseAction' name='deletePics' value='deletePics'>");
	//alert( "Handler for .change() called.5678" );
  
  //}
  
//});


// Change Daten ändern oder löschen -- END 


/*
$("input[class*=deactivate]").change(function(){

//$( this ).parent( "div input .imageThumb" ).removeAttr("disabled");
//$( this ).closest( "input" ).removeAttr("disabled");
//$( this ).parent().find( "input .imageThumb" ).removeAttr("disabled"); 

if($(this).is(":checked")){
var platzhalter = 'keine Aktion';
$( this ).parent().find(".deactivate").remove();
$( this ).parent().find( ".image-delete" ).prop("disabled",false);
}

else{

var id = $(this).val();
$( this ).parent().append("<input type='hidden' name='deactivate[]' value='"+id+"' class='deactivate'>" );
$( this ).parent().find( ".image-delete" ).prop("disabled",true);
}


});*/

$("input[class*=1activate]").change(function(){
	

if($(this).is(":checked")){
//alert(1);
var id = $(this).val();

$( this ).parent().find( "input[class*=deactivate]" ).prop("disabled",true);
// Urls zum Löschen von Bildern werden mitgeschickt wenn Delete Pics ausgewählt wurde
$( this ).parent().find( ".image-delete" ).prop("disabled",false);
//$( this ).parent().append("<input type='hidden' name='activate[]' value='"+id+"' class='activate'>" );

//$( this ).parent().append('test123');

}

else{
	//alert(2);
$( this ).parent().find( "input[class*=deactivate]" ).prop("disabled",false);	
// Urls zum Löschen von Bildern werden mitgeschickt wenn Delete Pics ausgewählt wurde
$( this ).parent().find( ".image-delete" ).prop("disabled",true);

//$( this ).parent().find(".activate").remove();
//$( this ).parent().append('test123');
}


});


// Duplicate email to a hidden field for form


$(".email").change(function(){

var email = $( this ).val();

$( this ).parent().find( ".email-clone" ).val(email);

});

// Duplicate email to a hidden field for form -- END 


$("div input #activate").click(function() {
    $("input #inform").prop("disabled", this.checked);
});

/*function informAll(){

//alert(arg);
alert(arg1);

if($("#informAll").is( ":checked" )){
$( "input[class*=inform]").removeAttr("checked",true);
$( "input[class*=inform]").click();
}

else{
$( "input[class*=inform]").click();

}

}*/

// Alle Bilder auswählen 

var n = 0;

$("#chooseAll").click(function(){


n++;
$("#click-count").val(n);



if($("#chooseAll").is( ":checked" )){
//alert('works');
//$( "input[class*=activate]").removeAttr("checked",true);
//$( "input[class*=activate]").prop("checked",true);
//$( "input[class*=1activate]").click();
$("input[class*=1activate]").prop("checked",true);
$("input[class*=deactivate]").prop("disabled",true);
// Urls zum Löschen von Bildern werden mitgeschickt wenn Delete Pics ausgewählt wurde
$( ".image-delete" ).prop("disabled",false);
/*
if (n>2) {
$( "input[class*=deactivate]").click();
}*/

}
else{
//alert('works');
//$( "input[class*=activate]").removeAttr("checked",true);
//$( "input[class*=activate]").removeAttr("checked",true);
//$( "input[class*=activate]").prop("checked",true);
$("input[class*=1activate]").prop("checked",false);
$("input[class*=deactivate]").prop("disabled",false);
// Urls zum Löschen von Bildern werden mitgeschickt wenn Delete Pics ausgewählt wurde
$( ".image-delete" ).prop("disabled",true);


//$( "input[class*=deactivate]").click();
//$( "input[class*=1activate]").click();


}

});

// Alle Bilder auswählen --- END


//Sortieren der Galerie




	var v = 0;
	
	var $i = 0;
	
	var rowid = [];
	
		if($i==0){  
	
			$( ".sortableDiv" ).each(function( i ) {
					  
			var rowidValue =  $(this).find('.rowId').val(); 
			
			
			rowid.push(rowidValue);
							
			});
			
			$i++;

		}
	
	  
	  $(function() {
		$( "#sortable" ).sortable({cursor: "move",placeholder: "ui-state-highlight", stop: function( event, ui ) {

	if(document.readyState === "complete"){



			  $( ".sortableDiv" ).each(function( i ) {
			  

			  
			$(this).find('.rowId').val(rowid[v]); 

			
			v++;

					  
			   });  
			   
			   v = 0;
			   
			   }
			   
	   }	
		
		});
		$('#sortable').css('cursor', 'move');
	  });

//Sortieren der Galerie --- ENDE
	  

  
});