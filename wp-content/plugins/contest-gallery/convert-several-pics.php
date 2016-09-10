<?php
// destination of the uploaded original image

$filename = $WPdestination . $unixadd . '_' . $dateiname.".".$imageType;


// Get dimensions of the original image. The x and y coordinates on the original image where we
list($current_width, $current_height) = getimagesize($filename);
 
global $wpdb;

	$tablename = $wpdb->prefix . "contest_gal1ery";	
	$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
 
// Origin Values needs first
$selectSQL1 = $wpdb->get_results( "SELECT * FROM $tablenameOptions WHERE id = '$galeryID'" );

		foreach($selectSQL1 as $value){

		$WidthThumb1 = "".$value->WidthThumb."";
		$HeightThumb1 = "".$value->HeightThumb."";
		$WidthGalery1 = "".$value->WidthGallery."";
		$HeightGalery1 = "".$value->HeightGallery."";
		$ScaleOnly = "".$value->ScaleOnly."";
		$ScaleAndCut = "".$value->ScaleAndCut."";
		$selectedCheckComments1 = "".$value->AllowComments."";
		$selectedCheckIp1 = "".$value->IpBlock."";
		$selectedCheckFb1 = "".$value->FbLike."";
		
		}
		
$ScaleOnly = 1; // Dient der Bestimmung ob nur skaliert werden soll oder skaliert und beschnitten werden soll	


			// Funktion zum Umrechnen des Memoryverbrauchs
			if(!function_exists('formatBytes2')){function formatBytes2($bytes, $precision = 2) { 
				$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

				$bytes = max($bytes, 0); 
				$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
				$pow = min($pow, count($units) - 1); 

				$bytes /= pow(1024, $pow); 

				return round($bytes, $precision) . ' ' . $units[$pow]; 
			}
			
			}

			$maxsizeConverted = formatBytes2(@$maxsize,2);
			
//------------------------------------------------------------
// ----------------------------------------------------------- Erstellen und speichern von 1920 px Breite Bildern ----------------------------------------------------------
//------------------------------------------------------------

// Ab hier genauso wie bei Change Sizes

//$new_width = 1920; // wird weiter unten bestimmt
//$new_height = $HeightGalery1; Wird nur gebraucht, wenn Skalieren und Beschneiden notwendig ist, $ScaleOnly == 0

$crop_width = $WidthGalery1;
$crop_height = $HeightGalery1;


//$quotient_width = $current_width/$crop_width;//=3,25
//$quotient_height = $current_height/$crop_height;//=1,56

//417-200
//217/2=108,5*1,53

if ((@$quotient_width > @$quotient_height) AND $ScaleOnly == 0){

$new_width = $current_width/$quotient_height;//417
$new_height = $crop_height;//
$left = ($new_width-$crop_width)/2*1.543;
// echo $left;
// echo "<br/>";
$top = 0;

}

if ((@$quotient_height > @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $current_height/$quotient_width;
$new_width = $crop_width;
$top= ($new_height-$crop_height)/2*1.87;
// echo $top;
// echo "<br/>";
$left = 0;

}

if ((@$quotient_height == @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $crop_height;
$new_width = $crop_width;
$top = 0;
$left = 0;

}

		if (($crop_height > $current_height OR $crop_width > $current_width)  AND $ScaleOnly == 0){

		$new_width = $crop_width;
		$new_height = $crop_height;

		$left= 0;
		// echo $top;
		// echo "<br/>";
		$top = 0;

		}
	
if ($ScaleOnly == 1){

$new_width = 1920;
$new_height = $new_width*$current_height/$current_width;

$crop_height = $new_height;




// echo "<br/>";
// echo "<br/>";
// echo "Gro�er TEST1234";
// echo "<br/>";
// echo "<br/>";
$left= 0;
// echo $top;
// echo "<br/>";
$top = 0;

}

$image1920 = imagecreatetruecolor(1920, $crop_height); // Kreiert den Rahmen in den das Bild dann reinkommt



/*echo $crop_width;
echo "<br/>";
echo $crop_height;
echo "<br/>";
echo $new_height;
echo "<br/>";
echo $new_width;
echo "<br/>";
echo $current_width;
echo "<br/>";
echo $current_height;
echo "<br/>";
echo $left;
echo "<br/>";
echo "<b>";
echo $top;
echo "</b>";*/



//$filenameCropped = explode('.',$dateiname);
//$filenameCropped = substr($dateiname, 0, -4);
$newDestination = $uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/';
//$newDestination .= $unixadd . '_'; 
//$newDestination .= $filenameCropped[0];
$newDestination .= $unixadd."_".$dateiname;


if($dateityp[2] == 1){

// 			echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";

$current_image = @imagecreatefromgif($filename);
$newDestination .= '-1920width.gif';

		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
			
			// echo formatBytes2(memory_get_peak_usage(),2);
			
			// echo "<br/>";


}

if($dateityp[2] == 2){
	
	//	echo "624";
	//echo "<br>";

		// 	echo "<br/>Bevor jpg:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
			// echo "<br/>";
$current_image = imagecreatefromjpeg($filename);
$newDestination .= '-1920width.jpg';

		// 	echo "nach jpg:<br/>";
		// 			echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
		// 	echo "nach jpg peak:<br/>";				
			// echo formatBytes2(memory_get_peak_usage(),2);
		// 	echo "<br/>";	

}


if($dateityp[2] == 3){

		// 	echo "<br/>Bevor png:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";

$current_image = @imagecreatefrompng($filename);
$newDestination .= '-1920width.png';

		// 	echo "nach png:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
		// 	echo "nach png peak:<br/>";		
		// 	echo formatBytes2(memory_get_peak_usage(),2);
		// 	echo "<br/>";			


}

else{
// echo "Wrong Data-Type";
}

//header('Content-type: image/jpg');

imagecopyresampled($image1920 ,$current_image, 0, 0, $left, $top, $new_width, $new_height , $current_width, $current_height);

//print_r($newDestination);

imageJPEG($image1920, $newDestination, 75);

imagedestroy($current_image);		

//------------------------------------------------------------
// ----------------------------------------------------------- Erstellen und speichern von 1600 px Breite Bildern ----------------------------------------------------------
//------------------------------------------------------------

// Ab hier genauso wie bei Change Sizes

//$new_width = 1600; // wird weiter unten bestimmt
//$new_height = $HeightGalery1; Wird nur gebraucht, wenn Skalieren und Beschneiden notwendig ist, $ScaleOnly == 0

$crop_width = $WidthGalery1;
$crop_height = $HeightGalery1;


//$quotient_width = $current_width/$crop_width;//=3,25
//$quotient_height = $current_height/$crop_height;//=1,56

//417-200
//217/2=108,5*1,53

if ((@$quotient_width > @$quotient_height) AND $ScaleOnly == 0){

$new_width = $current_width/$quotient_height;//417
$new_height = $crop_height;//
$left = ($new_width-$crop_width)/2*1.543;
// echo $left;
// echo "<br/>";
$top = 0;

}

if ((@$quotient_height > @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $current_height/$quotient_width;
$new_width = $crop_width;
$top= ($new_height-$crop_height)/2*1.87;
// echo $top;
// echo "<br/>";
$left = 0;

}

if ((@$quotient_height == @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $crop_height;
$new_width = $crop_width;
$top = 0;
$left = 0;

}

		if (($crop_height > $current_height OR $crop_width > $current_width)  AND $ScaleOnly == 0){

		$new_width = $crop_width;
		$new_height = $crop_height;

		$left= 0;
		// echo $top;
		// echo "<br/>";
		$top = 0;

		}
	
if ($ScaleOnly == 1){

$new_width = 1600;
$new_height = $new_width*$current_height/$current_width;

$crop_height = $new_height;




// echo "<br/>";
// echo "<br/>";
// echo "Gro�er TEST1234";
// echo "<br/>";
// echo "<br/>";
$left= 0;
// echo $top;
// echo "<br/>";
$top = 0;

}

$image1600 = imagecreatetruecolor(1600, $crop_height); // Kreiert den Rahmen in den das Bild dann reinkommt



/*echo $crop_width;
echo "<br/>";
echo $crop_height;
echo "<br/>";
echo $new_height;
echo "<br/>";
echo $new_width;
echo "<br/>";
echo $current_width;
echo "<br/>";
echo $current_height;
echo "<br/>";
echo $left;
echo "<br/>";
echo "<b>";
echo $top;
echo "</b>";*/



//$filenameCropped = explode('.',$dateiname);
//$filenameCropped = substr($dateiname, 0, -4);
$newDestination = $uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/';
//$newDestination .= $unixadd . '_'; 
//$newDestination .= $filenameCropped[0];
$newDestination .= $unixadd."_".$dateiname;


if($dateityp[2] == 1){

// 			echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";

$current_image = @imagecreatefromgif($filename);
$newDestination .= '-1600width.gif';

		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
			
			// echo formatBytes2(memory_get_peak_usage(),2);
			
			// echo "<br/>";


}

if($dateityp[2] == 2){
	
	//	echo "624";
	//echo "<br>";

		// 	echo "<br/>Bevor jpg:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
			// echo "<br/>";
$current_image = imagecreatefromjpeg($filename);
$newDestination .= '-1600width.jpg';

		// 	echo "nach jpg:<br/>";
		// 			echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
		// 	echo "nach jpg peak:<br/>";				
			// echo formatBytes2(memory_get_peak_usage(),2);
		// 	echo "<br/>";	

}


if($dateityp[2] == 3){

		// 	echo "<br/>Bevor png:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";

$current_image = @imagecreatefrompng($filename);
$newDestination .= '-1600width.png';

		// 	echo "nach png:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
		// 	echo "nach png peak:<br/>";		
		// 	echo formatBytes2(memory_get_peak_usage(),2);
		// 	echo "<br/>";			


}

else{
// echo "Wrong Data-Type";
}

//header('Content-type: image/jpg');

imagecopyresampled($image1600 ,$current_image, 0, 0, $left, $top, $new_width, $new_height , $current_width, $current_height);

//print_r($newDestination);

imageJPEG($image1600, $newDestination, 75);

imagedestroy($current_image);		
		
//------------------------------------------------------------
// ----------------------------------------------------------- Erstellen und speichern von 1024 px Breite Bildern ----------------------------------------------------------
//------------------------------------------------------------
		
// Ab hier genauso wie bei Change Sizes

//$new_width = 1024; // wird weiter unten bestimmt
//$new_height = $HeightGalery1; Wird nur gebraucht, wenn Skalieren und Beschneiden notwendig ist, $ScaleOnly == 0

$crop_width = $WidthGalery1;
$crop_height = $HeightGalery1;


//$quotient_width = $current_width/$crop_width;//=3,25
//$quotient_height = $current_height/$crop_height;//=1,56

//417-200
//217/2=108,5*1,53

if ((@$quotient_width > @$quotient_height) AND $ScaleOnly == 0){

$new_width = $current_width/$quotient_height;//417
$new_height = $crop_height;//
$left = ($new_width-$crop_width)/2*1.543;
// echo $left;
// echo "<br/>";
$top = 0;

}

if ((@$quotient_height > @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $current_height/$quotient_width;
$new_width = $crop_width;
$top= ($new_height-$crop_height)/2*1.87;
// echo $top;
// echo "<br/>";
$left = 0;

}

if ((@$quotient_height == @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $crop_height;
$new_width = $crop_width;
$top = 0;
$left = 0;

}

		if (($crop_height > $current_height OR $crop_width > $current_width)  AND $ScaleOnly == 0){

		$new_width = $crop_width;
		$new_height = $crop_height;

		$left= 0;
		// echo $top;
		// echo "<br/>";
		$top = 0;

		}
	
if ($ScaleOnly == 1){

$new_width = 1024;
$new_height = $new_width*$current_height/$current_width;

$crop_height = $new_height;


// echo "<br/>";
// echo "<br/>";
// echo "Gro�er TEST1234";
// echo "<br/>";
// echo "<br/>";
$left= 0;
// echo $top;
// echo "<br/>";
$top = 0;

}

$image1024 = imagecreatetruecolor(1024, $crop_height); // Kreiert den Rahmen in den das Bild dann reinkommt


//$filenameCropped = explode('.',$dateiname);
//$filenameCropped = substr($dateiname, 0, -4);
$newDestination = $uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/';
//$newDestination .= $unixadd . '_'; 
//$newDestination .= $filenameCropped[0];
$newDestination .= $unixadd."_".$dateiname;



//echo "<br>";

//print_r($dateityp[2]);

//echo "<br>";



if($dateityp[2] == 1){
	


		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";

$current_image = @imagecreatefromgif($filename);
$newDestination .= '-1024width.gif';

		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
			
		// 	echo formatBytes2(memory_get_peak_usage(),2);
			
	// 		echo "<br/>";


}

if($dateityp[2] == 2){
	
	//	echo "1024";
	//echo "<br>";


			// echo "<br/>Bevor jpg:<br/>";
			// echo formatBytes2(memory_get_usage(),2);
			// echo "<br/>";
$current_image = imagecreatefromjpeg($filename);
$newDestination .= '-1024width.jpg';

			// echo "nach jpg:<br/>";
			// 		echo formatBytes2(memory_get_usage(),2);
			// echo "<br/>";
			
			// echo "nach jpg peak:<br/>";				
			// echo formatBytes2(memory_get_peak_usage(),2);
			// echo "<br/>";	

}


if($dateityp[2] == 3){

			// echo "<br/>Bevor png:<br/>";
			// echo formatBytes2(memory_get_usage(),2);
			// echo "<br/>";

$current_image = @imagecreatefrompng($filename);
$newDestination .= '-1024width.png';

			// echo "nach png:<br/>";
			// echo formatBytes2(memory_get_usage(),2);
			// echo "<br/>";
			
			// echo "nach png peak:<br/>";		
			// echo formatBytes2(memory_get_peak_usage(),2);
			// echo "<br/>";			


}

else{
// echo "Wrong Data-Type";
}


imagecopyresized($image1024,$current_image, 0, 0, $left, $top, $new_width, $new_height , $current_width, $current_height);

imageJPEG($image1024, $newDestination, 75);

imagedestroy($current_image);

//------------------------------------------------------------
// ----------------------------------------------------------- Erstellen und speichern von 624 px Breite Bildern ----------------------------------------------------------
//------------------------------------------------------------

// Ab hier genauso wie bei Change Sizes

//$new_width = 624; // wird weiter unten bestimmt
//$new_height = $HeightGalery1; Wird nur gebraucht, wenn Skalieren und Beschneiden notwendig ist, $ScaleOnly == 0

$crop_width = $WidthGalery1;
$crop_height = $HeightGalery1;


//$quotient_width = $current_width/$crop_width;//=3,25
//$quotient_height = $current_height/$crop_height;//=1,56

//417-200
//217/2=108,5*1,53

if ((@$quotient_width > @$quotient_height) AND $ScaleOnly == 0){

$new_width = $current_width/$quotient_height;//417
$new_height = $crop_height;//
$left = ($new_width-$crop_width)/2*1.543;
// echo $left;
// echo "<br/>";
$top = 0;

}

if ((@$quotient_height > @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $current_height/$quotient_width;
$new_width = $crop_width;
$top= ($new_height-$crop_height)/2*1.87;
// echo $top;
// echo "<br/>";
$left = 0;

}

if ((@$quotient_height == @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $crop_height;
$new_width = $crop_width;
$top = 0;
$left = 0;

}

		if (($crop_height > $current_height OR $crop_width > $current_width)  AND $ScaleOnly == 0){

		$new_width = $crop_width;
		$new_height = $crop_height;

		$left= 0;
		// echo $top;
		// echo "<br/>";
		$top = 0;

		}
	
if ($ScaleOnly == 1){

$new_width = 624;
$new_height = $new_width*$current_height/$current_width;

$crop_height = $new_height;




// echo "<br/>";
// echo "<br/>";
// echo "Gro�er TEST1234";
// echo "<br/>";
// echo "<br/>";
$left= 0;
// echo $top;
// echo "<br/>";
$top = 0;

}

$image624 = imagecreatetruecolor(624, $crop_height); // Kreiert den Rahmen in den das Bild dann reinkommt



/*echo $crop_width;
echo "<br/>";
echo $crop_height;
echo "<br/>";
echo $new_height;
echo "<br/>";
echo $new_width;
echo "<br/>";
echo $current_width;
echo "<br/>";
echo $current_height;
echo "<br/>";
echo $left;
echo "<br/>";
echo "<b>";
echo $top;
echo "</b>";*/



//$filenameCropped = explode('.',$dateiname);
//$filenameCropped = substr($dateiname, 0, -4);
$newDestination = $uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/';
//$newDestination .= $unixadd . '_'; 
//$newDestination .= $filenameCropped[0];
$newDestination .= $unixadd."_".$dateiname;


if($dateityp[2] == 1){

// 			echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";

$current_image = @imagecreatefromgif($filename);
$newDestination .= '-624width.gif';

		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
			
			// echo formatBytes2(memory_get_peak_usage(),2);
			
			// echo "<br/>";


}

if($dateityp[2] == 2){
	
	//	echo "624";
	//echo "<br>";

		// 	echo "<br/>Bevor jpg:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
			// echo "<br/>";
$current_image = imagecreatefromjpeg($filename);
$newDestination .= '-624width.jpg';

		// 	echo "nach jpg:<br/>";
		// 			echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
		// 	echo "nach jpg peak:<br/>";				
			// echo formatBytes2(memory_get_peak_usage(),2);
		// 	echo "<br/>";	

}


if($dateityp[2] == 3){

		// 	echo "<br/>Bevor png:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";

$current_image = @imagecreatefrompng($filename);
$newDestination .= '-624width.png';

		// 	echo "nach png:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
		// 	echo "nach png peak:<br/>";		
		// 	echo formatBytes2(memory_get_peak_usage(),2);
		// 	echo "<br/>";			


}

else{
// echo "Wrong Data-Type";
}

//header('Content-type: image/jpg');

imagecopyresampled($image624 ,$current_image, 0, 0, $left, $top, $new_width, $new_height , $current_width, $current_height);

//print_r($newDestination);

imageJPEG($image624, $newDestination, 75);

imagedestroy($current_image);


//------------------------------------------------------------
// ----------------------------------------------------------- Erstellen und speichern von 300 px Breite Bildern ----------------------------------------------------------
//------------------------------------------------------------

// Ab hier genauso wie bei Change Sizes

//$new_width = 300; // wird weiter unten bestimmt
//$new_height = $HeightGalery1; Wird nur gebraucht, wenn Skalieren und Beschneiden notwendig ist, $ScaleOnly == 0

$crop_width = $WidthGalery1;
$crop_height = $HeightGalery1;


//$quotient_width = $current_width/$crop_width;//=3,25
//$quotient_height = $current_height/$crop_height;//=1,56

//417-200
//217/2=108,5*1,53

if ((@$quotient_width > @$quotient_height) AND $ScaleOnly == 0){

$new_width = $current_width/$quotient_height;//417
$new_height = $crop_height;//
$left = ($new_width-$crop_width)/2*1.543;
// echo $left;
// echo "<br/>";
$top = 0;

}

if ((@$quotient_height > @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $current_height/$quotient_width;
$new_width = $crop_width;
$top= ($new_height-$crop_height)/2*1.87;
// echo $top;
// echo "<br/>";
$left = 0;

}

if ((@$quotient_height == @$quotient_width)  AND $ScaleOnly == 0){

$new_height = $crop_height;
$new_width = $crop_width;
$top = 0;
$left = 0;

}

		if (($crop_height > $current_height OR $crop_width > $current_width)  AND $ScaleOnly == 0){

		$new_width = $crop_width;
		$new_height = $crop_height;

		$left= 0;
	// 	echo $top;
	// 	echo "<br/>";
		$top = 0;

		}
	
if ($ScaleOnly == 1){

$new_width = 300;
$new_height = $new_width*$current_height/$current_width;

$crop_height = $new_height;




// echo "<br/>";
// echo "<br/>";
// echo "Gro�er TEST1234";
// echo "<br/>";
// echo "<br/>";
$left= 0;
// echo $top;
// echo "<br/>";
$top = 0;

}

$image300 = imagecreatetruecolor(300, $crop_height); // Kreiert den Rahmen in den das Bild dann reinkommt




/*echo $crop_width;
echo "<br/>";
echo $crop_height;
echo "<br/>";
echo $new_height;
echo "<br/>";
echo $new_width;
echo "<br/>";
echo $current_width;
echo "<br/>";
echo $current_height;
echo "<br/>";
echo $left;
echo "<br/>";
echo "<b>";
echo $top;
echo "</b>";*/



//$filenameCropped = explode('.',$dateiname);
//$filenameCropped = substr($dateiname, 0, -4);
$newDestination = $uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/';
//$newDestination .= $unixadd . '_'; 
//$newDestination .= $filenameCropped[0];
$newDestination .= $unixadd."_".$dateiname;



if($dateityp[2] == 1){

		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";

$current_image = @imagecreatefromgif($filename);
$newDestination .= '-300width.gif';

		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
			
		// 	echo formatBytes2(memory_get_peak_usage(),2);
			
		// 	echo "<br/>";


}

if($dateityp[2] == 2){
	
	
	//	echo "300";
	//echo "<br>";

		// 	echo "<br/>Bevor jpg:<br/>";
		// 	echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
$current_image = imagecreatefromjpeg($filename);
$newDestination .= '-300width.jpg';

		// 	echo "nach jpg:<br/>";
		// 			echo formatBytes2(memory_get_usage(),2);
		// 	echo "<br/>";
			
		// 	echo "nach jpg peak:<br/>";				
		// 	echo formatBytes2(memory_get_peak_usage(),2);
		// 	echo "<br/>";	

}


if($dateityp[2] == 3){

	// 		echo "<br/>Bevor png:<br/>";
	// 		echo formatBytes2(memory_get_usage(),2);
	// 		echo "<br/>";

$current_image = @imagecreatefrompng($filename);
$newDestination .= '-300width.png';

	// 		echo "nach png:<br/>";
	// 		echo formatBytes2(memory_get_usage(),2);
	// 		echo "<br/>";
			
	// 		echo "nach png peak:<br/>";		
	// 		echo formatBytes2(memory_get_peak_usage(),2);
	// 		echo "<br/>";			


}

else{
// echo "Wrong Data-Type";
}


imagecopyresampled($image300 ,$current_image, 0, 0, $left, $top, $new_width, $new_height , $current_width, $current_height);



imageJPEG($image300, $newDestination, 75);

imagedestroy($current_image);



?>