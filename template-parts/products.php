<?php
    $products = get_field('products');
    $recipe = get_field('recipe');
?>
<div class="single-content__wrapper single-content__wrapper<?php echo get_field('recipe') ? '--recipe' : '--no-recipe'; ?>">
    <div class="products">
        <h2>Produkty</h2>
        <div class="products__wrapper">
            <?php foreach ($products as $product => $value): ?>
                <div class="products__wrapper__product">
                    <div class="products__wrapper__product__image">
                        <img src="<?php echo $value['image']; ?>" alt="<?php echo $value['product_name']; ?>">
                    </div>
                    <div class="products__wrapper__product__text">
                        <h3><?php echo $value['product_name']; ?></h3>
                        <a href="<?php echo $value['product_link']; ?>" target="_blank">KUP</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
