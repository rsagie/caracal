<?php 

	// Aurufen von WP-Config hier notwendig
	//require_once("../../../../wp-config.php");

//echo "testtest";



// User ID Überprüfung ob es die selbe ist
$CheckCheck = wp_create_nonce("check");

$check = @$_POST['check']; 

//echo "CheckCheck: $CheckCheck";
//echo "<br>";
//echo "check: $check";
//echo "111";


if($CheckCheck==$check){

//echo "333";
		$galeryID = intval(@$_POST['GalleryID']);
		
		//echo "galeryID: $galeryID";

		$unix = time();
		$unixadd = $unix+2;

		if(!function_exists('return_bytes1')){
		function return_bytes1($val) {
			$val = trim($val);
			$last = strtolower($val{strlen($val)-1});
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

		//echo "test1";


		$maxigroesse = return_bytes1(ini_get('upload_max_filesize'));


		//----------------------------Prove if user tries to reload ---------------->	

		global $wpdb;

		$tablename1 = $wpdb->prefix . "contest_gal1ery";
		$tablename_f_input = $wpdb->prefix . "contest_gal1ery_f_input";
		
														$content_url = wp_upload_dir();
												$content_url = $content_url['baseurl']; // Pfad zum Bilderordner angeben
		


		/*
		//Reload prove and max id
		$reloadProve = $wpdb->get_results( "SELECT NamePic
		FROM   $tablename1
		WHERE  id=(SELECT MAX(id) FROM $tablename1)");


		foreach($reloadProve as $proveValue){
		$NamePic = $proveValue->NamePic;
		}

		$timestamp = explode("_",$NamePic);

		$timestampUser = @$_POST['timestamp'];


		if(isset(@$_POST['submit'])){


		if($timestamp[0]==@$_POST['timestamp']){
		$fehler = true;
		$fehlertext .= "<br/><strong>Dont reload your browser when upload!</strong><br/>";
		}*/

		// Überprüfen ob Formular oder Bild abgeschickt wurden
		
		// Picture id's sammeln, falls InformAdmin aktiviert ist
		
		$collectImageIDs = array();
		
		if(@$_FILES['data']['tmp_name']){
		foreach(@$_FILES['data']['tmp_name'] as $key => $tmp_name ){
			
		$uploads = wp_upload_dir();
		$WPdestination = $uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/';  //   Pfad zum Bilderordner angeben 

		if ($_FILES['data']['size'] > 0) {

		//echo "test212435454";

			$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$tablename1'");
					$nextID = $last->Auto_increment;
					
					
		$collectImageIDs[] = $nextID;		


		//----------------------------Upload file and save in database ---------------->	

		/*
		if ((isset(@$_POST['submit']) && @$_POST['submit']==true) AND $_FILES['date']['size'] <= 0) {
		echo "<strong>Sie haben kein Bild ausgew&auml;hlt zum Hochladen.</strong><br/><br/>";
		}*/

		if (isset($_FILES['data']) && $_FILES['data']['size'] > 0) {
		  $tempname = $_FILES['data']['tmp_name'][$key];
		  $dateiname = $_FILES['data']['name'][$key];
		  $dateiname = strtolower($dateiname);
		  $dateigroesse = $_FILES['data']['size'][$key];
		  $dateityp = GetImageSize($tempname);
		//echo "<br>Dateiname: $dateiname<br>";
		  $search = array(" ", "!", '"', "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", "/", ":", ";", "=", "?", "@", "[", ".");
		  $dateiname = str_replace($search,"_",$dateiname);
		 
		$dateiname = htmlentities($dateiname, ENT_QUOTES);
		 
		// print_r($dateiname);
		 
		$dateiname = str_replace($search,"_",$dateiname);
		
		// ö –> Ã¶, ü –> Ã¼, ä –> Ã¤, Ö –> Ã?, Ü –> Ã?, Ä –> Ã?
		
		$dateiname = str_replace("Ã¶","oe",$dateiname);
		$dateiname = str_replace("Ã¼","ue",$dateiname);
		$dateiname = str_replace("Ã¤","ae",$dateiname);
		$dateiname = str_replace("Ã?","Oe",$dateiname);
		$dateiname = str_replace("Ã?","Ue",$dateiname);
		$dateiname = str_replace("Ã","Ae",$dateiname);
		
		//print_r($dateiname);

		   if(strlen($dateiname)>=1000){
		 // echo "The name of file you try to upload is to long.";
		  }
		  


		  elseif ($dateityp[2] == 1 || $dateityp[2] == 2 || $dateityp[2] == 3) { // GIF o. JPG?
			if ($dateigroesse <= $maxigroesse) { // Datei zu groß?
			
		//----------------------------Upload file and save in database ---------------->	
		/*
		USE something like:  header('Location: ' . $_SERVER['REQUEST_URI']);
		WITH GET for thank you info to preventing from reloading
		after data was insterted
		Use REQUEST_URI. Do not use PHP_SELF as in most CMS systems and frameworks PHP_SELF would refer to /index.php. 
		<br/><br/>

		Thank you for your understanding!*/
		
		$checkDataNameEnding = substr($dateiname, -4);	
		
		
		if($checkDataNameEnding=='jpeg'){
		
			$dateiname = substr($dateiname,0,-5);		
			
		}
		
		else{
			
			$dateiname = substr($dateiname,0,-4);	
			
		}
		
		if($dateityp[2] == 1){

			$imageType = 'gif';
			
		}
		
		if($dateityp[2] == 2){

			$imageType = 'jpg';
			
		}
		
		if($dateityp[2] == 3){

			$imageType = 'png';
			
		}
		






		if (move_uploaded_file($tempname, $WPdestination . $unixadd . '_' . $dateiname.".".$imageType)) {


		//----------------------------Create Thumbs and Galery pics ---------------->
		
		//echo "yes<br>";

		require(dirname(__FILE__) . "/../convert-several-pics.php");


		//----------------------------Create Thumbs and Galery pics END ----------------//
		
		//$wpdb->insert( $tablename1, array( 'id' => '', 'rowid' => "$nextID", 'Timestamp' => $unixadd, 'NamePic' => $dateiname, 'ImgType' => $imageType, 'CountC' => 0, 'CountR' => '', 'Rating' => '', 'GalleryID' => $galeryID, 'Active' => 0, 'Informed' => 0  ) );
		
		$wpdb->query( $wpdb->prepare(
		"
			INSERT INTO $tablename1
			( id, rowid, Timestamp, NamePic, ImgType, CountC, CountR, Rating, GalleryID, Active, Informed)
			VALUES ( %s,%d,%d,%s,%s,%d,%s,%s,%d,%d,%d )
		", 
			'',$nextID,$unixadd,$dateiname,$imageType,0,'','',$galeryID,0,0
		) );
		
		
		// Prove and insert send data
		
		
	
		

		$tablenameentries = $wpdb->prefix . "contest_gal1ery_entries";
		
		

		if (@$_POST['form_input']){
			
		//	print_r($form_input);

		//$form_input = sanitize_text_field(@$_POST['form_input']);
		$form_input = @$_POST['form_input'];

		//print_r($form_input);


		$i=0;


		// 1. Feldtyp <<< Zur Bestimmung der Feldart für weitere Verarbeitung in der Datenbank, Admin etc.
		// 2. Feldnummer <<<  Zur Bestimmung der Feldreihenfolge in Frontend und Admin.
		// 3. Feldreihenfolge
		// 4. Feldinhalt

			foreach ($form_input as $key => $value) {
			
			$i++;
			
				// Short_Text Entries werden eingefügt (Name, E-Mail)

				if ($i==1 AND (@$ft!='kf')){$ft = $value; continue;}

				if ($i==2 AND ($ft=='nf' or $ft=='ef')){$f_input_id = $value; continue;}

				if ($i==3 AND ($ft=='nf' or $ft=='ef')){$field_order = $value;  continue;}

				if ($i==4 AND ($ft=='nf' or $ft=='ef')){
				
				//echo "<br>insert $ft<br>";
				//echo "<br>f_input_id $f_input_id<br>";
				//echo "<br>field_order $field_order<br>";

				$content = $value;
				$content = stripslashes($content);
				$content = sanitize_text_field($content);
				
				if($ft=='nf'){  
				//$wpdb->insert( $tablenameentries, array( 'id' => '', 'pid' => $nextID, 'f_input_id' => $f_input_id, 'GalleryID' => $galeryID, "Field_Type" => 'text-f', 'Field_Order' => $field_order, 'Short_Text' => $content, 'Long_Text' => '') );
				
				$wpdb->query( $wpdb->prepare(
				"
					INSERT INTO $tablenameentries
					( id, pid, f_input_id, GalleryID, Field_Type, Field_Order, Short_Text, Long_Text)
					VALUES ( %s,%d,%d,%d,%s,%d,%s,%s )
				", 
					'',$nextID,$f_input_id,$galeryID,'text-f',$field_order,$content,''
				) );
				
				}
				
				if($ft=='ef'){  
				//$wpdb->insert( $tablenameentries, array( 'id' => '', 'pid' => $nextID, 'f_input_id' => $f_input_id, 'GalleryID' => $galeryID, "Field_Type" => 'email-f', 'Field_Order' => $field_order, 'Short_Text' => $content, 'Long_Text' => '') );
				
				$wpdb->query( $wpdb->prepare(
				"
					INSERT INTO $tablenameentries
					( id, pid, f_input_id, GalleryID, Field_Type, Field_Order, Short_Text, Long_Text)
					VALUES ( %s,%d,%d,%d,%s,%d,%s,%s )
				", 
					'',$nextID,$f_input_id,$galeryID,'email-f',$field_order,$content,''
				) );
								
				}
				
				$ft=false;
				$f_input_id=false;
				$field_order=false;
				$i=0;
				continue;
				}

				// Short_Text Entries werden eingefügt ---- ENDE 
				
				// Long Entries werden eingefügt

				if ($i==1 AND ($ft!='nf' or $ft!='ef')){$ft = $value; continue;}

				if ($i==2 AND ($ft=='kf')){$f_input_id = $value; continue;}

				if ($i==3 AND ($ft=='kf')){$field_order = $value; continue;}

				if ($i==4 AND ($ft=='kf')){
				
				//echo "<br>insert $ft<br>";
				//echo "<br>f_input_id $f_input_id<br>";
				//echo "<br>field_order $field_order<br>";

				$content = $value;
				
				$content = stripslashes($content);				
				$content = nl2br(htmlspecialchars($content, ENT_QUOTES, 'UTF-8'));
				$content = sanitize_text_field($content);
				
				//echo "<br>content $content<br>";
				

				//$wpdb->insert( $tablenameentries, array( 'id' => '', 'pid' => $nextID, 'f_input_id' => $f_input_id, 'GalleryID' => $galeryID, "Field_Type" => 'comment-f', 'Field_Order' => $field_order, 'Short_Text' => '', 'Long_Text' => $content) );
				
				$wpdb->query( $wpdb->prepare(
				"
					INSERT INTO $tablenameentries
					( id, pid, f_input_id, GalleryID, Field_Type, Field_Order, Short_Text, Long_Text)
					VALUES ( %s,%d,%d,%d,%s,%d,%s,%s )
				", 
					'',$nextID,$f_input_id,$galeryID,'comment-f',$field_order,'',$content
				) );

				$ft=false;
				$f_input_id=false;
				$field_order=false;
				$i=0;
				continue;
				}
				
				// Long Entries werden eingefügt ---- ENDE


			}

		}	
		
		
				// Activate and send e-mail
		
		
		$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
		
		@$ActivateUpload = $wpdb->get_var( "SELECT ActivateUpload FROM $tablenameOptions WHERE ActivateUpload='1' and id = '$galeryID' " );
		
		if(@$ActivateUpload==1){
			
		
				$wpdb->update( 
				"$tablename1",
				array('Active' => '1'), 
				array('id' => $nextID), 
				array('%d'),
				array('%d')
				);	
				
				
						
				// Größe der Bilder bei ThumbAnsicht (gewöhnliche Ansicht mit Bewertung)
				$uploadFolder = wp_upload_dir();
				$urlSource = site_url();							
				$blog_title = get_bloginfo(); 			

						
	

							$dirHTML = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/'.$unixadd."_".$dateiname.".html";
							
							if(!file_exists($dirHTML)){
																
									$scrImgMeta624 = $uploadFolder['baseurl'].'/contest-gallery/gallery-id-'.$galeryID.'/'.$unixadd."_".$dateiname."-624width.".$imageType."";
									$scrImgMeta1024 = $uploadFolder['baseurl'].'/contest-gallery/gallery-id-'.$galeryID.'/'.$unixadd."_".$dateiname."-1024width.".$imageType."";
									
									$urlForFacebook= $urlSource.'/wp-content/uploads/contest-gallery/gallery-id-'.$galeryID."/".$unixadd."_".$dateiname.".html";

										
									//$urlForFacebook= $urlSource.'/wp-content/uploads/contest-gallery/gallery-id-'.$galeryID."/".$unixadd."_".$dateiname.".html";

									
									$fields = '<!DOCTYPE html>
									<html lang="de">
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
									<div style="margin-top:40px;"><img src="'.$scrImgMeta1024.'"/></div>

									  
									  
									</body>
									</html>';
									$fp = fopen($dirHTML, 'w');
									fwrite($fp, $fields);
									fclose($fp);	

								}
	
			
			
			
			
		@$CheckEmail = $wpdb->get_var( "SELECT Short_Text FROM $tablenameentries WHERE Field_Type='email-f' and pid = '$nextID' " );	
			
			
			//echo "<br>CheckEmail: $CheckEmail<br>";
		
					if(@$CheckEmail){
						
						
						
							@$tablenameemail = $wpdb->prefix . "contest_gal1ery_mail";	
							@$selectSQLemail = $wpdb->get_row( "SELECT * FROM $tablenameemail WHERE GalleryID = '$galeryID'" );
							
							@$Subject = $selectSQLemail->Header;
							@$Admin = $selectSQLemail->Admin;
							@$Reply = $selectSQLemail->Reply;
							@$cc = $selectSQLemail->CC;
							@$bcc = $selectSQLemail->BCC;
							@$Msg = $selectSQLemail->Content;
							//$Msg = html_entity_decode(stripslashes($Msg1));
							
							// echo "<br>MSG:<br>";
							// echo "Msg: $Msg";
							// echo "<br>";
							//$Msg = $selectSQLemail->Content;
							
							
							@$url = @$selectSQLemail->URL;	
							@$url = (strpos(@$url,'?')) ? @$url.'&' : @$url.'?';
							
							@$contentMail = @$selectSQLemail->Content;
							
							@$posUrl = "\$url\$";
							
							// echo $posUrl;
							
							@$urlCheck = (strpos(@$contentMail,@$posUrl)) ? 1 : 0;
												
						
					

						@$To = sanitize_text_field(@$CheckEmail);
						
						
							if (filter_var(@$To, FILTER_VALIDATE_EMAIL)) {
				

																
								if(@$urlCheck==1 and @$url==true){
								
						
								
								@$codedPictureId = ($nextID+8)*2+100000; // Verschlüsselte ID ermitteln. Gecachte Sites sind mit verschlüsselter ID gespeichert.
										
								@$url1 = @$url."picture_id=$codedPictureId#cg-begin";
										
								@$replacePosUrl = '$url$';
										
								@$Msg = str_replace(@$replacePosUrl, @$url1, @$contentMail);
										
								}

								
								
								
	
								
								
								
								require_once(dirname(__FILE__)."/class-inform-user.php");
								$headers .= "Reply-To: ". strip_tags(@$Reply) . "\r\n";
								$headers .= "CC: $cc\r\n";
								$headers .= "BCC: $bcc\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=utf-8\r\n";
								
	
								
								add_filter('wp_mail_from', 'new_mail_from');
								add_filter('wp_mail_from_name', 'new_mail_from_name');

			
								
								@wp_mail(@$To, @$Subject, @$Msg, @$headers);
								
								//echo "<br>To: $To<br>";
								//echo "<br>Subject: $Subject<br>";
								//echo "<br>Msg: $Msg<br>";
								//echo "<br>headers: $headers<br>";
								
						
						
						
							
						//	}
						
						
				$wpdb->update( 
				"$tablename1",
				array('Informed' => '1'), 
				array('id' => $nextID), 
				array('%d'),
				array('%d')
				);
						
				
				
				}
			
			}			
				
			
			}


				        // Inform Admin if configured
		
		@$InformAdmin = $wpdb->get_var( "SELECT InformAdmin FROM $tablenameOptions WHERE id = '$galeryID'" );
		
		


	if(@$InformAdmin==1){
								
										
										@$tablenameemailadmin = $wpdb->prefix . "contest_gal1ery_mail_admin";	
										@$selectSQLemailAdmin = $wpdb->get_row( "SELECT * FROM $tablenameemailadmin WHERE GalleryID = '$galeryID'" );
										
										@$Subject = $selectSQLemailAdmin->Header;
										@$Admin = $selectSQLemailAdmin->Admin;
										@$AdminMail = $selectSQLemailAdmin->AdminMail;
										@$Reply = $selectSQLemailAdmin->Reply;
										@$cc = $selectSQLemailAdmin->CC;
										@$bcc = $selectSQLemailAdmin->BCC;
										@$Msg = $selectSQLemailAdmin->Content;								
							
								
							// Alle image IDs werden durchgegangen die gerade neu angelegt wurden	
							foreach($collectImageIDs as $key => $imageID){
						
									$UserEntries = '<br/>';	
									

										//$Msg = html_entity_decode(stripslashes($Msg1));
										
										// echo "<br>MSG:<br>";
										// echo "Msg: $Msg";
										// echo "<br>";
										//$Msg = $selectSQLemail->Content;
										
										
										//@$url = @$selectSQLemailAdmin->URL;	
										//@$url = (strpos(@$url,'?')) ? @$url.'&' : @$url.'?';
										
										@$contentMail = @$selectSQLemailAdmin->Content;
										
										@$posUserInfo = "\$info\$";
										
										// echo $posUrl;
										
										@$posUserInfoCheck = (strpos(@$contentMail,@$posUserInfo)) ? 1 : 0;
															
									@$To = sanitize_text_field(@$AdminMail);
									
									//@$replacePosUrl = '$info$';
									
									//Get User Info from entries
									
									if($posUserInfoCheck==1){

									
											@$selectFormInput = $wpdb->get_results( "SELECT id, Field_Type, Field_Order, Field_Content FROM $tablename_f_input WHERE GalleryID = '$galeryID' AND (Field_Type = 'text-f' OR Field_Type = 'comment-f' OR Field_Type ='email-f') ORDER BY Field_Order ASC" );
											
											
				
												
											$selectContentFieldArray = array();
											
											foreach (@$selectFormInput as $value) {
											
											// 1. Feld Typ
											// 2. ID des Feldes in F_INPUT
											// 3. Feld Reihenfolge
											// 4. Feld Content

											$selectFieldType = 	$value->Field_Type;
											$id = $value->id;// primäre unique id der form wird auch gespeichert und später in entries inserted zur erkennung des verwendeten formular feldes
											$fieldOrder = $value->Field_Order;// Die originale Field order in f_input Tabelle. Zwecks Vereinheitlichung.
											$selectContentFieldArray[] = $selectFieldType;
											$selectContentFieldArray[] = $id;
											$selectContentFieldArray[] = $fieldOrder;
											$selectContentField = unserialize($value->Field_Content);
											$selectContentFieldArray[] = $selectContentField["titel"];
											
											}
											
													foreach($selectContentFieldArray as $key => $formvalue){
											
												//	echo "<br>$i<br>";
												
													// 1. Feld Typ
													// 2. ID des Feldes in F_INPUT
													// 3. Feld Reihenfolge
													// 4. Feld Content 
													
													
																			
													if(@$formvalue=='text-f'){$fieldtype="nf"; $n=1; continue;}	
													if(@$fieldtype=="nf" AND $n==1){$formFieldId=$formvalue; $n=2; continue;}	
													if(@$fieldtype=="nf" AND $n==2){$fieldOrder=$formvalue; $n=3; continue;}	
													if (@$fieldtype=="nf" AND $n==3) {														
														
														$getEntries = $wpdb->get_var( $wpdb->prepare(
														"
															SELECT Short_Text
															FROM $tablenameentries 
															WHERE pid = %d and f_input_id = %d
														", 
														$imageID,$formFieldId
														) );
														
														$UserEntries .= "<br/><strong>$formvalue:</strong><br/>";
														$UserEntries .= "$getEntries<br/>";
														
														$fieldtype='';							
														$i=0;
													
													}
													
													if($formvalue=='email-f'){@$fieldtype="ef";  $n=1; continue;}	
													if(@$fieldtype=="ef" AND $n==1){$formFieldId=$formvalue; $n=2; continue;}	
													if(@$fieldtype=="ef" AND $n==2){$fieldOrder=$formvalue; $n=3; continue;}	
													if (@$fieldtype=='ef' AND $n==3) {
														

														$getEntries = $wpdb->get_var( $wpdb->prepare(
														"
															SELECT Short_Text
															FROM $tablenameentries 
															WHERE pid = %d and f_input_id = %d
														", 
														$imageID,$formFieldId
														) );
														
														$UserEntries .= "<br/><strong>$formvalue:</strong><br/>";
														$UserEntries .= "$getEntries<br/>";
														
														$fieldtype='';							
														$i=0;
														
													
													}
													
													if($formvalue=='comment-f'){$fieldtype="kf"; $n=1; continue;}	
													if($fieldtype=="kf" AND $n==1){$formFieldId=$formvalue; $n=2; continue;}	
													if($fieldtype=="kf" AND $n==2){$fieldOrder=$formvalue; $n=3; continue;}	
													if ($fieldtype=='kf' AND $n==3) {
														

														$getEntries = $wpdb->get_var( $wpdb->prepare(
														"
															SELECT Long_Text
															FROM $tablenameentries 
															WHERE pid = %d and f_input_id = %d
														", 
														$imageID,$formFieldId
														) );
														
														$UserEntries .= "<br/><strong>$formvalue:</strong><br/>";
														$UserEntries .= "$getEntries<br/>";
														
														$fieldtype='';							
														$i=0;
														
														
													}

																			
												}
												
												
												// Daten zur User URL sammeln
												
												$selectImageData = $wpdb->get_row( "SELECT * FROM $tablename1 WHERE GalleryID = '$galeryID' AND  id = '$imageID' ");
												

												
												$UserEntries .= "<br/><br/><strong>Original Image URL:</strong><br/>";
												$UserEntries .=''.$content_url.'/contest-gallery/gallery-id-'.$galeryID.'/'.$selectImageData->Timestamp.'_'.$selectImageData->NamePic.'.'.$selectImageData->ImgType.'<br/>';
				
				
											// User Info wird implementiert anstelle von $info$	 							
											@$Msg = str_replace(@$posUserInfo, @$UserEntries, @$contentMail);
											
												
											
											
									
									}
									
									
									
									/*
										if (filter_var(@$To, FILTER_VALIDATE_EMAIL)) {
							

																			
											if(@$urlCheck==1 and @$url==true){
											
									
											
											@$codedPictureId = ($nextID+8)*2+100000; // Verschlüsselte ID ermitteln. Gecachte Sites sind mit verschlüsselter ID gespeichert.
													
											@$url1 = @$url."picture_id=$codedPictureId#cg-begin";
													
											@$replacePosUrl = '$info$';
													
											
													
											}*/						
				
											
											
											
											require_once(dirname(__FILE__)."/class-inform-user.php");
											$headers .= "Reply-To: ". strip_tags(@$Reply) . "\r\n";
											$headers .= "CC: $cc\r\n";
											$headers .= "BCC: $bcc\r\n";
											$headers .= "MIME-Version: 1.0\r\n";
											$headers .= "Content-Type: text/html; charset=utf-8\r\n";
											
				
											
											add_filter('wp_mail_from', 'new_mail_from');
											add_filter('wp_mail_from_name', 'new_mail_from_name');

						
											
											@wp_mail(@$To, @$Subject, @$Msg, @$headers);
											
											//echo "<br>To: $To<br>";
											//echo "<br>Subject: $Subject<br>";
											//echo "<br>Msg: $Msg<br>";
											//echo "<br>headers: $headers<br>";					
									
				
					}
				
				}










		
        // Inform Admin if configured --- ENDE		
			
			
			
			
			
			
		}		
		
		
		
		// Activate and send e-mail --- END	
		
		
		
		


		// Prove and insert send data --- END		
		
		

				
			  } else {
				echo "<p>Upload was not successful!</p>";
			  } 
			} else {
			  echo "<p>The picture size is too big!</p>";
			} 
		  } else {
			echo "<p>Only jpg, png or gif files are allowed!</p>";
		  } 
		 
		} 

		} 
		} 
		

	// Forward confirmation texte after upload
	
	
	
			
		$contest_gal1ery_options_input = $wpdb->prefix . "contest_gal1ery_options_input";
		
		$inputOptionsSQL = $wpdb->get_row( "SELECT * FROM $contest_gal1ery_options_input WHERE GalleryID='$galeryID'"); // hier aufgehört. Die Gallery ID wird nicht übertragen, muss her geholt werden aus dem Jquery Post vorher oder aus dem Wordpress-PHP
		$Forward = $inputOptionsSQL->Forward;
		
		if($Forward==1){
		
			$Forward_URL = $inputOptionsSQL->Forward_URL;
			$Forward_URL = html_entity_decode(stripslashes($Forward_URL));
			
			$Forward_URLcheck = substr($Forward_URL, 0, 3);
			$Forward_URLcheck = strtolower($Forward_URLcheck);

			if($Forward_URLcheck=='www'){
			$Forward_URL = "http://".$Forward_URL; 	
			}
			
			
			
?>
<script>

// funtzt nur so als vorher bestimmte variable
var redirectURL = <?php echo json_encode($Forward_URL);?>;

// similar behavior as an HTTP redirect
window.location.replace(redirectURL);


</script>
<?php			
			//require("forward-url.php");
		
			//exit;
			//echo $Forward_URL;	
		
		}
		
		else{
			
			//echo "works";
			
				$permalinkURL = get_permalink();
				
				//echo "<br>$permalinkURL<br>";
				
				$checkPermalinkURL = explode('?',$permalinkURL);
				
				//$siteURL = ($checkPermalinkURL) ?  : "?";
				
			// 	echo "<br>checkPermalinkURL:".$checkPermalinkURL[0]; 
			
			// <input type="hidden" name="page_id" value="<?php echo "204"; 
				
				if(@$checkPermalinkURL[1]){
					$cg_upload_forward_siteURL = $checkPermalinkURL[0]."?".$checkPermalinkURL[1];
					
					// echo "<br>";
				// 	echo $checkPermalinkURL[1];
				// 	echo "<br>";
					
				//	$pageIDname = explode('=',$checkPermalinkURL[1]);
					
				// 	echo "<br>";
				// 	echo $pageIDname[0];
				// 	echo "<br>";
					
					
				//	$pageIDvalue = explode('&',$pageIDname[1]);
					
					
				// 	echo "<br>";
				// 	echo $pageIDvalue[0];
				// 	echo "<br>";
					
					
					
					
					//$siteURLsort = $checkPermalinkURL[0]."?".$checkPermalinkURL[1];			
					$siteURLsort = $checkPermalinkURL[0];			
					}
				else{$cg_upload_forward_siteURL = $permalinkURL."?";}		
			
			//echo "$cg_upload_forward_siteURL";
			?>
<script>



// funtzt nur so als vorher bestimmte variable
var galeryID = <?php echo json_encode($galeryID);?>;
var cg_upload_forward_siteURL = <?php echo json_encode($cg_upload_forward_siteURL);?>;

// funtzt nur so als vorher bestimmte variable
var redirectURL = ""+cg_upload_forward_siteURL+"&cg_upload=success&cg_id="+galeryID+"#cg_success";
//alert(redirectURL);
// similar behavior as an HTTP redirect
window.location.replace(redirectURL);


</script>
<?php	

			
			}
		
			echo "<br/>";
			//	echo "<p>Your picture upload was successful.<br/>We will activate your picture soon.<br/>Your picture has to be proved.";

				//exit();	
	
	
	// Forward confirmation texte after upload --- ENDE



		

		//<<< END prove reload
	
	
	}
	
else{
	
	echo "Plz don't fiddle the upload.";	
	
	}


?>