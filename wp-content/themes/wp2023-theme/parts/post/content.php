<?php
$pos_id = isset($args['post_id']) ? $args['post_id'] : get_the_ID();

?>

<div class="product__item">

    <div class="product__item__pic">
        <?= get_the_post_thumbnail($pos_id, 'medium') ?>
        <!-- If out of stock, do not display -->
        <ul class="product__item__pic__hover">

            <li> <?= get_the_date($pos_id) ?></li>
        </ul>
    </div>
    <div class="product__item__text">
        <span><?= get_the_date() ?></span>
        <span class="category__name">Rau ăn lá</span>
        <h5><a href="<?= get_the_permalink($pos_id) ?>"> <?= get_the_title($pos_id) ?></a></h5>

        <div class="product__item__price">
            <?= get_the_excerpt($pos_id) ?>
        </div>
    </div>

</div>