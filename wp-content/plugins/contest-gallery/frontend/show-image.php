<?php
//error_reporting(E_ALL); 
//ini_set('display_errors', 'On');
?>
<!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
 <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>--> 
<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->
<?php





//global $anzahlNeu; //weiterverarbeitung aus hochladen.php
//global $bewertungNeu; //weiterverarbeitung aus hochladen.php

	
		// Aufrufen von Daten
	include("get-data.php");
	include("check-language.php");

	
//echo memory_get_usage();
	

echo "<div id='main-cg-content-div' style='visibiity:hidden;margin:0px auto;'>";
	

// Bestimmung der Startposition wenn es zur Gallerie geht
/*
if ($sendOrder=='date-desc' OR $sendOrder=='date-asc') {

//echo "test1";

	$rowsActive = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM $tablename WHERE Active=1 AND GalleryID=$galeryID");
	
	$rowsActive1 = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE rowid >= '$pictureID' AND Active=1");
	
	$multiplier = floor($rowsActive1/$PicsPerSite);

	$provePart = $multiplier*$PicsPerSite;

	if ($provePart==$rowsActive1) { $start = ($multiplier-1)*$PicsPerSite; }

	if ($provePart+1==$rowsActive1) { $start = $multiplier*$PicsPerSite; }

}

if ($sendOrder=='rating-desc' OR $sendOrder=='rating-asc') {

//echo "<br>rating-desc valueiante<br>";

	$rowsActive = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM $tablename WHERE Active=1 AND GalleryID=$galeryID");
	
//echo "<br>rowsActive: $rowsActive<br>";

	if($order=='desc'){ $rowsActive1 = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE rowid >= '$pictureID'  AND Active=1  AND CountR = 0"); }

	if($order=='asc'){ $rowsActive1 = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE rowid <= '$pictureID'  AND Active=1  AND CountR = 0"); }
	
	
//echo "<br>rowsActive1: $rowsActive1<br>";
		
	$rowsActive2 = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE CountR > '0'  AND Active=1");
	
//echo "<br>rowsActive2: $rowsActive2<br>";

	$rowsActive3 = $rowsActive1 + $rowsActive2;
	
//echo "<br>rowsActive3: $rowsActive3<br>";
	
	$multiplier = floor($rowsActive3/$PicsPerSite);
	
//echo "<br>PicsPerSite: $PicsPerSite<br>";
//echo "<br>multiplier: $multiplier<br>";

	$provePart = $multiplier*$PicsPerSite;
	
	//echo "<br>provePart: $provePart<br>";

	
	if ($provePart==$rowsActive3) { $start = ($multiplier-1)*$PicsPerSite; }

	// Korrektur
	if ($provePart+1==$rowsActive3) { $start = $multiplier*$PicsPerSite;}
	
}


if ($sendOrder=='comment-desc' OR $sendOrder=='comment-asc') {

	$rowsActive = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM $tablename WHERE Active=1 AND GalleryID=$galeryID");

	if($order=='desc'){ $rowsActive1 = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE rowid >= '$pictureID'  AND Active=1  AND CountC = 0"); }
	
	if($order=='asc'){ $rowsActive1 = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE rowid <= '$pictureID'  AND Active=1  AND CountC = 0"); }
		
	$rowsActive2 = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE CountC > '0'  AND Active=1");

	$rowsActive3 = $rowsActive1 + $rowsActive2;
	
	$multiplier = floor($rowsActive3/$PicsPerSite);

	$provePart = $multiplier*$PicsPerSite;

	if ($provePart==$rowsActive3) {$start = ($multiplier-1)*$PicsPerSite;}

	// Korrektur
	if ($provePart+1==$rowsActive3) {$start = $multiplier*$PicsPerSite;}
	
}*/


//echo "<br>start6787: $start<br>";

// Bestimmung der Startposition wenn es zur Gallerie geht --- ENDE



// echo "<br>rating: $rating<br>";
// echo "<br>countR: $countR<br>";


if ($countR!=0){
$averageStars = $rating/$countR;
@$averageStarsRounded = round($averageStars,0);
//echo "<br>averageStars: $averageStars<br>";

}
 

 // echo "<br>averageStarsRounded: $averageStarsRounded<br>";

//echo "<br>averageStarsRounded: $averageStarsRounded<br>";

$star_off = 'star_off';
$star_on = 'star_on';

$star1 = 'star_on';
$star2 = 'star_on';
$star3 = 'star_on';
$star4 = 'star_on';
$star5 = 'star_on';


$codedPictureId = ($pictureID+8)*2+100000; 

$pngUrlIconImg = content_url().'/plugins/contest-gallery/css/url_icon.png';


$starON = plugins_url( '/../css/star_48.png', __FILE__ );
$starOFF = plugins_url( '/../css/star_off_48.png', __FILE__ );

if($AllowRating==1){
if((@$averageStarsRounded>=1 and @$IPcheck==0) or (@$averageStarsRounded>=1 and @$checkUserIP==true)){$star1 = "cgin$pictureID-1"; $star1img = $starON;}
else{$star1 = "cgio$pictureID-1"; $star1img = $starOFF;}
if((@$averageStarsRounded>=2 and @$IPcheck==0) or (@$averageStarsRounded>=2 and @$checkUserIP==true)){$star2 = "cgin$pictureID-2";$star2img = $starON;}
else{$star2 = "cgio$pictureID-2"; $star2img = $starOFF;}
if((@$averageStarsRounded>=3 and @$IPcheck==0) or (@$averageStarsRounded>=3 and @$checkUserIP==true)){$star3 = "cgin$pictureID-3";$star3img = $starON;}
else{$star3 = "cgio$pictureID-3"; $star3img = $starOFF;}
if((@$averageStarsRounded>=4 and @$IPcheck==0) or (@$averageStarsRounded>=4 and @$checkUserIP==true)){$star4 = "cgin$pictureID-4";$star4img = $starON;}
else{$star4 = "cgio$pictureID-4"; $star4img = $starOFF;}
if((@$averageStarsRounded>=5 and @$IPcheck==0) or (@$averageStarsRounded>=5 and @$checkUserIP==true)){$star5 = "cgin$pictureID-5";$star5img = $starON;}
else{$star5 = "cgio$pictureID-5"; $star5img = $starOFF;}
}

if($AllowRating==2){
if((@$countS>=1 and @$IPcheck==0) or (@$countS>=1 and @$checkUserIP==true)){$star6 = "cgin$pictureID-6"; $star6img = $starON;}
else{$star6 = "cgio$pictureID-6"; $star6img = $starOFF; @$countS=0;}	
}





		// Dynamic configs of pictures showing kind 
		$scriptOnOff = ($AllowGalleryScript==1) ? 'data-lightbox="roadtrip1"' : ''; 
		
		$urlGallerySrc = $uploads.'/'.$imageGalery; 
		
		$urlGalleryHref = ($AllowGalleryScript==0) ? $siteURL."picture_id=$rowid" : $urlGallerySrc; 
		
		$commentURL = $siteURL."picture_id=$rowid";
		
		// Dynamic configs of pictures showing kind --- END
		
		
		// Count Rating
		
		@$countRating = $wpdb->get_var( "SELECT CountR FROM $tablename WHERE rowid='$id1'" );
		
		$countRating = ($countRating==0) ? '0' : $countRating;
		
		// Count Rating --- END
		


		
//$picsSQL = $wpdb->get_results( "SELECT COUNT(*) FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY rowid ");SELECT COUNT(*) FROM TABLE WHERE id <= ELEMENT_ID

//print_r($picsSQL);


		// bestimmte Files öffnen		
		
		
				/*			// Verschlüsselung der ID
					$idCoded = ($pictureID+8)*2+100000;
					
							$cachefilesSites = dirname(__FILE__).'/../../../uploads/contest-gallery/gallery-id-'.$galeryID.'/cache/sites/id-100680*';
echo "<br>cachefilesSites: $cachefilesSites<br>";

			foreach (glob($cachefilesSites) as $filename) {
				
echo "<br>filename: $filename<br>";
			}*/




//echo "<h3><u><a href='$siteURL&1=".$getOrder."&2=".$getStart."&3=".$getStep."&4=".$getLook."&5=$count' style='cursor: pointer;'>Zur Galerie</a></u></h3>";

//echo "<br>sendOrder: $sendOrder<br>";

/*
// Count mitzuschicken ist hier nicht notwendig
					echo <<<HEREDOC
<form method="post" action="$backToGalery[0]">
<input type="hidden" name="order" value="$sendOrder">
<input type="hidden" name="look" value="$look">
<input type="hidden" name="start" value="$start">
<input type="hidden" name="step" value="$step">
<input name="submit" value="Create" type="submit" id="backToGallery" style="display: none;" />
</form>
HEREDOC; */





		// Arrows source	
				
		$arrowPngLeft = content_url().'/plugins/contest-gallery/css/arrow_left.png';
		$arrowPngRight = content_url().'/plugins/contest-gallery/css/arrow_right.png';

		// Arrows source -- END	



// Select last and first id of Galery --- END



// Calculate middle point of the picutre

$marginBottomArrow = $HeightGalery - ($HeightGalery/2+62);

$marginBottomArrow .= "px";


// Erkenne die nächste ID, die nach der aktuellen kommt

// echo "<br>sendOrder: $sendOrder<br>";

// echo get_site_url( $path );

if ($sendOrder=='date-desc' OR $sendOrder=='date-asc'){
		

	
	
		$picsSQL = $wpdb->get_results( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY rowid $order LIMIT $getStart, $getStep ");
		//$countPicsSQL = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY rowid $order");
		
		$countPicsSQL = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT COUNT(1)
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY rowid $order
		", 
		$galeryID,1
		) );
		
		
	//echo "<br>countPicsSQL: $countPicsSQL<br>";
	//echo "<br>start: $getStart<br>";
		
		
	// 	print_r($picsSQL);
		
		$sendGetStart = $getStart;
		
		$i=0;
		$r=1;		
		
		foreach($picsSQL as $value){
			
			$id = $value->id;
			
				if($id==$pictureID){
					
					$position = $i;
					$positionStart = $r;
					
					break;
									
				}
				
			$i++;	
			$r++;	
			
		}

		// echo "<br>order: $order<br>";
		// echo "<br>position: $position<br>";
	// 	echo "<br>positionStart: $positionStart<br>";
		
		@$nextCount = @$getStart+@$position+1;
		@$priorCount = @$getStart+@$position-1;
		@$priorCountPic = @$getStart+@$positionStart-1;
		
		$lastPic = $nextCount+$getStart;
		
	// 	echo "<br>nextCount: $nextCount<br>";
	// 	echo "<br>priorCount: $priorCount<br>";
	// 	echo "<br>priorCountPic: $priorCountPic<br>";
		
		//Achtung! Zählung fängt von 0 an!
		//$nextPossibleId = $wpdb->get_var( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY rowid $order LIMIT $nextCount, 1 ");
		
		$nextPossibleId = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT id
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY rowid $order LIMIT $nextCount, 1
		", 
		$galeryID,1
		) );
		
		//$priorPossibleId = $wpdb->get_var( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY rowid $order LIMIT $priorCount, 1 ");
		
		$priorPossibleId = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT id
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY rowid $order LIMIT $priorCount, 1
		", 
		$galeryID,1
		) );
		
		
		// Prüfen ob das nächste Bilder ein Step Übergang ist
		
		if(@$positionStart % $getStep == 0 or $nextCount > $getStart){
		
		$getStartRight = $getStart+$getStep;
		
		$checkGetStartStep = $getStart+$getStep;
		
	// 	echo "<br>checkGetStartStep: $checkGetStartStep<br>";
		
			if($nextCount < $checkGetStartStep){
					$getStartRight=$getStart;
			}		
		
			/*if($positionStart == 1 AND $getStart!=0){
					$getStartRight=$getStart+$getStep;
			}*/
		
		}
		
		$checkGetStartStep = $getStart+$getStep;
		
		if($nextCount <= $checkGetStartStep){
		
		$getStartLeft = $getStart;
		
			if(@$positionStart == 1){
					$getStartLeft=$getStart-$getStep;
			}	
		
		}
		
		

		// Prüfen ob das vorherige Bid das aller erste ist
		
		/*$checkStart = $getStart/$getStep;
		
		if($checkStart == 1 AND $sendGetStart==0){
		echo "asfasdfsdf";
		$getStart = $getStart-$getStep;
		
		}*/
		
	
/*
		// ermitteln der vorherigen erstmöglichen ID
		foreach($priorPossibleIdQuery  as $value){
		$priorPossibleRowId = $value->rowid;
		$priorPossibleId = $value->id;
		}
		
		// ermitteln der nächsten erstmöglichen ID
		foreach($nextPossibleIdQuery  as $value){
		$nextPossibleRowId = $value->rowid;
		$nextPossibleId = $value->id;
		}*/

		
	// 	echo "<br>pictureID: $pictureID<br>";
	// 	echo "<br>rowid: $rowid<br>";
		//echo "<br>priorPossibleRowId: $priorPossibleRowId<br>"; 
	// 			echo "<br>nextPossibleId: $nextPossibleId<br>";
	// 	echo "<br>priorPossibleId: $priorPossibleId<br>";
		//echo "<br>nextPossibleRowId: $nextPossibleRowId<br>";
	// 	echo "<br>maxID: $maxID<br>";
	// 	echo "<br>minID: $minID<br>";
	// 	echo "<br>rowImages: $rowImages<br>";
	// 	echo "<br>getStart: $getStart<br>";
	// 	echo "<br>getStartLeft: $getStartLeft<br>";
	// 	echo "<br>getStartRight: $getStartRight<br>";
		
		$nextPossibleIdcoded = ($nextPossibleId+8)*2+100000;
		$priorPossibleIdcoded = ($priorPossibleId+8)*2+100000;
		

		
		
		// Weitergabe des Counts bei der ersten (date-desc/asc) variante. Nicht notwend
		if(@$positionStart==1 and $sendGetStart==0){ $arrowLeftPic =''; }
		else{//$arrowLeftPic = "<div id='cg-arrow-left-second-div'><a href='$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."&4=".$getStep."#cg-begin' ><img id='cg-arrow-left-image' style='cursor: pointer;' src='$arrowPngLeft'></a></div>"; 
		 $arrowLeftPic = "<div id='cg_arrow_left' style='position:absolute;z-index:100;top:0;left:0;margin-top:50px;'><a href='$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."#cg-begin' ><img style='cursor: pointer;' src='$arrowPngLeft'></a></div>"; 

		}
		
		if($nextCount==$countPicsSQL){ $arrowRightPic ='<div id="cg_arrow_right">&nbsp;</div>'; }
		else{ $arrowRightPic = "<div id='cg_arrow_right' style='position:absolute;z-index:100;top:0;right:0;margin-top:50px;'><a href='$siteURL&picture_id=$nextPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartRight."#cg-begin' ><img id='cg-arrow-right-image' style='cursor: pointer;' src='$arrowPngRight'></a></div>"; }		

}



if ($sendOrder=='rating-desc' OR $sendOrder=='rating-asc') {

/*
echo "<br>valueiante 2<br>";

	
	$lastRowID = $wpdb->get_var( "SELECT rowid FROM $tablename WHERE GalleryID=$galeryID AND Active='1' ORDER BY CountR asc, rowid asc LIMIT 0, 1");
	
		echo "<br/>lastID : ";
		print_r($lastRowID);
		echo "<br>";
		echo "<br>";

	echo "<br>count: $count<br>";
	echo "<br>rowid: $rowid<br>";
	echo "<br>pictureID: $pictureID<br>";

	
		// fesstellen ob nicht das erste Bild geklickt wurde
		if($count-1 != -1){
		$priorCount = $count-1;
		echo "<br>priorCount: $priorCount<br>";
		$priorPossibleIdQuery = $wpdb->get_row( "SELECT id, rowid FROM $tablename WHERE GalleryID=$galeryID AND Active='1' ORDER BY CountR $order, rowid $order LIMIT $priorCount, 1");
		}
		
		
		// feststellen ob das letzte Bild geklickt wurde
		if($lastRowID != $rowid){
		$nextCount = $count+1;
		echo "<br>nextCount: $nextCount<br>";
		$nextPossibleIdQuery = $wpdb->get_row( "SELECT id, rowid  FROM $tablename WHERE GalleryID=$galeryID AND Active='1' ORDER BY CountR $order, rowid $order LIMIT $nextCount, 1");
		}
		
		// Prüfen ob das nächste Bilder ein Step Übergang ist
		
		if($nextCount % $getStep == 0){
		
		$getStart = $nextCount;
		
		}

		// Prüfen ob das nächste Bilder ein Step Übergang ist
		
		if($priorCount % $getStep == 0){
		
		$getStart = $priorCount-$getStep;
		
		}	
		
		
		
		//$key = array_search("$pictureID", $testPossibleIdQuery,true); 
		
		//echo "<br>key: $key<br>";

		echo "<br/>prior array1: ";
		echo "<br>";
		print_r($priorPossibleIdQuery );
		echo "<br>";
		echo "<br>";
	echo 	"<br/>next array: ";
echo "<br>";
		print_r($nextPossibleIdQuery );
		echo "<br>";
		echo "<br>";
		echo "<br>";
		
		// fesstellen ob nicht das erste Bild geklickt wurde
		if($count-1 != -1){
		$priorPossibleId = $priorPossibleIdQuery->id;
		$priorPossibleRowId = $priorPossibleIdQuery->rowid;
		echo "<br>priorPossibleId: $priorPossibleId<br>";
		echo "<br>priorPossibleRowId: $priorPossibleRowId<br>";
		$priorPossibleId = ($priorPossibleId+8)*2+100000;

		}
		
		// feststellen ob das letzte Bild geklickt wurde
		if($lastRowID != $rowid){
		$nextPossibleId = $nextPossibleIdQuery->id;
		$nextPossibleRowId = $nextPossibleIdQuery->rowid;
		echo "<br>nextPossibleId: $nextPossibleId<br>";
		echo "<br>nextPossibleRowId: $nextPossibleRowId<br>";
		$nextPossibleId = ($nextPossibleId+8)*2+100000;
		}
		
	
		echo "<br>pictureID: $pictureID<br>";
		echo "<br>rowid: $rowid<br>";


		echo "<br>maxID: $maxID<br>";
		echo "<br>minID: $minID<br>";
		echo "<br>rowImages: $rowImages<br>";
		
		
		
				
		echo "<br>priortPossibleId: $priorPossibleId<br>";
		echo "<br>nextPossibleIdCoded: $nextPossibleId<br>";
		

		if($count-1 == -1){ $arrowLeftPic ='<div id="cg-arrow-left-second-div">&nbsp;</div>'; }
		else{ $arrowLeftPic = "<div id='cg-arrow-left-second-div'><a href='$siteURL&picture_id=$nextPossibleId&1=".$getLook."&2=".$getOrder."&3=".$getStart."&4=".$getStep."&5=$nextCount' ><img id='cg-arrow-left-image' style='cursor: pointer;' src='$arrowPngLeft'></a>LALALA1</div>"; 	}
		
		if($lastRowID==$rowid){ $arrowRightPic ='<div id="cg-arrow-left-second-div">&nbsp;</div>'; }
		else{ $arrowRightPic = "<div id='cg-arrow-right-second-div'><a href='$siteURL&picture_id=$priorPossibleId&1=".$getLook."&2=".$getOrder."&3=".$getStart."&4=".$getStep."&5=$nextCount' ><img id='cg-arrow-right-image' style='cursor: pointer;' src='$arrowPngRight'></a>LALALA2</div>"; }	

	*/
	
	
		
		if($AllowRating==1){
		$picsSQL = $wpdb->get_results( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountR $order, rowid $order LIMIT $getStart, $getStep ");
		$countPicsSQL = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT COUNT(1)
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY CountR $order, rowid $order
		", 
		$galeryID,1
		) );		
		}
		if($AllowRating==2){
		$picsSQL = $wpdb->get_results( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountS $order, rowid $order LIMIT $getStart, $getStep ");
		$countPicsSQL = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT COUNT(1)
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY CountS $order, rowid $order
		", 
		$galeryID,1
		) );			
		}
			
		//$countPicsSQL = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountR $order, rowid $order");
		

		
	// 	echo "<br>countPicsSQL: $countPicsSQL<br>";
	// 	echo "<br>start: $getStart<br>";
		
		
	// 	print_r($picsSQL);
		
		$sendGetStart = $getStart;
		
		$i=0;
		$r=1;		
		
		foreach($picsSQL as $value){
			
			$id = $value->id;
			
				if($id==$pictureID){
					
					$position = $i;
					$positionStart = $r;
					
					break;
									
				}
				
			$i++;	
			$r++;	
			
		}

	// 	echo "<br>order: $order<br>";
	// 	echo "<br>position: $position<br>";
	// 	echo "<br>positionStart: $positionStart<br>";
		
		$nextCount = $getStart+$position+1;
		$priorCount = $getStart+$position-1;
		$priorCountPic = $getStart+$positionStart-1;
		
		$lastPic = $nextCount+$getStart;
		
	// 	echo "<br>nextCount: $nextCount<br>";
// 		echo "<br>priorCount: $priorCount<br>";
	// 	echo "<br>priorCountPic: $priorCountPic<br>";
		
		//Achtung! Zählung fängt von 0 an!
		//$nextPossibleId = $wpdb->get_var( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountR $order, rowid $order LIMIT $nextCount, 1 ");
		
		if($AllowRating==1){
			$nextPossibleId = $wpdb->get_var( $wpdb->prepare( 
			"
				SELECT id
				FROM $tablename 
				WHERE GalleryID=%d AND Active=%d ORDER BY CountR $order, rowid $order LIMIT $nextCount, 1
			", 
			$galeryID,1
			) );
		}
		if($AllowRating==2){
			$nextPossibleId = $wpdb->get_var( $wpdb->prepare( 
			"
				SELECT id
				FROM $tablename 
				WHERE GalleryID=%d AND Active=%d ORDER BY CountS $order, rowid $order LIMIT $nextCount, 1
			", 
			$galeryID,1
			) );
		}
		
		
		//$priorPossibleId = $wpdb->get_var( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountR $order, rowid $order LIMIT $priorCount, 1 ");
		
		if($AllowRating==1){
		$priorPossibleId = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT id
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY CountR $order, rowid $order LIMIT $priorCount, 1
		", 
		$galeryID,1
		) );
		}
		
		if($AllowRating==2){
		$priorPossibleId = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT id
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY CountS $order, rowid $order LIMIT $priorCount, 1
		", 
		$galeryID,1
		) );
		}
		
		
		
		// Prüfen ob das nächste Bilder ein Step Übergang ist
		
		if($positionStart % $getStep == 0 or $nextCount > $getStart){
		
		$getStartRight = $getStart+$getStep;
		
		$checkGetStartStep = $getStart+$getStep;
		
		//echo "<br>checkGetStartStep: $checkGetStartStep<br>";
		
			if($nextCount < $checkGetStartStep){
					$getStartRight=$getStart;
			}		
		
			/*if($positionStart == 1 AND $getStart!=0){
					$getStartRight=$getStart+$getStep;
			}*/
		
		}
		
		$checkGetStartStep = $getStart+$getStep;
		
		if($nextCount <= $checkGetStartStep){
		
		$getStartLeft = $getStart;
		
			if($positionStart == 1){
					$getStartLeft=$getStart-$getStep;
			}	
		
		}
		
		

		// Prüfen ob das vorherige Bid das aller erste ist
		
		/*$checkStart = $getStart/$getStep;
		
		if($checkStart == 1 AND $sendGetStart==0){
		echo "asfasdfsdf";
		$getStart = $getStart-$getStep;
		
		}*/
		
	
/*
		// ermitteln der vorherigen erstmöglichen ID
		foreach($priorPossibleIdQuery  as $value){
		$priorPossibleRowId = $value->rowid;
		$priorPossibleId = $value->id;
		}
		
		// ermitteln der nächsten erstmöglichen ID
		foreach($nextPossibleIdQuery  as $value){
		$nextPossibleRowId = $value->rowid;
		$nextPossibleId = $value->id;
		}*/

		
	// 	echo "<br>pictureID: $pictureID<br>";
// 		echo "<br>rowid: $rowid<br>";
		//echo "<br>priorPossibleRowId: $priorPossibleRowId<br>"; 
	// 			echo "<br>nextPossibleId: $nextPossibleId<br>";
	// 	echo "<br>priorPossibleId: $priorPossibleId<br>";
		//echo "<br>nextPossibleRowId: $nextPossibleRowId<br>";
// 		echo "<br>maxID: $maxID<br>";
// 		echo "<br>minID: $minID<br>";
	// 	echo "<br>rowImages: $rowImages<br>";
// 		echo "<br>getStart: $getStart<br>";
	// 	echo "<br>getStartLeft: $getStartLeft<br>";
// 	echo "<br>getStartRight: $getStartRight<br>";
		
		$nextPossibleIdcoded = ($nextPossibleId+8)*2+100000;
		$priorPossibleIdcoded = ($priorPossibleId+8)*2+100000;
		
		
		
		
		
		// Weitergabe des Counts bei der ersten (date-desc/asc) variante. Nicht notwend
		if($positionStart==1 and $sendGetStart==0){ $arrowLeftPic =''; }
		else{//$arrowLeftPic = "<div id='cg-arrow-left-second-div'><a href='$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."&4=".$getStep."#cg-begin' ><img id='cg-arrow-left-image' style='cursor: pointer;' src='$arrowPngLeft'></a></div>"; 
		 $arrowLeftPic = "<div id='cg_arrow_left' style='position:absolute;z-index:100;top:0;left:0;margin-top:50px;'><a href='$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."#cg-begin' ><img style='cursor: pointer;' src='$arrowPngLeft'></a></div>"; 

		}
		
		if($nextCount==$countPicsSQL){ $arrowRightPic ='<div id="cg_arrow_right">&nbsp;</div>'; }
		else{ $arrowRightPic = "<div id='cg_arrow_right' style='position:absolute;z-index:100;top:0;right:0;margin-top:50px;'><a href='$siteURL&picture_id=$nextPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartRight."#cg-begin' ><img id='cg-arrow-right-image' style='cursor: pointer;' src='$arrowPngRight'></a></div>"; }		

		

		
		/*
		// Weitergabe des Counts bei der ersten (date-desc/asc) variante. Nicht notwend
		if($positionStart==1 and $sendGetStart==0){ $arrowLeftPic ='<div id="cg-arrow-left-second-div">&nbsp;</div>'; }
		else{ $arrowLeftPic = "<div id='cg-arrow-left-second-div'><a href='$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."#cg-begin' ><img id='cg-arrow-left-image' style='cursor: pointer;' src='$arrowPngLeft'></a></div>"; 	}
		
		if($nextCount==$countPicsSQL){ $arrowRightPic ='<div id="cg-arrow-left-second-div">&nbsp;</div>'; }
		else{ $arrowRightPic = "<div id='cg-arrow-right-second-div'><a href='$siteURL&picture_id=$nextPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartRight."#cg-begin' ><img id='cg-arrow-right-image' style='cursor: pointer;' src='$arrowPngRight'></a></div>"; }	
		*/
	
	
	
	
}


if ($sendOrder=='comment-desc' OR $sendOrder=='comment-asc') {

			
				
				
		$picsSQL = $wpdb->get_results( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountC $order, rowid $order LIMIT $getStart, $getStep ");		
		//$countPicsSQL = $wpdb->get_var( "SELECT COUNT(1) FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountC $order, rowid $order");
		
		$countPicsSQL = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT COUNT(1)
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY CountC $order, rowid $order
		", 
		$galeryID,1
		) );
		
// 		echo "<br>countPicsSQL: $countPicsSQL<br>";
// 		echo "<br>start: $getStart<br>";
		
		
	// 	print_r($picsSQL);
		
		$sendGetStart = $getStart;
		
		$i=0;
		$r=1;		
		
		foreach($picsSQL as $value){
			
			$id = $value->id;
			
				if($id==$pictureID){
					
					$position = $i;
					$positionStart = $r;
					
					break;
									
				}
				
			$i++;	
			$r++;	
			
		}

	// 	echo "<br>order: $order<br>";
// 		echo "<br>position: $position<br>";
// 		echo "<br>positionStart: $positionStart<br>";
		
		$nextCount = $getStart+$position+1;
		$priorCount = $getStart+$position-1;
		$priorCountPic = $getStart+$positionStart-1;
		
		$lastPic = $nextCount+$getStart;
		
// 		echo "<br>nextCount: $nextCount<br>";
// 		echo "<br>priorCount: $priorCount<br>";
	// 	echo "<br>priorCountPic: $priorCountPic<br>";
		
		//Achtung! Zählung fängt von 0 an!
		//$nextPossibleId = $wpdb->get_var( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountC $order, rowid $order LIMIT $nextCount, 1 ");
		
		$nextPossibleId = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT id
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY CountC $order, rowid $order LIMIT $nextCount, 1
		", 
		$galeryID,1
		) );
		
		
		
		//$priorPossibleId = $wpdb->get_var( "SELECT id FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ORDER BY CountC $order, rowid $order LIMIT $priorCount, 1 ");
		
		$priorPossibleId = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT id
			FROM $tablename 
			WHERE GalleryID=%d AND Active=%d ORDER BY CountC $order, rowid $order LIMIT $priorCount, 1
		", 
		$galeryID,1
		) );
		
		
		// Prüfen ob das nächste Bilder ein Step Übergang ist
		
		if($positionStart % $getStep == 0 or $nextCount > $getStart){
		
		$getStartRight = $getStart+$getStep;
		
		$checkGetStartStep = $getStart+$getStep;
		
// 		echo "<br>checkGetStartStep: $checkGetStartStep<br>";
		
			if($nextCount < $checkGetStartStep){
					$getStartRight=$getStart;
			}		
		
			/*if($positionStart == 1 AND $getStart!=0){
					$getStartRight=$getStart+$getStep;
			}*/
		
		}
		
		$checkGetStartStep = $getStart+$getStep;
		
		if($nextCount <= $checkGetStartStep){
		
		$getStartLeft = $getStart;
		
			if($positionStart == 1){
					$getStartLeft=$getStart-$getStep;
			}	
		
		}
		
		

		// Prüfen ob das vorherige Bid das aller erste ist
		
		/*$checkStart = $getStart/$getStep;
		
		if($checkStart == 1 AND $sendGetStart==0){
		echo "asfasdfsdf";
		$getStart = $getStart-$getStep;
		
		}*/
		
	
/*
		// ermitteln der vorherigen erstmöglichen ID
		foreach($priorPossibleIdQuery  as $value){
		$priorPossibleRowId = $value->rowid;
		$priorPossibleId = $value->id;
		}
		
		// ermitteln der nächsten erstmöglichen ID
		foreach($nextPossibleIdQuery  as $value){
		$nextPossibleRowId = $value->rowid;
		$nextPossibleId = $value->id;
		}*/

		
	// 	echo "<br>pictureID: $pictureID<br>";
	// 	echo "<br>rowid: $rowid<br>";
		//echo "<br>priorPossibleRowId: $priorPossibleRowId<br>"; 
	// 			echo "<br>nextPossibleId: $nextPossibleId<br>";
	// 	echo "<br>priorPossibleId: $priorPossibleId<br>";
		//echo "<br>nextPossibleRowId: $nextPossibleRowId<br>";
	// 	echo "<br>maxID: $maxID<br>";
// 	echo "<br>minID: $minID<br>";
	// 	echo "<br>rowImages: $rowImages<br>";
	// 	echo "<br>getStart: $getStart<br>";
	// 	echo "<br>getStartLeft: $getStartLeft<br>";
	// 	echo "<br>getStartRight: $getStartRight<br>";
		
		$nextPossibleIdcoded = ($nextPossibleId+8)*2+100000;
		$priorPossibleIdcoded = ($priorPossibleId+8)*2+100000;
		

				// Weitergabe des Counts bei der ersten (date-desc/asc) variante. Nicht notwend
		if($positionStart==1 and $sendGetStart==0){ $arrowLeftPic =''; }
		else{//$arrowLeftPic = "<div id='cg-arrow-left-second-div'><a href='$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."&4=".$getStep."#cg-begin' ><img id='cg-arrow-left-image' style='cursor: pointer;' src='$arrowPngLeft'></a></div>"; 
		 $arrowLeftPic = "<div id='cg_arrow_left' style='position:absolute;z-index:100;top:0;left:0;margin-top:50px;'><a href='$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."#cg-begin' ><img style='cursor: pointer;' src='$arrowPngLeft'></a></div>"; 

		}
		
		if($nextCount==$countPicsSQL){ $arrowRightPic ='<div id="cg_arrow_right">&nbsp;</div>'; }
		else{ $arrowRightPic = "<div id='cg_arrow_right' style='position:absolute;z-index:100;top:0;right:0;margin-top:50px;'><a href='$siteURL&picture_id=$nextPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartRight."#cg-begin' ><img id='cg-arrow-right-image' style='cursor: pointer;' src='$arrowPngRight'></a></div>"; }		

		/*
		// Weitergabe des Counts bei der ersten (date-desc/asc) variante. Nicht notwend
		if($positionStart==1 and $sendGetStart==0){ $arrowLeftPic ='<div id="cg-arrow-left-second-div">&nbsp;</div>'; }
		else{ $arrowLeftPic = "<div id='cg-arrow-left-second-div'><a href='$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."#cg-begin' ><img id='cg-arrow-left-image' style='cursor: pointer;' src='$arrowPngLeft'></a></div>"; 	}
		
		if($nextCount==$countPicsSQL){ $arrowRightPic ='<div id="cg-arrow-left-second-div">&nbsp;</div>'; }
		else{ $arrowRightPic = "<div id='cg-arrow-right-second-div'><a href='$siteURL&picture_id=$nextPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartRight."#cg-begin' ><img id='cg-arrow-right-image' style='cursor: pointer;' src='$arrowPngRight'></a></div>"; }	
		*/
		
}


// Bestimmung von DefineOutput

// 1 = Feldtyp
// 2 = Feldnummer // 0 ist für Bild hochladen reserviert
// 3 = Feldname // 

$i3 = 3;
$fieldnumber = array();



if($countSelectFormOutput>1){

	echo "<div id='cg-start' style='position:relative;margin-left: auto;margin-right: auto;width: $WidthGalery;'>";
	echo "<h3><a name='cg-begin'></a></h3>";
	echo "<p style='font-size:21px;'><u><a href='$siteURL&1=".$getLook."&2=".$getOrder."&3=".$getStart."#cg-begin' id='cg_back_to_gallery'>$language_BackToGallery</a></u></p><br/>";
	echo "</div>";	
	

	foreach ($selectFormOutput as $value){
		
			if($value->Field_Type == 'text-f' or $value->Field_Type == 'email-f'){
			
				$f_input_id = $value->f_input_id;
			
				$getSQL = new sql_selects($tablenameEntries,$galeryID,$f_input_id,$start,$step,$pictureID);
				$select_f_field_short = $getSQL->select_f_field_short();
				
				
					if($select_f_field_short){ 
					
						echo "<div style='margin-left: auto;margin-right: auto;width: $WidthGalery;display:block;'>";
						
						echo "<p><b>".$value->Field_Content.":</b><br>";
						
						echo $select_f_field_short;
						
						echo "</p>";
						
						echo "</div>";
						
					}
				
			} // hier aufgehört
			if($value->Field_Type == 'comment-f'){
						
				$f_input_id = $value->f_input_id;
				
				$getSQL = new sql_selects($tablenameEntries,$galeryID,$f_input_id,$start,$step,$pictureID);
				$select_f_field_long = $getSQL->select_f_field_long();
				
						if($select_f_field_long){ 
					
						echo "<div style='position:relative;margin-left: auto;margin-right: auto;width: $WidthGalery;'>";
						
						echo "<p><b>".$value->Field_Content.":</b><br>";
						
						echo $select_f_field_long;
						
						echo "</p>";
						
						echo "</div>";
					
					}
				
			}
					
			if($value->Field_Type == 'image-f'){
					
					echo "<div id='cg_main_div' style='position:relative;margin-left: auto;margin-right: auto;width: $WidthGalery;'>";
					echo "<div id='cg_img_div' style='position:relative !important;width:$WidthGalery; height: $HeightGalery;overflow:hidden;'>";
					echo "<img id='cg_img_gallery' src='$urlGallerySrc' ".@$styleCenterImage.">";
					echo "</div>";	
					echo $arrowLeftPic;				
					echo $arrowRightPic;
					echo "</div>";
					
					//echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
					
					echo "<div id='rating-div' style='margin-left: auto;margin-right: auto;width: $WidthGalery;margin-bottom:50px;padding-top:10px;'>";

					//pngUrlIconImg
					
					
					if($ForwardToURL==1 AND $cg_Use_as_URL==1){
						
						// URL ermitteln zu der wetiergeleitet werden soll
						@$cg_img_url = $wpdb->get_var("SELECT Short_Text FROM $tablenameEntries, $tablename_f_input WHERE $tablenameEntries.f_input_id = $tablename_f_input.id
						AND $tablename_f_input.Use_as_URL = '1' AND  $tablenameEntries.pid='$pictureID'");

						//hier mit PHP überprüfen ob Zeichen enthalten sind
						@$cg_img_url = trim(@$cg_img_url);
						
						if(@$cg_img_url){
						
							if (strstr($cg_img_url, 'http')) {
								$cg_img_url = $cg_img_url ;
							}
							
							else{
								
							$cg_img_url = "http://".$cg_img_url;	
								
							}
							
							if($ForwardType==2){$cg_gallery_contest_target = "target='_blank'";}
							else{$cg_gallery_contest_target='';}

						echo "<a href='$cg_img_url' title='Go to $cg_img_url' $cg_gallery_contest_target >";
						echo "<div style='float:right;width:30px;display:inline;height:21px;line-height:21px;'><img src='$pngUrlIconImg' style='float:right;cursor:pointer;'></div>";	
						echo "</a>";
						
						}
						
						else{echo "";}
					
					}
					
					
					if ($FullSize==1) {
						
						echo "<div id='show-pic-full-size' style='float:right;width:230px;font-size:18px;text-align:right;line-height:18px;'><p><a href='$uploads/$originalImage' style='text-decoration:underline !important;' target='_blank' id='cg_full_size'>$language_FullSize</a></p></div>";	

					}				
			
					
					
					if($AllowRating==1){				
					
							if(@$IPcheck!=1 or (@$IPcheck==1 and @$checkUserIP==true)){
							
								echo "<div style='width:160px !important;display:inline;float:left;vertical-align:bottom;' id='cg_rate_stars_image'>";
								  //echo "<div style='width:200px;display:inline;float:left;'>";
								 //  echo "<img src='$star1img' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'>";
								 //  echo "<img src='$star2img' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'>";
								 //  echo "<img src='$star3img' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'>";
								 // echo "<img src='$star4img' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'>";
								 // echo "<img src='$star5img' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'>";
								 //  echo "</div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star1img' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star2img' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star3img' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star4img' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star5img' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'></div>";
								  echo "<div style='display:inline-block;float:left;font-size:21px;vertical-align: middle;line-height: 21px;height: 21px;color:#000;' class='rating_cg'><b>&nbsp;($countR)</b></div>";	
								 // echo "<div style='display:inline;float:left;' id='rating_cg-$pictureID' class='rating_cg'>($countR)</div>";
								 // echo "</div>";	
									
								  echo "</div>";
								  
							}
								  
							else{

								echo "<div style='width:160px !important;float:left;vertical-align:bottom;display:none;' id='cg_rate_stars_image_hidden'>";
								//echo "<p style='font-size:18px;text-align:left;line-height:18px;display:inline;'><a href='#cg_rate_stars_image'><u>Vote:</u></a></p>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'></div>";
				
								  echo "</div>";

							echo "<div style='width:160px !important;display:inline;float:left;vertical-align:bottom;' name='cg_rate_stars_image' id='cg_rate_stars_image'>";
							echo "<p style='font-size:18px;text-align:left;line-height:18px;' id='cg_plz_vote_single_image_view'><u>$language_VoteFirst...</u></a>";
							echo "</div>";
							}			
						
					}
					
					if($AllowRating==2){		
					
							if(@$IPcheck!=1 or (@$IPcheck==1 and @$checkUserIP==true)){
							
								echo "<div style='width:160px !important;display:inline;float:left;vertical-align:bottom;' id='cg_rate_stars_image'>";
								  //echo "<div style='width:200px;display:inline;float:left;'>";
								 //  echo "<img src='$star1img' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'>";
								 //  echo "<img src='$star2img' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'>";
								 //  echo "<img src='$star3img' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'>";
								 // echo "<img src='$star4img' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'>";
								 // echo "<img src='$star5img' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'>";
								 //  echo "</div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star6img' class='$star6' style='float:left;cursor:pointer;' alt='6' id='cg_rate_star6'></div>";
								  echo "<div style='display:inline-block;float:left;font-size:21px;vertical-align: middle;line-height: 21px;height: 21px;color:#000;' class='rating_cg'><b>&nbsp;($countS)</b></div>";	
								 // echo "<div style='display:inline;float:left;' id='rating_cg-$pictureID' class='rating_cg'>($countR)</div>";
								 // echo "</div>";						 
								  echo "</div>";
								  
							}
								  
							else{

								echo "<div style='width:160px !important;float:left;vertical-align:bottom;display:none;' id='cg_rate_stars_image_hidden'>";
								//echo "<p style='font-size:18px;text-align:left;line-height:18px;display:inline;'><a href='#cg_rate_stars_image'><u>Vote:</u></a></p>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star6' style='float:left;cursor:pointer;' alt='6' id='cg_rate_star6'></div>";
								  echo "</div>";

							echo "<div style='width:160px !important;display:inline;float:left;vertical-align:bottom;' name='cg_rate_stars_image' id='cg_rate_stars_image'>";
							echo "<p style='font-size:18px;text-align:left;line-height:18px;' id='cg_plz_vote_single_image_view'><u>$language_VoteFirst...</u></a>";
							echo "</div>";
							}			
						
					}
					
					
					
					if($FbLike==1){
					
				//	$marginRightFB = $WidthGaleryWithoutPx-310;
				//	$marginRightFB = $marginRightFB."px";
					
					//echo "<div id='fb-like-div' style='float:left;display:inline;width:76px !important;height:50px !important;margin-left:20px;'>";
					//echo '<div class="fb-like" data-href="'.$siteURL.'&picture_id='.$sendPictureID.'" data-layout="button_count" data-action="like"';
				  //  echo 'data-show-faces="true" data-share="false" data-share="true" style="float:left;display:inline-block;font-size:12px !important;position:absolute;" ></div>';
					//echo '<div class="fb-like" data-href="'.$originSiteURL.'picture_id='.$sendPictureID.'" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false" data-share="true" style="float:right;display:inline;margin-right:'.$marginRightFB.';width:76px;ertical-align: middle;"></div>';
					//echo "</div>"; 
					
									echo "<div style='height:20px;line-height:18px;vertical-align:top;margin-top:5px;margin-bottom:4px;overflow:hidden;'>";
									
									echo "<div style='border:none;margin: 0;padding 0;overflow:hidden;height:50px;'>";
									echo "<iframe src='".$urlForFacebook."'  style='border: none;width:180px;height:50px;overflow:hidden;' scrolling='no'></iframe>";
									echo "</div>";
									
									
									echo "</div>";	
					
					
					
					
					}
					

					

					
							
					echo "</div>";
					
			}

		}
	
	}
	
else{

					echo "<div id='cg-start' style='position:relative;margin-left: auto;margin-right: auto;width: $WidthGalery;'>";
					echo "<h3><a name='cg-begin'></a></h3>";
					echo "<p style='font-size:21px;'><u><a href='$siteURL&1=".$getLook."&2=".$getOrder."&3=".$getStart."' id='cg_back_to_gallery'>$language_BackToGallery</a></u></p><br/>";
					echo "</div>";	
					echo "<div id='cg_main_div' style='position:relative;margin-left: auto;margin-right: auto;width: $WidthGalery;'>";
					echo "<div id='cg_img_div' style='position:relative !important;width:$WidthGalery; height: $HeightGalery;overflow:hidden;'>";
					echo "<img id='cg_img_gallery' src='$urlGallerySrc' ".@$styleCenterImage.">";
					echo "</div>";	
					echo $arrowLeftPic;				
					echo $arrowRightPic;
					echo "</div>";
					
					echo "<div id='rating-div' style='margin-left: auto;margin-right: auto;width: $WidthGalery;margin-bottom:50px;padding-top:10px;'>";
					
					if($ForwardToURL==1 AND $cg_Use_as_URL==1){
						
						// URL ermitteln zu der wetiergeleitet werden soll
						@$cg_img_url = $wpdb->get_var("SELECT Short_Text FROM $tablenameEntries, $tablename_f_input WHERE $tablenameEntries.f_input_id = $tablename_f_input.id
						AND $tablename_f_input.Use_as_URL = '1' AND  $tablenameEntries.pid='$pictureID'");
						
						//hier mit PHP überprüfen ob Zeichen enthalten sind
						@$cg_img_url = trim(@$cg_img_url);
						
						if(@$cg_img_url){

							//hier mit PHP überprüfen ob Zeichen enthalten sind
							if (strstr($cg_img_url, 'http')) {
								$cg_img_url = $cg_img_url ;
							}
							
							else{
								
							$cg_img_url = "http://".$cg_img_url;	
								
							}
							
							if($ForwardType==2){$cg_gallery_contest_target = "target='_blank'";}
							else{$cg_gallery_contest_target='';}

							echo "<a href='$cg_img_url' title='Go to $cg_img_url' $cg_gallery_contest_target >";
							echo "<div style='float:right;width:30px;display:inline;height:21px;line-height:21px;'><img src='$pngUrlIconImg' style='float:right;cursor:pointer;'></div>";	
							echo "</a>";
							
						}
						
						else{echo "";}
					
					}
					
					
					if ($FullSize==1) {
						
						echo "<div id='show-pic-full-size' style='float:right;width:230px;font-size:18px;text-align:right;line-height:18px;'><p><a href='$uploads/$originalImage' style='text-decoration:underline !important;' target='_blank' id='cg_full_size'>$language_FullSize</a></p></div>";	

					}

		
								
					
					
					if($AllowRating==1){				
					
							if(@$IPcheck!=1 or (@$IPcheck==1 and @$checkUserIP==true)){
							
								echo "<div style='width:160px !important;display:inline;float:left;vertical-align:bottom;' id='cg_rate_stars_image'>";
								  //echo "<div style='width:200px;display:inline;float:left;'>";
								 //  echo "<img src='$star1img' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'>";
								 //  echo "<img src='$star2img' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'>";
								 //  echo "<img src='$star3img' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'>";
								 // echo "<img src='$star4img' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'>";
								 // echo "<img src='$star5img' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'>";
								 //  echo "</div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star1img' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star2img' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star3img' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star4img' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star5img' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'></div>";
								  echo "<div style='display:inline-block;float:left;font-size:21px;vertical-align: middle;line-height: 21px;height: 21px;color:#000;' class='rating_cg'><b>&nbsp;($countR)</b></div>";	
								 // echo "<div style='display:inline;float:left;' id='rating_cg-$pictureID' class='rating_cg'>($countR)</div>";
								 // echo "</div>";	
									
								  echo "</div>";
								  
							}
								  
							else{

								echo "<div style='width:160px !important;float:left;vertical-align:bottom;display:none;' id='cg_rate_stars_image_hidden'>";
								//echo "<p style='font-size:18px;text-align:left;line-height:18px;display:inline;'><a href='#cg_rate_stars_image'><u>Vote:</u></a></p>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'></div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'></div>";
				
								  echo "</div>";

							echo "<div style='width:160px !important;display:inline;float:left;vertical-align:bottom;' name='cg_rate_stars_image' id='cg_rate_stars_image'>";
							echo "<p style='font-size:18px;text-align:left;line-height:18px;' id='cg_plz_vote_single_image_view'><u>$language_VoteFirst...</u></a>";
							echo "</div>";
							}			
						
					}
					
					if($AllowRating==2){		
					
							if(@$IPcheck!=1 or (@$IPcheck==1 and @$checkUserIP==true)){
							
								echo "<div style='width:160px !important;display:inline;float:left;vertical-align:bottom;' id='cg_rate_stars_image'>";
								  //echo "<div style='width:200px;display:inline;float:left;'>";
								 //  echo "<img src='$star1img' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'>";
								 //  echo "<img src='$star2img' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'>";
								 //  echo "<img src='$star3img' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'>";
								 // echo "<img src='$star4img' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'>";
								 // echo "<img src='$star5img' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'>";
								 //  echo "</div>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$star6img' class='$star6' style='float:left;cursor:pointer;' alt='6' id='cg_rate_star6'></div>";
								  echo "<div style='display:inline-block;float:left;font-size:21px;vertical-align: middle;line-height: 21px;height: 21px;color:#000;' class='rating_cg'><b>&nbsp;($countS)</b></div>";	
								 // echo "<div style='display:inline;float:left;' id='rating_cg-$pictureID' class='rating_cg'>($countR)</div>";
								 // echo "</div>";						 
								  echo "</div>";
								  
							}
								  
							else{

								echo "<div style='width:160px !important;float:left;vertical-align:bottom;display:none;' id='cg_rate_stars_image_hidden'>";
								//echo "<p style='font-size:18px;text-align:left;line-height:18px;display:inline;'><a href='#cg_rate_stars_image'><u>Vote:</u></a></p>";
								  echo "<div style='display:inline-block;float:left;width:21px;height:21px;vertical-align: middle;'><img src='$starOFF' class='$star6' style='float:left;cursor:pointer;' alt='6' id='cg_rate_star6'></div>";
								  echo "</div>";

							echo "<div style='width:160px !important;display:inline;float:left;vertical-align:bottom;' name='cg_rate_stars_image' id='cg_rate_stars_image'>";
							echo "<p style='font-size:18px;text-align:left;line-height:18px;' id='cg_plz_vote_single_image_view'><u>$language_VoteFirst...</u></a>";
							echo "</div>";
							}			
						
					}	
					
					
					if($FbLike==1){
					
				//	$marginRightFB = $WidthGaleryWithoutPx-310;
					//$marginRightFB = $marginRightFB."px";
					//$siteURL&picture_id=$priorPossibleIdcoded&1=".$getLook."&2=".$getOrder."&3=".$getStartLeft."#cg-begin
					//echo "<div id='fb-like-div' style='float:left;display:inline;width:76px !important;height:50px !important;margin-left:20px;'>";
				//	echo '<div class="fb-like" data-href="'.$siteURL.'&picture_id='.$sendPictureID.'" data-layout="button_count" data-action="like"';
				   // echo 'data-show-faces="true" data-share="false" data-share="true" style="float:left;display:inline-block;font-size:12px !important;position:absolute;" ></div>';
					//echo '<div class="fb-like" data-href="'.$originSiteURL.'picture_id='.$sendPictureID.'" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false" data-share="true" style="float:right;display:inline;margin-right:'.$marginRightFB.';width:76px;ertical-align: middle;"></div>';
					//echo "</div>"; 
					
									echo "<div style='height:20px;line-height:18px;vertical-align:top;margin-top:5px;margin-bottom:4px;overflow:hidden;'>";
									
									echo "<div style='border:none;margin: 0;padding 0;overflow:hidden;height:50px;'>";
									echo "<iframe src='".$urlForFacebook."'  style='border: none;width:180px;height:50px;overflow:hidden;' scrolling='no'></iframe>";
									echo "</div>";
									
									
									echo "</div>";	
					
					
					
					}
					

					

					
							
					echo "</div>";	
					
					
					
					
					//echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
					

					


								


							
							//if($FbLike==1){
							
							//echo "<div style='float:none;'>";
							//echo '<br/><br/><div class="fb-like" data-href="'.$commentURL.'" data-layout="button_count" data-show-faces="false" data-send="false"></div>';
							//echo "</div>";
							
							//}
							
							

					

}

// Show Image --- ENDE	
	
// Bestimmung von DefineOutput --- ENDE


// --------------- Kommentarbereich

echo "<br/>";
echo "<br/>";
//echo $AllowComments;



if($AllowComments==1){

		/*$getSQL = new sql_selects($tablenameComments,$galeryID,$order,$start,$step,$pictureID);
		$select_comments = $getSQL->select_comments();*/
		
		$widthCommentArea = $WidthGaleryWithoutPx-60;
		$widthCommentArea = $widthCommentArea.'px';
		
		//echo "<br>TableNameComments: $tablenameComments<br>";
		//echo "<br>pictureID: $pictureID<br>";
		
		
		
		$select_comments = $wpdb->get_results( "SELECT * FROM $tablenameComments WHERE pid='$pictureID' ORDER BY Timestamp DESC" );
		
		
		
		echo "<div id='cg-main-comments-div' style='margin-left: auto;margin-right: auto;width: $WidthGalery;border: 1px solid;padding-bottom:30px;'>";
		echo "<p style='text-align:center;font-size:22px;padding-top:30px;' id='cg_picture_comments_single_view'>Picture comments</p>";
		echo "<div id='cg-comments-div' style='width:$WidthGalery;padding-left:30px;padding-right:30px;'>";
		
		//print_r($select_comments);
		
		

		if($select_comments){

			

			echo "<div id='show_comments'>";

			require_once("show-comments.php");

		echo "</div>";
		

		
}


		echo "<div id='show_new_comments'>";
		
		if(!$select_comments){
	echo "<br>";
	echo "<hr style='padding:0px;margin:0px;width:$widthCommentArea;' class='cg_comments_hr' >";
}

		echo "</div>";
		
		echo "<div id='cg-hint-msg'>";

		echo "</div>";




// --------------- Kommentarbereich--------------- ENDE







// Linie wird angezeigt wenn es keine Kommentare gibt


$unix = time();
echo <<<HEREDOC
<br/>
<p style='padding-top:30px;' id='cg_your_comment_single_view'><strong>Your comment:</strong></p>
<input type="hidden" name="Timestamp" value="$unix" id="timestamp">
<div id='cg_your_comment_name_single_view'>Name:</div>
<p><input type="text" name="Name" maxlength="35" id="cg_name"></p>
<div id='cg_your_comment_comment_single_view'>Comment:</div>
<p><textarea style="width:$widthCommentArea;padding:0px;" rows="5" name="Comment" id="cg_comment">
</textarea></p>
<div id="cg_i_am_not_a_robot">

</div>

<div style='visibility:hidden;margin:0;padding:0;height:0px !important;'>
  <label for="Email">Don't fill this field, your email will not be asked.</label>
  <input id="email" name="Email" size="60" value="" />
</div>

<input type="submit" value="Send" name="Submit" id="cg_submit" style='font-size:18px;padding-left:15px;padding-right:15px;'>

HEREDOC;


// Kommentareingabe und Kommentarerfolgs- bzw. -misserfolgsmeldung wird erzeugt -------- ENDE



	echo "</div>";
	echo "</div>";
	
	
}
	
	
	echo "</div>";


echo "<br/>";


// --------------- Kommentarbereich  ------------------ ENDE

//$pathSetComment = dirname(__FILE__) . "/set-comment.php";
//$pathSetComment = get_site_url()."/wp-content/plugins/contest-gallery/frontend/set-comment.php";
//$pathRatePicture = "/../../../../wp-content/plugins/contest-gallery/frontend/rate-picture.php";
//$pathRatePicture = dirname(__FILE__) . "/rate-picture.php";
//$pathRatePicture = get_site_url()."/wp-content/plugins/contest-gallery/frontend/rate-picture.php";
$pathRatePicture = plugins_url( '/../frontend/rate-picture.php', __FILE__ );

//add_action( 'wp_ajax_my_action', 'my_action_javascript' ); 
//function my_action_javascript() {
	
	/*
add_action( 'wp_ajax_nopriv_post_love_add_love', 'post_love_add_love' );
add_action( 'wp_ajax_post_love_add_love', 'post_love_add_love' );
	
	function post_love_add_love() {
$love = "test";
echo $love;
die();
}
echo "<div id='cg_test'>";

echo "hier is the test";

echo "</div>";*/

//$prefix = $wpdb->prefix;


// Rate Image






/*
add_filter( 'the_content1', 'post_love_display1', 99 );
if(!function_exists('post_love_display1')){
function post_love_display1( $content ) {
	$love_text = '';

	if ( is_single() ) {
		
		$love = get_post_meta( get_the_ID(), 'post_love', true );
		$love = ( empty( $love ) ) ? 0 : $love;

		$love_text = '<p class="love-received"><a class="love-button" href="' . admin_url( 'admin-ajax.php?action=post_love_add_love&post_id=' . get_the_ID() ) . '" data-id="' . get_the_ID() . '">give love</a><span id="love-count">' . $love . '</span></p>'; 
	
	}

	return $content . $love_text;

}*/

// Rate Image --- ENDE

	// echo "<br>cg_ContestEnd: $ContestEnd<br>";
	// echo "<br>pictureID: $pictureID<br>";
	// echo "<br>averageStarsRounded: $averageStarsRounded<br>";
	
//$HeightGalery = substr($HeightGalery,0,-2);

//echo $HeightThumbWithoutPx;

//$loadingGifSource = plugins_url( '/css/loading.gif', __FILE__ );
$loadingGifSource = content_url().'/plugins/contest-gallery/css/loading.gif';
//echo "$AllowComments";
// Erkennen ob es show show-image Datei ist oder nicht
echo "<input type='hidden' id='cg_show_image_file' value='cg_show_image_file'>";
// Erkennen ob es show show-image Datei ist oder nicht --- ENDE
echo "<input type='hidden' id='cg_allow_comments' value='$AllowComments'>";
echo "<input type='hidden' id='cg_width_gallery' value='$WidthGaleryWithoutPx'>";
echo "<input type='hidden' id='cg_height_image' value='$HeightThumbWithoutPx'>"; // Achtung! Jquery überschreibt das Feld mit der Wert der eigentlichen dargestellten Bild-Höhe. Scale and Cut ist oft ausgeschaltet.
echo "<input type='hidden' id='cg_IpBlock' value='".@$IpBlock."'>";
echo "<input type='hidden' id='cg_loadingGifSource' value='$loadingGifSource'>";
echo "<input type='hidden' id='cg_galeryID' value='$galeryID'>";
echo "<input type='hidden' id='cg_picture_id' value='$pictureID'>";
echo "<input type='hidden' id='widthCommentArea' value='".@$widthCommentArea."'>";
// Einmaliger Wert, ähnlich dem Session Wert. Ähnlich wie User-Id. Wird von Seite zur Seite bei Wordpress weitergegeben. Generiert in frontend/get-data.php
echo "<input type='hidden' id='cg_check' value='".@$check."'>";
echo "<input type='hidden' id='ip_check' value='".@$IPcheck."'>";
echo "<input type='hidden' id='cg_ContestEndTime' value='".@$ContestEndTime."'>";
echo "<input type='hidden' id='cg_ContestEnd' value='".@$ContestEnd."'>";
echo "<input type='hidden' id='cg_IPcheck' value='".@$IPcheck."'>";
echo "<input type='hidden' id='cg_checkUserIP' value='".@$checkUserIP."'>";
echo "<input type='hidden' id='cg_HideUntilVote' value='".@$HideUntilVote."'>";
echo "<input type='hidden' id='cg_CheckLogin' value='".@$CheckLogin."'>";
echo "<input type='hidden' id='cg_UserLoginCheck' value='".@$UserLoginCheck."'>";
echo "<input type='hidden' id='cg_AlreadyRated' value='$language_YouHaveAlreadyVotedThisPicture.'>";
echo "<input type='hidden' id='cg_AllVotesUsed' value='$language_AllVotesUsed.'>";
echo "<input type='hidden' id='cg_OnlyRegisteredUsersCanVote' value='$language_OnlyRegisteredUsersCanVote.'>";
echo "<input type='hidden' id='cg_user_login_check' value='".@$UserLoginCheck."'>";
echo "<input type='hidden' id='cg_check_login' value='".@$CheckLogin."'>";
echo "<input type='hidden' id='cg_ThankYouComment' value='$language_ThankYouForYourComment'>";
echo "<input type='hidden' id='cg_show_image' value='1'>";
echo "<input type='hidden' id='cg_comment_name_characters' value='$language_TheNameFieldMustContainTwoCharactersOrMore.'>";
echo "<input type='hidden' id='cg_comment_comment_characters' value='$language_TheCommentFieldMustContainThreeCharactersOrMore.'>";
echo "<input type='hidden' id='cg_comment_not_a_robot' value='$language_PlzCheckTheCheckboxToProveThatYouAreNotArobot.'>";
echo "<input type='hidden' id='cg_photo_contest_over' value='$language_ThePhotoContestIsOver.'>";
echo "<input type='hidden' id='cg_show_single_image_view' value='1'>";// Zum erkennen dass man sich gerade in der show image datei befindet

echo "<input type='hidden' id='cg_VotesPerUser' value='$VotesPerUser' >";

	// echo "<input type='hidden' id='arrowLeftPic' value='$arrowLeftPic'>";
	// echo "<input type='hidden' id='arrowRightPic' value=".$arrowRightPic.">";

//echo "<input type='hidden' id='cg_actual_value_id' value='$averageStarsRounded'>";




//echo "<input type='hidden' id='cg_galeryID' val='$'>";
//echo "<input type='hidden' id='cg_galeryID' val='$'>";
	
?>