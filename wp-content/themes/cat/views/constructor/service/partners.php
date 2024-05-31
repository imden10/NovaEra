<?php
$data = array_diff_key($content, array_flip(['list']));
?>

<div class="container">
    <div class="constrlistwrap">
        <div class="headerwrap">
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if (isset($content['list'])) : ?>
    <div id="partner-list" class="slider">
        <?php foreach ($content['list'] as $item) : ?>
            <a href="<?= $item['link'] ?>" class="swiper-slide">
                <!-- <img src="https://nova-era.com.ua/wp-content/uploads/2024/05/logo-partner-book-mini.svg" alt=""> -->
                <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 300px">
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="container">
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>