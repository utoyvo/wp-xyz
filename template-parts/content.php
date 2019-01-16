<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_XYZ
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			wp_xyz_posted_on();
			wp_xyz_posted_by(); ?>
		</div><!-- .entry-meta -->
		<?php endif;
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<?php wp_xyz_post_thumbnail(); ?>

	<footer class="entry-footer"><?php wp_xyz_entry_footer(); ?></footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
