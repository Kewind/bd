<?php

/*
Template Name: Subjects
*/

get_header();
?>


<?php
	global $current_user;
	get_currentuserinfo();
	
	?>
	<br>
	<h1>Your grades:</h1>
	<table border="1">
	<tr>
	 <th>Course</th>
	 <th>Grade</th>
	</tr>
	  <?php
	    global $wpdb;
	    $result = $wpdb->get_results ( "SELECT * FROM kd346885.subjects" );
	    foreach ( $result as $print )   {
	    ?>
	    <tr>
	    <td><?php echo $print->name;?></td>
	    <td><?php echo $print->grade;?></td>
	    </tr>
	    <?php }?>
	    </table>
	        
<br>

<?php
get_footer();

?>