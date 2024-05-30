<?php
$data = array_diff_key($content, array_flip(['list']));
?>


<div class="container">
    <!-- <pre>
            <?php
            print_r($data);
            ?>
        </pre> -->
    <?php if (!empty($content['title'])) : ?>
        <h2><?php echo $content['title']; ?></h2>
    <?php endif; ?>
</div>
<?php if (isset($content['list'])) : ?>
    <div id="block-slider" class="splide" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
        <?php foreach ($content['list'] as $item) : ?>
            <a href="<?= $item['link'] ?>" class="swiper-slide">
                <h4><?= $item['title']; ?></h4>
                <!-- <p><?= $item['text']; ?>descr</p> -->
                <!-- <img src="https://nova-era.sisidev.com.ua/wp-content/uploads/2024/05/img-golovna-test.png" alt=""> -->
                <img src="<?= get_image_url_by_id($item['image']); ?>" alt="">
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<div class="container right">
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    <div class="controls">
        <div class="button-prev ic-chevron-left"></div>
        <div class="button-next ic-chevron-right"></div>
    </div>
</div>