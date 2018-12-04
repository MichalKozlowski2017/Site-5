<?php
if (is_tax()){
    $tax = $wp_query->get_queried_object();
} elseif (is_single()) {
    // $tax = array_shift(get_the_terms($post->ID, 'posilek'));
    $tax = get_the_terms( get_the_ID(), 'posilek' )[1];
} else {
    $tax = get_field('main_category', 'option');
}
$catcur = get_the_terms( get_the_ID(), 'posilek' );
?>
<?php get_template_part('template-parts/mobile-nav'); ?>
<header id="page-header" class="page-header overflow-hidden-header">
    <div class="page-header__wrapper">
        <div class="page-header__wrapper__left">
            <div id="page-logo" class="page-header__wrapper__left__logo">
                <a href="<?php echo get_home_url(); ?>" title="<?php bloginfo('name') ?> - <?php bloginfo('description') ?>">
                    <?php the_custom_logo() ?>
                </a>
            </div>
            <div class="page-header__wrapper__left__title">
                <?php if(is_tag() || is_page() || is_search()): ?>
                <h1><a href="<?php echo get_home_url(); ?>">ANATOMIA ZDROWEGO </a><br>
                    <span class="page-header__wrapper__left__title__dropdown">
                        <span id="curCat">POSIŁKU</span>
                        <div class="page-header__wrapper__left__title__dropdown__category-menu">
                            <?php get_category_nav($post->ID); ?>
                        </div>
                    </span>
                </h1>
              <?php elseif(is_single()): ?>
              <h1><a href="<?php echo get_home_url(); ?>"><?php blog_title_form($tax); ?></a><br>
                  <span class="page-header__wrapper__left__title__dropdown"><span id="curCat">
                    <?php
                    $catcur = get_the_terms( get_the_ID(), 'posilek' );
                    for( $i= 0 ; $i < count($catcur) ; $i++ )
                    {
                     if ($catcur[$i]->slug != 'posilku') {
                       echo $catcur[$i]->name;
                     } else {
                       echo '';
                     }
                    }
                    ?>
                  </span>
                  <?php get_category_nav($post->ID); ?>
              </h1>
                <?php else: ?>
                <h1><a href="<?php echo get_home_url(); ?>"><?php blog_title_form($tax); ?></a><br>
                    <span class="page-header__wrapper__left__title__dropdown"><span id="curCat"><?php echo $tax->name; ?></span>
                    <?php get_category_nav($post->ID); ?>
                </h1>
                <?php endif; ?>
            </div>
            <?php if(is_tag() || is_page() || is_search()): ?>
            <?php else: ?>
                <?php get_subcategory_nav($post->ID); ?>
            <?php endif; ?>

        </div>
        <div class="page-header__wrapper__right">
            <?php
                $social_media_links = get_field('social_media_links', 'option');
            ?>
            <p class="page-header__wrapper__right__hash">
              <a href="https://--usuniete--.pl/zdrowaradosczycia/" target="_blank">
                #ZdrowaRadoscZycia
              </a>
            </p>
            <a href="" class="page-header__wrapper__right__search-btn"></a>
        </div>
        <div class="clearfix"></div>
        <div class="page-header__wrapper__search">
            <?php get_search_form(); ?>
        </div>
    </div>


</header>
<button class="hamburger hamburger--collapse page-header__hamburger" type="button">
    <span class="hamburger-box">
        <span class="hamburger-inner">
        </span>
    </span>
</button>
