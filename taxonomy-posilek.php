<?php
get_header() ?>
<?php

$tags = get_tags([
    'orderby' => 'count',
    'order' => 'DESC',
    'hide_empty' => false
]);

$post_ids = array();
$tax = $wp_query->get_queried_object();
$args = array(
   'post_type'           => array('post'), // Posts
   'orderby'   			 => 'menu_order',
   'posts_per_page'      => -1, // get all posts
   'ignore_sticky_posts' => true, // Do not preserve order of stickies
);
$the_query = new WP_Query( $args );

while ( $the_query->have_posts() ) : $the_query->the_post();
   $post_ids[] = $post->ID; // Build array of post IDs
endwhile; wp_reset_query();

$category_slug = '';
if (isset($_GET['kategoria'])) {
	$category_slug = $_GET['kategoria'];
}

 ?>
<div id="page-content" class="main-content">
    <section class="tagcloud">
	    <div class="tagcloud__wrapper col-sm-12">
	        <?php foreach ($tags as $tag) : ?>
	            <a class="btn btn-secondary btn-sm" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
	        <?php endforeach; ?>
	    </div>
	</section>
	<?php echo do_shortcode('[ajax_load_more id="masonry-loop" container_type="div" post_type="post" posts_per_page="10" scroll="false" transition="masonry" masonry_selector=".masonry-entry" images_loaded="true" masonry_horizontalorder="false" button_label="Więcej postów" button_loading_label="Ładuję posty" category="'. $category_slug .'" taxonomy="'. $tax->taxonomy .'" taxonomy_terms="'. $tax->slug .'" post__in="'. implode(',', array_reverse($post_ids)) .'" orderby="post__in"]'); ?>
</div>
<?php get_footer() ?>
