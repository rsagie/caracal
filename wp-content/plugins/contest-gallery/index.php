<?php
/*
Plugin Name: Contest Gallery
Description: Organize gallery or photo contest by using modern slider with animations, high level gallery views and by generating upload forms for images and information fields you need!
Version: 4.11
Author: Contest Gallery
Author URI: http://www.contest-gallery.com/
*/

/*
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);*/


//Beim Update vorgehensweise:
//$js_cg_version replace
//$p_cgal1ery_db_new_version für die Datenbank
//style.css version änderung
// Delete table wenn neues kreiert wurde, nicht vergessen


// JS File UPdates:
/*
20151108:
show_gallery_jquery2.js
edit_options2.js
show_jquery_language2.js
create_upload2.js
cg_rate2.js



*/



// define the admin_head-<hook_suffix> callback 
/*
function action_admin_head_cg_action(  ) { 
//echo '<meta name="description" content="Hello world. This meta description was created using my action hook example." />' . "\n";
echo '<!DOCTYPE html><head><meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" /></head>';
}; 
         
// add the action 
add_action( "admin_head", 'action_admin_head_cg_action', 0, 0 ); 

do_action( 'admin_head' ); 

add_action( 'wp_head', 'my_actionhook_example' );
function my_actionhook_example() {
echo '<meta name="description" content="Hello world. This meta description was created using my action hook example." />' . "\n";
} // The end of my_actionhook_example()




function contest_gal1ery_admin_header() {

    header("Cache-Control: private, must-revalidate,max-age=0, no-store, no-cache, must-revalidate, post-check=0, pre-check=0" );

}

add_action( 'send_headers', 'contest_gal1ery_admin_header' );




function my_custom_admin_head() {
	 header("Cache-Control: private, must-revalidate,max-age=0, no-store, no-cache, must-revalidate, post-check=0, pre-check=0" );
}
add_action( 'admin_head', 'my_custom_admin_head' );


add_action('admin_head-HOOK_SUFFIX', 'myplugin_adminhead');
function myplugin_adminhead() {
     echo '<meta name="description" content="Hello world. This meta description was created using my action hook example." />' . "\n";
}*/

//Create MySQL WP Table

// Register a new shortcode: [book]
add_shortcode( 'cg_gallery', 'frontend_gallery' );
add_shortcode( 'cg_users_upload', 'users_upload' );


	// Aktuelle Javascript Version <<< Änderung muss an 7 Stellen geschehen!
	$js_cg_version = '410'; // Javascript und CSS hat sich bei 3.11 nicht verändert!
	
	//add_site_option('ipm_security_failed_logins_blocker_options',$failedLoginsBlockerOptions);
	//add_option( "ipm_security_failed_logins_blocker_options", $failedLoginsBlockerOptions );
		
		
	
		

function frontend_gallery($atts){

/*

function my_function1()
{
echo '<meta name="12345" content="12345">';
}

add_action('wp_head', 'my_function1');*/
/*
function myCallbacktoAddMeta($lalala){
	
  echo "\t<meta property='og:image' content='12345' />\n";
 
}

$lalala = "https://www.contest-gallery.com/test-cg-1/wp-content/uploads/contest-gallery/gallery-id-8/1445181071_1_contest-gallery_174454592__large_.jpg";
myCallbacktoAddMeta($lalala);

add_action('wp_head', 'myCallbackToAddMeta,1,1');*/		
			
	// Aktuelle Javascript Version
	$js_cg_version = '410';
		
//	wp_enqueue_script( 'jquery.minicolors', plugins_url( '/js/color-picker/jquery.minicolors.js', __FILE__ ), array('jquery'), false, true );
//	wp_enqueue_script( 'jquery.minicolors.min', plugins_url( '/js/color-picker/jquery.minicolors.min.js', __FILE__ ), array('jquery'), false, true );
	wp_enqueue_script( 'jquery_frontend_color_picker', plugins_url( '/js/color-picker/jquery_frontend_color_picker.js', __FILE__ ), array('jquery'), false, true );
	wp_enqueue_script( 'show_gallery_jquery', plugins_url( '/js/show_gallery_jquery'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
	wp_enqueue_script( 'show_gallery_jquery_image_slider', plugins_url( '/js/show_gallery_jquery_image_slider'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
	wp_enqueue_script( 'show_image_jquery', plugins_url( '/js/show_image_jquery'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
	//wp_enqueue_script( 'show_jquery_language', plugins_url( '/js/show_jquery_language'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
	//wp_enqueue_script( 'show_jquery_out_of_gallery_rating', plugins_url( '/js/show_jquery_language'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
	wp_enqueue_script( 'jquery-ui-draggable' );
	//wp_enqueue_script( 'jquery-mobile-swipe' );
	//wp_enqueue_script( 'show_image_jquery_language', plugins_url( '/js/show_image_jquery_language.js', __FILE__ ), array('jquery'), false, true );
	//wp_enqueue_script( 'rate_picture', plugins_url( '/js/rate_picture.js', __FILE__ ), array('jquery'), false, true );
	@ob_start();
	include_once 'frontend/frontend-gallery.php';
	$frontend_gallery = @ob_get_clean();
	return $frontend_gallery;
	}


	function users_upload($atts){
		
	// Aktuelle Javascript Version
	$js_cg_version = '410';

	wp_enqueue_script( 'users_upload', plugins_url( '/js/users_upload'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
	//wp_enqueue_script( 'show_jquery_language', plugins_url( '/js/show_jquery_language'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
	ob_start();
	include_once 'frontend/users-upload.php';
	$users_upload = ob_get_clean();
	return $users_upload;
	}
	
	

	

if(!function_exists('contest_gal1ery_create_table')){	
	function contest_gal1ery_create_table(){
		
			
	global $wpdb;


	$tablename = $wpdb->prefix . "contest_gal1ery";
	//$tablename_test_db = $wpdb->prefix . "contest_gal1ery_test_db"; 
	$tablename_ip = $wpdb->prefix . "contest_gal1ery_ip";
	$tablename_comments = $wpdb->prefix . "contest_gal1ery_comments";
	$tablename_options = $wpdb->prefix . "contest_gal1ery_options";
	$tablename_options_input = $wpdb->prefix . "contest_gal1ery_options_input";
	$tablename_options_visual = $wpdb->prefix . "contest_gal1ery_options_visual";
	$tablename_email = $wpdb->prefix . "contest_gal1ery_mail";
	$tablename_email_admin = $wpdb->prefix . "contest_gal1ery_mail_admin";
	$tablename_entries = $wpdb->prefix . "contest_gal1ery_entries";
	$tablename_create_user_entries = $wpdb->prefix . "contest_gal1ery_create_user_entries";
	$tablename_create_activation = $wpdb->prefix . "contest_gal1ery_activation";
	$tablename_create_user_form = $wpdb->prefix . "contest_gal1ery_create_user_form";
	$tablename_form_input = $wpdb->prefix . "contest_gal1ery_f_input";
	$tablename_form_output = $wpdb->prefix . "contest_gal1ery_f_output";
	
	
		/*if($wpdb->get_var("SHOW TABLES LIKE '$tablename_test_db'") != $tablename_test_db){
		$sql = "CREATE TABLE $tablename_test_db (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		rowid INT(99),
		Timestamp INT(20),
		NamePic VARCHAR(1000),
		ImgType VARCHAR(5),
		CountC VARCHAR(7),
		CountR VARCHAR(7),
		Rating VARCHAR(13),
		GalleryID INT(99),
		Active INT(1),
		Informed INT(1)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			}*/
	
	


			
		if($wpdb->get_var("SHOW TABLES LIKE '$tablename'") != $tablename){
		$sql = "CREATE TABLE $tablename (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		rowid INT(99),
		Timestamp INT(20),
		NamePic VARCHAR(1000),
		ImgType VARCHAR(5),
		CountC VARCHAR(7),
		CountR VARCHAR(7),
		CountS VARCHAR(7),
		Rating VARCHAR(13),
		GalleryID INT(99),
		Active INT(1),
		Informed INT(1)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			}
			
		else{
			
		$sql = "ALTER TABLE $tablename MODIFY COLUMN NamePic VARCHAR(1000) NOT NULL";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		}	

		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_ip'") != $tablename_ip){
		$sql = "CREATE TABLE $tablename_ip (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		pid INT (99),
		IP VARCHAR (40),
		GalleryID INT (99),
		Rating INT (1),
		RatingS INT (1)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
				}

		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_comments'") != $tablename_comments){
		$sql = "CREATE TABLE $tablename_comments (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		pid INT (99),
		GalleryID INT (6),
		Name VARCHAR(35),
		Date VARCHAR(50),
		Comment TEXT,
		Timestamp VARCHAR(20)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);	
		}
		
		//URL VARCHAR(2000) erst ab Version 3.06 vorhanden 
		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_email'") != $tablename_email){
		$sql = "CREATE TABLE $tablename_email (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryID INT (99),
		Admin VARCHAR(200),
		Header VARCHAR(200),
		Reply VARCHAR(200),
		CC VARCHAR(200),
		BCC VARCHAR(200),
		URL VARCHAR(2000),
		Content VARCHAR (2000)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);		
		}
		
				//URL VARCHAR(2000) erst ab Version 3.06 vorhanden 
		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_email_admin'") != $tablename_email_admin){
		$sql = "CREATE TABLE $tablename_email_admin (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryID INT (99),
		Admin VARCHAR(200),
		AdminMail VARCHAR(200),
		Header VARCHAR(200),
		Reply VARCHAR(200),
		CC VARCHAR(200),
		BCC VARCHAR(200),
		URL VARCHAR(2000),
		Content VARCHAR (2000)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);		
			
			
		// Options Admin Email erschaffen und Werte einfügen falls nicht vorhanden ist
				$selectIDs = $wpdb->get_results( "SELECT id FROM $tablename_options" );
				
				$collectIDs = array();
				
				foreach ($selectIDs as $key => $value) {		
					
						foreach ($value as $key => $value1) {
							$collectIDs[]= $value1;
						}	
				}
				
				
		if(!function_exists('cg_create_table_email_admin')){
		// Determine email of blog admin and variables for email table 	
		$from = get_option('blogname');
		$reply = get_option('admin_email');
		$AdminMail = get_option('admin_email');
		$Header = 'A new picture was published';
		$ContentAdminMail = 'Dear Admin<br/><br/>A new picture was published<br/><br/><br/>$info$';
		}
	
 
		/*$wpdb->insert( $tablenameMail, array( 'id' => '', 'GalleryID' => $nextIDgallery, 'Admin' => "$from",
			'Header' => "$Header", 'Reply' => "$reply", 'cc' => "$reply",
			'bcc' => "$reply", 'Url' => '', 'Content' => "$Content"));*/
			
					foreach ($collectIDs as $key => $value) {
					
					
					
					$wpdb->query($wpdb->prepare(
						"
							INSERT INTO $tablename_email_admin
							( id, GalleryID, Admin, AdminMail,
							Header,Reply,cc,
							bcc,Url,Content)
							VALUES ( %s,%d,%s,%s,
							%s,%s,%s,
							%s,%s,%s)
						", 
							'',$value,$from,$AdminMail,
							$Header,$reply,$reply,
							$reply,'',$ContentAdminMail
					 ));
				
				}			
			
		}
		
		

		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_options'") != $tablename_options){
		$sql = "CREATE TABLE $tablename_options(
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryName VARCHAR(200),
		PicsPerSite INT (3),
		WidthThumb INT (5),
		HeightThumb INT (5),
		WidthGallery INT (5),
		HeightGallery INT (5),
		DistancePics INT (5),
		DistancePicsV INT (5),
		MaxResJPGon INT(1),
		MaxResPNGon INT(1),
		MaxResGIFon INT(1),
		MaxResJPG INT(20),
		MaxResJPGwidth INT(20),
		MaxResJPGheight INT(20),
		MaxResPNG INT(20),
		MaxResPNGwidth INT(20),
		MaxResPNGheight INT(20),
		MaxResGIF INT(20),
		MaxResGIFwidth INT(20),
		MaxResGIFheight INT(20),
		OnlyGalleryView TINYINT,
		SinglePicView TINYINT,
		ScaleOnly TINYINT,
		ScaleAndCut TINYINT,
		FullSize TINYINT,
		AllowSort TINYINT,
		RandomSort TINYINT,
		AllowComments TINYINT,
		CommentsOutGallery TINYINT,
		AllowRating TINYINT,
		VotesPerUser INT(5),
		RatingOutGallery TINYINT,
		ShowAlways TINYINT,
		ShowAlwaysInfoSlider TINYINT,
		IpBlock TINYINT,
		CheckLogin TINYINT,
		FbLike TINYINT,
		FbLikeGallery TINYINT,
		FbLikeGalleryVote TINYINT, 
		AllowGalleryScript TINYINT,
		InfiniteScroll TINYINT,
		FullSizeImageOutGallery TINYINT,
		FullSizeImageOutGalleryNewTab TINYINT,
		Inform TINYINT,
		InformAdmin TINYINT,
		TimestampPicDownload VARCHAR(20),
		ThumbLook TINYINT,
		AdjustThumbLook TINYINT,
		HeightLook TINYINT,
		RowLook TINYINT,
		ThumbLookOrder TINYINT,
		HeightLookOrder TINYINT,
		RowLookOrder TINYINT,
		HeightLookHeight INT(3),
		ThumbsInRow TINYINT,
		PicsInRow TINYINT,
		LastRow TINYINT,
		HideUntilVote TINYINT,
		ActivateUpload TINYINT,
		ContestEnd TINYINT,
		ContestEndTime VARCHAR(100),
		ForwardToURL TINYINT,
		ForwardFrom TINYINT,
		ForwardType TINYINT,
		ActivatePostMaxMB TINYINT,
		PostMaxMB INT(20),
		ActivateBulkUpload TINYINT,
		BulkUploadQuantity INT(20),
		BulkUploadMinQuantity INT(20)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			
		}
		
		
		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_options_visual'") != $tablename_options_visual){
		//IF(SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = "$tablename_options_visual" LIMIT 1){
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
		ThumbViewBorderRadius INT(20),		
		ThumbViewBorderColor VARCHAR(20),
		ThumbViewBorderOpacity VARCHAR(20),
		HeightViewBorderWidth INT(20),
		HeightViewBorderRadius INT(20),
		HeightViewBorderColor VARCHAR(20),
		HeightViewBorderOpacity VARCHAR(20),
		HeightViewSpaceWidth INT(20),
		HeightViewSpaceHeight INT(20),
		RowViewBorderWidth INT(20),
		RowViewBorderRadius INT(20),
		RowViewBorderColor VARCHAR(20),
		RowViewBorderOpacity VARCHAR(20),
		RowViewSpaceWidth INT(20),
		RowViewSpaceHeight INT(20),
		TitlePositionGallery TINYINT,
		RatingPositionGallery TINYINT,
		CommentPositionGallery TINYINT,
		ActivateGalleryBackgroundColor TINYINT,
		GalleryBackgroundColor VARCHAR(20),
		GalleryBackgroundOpacity VARCHAR(20)
		) DEFAULT CHARACTER SET utf8";		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);	
		
		
				// Options Visual erschaffen und Werte einfügen falls nicht vorhanden ist
				// Muss bei allen Updates angewendet werden
				$selectIDs = $wpdb->get_results( "SELECT id FROM $tablename_options" );		
				
				$collectIDs = array();
				
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
								ThumbViewBorderWidth,ThumbViewBorderRadius,ThumbViewBorderColor,ThumbViewBorderOpacity,HeightViewBorderWidth,HeightViewBorderRadius,HeightViewBorderColor,HeightViewBorderOpacity,HeightViewSpaceWidth,HeightViewSpaceHeight,
								RowViewBorderWidth,RowViewBorderRadius,RowViewBorderColor,RowViewBorderOpacity,RowViewSpaceWidth,RowViewSpaceHeight,TitlePositionGallery,RatingPositionGallery,CommentPositionGallery,
								ActivateGalleryBackgroundColor,GalleryBackgroundColor,GalleryBackgroundOpacity)
								VALUES ( %s,%d,%s,%s,
								%s,%s,%s,%s,%s,%s,
								%d,%d,%s,%d,%d,%d,%s,%d,%d,%d,
								%d,%d,%s,%d,%d,%d,%d,%d,%d,%d,%s,%d)
							", 
								'',$nextIDgallery,'left','left',
								'','left','','left','','left',
								0,0,'#ffffff',1,0,0,'#ffffff',1,0,0,
								0,0,'#ffffff',1,0,0,1,1,1,0,'#ffffff',1
					 ) );
				
				}


			
		}
		
		//if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_options_visual) == $tablename_options_visual){}
		
		
		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_options_input'") != $tablename_options_input){
		$sql = "CREATE TABLE $tablename_options_input(
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryID INT(99),
		Forward TINYINT,
		Forward_URL VARCHAR(999),
		Confirmation_Text VARCHAR(65535)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			
		}
		
				
		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_entries'") != $tablename_entries){
		$sql = "CREATE TABLE $tablename_entries (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		pid INT(99),
		f_input_id INT (99),
		GalleryID INT(99),
		Field_Type VARCHAR(10),
		Field_Order INT(3),
		Short_Text VARCHAR(999),
		Long_Text VARCHAR(65535)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);			
		}
		
		
		
		// Update ab Pro Version ab Juni 2016
		
		if(file_exists(plugin_dir_path( __FILE__ )."admin/users/create-user-form.php")){
			
			if($wpdb->get_var("SHOW TABLES LIKE '$tablename_create_activation'") != $tablename_create_activation){
			$sql = "CREATE TABLE $tablename_create_activation (
			id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			user_id_wp INT(9),
			user_login VARCHAR(200),
			user_pass VARCHAR(255),
			user_email VARCHAR(200),
			registered VARCHAR(20),
			activated VARCHAR(20),
			active TINYINT,
			activation_key VARCHAR(200)
			) DEFAULT CHARACTER SET utf8";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);			
			}
			
			
		
			if($wpdb->get_var("SHOW TABLES LIKE '$tablename_create_user_entries'") != $tablename_create_user_entries){
			$sql = "CREATE TABLE $tablename_create_user_entries (
			id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			GalleryID INT(99),
			activation_id INT(99),
			wp_user_id INT(99),
			f_input_id INT (99),
			Field_Type VARCHAR(100),
			Field_Order INT(3),
			Field_Name VARCHAR(200),
			Field_Content VARCHAR(65535),
			Option1 VARCHAR(200),
			Option2 VARCHAR(200),
			Option3 VARCHAR(200),
			Option4 VARCHAR(200),
			Option5 VARCHAR(200),
			Option6 VARCHAR(200),
			Option7 VARCHAR(200),
			Option8 VARCHAR(200),
			Option9 VARCHAR(200),
			Option10 VARCHAR(200)
			) DEFAULT CHARACTER SET utf8";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);			
			}
				
				
			if($wpdb->get_var("SHOW TABLES LIKE '$tablename_create_user_form'") != $tablename_create_user_form){
			$sql = "CREATE TABLE $tablename_create_user_form (
			id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			GalleryID INT(99),
			Field_Type VARCHAR(100),
			Field_Order INT(3),
			Show_Slider TINYINT,
			Use_as_URL TINYINT,
			Field_Name VARCHAR(200),
			Field_Content VARCHAR(65535),
			Min_Char VARCHAR(200),
			Max_Char VARCHAR(200),
			Necessary TINYINT,
			Option1 VARCHAR(200),
			Option2 VARCHAR(200),
			Option3 VARCHAR(200),
			Option4 VARCHAR(200),
			Option5 VARCHAR(200),
			Option6 VARCHAR(200),
			Option7 VARCHAR(200),
			Option8 VARCHAR(200),
			Option9 VARCHAR(200),
			Option10 VARCHAR(200)
			) DEFAULT CHARACTER SET utf8";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			
			// Anlegen der absolut notwendigen User Form Feldern (Username, E-Mail, Password und Confirm Password)
			
							// Options Visual erschaffen und Werte einfügen falls nicht vorhanden ist
					// Muss bei allen Updates angewendet werden
					$selectIDs = $wpdb->get_results( "SELECT id FROM $tablename_options" );	
			
					$collectIDs = array();
					
					foreach ($selectIDs as $key => $value) {		
						
							foreach ($value as $key => $value1) {
								$collectIDs[]= $value1;
							}	
					}
		
					foreach ($collectIDs as $key => $value) {
						
						$wpdb->query( $wpdb->prepare(
						"
							INSERT INTO $tablename_create_user_form
							( id, GalleryID, Field_Type, Field_Order,
							Show_Slider,Use_as_URL,Field_Name,Field_Content,Min_Char,Max_Char,
							Necessary,Option1,Option2,Option3,Option4,Option5,Option6,
							Option7,Option8,Option9,Option10)
							VALUES ( %s,%d,%s,%s,
							%d,%d,%s,%s,%d,%d,
							%d,%s,%s,%s,%s,%s,%s,
							%s,%s,%s,%s)
						", 
							'',$value,'main-user-name','1',
							0,0,'Username','',3,100,
							1,'','','','','','',
							'','','',''
						) );
						
						$wpdb->query( $wpdb->prepare(
						"
							INSERT INTO $tablename_create_user_form
							( id, GalleryID, Field_Type, Field_Order,
							Show_Slider,Use_as_URL,Field_Name,Field_Content,Min_Char,Max_Char,
							Necessary,Option1,Option2,Option3,Option4,Option5,Option6,
							Option7,Option8,Option9,Option10)
							VALUES ( %s,%d,%s,%s,
							%d,%d,%s,%s,%d,%d,
							%d,%s,%s,%s,%s,%s,%s,
							%s,%s,%s,%s)
						", 
							'',$value,'main-mail','2',
							0,0,'E-mail','','','',
							1,'','','','','','',
							'','','',''
						) );
						
						$wpdb->query( $wpdb->prepare(
						"
							INSERT INTO $tablename_create_user_form
							( id, GalleryID, Field_Type, Field_Order,
							Show_Slider,Use_as_URL,Field_Name,Field_Content,Min_Char,Max_Char,
							Necessary,Option1,Option2,Option3,Option4,Option5,Option6,
							Option7,Option8,Option9,Option10)
							VALUES ( %s,%d,%s,%s,
							%d,%d,%s,%s,%d,%d,
							%d,%s,%s,%s,%s,%s,%s,
							%s,%s,%s,%s)
						", 
							'',$value,'password','3',
							0,0,'Password','',6,100,
							1,'','','','','','',
							'','','',''
						) );
						
						$wpdb->query( $wpdb->prepare(
						"
							INSERT INTO $tablename_create_user_form
							( id, GalleryID, Field_Type, Field_Order,
							Show_Slider,Use_as_URL,Field_Name,Field_Content,Min_Char,Max_Char,
							Necessary,Option1,Option2,Option3,Option4,Option5,Option6,
							Option7,Option8,Option9,Option10)
							VALUES ( %s,%d,%s,%s,
							%d,%d,%s,%s,%d,%d,
							%d,%s,%s,%s,%s,%s,%s,
							%s,%s,%s,%s)
						", 
							'',$value,'password-confirm','4',
							0,0,'Confirm Password','',6,100,
							1,'','','','','','',
							'','','',''
						) );
						
						
						

					
					}
				
			// Anlegen der absolut notwendigen User Form Feldern (Username, E-Mail, Password und Confirm Password) --- ENDE	
				
			}
		
		}
		
		// Update ab Pro Version ab Juni 2016 --- ENDE
		
		
		
		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_form_input'") != $tablename_form_input){
		$sql = "CREATE TABLE $tablename_form_input (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryID INT(99),
		Field_Type VARCHAR(10),
		Field_Order INT(3),
		Field_Content VARCHAR(65535),
		Show_Slider TINYINT,
		Use_as_URL TINYINT
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
				
		
		if($wpdb->get_var("SHOW TABLES LIKE '$tablename_form_output'") != $tablename_form_output){
		$sql = "CREATE TABLE $tablename_form_output (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		f_input_id INT (99),
		GalleryID INT(99),
		Field_Type VARCHAR(10),
		Field_Order INT(3),
		Field_Content VARCHAR(65535)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		

		//ADD first first Galery
		
$uploads = wp_upload_dir();
$checkUploads = $uploads['basedir'].'/contest-gallery';

	if(!file_exists($checkUploads)){
	mkdir($checkUploads,0777,true);
	}
	
	
// Update Tables if already created	
	
	
$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'HideUntilVote'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD HideUntilVote TINYINT NULL");
}

	$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ActivateUpload'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ActivateUpload TINYINT NULL");
}

	$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ContestEnd'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ContestEnd TINYINT NULL");
}

	$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ContestEndTime'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ContestEndTime VARCHAR(100) NULL");
}
// (Show always vote, comments and info in gallery view)
	$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ShowAlways'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ShowAlways TINYINT NULL AFTER AllowRating");
}


$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'CheckLogin'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD CheckLogin TINYINT NULL AFTER IpBlock");
}


$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'ThumbViewBorderOpacity'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD ThumbViewBorderOpacity VARCHAR(20) NULL DEFAULT 1 AFTER ThumbViewBorderColor");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'HeightViewBorderOpacity'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD HeightViewBorderOpacity VARCHAR(20) NULL DEFAULT 1 AFTER HeightViewBorderColor");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'RowViewBorderOpacity'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD RowViewBorderOpacity VARCHAR(20) NULL DEFAULT 1 AFTER RowViewBorderColor");
}

// Update ab 01.01.2016

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'CommentsOutGallery'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD CommentsOutGallery TINYINT NULL AFTER AllowComments");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'RatingOutGallery'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD RatingOutGallery TINYINT NULL AFTER AllowRating");
}

// Textinformationen vom User diese zu entsprechender Feld ID gehören, sollen im Slider gezeigt werden
$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_form_input' AND column_name = 'Show_Slider'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_form_input ADD Show_Slider TINYINT NULL AFTER Field_Content");
}


// Update ab 05.02.2016 (Image URL Forwarding wurde eingebaut)

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_form_input' AND column_name = 'Use_as_URL'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_form_input ADD Use_as_URL TINYINT NULL AFTER Show_Slider");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ForwardToURL'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ForwardToURL TINYINT NULL DEFAULT 1 AFTER ContestEndTime ");
}


// 1 ist vom Slider 2 ist out of gallery
$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ForwardFrom'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ForwardFrom TINYINT NULL DEFAULT 1 AFTER ForwardToURL");
}

// 1 ist normal 2 ist _blank
$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ForwardType'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ForwardType TINYINT NULL AFTER ForwardToURL");
}


// Update ab 27.02.2016 (Restrict width und height resolution wurde eingebaut)


// JPG
$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'MaxResJPGwidth'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD  MaxResJPGwidth INT(20) DEFAULT '800' AFTER MaxResJPG");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'MaxResJPGheight'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD  MaxResJPGheight INT(20) DEFAULT '600' AFTER MaxResJPGwidth");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'MaxResJPGwidth'"  );

// PNG

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'MaxResPNGwidth'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD  MaxResPNGwidth INT(20) DEFAULT '800' AFTER MaxResPNG");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'MaxResPNGheight'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD  MaxResPNGheight INT(20) DEFAULT '600' AFTER MaxResPNGwidth");
}


// GIF

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'MaxResGIFwidth'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD  MaxResGIFwidth INT(20) DEFAULT '800' AFTER MaxResGIF");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'MaxResGIFheight'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD  MaxResGIFheight INT(20) DEFAULT '600' AFTER MaxResGIFwidth");
}

// Update ab 05.03.2016 ActivatePostMaxMB und PostMaxMB


$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ActivatePostMaxMB'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ActivatePostMaxMB TINYINT NULL AFTER ForwardType");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'PostMaxMB'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD PostMaxMB INT(20) DEFAULT '2' AFTER ActivatePostMaxMB");
}

// Update ab 05.03.2016 ActivatePostMaxMB und PostMaxMB

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ActivateBulkUpload'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ActivateBulkUpload TINYINT NULL AFTER ActivatePostMaxMB");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'BulkUploadQuantity'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD BulkUploadQuantity INT(20) DEFAULT '3' AFTER ActivateBulkUpload");
}

// Update ab 13.03.2016 IformAdmin

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'InformAdmin'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD InformAdmin TINYINT NULL AFTER Inform");
}

// Update ab 23.04.2016 BulkUploadMinQuantity und ShowAlwaysInfoSlider

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'BulkUploadMinQuantity'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD BulkUploadMinQuantity TINYINT NULL AFTER BulkUploadQuantity");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'ShowAlwaysInfoSlider'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD ShowAlwaysInfoSlider TINYINT NULL AFTER ShowAlways");
}

// Update ab 26.04.2016 FullSizeImageOutGallery und FullSizeImageOutGalleryNewTab

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'FullSizeImageOutGallery'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD FullSizeImageOutGallery TINYINT NULL AFTER AllowGalleryScript");
}


$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'FullSizeImageOutGalleryNewTab'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD FullSizeImageOutGalleryNewTab TINYINT NULL AFTER FullSizeImageOutGallery");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'SinglePicView'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD SinglePicView TINYINT NULL AFTER MaxResGIFheight");
}

$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'OnlyGalleryView'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD OnlyGalleryView TINYINT NULL AFTER MaxResGIFheight");
}


// Update ab 26.05.2016 InfiniteScroll

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'InfiniteScroll'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD InfiniteScroll TINYINT NULL AFTER AllowGalleryScript");
}

// Update ab 11.06.2016 One vote rating

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename' AND column_name = 'CountS'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename ADD CountS VARCHAR(7) NULL AFTER CountR");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_ip' AND column_name = 'RatingS'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_ip ADD RatingS INT(1) NULL AFTER Rating");
}


// Update ab 26.03.2016 Facebook Like in Gallery

// Spalte configuriert ob Facebook Like auch in der Galerie gezeigt werden soll
$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'FbLikeGallery'"  );

if(empty($row)){
	
	$wpdb->query("ALTER TABLE $tablename_options ADD FbLikeGallery TINYINT NULL AFTER FbLike");
	
		
		
   
				// Alle Gallery IDs auswählen um entsprechende Ordner auswählen zu können
			
				$getAllOptionIDs = $wpdb->get_results( "SELECT id FROM $tablename_options");
			
				foreach($getAllOptionIDs as $optionID){
					
						$GalleryID = $optionID->id;
   
						// Alle Bilder die Aktiv sind sollen für den Facebook button eine eigene HTML erhalten			
						$picsSQL = $wpdb->get_results( "SELECT Timestamp, NamePic FROM $tablename WHERE GalleryID = '$GalleryID' ORDER BY rowid DESC");		
								
										// Größe der Bilder bei ThumbAnsicht (gewöhnliche Ansicht mit Bewertung)
						$uploadFolder = wp_upload_dir();
						$urlSource = site_url();							
						$blog_title = get_bloginfo(); 			

								
						foreach($picsSQL as $value12){
						
							
								//$id = $value12->id;
								//$rowid = $value12->rowid;
								$Timestamp = $value12->Timestamp;
								$NamePic = $value12->NamePic;
								$ImgType = $value12->ImgType;
								//$rating = $value12->Rating;
								//$countR = $value12->CountR;
								//$countC = $value12->CountC;

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
   
}

// Spalte configuriert ob Facebook Like in der Galerie gezeigt werden soll und man in der Gallerie auch voten kann
$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'FbLikeGalleryVote'"  );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD FbLikeGalleryVote TINYINT NULL AFTER FbLikeGallery");
}


// Update ab 13.08.2016 RandomSort + Viele viuselle Verbesserungen


$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'RandomSort'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD RandomSort TINYINT NULL AFTER AllowSort");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'AdjustThumbLook'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD AdjustThumbLook TINYINT NULL AFTER ThumbLook");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'ThumbViewBorderRadius'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD ThumbViewBorderRadius INT(20) NULL AFTER ThumbViewBorderWidth");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'HeightViewBorderRadius'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD HeightViewBorderRadius INT(20) NULL AFTER HeightViewBorderWidth");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'HeightViewSpaceHeight'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD HeightViewSpaceHeight INT(20) NULL AFTER HeightViewSpaceWidth");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'RowViewBorderRadius" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD RowViewBorderRadius INT(20) NULL AFTER RowViewBorderWidth");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'RowViewSpaceHeight" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD RowViewSpaceHeight INT(20) NULL AFTER RowViewSpaceWidth");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'TitlePositionGallery" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD TitlePositionGallery TINYINT DEFAULT '1' AFTER RowViewSpaceHeight");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'RatingPositionGallery" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD RatingPositionGallery TINYINT DEFAULT '1' AFTER TitlePositionGallery");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'CommentPositionGallery" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD CommentPositionGallery TINYINT DEFAULT '1' AFTER RatingPositionGallery");
}

// Update ab 13.08.2016 Background Color + Votes per User

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options' AND column_name = 'VotesPerUser'" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options ADD VotesPerUser INT(5) NULL AFTER AllowRating");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'ActivateGalleryBackgroundColor" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD ActivateGalleryBackgroundColor TINYINT NULL AFTER CommentPositionGallery");
}


$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'GalleryBackgroundColor" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD GalleryBackgroundColor VARCHAR(20) DEFAULT '#ffffff' AFTER ActivateGalleryBackgroundColor");
}

$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename_options_visual' AND column_name = 'GalleryBackgroundOpacity" );

if(empty($row)){

   $wpdb->query("ALTER TABLE $tablename_options_visual ADD GalleryBackgroundOpacity VARCHAR(20) DEFAULT 1 AFTER GalleryBackgroundColor");
}


$p_cgal1ery_db_installed_ver = get_option( "p_cgal1ery_db_version" );
$p_cgal1ery_db_installed_ver = floatval($p_cgal1ery_db_installed_ver);

if($p_cgal1ery_db_installed_ver<4.10){
	
	$wpdb->query("ALTER TABLE $tablename MODIFY COLUMN CountC INT(7)");
	$wpdb->query("ALTER TABLE $tablename MODIFY COLUMN CountR INT(7)");
	$wpdb->query("ALTER TABLE $tablename MODIFY COLUMN CountS INT(7)");
	$wpdb->query("ALTER TABLE $tablename MODIFY COLUMN Rating INT(13)");
}



// Update Tables if already created --- END





// Update jquery files
		
		//$arrowPngLeft = plugins_url( 'css/arrow_left.png', __FILE__ );
		
		/*
		$js_cg_version = '410';
		
		$dir = plugin_dir_path( __FILE__ );
		
		$getAllJsFiles = $dir."js/*.js";
		// echo "<br>deleteCachedSiteFiles: $deleteCachedSiteFiles<br>";
		
		$getAllJsFiles = glob($getAllJsFiles); // get all file names
		foreach($getAllJsFiles as $oldFile){ // iterate files
		
		$newFileName = substr($oldFile, 0, -6).$js_cg_version.".js";
		
		rename($oldFile, $newFileName); 
		
		
		//if(is_file($file1))
		//unlink($file1); // delete file
	
		}*/


// Update jquery files --- END


		
}
}

register_activation_hook( __FILE__, 'contest_gal1ery_create_table' );


// Update DB


	
function contest_gal1ery_db_check() {
	
	global $p_cgal1ery_db_new_version;
$p_cgal1ery_db_new_version = '4.11';


@$p_cgal1ery_db_installed_ver = get_option( "p_cgal1ery_db_version" );
//echo $p_cgal1ery_db_new_version;
//echo "<br>";
//echo $p_cgal1ery_db_installed_ver;

//if ( @$p_cgal1ery_db_installed_ver != @$p_cgal1ery_db_new_version ) {
if ( @$p_cgal1ery_db_installed_ver != @$p_cgal1ery_db_new_version ) {
	
		if(function_exists('contest_gal1ery_create_table')){
			contest_gal1ery_create_table();
		}
		
		if($p_cgal1ery_db_installed_ver){update_option( "p_cgal1ery_db_version", $p_cgal1ery_db_new_version );}
		
		else{add_option( "p_cgal1ery_db_version", $p_cgal1ery_db_new_version );}
	
	}	
	
}
	add_action( 'plugins_loaded', 'contest_gal1ery_db_check' );
	
// Update DB - END	










// Add a top level menu to wordpress

// page_title â€” The title of the page as shown in the <title> tags
// menu_title â€” The name of your menu displayed on the dashboard
// capability â€” Minimum capability required to view the menu
// menu_slug â€” Slug name to refer to the menu; should be a unique name
// function : Function to be called to display the page content for the item
// icon_url â€” URL to a custom image to use as the Menu icon
// position â€” Location in the menu order where it should appear

//create submenu items

// parent_slug : Slug name for the parent menu ( menu_slug previously defi ned)
// page_title : The title of the page as shown in the <title> tags
// menu_title : The name of your submenu displayed on the dashboard
// capability : Minimum capability required to view the submenu
// menu_slug : Slug name to refer to the submenu; should be a unique name
// function : Function to be called to display the page content for the item


/*

add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts1' );
if(!function_exists('ajax_test_enqueue_scripts1')){
function ajax_test_enqueue_scripts1() {
	if( is_single() ) {
		wp_enqueue_style( 'love1', plugins_url( '/love1.css', __FILE__ ) );
	}

	wp_enqueue_script( 'cg_rate', plugins_url( '/cg_rate2.js', __FILE__ ), array('jquery'), '1.0', true );

	wp_localize_script( 'cg_rate', 'postlove1', array(
		'ajax_url1' => admin_url( 'admin-ajax.php' )
	));

}
}*/

// Register CSS

add_action( 'wp_enqueue_scripts', 'cg_frontend_style' );	

function cg_frontend_style() {
       /* Register our stylesheet. */
       wp_enqueue_style( 'cg_frontend_style', plugins_url('/frontend/cg_frontend_style.css', __FILE__) );
   }
   
   add_action( 'wp_enqueue_scripts', 'cg_frontend_singe_image_style' );	

function cg_frontend_singe_image_style() {
       /* Register our stylesheet. */
       wp_enqueue_style( 'cg_frontend_singe_image_style', plugins_url('/css/cg_frontend_singe_image_style.css', __FILE__) );
   }
   
   add_action( 'admin_enqueue_scripts', 'cg_options_tabcontent' );	

function cg_options_tabcontent() {
       /* Register our stylesheet. */
       wp_enqueue_style( 'cg_options_tabcontent', plugins_url('/admin/options/cg_options_tabcontent.css', __FILE__) );
   }
   

   




// AJAX Script für rate picture 

add_action( 'wp_enqueue_scripts', 'cg_rate_ajax_enqueue_scripts' );
function cg_rate_ajax_enqueue_scripts() {
	/*if( is_single() ) {
		wp_enqueue_style( 'love', plugins_url( '/js/love.css', __FILE__ ) );
	}*/
	
	$js_cg_version = '410';

	wp_enqueue_script( 'cg_rate', plugins_url( '/js/cg_rate'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );

	wp_localize_script( 'cg_rate', 'post_cg_rate_wordpress_ajax_script_function_name', array(
		'cg_rate_ajax_url' => admin_url( 'admin-ajax.php' )
	));

}


add_action( 'wp_ajax_nopriv_post_cg_rate', 'post_cg_rate' );
add_action( 'wp_ajax_post_cg_rate', 'post_cg_rate' );

function post_cg_rate() {
	
	
	global $wpdb;

$ip = $_SERVER['REMOTE_ADDR'];


	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

		require_once('frontend/rate-picture.php');

		die();
	}
	else {

		exit();
	}
}


// AJAX Script für rate picture ---- ENDE


// AJAX Script für set comment

add_action( 'wp_enqueue_scripts', 'cg_comment_ajax_enqueue_scripts' );
function cg_comment_ajax_enqueue_scripts() {
	/*if( is_single() ) {
		wp_enqueue_style( 'love', plugins_url( '/js/love.css', __FILE__ ) );
	}*/
	
	$js_cg_version = '410';

	wp_enqueue_script( 'cg_comment', plugins_url( '/js/cg_comment'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );

	wp_localize_script( 'cg_comment', 'post_cg_comment_wordpress_ajax_script_function_name', array(
		'cg_comment_ajax_url' => admin_url( 'admin-ajax.php' )
	));

}


add_action( 'wp_ajax_nopriv_post_cg_comment', 'post_cg_comment' );
add_action( 'wp_ajax_post_cg_comment', 'post_cg_comment' );

function post_cg_comment() {
	
	
	global $wpdb;


	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	
		require_once('frontend/set-comment.php');
		die();
	}
	else {

		exit();
	}
}


// AJAX Script für set comment ---- ENDE


// AJAX Script für set comment Slider

add_action( 'wp_enqueue_scripts', 'cg_set_comment_slider_ajax_enqueue_scripts' );
function cg_set_comment_slider_ajax_enqueue_scripts() {
	/*if( is_single() ) {
		wp_enqueue_style( 'love', plugins_url( '/js/love.css', __FILE__ ) );
	}*/
	
	$js_cg_version = '410';

	wp_enqueue_script( 'cg_set_comment_slider', plugins_url( '/js/cg_set_comment_slider'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );

	wp_localize_script( 'cg_set_comment_slider', 'post_cg_set_comment_slider_wordpress_ajax_script_function_name', array(
		'cg_set_comment_slider_ajax_url' => admin_url( 'admin-ajax.php' )
	));

}


add_action( 'wp_ajax_nopriv_post_cg_set_comment_slider', 'post_cg_set_comment_slider' );
add_action( 'wp_ajax_post_cg_set_comment_slider', 'post_cg_set_comment_slider' );

function post_cg_set_comment_slider() {
	
	
	global $wpdb;


	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	
		require_once('frontend/set-comment-slider.php');
		die();
	}
	else {

		exit();
	}
}


// AJAX Script für set comment Slider ---- ENDE



// AJAX Script für show comments slider

add_action( 'wp_enqueue_scripts', 'cg_show_comments_slider_ajax_enqueue_scripts' );
function cg_show_comments_slider_ajax_enqueue_scripts() {
	/*if( is_single() ) {
		wp_enqueue_style( 'love', plugins_url( '/js/love.css', __FILE__ ) );
	}*/
	
	$js_cg_version = '410';

	wp_enqueue_script( 'cg_show_comments_slider', plugins_url( '/js/cg_show_comments_slider'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );

	wp_localize_script( 'cg_show_comments_slider', 'post_cg_show_comments_slider_wordpress_ajax_script_function_name', array(
		'cg_show_comments_slider_ajax_url' => admin_url( 'admin-ajax.php' )
	));

}


add_action( 'wp_ajax_nopriv_post_cg_show_comments_slider', 'post_cg_show_comments_slider' );
add_action( 'wp_ajax_post_cg_show_comments_slider', 'post_cg_show_comments_slider' );

function post_cg_show_comments_slider() {
	
	
	global $wpdb;


	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	
		require_once('frontend/show-comments-slider.php');
		die();
	}
	else {

		exit();
	}
}


// AJAX Script für show comments slider


// localize Scripts


// localize Scripts --- ENDE


add_action('admin_menu', 'contest_gallery_add_page');
if(!function_exists('contest_gallery_add_page')){
	function contest_gallery_add_page() {
		add_menu_page( 'Contest-Gallery uploads', 'Contest Gallery', 'manage_options', __FILE__, 'contest_gallery_action', plugins_url('css/star_48_reduced.png', __FILE__ ));
	}
}



/*function boj_myplugin_add_page() {
	add_options_page( 'My Plugin', 'My Plugin', 'manage_options', 'boj_myplugin', 'boj_myplugin_option_page' );
}*/ 


//CSS Frontend file

if(!function_exists('my_scripts')){
function my_scripts() {
//wp_enqueue_script( 'jquery' );

$js_cg_version = '410';


wp_register_style( 'contest-style', plugins_url('css/style'.$js_cg_version.'.css', __FILE__) );
wp_enqueue_style( 'contest-style',  plugins_url('css/style'.$js_cg_version.'.css', __FILE__) );
wp_register_style( 'cg_color_picker_css', plugins_url('js/color-picker/jquery.minicolors.css', __FILE__) );
wp_enqueue_style( 'cg_color_picker_css',  plugins_url('js/color-picker/jquery.minicolors.css', __FILE__) );
}
}

add_action('wp_enqueue_scripts','my_scripts');

add_action('admin_enqueue_scripts','my_scripts');

/*
  add_action( 'admin_enqueue_scripts', 'cg_color_picker_css' );	
   
function cg_color_picker_css() {
       // Register our stylesheet. 
       wp_enqueue_style( 'cg_color_picker_css', plugins_url('/js/color-picker/jquery.minicolors.css', __FILE__) );
   }*/



//CSS Frontend file --- END


// Add editor 


/*function editor_admin_init() {

  wp_enqueue_script('word-count');

  wp_enqueue_script('post');


  wp_enqueue_script('media-upload'); 

}

function editor_admin_head() {

  wp_tiny_mce();
  
  }
  
add_action('admin_init', 'editor_admin_init');

add_action('admin_head', 'editor_admin_head');  */

// Add editor style

//add_editor_style(plugins_url('css/style.css', __FILE__));


// Add editor END





//------------------------------------------------------------
// ----------------------------------------------------------- Pro Version Abschnitt ----------------------------------------------------------

if(file_exists(plugin_dir_path( __FILE__ )."admin/users/create-user-form.php")){
add_shortcode( 'cg_users_registry', 'users_registry' );


function users_registry($atts){
	
// Aktuelle Javascript Version
$js_cg_version = '410';

wp_enqueue_script( 'users_registry', plugins_url( '/admin/users/users_registry'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
//wp_enqueue_script( 'show_jquery_language', plugins_url( '/js/show_jquery_language'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
ob_start();
include_once 'admin/users/users-registry.php';
$users_registry = ob_get_clean();
return $users_registry;

}

add_action('wp_ajax_nopriv_cg_user_registry_input','cg_user_registry_input');
add_action('wp_ajax_cg_user_registry_input','cg_user_registry_input');

		function cg_user_registry_input(){
			
			global $wpdb;

			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			
				require_once(__DIR__.'/admin/users/cg-user-registry-send.php');
				die();
				
			}
			else {

				exit();
			}
		
		}

}
// ----------------------------------------------------------- Pro Version Abschnitt ----------------------ENDE


//------------------------------------------------------------
// ----------------------------------------------------------- Hauptseite fÃ¼r hochgeladene Bilder ----------------------------------------------------------
//------------------------------------------------------------

if(!function_exists('contest_gallery_action')){
function contest_gallery_action() {
	
		// Aktuelle Javascript Version
	$js_cg_version = '410';

//$path = dirname(__FILE__) . "/admin/gallery/license.txt";

//$fh = fopen($path, 'r');
//$contents = fread($fh,filesize($path));
//echo "<br><br><b>You are using a $contents</b><br><br>";
//fclose($fh);	
//------------------------------------------------------------
// ----------------------------------------------------------- Edit CSS file ----------------------------------------------------------
//------------------------------------------------------------	
	
/*if (@$_GET['editCSSsend'] == true) {

require('admin/change-css.php');
require_once('admin/gallery/gallery.php');

exit('');
	
}		*/
		


if(@$_POST['changeSize']==true OR @$_GET['reset_ips'] == true OR @$_GET['reset_votes'] == true OR @$_GET['reset_votes2'] == true){

require_once('admin/options/change-options-and-sizes.php');

}


//------------------------------------------------------------
// ----------------------------------------------------------- Change options of gallery ---------------------------------------------------------- 
//------------------------------------------------------------	
	
if (@$_GET['edit_options'] == true OR @$_POST['edit_options']==true OR @$_POST['changeSize']==true OR @$_GET['reset_ips'] == true ) {
wp_enqueue_script( 'jquery.minicolors', plugins_url( '/js/color-picker/jquery.minicolors.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery.minicolors.min', plugins_url( '/js/color-picker/jquery.minicolors.min.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery_frontend_color_picker', plugins_url( '/js/color-picker/jquery_frontend_color_picker.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'edit_options', plugins_url( '/js/edit_options'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'cg_options_tabcontent_js', plugins_url( '/admin/options/cg_options_tabcontent.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-datepicker' );
wp_register_style( 'contest-style-css', plugins_url('admin/options/datepicker.css', __FILE__) );
wp_enqueue_style( 'contest-style-css', plugins_url('admin/options/datepicker.css', __FILE__) );
require_once('admin/options/edit-options.php');
	
}

//------------------------------------------------------------
// ----------------------------------------------------------- Create an Upload Form ----------------------------------------------------------
//------------------------------------------------------------	

	
if (@$_GET['define_upload'] == true) {
wp_enqueue_script( 'create_upload', plugins_url( '/js/create_upload'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery-ui-sortable' );
require_once('admin/upload/create-upload.php');
	
}

//------------------------------------------------------------
// ----------------------------------------------------------- Create an Upload Form ----------------------------------------------------------
//------------------------------------------------------------	

	
if (@$_GET['create_user_form'] == true) {

wp_enqueue_script( 'create_user_form', plugins_url( '/admin/users/create_user_form'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery-ui-sortable' );
require_once('admin/users/create-user-form.php');
}


//------------------------------------------------------------
// ----------------------------------------------------------- Define an output of a pic ----------------------------------------------------------
//------------------------------------------------------------	
	
if (@$_GET['define_output'] == true) {
wp_enqueue_script( 'define_output', plugins_url( '/js/define_output'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery-ui-sortable' );
require_once('admin/upload/define-output.php');
	
}			
		
		
		
//------------------------------------------------------------
// ----------------------------------------------------------- Change email text for informing users ----------------------------------------------------------
//------------------------------------------------------------	
	
if (@$_POST['inform_user'] == true OR @$_GET['inform_user'] == true) {
wp_enqueue_script( 'change_text_inform_user', plugins_url( '/js/change_text_inform_user'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
require_once('admin/email/change-text-inform-user.php');
	
}

	
//------------------------------------------------------------
// ----------------------------------------------------------- Neue Galerie lÃ¶schen ----------------------------------------------------------
//------------------------------------------------------------

if(@$_GET['option_id']==true AND @$_GET['delete']==true){

require_once('admin/delete-gallery.php');
require_once('admin/main-menu.php');

}		
	
//------------------------------------------------------------
// ----------------------------------------------------------- AuswahlmenÃ¼ zum Anzeigen und Erstellen von Galerien ----------------------------------------------------------
//------------------------------------------------------------		
	
if(@$_GET['option_id']==false and @$_POST['option_id']==false){
//require('css/style.php');

	if(@$_GET['object_test']==true){

	require_once('object-test.php');	

	}

	else{
	require_once('admin/main-menu.php');
	}
	
}


//------------------------------------------------------------
// ----------------------------------------------------------- User per Email informieren oder nicht informieren Ã¤ndern/ SPEICHERN ----------------------------------------------------------
//------------------------------------------------------------	
	
//if (@$_POST['submit'] == true AND @$_POST['informId'] == true) {

//require_once('admin/email/inform-user.php');
	
//}


//------------------------------------------------------------
// ----------------------------------------------------------- Upload several pics to a certain galery ----------------------------------------------------------
//------------------------------------------------------------

if(@$_GET['option_id']==true AND @$_POST['upload_pics']==true){

require_once('admin/gallery/upload-pics.php');

}

//------------------------------------------------------------
// ----------------------------------------------------------- Reset informed for all pictures ----------------------------------------------------------
//------------------------------------------------------------

if(@$_POST['reset_all']==true){

require_once('admin/gallery/reset_all.php');

}


//------------------------------------------------------------
// ----------------------------------------------------------- Edit certain galery ----------------------------------------------------------
//------------------------------------------------------------	
	
if (@$_GET['edit_gallery'] == true) {


		//------------------------------------------------------------
		// ----------------------------------------------------------- Hochgeladene Bilder anzeigen oder nicht anzeigen Ã¤ndern und Comments Ã¤ndern oder Informieren oder Informierte reseten SPEICHERN ----------------------------------------------------------
		//------------------------------------------------------------	
			
		if (@$_POST['submit'] == true AND @$_POST['changeGalery'] == true AND (@$_POST['chooseAction1'] == 1 OR @$_POST['chooseAction1'] == 3)) {
		wp_enqueue_script( 'gallery_admin', plugins_url( '/js/gallery_admin'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
		wp_enqueue_script( 'jquery-ui-sortable' );
		//echo "change";
		require_once('admin/gallery/change-gallery.php');
		require_once('admin/gallery/gallery.php');
			
		}
		
		//------------------------------------------------------------
		// ----------------------------------------------------------- Delete pics of certain galery ----------------------------------------------------------
		//------------------------------------------------------------	
			
		elseif (@$_POST['submit'] == true AND @$_POST['chooseAction1'] == 2) {
		wp_enqueue_script( 'gallery_admin', plugins_url( '/js/gallery_admin'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
		wp_enqueue_script( 'jquery-ui-sortable' );
		//echo "DELETE PICS!<br>";
		require_once('admin/gallery/delete-pics.php');
		require_once('admin/gallery/gallery.php');

		}
		
		//------------------------------------------------------------
		// ----------------------------------------------------------- Neue Galerie kreieren ----------------------------------------------------------
		//------------------------------------------------------------

		elseif(@$_GET['option_id']==true AND @$_GET['create']==true AND @$_GET['edit_gallery'] == true ){
		wp_enqueue_script( 'gallery_admin', plugins_url( '/js/gallery_admin'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
		wp_enqueue_script( 'jquery-ui-sortable' );
		require_once('admin/create-gallery.php');
		require_once('admin/gallery/gallery.php');

		}
				
		//------------------------------------------------------------
		// ----------------------------------------------------------- Edit certain galery ----------------------------------------------------------
		//------------------------------------------------------------	

		
		else{
		wp_enqueue_script( 'gallery_admin', plugins_url( '/js/gallery_admin'.$js_cg_version.'.js', __FILE__ ), array('jquery'), false, true );
		wp_enqueue_script( 'jquery-ui-sortable' );	
		require_once('admin/gallery/gallery.php');
		}		
		
		
		
}






//------------------------------------------------------------ 
// ----------------------------------------------------------- Kommentare anzeigen oder nicht anzeigen Ã¤ndern ----------------------------------------------------------
//------------------------------------------------------------	
	
 if (@$_POST['submitcomments'] == true) {

require_once('change-show-comments.php');

}	

//------------------------------------------------------------
// ----------------------------------------------------------- Kommentare eines einzelnen Bildes anzeigen ----------------------------------------------------------
//------------------------------------------------------------

if(@$_GET['show_comments']==true){

require_once('admin/gallery/show-comments.php');	

}



}
}
?>