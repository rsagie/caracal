<?php

/*error_reporting(E_ALL); 
ini_set('display_errors', 'On');*/

	$start = 0; // Startwert setzen (0 = 1. Zeile)
	$step =10;

	if (isset($_GET["start"])) {
	  $muster = "/^[0-9]+$/"; // reg. Ausdruck f�r Zahlen
	  if (preg_match($muster, @$_GET["start"]) == 0) {
		$start = 0; // Bei Manipulation R�ckfall auf 0
	  } else {
		$start = intval(@$_GET["start"]);
	  }
	}
	
	if (isset($_GET["step"])) {
	  $muster = "/^[0-9]+$/"; // reg. Ausdruck f�r Zahlen
	  if (preg_match($muster, @$_GET["start"]) == 0) {
		$step = 10; // Bei Manipulation R�ckfall auf 0  
	  } else {
		$step = intval(@$_GET["step"]);
	  }
	}
	
	$GalleryID = intval(@$_GET['option_id']);

	global $wpdb;

	// Set table names
	$tablename = $wpdb->prefix . "contest_gal1ery";
	$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
	$tablenameentries = $wpdb->prefix . "contest_gal1ery_entries"; 
	
	// Set table names --- END  
	
	
	
// DATEN L�schen und exit

/* Siehe Datei delete-pics.php
	// 2 = delete Pics
	if (@$_POST['chooseAction1']==2) {
	
	echo "TEST DELTE";
	
		$deleteQuery = 'DELETE FROM ' . $tablename . ' WHERE';
	
		$deleteParameters = '';

		/*
		foreach($activate as $key => $value){
	
		
					$deleteQuery .= ' id = "' . $value . '"';
					$deleteQuery .= ' or';
					
					$deleteParameters .= $value.",";
	
		} */
		
		/*
		foreach($activate as $key => $value){
	
		
					$deleteQuery .= ' id = %d';
					$deleteQuery .= ' or';
					
					$deleteParameters .= $value.",";
	
		}
		
		$deleteQuery = substr($deleteQuery,0,-3);	
		$deleteParameters = substr($deleteParameters,0,-1);	

		
		$wpdb->query( $wpdb->prepare(
			"
				$deleteQuery
			", 
				$deleteParameters
		 ));
		
		echo $deleteQuery;
		echo "<br>";
		echo $deleteParameters;
	
		$imageUnlink = @$_POST['imageUnlink'];
	
		foreach($imageUnlink as $key1 => $valueunlink){
		
		@unlink("../wp-content/uploads/$valueunlink");

		}
		
	//$deleteQuery = substr($deleteQuery,0,-3);	
	//$deleteSQL = $wpdb->query($deleteQuery);
	
	
	// Path to admin
	
	$path = plugins_url();
	
	$path .= "/contest-gallery/admin/certain-gallery.php";
	

	
	}*/
	
	
	
	
// DATEN L�schen und exit ENDE	

	
	/*
	// Change Order Auswahl
	if (@$_GET['dauswahl']==true) {

$dauswahl = (@$_POST['dauswahl']=='dab') ? 0 : 1;

$updateorder = "UPDATE $tablenameOptions SET OrderPics='$dauswahl' WHERE id = '$GalleryID' ";
$updateSQLorder = $wpdb->query($updateorder);	

}*/

	// Change Order Auswahl --- ENDE
	
	$galeryrow = $wpdb->get_row( "SELECT * FROM $tablenameOptions WHERE id = '$GalleryID'" );
	
	$informORnot = $galeryrow->Inform;
	//$AllowGalleryScript = $galeryrow->AllowGalleryScript;  

	// START QUERIES


	
	
	
	// Update Rows
	$querySETrow = 'UPDATE ' . $tablename . ' SET rowid = CASE id '; 
	$querySETaddRow = ' ELSE rowid END WHERE id IN (';
		
	// Update Inform
	
	//$updateInformIds = '(';
	
	// START QUERIES --- END
	
	$tablenameemail = $wpdb->prefix . "contest_gal1ery_mail";	
	$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";	
	$contest_gal1ery_f_input = $wpdb->prefix . "contest_gal1ery_f_input";	
	$selectSQLemail = $wpdb->get_row( "SELECT * FROM $tablenameemail WHERE GalleryID = '$GalleryID'" );
	
	$Subject = $selectSQLemail->Header;
	$Admin = $selectSQLemail->Admin;
	$Reply = $selectSQLemail->Reply;
	$cc = $selectSQLemail->CC;
	$bcc = $selectSQLemail->BCC;
	$Msg = $selectSQLemail->Content;
	//$Msg = html_entity_decode(stripslashes($Msg1));
	
	// echo "<br>MSG:<br>";
	// echo "Msg: $Msg";
	// echo "<br>";
	//$Msg = $selectSQLemail->Content;
	
	
	$url = $selectSQLemail->URL;	
	$url = (strpos($url,'?')) ? $url.'&' : $url.'?';
	
	$contentMail = $selectSQLemail->Content;
	
	$posUrl = "\$url\$";
	
	// echo $posUrl;
	
	$urlCheck = (strpos($contentMail,$posUrl)) ? 1 : 0;
	
	
	
	/*
	if ($AllowGalleryScript==0) {
	
	$urlCheck = (strpos($contentMail,"$url")) ? 1 : 0;
	
	
	}*/
	
	// Update welche Felder gezeigt werden sollen im slider
	
	/*
	$optionsSQL = $wpdb->get_row( "SELECT AllowGalleryScript FROM $tablenameOptions WHERE id = '$GalleryID'" );
	
	$AllowGalleryScript = $optionsSQL->AllowGalleryScript;
	
	//echo "script: ".$AllowGalleryScript;
	
	if($AllowGalleryScript==1){
		
		
				// Vorher pauschal alle auf null updaten		
		$wpdb->update(
		"$contest_gal1ery_f_input",
		array( 
			'Show_Slider' => "0"									
		), 
		array( 'GalleryID' => "$GalleryID" ),
		array( '%d'	), 
		array( '%d' )
		);
		
	}
	
	
	if (@$_POST['cg_f_input_id']) {
		
	
		
		$cg_f_input_id = $_POST['cg_f_input_id'];
	//	print_r($cg_f_input_id);
		foreach($cg_f_input_id as $key => $value){
			
			if($value=="on"){$set = 1;}
			else{$set = 0;}
			//echo $key;
			//echo "<br>";
			//echo $set;
			
								$wpdb->update(
								"$contest_gal1ery_f_input",
								array( 
									'Show_Slider' => "$set"									
								), 
								array( 'id' => "$key" ),
								array( '%d'	), 
								array( '%d' )
								);	
			
			
		}
		
	}*/
	

	
		
	// Insert content
	
	
	// 1. ID
	// 2. Feldreihenfolge
	// 3. Feldart
	// 4. Content
	
	
	$i = 0;
	
	if (@$_POST['content']) {
	
	//echo "<br>content";
	
	$content = @$_POST['content'];
	
	//print_r($content);
	
	//echo "<br>";
	
	
			foreach($content as $key => $value){
			
							// 1. Picture ID
							// 2. ID des Feldes in F_INPUT
							// 3. Feld Reihenfolge
							// 4. Feld Typ
							// 5. Feld Content
			
			$i++;
			
							// 1. Bild-ID und Uniuqe Form ID
							if ($i==1){$id=intval($value);}	
							// 2. ID des Feldes in F_INPUT
							if ($i==2){$formFieldId=intval($value);}							
							// 3. Feldreihenfolge
							if ($i==3){$field_order=intval($value);}
							// 4. Feldart
							if ($i==4){$field_type=sanitize_text_field($value);}	
							// 5. Content
							if ($i == 5 AND ($field_type=='text-f' OR $field_type=='email-f')) {
							
								$value = nl2br(htmlspecialchars($value));
								$value = sanitize_text_field($value);
							
								$checkEntries = $wpdb->get_results("SELECT 1 FROM $tablenameentries WHERE pid = '$id' AND f_input_id = '$formFieldId' LIMIT 1");
											
								if(!$checkEntries){
								/*$wpdb->insert( $tablenameentries, array( "id" => "", "pid" => "$id", "f_input_id" => "$formFieldId", "GalleryID" => "$GalleryID",
								"Field_Type" => "$field_type", "Field_Order" => "$field_order", "Short_Text" => "$value", "Long_Text" => "" ) );*/
								
								$wpdb->query( $wpdb->prepare(
								"
									INSERT INTO $tablenameentries
									( id, pid, f_input_id, GalleryID, 
									Field_Type, Field_Order, Short_Text, Long_Text)
									VALUES ( %s,%d,%d,%d,
									%s,%d,%s,%s ) 
								", 
									'',$id,$formFieldId,$GalleryID,
									$field_type,$field_order,$value,''
								) );
								
								}
								

		 
								
								if($checkEntries){//echo "textf sdafsdaf sadf";
								//$querySETcontent = "UPDATE $tablenameentries  SET Short_Text ='$value' WHERE pid = '$id' AND f_input_id = '$formFieldId' ";
								//$updateSQLcontent = $wpdb->query($querySETcontent);	
								
								$wpdb->update(
								"$tablenameentries",
								array( 
									'Short_Text' => "$value"									
								), 
								array( 'pid' => $id, 'f_input_id' => $formFieldId  ),
								array( '%s'	), 
								array( '%d','%d' )
								);							
								
								}
							
							$i = 0;
							
							}
							
							// 5. Content
							if ($i == 5 AND $field_type=='comment-f') {
							
								$value = nl2br(htmlspecialchars($value));
								$value = sanitize_text_field($value);
							
								$checkEntries = $wpdb->get_results("SELECT 1 FROM $tablenameentries WHERE pid = '$id' AND f_input_id = '$formFieldId' LIMIT 1");
											
								if(!$checkEntries){
								//$wpdb->insert( $tablenameentries, array( "id" => "", "pid" => "$id", "f_input_id" => "$formFieldId", 
								//"GalleryID" => "$GalleryID", "Field_Type" => "$field_type", "Field_Order" => "$field_order", "Short_Text" => "", "Long_Text" => "$value" ) );
								
								$wpdb->query( $wpdb->prepare(
								"
									INSERT INTO $tablenameentries
									( id, pid, f_input_id, GalleryID, 
									Field_Type, Field_Order, Short_Text, Long_Text)
									VALUES ( %s,%d,%d,%d,
									%s,%d,%s,%s ) 
								", 
									'',$id,$formFieldId,$GalleryID,
									$field_type,$field_order,'',$value
								) );
								
								
								}
								
								if($checkEntries){
								//echo "safsafsadfs cyvyc";
								//$querySETcontent = "UPDATE $tablenameentries  SET Long_Text ='$value' WHERE pid = '$id' AND f_input_id = '$formFieldId' ";
								//$updateSQLcontent = $wpdb->query($querySETcontent);
								
								$wpdb->update(
								"$tablenameentries",
								array( 
									'Long_Text' => "$value"									
								), 
								array( 'pid' => $id, 'f_input_id' => $formFieldId ),
								array( '%s'	), 
								array( '%d','%d'  )
								);		
																
								}
								
							$i = 0;

							}						
	
			}
			
	
	}
	
	// Insert content --- END
	
	
	
// Reihenfolge der Bilder �ndern und Activate bei allen erstmal auf 0 setzten (die die auf 1 geh�ren werden in sp�terer Schleife auf 1 gesetzt)
	
	
	// 	Bilder daktivieren
	
	//$querySET0 = 'UPDATE ' . $tablename . ' SET Active="0" WHERE';
	
	if (@$_POST['deactivate']==true) {
	
		$deactivate = @$_POST['deactivate'];

		foreach($deactivate as $key => $value){

		// Set to 0
		//$querySET0 .= ' id = "' . $value . '"';
		//$querySET0 .= ' or';
		
				$wpdb->update( 
				"$tablename",
				array('Active' => '0'), 
				array('id' => $value), 
				array('%d'),
				array('%d')
				);
		
		}
	
	}
	
	//$count = @$_POST['count'];
	$rowid = @$_POST['row'];
	
	@$querySET0 = substr($querySET0,0,-3);
	$updateSQL = $wpdb->query($querySET0);
	
	
	// Reihenfolge der Bilder wechseln
	
	foreach($rowid as $key => $value){	

	// UPDATE ROW
	$querySETrow .= " WHEN $key THEN $value";
	$querySETaddRow .= "$key,";	
			
	}
	
	$querySETaddRow = substr($querySETaddRow,0,-1);
	$querySETaddRow .= ")";
	
	$querySETrow .= $querySETaddRow;
    $updateSQL = $wpdb->query($querySETrow);

// Reihenfolge der Bilder �ndern und Activate bei allen erstmal auf 0 setzten (die die auf 1 geh�ren werden in sp�terer Schleife auf 1 gesetzt) --- ENDE	
	
	// 	Bilder aktivieren
	
	if (@$_POST['active']==true) {
	
	$activate = @$_POST['active'];
	
				foreach($activate as $key => $value){
				
				
				$wpdb->update( 
				"$tablename",
				array('Active' => '1'), 
				array('id' => $value), 
				array('%d'),
				array('%d')
				);
								
				}
				

				
				
				
							$picsSQL = $wpdb->get_results( "SELECT * FROM $tablename WHERE GalleryID='$GalleryID' AND Active='1' ORDER BY rowid DESC");		
									
											// Gr��e der Bilder bei ThumbAnsicht (gew�hnliche Ansicht mit Bewertung)
							$uploadFolder = wp_upload_dir();
							$urlSource = site_url();							
							$blog_title = get_bloginfo(); 			

						
				foreach($picsSQL as $value12){
				
					
						$id = $value12->id;
						$rowid = $value12->rowid;
						$Timestamp = $value12->Timestamp;
						$NamePic = $value12->NamePic;
						$ImgType = $value12->ImgType;
						$rating = $value12->Rating;
						$countR = $value12->CountR;
						$countC = $value12->CountC;

							$dirHTML = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$GalleryID.'/'.$Timestamp."_".$NamePic.".html";
							
							if(!file_exists($dirHTML)){
																
									$scrImgMeta624 = $uploadFolder['baseurl'].'/contest-gallery/gallery-id-'.$GalleryID.'/'.$Timestamp."_".$NamePic."-624width.".$ImgType."";
									$scrImgMeta1024 = $uploadFolder['baseurl'].'/contest-gallery/gallery-id-'.$GalleryID.'/'.$Timestamp."_".$NamePic."-1024width.".$ImgType."";
									$scrImgMeta = $uploadFolder['baseurl'].'/contest-gallery/gallery-id-'.$GalleryID.'/'.$Timestamp."_".$NamePic.".".$ImgType."";
									
									$urlForFacebook= $urlSource.'/wp-content/uploads/contest-gallery/gallery-id-'.$GalleryID."/".$Timestamp."_".$NamePic.".html";

										
									//$urlForFacebook= $urlSource.'/wp-content/uploads/contest-gallery/gallery-id-'.$GalleryID."/".$Timestamp."_".$NamePic.".html";

									
									$fields = '<!DOCTYPE html>
									<html lang="en">
									<head>
									<title>'.$blog_title.'</title>
									<meta property="og:url"           content="'.$urlForFacebook.'" />
									<meta property="og:type"          content="website" />
									<meta property="og:title"         content="'.$blog_title.'" />
									<meta property="og:image"         content="'.$scrImgMeta624.'" />
									<meta charset="utf-8">
									<meta name="viewport" content="width=device-width, initial-scale=1.0">
									 </head>
									 <body>
									 
									 <div id="fb-root"></div>
									<script>(function(d, s, id) {
									  var js, fjs = d.getElementsByTagName(s)[0];
									  if (d.getElementById(id)) return;
									  js = d.createElement(s); js.id = id;
									  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
									  fjs.parentNode.insertBefore(js, fjs);
									}(document, "script", "facebook-jssdk"));
									</script>		  
										
									<div class="fb-like" data-href="'.$urlForFacebook.'" data-layout="button_count" data-action="like" data-share="true" style="float:left;display:inline;width:76px;vertical-align: middle;position:absolute;top:0px;height: 20px;width:400px;overflow:hidden;"></div>
									<div style="margin-top:40px;"><img src="'.$scrImgMeta1024.'" width="800px" /></div>

									  
									  
									</body>
									</html>';
									$fp = fopen($dirHTML, 'w');
									fwrite($fp, $fields);
									fclose($fp);	

								}
	
				}
	}
	
		//$querySET = substr($querySET,0,-3);
		//$updateSQL = $wpdb->query($querySET);

	
// Activate Users ---- END


// Reset informierte Felder

	if(@$_POST['chooseAction1']==3){
	
	//echo "<b>TREEWRSDFSDETWERSDF</b>";
	
		if (@$_POST['resetInformId']==true) {
		
		//echo "resetInformId:";
		$resetInformId = @$_POST['resetInformId'];
		
		//print_r($querySETresetInformId);
		
		// Reset informierte Felder Query
		$querySETresetInformId = 'UPDATE ' . $tablename . ' SET Informed="0" WHERE';
		
		
		
			foreach($resetInformId as $key => $value){

			$querySETresetInformId .= ' id = "' . $value . '"';
			$querySETresetInformId .= ' or';
			
			}
			
		$querySETresetInformId = substr($querySETresetInformId,0,-3);
		$updateSQL = $wpdb->query($querySETresetInformId);
		
		}
	
	}
	
		

	
// Reset informierte Felder ---- END

$informId = @$_POST['informId'];

//echo "<br>informID: $informId<br>";

//echo "activate:<br>";

//print_r($activate);

//$emails = sanitize_text_field(@$_POST['email']);
$emails = @$_POST['email'];

//print_r($emails);

// Inform Users database save

			//$updateInform = 'UPDATE ' . $tablename . ' SET Informed="1" WHERE';

			if (@$_POST['informId']) {
			
			$informId = @$_POST['informId'];
			
			//print_r($informId);
			
				if ($informORnot==1  AND @$_POST['chooseAction1'] != 3) {
				
				$informId = @$_POST['informId'];
							
					foreach($informId as $key => $value){
					
						$To = $emails[$value];
					
						if (filter_var($To, FILTER_VALIDATE_EMAIL)) {
					
						//$updateInform .= ' id = "' . $value . '"';
						//$updateInform .= ' or';
						
						$wpdb->update( 
						"$tablename",
						array('Informed' => '1'), 
						array('id' => $value), 
						array('%d'),
						array('%d')
						);
						
						}
						
					
					}
				
				}
			
			}
			
	//$updateInform = substr($updateInform ,0,-3);
	//$updateSQLinform = $wpdb->query($updateInform);			
			
// Inform Users database save --- END		 


// Inform Users if picture is activated per Mail


			if ($informORnot==1 AND @$_POST['chooseAction1'] != 3) {
			
//echo "Post:";
//print_r(@$_POST['informId']);
			
			if (@$_POST['informId']) {
			
				foreach($informId as $key => $value){

					if(!empty($emails[$value])){
					
						//echo "<br/>";
			
						//echo "Emails Key:";
						//print_r($emails[$value]);
						//echo "<br/>";
						
						$To = sanitize_text_field($emails[$value]);
						
							if (filter_var($To, FILTER_VALIDATE_EMAIL)) {
				
						//if (in_array($informId[$key],$activate)) {
								
								/*
								if($urlCheck==1){
								
								//echo "TEST�$%";
										
								$url1 = $url."pictureID=$value#begin";
										
								$link = '$url';
										
								$Msg = str_replace($link, $url1, $contentMail);
										
								}*/
								
								
							// 	echo "<br>";
							// 			echo 'TRESSDFSD4645435435';
							// 	echo $Msg;
							// 	echo "<br>";
																
								if($urlCheck==1 and $url==true){
								
								//echo "TEST�$%";
								
								$codedPictureId = ($value+8)*2+100000; // Verschl�sselte ID ermitteln. Gecachte Sites sind mit verschl�sselter ID gespeichert.
										
								$url1 = $url."picture_id=$codedPictureId#cg-begin";
										
								$replacePosUrl = '$url$';
										
								$Msg = str_replace($replacePosUrl, $url1, $contentMail);
										
								}
								
								
								
						
								//$headers["Mime"] = "MIME-Version: 1.0";
								//$headers["Content-type"] = "Content-type: text/html; charset=iso-8859-1";	
								
								$To = $emails[$value];
								
								//echo $To;
								//echo "Inform Email: ";
								//echo $emails[$value];
								
								//$headers["Bcc"] = "Bcc: $bcc";
								//$headers["Reply"] = "Reply-To: $Reply";
								
								
								
								require_once(dirname(__FILE__)."/class-inform-user.php");
								$headers .= "Reply-To: ". strip_tags($Reply) . "\r\n";
								$headers .= "CC: $cc\r\n";
								$headers .= "BCC: $bcc\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=utf-8\r\n";
								
								//echo "$headers";
								
								
								//add_filter( 'wp_mail', 'rw_change_email_headers' );		
								
								add_filter('wp_mail_from', 'new_mail_from');
								add_filter('wp_mail_from_name', 'new_mail_from_name');

									
								//require_once(dirname(__FILE__)."/../email/class-inform-user.php");
								
								//$content = new Content($headers);
								
								//$headers["Content-type"] = $content->headers1;
						

								//include_once('email/class-inform-user2.php');
									
								
								// echo '<br/>';
							// 	echo 'TRESTETSTSDFSD';
							// 	echo $Msg;
								
								//$headers[]= "Cc: $cc";
								//$headers[]= "Bcc: $bcc";
								
								
								//echo '<br/>';
								//echo "<b>Absender: $Admin</b>";
								//echo '<br/>';
								//echo '<br/>';
								//echo "<b>Reply: $Reply</b>";
								//echo '<br/>';					
								//echo '<br/>';
								//echo "<b>Cc: $cc</b>";
								//echo '<br/>';
								//echo '<br/>';
								//echo "<b>Bcc: $bcc</b>";
								//echo '<br/>';
								//echo '<br/>';
								//echo "<b>Header: $Subject</b>";
								//echo '<br/>';
								//echo '<br/>';
								//echo "<b>Header: $url1</b>";
								//echo '<br/>';
								
								@wp_mail($To, $Subject, $Msg, $headers);
						
						
							}	
							
						//	}
						
						}
				
				}
			
			}
			
			}
			
// Inform Users if picture is activated per Mail --- END	


echo "<p id='cg_changes_saved' style='font-size:18px;'><strong>Changes saved</strong></p>";

		
	// END QUERIES
	

		
	//echo "<br/>";
	//echo "Query Set:";
	//echo $querySET;
	//echo "<br/>";
	
	//echo "<br/>";
	//echo "Update Inform:";
	//echo $updateInform;
	//echo "<br/>";
	
	
	//	echo "<br/>";
	//echo "Change Row of pics:";
	//echo $querySETrow;
	//echo "<br/>";

	// END QUERIES ENDE
	

?>