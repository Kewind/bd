<?php

/*
Template Name: Current_studies
*/

get_header();
?>

<?php
If($_POST['Submit_activity']) {
	global $wpdb;
	$user_ID = get_current_user_id();
	
	$wpdb->insert( 
		'activities', 
		array( 'user_id' => $user_ID, 'name' => $_POST["namee"],
			'description' => $_POST["description"], 'grade' => $_POST["grade"]),
		array( '%s', '%s', '%s', '%s')
	);
?>
<a href="http://students.mimuw.edu.pl/~kd346885/test/wordpress/schedule/" onClick="return false;" id="addform">Add Another Event.</a>
<?php
}
else // else we didn't submit the form, so display the form
{	
?>
<form action="" method="post" id="addevent">
<label id="namee">Name: <input type="text" name="namee" size="30" /></label><br>
<label id="description">Description: <input type="text" name="description" size="30" /></label><br>
<label id="grade">Grade: <input type="text" name="grade" size="30" /></label><br>
<input type="submit" name="Submit_activity" id="addform" value="Submit_activity" />
</form>

<?php
} // end else no post['submit']
?>

<?php
	global $current_user;
	$user_id = get_current_user_id();
	$row_with_id = $wpdb->get_results ( "SELECT identifier FROM kd346885.wp_wslusersprofiles where user_id =".$user_id );
	$user_usos_id = $row_with_id[0]->identifier;
	?>
	<br>
	<h1>Your current classes</h1>
	<table border="1">
	<tr>
	 <th>Name</th>
	 <th>Description</th>
	</tr>
	  <?php
	    global $wpdb;
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.current_education where user_id=".$user_usos_id);
	    foreach ( $result as $print )   {
	    ?>
	    <tr>
	    <td><?php echo $print->name;?></td>
	    <td><?php echo $print->course_id;?></td>
	    </tr>
	    <?php }?>
	    <?php
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.activities where user_id=".$user_id );
	    foreach ( $result as $print )   {
	    ?>
	    <tr>
	    <td><?php echo $print->name;?></td>
	    <td><?php echo $print->description;?></td>
	    <?php }?>
	    </tr>
	    </table>
<br>	
		
<?php
get_footer();

?>