<?php

/*
Template Name: Internships
*/

get_header();
?>

<?php
If($_POST['Submit_internship']) {
	global $wpdb;
	$user_ID = get_current_user_id();
	
	$wpdb->insert( 
		'internships', 
		array( 'user_id' => $user_ID, 'company' => $_POST["company"],
			'role' => $_POST["role"], 'from' => $_POST["from"], 'to' => $_POST["to"],
			'link' => $_POST["link"]),
		array( '%s', '%s', '%s', '%s', '%s', '%s')
	);
?>
<a href="" onClick="return false;" id="addform">Add Another Course.</a>
<?php
}
else // else we didn't submit the form, so display the form
{
?>
<form action="" method="post" id="addinternship">
<label id="company">Company: <input type="text" name="company" size="30" /></label><br>
<label id="role">Role: <input type="text" name="role" size="30" /></label><br>
<label id="from">From: <input type="text" name="from" size="30" /></label><br>
<label id="to">To: <input type="text" name="to" size="30" /></label><br>
<label id="link">Link: <input type="text" name="link" size="30" /></label><br>

<input type="submit" name="Submit_internship" id="addform" value="Submit_internship" />
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
	 <th>Company</th>
	 <th>Role</th>
	 <th>From</th>
	 <th>To</th>
	 <th>Link</th>
	</tr>
	  <?php
	    global $wpdb;
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.internships where user_id=".$user_ID );
	    foreach ( $result as $print )   {
	    ?>
	    <tr>
	    <td><?php echo $print->company;?></td>
	    <td><?php echo $print->role;?></td>
	    <td><?php echo $print->from;?></td>
	    <td><?php echo $print->to;?></td>
	    <td><?php echo $print->link;?></td>
	    </tr>
	    <?php }?>
	    </table>
<br>
<?php
get_footer();

?>