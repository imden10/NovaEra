<div class="gallery">
    <div class="container">

        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>

        <div class="swiper">
            <?php if (isset($content['images']) && !empty($content['images'])) : ?>
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php foreach ($content['images'] as $image) : ?>
                        <?php if (isset($image['id']) && !empty($image['id'])) : ?>
                            <div class="swiper-slide">

                                <img src="<?php echo wp_get_attachment_image_url($image['id'], 'full'); ?>" alt="<?php echo $image['title']; ?>" class="galleryslider_item_img">
                                < </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                </div>
            <?php endif; ?>
            <?php require app('path.views') . '/constructor/_buttons.php'; ?>
        </div>
    </div>
</div>