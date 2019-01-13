<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WP_XYZ
 */

if ( ! function_exists( 'wp_xyz_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wp_xyz_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			//esc_html_x( 'Posted on %s', 'post date', 'wp-xyz' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="far fa-calendar-alt"></i> ' . $time_string . '</a>'
		);
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'wp_xyz_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wp_xyz_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'wp-xyz' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_avatar( get_the_author_meta( 'user_email' ), 20 ) . '<span>' . esc_html( get_the_author() ) . '</span></a></span>'
		);
		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'wp_xyz_tags_links' ) ) :
	/**
	 * Prints HTML with meta information for the tags.
	 */
	function wp_xyz_tags_links() {
		if ( is_single() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'wp-xyz' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links">' . esc_html__( '%1$s', 'wp-xyz' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'wp_xyz_comments_link' ) ) :
	/**
	 * Prints HTML with meta information for the comments.
	 */
	function wp_xyz_comments_link() {
		if ( comments_open() || get_comments_number() ) { ?>
			<span class="comments-link">
				<?php
				comments_popup_link(
					'<i class="far fa-comment"></i>&nbsp;0',
					'<i class="far fa-comment"></i>&nbsp;1',
					'<i class="far fa-comments"></i>&nbsp;%',
					'',
					'<i class="far fa-comment-slash"></i>'
				); ?>
			</span>
			<?php
		}
	}
endif;

if ( ! function_exists( 'wp_xyz_cat_links' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function wp_xyz_cat_links() {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links"><i class="fas fa-tag"></i> %1$s</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'wp_xyz_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the entry-footer.
	 */
	function wp_xyz_entry_footer() {
		// Show category text for single pages.
		if ( is_single() ) {
			wp_xyz_cat_links();
		}

		// Hide comments link for single pages.
		if ( ! is_single() && ! post_password_required() ) {
			wp_xyz_comments_link();
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-xyz' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'wp_xyz_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function wp_xyz_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) : ?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( 'post-thumbnail', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) ); ?>
			</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_xyz_excerpt' ) ) :
	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @link https://developer.wordpress.org/reference/functions/the_excerpt/
	 */
	function wp_xyz_excerpt( $excerpt ) {
		if ( ! is_single() || has_excerpt() || is_search() ) {
			$excerpt = sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
				get_permalink( get_the_ID() ),
				esc_html__( 'Read More...', 'wp-xyz' )
			);
		}
		return $excerpt;
	}
	add_filter( 'excerpt_more', 'wp_xyz_excerpt' );
endif;

if ( ! function_exists( 'wp_xyz_tag_cloud_limit' ) ) :
	/**
	 * Limit the number of tags displayed by Tag Cloud widget.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/widget_tag_cloud_args/
	 */
	function wp_xyz_tag_cloud_limit( $tagCloudLimit ) {
		if ( isset($tagCloudLimit['taxonomy']) && $tagCloudLimit['taxonomy'] == 'post_tag' ) {
			$tagCloudLimit['number'] = 32;
		}
		return $tagCloudLimit;
	}
	add_filter( 'widget_tag_cloud_args', 'wp_xyz_tag_cloud_limit' );
endif;

if ( ! function_exists( 'wp_xyz_add_editor_styles' ) ) :
	/**
	 * Allows theme developers to link a custom stylesheet file to the TinyMCE visual editor.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
	 */
	function wp_xyz_add_editor_styles() {
		add_editor_style( 'editor-styles.css' );
	}
	add_action( 'current_screen', 'wp_xyz_add_editor_styles' );
endif;
