<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_XYZ
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' ); ?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			/*
			 * Posts navigation.
			 *
			 * @link https://codex.wordpress.org/Function_Reference/the_posts_pagination
			 */
			the_posts_pagination( array(
				'mid_size'           => 1,
				'prev_text'          => __( 'Previous page', 'wp-xyz' ),
				'next_text'          => __( 'Next page', 'wp-xyz' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wp-xyz' ) . '</span>',
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
