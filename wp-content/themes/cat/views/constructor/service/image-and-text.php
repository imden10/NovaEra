<!-- <?php print_r($content) ?> -->
<div class="image-and-text">
    <div class="container">

        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>

        <div class="text-wrapper <?php echo $content['image_position'] ?>">
            <div class="image">
                <img src="<?php echo wp_get_attachment_image_url($content['image']['id'], 'full'); ?>" alt="">
            </div>
            <div class="text">
                <div class="redactor">
                    <?php echo $content['text']; ?>
                    <?php if (isset($content['link']) && !empty($content['link'])) : ?>
                        <a href="<?php echo $content['link']; ?>" class="constrlnk"><?php echo trans('Переход'); ?> <img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>
</div>