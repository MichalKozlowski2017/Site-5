		<?php
		$footer_text = get_field('footer_text', 'option');
		$footer_copy_text = get_field('footer_copy_text', 'option');
		?>
		<footer id="page-footer" class="page-footer <?php echo (is_home()) ? 'page-footer--extra-padding' : ''; ?>" >
			<?php if (is_single()): ?>
			<div class="back-to-top">
			Powrót <br>do góry
			</div>
		<?php endif; ?>
			<?php wp_nav_menu(array(
				'theme_location' => 'footer-nav',
				'container'      => 'nav',
				'container_id'   => 'footer-nav'
			)) ?>
			<div class="page-footer__text">
				<?php echo $footer_text; ?>
				<p><?php echo $footer_copy_text; ?></p>
			</div>
			<?php get_template_part('template-parts/socials_footer'); ?>
		</footer>
		<?php if(is_home()): ?>
		<div class="mobile-fixed-cat-nav">
			<?php get_subcategory_nav($post->ID); ?>
		</div>
		<?php endif; ?>

		<div class="dark-overlay"></div>



		<script type="text/javascript">
		var listonic_bw_type = "generic";
		var listonic_bw_generic_entryClass = "listonic"; //here goes DOM ID of element that encloses ingredients
		var listonic_hideSideBar = true;
		</script>

		<script src="https://s3-eu-west-1.amazonaws.com/buttons.listonic.pl/v1/blogwidget.js" charset="UTF-8"></script>
		<?php wp_footer(); ?>
		<?php if(is_single() || is_tag()): ?>
		<div class="prev-page-btn">
			<?php
			$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
			$back_id = url_to_postid($_SERVER['HTTP_REFERER']);
			if( $back_id > 0 ){
				$back_title = get_the_title( $back_id );
				echo "<a href='{$url}'>Powrót do artykułu: <br>{$back_title}</a>";
			} else if ((strpos($url, '/?s='))) {
			    echo "<a href='{$url}'>Powrót do: <br>strony wyszukiwania</a>";
		    } else if ((strpos($url, 'posilek/')) && !strpos($url, 'kategoria=')) {
				echo "<a href='{$url}'>Powrót do: <br>strony głównej</a>";
			} else if ((strpos($url, 'kategoria='))) {
				echo "<a href='{$url}'>Powrót do: <br>sfiltrowanej kategorii</a>";
			} else if ((strpos($url, '/tag'))) {
			    echo "<a href='{$url}'>Powrót do: <br>widoku tagu</a>";
		    } else if ($url == get_home_url().'/') {
			    echo "<a href='{$url}'>Powrót do: <br>strony głównej</a>";
			}
			?>
		</div>
		<?php endif; ?>
  
	</body>
</html>
