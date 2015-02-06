<?php

get_header();
?>

<?php 

/* SECTION : CREATE TABLE IF DOESN'T EXIST */

global $wpdb;
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$table_name = "activities";   
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	 $create_table_query = "CREATE TABLE `kd346885`.`activities` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `name` VARCHAR(65) NOT NULL,
				  `description` VARCHAR(65) NULL,
				  `grade` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `name`));";
	 dbDelta($create_table_query);
}

$table_name = "awards";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	$create_table_query = "CREATE TABLE `kd346885`.`awards` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `name` VARCHAR(65) NOT NULL,
				  `description` VARCHAR(65) NULL,
				  `date` VARCHAR(45) NULL,
				  `link` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `name`));";
	dbDelta($create_table_query);
}

$table_name = "current_education";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	$create_table_query = "CREATE TABLE `kd346885`.`current_education` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `name` VARCHAR(65) NOT NULL,
				  `course_id` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `name`));";
	dbDelta($create_table_query);
}

$table_name = "events";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	$create_table_query = "CREATE TABLE `kd346885`.`events` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `name` VARCHAR(65) NOT NULL,
				  `description` VARCHAR(65) NULL,
				  `from` VARCHAR(45) NULL,
				  `to` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `name`));";
	dbDelta($create_table_query);
}

$table_name = "internships";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	$create_table_query = "CREATE TABLE `kd346885`.`internships` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `company` VARCHAR(65) NOT NULL,
				  `from` VARCHAR(65) NULL,
				  `to` VARCHAR(45) NULL,
				  `role` VARCHAR(45) NULL,
				  `link` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `company`));";
	dbDelta($create_table_query);
}

$table_name = "portfolio";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	$create_table_query = "CREATE TABLE `kd346885`.`portfolio` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `project` VARCHAR(65) NOT NULL,
				  `description` VARCHAR(65) NULL,
				  `role` VARCHAR(45) NULL,
				  `link` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `project`));";
	dbDelta($create_table_query);
}

$table_name = "schedule";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	$create_table_query = "CREATE TABLE `kd346885`.`schedule` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `name` VARCHAR(65) NOT NULL,
				  `class_id` VARCHAR(65) NULL,
				  `start` VARCHAR(45) NULL,
				  `end` VARCHAR(45) NULL,
				  `type` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `class_id`));";
	dbDelta($create_table_query);
}

$table_name = "subjects";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	$create_table_query = "CREATE TABLE `kd346885`.`subjects` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `name` VARCHAR(65) NOT NULL,
				  `grade` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `name`));";
	dbDelta($create_table_query);
}

$table_name = "technologies";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	$create_table_query = "CREATE TABLE `kd346885`.`technologies` (
				  `user_id` VARCHAR(45) NOT NULL,
				  `name` VARCHAR(65) NOT NULL,
				  `experience` VARCHAR(65) NULL,
				  `link` VARCHAR(45) NULL,
				  PRIMARY KEY (`user_id`, `name`));";
	dbDelta($create_table_query);
}

/* WEB CONTENT */

if (is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	echo "Hello ".$current_user->user_firstname."!";
	?>
	<br>
	<?php
	echo "Welcome to your own personal website.";
} else {
	echo "Hello! Please log in using your USOS account to access all features.";
}
?>

<br>		
<br>

<?php
get_footer();

?>