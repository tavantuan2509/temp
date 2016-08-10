<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package test
 */

if ( ! function_exists( 'test_site_logo' ) ) :
/**
 * Displays the site logo in the header area
 */
function test_site_logo() {

	if ( function_exists( 'the_custom_logo' ) ) {

		the_custom_logo();

	}

}
endif;


if ( ! function_exists( 'test_site_title' ) ) :
/**
 * Displays the site title in the header area
 */
function test_site_title() {

	// Get theme options from database.
	$theme_options = test_theme_options();

	// Return early if site title is deactivated.
	if ( false == $theme_options['site_title'] ) {
		return;
	}

	if ( is_home() or is_page_template( 'template-magazine.php' )  ) : ?>

		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

	<?php else : ?>

		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

	<?php endif;

}
endif;


if ( ! function_exists( 'test_site_description' ) ) :
/**
 * Displays the site description in the header area
 */
function test_site_description() {

	// Get theme options from database.
	$theme_options = test_theme_options();

	// Return early if site title is deactivated.
	if ( false == $theme_options['site_description'] ) {
		return;
	}

	$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

	if ( $description || is_customize_preview() ) : ?>

		<p class="site-description"><?php echo $description; ?></p>

	<?php
	endif;

}
endif;


if ( ! function_exists( 'test_header_image' ) ) :
/**
 * Displays the custom header image below the navigation menu
 */
function test_header_image() {

	// Get theme options from database.
	$theme_options = test_theme_options();

	// Display featured image as header image on static pages.
	if ( get_header_image() ) :

		// Hide header image on front page.
		if ( true === $theme_options['custom_header_hide'] and is_front_page() ) {
			return;
		}
		?>

		<div id="headimg" class="header-image">

		<?php // Check if custom header image is linked.
		if ( '' !== $theme_options['custom_header_link'] ) : ?>

			<a href="<?php echo esc_url( $theme_options['custom_header_link'] ); ?>">
				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			</a>

		<?php else : ?>

			<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

		<?php endif; ?>

		</div>

	<?php
	endif;
}
endif;


if ( ! function_exists( 'test_post_image' ) ) :
/**
 * Displays the featured image on archive posts.
 *
 * @param string $size Post thumbnail size.
 * @param array  $attr Post thumbnail attributes.
 */
function test_post_image( $size = 'post-thumbnail', $attr = array() ) {

	// Display Post Thumbnail.
	if ( has_post_thumbnail() ) : ?>

		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php the_post_thumbnail( $size, $attr ); ?>
		</a>

	<?php endif;

} // test_post_image()
endif;


if ( ! function_exists( 'test_post_image_single' ) ) :
/**
 * Displays the featured image on single posts
 */
function test_post_image_single() {

	// Get theme options from database.
	$theme_options = test_theme_options();

	// Display Post Thumbnail if activated.
	if ( true === $theme_options['post_image_single'] ) :

		the_post_thumbnail();

	endif;

} // test_post_image_single()
endif;


if ( ! function_exists( 'test_entry_meta' ) ) :
/**
 * Displays the date, author and categories of a post
 */
function test_entry_meta() {

	// Get theme options from database.
	$theme_options = test_theme_options();

	$postmeta = '';

	// Display date unless user has deactivated it via settings.
	if ( true === $theme_options['meta_date'] ) {

		$postmeta .= test_meta_date();

	}

	// Display author unless user has deactivated it via settings.
	if ( true === $theme_options['meta_author'] ) {

		$postmeta .= test_meta_author();

	}

	// Display categories unless user has deactivated it via settings.
	if ( true === $theme_options['meta_category'] ) {

		$postmeta .= test_meta_category();

	}

	// Display categories unless user has deactivated it via settings.
	if ( true === $theme_options['meta_comments'] ) {

		$postmeta .= test_meta_comments();

	}

	if ( $postmeta ) {

		echo '<div class="entry-meta">' . $postmeta . '</div>';

	}

} // test_entry_meta()
endif;


if ( ! function_exists( 'test_meta_date' ) ) :
/**
 * Displays the post date
 */
function test_meta_date() {

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	return '<span class="meta-date">' . $time_string . '</span>';

}  // test_meta_date()
endif;


if ( ! function_exists( 'test_meta_author' ) ) :
/**
 * Displays the post author
 */
function test_meta_author() {

	$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( esc_html__( 'View all posts by %s', 'test' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);

	return '<span class="meta-author"> ' . $author_string . '</span>';

}  // test_meta_author()
endif;


if ( ! function_exists( 'test_meta_category' ) ) :
/**
 * Displays the category of posts
 */
function test_meta_category() {

	return '<span class="meta-category"> ' . get_the_category_list( ', ' ) . '</span>';

} // test_meta_category()
endif;


if ( ! function_exists( 'test_meta_comments' ) ) :
/**
 * Displays the post comments
 */
function test_meta_comments() {

	// Start Output Buffering.
	ob_start();

	// Display Comments.
	comments_popup_link( esc_html__( 'Leave a comment', 'test' ), esc_html__( 'One comment', 'test' ), esc_html__( '% comments', 'test' ) );
	$comments = ob_get_contents();

	// End Output Buffering.
	ob_end_clean();

	return '<span class="meta-comments"> ' . $comments . '</span>';

} // test_meta_comments()
endif;


if ( ! function_exists( 'test_entry_tags' ) ) :
/**
 * Displays the post tags on single post view
 */
function test_entry_tags() {

	// Get theme options from database.
	$theme_options = test_theme_options();

	// Get tags.
	$tag_list = get_the_tag_list( '', '' );

	// Display tags.
	if ( $tag_list && $theme_options['meta_tags'] ) : ?>

		<div class="entry-tags clearfix">
			<span class="meta-tags">
				<?php echo $tag_list; ?>
			</span>
		</div><!-- .entry-tags -->

	<?php
	endif;

} // test_entry_tags()
endif;


if ( ! function_exists( 'test_more_link' ) ) :
/**
 * Displays the more link on posts
 */
function test_more_link() {
	?>

	<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php esc_html_e( 'Continue reading &raquo;', 'test' ); ?></a>

	<?php
}
endif;


if ( ! function_exists( 'test_post_navigation' ) ) :
/**
 * Displays Single Post Navigation
 */
function test_post_navigation() {

	// Get theme options from database.
	$theme_options = test_theme_options();

	if ( true === $theme_options['post_navigation'] ) {

		the_post_navigation( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html_x( 'Previous Post:', 'post navigation', 'test' ) . '</span>%title',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Post:', 'post navigation', 'test' ) . '</span>%title',
		) );

	}

}
endif;


if ( ! function_exists( 'test_breadcrumbs' ) ) :
/**
 * Displays ThemeZee Breadcrumbs plugin
 */
function test_breadcrumbs() {

	if ( function_exists( 'themezee_breadcrumbs' ) ) {

		themezee_breadcrumbs( array(
			'before' => '<div class="breadcrumbs-container container clearfix">',
			'after' => '</div>',
		) );

	}
}
endif;


if ( ! function_exists( 'test_related_posts' ) ) :
/**
 * Displays ThemeZee Related Posts plugin
 */
function test_related_posts() {

	if ( function_exists( 'themezee_related_posts' ) ) {

		themezee_related_posts( array(
			'class' => 'related-posts type-page clearfix',
			'before_title' => '<h2 class="page-title related-posts-title">',
			'after_title' => '</h2>',
		) );

	}
}
endif;


if ( ! function_exists( 'test_pagination' ) ) :
/**
 * Displays pagination on archive pages
 */
function test_pagination() {

	global $wp_query;

	$big = 999999999; // Need an unlikely integer.

	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'test' ) . '</span>&raquo;',
		'prev_text' => '&laquo<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'test' ) . '</span>',
		'add_args' => false,
	) );

	// Display the pagination if more than one page is found.
	if ( $paginate_links ) : ?>

		<div class="post-pagination clearfix">
			<?php echo $paginate_links; ?>
		</div>

	<?php
	endif;

} // test_pagination()
endif;


/**
 * Displays credit link on footer line
 */
function test_footer_text() {
	?>

	<span class="credit-link">
		<?php printf( esc_html__( 'Powered by %1$s and %2$s.', 'test' ),
			'<a href="http://wordpress.org" title="WordPress">WordPress</a>',
			'<a href="https://themezee.com/themes/test/" title="test WordPress Theme">test</a>'
		); ?>
	</span>

	<?php
}
add_action( 'test_footer_text', 'test_footer_text' );
