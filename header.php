<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_XYZ
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-xyz' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;
			$wp_xyz_description = get_bloginfo( 'description', 'display' );
			if ( $wp_xyz_description || is_customize_preview() ) : ?>
			<p class="site-description screen-reader-text"><?php echo $wp_xyz_description; ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle hamburger hamburger--squeeze" aria-controls="primary-menu" aria-expanded="false">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
