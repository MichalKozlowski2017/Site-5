<?php /* Template Name: O blogu */
    get_header();

?>
<div id="page-content" class="single-content single-content oblogu">
    <div class="single-content__wrapper single-content__wrapper--no-recipe oblogu__wrapper">
        <div class="oblogu__wrapper__title">
            <h2><?php echo get_the_title(); ?></h2>
        </div>
        <?php
            if( have_rows('content') ):
                 // loop through the rows of data
                while ( have_rows('content') ) : the_row();
                    if( get_row_layout() == 'lead' ):
                        $lead = get_sub_field('lead');
                        $image = get_sub_field('image');
                        $podpis_pod_zdjeciem = get_sub_field('podpis_pod_zdjeciem'); ?>

                        <div class="oblogu__wrapper__lead">
                            <h4><?php echo $lead; ?></h4>
                        </div>
                    </div>
                </div>
                        <div class="oblogu__wrapper__image">
                            <img src="<?php echo $image['sizes']['post-image']; ?>" alt="<?php echo get_the_title(); ?>">
                            <p><?php echo $podpis_pod_zdjeciem; ?></p>
                        </div>
                <div class="single-content__wrapper single-content__wrapper--no-recipe oblogu__wrapper">
                    <div class="oblogu__wrapper__title">
                        <?php elseif( get_row_layout() == 'text' ):
                        $text = get_sub_field('text');
                        ?>
                        <div class="oblogu__wrapper__text">
                            <?php echo $text; ?>
                        </div>
                    <?php elseif( get_row_layout() == 'eksperci' ):
                        $title = get_sub_field('title');
                        $ekspert = get_sub_field('ekspert');
                        ?>
                        <div class="oblogu__wrapper__eksperci">
                            <h3><?php echo $title; ?></h3>
                            <div class="oblogu__wrapper__eksperci__wrapper">
                                <?php foreach($ekspert as $item): ?>
                                <div class="oblogu__wrapper__eksperci__wrapper__ekspert">
                                    <img src="<?php echo $item['image']['sizes']['ekspert-image'] ?>" alt="<?php echo $item['title']; ?>">
                                    <h4><?php echo $item['title']; ?></h4>
                                    <?php if($item['socials']): ?>
                                    <div class="oblogu__wrapper__eksperci__wrapper__ekspert__socials">
                                        <ul>
                                            <?php foreach($item['socials'] as $social): ?>
                                                <li><span>/</span> <a href="<?php echo $social['link'] ?>" target="_blank"><?php echo $social['text'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                    <?php echo $item['text']; ?>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>



                        <?php endif;
                endwhile;
            else :

                // no layouts found

            endif;
        ?>
    </div>
</div>

<?php
    get_footer();
?>
