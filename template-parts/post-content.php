<?php
// check if the flexible content field has rows of data

if( have_rows('content') ):
     // loop through the rows of data
    while ( have_rows('content') ) : the_row();
        if( get_row_layout() == 'text' ):
            get_template_part( 'template-parts/text-content');
        elseif( get_row_layout() == 'slider' ):
            get_template_part( 'template-parts/slider');
        endif;
    endwhile;
else :

    // no layouts found

endif;

?>
