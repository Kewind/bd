<?php

get_header();
?>

<?php 

$current_user = wp_get_current_user();

echo "Hello ".$current_user->user_firstname."!";

?>

<br>

<?php

echo "Welcome to your own personal website.";

?>
		
<br>

<?php
get_footer();

?>