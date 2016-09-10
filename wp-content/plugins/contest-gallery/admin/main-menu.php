<?php

//sleep(1);

// Path to jquery Lightbox Script

$siteURL = get_site_url()."/wp-admin/admin.php";

 //$installed_version = get_option('contest_gallery_db_version');
 
 //echo "$installed_version";





?>
<script type="text/javascript">

var siteURL = <?php echo json_encode($siteURL);?>;

function checkMe(arg) {

var del = arg;

    if (confirm("Are you sure you want to delete this gallery (id "+del+")? All uploaded pictures and entries will be irrevocable deleted.")) {
        //alert("Clicked Ok");
		//confirmForm(); 
		//fDeleteFieldAndData(del);
		//e.preventDefault();
		//window.location.href = '?page=contest-gallery/index.php&delete=true&option_id='+del+'';
		window.location.replace(siteURL+'?page=contest-gallery/index.php&delete=true&option_id='+del+'');
	    return true;
    } else {
        //alert("Clicked Cancel");
        return false;
    }
}

</script>
<?php

$permalinkURL = get_site_url()."/wp-admin/admin.php";

//echo "$permalinkURL 2323242";

	global $wpdb;

	$tablename_options = $wpdb->prefix . "contest_gal1ery_options";
	//$tablename_options_visual = $wpdb->prefix . "contest_gal1ery_options_visual";

	$selectSQL = $wpdb->get_results( "SELECT * FROM $tablename_options ORDER BY id ASC" ); 	


// Update neue Tabelle wenn noch nicht existiert
/*


		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_options_visual) != $tablename_options_visual){
		$sql = "CREATE TABLE $tablename_options_visual(
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryID INT(99),
		CommentsAlignGallery VARCHAR(20),
		RatingAlignGallery VARCHAR(20),
		Field1IdGalleryView INT(20),
		Field1AlignGalleryView VARCHAR(20),
		Field2IdGalleryView INT(20),
		Field2AlignGalleryView VARCHAR(20),
		Field3IdGalleryView INT(20),
		Field3AlignGalleryView VARCHAR(20),
		ThumbViewBorderWidth INT(20),
		ThumbViewBorderColor VARCHAR(20),
		ThumbViewBorderOpacity VARCHAR(20),
		HeightViewBorderWidth INT(20),
		HeightViewBorderColor VARCHAR(20),
		HeightViewBorderOpacity VARCHAR(20),
		HeightViewSpaceWidth INT(20),
		RowViewBorderWidth INT(20),
		RowViewBorderColor VARCHAR(20),
		RowViewBorderOpacity VARCHAR(20),
		RowViewSpaceWidth INT(20)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);	

				$selectIDs = $wpdb->get_results( "SELECT id FROM $tablename_options" );
				
				$collectIDs = array();
				
				//print_r($selectIDs);
				
				foreach ($selectIDs as $key => $value) {		
					
						foreach ($value as $key => $value1) {
							$collectIDs[]= $value1;
						}	
				}
	
				foreach ($collectIDs as $key => $value) {
					
				$wpdb->query( $wpdb->prepare(
				"
					INSERT INTO $tablename_options_visual
					( id, GalleryID, CommentsAlignGallery, RatingAlignGallery,
					Field1IdGalleryView,Field1AlignGalleryView,Field2IdGalleryView,Field2AlignGalleryView,Field3IdGalleryView,Field3AlignGalleryView,
					ThumbViewBorderWidth,ThumbViewBorderColor,ThumbViewBorderOpacity,HeightViewBorderWidth,HeightViewBorderColor,HeightViewBorderOpacity,HeightViewSpaceWidth,
					RowViewBorderWidth,RowViewBorderColor,RowViewBorderOpacity,RowViewSpaceWidth)
					VALUES ( %s,%d,%s,%s,
					%s,%s,%s,%s,%s,%s,
					%d,%s,%d,%d,%s,%d,%d,
					%d,%s,%d,%d)
				", 
					'',$value,'left','left',
					'','left','','left','','left',
					0,'#ffffff',1,0,'#ffffff',1,0,
					0,'#ffffff',1,0
				) );
				
				}
			
		}*/

// Update neue Tabelle wenn noch nicht existiert --- ENDE



	
	
	echo '<div class="main-table">';
	
	echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='635px'>";
	echo "<tr><td style='padding-left:20px;overflow:hidden;' colspan='4'><p><h2>Contest Gallery</h2></p></td></tr>";
	echo "</table>";
	echo "<br/>";
	
	

		foreach($selectSQL as $value){

			$option_id = $value -> id;
			$GalleryName = $value -> GalleryName;
			
			if ($option_id % 2 != 0) {
			$backgroundColor = "#DFDFDF";
			} else {
			$backgroundColor = "#ECECEC";
			}
			
		echo "<table width='635px' style='border: 1px solid #DFDFDF;background-color:#ffffff;'>";

			echo "<tr style='background-color:#ffffff;'>";
			
			echo "<td style='padding-left:20px;width:50px;' ><p>ID: $option_id</p></td>";
			
			if($GalleryName){$GalleryName="<p style='text-align:center;'>$GalleryName</p>";}
			else {$GalleryName="";}
			
			echo "<td align='center'>$GalleryName";
			echo "<p>Shortcode: <strong>[cg_gallery id=\"".$option_id."\"]</strong></p></td>";				
			echo '<td align="center"><p><form action="?page=contest-gallery/index.php&option_id='.$option_id.'&edit_gallery=true" method="POST" ><input type="hidden" name="option_id" value="'.$option_id.'">';
			echo '<input type="hidden" name="edit_gallery_hidden_post"';
			echo '<input type="hidden" name="page" value="contest-gallery/index.php"><input name="" value="Edit" type="Submit" style="text-align:center;width:70px;background:linear-gradient(0deg, #bbe0ef 5%, #90d4f0 70%);"></form></p></td>';	
			echo '<td align="center"><p><form action="?page=contest-gallery/index.php" method="GET" ><input type="hidden" name="option_id" value="'.$option_id.'">';
			echo '<input type="hidden" name="delete" value="true"><input type="button" value="Delete" onClick="return checkMe('.$option_id.')" style="text-align:center;width:70px;background:linear-gradient(0deg, #fef050 5%, #fce129 70%);"></form></p></td>';
			//echo '<td style="padding-left:100px;padding-right:20px;"><p><form action="?page=contest-gallery/index.php&option_id=' . $option_id . '&delete=true" method="GET" ><input value="L&ouml;schen" type="Submit"></form></p></td>';
			
			echo "</tr>";
		
		echo "</table>";
		
		@$option_id++;
			
			}
			
	

echo "<br/>";

// Die nexte ID des Option Tables ermitteln
	$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$tablename_options'");
			$nextID = $last->Auto_increment;

echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='635px'>";	
 	echo '<tr><td style="padding-left:20px;overflow:hidden;" colspan="4"><p><form action="?page=contest-gallery/index.php&option_id='.$nextID.'&edit_gallery=true&create=true" method="POST" ><input type="hidden" name="option_id" value="'.$nextID.'">';
	echo '<input type="hidden" name="create" value="true"><input type="hidden" name="page" value="contest-gallery/index.php"><input name="" value="New gallery" type="Submit"></form></p></td></tr>';	
 	//echo '<tr><td style="padding-left:20px;overflow:hidden;" colspan="4"><p><a href="?page=contest-gallery/index.php&option_id=' . $option_id . '&create=true" class="classname">Neue Galerie</a></p></td></tr>';	
 	//echo '<tr><td style="padding-left:20px;overflow:hidden;" colspan="4"><p><a href="?page=contest-gallery/index.php&option_id=' . $option_id . '&create=true" class="classname">Neue Galerie</a></p></td></tr>';	
	
	echo "</table>";

	echo '</div>';
	
?>