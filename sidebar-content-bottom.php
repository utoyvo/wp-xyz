<?php
/**
 * The template for the content bottom widget areas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_XYZ
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
} ?>

<aside id="sidebar-bottom" class="widget-area container">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #sidebar-bottom -->
