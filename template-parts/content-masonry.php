<article class="masonry-entry" id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background: url('<?php echo get_the_post_thumbnail_url() ?>')" >
<?php if ( has_post_thumbnail() ) : ?>
    <div class="masonry-thumbnail">
        <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"></a>
    </div><!--.masonry-thumbnail-->
<?php endif; ?>
    <div class="masonry-details">
        <h5><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><span class="masonry-post-title"> <?php the_title(); ?></span></a></h5>
    </div><!--/.masonry-entry-details -->
</article><!--/.masonry-entry-->
