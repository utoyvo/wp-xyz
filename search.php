<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WP_XYZ
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'wp-xyz' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

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
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
