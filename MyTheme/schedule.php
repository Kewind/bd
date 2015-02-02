<?php

/*
Template Name: Schedule
*/

get_header();
?>


<?php
If($_POST['Submit_event']) {
	global $wpdb;
	$user_ID = get_current_user_id();
	
	$wpdb->insert( 
		'events', 
		array( 'user_id' => $user_ID, 'name' => $_POST["namee"],
			'description' => $_POST["description"], 'from' => $_POST["from"], 'to' => $_POST["to"]),
		array( '%s', '%s', '%s', '%s', '%s')
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
<label id="from">From: <input type="text" name="from" size="30" /></label><br>
<label id="to">To: <input type="text" name="to" size="30" /></label><br>

<input type="submit" name="Submit_event" id="addform" value="Submit_event" />
</form>

<?php
} // end else no post['submit']
?>

<br>


<?php
	global $current_user;
	get_currentuserinfo();

?>
<br>
<h1>Your current schedule</h1>
<table border="1">
<tr>
	 <th>Class</th>
	 <th>Type</th>
	 <th>ID</th>
	 <th>Start time</th>
	 <th>End time</th>
</tr>
<?php
	global $wpdb;
	global $current_user;
	$user_id = get_current_user_id();
	$row_with_id = $wpdb->get_results ( "SELECT identifier FROM kd346885.wp_wslusersprofiles where user_id =".$user_id );
	$user_usos_id = $row_with_id[0]->identifier;
	$result = $wpdb->get_results ( "SELECT * FROM kd346885.schedule where user_id=".$user_usos_id." order by start" );
	foreach ( $result as $print )   {
	?>
	<tr>
	<td><?php echo $print->name;?></td>
	<td><?php echo $print->type;?></td>
	<td><?php echo $print->class_id;?></td>
	<td><?php echo $print->start;?></td>
	<td><?php echo $print->end;?></td>
	</tr>
	<?php }?>
	</table>
		
   
<br>

<?php
	global $current_user;
	get_currentuserinfo();
	$user_ID = get_current_user_id();
	
	?>
	<br>
	<h1>Your events</h1>
	<table border="1">
	<tr>
	 <th>Name</th>
	 <th>Description</th>
	 <th>Start time</th>
	 <th>End time</th>
	</tr>
	  <?php
	    global $wpdb;
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.events where user_id=".$user_ID );
	    foreach ( $result as $print )   {
	    ?>
		    <tr>
		    <td><?php echo $print->name;?></td>
		    <td><?php echo $print->description;?></td>
		    <td><?php echo $print->from;?></td>
		    <td><?php echo $print->to;?></td>
		    </tr>
    <?php }?>
    </table>
<br>
	
<?php
get_footer();

?>