<?php if ($content['image_position'] == 'top') : ?>

    <div class="constr imgtop">
        <div class="container mobfluid">
            <div class="headerwrap">
                <div class="titlefigure"></div>
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <?php if (isset($content['image']['id']) && !empty($content['image']['id'])) : ?>
                <img src="<?php echo wp_get_attachment_image_url($content['image']['id'], 'full'); ?>" alt="" class="constrimg">
            <?php endif; ?>

            <?php echo $content['text']; ?>

            <?php if (isset($content['link']) && !empty($content['link'])) : ?>
                <div class="constrlnkwrap">
                    <a href="<?php echo $content['link']; ?>" class="constrlnk"><?php echo trans('Переход'); ?> <img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php else : ?>

    <div class="constr <?php echo $content['image_position']; ?>img">
        <div class="container mobfluid">
            <div class="row">
                <div class="txtwrap">
                    <div class="headerwrap">
                        <div class="titlefigure"></div>
                        <?php if (!empty($content['title'])) : ?>
                            <h2><?php echo $content['title']; ?></h2>
                        <?php endif; ?>
                    </div>

                    <?php echo $content['text']; ?>

                    <?php if (isset($content['link']) && !empty($content['link'])) : ?>
                        <div class="constrlnkwrap">
                            <a href="<?php echo $content['link']; ?>" class="constrlnk"><?php echo trans('Переход'); ?> <img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (isset($content['image']['id']) && !empty($content['image']['id'])) : ?>
                    <div class="imgcol">
                        <div class="imgwrap">
                            <img src="<?php echo wp_get_attachment_image_url($content['image']['id'], 'full'); ?>" alt="" class="constrimg">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>