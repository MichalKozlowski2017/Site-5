<?php get_header() ?>
<?php

$tagi = get_tags([
    'orderby' => 'count',
    'order' => 'DESC',
    'hide_empty' => false
]);
$post_ids = array();

$s = get_search_query();
$args = array( 's' =>$s );
    // The Query
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
   $post_ids[] = $post->ID; // Build array of post IDs
endwhile; wp_reset_query();
?>
<?php if(empty($post_ids) || !$s): ?>
    <div id="page-content" class="search-content">
        <div class="search-content__text">
            <br><br>
            <div class="search-content__text__title">NIE ZNALAZŁEŚ CZEGO SZUKASZ?:</div>
            <div class="search-content__text__subtitle">MOŻE ZAINTERESUJĄ CIĘ INNE TEMATY:</div>
            <div class="search-content__text__tags">
                <br>
                <p>Popularne tagi:</p>
                <section class="tagcloud">
    			    <div class="tagcloud__wrapper">
    			        <?php if(!empty($tagi)) : foreach ($tagi as $tag) : ?>
    			            <a class="btn btn-secondary btn-sm" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
    			        <?php endforeach; endif; ?>
    			    </div>
    			</section>
            </div>
        </div>
    </div>
<?php else: ?>
<div id="page-content" class="search-content">
    <div class="search-content__text">
        <div class="search-content__text__title">Wyniki wyszukiwania:</div>
        <?php if($s): ?>
        <div class="search-content__text__term"><?php echo $s; ?></div>
        <div class="search-content__text__count">
            <p>Znaleziono: <span><?php echo count($post_ids); ?><?php echo (count($post_ids) > 1 ? ' ARTYKUŁÓW' : ' ARTYKUŁ');  ?></span></p>
        </div>
    <?php endif; ?>
    </div>

	<?php echo do_shortcode('[ajax_load_more id="masonry-loop" container_type="div" post_type="post" posts_per_page="-1" scroll="false" transition="masonry" masonry_selector=".masonry-entry" images_loaded="true" masonry_horizontalorder="false" button_label="Więcej postów" button_loading_label="Ładuję posty" post__in="'. implode(',', array_reverse($post_ids)) .'" orderby="post__in"]'); ?>

    <div class="search-content__text">
        <div class="search-content__text__title">NIE ZNALAZŁEŚ CZEGO SZUKASZ?:</div>
        <div class="search-content__text__subtitle">MOŻE ZAINTERESUJĄ CIĘ INNE TEMATY:</div>
        <div class="search-content__text__tags">
            <p>Popularne tagi:</p>
            <section class="tagcloud">
			    <div class="tagcloud__wrapper">
			        <?php if(!empty($tagi)) : foreach ($tagi as $tag) : ?>
			            <a class="btn btn-secondary btn-sm" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
			        <?php endforeach; endif; ?>
			    </div>
			</section>
        </div>
    </div>
</div>
<?php endif; ?>
<?php get_footer() ?>
