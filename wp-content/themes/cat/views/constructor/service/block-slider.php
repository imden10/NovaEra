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
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ($content['list'] as $item) : ?>
                <div class="swiper-slide">
                    <h4><?= $item['link']; ?>title</h4>
                    <!-- <p><?= $item['text']; ?>descr</p> -->
                    <img src="https://nova-era.sisidev.com.ua/wp-content/uploads/2024/05/img-golovna-test.png" alt="">
                    <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 300px">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
<?php endif; ?>


<div class="container right">
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>