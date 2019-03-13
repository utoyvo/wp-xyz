<?php
/**
 * WP XYZ Theme Customizer
 *
 * @package WP_XYZ
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_xyz_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'wp_xyz_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'wp_xyz_customize_partial_blogdescription',
		) );
	}

	// Primary color
	$wp_customize->add_setting( 'primary_color', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Primary color', 'wp-xyz' ),
	) ) );

	// Second color
	$wp_customize->add_setting( 'second_color', array(
		'default'   => '#eeeeee',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'second_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Second color', 'wp-xyz' ),
	) ) );

	// Text color
	$wp_customize->add_setting( 'text_color', array(
		'default'   => '#222222',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Text color', 'wp-xyz' ),
	) ) );

	// Link color
	$wp_customize->add_setting( 'link_color', array(
		'default'   => '#008888',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Link color', 'wp-xyz' ),
	) ) );

	// Accent color
	$wp_customize->add_setting( 'accent_color', array(
		'default'   => '#004444',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Accent color', 'wp-xyz' ),
	) ) );

	// Border color
	$wp_customize->add_setting( 'border_color', array(
		'default'   => '#dddddd',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'border_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Border color', 'wp-xyz' ),
	) ) );

	// Field color
	$wp_customize->add_setting( 'field_color', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'field_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Field color', 'wp-xyz' ),
	) ) );

	// Accent field color
	$wp_customize->add_setting( 'accent_field_color', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_field_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Accent field color', 'wp-xyz' ),
	) ) );

	// Footer color
	$wp_customize->add_setting( 'footer_color', array(
		'default'   => '#222222',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Footer color', 'wp-xyz' ),
	) ) );

	// Footer text color
	$wp_customize->add_setting( 'footer_text_color', array(
		'default'   => '#eeeeee',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Footer text color', 'wp-xyz' ),
	) ) );
}
add_action( 'customize_register', 'wp_xyz_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_xyz_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_xyz_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_xyz_customize_preview_js() {
	wp_enqueue_script( 'wp-xyz-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'wp_xyz_customize_preview_js' );

/**
 * Custom style
 */
function wp_xyz_get_customizer_css() {
	ob_start();

	// Primary color
	$primary_color = get_theme_mod( 'primary_color', '' );
	if ( ! empty( $primary_color ) ) { ?>

		.site-header,
		.hentry,
		.widget,
		.page-header,
		.page-content,
		.comments-area,
		.navigation .nav-links,
		.pagination .nav-links {
			background: <?php echo $primary_color; ?>;
		}
	<?php
	}

	// Second color
	$second_color = get_theme_mod( 'second_color', '' );
	if ( ! empty( $second_color ) ) { ?>

		blockquote,
		.comment .comment-body,
		code, kbd, samp, blockquote, pre {
			background: <?php echo $second_color; ?>;
		}

		.comment .comment-body::before {
			border-color: transparent <?php echo $second_color; ?> transparent transparent;
		}
	<?php
	}

	// Text color
	$text_color = get_theme_mod( 'text_color', '' );
	if ( ! empty( $text_color ) ) { ?>

		body, mark, ins,
		.hentry .entry-header .entry-title,
		.hentry .entry-header .entry-title a,
		.hentry .entry-header .entry-meta,
		.hentry .entry-header .entry-meta a,
		.hentry .entry-footer a,
		#secondary .widget-title,
		.page-header .page-title,
		.main-navigation a,
		.comment .comment-body,
		.comment .comment-metadata a,
		.comment .comment-metadata .comment-edit-link,
		.navigation .nav-links .page-numbers,
		.pagination .nav-links .page-numbers,
		.comment-navigation .nav-previous a,
		.comment-navigation .nav-next a,
		.posts-navigation .nav-previous a,
		.posts-navigation .nav-next a,
		.post-navigation .nav-previous a,
		.post-navigation .nav-next a {
			color: <?php echo $text_color; ?>;
		}
	<?php
	}

	// Link color
	$link_color = get_theme_mod( 'link_color', '' );
	if ( ! empty( $link_color ) ) { ?>

		a,
		.main-navigation .current-menu-item,
		.main-navigation .current-menu-item a {
			color: <?php echo $link_color; ?>;
		}

		button, .button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.navigation .nav-links .page-numbers.current,
		.pagination .nav-links .page-numbers.current,
		.widget_calendar tbody a {
			background: <?php echo $link_color; ?>;
			border-color: <?php echo $link_color; ?>;
		}
	<?php
	}

	// Accent color
	$accent_color = get_theme_mod( 'accent_color', '' );
	if ( ! empty( $accent_color ) ) { ?>

		a:hover,
		.main-navigation a:hover,
		.main-navigation a:focus,
		.hentry .entry-footer a:hover,
		.hentry .entry-footer a:focus {
			color: <?php echo $accent_color; ?>;
		}

		button:hover, .button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover,
		.widget_calendar tbody a:hover {
			background: <?php echo $accent_color; ?>;
			border-color: <?php echo $accent_color; ?>;
		}
	<?php
	}

	// Border color
	$border_color = get_theme_mod( 'border_color', '' );
	if ( ! empty( $border_color ) ) { ?>

		hr {
			background: <?php echo $border_color; ?>;
		}

		.hentry,
		.page-header,
		.page-content,
		.widget,
		.site-header,
		.main-navigation ul ul,
		.comments-area,
		.comments-area .comments-title,
		.comments-area .no-comments,
		.comment-respond, .comment .comment-respond,
		.comment .comment-author .avatar,
		code, kbd, samp, blockquote, pre, select,
		table, th, td,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		.navigation .nav-links,
		.pagination .nav-links,
		.comment-navigation .nav-previous a,
		.comment-navigation .nav-next a,
		.posts-navigation .nav-previous a,
		.posts-navigation .nav-next a,
		.post-navigation .nav-previous a,
		.post-navigation .nav-next a,
		.navigation .nav-links .page-numbers,
		.pagination .nav-links .page-numbers {
			border-color: <?php echo $border_color; ?>;
		}
	<?php
	}

	// Field color
	$field_color = get_theme_mod( 'field_color', '' );
	if ( ! empty( $field_color ) ) { ?>

		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		select {
			background: <?php echo $field_color; ?>;
		}
	<?php
	}

	// Accent field color
	$accent_field_color = get_theme_mod( 'accent_field_color', '' );
	if ( ! empty( $accent_field_color ) ) { ?>

		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus {
			background: <?php echo $accent_field_color; ?>;
		}
	<?php
	}

	// Footer color
	$footer_color = get_theme_mod( 'footer_color', '' );
	if ( ! empty( $footer_color ) ) { ?>

		#colophon {
			background: <?php echo $footer_color; ?>;
		}
	<?php
	}

	// Footer text color
	$footer_text_color = get_theme_mod( 'footer_text_color', '' );
	if ( ! empty( $footer_text_color ) ) { ?>

		#colophon,
		#colophon a {
			color: <?php echo $footer_text_color; ?>;
		}
	<?php
	}

	$css = ob_get_clean();
	return $css;
}

/**
 * Add custom style
 */
function wp_xyz_enqueue_styles() {
	wp_enqueue_style( 'wp-xyz-styles', get_stylesheet_uri() );
	$custom_css = wp_xyz_get_customizer_css();
	wp_add_inline_style( 'wp-xyz-styles', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'wp_xyz_enqueue_styles' );
