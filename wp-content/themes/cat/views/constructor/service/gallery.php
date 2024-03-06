<?php if ($content['type'] == 'usual') : ?>
    <div class="constr gallery">

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
        </div>

        <!-- <?php else : ?>

    <div class="constr brickgallery">
        <div class="container mobfluid">
            <div class="headerwrap">
                <div class="titlefigure"></div>
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <?php if (isset($content['images']) && !empty($content['images'])) : ?>
            <div class="container">
                <div class="brickgallery_wrap">

                    <?php foreach ($content['images'] as $image) : ?>

                        <?php if (isset($image['id']) && !empty($image['id'])) : ?>
                            <div class="brickgallery_item">
                                <img src="<?php echo wp_get_attachment_image_url($image['id'], 'full'); ?>" alt="<?php echo $image['title']; ?>" class="brickgallery_item__img">

                                <div class="brickgallery_item__textwrap">
                                    <div class="brickgallery_item__txt">
                                        <span class="brickgallery_item__title"><?php echo $image['title']; ?></span>

                                        <p><?php echo $image['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endforeach; ?>

                </div>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?> -->

        <?php require app('path.views') . '/constructor/_buttons.php'; ?>