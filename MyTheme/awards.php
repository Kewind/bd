<?php

/*
Template Name: Awards
*/

get_header();
?>

<?php
If($_POST['Submit_award']) {
	global $wpdb;
	$user_ID = get_current_user_id();
	
	$wpdb->insert( 
		'awards', 
		array( 'user_id' => $user_ID, 'name' => $_POST["namee"],
			'description' => $_POST["description"], 'date' => $_POST["date"], 'link' => $_POST["link"]),
		array( '%s', '%s', '%s', '%s', '%s')
	);
?>
<a href="" onClick="return false;" id="addform">Add Another Award.</a>
<?php
}
else // else we didn't submit the form, so display the form
{
?>
<form action="" method="post" id="addaward">
<label id="namee">Name: <input type="text" name="namee" size="30" /></label><br>
<label id="description">Description: <input type="text" name="description" size="30" /></label><br>
<label id="date">Date: <input type="text" name="date" size="30" /></label><br>
<label id="link">Link: <input type="text" name="link" size="30" /></label><br>

<input type="submit" name="Submit_award" id="addform" value="Submit_award" />
</form>

<?php
} // end else no post['submit']
?>

<br>

<?php
	global $current_user;
	get_currentuserinfo();
	$user_ID = get_current_user_id();
	
	?>
	<table border="1">
	<tr>
	 <th>Name</th>
	 <th>Description</th>
	 <th>Date</th>
	 <th>Link</th>
	</tr>
	  <?php
	    global $wpdb;
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.awards where user_id=".$user_ID );
	    foreach ( $result as $print )   {
	    ?>
	    <tr>
	    <td><?php echo $print->name;?></td>
	    <td><?php echo $print->description;?></td>
	    <td><?php echo $print->date;?></td>
	    <td><?php echo $print->link;?></td>
	    </tr>
	    <?php }?>
	    </table>
<br>
<?php
get_footer();

?>