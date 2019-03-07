<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_XYZ
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php get_sidebar( 'content-bottom' ); ?>

		<?php
		if ( has_nav_menu( 'social' ) ) :
			wp_nav_menu( array(
				'theme_location'  => 'social',
				'container'       => 'nav',
				'container_class' => 'social-navigation container',
				'menu_class'      => 'social-links-menu',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
			) );
		endif; ?>

		<div class="site-info container">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wp-xyz' ) ); ?>" target="_blank">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( 'Proudly powered by %s.', 'wp-xyz' ), 'WordPress' );	?>
			</a>

			<?php
			/* Privacy Policy */
			printf( '<a href="%s">%s</a>', get_permalink( get_option( 'wp_page_for_privacy_policy' ) ), esc_html( __( 'Privacy Policy' ) ) ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<div id="up-down"><i class="fas fa-angle-up"></i></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body></html>
