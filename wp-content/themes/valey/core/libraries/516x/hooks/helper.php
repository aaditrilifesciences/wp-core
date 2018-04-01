<?php
/**
 * Custom template tags.
 *
 * @since   1.0.0
 * @package Valey
 */

/**
 * Render header layout.
 *
 * @return string
 */
if ( ! function_exists( 'fx_header' ) ) {
	function fx_header() {
		$layout = cs_get_option( 'header-layout' );
		if ( isset( $_GET['header'] ) ) {
			$layout = $_GET['header'];
		}

		ob_start();
		get_template_part( 'views/header/' . $layout );
		$output = ob_get_clean();

		echo apply_filters( 'fx_header', $output );
	}
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_posted_on' ) ) {
	function fx_valey_posted_on() {
		$output = '';
		$time = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$output .= sprintf( $time,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		echo apply_filters( 'fx_valey_posted_on', '<span class="posted-on">' . $output . '</span>' );
	}
}

/**
 * Prints post title.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_post_title' ) ) {
	function fx_valey_post_title( $link = true ) {
		$output = '';

		if ( $link ) {
			$output .= sprintf( '<h2 class="post-title fwb tu"><a class="chp" href="%2$s" rel="bookmark">%1$s</a></h2>', get_the_title(), esc_url( get_permalink() ) );
		} else {
			$output .= sprintf( '<h2 class="post-title fwb tu">%s</h2>', get_the_title() );
		}

		echo apply_filters( 'fx_valey_post_title', $output );
	}
}

/**
 * Prints post meta with the post author, categories and post comments.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_post_meta' ) ) {
	function fx_valey_post_meta() {
		$output = '';
		// Post author
		$output .= sprintf(
			esc_html__( '%1$s', 'valey' ),
			'<span class="author vcard pr">' . get_avatar( get_the_author_meta( 'user_email' ), '25', '' ) . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		// Post categories
		$categories = get_the_category_list( esc_html__( ', ', 'valey' ) );
		if ( $categories ) {
			$output .= sprintf(
				'<span class="cat pr">' . esc_html__( 'Category %1$s', 'valey' ) . '</span>', $categories 
			);
		}

		// Post comments
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			$output .= sprintf( '<span class="comment-number pr"><a href="%2$s">' . esc_html__( '%1$s Comment', get_comments_number(), 'valey' ) . '</a></span>', number_format_i18n( get_comments_number() ), esc_url( get_comments_link() ) );
		}

		echo apply_filters( 'fx_valey_post_title', '<div class="post-meta">' . $output . '</div>' );
	}
}

/**
 * Render post tags.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_get_tags' ) ) :
	function fx_valey_get_tags() {
		$output = '';

		// Get the tag list
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'valey' ) );
		if ( $tags_list ) {
			$output .= sprintf( '<div class="post-tags"><i class="fa fa-tags"></i> ' . esc_html__( '%1$s', 'valey' ) . '</div>', $tags_list );
		}
		return apply_filters( 'fx_valey_get_tags', $output );
	}
endif;

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_post_thumbnail' ) ) {
	function fx_valey_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) : ?>

			<div class="post-thumbnail mb__85 tc">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
		
			<div class="post-thumbnail mb__50">
				<a href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
					<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
				</a>
			</div>

		<?php endif;
	}
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_pagination' ) ) {
	function fx_valey_pagination( $nav_query = false ) {

		global $wp_query, $wp_rewrite;

		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		// Prepare variables
		$query        = $nav_query ? $nav_query : $wp_query;
		$max          = $query->max_num_pages;
		$current_page = max( 1, get_query_var( 'paged' ) );
		$big          = 999999;
		?>
		<nav class="fx-pagination clearfix" role="navigation">
			<?php
				echo '' . paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => $current_page,
						'total'     => $max,
						'type'      => 'list',
						'prev_text' => '<i class="fa fa-angle-left"></i>',
						'next_text' => '<i class="fa fa-angle-right"></i>',
					)
				) . ' ';
			?>
		</nav><!-- .page-nav -->
		<?php
	}
}

/**
 * Create a breadcrumb menu.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_breadcrumb' ) ) {
	function fx_valey_breadcrumb() {
		// Settings
		$sep   = '/';
		$home  = esc_html__( 'Home', 'valey' );
		$blog  = esc_html__( 'Blog', 'valey' );
		$shop  = esc_html__( 'Shop', 'valey' );
		 
		// Get the query & post information
		global $post, $wp_query;

		// Get post category
		$category = get_the_category();

		// Get product category
		$product_cat = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		if ( $product_cat ) {
			$tax_title = $product_cat->name;
		}

		$output = '';
		 
		// Build the breadcrums
		$output .= '<ul class="fx-breadcrumbs dib f__mont ls__1 tu clearfix fs__14">';
		 
		// Do not display on the homepage
		if ( ! is_front_page() ) {

			if ( is_home() ) {
				
				// Home page
				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl separator"> ' . $blog . ' </li>';

			} elseif ( function_exists( 'is_shop' ) && is_shop() ) {

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl">' . $shop . '</li>';
			
			} else if ( function_exists( 'is_product' ) && is_product() || function_exists( 'is_cart' ) && is_cart() || function_exists( 'is_checkout' ) && is_checkout()  || function_exists( 'is_account_page' ) && is_account_page() ) {

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl"><a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '" title="' . esc_attr( $home ) . '">' . $shop . '</a></li>';

			} else if ( function_exists( 'is_product_category' ) && is_product_category() ) {

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl"><a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '" title="' . esc_attr( $home ) . '">' . $shop . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl separator"> ' . esc_html__( 'Category', 'valey' ) . ' </li>';

			} else if ( function_exists( 'is_product_tag' ) && is_product_tag() ) {

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl"><a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '" title="' . esc_attr( $home ) . '">' . $shop . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl separator"> ' . esc_html__( 'Tag', 'valey' ) . ' </li>';

			} else if ( is_post_type_archive() ) {

				$post_type = get_post_type_object( get_post_type() );

				$output .= '<li class="fl current">' . $post_type->labels->singular_name . '</li>';

			} else if ( is_single() ) {
				 
				// Single post (Only display the first category)
				if ( ! empty( $category ) ) {
					$output .= '<li class="fl"><a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '" title="' . esc_attr( $category[0]->cat_name ) . '">' . $category[0]->cat_name . '</a></li>';
				}
				
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl current">' . get_the_title() . '</li>';
				 
			} else if ( is_category() ) {
				 
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) echo get_category_parents( $thisCat->parent, TRUE, ' ' );

				// Category page
				$output .= '<li class="fl current">' . single_cat_title( '', false ) . '</li>';
				 
			} else if ( is_page() ) {
				 
				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';

				// Standard page
				if ( $post->post_parent ) {
					 
					// If child page, get parents 
					$anc = get_post_ancestors( $post->ID );
					 
					// Get parents in the right order
					$anc = array_reverse($anc);
					 
					// Parent page loop
					foreach ( $anc as $ancestor ) {
						$parents = '<li class="fl"><a href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_attr( get_the_title( $ancestor ) ) . '">' . get_the_title( $ancestor ) . '</a></li>';
						$parents .= '<li class="fl separator"> ' . $sep . ' </li>';
					}
					 
					// Display parent pages
					$output .= $parents;
					 
					// Current page
					$output .= '<li class="fl current"> ' . get_the_title() . '</li>';
					 
				} else {
					 
					// Just display current page if not parents
					$output .= '<li class="fl current"> ' . get_the_title() . '</li>';
					 
				}
				 
			} else if ( is_tag() ) {
				 
				// Tag page
				 
				// Get tag information
				$term_id  = get_query_var( 'tag_id' );
				$taxonomy = 'post_tag';
				$args     = 'include=' . $term_id;
				$terms    = get_terms( $taxonomy, $args );
				 
				// Display the tag name
				$output .= '<li class="fl current">' . $terms[0]->name . '</li>';
			 
			} elseif ( is_day() ) {
				 
				// Day archive
				 
				// Year link
				$output .= '<li class="fl"><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . esc_html__( ' Archives', 'valey' ) . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				 
				// Month link
				$output .= '<li class="fl"><a href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time( 'm' ) ) ) . '" title="' . esc_attr( get_the_time( 'M' ) ) . '">' . get_the_time( 'M' ) . esc_html__( ' Archives', 'valey' ) . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				 
				// Day display
				$output .= '<li class="fl current"> ' . get_the_time('jS') . ' ' . get_the_time('M') . esc_html__( ' Archives', 'valey' ) . '</li>';
				 
			} else if ( is_month() ) {
				 
				// Month Archive
				 
				// Year link
				$output .= '<li class="fl"><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . esc_html__( ' Archives', 'valey' ) . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				 
				// Month display
				$output .= '<li class="fl">' . get_the_time( 'M' ) . esc_html__( ' Archives', 'valey' ) . '</li>';
				 
			} else if ( is_year() ) {
				 
				// Display year archive
				$output .= '<li class="fl current">' . get_the_time('Y') . esc_html__( 'Archives', 'valey' ) . '</li>';
				 
			} else if ( is_author() ) {
				 
				// Auhor archive
				 
				// Get the author information
				global $author;
				$userdata = get_userdata( $author );
				 
				// Display author name
				$output .= '<li class="fl current">' . esc_html__( 'Author: ', 'valey' ) . $userdata->display_name . '</li>';
			 
			} else if ( get_query_var('paged') ) {
				 
				// Paginated archives
				$output .= '<li class="fl current">' .  esc_html__( 'Page', 'valey' ) . ' ' . get_query_var( 'paged' ) . '</li>';
				 
			} else if ( is_search() ) {
			 
				// Search results page
				$output .= '<li class="fl current">' .  esc_html__( 'Search results for: ', 'valey' ) . get_search_query() . '</li>';
			 
			} elseif ( is_404() ) {
				 
				// 404 page
				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl current">' . esc_html__( 'Error 404', 'valey' ) . '</li>';
			}
			 
		} else  {
			$output .= '<li class="fl current">' . esc_html__( 'Front Page', 'valey' ) . '</li>';
		}
		 
		$output .= '</ul>';

		return apply_filters( 'fx_valey_breadcrumb', $output );
	}
}

/**
 * Render title of page.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_page_title' ) ) {
	function fx_valey_page_title() {
		$output = '';

		// Get title of blog list
		$blogtitle = cs_get_option( 'blog-page-title' );

		// Get title of WC
		$wctitle = cs_get_option( 'wc-page-title' );

		$output .= '<h1 class="f__libre cb">';
			if ( function_exists( 'is_shop' ) && is_shop() ) {

				if ( ! empty( $wctitle ) ) {
					$output .= $wctitle;
				} else {
					$output .= get_the_title( wc_get_page_id( 'shop' ) );
				}

			} else if (
				function_exists( 'is_product_category' ) && is_product_category()
				|| function_exists( 'is_product_tag' ) && is_product_tag()
			) {
				$output .= single_term_title( '', false );

			} else if ( is_page() ) {

				$output .= get_the_title();

			} else if ( is_home() ) {

				if ( ! empty( $blogtitle ) ) {
					$output .= $blogtitle;
				} else {
					$output .= esc_html__( 'Article', 'valey' );
				}

			}
		$output .= '</h1>';

		return apply_filters( 'fx_valey_page_title', $output );
	}
}

/**
 * Render sub title of page.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_page_sub_title' ) ) {
	function fx_valey_page_sub_title() {
		$output = '';

		// Get sub title of blog list
		$blogsubtitle = cs_get_option( 'blog-page-subtitle' );

		// Get title of WC
		$wcsubtitle = cs_get_option( 'wc-page-subtitle' );

		// Get sub title
		$subtitle = get_post_meta( get_the_ID(), '_custom_page_options', true );
		if ( isset( $subtitle['subtitle'] ) && ! $subtitle['subtitle'] ) return;

		$output .= '<span class="tu cb bgp f__mont ls__3 dib">';
			if (
				function_exists( 'is_shop' ) && is_shop()
				|| function_exists( 'is_product_category' ) && is_product_category()
				|| function_exists( 'is_product_tag' ) && is_product_tag()
			) {
				if ( ! empty( $wcsubtitle ) ) {
					$output .= $wcsubtitle;
				} else {
					$output .= esc_html__( 'Shop', 'valey' );
				}

			} else if ( is_page() ) {

				if ( isset( $subtitle['subtitle'] ) && $subtitle['subtitle'] && ! empty( $subtitle['title'] ) ) {
					$output .= $subtitle['title'];

				} else if (
					function_exists( 'is_cart' ) && is_cart()
					|| function_exists( 'is_checkout' ) && is_checkout()
					|| function_exists( 'is_account_page' ) && is_account_page()
				) {
					$output .= esc_html__( 'Shop', 'valey' );

				} else {
					$output .= esc_html__( 'Page', 'valey' );
				}

			} else if ( 'posts' == get_option( 'show_on_front' ) ) {

				$output .= apply_filters( 'fx_blog_title', esc_html__( 'Blog', 'valey' ) );

			} else {

				if ( ! empty( $blogsubtitle ) ) {
					$output .= $blogsubtitle;
				} else {
					$output .= get_the_title( get_option( 'page_for_posts' ) );
				}

			}
		$output .= '</span>';

		return apply_filters( 'fx_valey_page_sub_title', $output );
	}
}

/**
 * Print HTML for social share.
 *
 * @return  void
 */
if ( ! function_exists( 'fx_valey_social_share' ) ) {
	function fx_valey_social_share() {
	?>
		<div class="fx-share flex between-sm center-xs middle-xs pt__35 pb__35 mt__60 mb__45 bdt bdb">
			<h4 class="tu cb mg__0 fs__14 hide-xs visible-sm"><?php echo esc_html__( 'Love this article?', 'valey' ); ?></h4>
			<div class="f__mont tc">
				<a title="<?php echo esc_html__( 'Share this post on Facebook', 'valey' ); ?>" class="dib cw facebook" href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<i class="mr__15 fa fa-facebook-official"></i>
					<span class="tu"><?php echo esc_html__( 'Share', 'valey' ); ?></span>
				</a>
				<a title="<?php echo esc_html__( 'Share this post on Twitter', 'valey' ); ?>" class="dib cw twitter" href="https://twitter.com/share?url=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<i class="mr__15 fa fa-twitter"></i>
					<span class="tu"><?php echo esc_html__( 'Tweet', 'valey' ); ?></span>
				</a>
				<a title="<?php echo esc_html__( 'Share this post on Google Plus', 'valey' ); ?>" class="dib cw google-plus" href="https://plus.google.com/share?url=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<i class="mr__15 fa fa-google-plus"></i>
					<span class="tu"><?php echo esc_html__( 'Google+', 'valey' ); ?></span>
				</a>
			</div><!-- .fx-social -->
		</div>
		<?php
	}
}

/**
 * Print HTML for social list.
 *
 * @return  void
 */
if ( ! function_exists( 'fx_valey_social' ) ) {
	function fx_valey_social() {
		$output = '';

		$socials = cs_get_option( 'social-network' );
		if ( empty( $socials ) ) return;

		$output .= '<div class="fx-social">';
			foreach ( $socials as $social) {
				$output .= '<a class="' . esc_attr( str_replace( 'fa fa-', '', $social['icon'] ) ) . '" href="' . esc_url( $social['link'] ) . '"><i class="' . esc_attr( $social['icon'] ) . '"></i></a>';
			}
		$output .= '</div>';

		return apply_filters( 'fx_valey_social', $output );
	}
}

/**
 * Render author information.
 *
 * @return string
 */
if ( ! function_exists( 'fx_valey_author_info' ) ) {
	function fx_valey_author_info() {
		$author = sprintf(
			__( '<div class="post-author">%1$s<div class="clearfix">%2$s%3$s</div></div>', 'valey' ),
			'<h4 class="mg__0 mb__35 pr dib tu cp head__1">' . esc_html__( 'About Author', 'valey' ) . '</h4>',
			'<div class="fl">' . get_avatar( get_the_author_meta( 'user_email' ), '100', '' ) . '</div>',
			'<div class="oh pl__70"><a class="f__mont cb chp fwb db mb__10 mt__5 tu" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a><p>' . get_the_author_meta( 'description' ) . '</p></div>'

		);
		echo apply_filters( 'fx_valey_author_info', $author );
	}
}

/**
 * Render related post based on post tags.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_related_post' ) ) {
	function fx_valey_related_post() {
		global $post;

		// Get post's tags
		$tags = wp_get_post_tags( $post->ID );

		if ( $tags ) {
			// Get id for all tags
			$tag_ids = array();

			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}

			// Build arguments to query for related posts
			$args = array(
				'tag__in'             => $tag_ids,
				'post__not_in'        => array( $post->ID ),
				'posts_per_page'      => apply_filters( 'fx_valey_related_post_per_page', '3' ),
				'ignore_sticky_posts' => 1,
				'orderby'             => 'rand',
			);

			// Get related post
			$related = new wp_query( $args );

			$output = '';
			$output .= '<div class="post-related pt__20">';
				$output .= '<h4 class="mg__0 mb__30 pr dib tu cp head__1">' . esc_html__( 'Related Articles', 'valey' ) . '</h4>';
				while ( $related->have_posts() ) :
					// Update global post data
					$related->the_post();

					$output .= '<div class="item pr pb__15 mb__15">';
						$output .= '<h4 class="mg__0"><a class="cb chp tu" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h4>';
						$output .= '<span class="f__libre">' . get_the_time( 'F j' ) . '</span>';
					$output .= '</div>';
				endwhile;
			$output .= '</div>';
			
			// Reset global query object
			wp_reset_postdata();

			echo apply_filters( 'fx_valey_related_post', $output );
		}
	}
}

/**
 * custom function to use to open and display each comment
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_comments_list' ) ) {
	function fx_valey_comments_list( $comment, $args, $depth ) {
	// Globalize comment object
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :

			case 'pingback'  :
			case 'trackback' :
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p>
						<?php
							echo esc_html__( 'Pingback:', 'valey' );
							comment_author_link();
							edit_comment_link( esc_html__( 'Edit', 'valey' ), '<span class="edit-link">', '</span>' );
						?>
					</p>
				<?php
			break;

			default :
				global $post;
				?>
				<li <?php comment_class( 'mt__30' ); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment-body">
						<div class="comment-avatar fl">
							<?php echo get_avatar( $comment, 68 ); ?>
						</div>
						<div class="comment-content oh pl__30">
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'valey' ); ?></p>
							<?php endif; ?>

							<?php
								printf(
									'<h5 class="comment-author mg__0 mb__15">%1$s</h5>',
									get_comment_author_link(),
									( $comment->user_id == $post->post_author ) ? '<span class="author-post">' . esc_html__( 'Post author', 'valey' ) . '</span>' : ''
								);
							?>
							<?php comment_text(); ?>

							<div class="flex">
								<?php
									printf(
										'<time class="grow">%3$s</time>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										sprintf( __( '%1$s at %2$s', 'valey' ), get_comment_date(), get_comment_time() )
									);
								?>
								<?php
									edit_comment_link( __( '<span>Edit</span>', 'valey' ) );
									comment_reply_link(
										array_merge(
											$args,
											array(
												'reply_text' => __( '<span class="ml__10">Reply</span>', 'valey' ),
												'depth'      => $depth,
												'max_depth'  => $args['max_depth'],
											)
										)
									);
								?>
							</div><!-- .action-link -->
						</div><!-- .comment-content -->
					</article><!-- #comment- -->
				<?php
			break;

		endswitch;
	}
}

/**
 * Render custom styles.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_custom_css' ) ) {
	function fx_valey_custom_css( $css = array() ) {
		// Logo width
		if ( cs_get_option( 'logo-width' ) ) {
			$css[] = '.fx-branding > .dib {
				max-width: ' . esc_attr( cs_get_option( 'logo-width' ) ) . 'px;
			}';
		}
		// Blog page title background
		$blog_pagehead_bg = cs_get_option( 'blog-pagehead-bg' );

		if ( ! empty( $blog_pagehead_bg['image'] ) ) {
			$css[] = '.head-blog {';
				$css[] = '
					background-image:  url(' .  $blog_pagehead_bg['image'] . ')    ;
					background-size:       ' .  $blog_pagehead_bg['size'] .       ';
					background-repeat:     ' .  $blog_pagehead_bg['repeat'] .     ';
					background-position:   ' .  $blog_pagehead_bg['position'] .   ';
					background-attachment: ' .  $blog_pagehead_bg['attachment'] . ';
					background-color:      ' .  $blog_pagehead_bg['color'] .      ';
				';
			$css[] = '}';
		}

		// WooCommcerce page title background
		$wc_pagehead_bg = cs_get_option( 'wc-pagehead-bg' );

		if ( ! empty( $wc_pagehead_bg['image'] ) ) {
			$css[] = '.head-wc {';
				$css[] = '
					background-image:  url(' .  $wc_pagehead_bg['image'] . ')    ;
					background-size:       ' .  $wc_pagehead_bg['size'] .       ';
					background-repeat:     ' .  $wc_pagehead_bg['repeat'] .     ';
					background-position:   ' .  $wc_pagehead_bg['position'] .   ';
					background-attachment: ' .  $wc_pagehead_bg['attachment'] . ';
					background-color:      ' .  $wc_pagehead_bg['color'] .      ';
				';
			$css[] = '}';
		}

		// Footer background
		$footer_bg = cs_get_option( 'footer-bg' );
		if ( ! empty( $footer_bg['image'] ) ) {
			$css[] = '#fx-footer {';
				$css[] = '
					background-image:  url(' .  $footer_bg['image'] . ')    ;
					background-size:       ' .  $footer_bg['size'] .       ';
					background-repeat:     ' .  $footer_bg['repeat'] .     ';
					background-position:   ' .  $footer_bg['position'] .   ';
					background-attachment: ' .  $footer_bg['attachment'] . ';
				';
				if ( ! empty( $footer_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $footer_bg['color'] .';';
				}
			$css[] = '}';
		}

		// Maintenance mode
		$maintenance    = cs_get_option( 'maintenance' );
		$maintenance_bg = cs_get_option( 'maintenance-bg' );
		if ( $maintenance ) {
			if ( ! empty( $maintenance_bg['image'] ) ) {
				$css[] = '.fx-offline {';
					$css[] = '
						background-image:  url(' .  $maintenance_bg['image'] . ')    ;
						background-size:       ' .  $maintenance_bg['size'] .       ';
						background-repeat:     ' .  $maintenance_bg['repeat'] .     ';
						background-position:   ' .  $maintenance_bg['position'] .   ';
						background-attachment: ' .  $maintenance_bg['attachment'] . ';
					';
				$css[] = '}';
			}
			if ( ! empty( $maintenance_bg['color'] ) ) {
				$css[] = '.fx-offline:before {';
					$css[] = '
						background-color: ' .  $maintenance_bg['color'] . ';
					';
				$css[] = '}';
			}
		}

		// 404 background
		$notfound = cs_get_option( 'not-found-bg' );
		$notfound_bg = wp_get_attachment_image_src( $notfound, 'full', true );
		if ( $notfound ) {
			$css[] = '
				#fx-content-404 {
					background: url(' . esc_url( $notfound_bg[0] ) . ')  no-repeat 0 0 / cover;
				}
			';
		}
		
		// Content width
		if ( cs_get_option( 'content-width' ) && ! cs_get_option( 'boxed' ) ) {
			$css[] = '
				@media only screen and (min-width: 75em) {
					.fx-container {
						width: ' . cs_get_option( 'content-width' ) . 'px;
					}
				}
			';
		}

		// Boxed layout
		$boxed_bg = cs_get_option( 'boxed-bg' );
		if ( cs_get_option( 'boxed' ) ) {
			$css[] = '.boxed {';
				$css[] = '
					background-image:  url(' .  $boxed_bg['image'] . ')    ;
					background-size:       ' .  $boxed_bg['size'] .       ';
					background-repeat:     ' .  $boxed_bg['repeat'] .     ';
					background-position:   ' .  $boxed_bg['position'] .   ';
					background-attachment: ' .  $boxed_bg['attachment'] . ';
				';
				if ( ! empty( $boxed_bg['color'] ) ) {
					$css[] = '
						background-color: ' .  $boxed_bg['color'] . ';
					';
				}
			$css[] = '}';
			$css[] = '
				.boxed #fx-wrapper {
					width: ' . cs_get_option( 'content-width' ) . 'px;
					margin: auto;
					background: #fff;
					padding: 0 10px;
				}
			';
		}

		// Typography
		$body_font    = cs_get_option( 'body-font' );
		$heading_font = cs_get_option( 'heading-font' );

		$css[] = 'body, .f__libre {';
			$css[] = 'font-family: "' . $body_font['family'] . '";';
			if ( '100italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 100;
					font-style: italic;
				';
			} elseif ( '300italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 300;
					font-style: italic;
				';
			} elseif ( '400italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 400;
					font-style: italic;
				';
			} elseif ( '700italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';
			} elseif ( '900italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 900;
					font-style: italic;
				';
			} elseif ( 'regular' == $body_font['variant'] ) {
				$css[] = 'font-weight: 400;';
			} elseif ( 'italic' == $body_font['variant'] ) {
				$css[] = 'font-style: italic;';
			} else {
				$css[] = 'font-weight:' . $body_font['variant'];
			}
		$css[] = '}';

		$css[] = 'body {';
			if ( cs_get_option( 'body-font-size' ) ) {
				$css[] = 'font-size:' . cs_get_option( 'body-font-size' ) . 'px;';
			}
			if ( cs_get_option( 'body-color' ) ) {
				$css[] = 'color:' . cs_get_option( 'body-color' );
			}
		$css[] = '}';

		$css[] = 'h1, h2, h3, h4, h5, h6, .f__mont {';
			$css[] = 'font-family: "' . $heading_font['family'] . '";';
			if ( '100italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 100;
					font-style: italic;
				';
			} elseif ( '300italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 300;
					font-style: italic;
				';
			} elseif ( '400italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 400;
					font-style: italic;
				';
			} elseif ( '700italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';
			} elseif ( '900italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 900;
					font-style: italic;
				';
			} elseif ( 'regular' == $heading_font['variant'] ) {
				$css[] = 'font-weight: 400;';
			} elseif ( 'italic' == $heading_font['variant'] ) {
				$css[] = 'font-style: italic;';
			} else {
				$css[] = 'font-weight:' . $heading_font['variant'];
			}
		$css[] = '}';
		
		if ( cs_get_option( 'heading-color' ) ) {
			$css[] = 'h1, h2, h3, h4, h5, h6 {';
				$css[] = 'color:' . cs_get_option( 'heading-color' );
			$css[] = '}';
		}

		if ( cs_get_option( 'h1-font-size' ) ) {
			$css[] = 'h1 { font-size:' . cs_get_option( 'h1-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h2-font-size' ) ) {
			$css[] = 'h2 { font-size:' . cs_get_option( 'h2-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h3-font-size' ) ) {
			$css[] = 'h3 { font-size:' . cs_get_option( 'h3-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h4-font-size' ) ) {
			$css[] = 'h4 { font-size:' . cs_get_option( 'h4-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h5-font-size' ) ) {
			$css[] = 'h5 { font-size:' . cs_get_option( 'h5-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h6-font-size' ) ) {
			$css[] = 'h6 { font-size:' . cs_get_option( 'h6-font-size' ) . 'px; }';
		}

		// Single Post
		if ( cs_get_option( 'single-title-font-size' ) ) {
			$css[] = '.fx-single .post-title { font-size:' . cs_get_option( 'single-title-font-size' ) . 'px; }';
		}

		return implode( '', $css );
	}
}

/**
 * Render page heading for blog list.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_head_blog' ) ) {
	function fx_valey_head_blog() {
		$output = $mask = '';

		// Blog page title background
		$blog_pagehead_bg = cs_get_option( 'blog-pagehead-bg' );
		if ( ! empty( $blog_pagehead_bg['image'] ) ) {
			$mask = ' mask';
		}

		$output .= '<div id="fx-page-head" class="head-blog pt__75 pr tc' . esc_attr( $mask ) . '">';
			$output .= '<div class="fx-container pr">';
				$output .= fx_valey_page_sub_title();
				$output .= fx_valey_page_title();
				$output .= fx_valey_breadcrumb();
			$output .= '</div>';
		$output .= '</div>';

		return apply_filters( 'fx_valey_head_blog', $output );
	}
}

/**
 * Render page heading for single post.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_head_single' ) ) {
	function fx_valey_head_single() {
		$output = '';
		// Get post or page thumbnail
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );

		$output .= '<div id="fx-single-head" class="pr oh">';
			if ( $image ) {
				$output .= '<div class="blur"><img src="' . esc_url( $image[0] ) . '" width="' . esc_attr( $image[1] ) . '" height="' . esc_attr( $image[2] ) . '" alt="' . esc_attr( get_the_title() ) . '" /></div>';
				$output .= '<img src="' . esc_url( $image[0] ) . '" width="' . esc_attr( $image[1] ) . '" height="' . esc_attr( $image[2] ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
			}
		$output .= '</div>';

		return apply_filters( 'fx_valey_head_single', $output );
	}
}

/**
 * Render page heading for page.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_head_page' ) ) {
	function fx_valey_head_page() {
		$output = $mask = $atts = '';

		// Get post or page thumbnail
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );

		if ( $image ) {
			$atts = 'style="background: url(' . esc_url( $image[0] ) . ') no-repeat 10% 10% / cover;"';
			$mask = ' mask';
		}

		$output .= '<div id="fx-page-head" class="pt__75 tc pr' . esc_attr( $mask ) . '" ' . $atts . '>';
			$output .= '<div class="fx-container pr">';
				$output .= fx_valey_page_sub_title();
				$output .= fx_valey_page_title();
				$output .= fx_valey_breadcrumb();
			$output .= '</div>';
		$output .= '</div>';

		return apply_filters( 'fx_valey_head_page', $output );
	}
}