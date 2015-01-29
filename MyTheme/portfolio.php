<?php

/*
Template Name: Portfolio
*/

get_header();
?>

<?php
If($_POST['Submit_project']) {
	global $wpdb;
	$user_ID = get_current_user_id();
	
	$wpdb->insert( 
		'portfolio', 
		array( 'user_id' => $user_ID, 'project' => $_POST["project"],
			'description' => $_POST["description"], 'role' => $_POST["role"],
			'link' => $_POST["link"]),
		array( '%s', '%s', '%s', '%s', '%s')
	);
?>
<a href="http://students.mimuw.edu.pl/~kd346885/test/wordpress/portfolio/" onClick="return false;" id="addform">Add Another Project.</a>
<?php
}
else // else we didn't submit the form, so display the form
{
?>
<form action="" method="post" id="addproject">
<label id="project">Project: <input type="text" name="project" size="30" /></label><br>
<label id="description">Description: <input type="text" name="description" size="30" /></label><br>
<label id="role">Role: <input type="text" name="role" size="30" /></label><br>
<label id="link">Link: <input type="text" name="link" size="30" /></label><br>

<input type="submit" name="Submit_project" id="addform" value="Submit_project" />
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
	<br>
	<table border="1">
	<tr>
	 <th>Project</th>
	 <th>Description</th>
	 <th>Role</th>
	 <th>Link</th>
	</tr>
	  <?php
	    global $wpdb;
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.portfolio where user_id=".$user_ID);
	    foreach ( $result as $print )   {
	    ?>
	    <tr>
	    <td><?php echo $print->project;?></td>
	    <td><?php echo $print->description;?></td>
	    <td><?php echo $print->role;?></td>
	    <td><?php echo $print->link;?></td>
	    </tr>
	    <?php }?>
	    </table>
<br>
		
<?php
get_footer();

?>