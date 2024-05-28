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
    <div id="partner-list" class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ($content['list'] as $item) : ?>
                <a href="<?= $item['link'] ?>" class="swiper-slide">
                    <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 300px">
                </a>
            <?php endforeach; ?>

        </div>
    </div>
<?php endif; ?>

<div class="container">
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>