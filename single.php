<?php
$lead = get_field('lead');
$products = get_field('products');
$wideo_post = get_field('wideo_post');
$thumbnail_title = get_field('thumbnail_title');

$tags = get_the_tags();
$tags_popular = false;
if ($tags) {
	$tags_popular = array_slice($tags, 0, 3);
}
get_header();

?>

<div id="page-content" class="single-content">
	<div class="single-content__header nav-up">
		<h2><?php echo esc_html( get_the_title() ); ?></h2>
		<div class="share">
			<p>Udostępnij</p>
				<a onClick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)"><span>+</span>Facebook</a>
			<a href="https://twitter.com/home?status=" target="_blank"><span>+</span>Twitter</a>
			<!-- <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site http://www.website.com."
   title="Share by Email" target="_blank"><span>+</span>Email</a> -->
		</div>
	</div>

	<div class="single-content__wrapper single-content__wrapper<?php echo get_field('recipe') ? '--recipe' : '--no-recipe'; ?>">
		<div class="single-content__wrapper__title">
			<div class="single-content__wrapper__title__above">
				<p><?php echo get_the_category($post->ID)[0]->name; ?></p>
				<p><?php echo get_the_date('d.m.Y') ?></p>
			</div>
			<section class="tagcloud">
			    <div class="tagcloud__wrapper col-sm-12">
			        <?php if(!empty($tags_popular)) : foreach ($tags_popular as $tag) : ?>
			            <a class="btn btn-secondary btn-sm" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
			        <?php endforeach; endif; ?>
			    </div>
			</section>
			<h1>
				<?php echo esc_html( get_the_title() ); ?>
			</h1>
		</div>
		<?php if($lead): ?>
		<div class="single-content__wrapper__lead">
			<h2><?php echo $lead; ?></h2>
		</div>
		<?php endif ?>
		<div class="share">
			<p>Udostępnij</p>
			<a onClick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)"><span>+</span>Facebook</a>
			<a href="https://twitter.com/home?status=" target="_blank"><span>+</span>Twitter</a>
			<!-- <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site http://www.website.com."
   title="Share by Email" target="_blank"><span>+</span>Email</a> -->
		</div>
	</div>
	<div class="single-content__wrapper__post-content-loop">

		<?php get_template_part( 'template-parts/post-content'); ?>
		<div class="single-content__wrapper__post-content-loop__nextprev-nav">
			<?php
				$prev_post = get_next_post( true );
				$next_post = get_previous_post( true );

				if(!empty($next_post) && $next_post->post_title != 'Video post') {
					echo '<a class="single-content__wrapper__post-content-loop__nextprev-nav__next" href="'. get_permalink($next_post->ID) .'">'. $next_post->post_title .'</a>';
				}
				if(!empty($prev_post) && $prev_post->post_title != 'Video post') {
					echo '<a class="single-content__wrapper__post-content-loop__nextprev-nav__prev" href="'. get_permalink($prev_post->ID) .'">'. $prev_post->post_title .'</a>';
				}
			?>
		</div>
	</div>
	<div class="single-content__wrapper single-content__wrapper<?php echo get_field('recipe') ? '--recipe' : '--no-recipe'; ?>">
		<section class="tagcloud">
		    <div class="tagcloud__wrapper col-sm-12">
		        <?php if(!empty($tags)) : foreach ($tags as $tag) : ?>
		            <a class="btn btn-secondary btn-sm" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
		        <?php endforeach; endif; ?>
		    </div>
		</section>
		<div class="share">
			<p>Udostępnij</p>
			<a onClick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)"><span>+</span>Facebook</a>
			<a href="https://twitter.com/home?status=" target="_blank"><span>+</span>Twitter</a>
			<!-- <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site http://www.website.com."
   title="Share by Email" target="_blank"><span>+</span>Email</a> -->
		</div>

		<br><br>
		<a class="pdf-button" href="<?php echo get_permalink().'/pdf'; ?>" target="_blank">
			<button><img src="/blog/wp-content/themes/--usuniete--blog/images/pdf.png" alt="">Pobierz PDF</button>
		</a>

	</div>
	<?php if($products): ?>
		<?php get_template_part('template-parts/products'); ?>
	<?php endif; ?>
	<?php
	comments_template('/template-parts/custom-comments.php')
	?>
	<?php related_posts(); ?>
</div>
<?php get_footer(); ?>
