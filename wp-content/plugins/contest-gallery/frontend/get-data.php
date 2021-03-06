<?php

//$start1 = microtime(true);

/*
AUFBAU

1. Ermitteln von Formular Daten wenn die ganze Galerie angezeigt wird
2. SQL Klasse wird aufgestellt
3. Ermitteln von Options
4. Ermitteln von Formular Daten wenn einzelnes Bild angezeigt wird
5. Ermitteln von Image Daten
6. Aufbau diverser Variablen, die von Fall zu Fall gebraucht werden. 


*/
//echo "test";

	// Tabellennamen ermitteln, GalleryID wurde als Shortcode bereits �bermittelt.
	//global $wpdb; <<< wurde bereits in der frontend-gallery.php bestimmt

	
	$tablename = $wpdb->prefix . "contest_gal1ery";	
	//$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";  <<< wurde bereits in der frontend-gallery.php bestimmt
	$tablenameComments = $wpdb->prefix . "contest_gal1ery_comments";
	$tablename_f_input = $wpdb->prefix . "contest_gal1ery_f_input";
	$tablename_f_output = $wpdb->prefix . "contest_gal1ery_f_output";
	$tablename_options_visual = $wpdb->prefix . "contest_gal1ery_options_visual";
	$tablenameEntries = $wpdb->prefix . "contest_gal1ery_entries";
	$tablenameIP = $wpdb->prefix ."contest_gal1ery_ip";
	
		// SQL Klassen
	
	class sql_selects
	{
	
		public $tablename;
		public $galeryID;
		public $order;
		public $start;
		public $step;		
		public $pictureID;		
		
		
		  function __construct($tablename,$galeryID,$order,$start,$step,$pictureID)
		  {
			$this->tablename = $tablename;
			$this->galeryID = $galeryID;
			$this->order = $order;
			$this->start = $start;
			$this->step = $step;
			$this->pictureID = $pictureID;
		  }
		
		
		// Klassen � Methode 
		
		public function pic_sql()
		{
		global $wpdb;
		$picSQL = $wpdb->get_results( "SELECT * FROM $this->tablename WHERE id='$this->pictureID'" );
		return $picSQL;
		}	
		
		public function pics_sql_date_order()
		{
		global $wpdb;
		$picsSQL = $wpdb->get_results( "SELECT * FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Active='1' ORDER BY rowid $this->order LIMIT $this->start, $this->step ");
		return $picsSQL;
		}
		
		public function pics_sql_rating_order()
		{
		global $wpdb;
		$picsSQL = $wpdb->get_results( "SELECT * FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Active='1' ORDER BY CountR $this->order, rowid $this->order LIMIT $this->start, $this->step ");
		return $picsSQL;
		}

		public function pics_sql_rating_order_one_star()
		{
		global $wpdb;
		$picsSQL = $wpdb->get_results( "SELECT * FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Active='1' ORDER BY CountS $this->order, rowid $this->order LIMIT $this->start, $this->step ");
		return $picsSQL;
		}		
		
		public function pics_sql_comment_order()
		{
		global $wpdb;
		$picsSQL = $wpdb->get_results( "SELECT * FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Active='1' ORDER BY CountC $this->order, rowid $this->order LIMIT $this->start, $this->step ");
		return $picsSQL;
		}

		
		public function pics_sql_select_all_acitvated_ids()
		{
		global $wpdb;
		$picsSQL = $wpdb->get_results( "SELECT id FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Active='1' ORDER BY rowid $this->order");
		return $picsSQL;
		}
		
		public function options_sql()
		{
		global $wpdb;
		$optionsSQL = $wpdb->get_row( "SELECT * FROM $this->tablename WHERE id='$this->galeryID'"); // hier aufgeh�rt. Die Gallery ID wird nicht �bertragen, muss her geholt werden aus dem Jquery Post vorher oder aus dem Wordpress-PHP
		return $optionsSQL;
		}
		
		// Ermittelt ob form output vorhanden ist und w�hlt diesen aus
		public function select_f_output()
		{
		global $wpdb;
		$selectFormOutput = $wpdb->get_results( "SELECT * FROM $this->tablename WHERE GalleryID='$this->galeryID' ORDER BY Field_Order ASC");
		return $selectFormOutput;		
		}
		
		// Ermittelt den Titel eines Form Output Feldes
		/*public function select_f_output_field_titel()
		{
		global $wpdb;
		$select_f_output_field_titel = $wpdb->get_var( "SELECT Field_Content FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Field_Order = '$this->order'");
		return $select_f_output_field_titel;		
		}*/
		
		// Ermittelt den Content der eingegebenen Felder
		public function select_f_field_short()
		{
		global $wpdb;
		//$selectFormOutputFieldShort = $wpdb->get_var( "SELECT Short_Text FROM $this->tablename WHERE pid='$this->pictureID' AND f_input_id = '$this->order'");
		
		$selectFormOutputFieldShort = $wpdb->get_var( $wpdb->prepare( 
			"
				SELECT Short_Text 
				FROM $this->tablename 
				WHERE pid = %d AND f_input_id = %d
			", 
			$this->pictureID,$this->order
		) );
		
		return $selectFormOutputFieldShort;		
		}
		
		
		// Ermittelt den Content der eingegebenen Felder
		public function select_f_field_long()
		{
		global $wpdb;
		//$selectFormOutputFieldLong = $wpdb->get_var( "SELECT Long_Text FROM $this->tablename WHERE pid='$this->pictureID' AND f_input_id = '$this->order'" );
		
		$selectFormOutputFieldLong = $wpdb->get_var( $wpdb->prepare( 
			"
				SELECT Long_Text 
				FROM $this->tablename 
				WHERE pid = %d AND f_input_id = %d
			", 
			$this->pictureID,$this->order
		) );
		
		return $selectFormOutputFieldLong;		
		}
		
		
		public function pic_names_sql()
		{
		global $wpdb;
		$selectPicNames = $wpdb->get_results($wpdb->prepare("SELECT NamePic, ImgType, rowid FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Active='1' ORDER BY rowid $this->order LIMIT $this->start, $this->step ",$str));
		}
		
		/*public function rowsAnzahlB()
		{
		global $wpdb;
		$rowsAnzahlB = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Active='1' AND AnzahlB>'0'");
		
		}*/
		
		public function count_pics()
		{
		global $wpdb;
		//$count_pics = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM $this->tablename WHERE GalleryID='$this->galeryID' AND Active='1' ");
		
		$count_pics = $wpdb->get_var( $wpdb->prepare( 
			"
				SELECT COUNT(*) AS NumberOfRows 
				FROM $this->tablename 
				WHERE GalleryID = %d AND Active = %d
			", 
			$this->galeryID,1
		) );
		
		return $count_pics;
		}
		
		public function select_comments()
		{
		global $wpdb;
		$select_comments = $wpdb->get_results( "SELECT * FROM $this->tablename WHERE pid='$this->pictureID' ORDER BY Timestamp DESC" );
		return $select_comments;
		}
		
		// Ermittelt wie viele aktive Bilder in der Galerie noch vor dem aktuellen Bild sind
		public function pics_before_start()
		{
		global $wpdb;
		//$picsBeforeStart = $wpdb->get_var( "SELECT COUNT(1) FROM $this->tablename WHERE rowid='$this->pictureID' AND Active=1");
		$picsBeforeStart = $wpdb->get_var( $wpdb->prepare( 
			"
				SELECT COUNT(1)
				FROM $this->tablename 
				WHERE rowid = %d AND Active = %d
			", 
			$this->pictureID,1
		) );
		return $picsBeforeStart;
		
		//$GLOBALS['picsBeforeStart'] = $picsBeforeStart;
		//return $GLOBALS['picsBeforeStart'];
		}
		
	
	}
	
	// SQL KLassen --------------------------------- END
	
	
	// ------------------------------------------- KOMMENTAR BEREICH -------------------------------------------------------

/*

// Auswertung und Einf�gen des Kommentares

		if(@$_POST['SendComment']){

		require_once("set-comment.php");

		} 

// Auswertung und Einf�gen des Kommentares ---- ENDE


// Dank f�r erfolgreiche Kommentar�bermittlung

		if(@$_GET['SendComment']){

		require_once("set-comment.php");

		} 

// Dank f�r erfolgreiche Kommentar�bermittlung ---- ENDE */


// ------------------------------------------- KOMMENTAR BEREICH ------------------------------------------------------- ENDE
	
	
	
	
	
	// 1. Look
	// 2. Order
	// 3. Start	
	// 4. Step
	// 5. Count (Reihenfolge des Bildes in der Anordnung)	
	
	
	
	
	if (!@$_GET['picture_id']  OR $AllowGalleryScript == 1) {
	
	// Aktivierung von Caching	
/*
$cachefile = dirname(__FILE__)."/cache/show-gallery-test.html";

$cachetime = 120 * 60; // 2 hours
// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
include($cachefile);
echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
exit;
}
ob_start(); // start the output buffer */
	

	
	
	//$PicsPerSite = $wpdb->get_var( "SELECT PicsPerSite FROM $tablenameOptions WHERE id='$galeryID'"); // Wie viele Bilder sollen insgesamt  gezeigt werden
	$PicsPerSite = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT PicsPerSite
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	
	//Pr�ft ob infinite Scroll aktiviert ist
	
		$InfiniteScroll = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT InfiniteScroll
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	
	//$PicsInRow = $wpdb->get_var( "SELECT PicsInRow FROM $tablenameOptions WHERE id='$galeryID'"); // Wie viele Bilder sollen insgesamt  gezeigt werden
	//$LastRow = $wpdb->get_var( "SELECT LastRow FROM $tablenameOptions WHERE id='$galeryID'"); // Wie viele Bilder sollen insgesamt  gezeigt werden
	//$AllowSort = $wpdb->get_var( "SELECT AllowSort FROM $tablenameOptions WHERE id='$galeryID'"); // Wie viele Bilder sollen insgesamt  gezeigt werden
		$AllowSort = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT AllowSort
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	//$ThumbLook = $wpdb->get_var( "SELECT ThumbLook FROM $tablenameOptions WHERE id='$galeryID'");
			$ThumbLook = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT ThumbLook
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	//$RowLook = $wpdb->get_var( "SELECT RowLook FROM $tablenameOptions WHERE id='$galeryID'");
				$RowLook = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT RowLook
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	//$HeightLook = $wpdb->get_var( "SELECT HeightLook FROM $tablenameOptions WHERE id='$galeryID'");
					$HeightLook = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT HeightLook
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	
	//	echo "<br>ThumbLook: $ThumbLook<br>";
	
	
	//$HeightLookHeight = $wpdb->get_var( "SELECT HeightLookHeight FROM $tablenameOptions WHERE id='$galeryID'");
	
	// Reihenfolge des Galerien wird ermittelt
	$selectGalleryLookOrder = $wpdb->get_results( "SELECT ThumbLookOrder, HeightLookOrder, RowLookOrder  FROM $tablenameOptions WHERE id = '$galeryID'" );
		
	// Reihenfolge der Gallerien wird ermittelt

	$orderGalleries = array();

		foreach($selectGalleryLookOrder[0] as $key => $value){

			$orderGalleries[$value]=$key;

		}

	ksort($orderGalleries);
	
//	print_r($orderGalleries);

	//$arrowPngRight = content_url().'/plugins/contest-gallery/css/arrow_right.png';
	$arrowPngRight = plugins_url( 'css/arrow_right.png', __FILE__ );

		//$selected_look_thumb = content_url().'/plugins/contest-gallery/css/thumb-cg-view-off.jpg';
		$selected_look_thumb = plugins_url( '/../css/thumb-cg-view-off.jpg', __FILE__ );
		//$selected_look_height = content_url().'/plugins/contest-gallery/css/height-cg-view-off.jpg';
		$selected_look_height = plugins_url( '/../css/height-cg-view-off.jpg', __FILE__ );
		//$selected_look_row = content_url().'/plugins/contest-gallery/css/row-cg-view-off.jpg';
		$selected_look_row = plugins_url( '/../css/row-cg-view-off.jpg', __FILE__ );
	
		foreach($orderGalleries as $key => $value){
		
			//if($value=='ThumbLookOrder' AND $ThumbLook==1){$configuredLook = 'thumb'; $getLook = 1; $selected_look_thumb = content_url().'/plugins/contest-gallery/css/thumb-cg-view-on.jpg'; break;}
			if($value=='ThumbLookOrder' AND $ThumbLook==1){$configuredLook = 'thumb'; $getLook = 1; $selected_look_thumb = plugins_url( '/../css/thumb-cg-view-on.jpg', __FILE__ ); break;}
			//if($value=='HeightLookOrder' AND $HeightLook==1){$configuredLook = 'height'; $getLook = 2; $selected_look_height = content_url().'/plugins/contest-gallery/css/height-cg-view-on.jpg'; break;}
			if($value=='HeightLookOrder' AND $HeightLook==1){$configuredLook = 'height'; $getLook = 2; $selected_look_height = plugins_url( '/../css/height-cg-view-on.jpg', __FILE__ ); break;}
			//if($value=='RowLookOrder'  AND $RowLook==1){$configuredLook = 'row'; $getLook = 3; $selected_look_row = content_url().'/plugins/contest-gallery/css/row-cg-view-on.jpg'; break;}
			if($value=='RowLookOrder'  AND $RowLook==1){$configuredLook = 'row'; $getLook = 3; $selected_look_row = plugins_url( '/../css/row-cg-view-on.jpg', __FILE__ ); break;}
		
		
		}
		
		//echo "<br>configuredLook: $configuredLook<br>";
		
		
	
	
	
		// Pfade Ordner
	/*
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		
		$path = $_SERVER['REQUEST_URI'];
		
		$host = $_SERVER['HTTP_HOST'];
		
		$siteUrlOff = (strpos($path,'?')) ? $host.$path : $host.$path.'?';
		
		$siteURL = $pageURL.$siteUrlOff;
		
		//	echo "<br>SiteUrl1: $siteURL<br>";
		
		// Wenn der zweite Teil des Explodes existiert, dann die URL wieder zur�ck machen
		$siteURL = (strpos($siteURL,'&&')) ? str_replace("&&", "&","$siteURL") : $siteURL;
		
		//	echo "<br>SiteUrl2: $siteURL<br>";
		
		$explode = explode('&',$siteURL);
		
		$siteURL = ($explode[2]) ? $explode[0].'&'. $explode[1].'&' : $siteURL;
		
		$siteURLgalleryLook = $siteURL;
		
		$siteURLsubStr = $siteURL;
		
		//echo "<br>SiteUrl3: $siteURL<br>";
		
		if(substr($siteURLsubStr, -1)=='?'){$siteURLgalleryLook = substr($siteURLsubStr, 0, -1);}
		
		//echo "<br>SiteUrl4: $siteURL<br>";*/
		

		
	// 	echo "<br>siteURL1: $siteURL<br>";

		
	// Pfade Ordner --- ENDE
	
	
	// 	echo "<br>configuredLook: $configuredLook<br>";

	
		//echo @$_GET['1'];
	
	
		//1. Look:
		if((@$_GET['1']==1 AND $ThumbLook==1) or (@$_GET['1']==2  AND $HeightLook==1) or (@$_GET['1']==3  AND $RowLook==1)){
			if(@$_GET['1']==1){$look = 'thumb'; $getLook = 1;
			// 	$selected_look_thumb = content_url().'/plugins/contest-gallery/css/thumb-cg-view-on.jpg';
			$selected_look_thumb = plugins_url( '/../css/thumb-cg-view-on.jpg', __FILE__ );
			// 	$selected_look_height = content_url().'/plugins/contest-gallery/css/height-cg-view-off.jpg';
			$selected_look_height = plugins_url( '/../css/height-cg-view-off.jpg', __FILE__ );
			// 	$selected_look_row = content_url().'/plugins/contest-gallery/css/row-cg-view-off.jpg';
			$selected_look_row = plugins_url( '/../css/row-cg-view-off.jpg', __FILE__ );
			}
			if(@$_GET['1']==2){$look = 'height'; $getLook = 2; 
			// 	$selected_look_thumb = content_url().'/plugins/contest-gallery/css/thumb-cg-view-off.jpg';
			$selected_look_thumb = plugins_url( '/../css/thumb-cg-view-off.jpg', __FILE__ );
			// 	$selected_look_height = content_url().'/plugins/contest-gallery/css/height-cg-view-on.jpg';
			$selected_look_height = plugins_url( '/../css/height-cg-view-on.jpg', __FILE__ );
			// 	$selected_look_row = content_url().'/plugins/contest-gallery/css/row-cg-view-off.jpg';
			$selected_look_row = plugins_url( '/../css/row-cg-view-off.jpg', __FILE__ );
			}
			if(@$_GET['1']==3){$look = 'row'; $getLook = 3; 
			// 	$selected_look_thumb = content_url().'/plugins/contest-gallery/css/thumb-cg-view-off.jpg';
			$selected_look_thumb = plugins_url( '/../css/thumb-cg-view-off.jpg', __FILE__ );
			// 	$selected_look_height = content_url().'/plugins/contest-gallery/css/height-cg-view-off.jpg';
			$selected_look_height = plugins_url( '/../css/height-cg-view-off.jpg', __FILE__ );
			// 	$selected_look_row = content_url().'/plugins/contest-gallery/css/row-cg-view-on.jpg';
			$selected_look_row = plugins_url( '/../css/row-cg-view-on.jpg', __FILE__ );
			}
		}
		else{$look = $configuredLook; } // GetLook wurde oben ermittelt
		 	//echo "<br>look: $look<br>";
		
						// 2. Order (wird bei formularen �bergeben und bei bild auswahl) (1=date-desc, 2=date-asc, 3=rating-desc, 4=rating-asc, 5=comment-desc, 6=comment-asc)
			//$sendOrder = (@$_GET['1']) ? @$_GET['1'] : "date-desc";		
			
			
		if($AllowSort==1 AND (@$_GET['2']==1 or @$_GET['2']==2 or @$_GET['2']==3 or @$_GET['2']==4 or @$_GET['2']==5 or @$_GET['2']==6)){	
			if(@$_GET['2']=='1'){ $order='date-desc';  $getOrder = 1; }
			else if(@$_GET['2']=='2'){ $order='date-asc';  $getOrder = 2;}
			else if(@$_GET['2']=='3'){ $order='comment-desc';  $getOrder = 3;}
			else if(@$_GET['2']=='4'){ $order='comment-asc';  $getOrder = 4;}
			else if(@$_GET['2']=='5'){$order='rating-desc';  $getOrder = 5;}
			else if(@$_GET['2']=='6'){$order='rating-asc';  $getOrder = 6;}
		}
		else{$order='date-desc'; $getOrder = 1;}
	
	
	
	// Ermittelt die gesendeten Daten
		//$look = (@$_GET['1']) ? @$_POST['look'] : $configuredLook;
		//$order = (@$_GET['2']) ? @$_POST['order'] : 'date-desc';
		
		//$checkPicsPerSite = @$_GET['4']-@$_GET['3'];
		
		// Sollte irgendwie der Wert Null gespeichert worden sein. Wird der Wert auf 10 gesetzt und in die Datenbank gespeichert!
		if($PicsPerSite == 0){
			
			$PicsPerSite=10;
			
				$wpdb->update( 
				"$tablenameOptions",
				array('PicsPerSite' => $PicsPerSite),
				array('id' => $galeryID), 
				array('%d'),
				array('%d')
			);
			
		}
		
		
		if(@$_GET['3'] % $PicsPerSite == 0 or @$_GET['3']==0){
			$start = (@$_GET['3'])  ? @$_GET['3'] : 0;
			$getStart = (@$_GET['3'])  ? @$_GET['3'] : 0;
			//$step = (@$_GET['4']) ? @$_GET['4'] : $PicsPerSite;
		}
		else{
			$start = 0;
			$getStart = 0;
			}
			
			//echo "<br>$InfiniteScroll</br>";
			
		if($InfiniteScroll!=0){
			
		$step = 500;
		$getStep = 500;
			
		}	
		else{	
		$step = $PicsPerSite;
		$getStep = $PicsPerSite;
		}
		
		
		
	//echo "<br>start: $start<br>";
	//echo "<br>step: $step<br>";
	// echo "<br>order: $order<br>";
	// echo "<br>look: $look<br>";
	// echo "<br>start: $start<br>";
	// echo "<br>step: $step<br>";
	// echo "<br>getLook: $getLook<br>";

	
	
		// Es wird ermittelt wie viele Bilder auf einmal auf einer Seite dargestellt werden
		$count_pics = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM $tablename WHERE GalleryID='$galeryID' AND Active='1' ");
		
		// Wenn weniger als step dann wird die ermittelte zahl genommen. Wenn mehr dann wird step genommen.
		$count = ($count_pics < $PicsPerSite or $count_pics < $step) ? $count_pics : $step;
			
	
	
	//echo "count:$count";
	
	
	

	
	// Bestimmung der Daten des weitergeleitete Arrays bei show-gallery.php

	// Werte werden sowohl in W�rtern als auch in Zahlen gesendet

	
	
		//$dataArray = @$_POST['getData']; 
		
		//print_r($dataArray);

		//$galeryID = ($dataArray[0]) ? $dataArray[0] : $galeryID;
		//$widthMainCGallery = $dataArray[1];
		//$look = $dataArray[2]; // SameCount, SameHeight, Thumb 
		//$order = $dataArray[3];// Datum absteigend aufsteigend, Kommentar absteigend aufsteigend, Bewertungen Anzahl absteigend aufsteigend
		//$start = $dataArray[4];
		//$step = $dataArray[5];
		//$siteURL = $dataArray[6];
/*
// Aktivierung von Caching	
$cachefile = dirname(__FILE__).'/../../../uploads/contest-gallery/gallery-id-'.$galeryID.'/cache/gallery/1-'.$getLook.'_2-'.$getOrder.'_3-'.$start.'.html';

//$uploads = wp_upload_dir();
//$cachefile = $uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/cache/look-'.$look.'-'.$start.'-'.$step.'.html'; // Pfad zum Bilderordner angeben

$cachetime = 5 * 60; // 5 Minuten
// Serve from the cache if it is younger than $cachetime

$end = microtime(true);

$laufzeit = $end - $start1;

// echo "Laufzeit1: ".$laufzeit." Sekunden!";
	

	
	// echo "<br/>";
	// echo "<br/>";



if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
include($cachefile);
echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";





exit;
}
ob_start(); // start the output buffer 

*/
// generate SiteURL

		$permalinkURL = get_permalink();
		
	// 	echo "<br>$permalinkURL<br>";
		
		$checkPermalinkURL = explode('?',$permalinkURL);
		
		//$siteURL = ($checkPermalinkURL) ?  : "?";
		
	// 	echo "<br>checkPermalinkURL:".$checkPermalinkURL[0]; 
	
	// <input type="hidden" name="page_id" value="<?php echo "204"; 
		
		if(@$checkPermalinkURL[1]){
			$siteURL = $checkPermalinkURL[0]."?".$checkPermalinkURL[1];
			
			// echo "<br>";
			// echo $checkPermalinkURL[1];
			// echo "<br>";
			
			$pageIDname = explode('=',$checkPermalinkURL[1]);
			
			// echo "<br>";
		// 	echo $pageIDname[0];
		// 	echo "<br>";
			
			
			$pageIDvalue = explode('&',$pageIDname[1]);
			
			
		// 	echo "<br>";
		// 	echo $pageIDvalue[0];
		// 	echo "<br>";
			
			
			
			
			//$siteURLsort = $checkPermalinkURL[0]."?".$checkPermalinkURL[1];			
			$siteURLsort = $checkPermalinkURL[0];			
			}
		else{@$siteURL = @$permalinkURL."?";@$siteURLsort = @$permalinkURL;}

	//echo "<br>siteURL: $permalinkURL"; 
// generate SiteURL --- ENDE


		
		
		// 2. Reihenfolge
		
		// wird bei formularen �bergeben und bei bild auswahl
		$sendOrder = $order;
		
		$selected_date_desc = '';
		$selected_date_asc = '';
		$selected_comment_desc = '';
		$selected_comment_asc = '';
		$selected_rating_desc = '';
		$selected_rating_asc = '';
		
		//echo "<br>look: $look<br>";
		//echo "<br>order: $order<br>";
		//echo "<br>start: $start<br>";
		//echo "<br>step: $step<br>";
		
		
		if($order=='date-desc' ){$order='desc'; $getOrder=1; $sendOrder='date-desc'; $selected_date_desc = 'selected';}
		else if($order=='date-asc' ){$order='asc'; $getOrder=2; $sendOrder='date-asc'; $selected_date_asc = 'selected';}
		else if($order=='comment-desc' ){$order='desc'; $getOrder=3; $sendOrder='comment-desc'; $selected_comment_desc = 'selected';}
		else if($order=='comment-asc' ){$order='asc'; $getOrder=4; $sendOrder='comment-asc'; $selected_comment_asc = 'selected';}
		else if($order=='rating-desc' ){$order='desc';$getOrder=5; $sendOrder='rating-desc'; $selected_rating_desc = 'selected';}
		else if($order=='rating-asc' ){$order='asc';$getOrder=6; $sendOrder='rating-asc'; $selected_rating_asc = 'selected';}

		
		

		

	// 1. Order (wird bei formularen �bergeben und bei bild auswahl) (1=date-desc, 2=date-asc, 3=rating-desc, 4=rating-asc, 5=comment-desc, 6=comment-asc)
	//$sendOrder = (@$_GET['1']) ? @$_GET['1'] : "date-desc";
	/*
	echo $order;
	
	
		if($order[3]=='date-desc'){}
		else if($dataArray[3]=='date-asc'){}
		else if($dataArray[3]=='comment-desc'){ }
		else if($dataArray[3]=='comment-asc'){}
		else if($dataArray[3]=='rating-desc'){}
		else if($dataArray[3]=='rating-asc'){}
		else{$getOrder = 1;}*/
		
			//echo "<br>getOrder: $getOrder<br>";
	
	//2. Start:
	
	$getStart = $start;
	
	// 3. Step
	$getStep = $step;
	
	//4. Look (Thumb=1, Height=2, Row=3)
		/*if($look=='thumb'){$getLook = 1;}
		if($look=='height'){$getLook = 2;}
		if($look=='row'){$getLook = 3;}
		else{$getLook = 1;}*/
		
	//5.Count >>> siehe Gallerieverarbeitung

	
	// Pr�fen ob Form Feld geladen werden soll und pr�fen Visual Options
	
	
	
	@$visualOptionsSQL = $wpdb->get_row( "SELECT * FROM $tablename_options_visual WHERE GalleryID='$galeryID'");
	
	
	@$Field1IdGalleryView = @$visualOptionsSQL -> Field1IdGalleryView;
	
	if(@$Field1IdGalleryView){
	
	@$inputFieldSQL = $wpdb->get_row( "SELECT * FROM $tablename_f_input WHERE id='$Field1IdGalleryView'");
	@$inputFieldContentID = $inputFieldSQL->Field_Type;
	}
	
	//echo $inputFieldContentID;
	
	// NEU! Auswahl des Contents falls Gallerie Slider an ist und Eintragungen vorgenommen wurden
	
	if($AllowGalleryScript==1){
		
		
		// Pr�fung ob bestimmte Felder im Slider zu sehen sein sollten. Erstmal pr�fen ob AllowGalleryScript (Slider) aktiviert ist.
				@$selectFormInput = $wpdb->get_results( "SELECT id, Show_Slider FROM $tablename_f_input WHERE GalleryID = '$galeryID' AND Show_Slider = '1' ");
	
//		print_r($selectFormInput);	
		//@$ShowSliderInputID = array();
//		echo "<br>";
	//	$ShowSliderInputID[] = 0;
	
		if(@$selectFormInput){
	
				$f_input_id_collection = "";
				
					foreach (@$selectFormInput as $value) {
				
				//$ShowSlider = 	$value->Show_Slider;
				//@$ShowSliderInputID[] = $value->id;
				
					$f_input_id	= $value->id;
					
					$f_input_id_collection .= "id = $f_input_id or ";	
					
					}
				//	print_r($f_input_id_collection);
					@$f_input_id_collection = substr($f_input_id_collection,0,-4);
					
				//	echo $f_input_id_collection;
				//	echo "<br>";
				//	echo "1";

				
						$selectFormInput = $wpdb->get_results( "SELECT id, Field_Type, Field_Order, Field_Content FROM $tablename_f_input WHERE GalleryID = '$galeryID' AND ($f_input_id_collection) AND (Field_Type = 'text-f' OR Field_Type = 'comment-f' OR Field_Type ='email-f') ORDER BY Field_Order ASC" );

						$selectContentFieldArray = array();
						
						
						
						foreach ($selectFormInput as $value) {
						
							// 1. Feld Typ
							// 2. ID des Feldes in F_INPUT
							// 3. Feld Reihenfolge
							// 4. Feld Content

							$selectFieldType = 	$value->Field_Type;
							$id = $value->id;// prim�re unique id der form wird auch gespeichert und sp�ter in entries inserted zur erkennung des verwendeten formular feldes
							$fieldOrder = $value->Field_Order;// Die originale Field order in f_input Tabelle. Zwecks Vereinheitlichung.
							$selectContentFieldArray[] = $selectFieldType;
							$selectContentFieldArray[] = $id;
							$selectContentFieldArray[] = $fieldOrder;
							$selectContentField = unserialize($value->Field_Content);
							$selectContentFieldArray[] = $selectContentField["titel"];
						
						}
						
		}				
	
	}
	//print_r($selectContentFieldArray);
			// NEU! Auswahl des Contents falls Gallerie Slider an ist und Eintragungen vorgenommen wurden --- ENDE
	


	//echo "Visual Options <br>";
		//print_r($visualOptionsSQL);
			
				
		// Ermitteln visual Options
		
				
		$ThumbViewBorderWidth = $visualOptionsSQL->ThumbViewBorderWidth;
		$ThumbViewBorderRadius = $visualOptionsSQL->ThumbViewBorderRadius;
		$ThumbViewBorderColor = $visualOptionsSQL->ThumbViewBorderColor;
		$ThumbViewBorderOpacity = $visualOptionsSQL->ThumbViewBorderOpacity;
		$HeightViewBorderWidth = $visualOptionsSQL->HeightViewBorderWidth;
		$HeightViewBorderRadius = $visualOptionsSQL->HeightViewBorderRadius;
		$HeightViewSpaceWidth = $visualOptionsSQL->HeightViewSpaceWidth;
		$HeightViewSpaceHeight = $visualOptionsSQL->HeightViewSpaceHeight;
		$HeightViewBorderColor = $visualOptionsSQL->HeightViewBorderColor;
		$HeightViewBorderOpacity = $visualOptionsSQL->HeightViewBorderOpacity;
		$RowViewBorderWidth = $visualOptionsSQL->RowViewBorderWidth;
		$RowViewBorderRadius = $visualOptionsSQL->RowViewBorderRadius;
		$RowViewSpaceWidth = $visualOptionsSQL->RowViewSpaceWidth;
		$RowViewSpaceHeight = $visualOptionsSQL->RowViewSpaceHeight;
		$RowViewBorderColor = $visualOptionsSQL->RowViewBorderColor;
		$RowViewBorderOpacity = $visualOptionsSQL->RowViewBorderOpacity;
		$TitlePositionGallery = $visualOptionsSQL->TitlePositionGallery;
		$RatingPositionGallery = $visualOptionsSQL->RatingPositionGallery;
		$CommentPositionGallery = $visualOptionsSQL->CommentPositionGallery;
		$ActivateGalleryBackgroundColor = $visualOptionsSQL->ActivateGalleryBackgroundColor;
		$GalleryBackgroundColor = $visualOptionsSQL->GalleryBackgroundColor;
		$GalleryBackgroundOpacity = $visualOptionsSQL->GalleryBackgroundOpacity;
		
				
		// Ermitteln visual Options --- ENDE
	
	
	
	
	
	//echo "$Field1IdGalleryView<br>";
	
	/*
	if(@$cgFormField and @$cgFormField!=0){
	
	@$cgFormFieldRow = $wpdb->get_row( "SELECT * FROM $tablename_f_input WHERE id='$cgFormField'");
	@$cgFormFieldContent = $cgFormFieldRow->Field_Content;
	
	
	@$cgFormFieldContent = unserialize($cgFormFieldContent);
	echo "data<br>";
	print_r($cgFormFieldContent);
	
}*/
	
	
	//echo $cgFormField;
	
	$cg_slider_button = plugins_url( '/../css/close_button.png', __FILE__ );
	
	
	//Pfeile f�r Slider URLs
	
	$cg_slider_arrow_left = plugins_url( '/../css/cg_slider_arrow_left_mobile.png', __FILE__ );
	$cg_slider_arrow_right = plugins_url( '/../css/cg_slider_arrow_right_mobile.png', __FILE__ );
	
	//Star on star off f�r Slider
	
	$cg_star_on_slider = plugins_url( '/../css/star_48.png', __FILE__ );
	$cg_star_off_slider = plugins_url( '/../css/star_off_48.png', __FILE__ );
	
	
	
	// Auswahl aller aktviierten IDs
	
		@$getSQL = new sql_selects($tablename,$galeryID,$order,$start,$step,$pictureID);
		
		$pics_sql_select_all_acitvated_ids = $getSQL->pics_sql_select_all_acitvated_ids();
		
		//print_r($pics_sql_select_all_acitvated_ids);
		
		
	
	
	// Auswahl aller aktviierten IDs --- ENDE
	


	}

		// Bestimmung der Daten des weitergeleitete Arrays bei show-gallery.php ---------------- ENDE
		
		
		
		
	// 	Wird aufgerufen wenn man von einem Bild zur�ck zur Galerie gelangt
	/*else if(!@$_GET['picture_id']){
	
	
	
	
		$order = $dataArray[2];// Datum absteigend aufsteigend, Kommentar absteigend aufsteigend, Bewertungen Anzahl absteigend aufsteigend
		$look = $dataArray[3]; // SameCount, SameHeight, Thumb 
		$start = $dataArray[4];
		$step = $dataArray[5];
		$count = $dataArray[5];
	
	
	
	
	
	
	
	// Aktivierung von Caching	
$cachefile = dirname(__FILE__).'/../../../uploads/contest-gallery/gallery-id-'.$galeryID.'/cache/gallery_order-'.$order.'_look-'.$look.'_start-'.$start.'_step-'.$step.'-count-'.$count.'.html';
	
	
	
	
	
	
	
	
	
	}*/
	
		// 	Wird aufgerufen wenn man von einem Bild zur�ck zur Galerie gelangt  --- ENDE
		
		
		


	// Bestimmung von Daten bei aufrufen von show-image
	
	// 1. Look
	// 2. Reihenfolge
	// 3. Start	
	// 4. Step
	// 5. Count (Reihenfolge des Bildes in der Anordnung)
	
	else if (@$_GET['picture_id'] AND  $AllowGalleryScript != 1) {
		
	global $wpdb;
	$tablename = $wpdb->prefix . "contest_gal1ery";
	$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";	
	
	
	
	//$PicsPerSite = $wpdb->get_var( "SELECT PicsPerSite FROM $tablenameOptions WHERE id='$galeryID'");  // Wie viele Bilder sollen insgesamt  gezeigt werden
	
	$PicsPerSite = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT PicsPerSite
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
		//Pr�ft ob infinite Scroll aktiviert ist
	
		$InfiniteScroll = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT InfiniteScroll
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	
	//$ThumbLook = $wpdb->get_var( "SELECT ThumbLook FROM $tablenameOptions WHERE id='$galeryID'");
	
	$ThumbLook = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT ThumbLook
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	//$RowLook = $wpdb->get_var( "SELECT RowLook FROM $tablenameOptions WHERE id='$galeryID'");
	
	$RowLook = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT RowLook
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	//$HeightLook = $wpdb->get_var( "SELECT HeightLook FROM $tablenameOptions WHERE id='$galeryID'");
	
	$HeightLook = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT HeightLook
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	//$AllowSort = $wpdb->get_var( "SELECT AllowSort FROM $tablenameOptions WHERE id='$galeryID'");
	
	$AllowSort = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT AllowSort
		FROM $tablenameOptions 
		WHERE id = %d
	", 
	$galeryID
	) );
	
	
	// Sammeln von Daten von Get zur Weitergabe
	
	// echo @$_GET['1'];
	// echo @$_GET['2'];
	// echo @$_GET['3'];

	// echo "<br>AllowSort: $AllowSort<br>";
			
		//1. Look:
		if((@$_GET['1']==1 AND $ThumbLook==1) or (@$_GET['1']==2  AND $HeightLook==1) or (@$_GET['1']==3  AND $RowLook==1)){
			if(@$_GET['1']==1){$look = 'thumb'; $getLook = 1;}
			else if(@$_GET['1']==2){$look = 'height'; $getLook = 2;}
			else if(@$_GET['1']==3){$look = 'row'; $getLook = 3;}
			
		}
		else{$look = 'thumb'; $getLook = 1;}
		
						// 2. Order (wird bei formularen �bergeben und bei bild auswahl) (1=date-desc, 2=date-asc, 3=rating-desc, 4=rating-asc, 5=comment-desc, 6=comment-asc)
			//$sendOrder = (@$_GET['1']) ? @$_GET['1'] : "date-desc";	

		// 	echo @$_GET['2'];
			
		if($AllowSort==1 AND (@$_GET['2']==1 or @$_GET['2']==2 or @$_GET['2']==3 or @$_GET['2']==4 or @$_GET['2']==5 or @$_GET['2']==6)){		
			if(@$_GET['2']==1){$order='desc'; $sendOrder='date-desc'; $getOrder = 1;}
			else if(@$_GET['2']==2){$order='asc'; $sendOrder='date-asc'; $getOrder = 2;}
			else if(@$_GET['2']==3){$order='desc'; $sendOrder='comment-desc'; $getOrder = 3;}
			else if(@$_GET['2']==4){$order='asc'; $sendOrder='comment-asc'; $getOrder = 4;}
			else if(@$_GET['2']==5){$order='desc'; $sendOrder='rating-desc'; $getOrder = 5;}
			else if(@$_GET['2']==6){$order='asc'; $sendOrder='rating-asc'; $getOrder = 6;}
			
		}
		
		else{$order = 'desc'; $sendOrder='date-desc'; $getOrder = 1;}
		
		//echo "<br>getOrder: $getOrder<br>";
		
			
		if(@$_GET['3'] % $PicsPerSite == 0 or @$_GET['3']==0){
			$start = (@$_GET['3'])  ? @$_GET['3'] : 0;
			$getStart = (@$_GET['3'])  ? @$_GET['3'] : 0;
			//$step = (@$_GET['4']) ? @$_GET['4'] : $PicsPerSite;
		}
		else{
			$start = 0;
			$getStart = 0;
			}
			
		//	echo "<br>PicsPerSite: $PicsPerSite<br>";
		
		
		//
		
		if($InfiniteScroll!=0){
			
		$step = 500;
		$getStep = 500;
			
		}	
		else{	
		$step = $PicsPerSite;
		$getStep = $PicsPerSite;
		}
			
			//4. Look (Thumb=1, Height=2, Row=3)
				/*if(@$_GET['4']=='thumb'){$getLook = 1;}
				if(@$_GET['4']=='height'){$getLook = 2;}
				if(@$_GET['4']=='row'){$getLook = 3;}
				else{$getLook = 1;}*/
				
			//5.Count >>> siehe Gallerieverarbeitung
			//$getCount = @$_GET['5'];
	
	
	// Sammeln von Daten von Get zur Weitergabe --- ENDE
	
	//2. Start:
	
	//$start = (@$_GET['2']) ? @$_GET['2']: 0;
	

	
	
	
	
	
	
	$sendPictureID = @$_GET['picture_id'];
	

	
	// ID entschl�sseln
	$pictureID = (@$_GET['picture_id']-100000)/2-8;
	
	
		//3.Step
	//$step = (@$_GET['3']) ? @$_GET['3']: $PicsPerSite;
	
	
	//5.Count
	//$count = @$_GET['5'];	
	
	// echo "<br>getLook: $getLook<br>";
// 	echo "<br>getOrder: $getOrder<br>";
// 	echo "<br>getStart: $getStart<br>";
	/*
	
// Aktivierung von Caching	
$cachefile = dirname(__FILE__).'/../../../uploads/contest-gallery/gallery-id-'.$galeryID.'/cache/sites/id-'.@$_GET['picture_id'].'_1-'.$getLook.'_2-'.$getOrder.'_3-'.$getStart.'.html';


	
	// echo "<br>cachefile: $cachefile<br>";

	
				// Aktivierung von Caching		
//$cachefile = dirname(__FILE__)."/cache/show-image-id-db-".$pictureID.".html";

$cachetime = 120 * 60; // 2 hours
// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
include($cachefile);
echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
exit;
}
ob_start(); // start the output buffer 
	*/
	//echo "<br>PicsPerSite: $PicsPerSite<br>";
	//echo @$_POST['step'];
	

	
	
// Wenn Form Output definiert ist, dann wird die Reihenfolge der Text-Bild-Anordnung ermittelt

		$getSQL = new sql_selects($tablename_f_output,$galeryID,$order,$start,$step,$pictureID);
		$selectFormOutput = $getSQL->select_f_output();
		
		$countSelectFormOutput = count($selectFormOutput);
		
	//	print_r($selectFormOutput);
		
	//	echo "<br>countSelectFormOutput: $countSelectFormOutput</br>";

// Wenn Form Output definiert ist, dann wird die Reihenfolge der Text-Bild-Anordnung ermittelt --- ENDE
	
	
	
	
	// Ermittelt wie viele aktive Bilder in der Galerie noch vor dem aktuellen Bild sind
		$getSQL = new sql_selects($tablename,$galeryID,$order,$start,$step,$pictureID);
		$picsBeforeStart = $getSQL->pics_before_start();

		if ($picsBeforeStart < $PicsPerSite) {$start=0;}
		else{$start=floor($picsBeforeStart/$PicsPerSite*$PicsPerSite);}
		
		// 1. Order (wird bei formularen �bergeben und bei bild auswahl) (1=date-desc, 2=date-asc, 3=rating-desc, 4=rating-asc, 5=comment-desc, 6=comment-asc)
		//$sendOrder = (@$_GET['1']) ? @$_GET['1'] : "date-desc";
	
		

		

		
	}
	
	
	// Bestimmung von Daten bei aufrufen von show-image  --- ENDE	
		
	
		// ------------ Ermitteln der Options-Daten (Show-Image und Show-Gallery)
		
		
		//Pr�fen ob bei Klick auf images weitergelitet werden soll
		@$Use_as_URL = $wpdb->get_var( "SELECT Use_as_URL FROM $tablename_f_input WHERE GalleryID='$galeryID' AND Use_as_URL='1'");
		
		//Pr�fung ob es ein input Feld gibt welches als url bestimmt wurde
		if(@$Use_as_URL==true){@$cg_Use_as_URL=1;}
		else{@$cg_Use_as_URL=0;}
		
		@$getSQL = new sql_selects($tablenameOptions,$galeryID,$order,$start,$step,$pictureID);
		
		$optionsSQL = $getSQL->options_sql();
		
	
		//print_r($optionsSQL);
		
		$RowLook = $optionsSQL->RowLook; // Bilder in einer Reiehe nacheinander anzeigen oder nicht 
		$LastRow = $optionsSQL->LastRow; // Wenn $RowLook an dann wie viele Bilder sollen in letzter Spalte gezeigt werden
		//$PicsPerSite = $optionsSQL->PicsPerSite; // Wie viele Bilder sollen insgesamt  gezeigt werden --- UPDATE: Wird bereits weiter oben oder bei get-data-1.php ermittelt
		$PicsInRow = $optionsSQL->PicsInRow; // Wie viele Bilder in einer Reiehe sollen gezeigt werden 
		$WidthGalery = $optionsSQL->WidthGallery;
		$HeightGalery = $optionsSQL->HeightGallery;
		$DistancePics = $optionsSQL->DistancePics;
		$DistancePicsOriginal = $optionsSQL->DistancePics;
		$DistancePicsV = $optionsSQL->DistancePicsV;
		$DistancePicsVwithoutPX = $optionsSQL->DistancePicsV;
		$OnlyGalleryView = $optionsSQL->OnlyGalleryView;
		$AllowComments = $optionsSQL->AllowComments;
		$AllowRating = $optionsSQL->AllowRating;
		$VotesPerUser = $optionsSQL->VotesPerUser;
		$AllowSort = $optionsSQL->AllowSort;
		$RandomSort = $optionsSQL->AllowSort;
		$ShowAlways = $optionsSQL->ShowAlways;
		$ShowAlwaysInfoSlider = $optionsSQL->ShowAlwaysInfoSlider;
		//$ShowAlwaysInfoSliderDisplay = ($ShowAlwaysInfoSlider==1) ? "display:block" : "display:none !important";
		@$ScalePics = $optionsSQL->ScalePics;
		$ScaleAndCut = $optionsSQL->ScaleAndCut;
		//$AllowGalleryScript = $optionsSQL->AllowGalleryScript;   <<< wurde bereits in frontend-gallery.php bestimmt
		$ThumbsInRow = $optionsSQL->ThumbsInRow; // Anzahl der Bilder in einer Reihe bei Auswahl von ReihenAnsicht (Semi-Flickr-Ansicht)
		$ThumbLook = $optionsSQL->ThumbLook;
		$AdjustThumbLook = $optionsSQL->AdjustThumbLook;
		$RowLook = $optionsSQL->RowLook;
		$HeightLook = $optionsSQL->HeightLook;
		$WidthThumb = $optionsSQL->WidthThumb; // Breite der ThumbBilder (Normale Ansicht mit Bewertung etc.) 
		$HeightThumb = $optionsSQL->HeightThumb;  // H�he der ThumbBilder (Normale Ansicht mit Bewertung etc.)
		$LastRow = $optionsSQL->LastRow;
		$FullSize = $optionsSQL->FullSize;
		$IpBlock = $optionsSQL->IpBlock;
		@$CheckLogin = $optionsSQL->CheckLogin;
		$AllowGalleryScript = $optionsSQL->AllowGalleryScript;
		$InfiniteScroll = $optionsSQL->InfiniteScroll;
		$FullSizeImageOutGallery = $optionsSQL->FullSizeImageOutGallery;
		$FullSizeImageOutGalleryNewTab = $optionsSQL->FullSizeImageOutGalleryNewTab;
		$CommentsOutGallery = $optionsSQL->CommentsOutGallery;
		$ForwardToURL = $optionsSQL->ForwardToURL;
		$ForwardFrom = $optionsSQL->ForwardFrom;
		$ForwardType = $optionsSQL->ForwardType;
		$RatingOutGallery = $optionsSQL->RatingOutGallery;
		
	//	echo $FullSizeImageOutGallery;
		
		// Notwendig um sp�ter die star Icons anzuzeigen
		$iconsURL = content_url().'/plugins/contest-gallery/css';

		if(@$CheckLogin==1 and $AllowRating==1){
			if(is_user_logged_in()){@$UserLoginCheck = 1;} // Allow only registered users to vote (Wordpress profile) wird dadurch aktiviert			
			else{@$UserLoginCheck=0;}//Allow only registered users to vote (Wordpress profile): wird dadurch deaktiviert
		}
		else{@$UserLoginCheck=0;}
		
		//echo $AllowGalleryScript;
		
		// Einmaliger Wert, �hnlich dem Session Wert. �hnlich wie User-Id. Wird von Seite zur Seite bei Wordpress weitergegeben.
		if($AllowComments==1){$check = wp_create_nonce("check");}

	
		
		@$FbLike = $optionsSQL->FbLike;
		@$FbLikeGallery = $optionsSQL->FbLikeGallery;
		@$FbLikeGalleryVote = $optionsSQL->FbLikeGalleryVote;
		
		
		$showFbLikeInGalleryStyle = ($FbLikeGallery==1) ? "display:block" : "display:none";
		$showFbLikeInGalleryStyleVoteOrNot = ($FbLikeGalleryVote==1) ? "" : "pointer-events: none;";
	
		
		$ScaleOnly = $optionsSQL->ScaleOnly;
		@$JqgGalery = $optionsSQL->JqgGalery;
		$HeightLookHeight= $optionsSQL->HeightLookHeight;
		@$HideUntilVote= $optionsSQL->HideUntilVote;
		@$ContestEnd= $optionsSQL->ContestEnd;
		@$ContestEndTime= $optionsSQL->ContestEndTime;
		
		$WidthGaleryWithoutPx = $optionsSQL->WidthGallery; 
		$WidthThumbWithoutPx = $optionsSQL->WidthThumb; // Breite der ThumbBilder (Normale Ansicht mit Bewertung etc.)
		$HeightThumbWithoutPx = $optionsSQL->HeightThumb;
		
		$WidthThumbPx = $WidthThumb.'px';// Breite Thumb mit px f�r Heredoc
		$HeightThumbPx = $HeightThumb.'px';// H�he Thumb mit px f�r Heredoc
		$DistancePicsPx = $DistancePics.'px'; // Abstand der Thumbs Breite mit px f�r Heredoc
		$DistancePicsOriginalPx = $DistancePicsOriginal.'px'; // Abstand der Thumbs Breite mit px f�r Heredoc
		$DistancePicsVtopBlock = $DistancePicsV+12;
		$DistancePicsVtopBlock = $DistancePicsVtopBlock."px";
		$DistancePicsV = $DistancePicsV.'px'; // Abstand der Thumbs H�he mit px f�r Heredoc
		
		//echo "<br>IpBlock: $IpBlock <br>";
		
		//F�r Facebook Iframe
		$urlSource = site_url();


		
		
		@$IPcheck = @$HideUntilVote;

		
		
    	// Ermitteln der Options-Daten ---------------- ENDE
		
		
		// check IP if hide images before rated look
		
		if(@$IPcheck == 1){
		
		@$userIP = $_SERVER['REMOTE_ADDR'];
		
		//echo $userIP;
		

			if($AllowRating==1){		
			
					@$selectRatedImages = $wpdb->get_results( "SELECT pid FROM $tablenameIP WHERE IP = '".@$userIP."' AND Rating>='1' AND GalleryID='$galeryID'" );
					
				//	echo $userIP;
						
					//print_r($selectRatedImages);
					
						@$simpleRatedImagesArray = array();
						
						$simpleRatedImagesArray[] = 0;
						
							foreach(@$selectRatedImages as $key => $value1){
										
									foreach(@$value1 as $key => $value2){

									@$simpleRatedImagesArray[]=$value2;

									}
							
							}
					
			}
			
			if($AllowRating==2){
				
					@$selectRatedImagesOneStar = $wpdb->get_results( "SELECT pid FROM $tablenameIP WHERE IP = '".@$userIP."' AND RatingS>='1' AND GalleryID='$galeryID'" );
					
					@$selectRatedImagesOneStarArray = array();
					
					$selectRatedImagesOneStarArray[] = 0;
					
						foreach(@$selectRatedImagesOneStar as $key => $value3){
									
								foreach(@$value3 as $key => $value4){

								@$selectRatedImagesOneStarArray[]=$value4;

								}
						
						}						
						
					
			}
			
		
		}
		

		
		
		
	
		//print_r($simpleRatedImagesArray);

			
		// check IP if hide images before rated look --- END
		
		
		
		// Reihenfolge des Galerien wird ermittelt
		$selectGalleryLookOrder = $wpdb->get_results( "SELECT ThumbLookOrder, HeightLookOrder, RowLookOrder  FROM $tablenameOptions WHERE id = '$galeryID'" );
		
		// Reihenfolge der Gallerien wird ermittelt

$orderGalleries = array();

if(@$selectGalleryLookOrder){
	foreach($selectGalleryLookOrder[0] as $key => $value){

		@$orderGalleries[$value]=$key;

	}
	}

ksort($orderGalleries);

// Reihenfolge der Gallerien wird ermittelt --- ENDE
	

		// ------------------ Ermitteln weiter FormularDaten 
		
		// Ermitteln aller Bilder die angezeigt werden sollen und die Anzahl der Bilder die angezeigt werden k�nnen
		
		if (!@$_GET['picture_id'] OR  $AllowGalleryScript == 1) {
		
		@$getSQL = new sql_selects($tablename,$galeryID,$order,$start,$step,$pictureID);
		
		if($sendOrder =='date-desc' or $sendOrder=='date-asc' or $sendOrder=='desc'){
		
		$picsSQL = $getSQL->pics_sql_date_order();
		
		}
		
		if($sendOrder=='rating-desc' or $sendOrder=='rating-asc'){
				
				if($AllowRating==1){
				$picsSQL = $getSQL->pics_sql_rating_order();
				}
				if($AllowRating==2){
				$picsSQL = $getSQL->pics_sql_rating_order_one_star();
				}
				
		
		}


		if($sendOrder=='comment-desc' or $sendOrder=='comment-asc'){
		
		$picsSQL = $getSQL->pics_sql_comment_order();
		
		}		
		
		// Ermittelt Anzahl der Bilder die angzeigt werden k�nnen
		$rows = $getSQL->count_pics();
		
			
		}
		
		//print_r($picsSQL);

		// Ermitteln aller Bilder die angezeigt werden sollen und die Anzahl der Bilder die angezeigt werden k�nnen --- ENDE


	
	
	
	
	// Ermitteln weiter FormularDaten  --- ENDE
	
	
			// Ermitteln ob checked oder nicht ---- ENDE		




		// Ermitteln der Tabellendaten
	
		// --------------- Ermitteln der Image Daten (Show-Image)
		
		if(@$_GET['picture_id']  AND $AllowGalleryScript != 1){
		
			// Einmaliger Wert, �hnlich dem Session Wert. �hnlich wie User-Id. Wird von Seite zur Seite bei Wordpress weitergegeben.
			if($AllowComments==1){$check = wp_create_nonce("check");}
		
			// Objekt � Erzeugung 
			$getSQL = new sql_selects($tablename,$galeryID,$order,$start,$step,$pictureID);
			$picSQL = $getSQL->pic_sql();
			
			foreach($picSQL as $value){
			
			$id = $value->id;
			$rowid = $value->rowid;
			$Timestamp = $value->Timestamp.'_';
			$NamePic = $value->NamePic;
			$ImgType = $value->ImgType;
			$rating = $value->Rating;
			$countR = $value->CountR;
			$countS = $value->CountS;
			
			$countR = ($countR) ? $countR : 0; 
			
			
			$urlForFacebook=$urlSource.'/wp-content/uploads/contest-gallery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.".html";
			
			}
			
			if(@$IPcheck == 1){
			
			@$userIP = $_SERVER['REMOTE_ADDR'];
			
						if($AllowRating==1){
					
						@$checkUserIP = $wpdb->get_var( $wpdb->prepare( 
						"
							SELECT Rating
							FROM $tablenameIP 
							WHERE IP = %s and pid = %s and Rating >= %d
						",
						@$userIP,@$pictureID,1
						) );
					
					}
					
					if($AllowRating==2){
					
						@$checkUserIP = $wpdb->get_var( $wpdb->prepare( 
						"
							SELECT RatingS
							FROM $tablenameIP 
							WHERE IP = %s and pid = %s and RatingS >= %d
						",
						@$userIP,@$pictureID,1
						) );
					
					}	

			}	
			
			
			
	//$ScaleAndCut=0;
			
	if($ScaleAndCut==0){
		
		$originalImage = $Timestamp.$NamePic.".".$ImgType;

	// je nach Breite wird entsprechendes Bild gew�hlt
		if($WidthGalery <= 300) {$imageGalery = $Timestamp.$NamePic."-300width.".$ImgType;}		
		if($WidthGalery > 300 AND $WidthGalery <= 624) {$imageGalery = $Timestamp.$NamePic."-624width.".$ImgType;}		
		if($WidthGalery > 624 AND $WidthGalery <= 1024) {$imageGalery = $Timestamp.$NamePic."-1024width.".$ImgType;}		
		if($WidthGalery > 1024) {$imageGalery = $Timestamp.$NamePic.".".$ImgType; }	
		
		//$styleCenterImage = "width='$WidthGalery'";
		
		@$WidthGaleryPic = $WidthGaleryPic.'px';
		
		$WidthGalery = $WidthGalery.'px';
		
		$uploadFolder = wp_upload_dir();
		
		// Feststellen der Quelle des Original Images		
		$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.'.'.$ImgType; // Pfad zum Bilderordner angeben
		list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und H�he von original Image
		
		// Ermittlung der H�he nach Skalierung. Falls unter der eingestellten H�he, dann n�chstgr��eres Bild nehmen.
		$heightScaledGalery = $WidthGalery*$heightOriginalImg/$widthOriginalImg;
		
		
		$HeightThumbWithoutPx = $heightScaledGalery;
		
		//$styleCenterImageDiv = "style='display:inline;width: $WidthGalery;overflow:hidden;position:relative;'";
		
	}	
		
							// Definition der Variablen, notwendig f�r die Ausgabe
							
	if($ScaleAndCut==1){
	
					// destination of the uploaded original image
					
					$uploadFolder = wp_upload_dir();
					
					// Feststellen der Quelle des Original Images		
					$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.'.'.$ImgType; // Pfad zum Bilderordner angeben
					list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und H�he von original Image
					
					// Ermittlung der H�he nach Skalierung. Falls unter der eingestellten H�he, dann n�chstgr��eres Bild nehmen.
					$heightScaledGalery = $WidthGalery*$heightOriginalImg/$widthOriginalImg;
					
					
					// Falls unter der eingestellten H�he, dann gr��eres Bild nehmen (normales Bild oder panorama Bild, kein Vertikalbild)
					
					if ($heightScaledGalery <= $HeightGalery) {
					
					$widthScaledGalery = $HeightGalery*$widthOriginalImg/$heightOriginalImg;
					
					if($widthScaledGalery <= 300) {$imageGalery = $Timestamp.$NamePic."-300width.".$ImgType;}		
					if($widthScaledGalery > 300 AND $widthScaledGalery <= 624) {$imageGalery = $Timestamp.$NamePic."-624width.".$ImgType;}		
					if($widthScaledGalery > 624 AND $widthScaledGalery <= 1024) {$imageGalery = $Timestamp.$NamePic."-1024width.".$ImgType; }		
					if($widthScaledGalery > 1024) {$imageGalery = $Timestamp.$NamePic.".".$ImgType;}
					
					// Bestimmung von Breite des Bildes
					$WidthGaleryPic = $HeightGalery*$widthOriginalImg/$heightOriginalImg;
					$WidthGaleryPic = $WidthGaleryPic.'px';
					
					// Bestimmung wie viel links und rechts abgeschnitten werden soll 
					$paddingLeftRight = ($WidthGaleryPic-$WidthGalery)/2;
					$paddingLeftRight = $paddingLeftRight.'px';
					
					$padding = "left: -$paddingLeftRight;right: -$paddingLeftRight";
					
					}
					
					
					// Falls �ber der eingestellten H�he, dann kleineres Bild nehmen (kein Vertikalbild)
					if ($heightScaledGalery > $HeightGalery) {
					if($WidthGalery <= 300) {$imageGalery = $Timestamp.$NamePic."-300width.".$ImgType;}		
					if($WidthGalery > 300 AND $WidthGalery <= 624) {$imageGalery = $Timestamp.$NamePic."-624width.".$ImgType;}		
					if($WidthGalery > 624 AND $WidthGalery <= 1024) {$imageGalery = $Timestamp.$NamePic."-1024width.".$ImgType;}		
					if($WidthGalery > 1024) {$imageGalery = $Timestamp.$NamePic.".".$ImgType;}
					
					// Bestimmung von Breite des Bildes
					$WidthGaleryPic = $WidthGalery.'px';
					
					// Bestimmung wie viel oben und unten abgeschnitten werden soll
					$heightImageGalery = $WidthGalery*$heightOriginalImg/$widthOriginalImg;
					$paddingTopBottom = ($heightImageGalery-$HeightGalery)/2;
					$paddingTopBottom = $paddingTopBottom.'px';
					
					$padding = "top: -$paddingTopBottom;bottom: -$paddingTopBottom";
					
					}	
					
		 // Falls ScaleAndCut aktiviert ist wird der Div Box eingestellte Breite und H�he vergeben
		 
		 $HeightThumbWithoutPx = $heightScaledGalery;
		 
		 $WidthGalery = $WidthGalery.'px';
		 $HeightGalery = $HeightGalery.'px';
		 
		 $styleCenterImageDiv = "style='display:inline;width: $WidthGalery;height: $HeightGalery;overflow:hidden;position:relative;'";
		 
		 $styleCenterImage = "style='z-index:1;$padding;position: relative !important;max-width:none !important;' width='$WidthGaleryPic'";
		 
		 $originalImage = $Timestamp.$NamePic.".".$ImgType;
		 
		 
			}
			
		
		}
		
		// Ermitteln der Image Daten (Show-Image) ---------------------- ENDE
		
		
	
	// Ermitteln der Tabellendaten --- ENDE
	
	
			// Pfade Ordner
	
		//$uploads = content_url().'/uploads/contest-gallery/gallery-id-'.$galeryID;
		
		
		$uploads = wp_upload_dir();
		$uploads = $uploads['baseurl'].'/contest-gallery/gallery-id-'.$galeryID; // Pfad zum Bilderordner angeben
		
		/*
		Chacha, per the PHP documentation: "Set to a non-empty value if the script was queried through the HTTPS protocol."
		 So your if statement there will return false in many cases where HTTPS is indeed on.
		 You'll want to verify that $_SERVER['HTTPS'] exists and is non-empty.
		 In cases where HTTPS is not set correctly for a given server,
		 you can try checking if $_SERVER['SERVER_PORT']  == 443.
		*/
			if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443){				
				if(substr($uploads,0,5)!='https'){
					$uploads = substr($uploads,4);
					$uploads = "https".$uploads;			
				}			
			}

		//$urlTransparentPic = content_url().'/plugins/contest-gallery/css/transparent.png';
		
			// Pfade Ordner --- ENDE
	
	
	// Abgeleitete Daten, teilweise aus Tabellendaten notwendig zur Darstellung
	
		// Ermitteln Anzahl der Bilder
	
		$JqgGalery1 = ($RowLook==1 OR ($RowLook==0 AND $ThumbLook==0)) ? "style='float:left !important;padding:0 !important;margin:0 !important;border:0 !important;visibility:hidden;cursor: pointer;'" : '';
		
	// Abgeleitete Daten, teilweise aus Tabellendaten notwendig zur Darstellung --- ENDE	
	
			// Arrows source	
				
		// $arrowPngLeft = content_url().'/plugins/contest-gallery/css/arrow_left.png';
		$arrowPngLeft = plugins_url( 'css/arrow_left.png', __FILE__ );
		// $arrowPngRight = content_url().'/plugins/contest-gallery/css/arrow_right.png';
		$arrowPngRight = plugins_url( 'css/arrow_right.png', __FILE__ );

		// Arrows source -- END	
	
	// Die Reihenfolge der Bilder wird bestimmt (show-image.php)
	
		if (@$_GET['order']==true){
			if (@$_GET['order']=='DESC') {$rowImages = 'DESC';}
			if (@$_GET['order']=='ASC') {$rowImages = 'ASC';}
			if (@$_GET['order']=='DB') {	$rowImages = 'DB';}
			if (@$_GET['order']=='DC') {	$rowImages = 'DC';}
		}
		else{$rowImages = 'DESC';}
		
	//  Die Reihenfolge der Bilder wird in show-image.php bestimmt --- ENDE
	

// Pfade Ordner bei show-image.php
	
		if(@$_GET['picture_id'] AND $AllowGalleryScript != 1){

		// Pfade Ordner
	
		/*$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		
		$path = $_SERVER['REQUEST_URI'];
		
		$host = $_SERVER['HTTP_HOST'];
		
		$siteUrlOff = (strpos($path,'?')) ? $host.$path.'&' : $host.$path.'?';
		
		$siteURL = $pageURL.$siteUrlOff;
		
		//echo "<br>SiteUrl1: $siteURL<br>";
		
		// Wenn der zweite Teil des Explodes existiert, dann die URL wieder zur�ck machen
		$siteURL = (strpos($siteURL,'&&')) ? str_replace("&&", "&","$siteURL") : $siteURL;
		
		//echo "<br>SiteUrl2: $siteURL<br>";
		
		$explode = explode('&',$siteURL);
		
		$siteURL = ($explode[2]) ? $explode[0].'&'. $explode[1].'&' : $siteURL;
		
		//echo "<br>SiteUrl3: $siteURL<br>";
		
	//	echo "siteURL: $siteURL";
		
		$originSiteURL = explode('picture_id',$siteURL);
		$originSiteURL = $originSiteURL[0];
		$originSiteURL = substr($originSiteURL, 0, -1);*/
		
		//echo "originSiteURL: $originSiteURL";
		
		
		
// generate SiteURL

		$permalinkURL = get_permalink();
		
		//echo "<br>$permalinkURL<br>";
		
		$checkPermalinkURL = explode('?',$permalinkURL);
		
		//$siteURL = ($checkPermalinkURL) ?  : "?";
		
	// 	echo "<br>checkPermalinkURL:".$checkPermalinkURL[0]; 
	
	// <input type="hidden" name="page_id" value="<?php echo "204"; 
		
		if(@$checkPermalinkURL[1]){
			$siteURL = $checkPermalinkURL[0]."?".$checkPermalinkURL[1];
			
			// echo "<br>";
		// 	echo $checkPermalinkURL[1];
		// 	echo "<br>";
			
			$pageIDname = explode('=',$checkPermalinkURL[1]);
			
		// 	echo "<br>";
		// 	echo $pageIDname[0];
		// 	echo "<br>";
			
			
			$pageIDvalue = explode('&',$pageIDname[1]);
			
			
		// 	echo "<br>";
		// 	echo $pageIDvalue[0];
		// 	echo "<br>";
			
			
			
			
			//$siteURLsort = $checkPermalinkURL[0]."?".$checkPermalinkURL[1];			
			$siteURLsort = $checkPermalinkURL[0];			
			}
		else{$siteURL = $permalinkURL."?";}


// generate SiteURL --- ENDE
	

		} 
		/*
		if(@$_GET['picture_id']){

		// Configuration back to galery link
		$backToGalery = strpos($siteURL,'page_id') ? explode('&',$siteURL) : explode('/?',$siteURL);
		
		
		// Configuration link rating
		$ratingUrl = strpos($siteURL,'&sc=tr') ? str_replace("&sc=tr", "", "$siteURL") : $siteURL;

		}*/
		
			//	print_r($picsSQL);

	
// Pfade Ordner bei show-image.php  --- ENDE

?>