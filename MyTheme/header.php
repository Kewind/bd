<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo("charset"); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('Homepage'); ?></title>
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>

	<div class="container">

	<!-- site header -->
	<header class ="site-header">
		<h1>
			<a href="<?php echo home_url(); ?>" style="text-decoration: none"><hightlight>Home</highlight></a>
			<?php
			if (is_user_logged_in() ) { ?>	
				<div style="float:right"><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout" style="text-decoration: none">Logout</a></div>
				<?php
			} else { ?>
				<div style="float:right"> <?php do_action( 'wordpress_social_login' ); ?> </div>
				<?php
			};
			?>	
			<br>
		</h1>
		
		<nav class="site-nav">
			
			<?php
			$args = array( 'theme_location' => 'primary' );
			?>
		
			<?php wp_nav_menu( $args ); ?>
		</nav>
	</header><!-- /site-header-->

