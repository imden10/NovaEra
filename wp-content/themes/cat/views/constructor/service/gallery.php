<?php if ($content['type'] == 'usual') : ?>

    <div class="constr gallery">
        <div class="container">
            <div class="headerwrap">
                <div class="titlefigure"></div>
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <?php if (isset($content['images']) && !empty($content['images'])) : ?>
                <div class="galleryslider_wrap sliderwraptrgt">
                    <div class="galleryslider owl-carousel noselect">

                        <?php foreach ($content['images'] as $image) : ?>

                            <?php if (isset($image['id']) && !empty($image['id'])) : ?>
                                <div class="galleryslider_item">
                                    <div class="galleryslider_item_imgwrap">
                                        <img src="<?php echo wp_get_attachment_image_url($image['id'], 'full'); ?>" alt="<?php echo $image['title']; ?>" class="galleryslider_item_img">
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    </div>

                    <div class="galleryslider_controls slider_controls">
                        <span class="slider_controls__prev" id="gallery_prev">
                            <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26 6.5H1.5M5 1L1 6.5L5 12" stroke="black" stroke-opacity="0.7"/>
                            </svg>
                        </span>

                        <span class="slider_controls__next" id="gallery_next">
                            <svg width="28" height="13" viewBox="0 0 28 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 6.5H26M22.5 1L26.5 6.5L22.5 12" stroke="white"/>
                            </svg>
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="dotsplacehold"></div>
        </div>
    </div>

<?php else : ?>

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

<?php endif; ?>
