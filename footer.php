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

		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation container" role="navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'social',
					'menu_class'     => 'social-links-menu',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) ); ?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

		<div class="site-info container">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wp-xyz' ) ); ?>" target="_blank">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'wp-xyz' ), 'WordPress' );	?>
			</a>

			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'wp-xyz' ), 'wp-xyz', '<a href="http://utoyvo.xyz">utoyvo</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<div id="up-down"><i class="fas fa-angle-up"></i></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body></html>
