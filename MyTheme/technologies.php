<?php

/*
Template Name: Technologies
*/

get_header();
?>

<?php
If($_POST['Submit_technology']) {
	global $wpdb;
	$user_ID = get_current_user_id();
	
	$wpdb->insert( 
		'technologies', 
		array( 'user_id' => $user_ID, 'name' => $_POST["namee"],
			'experience' => $_POST["experience"], 'link' => $_POST["link"]),
		array( '%s', '%s', '%s', '%s')
	);
?>
<a href="http://students.mimuw.edu.pl/~kd346885/test/wordpress/technologies/" onClick="return false;" id="addform">Add Another Technologz.</a>
<?php
}
else // else we didn't submit the form, so display the form
{
?>
<form action="http://students.mimuw.edu.pl/~kd346885/test/wordpress/technologies/" method="post" id="addtechnology">
<label id="namee">Name: <input type="text" name="namee" size="30" /></label><br>
<label id="experience">Experience: <input type="text" name="experience" size="30" /></label><br>
<label id="link">Link: <input type="text" name="link" size="30" /></label><br>

<input type="submit" name="Submit_technology" id="addform" value="Submit_technology" />
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
	 <th>Experience</th>
	 <th>Link</th>
	</tr>
	  <?php
	    global $wpdb;
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.technologies where user_id=".$user_ID );
	    foreach ( $result as $print )   {
	    ?>
	    <tr>
	    <td><?php echo $print->name;?></td>
	    <td><?php echo $print->experience;?></td>
	    <td><?php echo $print->link;?></td>
	    </tr>
	    <?php }?>
	    </table>
<br>
		
<?php
get_footer();

?>