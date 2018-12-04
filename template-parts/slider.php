<?php
    $slides = get_sub_field('slides');
?>

<section class="slider">
    <div class="slider__wrapper col-sm-12">
        <?php foreach($slides as $slide) :
            $image = $slide['image']['sizes']['post-image'];
            $title = $slide['title'];
            $description = $slide['description'];
        ?>
        <div>
            <div class="slider__wrapper__slide" style="background-image: url('<?php echo $image; ?>');" >
                <h2><?php echo $title ?></h2>

            </div>
            <p><?php echo $description; ?></p>
        </div>
    <?php endforeach; ?>

    </div>
</section>
