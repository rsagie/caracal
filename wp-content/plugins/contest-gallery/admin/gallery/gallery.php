<?php 

//Pr�fung ob neue Gallerie gerade kreiert wurde, wenn nicht dann sicherheitshalber reload erzwingen, zwecks cache aktualisierung
if(!@$_GET['create'] AND !@$_POST['create_zip'] AND !@$_GET['delete_zip'] AND !@$_POST['create_data_csv']
 AND !@$_GET['delete_data_csv'] AND !@$_POST['changeGalery'] AND !@$_POST['chooseAction1']
 AND !@$_POST['edit_gallery_hidden_post']){?>
<script type='text/javascript'>
//Check if the current URL contains '#'img
//Reload sollte immer 1 Mal geschehen, falls User �ber den Back Button zur�ck kommt
if(document.URL.indexOf("#img")==-1)
{
// Set the URL to whatever it was plus "#".
url = document.URL+"#img";
location = "#img";

//alert(1);

//Reload the page
location.reload(true);

}
</script>
<?php

sleep(1);

}



/*
echo "<br>";
echo $uploadFolder['baseurl'];/*

		/*$cachefiles = dirname(__FILE__).'/../../../../uploads/contest-gallery/gallery-id-'.$GalleryID.'/cache/look-thumb-0-80.html';
		$cachefiles1 = dirname(__FILE__).'/../../../../uploads/contest-gallery/gallery-id-'.$GalleryID.'/cache/*';
		
		if(file_exists($cachefiles )){echo "EXISTS";}
		else{echo "not exists";}*/

include("get-data.php");
include(dirname(__FILE__) . "/../nav-gallery.php");
include("header-1.php");
include("header-2.php");
		

	// Bestimmen ob ABSTEIGEND oder AUFSTEIGEND
	

		
	
// -------------------------------Ausgabe der eingetragenen Felder. Hauptdiv id=sortable. Sortierbare Felder div id=sortableDiv				
		

		echo "<form action='?page=contest-gallery/index.php&option_id=$GalleryID&step=$step&start=$start&edit_gallery=true' method='POST'>";	
		echo '<input type="hidden" name="option_id" value="'. $GalleryID .'">';
		//echo "<div id='sortable' style='width:935px;border: 1px solid #DFDFDF;background-color:#fff;padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:20px;'>";
		
		echo "<ul id='sortable' style='width:895px;padding:20px;background-color:#fff;margin-bottom:0px !important;margin-bottom:0px;border: 1px solid #DFDFDF;>";
		
		// Bei der ersten Abarbeitung notwendig
		echo "<li style='width:891px;border: 1px solid #DFDFDF;padding-top:10px;padding-bottom:10px;display:table;' id='div' class='sortableDiv'>";
// Wird gebraucht um die h�chste RowID am Anfang zu ermitln
	    $r = 0;	
		
	
		foreach($selectSQL as $value){
		
			$selectedCheck = "".$value->Active."";

				if ($selectedCheck == 1){
				$checkedActive = "checked";
				}
				else {
				$checkedActive = "";
				}

		$id = $value->id;
		$rowid = $value->rowid;
		$Timestamp = $value->Timestamp."_";
		$NamePic = $value->NamePic;
		$CountC = $value->CountC;
		$rating = $value->Rating;
		$countR = $value->CountR;
		$countS = $value->CountS;
		
		
		$urlForFacebook=$urlSource.'/wp-content/uploads/contest-gallery/gallery-id-'.$GalleryID.'/'.$Timestamp.$NamePic.".html";
//echo $urlForFacebook;
		//echo "$id";
		
		if(!$rating){$rating=0;} 
		
		// Die h�chste RowID wird gebraucht und sp�ter von JavaScript verarbeitet
				/*$r++;
		
				if ($r==1) {
				
				echo '<input type="hidden" id="highestRowId" value="'. $rowid .'">';
				
				}*/
		// Die h�chste RowID wird gebraucht und sp�ter von JavaScript verarbeitet --- END
		
		
		echo "<br/>";
		
		echo "<li style='width:891px;border: 1px solid #DFDFDF;padding-top:10px;padding-bottom:10px;display:table;' id='div$id' class='sortableDiv'>";
		
		
		
		
		echo "<br/>";
		
		// hidden inputs zur bestimmung der Reihenfolge
		echo "<input type='hidden' name='row[$id]'  class='rowId' value='$rowid'>"; // Zur Feststellung der Reihenfolge, wird vom Javascript verarbeitet
		echo "<input type='hidden' name='count[]' value=\"$id\">";
		echo "<input type='hidden' name='changeGalery' value='changeGalery'>";
		// hidden inputs zur bestimmung der Reihenfolge ENDE
		
		
		
		// ------ Bild wird mittig und passend zum Div angezeigt	
		
						
					// destination of the uploaded original image
					
					$uploadFolder = wp_upload_dir();
					
					// Feststellen der Quelle des Original Images		
					$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType; // Pfad zum Bilderordner angeben
					$sourceOriginalImgShow = $uploadFolder['baseurl'].'/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType; // Pfad zum Bilderordner angeben
					list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und H�he von original Image
					
					$WidthThumb = 125;
					$HeightThumb = 81;
				
					
					// Ermittlung der H�he nach Skalierung. Falls unter der eingestellten H�he, dann n�chstgr��eres Bild nehmen.
					$heightScaledThumb = $WidthThumb*$heightOriginalImg/$widthOriginalImg;
					
					
					// Falls unter der eingestellten H�he, dann gr��eres Bild nehmen (normales Bild oder panorama Bild, kein Vertikalbild)
					
					if ($heightScaledThumb <= $HeightThumb) {
					
					$widthScaledThumb = $HeightThumb*$widthOriginalImg/$heightOriginalImg;
					
					@$imageThumb = $NamePic."-300width.".$ImgType;		


					// Bestimmung von Breite des Bildes
					$WidthThumbPic = $HeightThumb*$widthOriginalImg/$heightOriginalImg;
					$WidthThumbPic = $WidthThumbPic.'px';
					
					// Bestimmung wie viel links und rechts abgeschnitten werden soll
					$paddingLeftRight = ($WidthThumbPic-$WidthThumb)/2;
					$paddingLeftRight = $paddingLeftRight.'px';
					
					$padding = "left: -$paddingLeftRight;right: -$paddingLeftRight";
					
					}
					
					
					// Falls �ber der eingestellten H�he, dann kleineres Bild nehmen (kein Vertikalbild)
					if ($heightScaledThumb > $HeightThumb) {
					
					@$imageThumb = $NamePic."-300width.".$ImgType;		
				
					// Bestimmung von Breite des Bildes
					$WidthThumbPic = $WidthThumb.'px';
					
					// Bestimmung wie viel oben und unten abgeschnitten werden soll
					$heightImageThumb = $WidthThumb*$heightOriginalImg/$widthOriginalImg;
					$paddingTopBottom = ($heightImageThumb-$HeightThumb)/2;
					$paddingTopBottom = $paddingTopBottom.'px';
					
					$padding = "top: -$paddingTopBottom;bottom: -$paddingTopBottom";
					
					}

		// Bild wird mittig und passend zum Div angezeigt	--------  ENDE
		
		
		
		// ----------- Ermitteln der Sprache des Blogs, um das Upload Datum in richtiger schreibweise anzuzeigen
	
		$uploadTime = date('m/d/Y h:i a', $value->Timestamp);
			

		// Ermitteln der Sprache des Blogs, um das Upload Datum in richtiger schreibweise anzuzeigen  ------------  ENDE
		
		
		//$uploads = wp_upload_dir();
//$WPdestination = $uploads['baseurl'].'/contest-gallery/gallery-id-'.$GalleryID.'/'; // Pfad zum Bilderordner angeben
		
		
		echo "<div style='float:left;width:125px;margin-left:20px;'>";
		echo '<div style="width:125px;height:81px;overflow: hidden !important;position: relative;float:left;display:inline;margin-left:1px;">';
		echo '<a href="'.$sourceOriginalImgShow.'" target="_blank" title="Show full size" alt="Show full size"><img src="'.$content_url.'/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-300width.'.$value->ImgType.'" style="'.$padding.';position: absolute !important;max-width:none !important;" width="'.$WidthThumbPic.'"></a>';
		//echo '<a href="'.$sourceOriginalImgShow.'" target="_blank" title="Show full size" alt="Show full size"><img src="'.$WPdestination.$value->Timestamp.'_'.$value->NamePic.'-300width.'.$value->ImgType.'" style="'.$padding.';position: absolute !important;max-width:none !important;" width="'.$WidthThumbPic.'"></a>';
		echo "</div>";
		echo '<div style="width:125px;text-align:center;font-size:11px;float:left;margin-right:20px;"><input type="text" disabled name="upload-date" value=" '.$uploadTime .'" style="width:125px;text-align:center;font-size:11px;float:left;margin-right:20px;" ></div>';
	
	

		// Berechnung und Anzeige des durchschnittlichen Ratings
		
		echo '<div style="display:inline-block;position:relative;width:108px;font-size:11px;float:left;margin:0px auto;background-color: #23282D;padding: 3px;padding-left: 15px;">';
		
			if($AllowRating==1){
				
				if ($countR!=0){
					$averageStars = $rating/$countR;
					$averageStarsRounded = round($averageStars,0);
					//echo "<br>averageStars: $averageStars<br>";					
				}
				
			else{$countR=0; $averageStarsRounded = 0;}
		
		
			if($averageStarsRounded>=1){$starTest1 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest1 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=2){$starTest2 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest2 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=3){$starTest3 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest3 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=4){$starTest4 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest4 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=5){$starTest5 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest5 = $iconsURL.'/star_off_48_reduced.png';}
			
			
			echo "<div style='display:inline-block;float:left;width:13px;height:11px;vertical-align: middle;'><img src='$starTest1'  style='float:left;cursor:default;' alt='1'></div>";
			echo "<div style='display:inline;float:left;width:13px;height:11px;vertical-align: middle;'><img src='$starTest2'  style='float:left;cursor:default;' alt='2'></div>";
			echo "<div style='display:inline;float:left;width:13px;height:11px;vertical-align: middle;'><img src='$starTest3'  style='float:left;cursor:default;' alt='3'></div>";
			echo "<div style='display:inline;float:left;width:13px;height:11px;vertical-align: middle;'><img src='$starTest4'  style='float:left;cursor:default;' alt='4'></div>";
			echo "<div style='display:inline;float:left;width:13px;height:11px;vertical-align: middle;'><img src='$starTest5'  style='float:left;cursor:default;' alt='5'></div>";

			echo "<div style='display:inline;float:left;font-size:15px;v-align: top;line-height: 15px;height: 15px;color:#fff;'><b>&nbsp;(".@$countR.")</b></div>";	
			echo "<br/>";
			echo "<div style='display:inline-block;position:relative;font-size:12px;v-align: top;line-height: 12px;height: 12px;color:#fff;text-align:center;margin-top:4px;' ><b>Cumulated: (".$rating.")</b></div>";	
			echo "<br/>";
			
			}
			
			if($AllowRating==2){
				
				if ($countS>0){
					$countS = $countS;
				}
				else{$countS=0;}
		
			if($countS>=1){$starTest6 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest6 = $iconsURL.'/star_off_48_reduced.png';}	
			
			echo "<div style='display:inline-block;float:left;width:13px;height:11px;vertical-align: middle;margin-left:25px;'><img src='$starTest6'  style='float:left;cursor:default;' alt='1'></div>";
			echo "<div style='display:inline;float:left;font-size:15px;v-align: center;line-height: 15px;height: 15px;color:#fff;padding-top:1px;'><b>&nbsp;&nbsp;(".@$countS.")</b></div>";
			echo "<br/>";
			
			}
	
	
	
	
	
	/*
	if($FbLike==1){
	echo "<div style='display:inline-block;font-size:12px;line-height: 28px;height: 28px;color:#fff;position:relative;width:100px;overflow:hidden;margin-left:5px;' >";
	echo "<div style='z-index:15;border:none;margin: 0;padding 5;height:30px;position:absolute;width:45px;left:4px;top:1px;background-color: #23282D;'>";
	echo "<b>Fb Like:</b>";
	echo "</div>";
	echo "<div style='border:none;margin: 0;padding 0;height:25px;position:absolute;width:200px;top:0px;z-index:0;left:-90px;top:5px;' id='cg_fb_like_div".$realId."'>";
	echo "<iframe src='".$urlForFacebook."'  style='border: none;width:180px;height:50px;overflow:hidden;' scrolling='no' id='cg_fb_like_iframe_gallery".$realId."'  name='cg_fb_like_iframe_gallery".$realId."'></iframe>";
	echo "</div>";
	echo "</div>";
	}*/
		echo '</div>';

		// Berechnung und Anzeige des durchschnittlichen Ratings --- ENDE

		echo "</div>";
		
		


		
		
								/*	echo "<div id='cg_answerJPG' style='position:absolute;margin-right:35px;width:460px;background-color:white;border:1px solid;padding:5px;display:none;'>";
							echo "This allows you to restrict the resolution of the pictures which will be uploaded in frontend. It depends on your web hosting provider how big resolution ca be be for uploaded pics.";
							echo " If your webhosting packet is not so powerfull then you should use this restriction.</div>";*/
		
		echo "<div style='float:left;margin-left:20px;width:470px !important;' id='cg_fields_div'>";
		
		//print_r($selectUpload);
		
		// FELDBENENNUNGEN

		// 1 = Feldtyp
		// 2 = Feldnummer
		// 3 = Feldtitel
		// 4 = Feldinhalt
		// 5 = Feldkrieterium1
		// 6 = Feldkrieterium2
		// 7 = Felderfordernis
		
		$r = 0; // Notwendig zur �berpr�fung ab wann das dritte Feld versteckt wird. ACHTUNG: Bild-Uploadfeld immer dabei, dasswegen r>=4 zum Schluss.
		
		//print_r($selectContentFieldArray);
		//print_r($ShowSliderInputID); 
		
		if ($selectFormInput == true) {
		

					//$countFormFields = 0;
					foreach($selectContentFieldArray as $key => $formvalue){
					
							
							// 1. Feld Typ
							// 2. ID des Feldes in F_INPUT
							// 3. Feld Reihenfolge
							// 4. Feld Content 
							
							
													
							if(@$formvalue=='text-f'){$fieldtype="nf"; $i=1; continue;}	
							if(@$fieldtype=="nf" AND $i==1){$formFieldId=$formvalue; $i=2; continue;}	
							if(@$fieldtype=="nf" AND $i==2){$fieldOrder=$formvalue; $i=3; continue;}	
							if (@$fieldtype=="nf" AND $i==3) {
							
							//$getEntries = $wpdb->get_var( "SELECT Short_Text FROM $tablenameentries WHERE pid='$id' AND f_input_id = '$formFieldId'");
							
							$getEntries = $wpdb->get_var( $wpdb->prepare( 
							"
								SELECT Short_Text
								FROM $tablenameentries 
								WHERE pid = %d and f_input_id = %d
							", 
							$id,$formFieldId
							) );
							
							// Pr�fen ob das Feld im Slider angezeigt werden soll
							if($AllowGalleryScript==1){
							if(array_search($formFieldId, @$ShowSliderInputID)){$checked='checked';}
							else{$checked='';}
							}
							
							echo "<div style='width:540px;' >";
							echo "$formvalue:<br/>";
							//echo "$formFieldId:<br/>";
							echo "<input type='hidden' name='content[]' value='$id'>";
							echo "<input type='hidden' name='content[]' value='$formFieldId'>";
							echo "<input type='hidden' name='content[]' value='$fieldOrder'>";
							echo "<input type='hidden' name='content[]' value='text-f'>";
							echo "<input type='text' value='$getEntries' name='content[]'  style='width: 500px;' maxlength='100'>";
							
							//echo "$Use_as_URL_id";
							//echo "<br>$formFieldId";
							
							if(@$Use_as_URL_id==$formFieldId AND $ForwardToURL==1){
								
							echo "&nbsp;&nbsp;&nbsp;<strong>URL</strong>";	
								
							}
							else{
							/*if($AllowGalleryScript==1){
							echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='cg_field_$formFieldId' name='cg_f_input_id[$formFieldId]' title='This field will appear in slider if you hook it.' $checked>";
							}*/
							}
							echo "</div>";

							$fieldtype='';
							
							$i=0;
							
							}
							
							if($formvalue=='email-f'){@$fieldtype="ef";  $i=1; continue;}	
							if(@$fieldtype=="ef" AND $i==1){$formFieldId=$formvalue; $i=2; continue;}	
							if(@$fieldtype=="ef" AND $i==2){$fieldOrder=$formvalue; $i=3; continue;}	
							if (@$fieldtype=='ef' AND $i==3) {
							
							//$getEntries = $wpdb->get_var( "SELECT Short_Text FROM $tablenameentries WHERE pid='$id' AND f_input_id = '$formFieldId'");
							
							$getEntries = $wpdb->get_var( $wpdb->prepare(
							"
								SELECT Short_Text
								FROM $tablenameentries 
								WHERE pid = %d and f_input_id = %d
							", 
							$id,$formFieldId
							) );
							
														// Pr�fen ob das Feld im Slider angezeigt werden soll
													if($AllowGalleryScript==1){
								if(array_search($formFieldId, @$ShowSliderInputID)){$checked='checked';}
								else{$checked='';}
													}
							
							echo "<div style='width:540px;'>";
							echo "$formvalue:<br/>";
							//echo "$formFieldId:<br/>";
							echo "<input type='hidden' name='content[]' value='$id'>";
							echo "<input type='hidden' name='content[]' value='$formFieldId'>";
							echo "<input type='hidden' name='content[]' value='$fieldOrder'>";
							echo "<input type='hidden' name='content[]' value='email-f'>";
							echo "<input type='text' value='$getEntries' name='content[]'  style='width: 500px;' class='email'  maxlength='100'>";
							echo "<input type='hidden' value='$getEntries' name='email[$id]'  style='width: 500px;' class='email-clone'  maxlength='100'>";
							/*if($AllowGalleryScript==1){
							echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='cg_field_$formFieldId' name='cg_f_input_id[$formFieldId]' title='This field will appear in slider if you hook it.' $checked>";
							}*/
							echo "</div>";
							
							$fieldtype='';
							
							$i=0;						
							
							}
							
							if($formvalue=='comment-f'){$fieldtype="kf"; $i=1; continue;}	
							if($fieldtype=="kf" AND $i==1){$formFieldId=$formvalue; $i=2; continue;}	
							if($fieldtype=="kf" AND $i==2){$fieldOrder=$formvalue; $i=3; continue;}	
							if ($fieldtype=='kf' AND $i==3) {
							
							//$getEntries = $wpdb->get_var( "SELECT Long_Text FROM $tablenameentries WHERE pid='$id' AND f_input_id = '$formFieldId'");
							
							$getEntries = $wpdb->get_var( $wpdb->prepare( 
							"
								SELECT Long_Text
								FROM $tablenameentries 
								WHERE pid = %d and f_input_id = %d
							", 
							$id,$formFieldId
							) );
							
							
							$getEntries1 = html_entity_decode(stripslashes($getEntries));
							
							// Pr�fen ob das Feld im Slider angezeigt werden soll
							if($AllowGalleryScript==1){
								if(array_search($formFieldId, @$ShowSliderInputID)){$checked='checked';}
								else{$checked='';}
							}
							
							echo "<div style='width:540px;'>";
							echo "$formvalue:<br/>";
							//echo "$formFieldId:<br/>";
							echo "<input type='hidden' name='content[]' value='$id'>";
							echo "<input type='hidden' name='content[]' value='$formFieldId'>";
							echo "<input type='hidden' name='content[]' value='$fieldOrder'>";
							echo "<input type='hidden' name='content[]' value='comment-f'>";
							echo "<textarea name='content[]' style='width: 500px;' rows='4'  maxlength='1000'>$getEntries1</textarea>";
							/*if($AllowGalleryScript==1){
							echo "<input type='checkbox' class='cg_field_$formFieldId' name='cg_f_input_id[$formFieldId]' title='This field will appear in slider if you hook it.' style='float:right;margin-right:11px;margin-top:6px;' $checked>";
							}*/
							//echo '<div id="cg_questionJPG" style="display:inline;"><p style="font-size:18px;display:inline;">&nbsp;<a><b>?</b></a></p></div>';
							echo "</div>";
							
							$fieldtype='';
							
							$i=0;
								
							}

													
						}
					
				
					
					
					
				
		
			if ($r>=4) {
			echo "</div>"; //Bild-Uploadfeld immer dabei, dasswegen r>=4 zum Schluss.
			}
		
			else{
		
			echo "&nbsp;";
		
			}
			
			
		
		}
		
		else{
		
		echo "&nbsp;";
		
		}
		
		echo "</div>";
		echo "<div style='float:left;width:160px;margin-left:85px;'>";		
		echo "<div class='informdiv' style='margin-bottom:18px;'>";
		
		
		// �berpr�fe ob schon aktiviert ist oder nicht
		
		$Active = $value->Active;
		//echo "$Active";
		
		if ($Active == 1) {echo 'Activate/Delete:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;';
		echo '<input type="checkbox" class="1activate_'. $id .'" value="'. $id .'" ' . $checkedActive . ' name="active['.$id.']" >';
		echo '<input type="hidden" class="deactivate_'. $id .'" value="'. $id .'"  name="deactivate['.$id.']" disabled >';
		//echo "<input type='hidden' name='active[$id]' value=\"$id\" class='image-delete' >";
		} // Beim Anklicken erscheinen Felder zum Deaktivieren
		else{echo 'Activate/Delete:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  ';
		'<input type="checkbox" class="1activate_'. $id .'" value="'. $id .'" ' . $checkedActive . '>';
		echo '<input type="checkbox" class="1activate_'. $id .'" value="'. $id .'" name="active['.$id.']" >';
		echo '<input type="hidden" class="deactivate_'. $id .'" value="'. $id .'" name="deactivate['.$id.']" >';
		//echo "<input type='hidden' disabled name='active[$id]' value=\"$id\" class='image-delete' >";
		} // Beim Anklicken erscheinen Felder zum Aktivieren
		
		if($CountC>0){ echo "<br><br><a href=\"?page=contest-gallery/index.php&option_id=$GalleryID&show_comments=true&id=$id\">Comments</a>"; }
		else{ echo ""; }
		
		if($countSelectSQL>4){
		echo "<br><br><a href='#cg_go_to_save_button'>Go save</a>";
		}
		
		// �berpr�fe ob schon aktiviert ist oder nicht --- ENDE
		
		// Check if user should be informed or is informed
		
		$Informed = $value->Informed;
		if($Informed==1){echo "<br><b>Informed</b><br>";}
		else{echo "<br><br><br><b></b>";}
		//echo "<br>Inform: $Inform<br>";
		
		//echo "<br>Activate: $Activate<br>";
		
		
		

		
		
	//echo "<br>Informed: $Informed<br>";
		//if($Informed==1){  echo "klappt";}
		
		if($Active==1){

				if ($Inform == 1) {
				
					//$Informed = $value->Informed;
					
					$InformedId = ($Informed==1) ? "<input type='hidden' disabled name='informId[]' value=\"$id\" class='image-delete' >" : "<input type='hidden' name='informId[]' value=\"$id\" class='image-delete' >";
					$resetInformedId = ($Informed==1) ? "<input type='hidden' name='resetInformId[]' value=\"$id\" class='image-delete' >" :  "";
					//$InformedVisual = ($Informed==1) ? "&nbsp;<b>I</b>" :  "";
					
					//if($Informed==1){  echo "klappt";}
					echo $InformedId;
					echo $resetInformedId;
				
				}		
		
			echo '<input type="hidden" name="imageUnlinkOrigin[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageUnlink300[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-300width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageUnlink624[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-624width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageUnlink1024[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-1024width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageUnlink1600[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-1600width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageUnlink1920[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-1920width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageFbHTMLUnlink[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.html" class="image-delete">';
			
			//$dirHTML = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$GalleryID.'/'.$Timestamp."_".$NamePic.".html";
			
		}
		
		if($Active!=1){ 
		
				if ($Inform == 1) {
				
					$Informed = $value->Informed;
					
					$InformedId = ($Informed==1) ? "<input type='hidden' disabled name='informId[]' value=\"$id\" class='image-delete' >" : "<input type='hidden' disabled name='informId[]' value=\"$id\" class='image-delete' >";
					$resetInformedId = ($Informed==1) ? "<input type='hidden' name='resetInformId[]' value=\"$id\" class='image-delete' >" :  "";
					$InformedVisual = ($Informed==1) ? "&nbsp;<b>I</b>" :  "";
					
					echo $InformedId;
					echo $resetInformedId;
					
			
				}	
		
		
			echo '<input type="hidden" disabled name="imageUnlinkOrigin[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageUnlink300[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-300width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageUnlink624[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-624width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageUnlink1024[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-1024width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageUnlink1600[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-1600width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageUnlink1920[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-1920width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageFbHTMLUnlink[]" value="/contest-gallery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.html" class="image-delete">';
		
		
		}
		
		
		
		echo "</div>";
		
		if(@$countC>0){  
		echo "<div >";
		echo '<a href="?page=contest-gallery/index.php&pictureID=' . $id . '">Comments</a><br/>';
		echo "</div>";
		}
		echo "</div>";
		echo "</li>";


		}
		
				echo "</ul>";
				
								echo "<div style='padding:20px;background-color:white;width:895px;text-align:right;margin-top:0px;border-bottom: 1px solid #DFDFDF;border-left: 1px solid #DFDFDF;border-right: 1px solid #DFDFDF;'>";
		echo "<a name='cg_go_to_save_button'></a>";
		echo "<select name='chooseAction1' id='chooseAction1'>";
		
		echo "<option value='1'>Activate Image(s)/Save Data &nbsp;</option>";
		echo "<option value='2'>Delete Image(s)/Data</option>";
		
		/*
		if($selectSQL){  
		echo "<option value='4'>Zip selected</option>";
		}*/
		
		if($checkInformed){  
		echo "<option value='3'>Reset informed</option>";
		}
		
		echo "</select>";
		
		echo '&nbsp;&nbsp; <input type="submit" name="submit" value="Save" id="cg_gallery_backend_submit" style="text-align:center;width:80px;">';

						
		echo "</div>";
				

				
		

		
				
	
		echo '</form>';
		
		if(@$_POST['chooseAction1'] == 4 and (@$_POST['informId']==false and @$_POST['resetInformId']==false)){
		
			?><script>alert("You have to select pics.");</script><?php
		
		}
		
				echo "<br/>";
				echo "<br/>";
				
				
				
				// Ausgabe der eingetragenen Felder. Hauptdiv id=sortable. Sortierbare Felder div id=sortableDiv ----- ENDE			
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

?>