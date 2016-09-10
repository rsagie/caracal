<?php

	echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='937px;'>";
	
	if(@$GalleryName){@$GalleryName="$GalleryName";}
	else {@$GalleryName="Contest Gallery";}
	
	echo "<tr><td align='center'><div style='width:180px;' ><br/>$GalleryName<br/><b>Shortcodes</b><br/><br/></div></td>";
	echo "<td align='center'><div style='width:180px;' ><br/>Gallery shortcode:<br/><strong>[cg_gallery id=\"$GalleryID\"]</strong><br/><br/></div></td>";
	echo "<td align='center'><div style='width:180px;' ><br/>Upload form shortcode: <strong>[cg_users_upload id=\"$GalleryID\"]</strong><br/><br/></div></td>";
	echo "<td align='center'><div style='width:180px;' >";

/*
echo <<<HEREDOC
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="29YDAVDLKPK6W">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
</form>


HEREDOC;*/
	
	echo "</div></td>"; 
	echo "</tr>";
	echo "</table>";
	
	echo "<br/>";

	echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='937px;'>";
	echo "<tr>";
	echo "<td align='center'><br/><div><form method='POST' action='?page=contest-gallery/index.php&option_id=$GalleryID&edit_gallery=true' ><input type='submit' value='&nbsp;<<< &nbsp;&nbsp;Back to gallery' style='text-align:left;width:180px;background:linear-gradient(0deg, #fef050 5%, #fcd729 70%);' /></form><br/></div></td>";
	echo "<td align='center'><br/><div><form method='POST' action='?page=contest-gallery/index.php&edit_options=true&option_id=$GalleryID' ><input type='submit' value='Edit options' style='text-align:center;width:180px;background:linear-gradient(0deg, #bbe0ef 5%, #90d4f0 70%);' /></form><br/></div></td>";
	echo "<td align='center'><br/><div><form method='POST' action='?page=contest-gallery/index.php&option_id=$GalleryID&define_upload=true'><input type='submit' value='Edit upload form' style='text-align:center;width:180px;background:linear-gradient(0deg, #bbe0ef 5%, #90d4f0 70%);' /></form><br/></div></td>"; 
	echo "<td align='center'><br/><div>";

	if(file_exists(plugin_dir_path( __FILE__ )."users/create-user-form.php")){
		
		echo "<form method='POST' action='?page=contest-gallery/index.php&create_user_form=true&option_id=$GalleryID'><input type='hidden' name='option_id' value='$GalleryID'><input type='submit' value='User registration form' style='text-align:center;width:180px;background:linear-gradient(0deg, #ffbe4e 5%, #ffac1c 70%);' /></form><br/>";
		
		}
    
	else{echo "<input type='hidden' name='option_id' value='$GalleryID'><input type='submit' value='Get pro version' style='text-align:center;width:180px;background:linear-gradient(0deg, #90d4f0 5%, #bbe0ef 70%);visibility:hidden;' />";}

	echo "</div></td>"; 
	
	echo "</tr>";
	
	echo "</table>";
		
	echo "<br/>";


?>