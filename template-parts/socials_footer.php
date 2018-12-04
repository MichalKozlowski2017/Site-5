<?php $social_media_links = get_field('social_media_links_footer', 'option'); ?>
<?php if($social_media_links) : ?>
    <div class="socials">
        <ul>
        <?php foreach($social_media_links as $index => $link): ?>
            <li>
                <a href="<?php echo $link['link'] ?>" target="_blank">
                    <img src="<?php echo $link['image']; ?>" alt="<?php echo $link['alt'] ?>">
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
