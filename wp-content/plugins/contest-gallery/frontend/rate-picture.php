<?php


		$galeryID = intval($_REQUEST['action1']); 
		$pictureID = intval($_REQUEST['action2']); 
		$rateValue = intval($_REQUEST['action3']); 
		$type = $_REQUEST['action4']; 
		$alreadyVotedText = $_REQUEST['action5'];
		@$IpBlock = $_REQUEST['action6'];
		@$VotesPerUser = $_REQUEST['action7'];
		
		

//------------------------------------------------------------
// ----------------------------------------------------------- Bilder bewerten ----------------------------------------------------------
//------------------------------------------------------------



//global $wpdb;



//echo "<br>ip: $ip<br>";

//$tablename = $wpdb->prefix . "contest_gal1ery";
//$tablenameIP = $wpdb->prefix . "contest_gal1ery_ip";

$tablename = $wpdb->prefix ."contest_gal1ery";
$tablenameIP = $wpdb->prefix ."contest_gal1ery_ip";

//echo "$tablenameIP <br>";
//echo "$tablename <br>";

//echo "<br>pictureID-test: $pictureID<br>";
//echo "<br>rateValue-test: $rateValue<br>";

/*
	if ($pictureID) {
	  $muster1 = "/^[0-9]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster1, $pictureID) == 0) {
		// Bei Manipulation Rückfall auf 0
		exit("Bitte manipulieren Sie die URL nicht!");
	  } else {
		// Choose picture user want to rate

	  }
	}
	
	if ($rateValue) {
	  $muster1 = "/^[1-5]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster1, $rateValue) == 0 OR $rateValue==0) {
		// Bei Manipulation Rückfall auf 0
		exit("Bitte manipulieren Sie die URL nicht!");
	  } else {
		$star = $rateValue;
	  }
	}*/
	//echo $type;
	

	


if(!@$rating){
$rating = 0;
}

if(!@$countR){
$countR = 0;
}

//echo "<br>getRating-test: $getRating<br>";
//echo "<br>rating-test: $rating<br>";
//echo "<br>countR-test: $countR<br>";

//echo "getRating: $getRating";

	
if ($rateValue>6 or $rateValue<1){
echo "Rating is not allowed!<br/>";
}
else {
	
	
if($type=="slider"){
	$fontColor = "#fff";	
	//$classRatingCount = "rating_cg_slider$pictureID";
	$classRatingCount = "";
	$fontDivHeight = "font-size:21px;font-size: 21px; line-height: 21px";
	$starDiv = "width:21px;height: 21px";
	}
elseif($type=="gallery"){
	$fontColor = "#fff";	
	//$classRatingCount = "rating_cg";
	$classRatingCount = "";
	$fontDivHeight = "font-size:18px;font-size: 18px; line-height: 18px";
	$starDiv = "width:18px;height: 18px";
	}
else{
	$fontColor = "#000";
	//$classRatingCount = "rating_cg";
	$classRatingCount = "";
	$fontDivHeight = "font-size:21px;font-size: 21px; line-height: 21px";
	$starDiv = "width:21px;height: 21px";
	}	
	

$ip = $_SERVER['REMOTE_ADDR'];	
	
	
//$getRating = $wpdb->get_var( "SELECT Rating FROM $tablenameIP WHERE pid = '$pictureID' and GalleryID = '$galeryID' and IP = '$ip'" );

$getRatingPicture = $wpdb->get_var( $wpdb->prepare(
"
	SELECT COUNT(*) AS NumberOfRows
	FROM $tablenameIP 
	WHERE pid = %d and GalleryID = %d and IP = %s
", 
$pictureID,$galeryID,$ip
) );


if(@$VotesPerUser!=0 AND @$VotesPerUser!=''){
	$countVotesGallery = $wpdb->get_var( $wpdb->prepare(
	"
		SELECT COUNT(*) AS NumberOfRows
		FROM $tablenameIP 
		WHERE GalleryID = %d and IP = %s
	", 
	$galeryID,$ip
	) );
}
//echo "<br>getrating: $getRating<br>";

		
	
			$getTotalRating = $wpdb->get_row( "SELECT CountR, Rating, CountS FROM $tablename WHERE id = '$pictureID' and GalleryID = '$galeryID'" );
			$rating = $getTotalRating->Rating;
			$countR = $getTotalRating->CountR;
			$countS = $getTotalRating->CountS;
			
			$starON = plugins_url( '/../css/star_48.png', __FILE__ );
			$starOFF = plugins_url( '/../css/star_off_48.png', __FILE__ );
			
if (@$getRatingPicture and @$IpBlock==1){
			
			
			if($rateValue<=5 and $rateValue>=1){					
					

					
					$rating = round($rating/$countR,0);
						
					if($rating>=1){$star1 = "cgin$pictureID-1"; $star1img = $starON;}
					else{$star1 = "cgio$pictureID-1"; $star1img = $starOFF;}
					if($rating>=2){$star2 = "cgin$pictureID-2";$star2img = $starON;}
					else{$star2 = "cgio$pictureID-2"; $star2img = $starOFF;}
					if($rating>=3){$star3 = "cgin$pictureID-3";$star3img = $starON;}
					else{$star3 = "cgio$pictureID-3"; $star3img = $starOFF;}
					if($rating>=4){$star4 = "cgin$pictureID-4";$star4img = $starON;}
					else{$star4 = "cgio$pictureID-4"; $star4img = $starOFF;}
					if($rating>=5){$star5 = "cgin$pictureID-5";$star5img = $starON;}
					else{$star5 = "cgio$pictureID-5"; $star5img = $starOFF;}


					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star1img' class='$star1' style='float:left;cursor:pointer;$starDiv;' alt='1' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star2img' class='$star2' style='float:left;cursor:pointer;$starDiv;' alt='2' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star3img' class='$star3' style='float:left;cursor:pointer;$starDiv;' alt='3' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star4img' class='$star4' style='float:left;cursor:pointer;$starDiv;' alt='4' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star5img' class='$star5' style='float:left;cursor:pointer;$starDiv;' alt='5' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$fontDivHeight;vertical-align: middle;color:".$fontColor.";' class='$classRatingCount'><b>&nbsp;($countR)</b></div>";

			//echo "$alreadyVotedText";
			echo "<input type='hidden' id='cg_AlreadyRated' value='".$alreadyVotedText."'>";
			
			}
			
			if($rateValue==6){
			
	
				
				if($countS>0){$star6 = "cgin$pictureID-6"; $star1img = $starON;}
				else{$star6 = "cgio$pictureID-6"; $star1img = $starOFF;}
				
				 echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star1img' class='$star6' style='float:left;cursor:pointer;$starDiv;' alt='6' id='cg_rate_star$pictureID'></div>";
				 echo "<div style='display:inline-block;float:left;$fontDivHeight;vertical-align: middle;color:".$fontColor.";' class='$classRatingCount'><b>&nbsp;($countS)</b></div>";	
				 echo "<input type='hidden' id='cg_AlreadyRated' value='".$alreadyVotedText."'>";	
			}
			
			

//echo "<br>alreadyVoted: $alreadyVotedText<br>";
						  
?>
<script>


var cgVoted = document.getElementById("cg_AlreadyRated").value ;

	
//	div.innerHTML = div.innerHTML + commentDate;

alert(cgVoted);
 
 /*
var ratingPictureID = <?php echo json_encode("#rating_cgd-".$pictureID);?>;

var countR = <?php echo json_encode($countR);?>;	 

 
 alert(countR);
 alert(ratingPictureID);
 
 

	$(""+ratingPictureID+"").text("("+countR+")");*/


</script>
<?php

}


else if ((@$countVotesGallery >= @$VotesPerUser) && (@$VotesPerUser!=0 || @$VotesPerUser!='')){
			
			
			if($rateValue<=5 and $rateValue>=1){					
					

					
					$rating = round($rating/$countR,0);
						
					if($rating>=1){$star1 = "cgin$pictureID-1"; $star1img = $starON;}
					else{$star1 = "cgio$pictureID-1"; $star1img = $starOFF;}
					if($rating>=2){$star2 = "cgin$pictureID-2";$star2img = $starON;}
					else{$star2 = "cgio$pictureID-2"; $star2img = $starOFF;}
					if($rating>=3){$star3 = "cgin$pictureID-3";$star3img = $starON;}
					else{$star3 = "cgio$pictureID-3"; $star3img = $starOFF;}
					if($rating>=4){$star4 = "cgin$pictureID-4";$star4img = $starON;}
					else{$star4 = "cgio$pictureID-4"; $star4img = $starOFF;}
					if($rating>=5){$star5 = "cgin$pictureID-5";$star5img = $starON;}
					else{$star5 = "cgio$pictureID-5"; $star5img = $starOFF;}


					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star1img' class='$star1' style='float:left;cursor:pointer;$starDiv;' alt='1' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star2img' class='$star2' style='float:left;cursor:pointer;$starDiv;' alt='2' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star3img' class='$star3' style='float:left;cursor:pointer;$starDiv;' alt='3' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star4img' class='$star4' style='float:left;cursor:pointer;$starDiv;' alt='4' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star5img' class='$star5' style='float:left;cursor:pointer;$starDiv;' alt='5' id='cg_rate_star$pictureID'></div>";
					  echo "<div style='display:inline-block;float:left;$fontDivHeight;vertical-align: middle;color:".$fontColor.";' class='$classRatingCount'><b>&nbsp;($countR)</b></div>";

			//echo "$alreadyVotedText";
			echo "<input type='hidden' id='cg_AlreadyRated' value='".$alreadyVotedText."'>";
			
			}
			
			if($rateValue==6){
			
	
				
				if($countS>0){$star6 = "cgin$pictureID-6"; $star1img = $starON;}
				else{$star6 = "cgio$pictureID-6"; $star1img = $starOFF;}
				
				 echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star1img' class='$star6' style='float:left;cursor:pointer;$starDiv;' alt='6' id='cg_rate_star$pictureID'></div>";
				 echo "<div style='display:inline-block;float:left;$fontDivHeight;vertical-align: middle;color:".$fontColor.";' class='$classRatingCount'><b>&nbsp;($countS)</b></div>";	
				 echo "<input type='hidden' id='cg_AlreadyRated' value='".$alreadyVotedText."'>";	
			}
			
			

//echo "<br>alreadyVoted: $alreadyVotedText<br>";
						  
?>
<script>


var cgVoted = document.getElementById("cg_AllVotesUsed").value ;

	
//	div.innerHTML = div.innerHTML + commentDate;

alert(cgVoted);
 
 /*
var ratingPictureID = <?php echo json_encode("#rating_cgd-".$pictureID);?>;

var countR = <?php echo json_encode($countR);?>;	 

 
 alert(countR);
 alert(ratingPictureID);
 
 

	$(""+ratingPictureID+"").text("("+countR+")");*/


</script>
<?php

}






else{
	
	

		if($rateValue<=5 and $rateValue>=1){
	
			//$wpdb->insert( $tablenameIP, array( 'id' => '', 'IP' => $ip, 'GalleryID' => $galeryID, 'pid' => $pictureID, 'Rating' => $rateValue ));

					$wpdb->query( $wpdb->prepare(
						"
							INSERT INTO $tablenameIP
							( id, IP, GalleryID, pid, Rating)
							VALUES ( %s,%s,%d,%d,%d )
						", 
							'',$ip,$galeryID,$pictureID,$rateValue
					 ) );


			$cumulatedRating = $rating+$rateValue;

			$newCountR = $countR+1;

			$newRating = round($cumulatedRating/$newCountR,0);

			//$querySET = "UPDATE $tablename SET Rating='$cumulatedRating', CountR='$newCountR' WHERE id = '$pictureID' ";
			//$updateSQL = $wpdb->query($querySET);

							$wpdb->update( 
							"$tablename",
							array('Rating' => $cumulatedRating,'CountR' => $newCountR), 
							array('id' => $pictureID), 
							array('%d','%d'),
							array('%d')
							);


			echo "<input type='hidden' id='rate_picture' value='on' />";




			if($newRating>=1){$star1 = "cgin$pictureID-1"; $star1img = $starON;}
			else{$star1 = "cgio$pictureID-1"; $star1img = $starOFF;}
			if($newRating>=2){$star2 = "cgin$pictureID-2";$star2img = $starON;}
			else{$star2 = "cgio$pictureID-2"; $star2img = $starOFF;}
			if($newRating>=3){$star3 = "cgin$pictureID-3";$star3img = $starON;}
			else{$star3 = "cgio$pictureID-3"; $star3img = $starOFF;}
			if($newRating>=4){$star4 = "cgin$pictureID-4";$star4img = $starON;}
			else{$star4 = "cgio$pictureID-4"; $star4img = $starOFF;}
			if($newRating>=5){$star5 = "cgin$pictureID-5";$star5img = $starON;}
			else{$star5 = "cgio$pictureID-5"; $star5img = $starOFF;}
									  echo "<input type='hidden' class='cg_check_voted' value='1' id='cg_check_voted$pictureID'>";
									  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star1img' class='$star1' style='float:left;cursor:pointer;$starDiv;' alt='1' id='cg_rate_star$pictureID'></div>";
									  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star2img' class='$star2' style='float:left;cursor:pointer;$starDiv;' alt='2' id='cg_rate_star$pictureID'></div>";
									  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star3img' class='$star3' style='float:left;cursor:pointer;$starDiv;' alt='3' id='cg_rate_star$pictureID'></div>";
									  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star4img' class='$star4' style='float:left;cursor:pointer;$starDiv;' alt='4' id='cg_rate_star$pictureID'></div>";
									  echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$star5img' class='$star5' style='float:left;cursor:pointer;$starDiv;' alt='5' id='cg_rate_star$pictureID'></div>";
									  echo "<div style='display:inline-block;float:left;$fontDivHeight;vertical-align: middle;color:".$fontColor.";' class='$classRatingCount'><b>&nbsp;($newCountR)</b></div>";	
									  echo "<input type='hidden' class='cg_real_id' value='$pictureID'>";	
									  

?>

<script>

// hidden value in input field, in show-gallery.php für einzelnes Bild generiert, wird gesetzt
var newCountR = <?php echo json_encode($newCountR);?>;	 
var pictureID = <?php echo json_encode($pictureID);?>;
var newRating = <?php echo json_encode($newRating);?>;
var tagID = 'countRatingQuantity'+pictureID;
var elem = document.getElementById(tagID);
elem.value = newCountR;

// check voted hidden Feld wird als value 1 eingefügt, damit erkannt wird dass der user schon gevotet hat und nach dem schließen des sliders das gevotete renewt wird.
var tagID = 'cg_check_voted'+pictureID;
var elem = document.getElementById(tagID);
elem.value = "1";

var tagID = 'averageStarsRounded'+pictureID;
var elem = document.getElementById(tagID);
elem.value = newRating;
 

</script>
<?php
									  
		}
		
		if($rateValue==6){
			
			
			//$wpdb->insert( $tablenameIP, array( 'id' => '', 'IP' => $ip, 'GalleryID' => $galeryID, 'pid' => $pictureID, 'Rating' => $rateValue ));

			$wpdb->query( $wpdb->prepare(
				"
					INSERT INTO $tablenameIP
					( id, IP, GalleryID, pid, Rating, RatingS)
					VALUES ( %s,%s,%d,%d,%d,%d )
				", 
					'',$ip,$galeryID,$pictureID,0,1
			 ) );
			 
			$countS++;

							$wpdb->update( 
							"$tablename",
							array('CountS' => $countS), 
							array('id' => $pictureID), 
							array('%d','%d'),
							array('%d')
							);


			echo "<input type='hidden' id='rate_picture' value='on' />";
			echo "<input type='hidden' class='cg_check_voted' value='1' id='cg_check_voted$pictureID'>";

			$star6 = "cgin$pictureID-6"; $starON;	

			 echo "<div style='display:inline-block;float:left;$starDiv;vertical-align: middle;'><img src='$starON' class='$star6' style='float:left;cursor:pointer;$starDiv;' alt='6' id='cg_rate_star$pictureID'></div>";
			 echo "<div style='display:inline-block;float:left;$fontDivHeight;vertical-align: middle;color:".$fontColor.";' class='$classRatingCount'><b>&nbsp;($countS)</b></div>";	
			 echo "<input type='hidden' class='cg_real_id' value='$pictureID'>";
			 
			
?>

<script>

// hidden value in input field, in show-gallery.php für einzelnes Bild generiert, wird gesetzt 
var countS = <?php echo json_encode($countS);?>;
//alert(countS); 

var pictureID = <?php echo json_encode($pictureID);?>;
//alert(pictureID); 


var tagID = 'countRatingSQuantity'+pictureID;
var elem = document.getElementById(tagID);
elem.value = countS;

// check voted hidden Feld wird als value 1 eingefügt, damit erkannt wird dass der user schon gevotet hat und nach dem schließen des sliders das gevotete renewt wird.
var tagID = 'cg_check_voted'+pictureID;
var elem = document.getElementById(tagID);
elem.value = "1";


 

</script>
<?php

 
			 
		}		
		
						  




}

}


?>