<?php
/**
 * Filename: index-pdf.php
 * Project: WordPress PDF Templates
 * Copyright: (c) 2014-2016 Antti Kuosmanen
 * License: GPLv3
 *
 * Copy this file to your theme directory to start customising the PDF template.
*/

?>
<!DOCTYPE html>

<html>
<head>
    <meta name="robots" content="noindex,nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        * { font-family: DejaVu Sans;}
        img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        h1 {
          line-height: 1.1;
          text-transform: uppercase;
          font-size: 18pt;
        }
        .pdf-lead {
            font-weight: bold;
            font-size: 8pt;
        }
        .recipe__wrapper__header__above__cat {
            display: none;
        }
        .recipe__wrapper__list {
            ul {
                margin: 0;
                padding: 0;
            }
        }
        .pdf-container {
          position: relative;
          width: 100%;
        }
        .pdf-container p {
          margin: 0;
          padding: 0;
        }
        .recipe {
          display: block;
          width: 60%;
          font-size: 8pt;
          float: left;
        }
        .norecipe {
          width: 100%;
          float: none;
          font-size: 11pt;
        }
        .recipe__wrapper {
          display: block;
          width: 35%;
          float: right;
        }
        .recipe__wrapper h3 {
          padding: 10px 0;
          margin: 0;
          border-top: 1pt solid #d2d2d2;
          border-bottom: 1pt solid #d2d2d2;
        }
        .recipe__wrapper__list ul li {
          font-size: 12px;
          border-bottom: 1pt solid #d2d2d2;
          padding: 10px 0;
        }
        .recipe__wrapper__list ul {
          list-style: none;
          margin: 0;
          padding: 0;
        }
        .pdf-footer a {
          color: #898989;
          font-weight: bold;
        }
        p img {
          max-width: 100%;
          height: auto;
          margin: 10px 0;
        }
    </style>
</head>

<body>
  <div class="pdf-container">
    <header>
      <?php the_custom_logo() ?>
    </header>
    <?php
    $lead = get_field('lead');
    $products = get_field('products');
    $wideo_post = get_field('wideo_post');
    $thumbnail_title = get_field('thumbnail_title');
    $recipe = get_field('recipe');
    ?>
    <div class="pdf-wrapper">
      <div class="pdf-title">
        <h1>
          <?php echo esc_html( get_the_title() ); ?>
        </h1>
      </div>
      <div class="pdf-content <?php echo $recipe ? 'recipe' : 'norecipe'; ?>">
        <div class="pdf-image">
          <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
        </div>
        <?php if($lead): ?>
    		<div class="pdf-lead">
    			<h2><?php echo $lead; ?></h2>
    		</div>
    		<?php endif ?>

        <?php
        // check if the flexible content field has rows of data

        if( have_rows('content') ):
             // loop through the rows of data
            while ( have_rows('content') ) : the_row();
                if( get_row_layout() == 'text' ):
                  $text_content = get_sub_field('text_content');
                  echo $text_content;
                endif;
            endwhile;
        else :

            // no layouts found

        endif;

        ?>
        <div class="pdf-footer">
          <p><br><b>Więcej przepisów znajdziesz na:</b> <a href="https://--usuniete--.pl/blog">--usuniete--.pl/blog</a></p>
        </div>
      </div>
      <?php if($recipe): ?>
      <?php
          $time = get_field('czas_przygotowania');
          $kcal = get_field('kcal');
          $porcje = get_field('porcje');
          $skladniki = get_field('skladniki');
      ?>
        <div class="recipe__wrapper">
            <div class="recipe__wrapper__header">
                <div class="recipe__wrapper__header__above">
                    <?php if($time): ?>
                    <div class="recipe__wrapper__header__above__time">
                        <div class="recipe__wrapper__header__above__time__icon"></div>
                        <p><?php echo $time; ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if($kcal): ?>
                    <div class="recipe__wrapper__header__above__kcal">
                        <p><?php echo $kcal; ?><span>KCAL</span></p>
                    </div>
                    <?php endif; ?>
                    <div class="recipe__wrapper__header__above__cat">
                        <p>LUNCH</p>
                    </div>
                </div>
                <div class="recipe__wrapper__header__below">
                    <h3>SKŁADNIKI</h3>
                    <?php if ($porcje): ?>
                    <p><?php echo $porcje; ?> PORCJE</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="recipe__wrapper__list">
                <ul class="listonic">
                <?php foreach($skladniki as $skladnik => $index): ?>
                    <li class="listonic_point"><span><?php echo $index['ilosc']; ?></span> <span><?php echo $index['skladnik']; ?></span></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
      <?php endif; ?>
    </div>

  </div>


</body>
</html>
