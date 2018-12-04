<?php
	// $cookies = ['comment_author', 'comment_author_email', 'comment_author_url'];
	// foreach($cookies as $item) {
	// 	$$item = $_COOKIE[$item];
	// }
?>
<div class="single-content__wrapper comments single-content__wrapper<?php echo get_field('recipe') ? '--recipe' : '--no-recipe'; ?>">
<?php
$comments_count = wp_count_comments($post->ID);
$comment_title = substr(get_the_title(), 0, 10);
?>
<div class="comments__title">
	<h2><?php echo ($comments_count->approved == 0 ? 'Brak' : $comments_count->approved); ?> Odpowiedzi do <?php echo '"'.mb_substr(get_the_title(),0,22). '..."'; ?></h2>
</div>

<?php if (have_comments()): ?>
	<ul id="comment-list" class="comments__comment-list">
		<?php wp_list_comments( 'type=comment&callback=--usuniete--_blog_comment' ); ?>
	</ul>
	<div class="comments-navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
 <?php else: // this is displayed if there are no comments so far ?>
	<?php if (comments_open()): ?>
		<p>Ten artykuł nie posiada komentarzy.</p>
	 <?php else: // comments are closed ?>
		<p>Brak możliwości komentowania.</p>
	<?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ): ?>
	<div class="comments__comment-form-container">
		<h2 class="comments__comment-form-container__comment-form-title"><?php comment_form_title( 'Skomentuj', 'Skomentuj %s' ); ?></h2>
		<div class="comments__comment-form-container__comment-form-note">
			<p>Twój adres email nie zostanie opublikowany.</p>
			<p>Pola, których wypełnienie jest wymagane, są oznaczone symbolem *</p>
		</div>
		<div class="cancel-comment_reply">
			<?php cancel_comment_reply_link() ?>
		</div>
		<?php if (get_option('comment_registration') and !is_user_logged_in()): ?>
			<p>You must be <a href="<?= wp_login_url(get_permalink()) ?>">logged in</a> to post a comment.</p>
		<?php else: ?>
		<form action="<?= get_option('siteurl') ?>/wp-comments-post.php" method="post" class="comment-form" id="comment_form">
			<?php if (is_user_logged_in()): ?>
				<p>Zalogowany jako <a href="<?= get_option('siteurl') ?>/wp-admin/profile.php"><?= $user_identity ?></a>. <a href="<?= wp_logout_url(get_permalink()) ?>" title="Log out of this account">Log out &raquo;</a></p>
			<?php else : ?>
				<div class="input-wrap comments__comment-form-container__message textarea<?= ($req) ? ' required' : ''?>">
					<label for="input-comment">Twój komentarz:</label>
					<textarea name="comment" id="input-comment"></textarea>
				</div>
				<div class="input-wrap text<?= ($req) ? ' required' : ''?>">
					<label for="input-author">Podpis:<sup>*</sup></label>
					<input type="text" name="author" id="input-author" value="<?= esc_attr($comment_author) ?>"<?= ($req) ? ' aria-required="true"' : '' ?> />
				</div>
				<div class="input-wrap text<?= ($req) ? ' required' : ''?>">
					<label for="input-email">E-mail:<sup>*</sup></label>
					<input type="text" name="email" id="input-email" value="<?= esc_attr($comment_author_email) ?>"<?= ($req) ? ' aria-required="true"' : '' ?> />
				</div>
				<div class="input-wrap text<?= ($req) ? ' required' : ''?>">
					<label for="input-url">Witryna internetowa:</label>
					<input type="text" name="url" id="input-url" value="<?= esc_attr($comment_author_url) ?>" />
				</div>
				<div class="input-wrap checkbox">
					<input type="checkbox" name="wp-comment-cookies-consent" id="input-cookie" value="checked" />
					<label for="input-cookie">Pamiętaj moje dane w tej przeglądarce podczas pisania kolejnych komentarzy.</label>
				</div>

			<?php endif; ?>

			<div class="input-wrap submit">
				<input class="button" type="submit" value="Opublikuj komentarz" />
				<?php comment_id_fields() ?>
			</div>
			<?php do_action('comment_form', $post->ID) ?>
		</form>
		<?php endif; ?>
	</div>
<?php endif; ?>
</div>
