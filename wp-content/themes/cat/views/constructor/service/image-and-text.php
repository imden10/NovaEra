<?php
$image = wp_get_attachment_image_url($content['image']['id'], 'full');
?>
<div class="container">
    <div class="text-wrapper <?php echo $content['image_position'] ?>">
        <div class="media">
            <?php
            $path_parts = pathinfo(get_image_url_by_id($image));
            if ($path_parts['extension'] === 'mp4') :
            ?>
                <video autoplay muted playsinline loop>
                    <source src="<?= get_image_url_by_id($image); ?>" type="video/mp4">
                    Ваш браузер не поддерживает тег видео.
                </video>
            <?php else : ?>
                <img src="<?= $image ?>" alt="<?= $image ?>">
            <?php endif; ?>
        </div>
        <div class="text">
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
            <div class="redactor">
                <?php echo $content['text']; ?>
                <?php if (isset($content['link']) && !empty($content['link'])) : ?>
                    <!-- <img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""> -->
                    <a href="<?php echo $content['link']; ?>" class="constrlnk"><?php echo trans('Переход'); ?></a>
                <?php endif; ?>
            </div>
            <?php require app('path.views') . '/constructor/_buttons.php'; ?>
        </div>
    </div>
</div>