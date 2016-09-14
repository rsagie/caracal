<noscript>
<div style="border: 1px solid purple; padding: 10px">
<span style="color:red">Enable JavaScript to use the form</span>
</div>
<style>
#upload_btn {
  position: fixed;
    bottom: 60px;
    right: 198px;
    border-radius: 50%;
    height: 40px;
    width: 40px;
    background: #3bc492;
    color: #fff;
    text-align: center;
    line-height: 41px;
    font-size: 20px;
}

#upload_div{
	z-index: 20;
    position: fixed;
    background: white;
    top: 30px;
    box-shadow: -1px 5px 21px #888888;
    display:none;
    width: 600px;
    left: 50%;
    margin-left: -300px
}
</style>
</noscript>
<?php


if(@$_GET["cg_upload"]){
	
	//echo "222";
			global $wpdb;
			
			
			$galeryID = @$_GET["cg_id"];
			$contest_gal1ery_options_input = $wpdb->prefix . "contest_gal1ery_options_input";
			$inputOptionsSQL = $wpdb->get_row( "SELECT * FROM $contest_gal1ery_options_input WHERE id='$galeryID'"); 

			$Confirmation_Text = $inputOptionsSQL->Confirmation_Text;
			$Confirmation_Text = html_entity_decode(stripslashes($Confirmation_Text));
			echo "<a href='#cg_success'></a>";
			echo "<div id='cg_success' style='padding-bottom:100px;'>";			
			echo "</div>";
			echo $Confirmation_Text;	
			
			
			
			?>

<script>

//Löschung der Werte in den Feldern beim erfolgreichen Ausfüllen des Formulars
		/*$("#name").val("");
		$("#comment").val("");
		
					      $('html, body').animate({
        scrollTop: $("#cg-comments-div").offset().top
    }, 400);	*/
		
// Sprung zur Meldung ob Formulardaten erfolgreich übermittelt wurden oder nicht
		//$('#go-to-comment-success').click();
		



	
//location.href = "#";

// Sprung zur Meldung ob Formulardaten erfolgreich übermittelt wurden oder nicht
location.href = "#cg_success";

//alert("lala");



		

</script>

<?php	
	
	
}


else if(@$_POST['submit']){
include('users-upload-check.php');
}
 else{
 include("check-language.php");
 

// Ermitteln der maximalen UploadSize
$get_max_post = (int)(ini_get('post_max_size'));

//echo "<br>get_max_post: $get_max_post<br>";

$upload_max_filesize = ini_get('upload_max_filesize');



$post_max_sizeMB = $get_max_post.'MB';



$max_post = $get_max_post.'m';

$upload_mb = min(@$max_upload, @$max_post, @$memory_limit);





$memory_limit = (int)(ini_get('memory_limit'));



	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );
$galeryID = $atts['id'];


//echo "$galeryID";

//echo "GaleryID: $galeryID<br/>";


	global $wpdb;

	$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
	$tablenameFormInput = $wpdb->prefix . "contest_gal1ery_f_input";
	
	//echo "tablenameOptions: $tablenameOptions<br/>";
	//echo "tablenameFormInput: $tablenameFormInput<br/>";
	//echo "GaleryID: $galeryID<br/>";

	$picsSQL1 = $wpdb->get_row( "SELECT * FROM $tablenameOptions WHERE id='$galeryID'");
	
	$getUploadForm = $wpdb->get_results("SELECT * FROM $tablenameFormInput WHERE GalleryID='$galeryID' ORDER BY Field_Order ASC");
	
	//print_r($getUploadForm);

	@$MemoryLimit = $picsSQL1->MemoryLimit;
	
				if(!function_exists('formatBytes2')){function formatBytes2($bytes, $precision = 2) { 
				$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

				$bytes = max($bytes, 0); 
				$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
				$pow = min($pow, count($units) - 1); 

				$bytes /= pow(1024, $pow); 

				return round($bytes, $precision) . ' ' . $units[$pow]; 
			}
			
			}
			
			if(!function_exists('return_bytes1')){
				function return_bytes1($val) {
				$val = trim($val);
				$last = strtolower($val[strlen($val)-1]);
				switch($last) {
					// The 'G' modifier is available since PHP 5.1.0
					case 'g':
						$val *= 1024;
					case 'm':
						$val *= 1024;
					case 'k':
						$val *= 1024;
		
				}

				return $val;
			}
			}
			
			//echo "Return Bytes: <br>";
			//echo return_bytes1($max_post);
			//echo "<br>";
			
	
			
			$max_post = return_bytes1($max_post);
			
			//echo "<br>max_post: $max_post<br>";
			
			//echo "<br/>Post Max Size: $post_max_size<br/>";
			
			$memoryPeak = formatBytes2(memory_get_peak_usage(),2);
			
			//echo "<br/>";
			//echo formatBytes2(memory_get_peak_usage(),2);
			//echo "<br/>";
			
			//$maxMemory = $MemoryLimit-$MemoryLimit/100*16-$memoryPeak;
			
			$maxMemory = $MemoryLimit-$MemoryLimit/100*16-$memoryPeak;
			
			// Ermitteln der maximalen Auflösung der einzelnen Formate
			
			
			//print_r($MaxRes);
			
			/* aktuelle MaxRes Options

			$maxRes = array();
			$maxRes[] = '';//JPG
			$maxRes[] = 'JPG';
			$maxRes[] = '';
			$maxRes[] = 1;//PNG
			$maxRes[] = 'PNG';
			$maxRes[] = '';
			$maxRes[] = 1;//GIF
			$maxRes[] = 'GIF';
			$maxRes[] = '';
			
			*/
			
			$i = 3;
			
			if (@$MaxRes) {		
			
		
				foreach($MaxRes as $key => $value){
				
				if ($i == 0) {$i=3;}
				
				if ($i == 3) {$resRestrict = ($value=='on') ? 'on' : 'off';}
				
				if ($i == 2) {
				if($value == 'JPG'){$imgType = 'JPG';}
				elseif($value == 'PNG'){$imgType = 'PNG';}
				elseif($value == 'GIF'){$imgType = 'GIF';}
				}
				
				if ($i == 1) {
				
				if ($imgType=='JPG'){$maxResJpg = (!$value) ? 0 : $value; $restrictJpg = ($resRestrict=='on') ? 1 : 0 ;}
				elseif($imgType=='GIF'){$maxResPng = (!$value) ? 0 : $value; $restrictPng = ($resRestrict=='on') ? 1 : 0 ;}
				elseif($imgType=='PNG'){$maxResGif = (!$value) ? 0 : $value; $restrictGif = ($resRestrict=='on') ? 1 : 0 ;}
				
				}
				
				$i--;
				
				}
			
			}
			
			else {
			
			echo "";
			
			}
			
			$MaxResJPGon = intval($picsSQL1->MaxResJPGon);
			$MaxResPNGon = intval($picsSQL1->MaxResPNGon);
			$MaxResGIFon = intval($picsSQL1->MaxResGIFon);
			
			$MaxResJPGwidth = intval($picsSQL1->MaxResJPGwidth);
			$MaxResJPGheight = intval($picsSQL1->MaxResJPGheight);
			$MaxResPNGwidth = intval($picsSQL1->MaxResPNGwidth);
			$MaxResPNGheight = intval($picsSQL1->MaxResPNGheight);
			$MaxResGIFwidth = intval($picsSQL1->MaxResGIFwidth);
			$MaxResGIFheight = intval($picsSQL1->MaxResGIFheight);
			
			$ContestEnd = $picsSQL1->ContestEnd;
			$ContestEndTime = $picsSQL1->ContestEndTime;
			

			//echo "<br>ContestEnd: $ContestEnd<br>";
			//echo "<br>ContestEndTime: $ContestEndTime<br>";
			
			
			$ActivatePostMaxMB = $wpdb->get_var("SELECT ActivatePostMaxMB FROM $tablenameOptions WHERE id = '$galeryID'");
			//echo "ActivatePostMaxMB: $ActivatePostMaxMB <br>";
			if($ActivatePostMaxMB==1){
				$PostMaxMB = $wpdb->get_var("SELECT PostMaxMB FROM $tablenameOptions WHERE id = '$galeryID'");
			}
			else{
				$PostMaxMB=$get_max_post;
			}
//echo "PostMaxMB: $PostMaxMB <br>";
			
			
			$ActivateBulkUpload = $wpdb->get_var("SELECT ActivateBulkUpload FROM $tablenameOptions WHERE id = '$galeryID'");
			
			if($ActivateBulkUpload==1){
				$SingleBulkUploadConfiguration = "name='data[]' multiple";
			}
			else{
				$SingleBulkUploadConfiguration = "name='data[]' ";
			}
			
			
			$BulkUploadQuantity = $wpdb->get_var("SELECT BulkUploadQuantity FROM $tablenameOptions WHERE id = '$galeryID'");
			$BulkUploadMinQuantity = $wpdb->get_var("SELECT BulkUploadMinQuantity FROM $tablenameOptions WHERE id = '$galeryID'");
			
echo "<input type='hidden' value='$MaxResJPGon' id='restrictJpg' />";
echo "<input type='hidden' value='$MaxResJPGwidth' id='MaxResJPGwidth' />";
echo "<input type='hidden' value='$MaxResJPGheight' id='MaxResJPGheight' />";
echo "<input type='hidden' value='$MaxResPNGon' id='restrictPng' />";
echo "<input type='hidden' value='$MaxResPNGwidth' id='MaxResPNGwidth' />";
echo "<input type='hidden' value='$MaxResPNGheight' id='MaxResPNGheight' />";
echo "<input type='hidden' value='$MaxResGIFon' id='restrictGif' />";
echo "<input type='hidden' value='$MaxResGIFwidth' id='MaxResGIFwidth' />";
echo "<input type='hidden' value='$MaxResGIFheight' id='MaxResGIFheight' />";
echo "<input type='hidden' value='$get_max_post' id='post_max_size_php_ini' />";
echo "<input type='hidden' value='$PostMaxMB' id='post_max_size_user_config' />";


echo "<input type='hidden' value='$ActivateBulkUpload' id='ActivateBulkUpload' />";


echo "<input type='hidden' id='cg_ContestEndTime' value='".@$ContestEndTime."'>";
echo "<input type='hidden' id='cg_ContestEnd' value='".@$ContestEnd."'>";
echo "<input type='hidden' id='cg_photo_contest_over' value='$language_ThePhotoContestIsOver.'>";



//echo "$ContestEndTime";


echo "<input type='hidden' value='$BulkUploadQuantity' id='BulkUploadQuantity' />";
echo "<input type='hidden' value='$BulkUploadMinQuantity' id='BulkUploadMinQuantity' />";
			
		
			//echo "<br/>MaxResolutionJPG: $maxResJpg<br/>";
			//echo "<br/>MaxResolutionPNG: $maxResPng<br/>";
			//echo "<br/>MaxResolutionGIF: $maxResGif<br/>";
			
			
			/*
			
			// Maximaler mögliche Auflösung für JPG Bilder  
			
			if ($maxMemory < 34) {$maxResJPG = 1000000; }
			elseif ($maxMemory < 38) {$maxResJPG = 2000000; }
			elseif ($maxMemory < 43) {$maxResJPG = 3000000; }
			elseif ($maxMemory < 48) {$maxResJPG = 4000000; } 
			elseif ($maxMemory < 53) {$maxResJPG = 5000000; }
			elseif ($maxMemory < 57) {$maxResJPG = 6000000; }
			elseif ($maxMemory < 59) {$maxResJPG = 6250000; }
			elseif ($maxMemory < 62) {$maxResJPG = 7000000; }
			
			// Maximaler mögliche Auflösung für PNG Bilder
			
			if ($maxMemory < 37) {$maxResPNG = 1000000; }
			elseif ($maxMemory < 44) {$maxResPNG = 2000000; }
			elseif ($maxMemory < 52) {$maxResPNG = 3000000; }
			elseif ($maxMemory < 59) {$maxResPNG = 4000000; }
			elseif ($maxMemory < 72) {$maxResPNG = 5000000; }
			elseif ($maxMemory < 75) {$maxResPNG = 6000000; }
			elseif ($maxMemory < 77) {$maxResPNG = 6250000; } */
	







 
 
/*
<noscript>
<div style="border: 1px solid purple; padding: 10px">
<span style="color:red">You have to activate JavaScript to use the form</span>
</div>
</noscript>	*/

echo "<label for="cg_bh" id="upload_btn">+</label>";
echo "<div id='upload_div' style='visibility:hidden;>";

echo "<div id='ausgabe1' style='visibility:hidden; text-align:left;color:#000;'>";


		// User ID Überprüfung ob es die selbe ist
		$check = wp_create_nonce("check");



$path = $_SERVER['REQUEST_URI'];
echo "<div>";
echo '<form action="'.$path.'" method="post" id="form" enctype="multipart/form-data">';

echo "<input type='hidden' name='check' value='$check'>";

echo "<input type='hidden' name='GalleryID' value='$galeryID'>";


if(!isset($_POST['submit'])){


$i=0;

// Beim Eintrag wird gesendet:
/*
- Feldart
- FeldID
- FeldReihenfolge
- Content
*/

//echo "<br>getUploadform:<br>";
//print_r($getUploadForm );

		foreach($getUploadForm as $value){
	
		if ($value->Field_Type=='image-f'){
		
			@$id = $value->f_input_id;
			$Field_Order = $value->Field_Order;
			$Field_Content = $value->Field_Content;
			$Field_Content = unserialize($Field_Content);
			foreach($Field_Content as $key => $value){if($key=='titel'){ $titel = $value; break;} }
			
	

					echo "<div style='text-align:left;' id='cg-upload-$Field_Order'><div style='display:inline;font-size:18px;'>$titel *<br/></div>";
					echo "<input type='file' style='visibility:hidden' class='bh' id='cg_bh' $SingleBulkUploadConfiguration />";// Content Feld
					//echo "<input type='submit' value='Upload' />";
					echo "<p class='append'></p>";// Fehlermeldung erscheint hier
					echo "</div>";

	
		}	

		if (@$value->Field_Type=='text-f'){
		
			$id = $value->id;
			$Field_Order = $value->Field_Order;
			$Field_Content = $value->Field_Content;
			$Field_Content = unserialize($Field_Content);
			foreach($Field_Content as $key => $value){
				if($key=='titel'){ $titel = $value; }
				
				if($key=='min-char'){ $minsize = ($value) ? "$value" : "" ;}
				if($key=='max-char'){ $maxsize = ($value) ? "$value" : "" ;}
				
				if($key=='mandatory'){ 
				$necessary = ($value=='on') ? '*' : '' ;
				$checkIfNeed = ($value=='on') ? 'on' : '' ;
				}
			}
			
			echo "<div id='cg-upload-$Field_Order''><div style='display:inline;float:left;font-size:18px;'>$titel $necessary</div>";
			echo "<input type='hidden' name='form_input[]' value='nf'><input type='hidden' name='form_input[]' value='$id'><br/>";// Formart und FormfeldID hidden
			echo "<input type='hidden' name='form_input[]'  value='$Field_Order'>";// Feldreihenfolge wird mitgegeben
			echo "<input type='text'  class='nf' value='' name='form_input[]' style='width:100%;'>";// Content Feld, länge wird überprüft
			echo "<input type='hidden' class='minsize' value='$minsize'>"; // Prüfen minimale Anzahl zeichen
			echo "<input type='hidden' class='maxsize' value='$maxsize'>"; // Prüfen maximale Anzahl zeichen
			echo "<input type='hidden' class='checkIfNeed' value='$checkIfNeed'>";// Prüfen ob Pflichteingabe
			echo "<p class='append'></p>";// Fehlermeldung erscheint hier
			echo "</div>";
						
		}
	
		
		
		if (@$value->Field_Type=='email-f'){
		
			$id = $value->id;		
			$Field_Order = $value->Field_Order;
			$Field_Content = $value->Field_Content;
			$Field_Content = unserialize($Field_Content);
			foreach($Field_Content as $key => $value){
				if($key=='titel'){ $titel = $value; }
				if($key=='mandatory'){ 
				$necessary = ($value=='on') ? '*' : '' ;
				$checkIfNeed = ($value=='on') ? 'on' : '' ;
				}
			}
			echo "<div id='cg-upload-$Field_Order'><div style='display:inline;float:left;font-size:18px;'>$titel $necessary</div>";
			echo "<input type='hidden' name='form_input[]'  value='ef'><input type='hidden' name='form_input[]' value='$id'><br/>";//Formart und FormfeldID hidden
			echo "<input type='hidden' name='form_input[]'  value='$Field_Order'>";// Feldreihenfolge wird mitgegeben
			echo "<input type='text' value='' class='ef' style='width:100%;' name='form_input[]'>";// Content Feld, länge wird überprüft
			echo "<input type='hidden' class='checkIfNeed' value='$checkIfNeed'>";// Prüfen ob Pflichteingabe
			echo "<p class='append'></p>";// Fehlermeldung erscheint hier
			echo "</div>";
		}

		if (@$value->Field_Type=='comment-f'){
		
			$id = $value->id;				
			$Field_Order = $value->Field_Order;
			$Field_Content = $value->Field_Content;
			$Field_Content = unserialize($Field_Content);
			foreach($Field_Content as $key => $value){
				if($key=='titel'){ $titel = $value; }
				
				if($key=='min-char'){ $minsize = ($value) ? "$value" : "";}
				if($key=='max-char'){ $maxsize = ($value) ? "$value" : "";}
				
				if($key=='mandatory'){ 
				$necessary = ($value=='on') ? '*' : '' ;
				$checkIfNeed = ($value=='on') ? 'on' : '' ;
				}
			}

			echo "<div id='cg-upload-$Field_Order'><div style='display:inline;float:left;font-size:18px;'>$titel $necessary</div>";
			echo "<input type='hidden' name='form_input[]'  value='kf'><input type='hidden' name='form_input[]' value='$id'><br/>";// Formart und FormfeldID hidden
			echo "<input type='hidden' name='form_input[]'  value='$Field_Order'>";// Feldreihenfolge wird mitgegeben
			echo "<textarea maxlength='1000' class='kf' name='form_input[]'  style='width:100%;' rows='10' ></textarea>";// Content Feld, länge wird überprüft
			echo "<input type='hidden' class='minsize' value='$minsize'>"; // Prüfen minimale Anzahl zeichen
			echo "<input type='hidden' class='maxsize' value='$maxsize'>"; // Prüfen maximale Anzahl zeichen
			echo "<input type='hidden' class='checkIfNeed' value='$checkIfNeed'>";// Prüfen ob Pflichteingabe
			echo "<p class='append'></p>";// Fehlermeldung erscheint hier
			echo "</div>";
			
		}
		
		
		if (@$value->Field_Type=='check-f'){
		
			$id = $value->id;				
			$Field_Order = $value->Field_Order;
			$Field_Content = $value->Field_Content;
			$Field_Content = unserialize($Field_Content);
			foreach($Field_Content as $key => $value){
				if($key=='titel'){ $titel = $value; }
				if($key=='content'){ $content = html_entity_decode(stripslashes($value)); }
				}

			echo "<div id='cg-upload-$Field_Order'><div style='display:inline;float:left;font-size:18px;'>$titel * </div>";
			echo "<input type='checkbox' class='cg-check-f' style='display:inline;'>";
			echo "<div style='display:block;width:100%;float:left;text-align:left;'>$content</div><br/>";// Content Feld, länge wird überprüft
			echo "<p class='append'></p>";// Fehlermeldung erscheint hier 
			echo "</div>";
			
		}
		
	}
	
//$unix = time()+2;

//echo '<input type="hidden" name="timestamp" value="'.$unix.'">';


echo "";
//echo "<div style='display:inline;width:100%;float:left;text-align:left;'>";
echo '<input type="submit" name="submit" id="cg_users_upload_submit" value="'.$language_Send.'" style="min-width:150px;">';
//echo "</div>";
echo '</form>';
echo "</div>";
echo "</div> <!-- ausgabe1 --> ";// Zum schließen des obersten Divs #ausgabe1, ist auf hidden wegen javascript

echo "</div><!-- upload_div -->";

echo "<br/>";

//echo "<input type='hidden' id='resPic'>";

}
//echo "$language_MaximumAllowedWidthForJPGsIs";
echo "<input type='hidden' id='cg_show_upload' value='1'>";

//echo "language_ThisFileTypeIsNotAllowed: $language_ThisFileTypeIsNotAllowed";
echo "<input type='hidden' id='cg_file_not_allowed_1' value='$language_ThisFileTypeIsNotAllowed'>";
echo "<input type='hidden' id='cg_file_size_to_big' value='$language_TheFileYouChoosedIsToBigMaxAllowedSize'>";
echo "<input type='hidden' id='cg_post_size' value='$post_max_sizeMB'>";

echo "<input type='hidden' id='cg_to_high_resolution' value='$language_TheResolutionOfThisPicIs'>";

echo "<input type='hidden' id='cg_max_allowed_resolution_jpg' value='$language_MaximumAllowedResolutionForJPGsIs'>";
echo "<input type='hidden' id='cg_max_allowed_width_jpg' value='$language_MaximumAllowedWidthForJPGsIs'>";
echo "<input type='hidden' id='cg_max_allowed_height_jpg' value='$language_MaximumAllowedHeightForJPGsIs'>";

echo "<input type='hidden' id='cg_max_allowed_resolution_png' value='$language_MaximumAllowedResolutionForPNGsIs'>";
echo "<input type='hidden' id='cg_max_allowed_width_png' value='$language_MaximumAllowedWidthForPNGsIs'>";
echo "<input type='hidden' id='cg_max_allowed_height_png' value='$language_MaximumAllowedHeightForPNGsIs'>";

echo "<input type='hidden' id='cg_max_allowed_resolution_gif' value='$language_MaximumAllowedResolutionForGIFsIs'>";
echo "<input type='hidden' id='cg_max_allowed_width_gif' value='$language_MaximumAllowedWidthForGIFsIs'>";
echo "<input type='hidden' id='cg_max_allowed_height_gif' value='$language_MaximumAllowedHeightForGIFsIs'>";


echo "<input type='hidden' id='cg_check_agreement' value='$language_YouHaveToCheckThisAgreement '>";
echo "<input type='hidden' id='cg_check_email_upload' value='$language_EmailAdressHasToBeValid'>";
echo "<input type='hidden' id='cg_min_characters_text' value='$language_MinAmountOfCharacters'>";
echo "<input type='hidden' id='cg_max_characters_text' value='$language_MaxAmountOfCharacters'>";
echo "<input type='hidden' id='cg_no_picture_is_choosed' value='$language_ChooseYourImage'>";


echo "<input type='hidden' id='cg_language_BulkUploadQuantityIs' value='$language_BulkUploadQuantityIs'>";
echo "<input type='hidden' id='cg_language_BulkUploadLowQuantityIs' value='$language_BulkUploadLowQuantityIs'>";



echo "<input type='hidden' id='cg_e_prevent_default' value=''>";


}


?>