<?php $text_content = get_sub_field('text_content'); ?>
<div class="single-content__wrapper single-content__wrapper<?php echo get_field('recipe') ? '--recipe' : '--no-recipe'; ?>">
    <?php echo get_field('recipe') ? '<div class="text-content-recipe-wrapper">' : ''; ?>
    <section class="text-content">
        <?php echo $text_content; ?>
    </section>

    <?php
    if (get_field('recipe')) {
        get_template_part( 'template-parts/recipe');
    }

    ?>
    <?php echo get_field('recipe') ? '</div>' : ''; ?>
</div>
