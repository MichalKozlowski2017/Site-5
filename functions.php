<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
function theme_enqueue_scripts(){

	wp_enqueue_script('jQuery', get_bloginfo('template_url') . '/js/vendor/jquery/jquery.js', null, null, true);

	wp_register_script('slick-carousel', get_bloginfo('template_url') . '/js/vendor/slick-carousel/slick/slick.min.js', null, false, true);
	wp_enqueue_script('slick-carousel');

	wp_register_script('modernizr', get_bloginfo('template_url') . '/js/modernizr.js');
	wp_enqueue_script('modernizr');




	// wp_register_script('require', get_bloginfo('template_url') . '/js/vendor/requirejs/require.js', array(), false, true);
	// wp_enqueue_script('require');

	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'masonry', '//cdnjs.cloudflare.com/ajax/libs/masonry/4.1.1/masonry.pkgd.min.js' );

	wp_enqueue_script( 'isotope' );
	wp_enqueue_script( 'isotope', get_bloginfo('template_url') . '/js/isotope.pkgd.min.js' );

	wp_enqueue_script( 'jquery-validate' );
	wp_enqueue_script( 'jquery-validate', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js' );

	wp_register_script('global', get_bloginfo('template_url') . '/js/global.js', array(), false, true);
	wp_enqueue_script('global');

	// wp_enqueue_script( 'listonic' );
	// wp_enqueue_script( 'listonic', 'https://s3-eu-west-1.amazonaws.com/buttons.listonic.pl/v1/blogwidget.js' );

	wp_register_script('livereload', 'http://--usuniete---blog.test:35729/livereload.js?snipver=1', null, false, true);
	wp_enqueue_script('livereload');

	wp_enqueue_style('animate', get_bloginfo('template_url') . '/css/media/animate.css');
	wp_enqueue_style('slick-css', get_bloginfo('template_url') . '/js/vendor/slick-carousel/slick/slick.css');
	wp_enqueue_style('slick-theme', get_bloginfo('template_url') . '/js/vendor/slick-carousel/slick/slick-theme.css');
	wp_enqueue_style('global', get_bloginfo('template_url') . '/css/global.css');
}

//Add Featured Image Support
add_theme_support('post-thumbnails');

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

function register_menus() {
	register_nav_menus(
		array(
			'main-nav' => 'Main Navigation',
			'category-nav' => 'Category Navigation',
			'mobile-category-nav' => 'Mobile Category Navigation',
			'mobile-other-nav' => 'Mobile Other Navigation',
			'footer-nav' => 'Footer Navigation'
		)
	);
}
add_action( 'init', 'register_menus' );

// ACF Options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}
// Custom logo link
add_filter( 'get_custom_logo', 'wecodeart_com' );
function wecodeart_com() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $html = sprintf( '<a href="https://--usuniete--.pl" class="custom-logo-link" rel="home" itemprop="url" target="_blank">%2$s</a>',
            get_home_url(),
            wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                'class'    => 'custom-logo',
            ) )
        );
    return $html;
}

add_image_size('post-image', 1000, 9999, false);
add_image_size('post-image-small', 500, 9999, false);
add_image_size('ekspert-image', 480, 264, true);

// add_action( 'init', 'create_produkt_post_type' );
// function create_produkt_post_type() {
// 	register_post_type( 'produkt',
// 		array(
// 			'labels' => array(
// 				'name' => __( 'Produkty', '--usuniete--blog' ),
// 				'singular_name' => __( 'Produkt', '--usuniete--blog' )
// 			),
// 			'menu_icon' => 'dashicons-products',
// 			'public' => true,
// 			'has_archive' => false,
// 			'publicaly_queryable' => false,
// 			'query_var' => false,
// 			'supports' => array('title', 'editor', 'thumbnail'),
// 		)
// 	);
// }

// Related posts
function related_posts() {

   $post_id = get_the_ID();
   $cat_ids = array();
   $categories = get_the_category( $post_id );
   if ( $categories && ! is_wp_error( $categories ) ) {
	   foreach ( $categories as $category ) {
		   array_push( $cat_ids, $category->term_id );
	   }
   }

   $current_post_type = get_post_type( $post_id );
   $current_post_date = get_the_date( 'Y-m-d H:i:s');

   $args = array(
	   'category__in' => '4',
	   'post_type' => $current_post_type,
	   'date_query' => array(
		   array(
			'after' => $current_post_date,
			'inclusive' => true,
		   ),
		),
	   'posts_per_page' => '3',
	   'post__not_in' => array( $post_id ),
	   'orderby' => 'date',
		'order'   => 'ASC',
	   
	
   );
   $query = new WP_Query( $args );

   if ( $query->have_posts() ) {

	   ?>
	   		<div class="single-content__wrapper single-content__wrapper--recipe">
				<section class="related-posts">
					<h3>
						<?php _e( 'Podobne artykuły', '--usuniete--blog' ); ?>
					</h3>
					<div id="masonry-loop" class="masonry-loop">
					<div class="grid-sizer"></div>
					<?php
					   while ( $query->have_posts() ) {
						   $query->the_post();
						   ?>
						   <article class="masonry-entry" id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background: url('<?php echo get_the_post_thumbnail_url() ?>')" >
							<a href="<?php the_permalink(); ?>" class="post-link"></a>
						   <div class="masonry-entry__main-category">
								 <?php
            		$catcur = get_the_terms( get_the_ID(), 'posilek' );
    for( $i= 0 ; $i < count($catcur) ; $i++ )
    {
     if ($catcur[$i]->slug != 'posilku') {
         echo $catcur[$i]->description;
     } else {
         echo '';
     }
    }
            	?>
						   </div>
						   <?php if(get_field('thumbnail_title')): ?>
							   <h2><?php echo get_field('thumbnail_title'); ?></h2>
						   <?php endif; ?>
						   <?php if(!get_field('wideo_post')): ?>
							   <div class="masonry-details">
								   <h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="masonry-post-title"> <?php the_title(); ?></span></a></h5>
								   <div class="masonry-details__category">
									   <?php
										   $category_id = get_cat_ID(get_the_category($post->ID)[0]->name);
										   $category_link = get_category_link( $category_id );
									   ?>
									   <p><a href="<?php echo esc_url( $category_link ); ?>"><?php echo get_the_category($post->ID)[0]->name; ?></a></p>
									   <p><?php echo get_the_date('d.m.Y') ?></p>
								   </div>
							   </div><!--/.masonry-entry-details -->
						   <?php endif; ?>
						   </article><!--/.masonry-entry-->

						   <?php
					   }
				   ?>
				   </div>

			   </section>
		   </div>
		   <div class="clearfix">


		   </div>

   <?php
}
wp_reset_postdata();
}
if (! function_exists('slug_scripts_masonry') ) :
	if ( ! is_admin() ) :
		function slug_scripts_masonry() {
		    wp_enqueue_script('masonry');
		}
		add_action( 'wp_enqueue_scripts', 'slug_scripts_masonry' );
	endif; //! is_admin()
endif; //! slug_scripts_masonry exists


add_filter( 'wpsp_ajax_load_more','wpsp_change_load_more' );
function wpsp_change_load_more()
{
    return 'Whatever';
}

// comments
function --usuniete--_blog_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comments__comment-list__comment-meta vcard">
			<?php
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] );
            }
				echo '<p>'. get_comment_author() .'</p>';
				if (!empty(get_comment_author_url())) {
					$author_url = get_comment_author_url();
					$to_remove = array( 'http://', 'https://', '/' );
					foreach ( $to_remove as $item ) {
					    $author_url = str_replace($item, '', $author_url); // to: www.example.com
					}
					echo '<p>, '. $author_url .'</p>';
				}
			?>
        </div>
		<div class="comments__comment-list__comment-meta__comment-date">
			<p>
			<?php
			echo get_comment_date('d M Y, l');
			echo ', '. get_comment_time();

			?>
			</p>
		</div>
		<?php
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
        } ?>

		<div class="comments__comment-list__comment-text">
        <?php comment_text(); ?>
		</div>
        <div class="reply"><?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => $add_below,
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth']
                        )
                    )
                ); ?>
        </div><?php
    if ( 'div' != $args['style'] ) : ?>
        </div><?php
    endif;
}

function comment_validation_init() {
    if(is_single() && comments_open() ) { ?>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
    $('#form_comment').validate({

    rules: {
      author: {
        required: true,
        minlength: 2
      },

      email: {
        required: true,
        email: true
      },

      comment: {
        required: true,
        minlength: 1
      }
    },

    messages: {
      author: "Proszę podać imię.",
      email: "Nieprawidłowy format email.",
      comment: "Proszę wpisać komentarz."
    },

    errorElement: "div",
    errorPlacement: function(error, element) {
      error.insertAfter(element);
	  $(element).closest("input").addClass("comment-error");
	  $(element).closest("textarea").addClass("comment-error");
    }

    });
    });
    </script>
    <?php
    }
}
    add_action('wp_footer', 'comment_validation_init');


function textarea_resize() {
if(is_single() && comments_open() ) { ?>
	<script>

	document.addEventListener("DOMContentLoaded", function() {
		var textarea = document.querySelector('textarea');

			textarea.addEventListener('keydown', autosize);

			function autosize(){
				var el = this;
				setTimeout(function(){
					el.style.cssText = 'height:auto; padding:10';
					// for box-sizing other than "content-box" use:
					// el.style.cssText = '-moz-box-sizing:content-box';
					el.style.cssText = 'height:' + el.scrollHeight + 'px';
				},0);
			}
	});
	</script>
    <?php
    }
}
add_action('wp_enqueue_scripts', 'textarea_resize');


//Active menu class
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


function blog_title_form ($tax) {
	switch ($tax->slug) {
		case 'lunch':
			echo 'ANATOMIA ZDROWEGO ';
			break;
		case 'kolacja':
			echo 'ANATOMIA ZDROWEJ ';
			break;
		case 'obiad':
			echo 'ANATOMIA ZDROWEGO ';
			break;
		case 'posilek':
			echo 'ANATOMIA ZDROWEGO ';
			break;
		case 'przekaska':
			echo 'ANATOMIA ZDROWEJ ';
			break;
		case 'sniadanie':
			echo 'ANATOMIA ZDROWEGO ';
			break;
		case 'posilku':
			echo 'ANATOMIA ZDROWEGO ';
			break;

		default:
			// code...
			break;
	}
}




flush_rewrite_rules();
function add_custom_taxonomies() {
	register_taxonomy('posilek', 'post', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Posilek', 'taxonomy general name' ),
			'singular_name' => _x( 'Posiłek', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Posiłek' ),
			'all_items' => __( 'All Posiłki' ),
			'parent_item' => __( 'Parent Posiłku' ),
			'parent_item_colon' => __( 'Parent Posiłku:' ),
			'edit_item' => __( 'Edit Posiłek' ),
			'update_item' => __( 'Update Posiłek' ),
			'add_new_item' => __( 'Dodaj nowy Posiłek' ),
			'new_item_name' => __( 'New Posiłek Name' ),
			'menu_name' => __( 'Posiłki' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'posilek',
			'with_front' => true,
			'hierarchical' => true
		),
	));
}
add_action( 'init', 'add_custom_taxonomies', 0 );

function get_category_nav($post_id, $echo = true) {
	$terms = get_terms('posilek');
	$currentTerm = array_shift(get_the_terms($post_id, 'posilek'));
	// $html = '<span class="page-header__wrapper__left__title__dropdown"><span id="curCat">'.$currentTerm->name.'</span>';
	$html = '<div class="page-header__wrapper__left__title__dropdown__category-menu">';
	$html .= '<nav id="category-nav" class="menu-category-menu-container">';
	$html .= '<ul id="menu-category-menu-1" class="menu">';
	foreach($terms as $term) {
		if ($currentTerm->term_id == $term->term_id) {
			$class = 'current-menu-item active';
		} else {
			$class = '';
		}
		$html .= '<li class="menu-item menu-item-type-taxonomy menu-item-object-posilek '.$class.'">';
		$html .= '<a href="'. get_site_url() .'/posilek/'.$term->slug.'">'.$term->name.'</a>';
		$html .= '</li>';
	}
	$html .= '</ul>';
	$html .= '</nav>';
	$html .= '</div>';
	$html .= '</span>';
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function get_subcategory_nav($post_id, $echo = true) {
	if (!is_tag()) {
		$categories = get_categories(['exclude' => 1]);

		$base = get_home_url();
		if (is_single() || is_tax() || is_page()) {
			$base = get_term_link(array_shift(get_the_terms($post_id, 'posilek')));
		}
		$links = [];
		foreach ($categories as $category) {
			$links[] = $base.'?kategoria='.$category->category_nicename;
		}
		$html = '<nav id="primary-nav" class="menu-menu-kategorie-container">';
		$html .= '<ul id="menu-menu-kategorie" class="menu">';
		$class = '';
		if (empty(array_pop(explode('=', $_SERVER['QUERY_STRING'])))) {
			$class = 'current-menu-item active';
		}
		$html .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home '.$class.'">';
		$html .= '<a href="'.$base.'">Wszystkie</a>';
		$html .= '</li>';
		foreach ($categories as $index => $category) {
			if (array_pop(explode('=', $_SERVER['QUERY_STRING'])) == $category->category_nicename) {
	            $class = 'current-menu-item active';
	        } else {
	            $class = '';
	        }
	        $html .= '<li class="menu-item menu-item-type-taxonomy menu-item-object-category '.$class.'">';
	        $html .= '<a href="'.$links[$index].'">'.$category->cat_name.'</a>';
	        $html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '</nav>';
		if ($echo) {
			echo $html;
		} else {
			return $html;
		}
	}
}
