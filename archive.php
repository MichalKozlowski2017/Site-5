<?php get_header(); ?>
<div id="page-content" class="page-content archive main-content">
	<?php echo do_shortcode('[ajax_load_more id="masonry-loop" container_type="div" post_type="post" posts_per_page="10" scroll="false" transition="masonry" masonry_selector=".masonry-entry" masonry_horizontalorder="false" button_label="Więcej postów" button_loading_label="Ładuję posty" category="'. get_the_category($post->ID)[0]->name .'"]'); ?>
</div>
<?php get_footer(); ?>
