<?php if (have_posts()):?>
	<div id="masonry-loop" class="masonry-loop">

	<?php $count = 1; ?>
	<div class="grid-sizer"></div>
	<?php while (have_posts()) : the_post() ?>
		<article class="masonry-entry box-<?php echo $count; ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background: url('<?php echo get_the_post_thumbnail_url() ?>')" >
		<?php if(!get_field('wideo_post')): ?>
		<a href="<?php the_permalink(); ?>" class="post-link"></a>
		<?php endif; ?>
		<?php if(get_field('wideo_post')): ?>
			<video autoplay loop id="video-background" muted plays-inline>
  			<source src="<?php echo get_field('wideo'); ?>" type="video/mp4">
			</video>
	<?php endif; ?>
		<div class="masonry-entry__main-category">
			LUNCH <h2><?php echo $count; ?></h2>
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
	<?php $count++; ?>
	<?php
		if ($count >= 11) {
			$count = 1;
		}
	?>
	<?php endwhile; ?>

	</div>
<?php else: ?>
	<p>Nie odnaleziono żadnych postów.</p>
<?php  endif; ?>

<div class="clearfix"></div>
