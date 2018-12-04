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

<?php endif; ?>
<div class="comments__comment-form-container">
<?php
$comments_args = array(
    // change the title of send button
    'label_submit'=> esc_html(__('Opublikuj komentarz','--usuniete--blog')),
	'class_submit' => 'button',
    // change the title of the reply section
    'title_reply' => '<h2 class="comments__comment-form-container__comment-form-title">Skomentuj:</h2>',
	'comment_notes_before' => '<div class="comments__comment-form-container__comment-form-note">
			<p>Twój adres email nie zostanie opublikowany.</p>
			<p>Pola, których wypełnienie jest wymagane, są oznaczone symbolem *</p>
		</div>',
    // redefine your own textarea (the comment body)
    'comment_field' => '
    <div class="input-wrap">
		<label>Twój komentarz:</label>
		<div class="input-field">
			<textarea class="materialize-textarea" type="text" rows="5" id="textarea1" name="comment" aria-required="true"></textarea>
		</div>
	</div>',

	'id_form' => 'form_comment',

    'fields' => apply_filters( 'comment_form_default_fields', array(
        'author' =>'' .
          '<div><div class="input-wrap">' .
		  '<label>Podpis:*</label>'.
          '<input class="validate" id="name" name="author" placeholder="'. esc_attr(__('','--usuniete--blog')) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
          '" size="30"' . $aria_req . ' /></div></div>',

        'email' =>'' .
          '<div><div class="input-wrap">' .
		  '<label>E-mail:*</label>'.
          '<input class="validate" id="email" name="email" placeholder="'. esc_attr(__('','--usuniete--blog')) .'" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
          '" size="30"' . $aria_req . ' /></div></div>',

        // 'url' =>'' .
        //   '<div class="input-wrap">'.
		//   '<label>Witryna internetowa:</label>'.
        //   '<div><div class="input-wrap"><input class="validate" placeholder="'. esc_attr(__('','--usuniete--blog')) .'" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        //   '" size="30" /></div></div>',

// Now we will add our new privacy checkbox optin

        'cookies' => ''.
		'<div class="input-wrap">'.
	     '<label class="input-wrap checkbox-container" for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.' ) . '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
 		'<span class="checkmark"></span></label></div>',
        )
    ),
);

    comment_form($comments_args);   ?>
</div>

</div>
</div>
