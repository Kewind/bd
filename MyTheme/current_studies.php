<?php

/*
Template Name: Current_studies
*/

get_header();
?>


<?php
	global $current_user;
	get_currentuserinfo();
	$user_ID = get_current_user_id();
	
	?>
	<br>
	<h1>Your current classes</h1>
	<table border="1">
	<tr>
	 <th>Name</th>
	 <th>Course_id</th>
	</tr>
	  <?php
	    global $wpdb;
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.current_education");
	    foreach ( $result as $print )   {
	    ?>
	    <tr>
	    <td><?php echo $print->name;?></td>
	    <td><?php echo $print->course_id;?></td>
	    </tr>
	    <?php }?>
	    </table>
<br>	
		
<?php
get_footer();

?>