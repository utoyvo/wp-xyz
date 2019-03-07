<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_XYZ
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$wp_xyz_comment_count = get_comments_number();
			if ( '1' === $wp_xyz_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'wp-xyz' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $wp_xyz_comment_count, 'comments title', 'wp-xyz' ) ),
					number_format_i18n( $wp_xyz_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			} ?>
		</h2><!-- .comments-title -->

		<?php
		the_comments_pagination( array(
			'mid_size'           => 1,
			'prev_text'          => __( 'Prev', 'wp-xyz' ),
			'next_text'          => __( 'Next', 'wp-xyz' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Comment', 'wp-xyz' ) . '</span>',
		) ); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 64,
			) ); ?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_pagination( array(
			'mid_size'           => 1,
			'prev_text'          => __( 'Prev', 'wp-xyz' ),
			'next_text'          => __( 'Next', 'wp-xyz' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Comment', 'wp-xyz' ) . '</span>',
		) );

		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wp-xyz' ); ?></p>
			<?php
		endif;

	endif;

	comment_form(); ?>

</div><!-- #comments -->
