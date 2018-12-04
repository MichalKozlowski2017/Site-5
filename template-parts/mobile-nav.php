<?php
$tagi = get_tags([
    'orderby' => 'count',
    'order' => 'DESC',
    'hide_empty' => false
]);
?>

<div class="mobile-nav">
    <div class="mobile-nav__wrapper">
        <h2>Anatomia zdrowego...</h2>
        <div class="mobile-nav__wrapper__main-category-nav">
            <p>Posiłku:</p>
            <?php wp_nav_menu(array(
                'theme_location' => 'mobile-category-nav',
                'container'      => 'nav',
                'container_id'   => 'mobile-category-nav'
            )) ?>
        </div>
        <div class="mobile-nav__wrapper__second-category-nav">
            <p>Kategorie:</p>
            <?php $categories = get_categories(['exclude' => 1]); ?>
            <nav id="mobile-primary-nav">
                <ul class="menu">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-43"><a href="<?php echo "http://$_SERVER[HTTP_HOST]".strtok($_SERVER[REQUEST_URI], '?') ?>">Wszystkie</a></li>
                    <?php foreach ($categories as $category) : ?>
                        <?php
                            if (array_pop(explode('=', $_SERVER['QUERY_STRING'])) == $category->category_nicename) {
                                $class = 'current-menu-item active';
                            } else {
                                $class = '';
                            }
                            ?>
                        <li class="menu-item menu-item-type-taxonomy menu-item-object-category <?php echo $class; ?>"><a href="<?php echo "http://$_SERVER[HTTP_HOST]".strtok($_SERVER[REQUEST_URI], '?')."?kategoria=$category->category_nicename"; ?>"><?php echo $category->cat_name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
        <div class="mobile-nav__wrapper__tags">
            <p>Popularne tagi:</p>
            <section class="tagcloud">
			    <div class="tagcloud__wrapper">
			        <?php if(!empty($tagi)) : foreach ($tagi as $tag) : ?>
			            <a class="btn btn-secondary btn-sm" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
			        <?php endforeach; endif; ?>
			    </div>
			</section>
        </div>
        <div class="mobile-nav__wrapper__footer-menu">
            <p>
                więcej:
            </p>
            <?php wp_nav_menu(array(
				'theme_location' => 'mobile-other-nav',
				'container'      => 'nav',
				'container_id'   => 'mobile-other-nav'
			)) ?>
        </div>
        <div class="mobile-nav__wrapper__footer">
            <p>
                Odwiedź nas na:
            </p>
            <?php get_template_part('template-parts/socials'); ?>
            <div class="mobile-nav__wrapper__footer__search" id="mobile-search">
                <p>SZUKAJ</p><img src="/blog/wp-content/themes/--usuniete--blog/images/search.png" alt="SZUKAJ">
            </div>
        </div>
    </div>
</div>
