<?php
    $time = get_field('czas_przygotowania');
    $kcal = get_field('kcal');
    $porcje = get_field('porcje');
    $skladniki = get_field('skladniki');
?>
<aside class="recipe">
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
                <p><?php echo $porcje; ?> PORCJE</p>
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
</aside>
