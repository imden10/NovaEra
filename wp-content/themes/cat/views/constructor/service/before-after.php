<?php

$before_after = !empty($content['ids']) ? get_posts([
    'post_type' => 'before_after',
    'posts_per_page' => -1,
    'post__in' => (array) $content['ids'],
    'orderby' => 'menu_order',
    'order' => 'ASC',
]) : [];

if (!empty($before_after)) : ?>

    <div class="constr beforeafter">
        <div class="container mobfluid">
            <div class="headerwrap">
                <div class="titlefigure"></div>
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <?php foreach ($before_after as $item) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="befafitem">
                            <div class="befafitem__imgwrap">
                                <?php if (!empty($item->before_after_information_before)) : ?>
                                    <img src="<?php echo wp_get_attachment_image_url($item->before_after_information_before, 'full'); ?>" alt="" class="befafitem__imgwrap__img">
                                <?php endif; ?>

                                <?php if (!empty($item->before_after_information_after)) : ?>
                                    <img src="<?php echo wp_get_attachment_image_url($item->before_after_information_after, 'full'); ?>" alt="" class="befafitem__imgwrap__img">
                                <?php endif; ?>
                            </div>

                            <div class="befafitem__labelwrap">
                                <span class="befafitem__labelwrap__label"><?php echo trans('До'); ?></span>
                                <span class="befafitem__labelwrap__label"><?php echo trans('После'); ?></span>
                            </div>

                            <div class="befafitem__txtcontent">
                                <?php if (!empty($item->before_after_information_employee)) : ?>
                                    <span class="befafitem__txtcontent__title"><?php echo get_post($item->before_after_information_employee)->post_title; ?></span>
                                <?php endif; ?>

                                <?php if (!empty($item->before_after_information_service)) : ?>
                                    <span class="befafitem__txtcontent__subtitle"><?php echo get_post($item->before_after_information_service)->post_title; ?></span>
                                <?php endif; ?>

                                <?php echo wpautop($item->post_content); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="bgdots bg1"></div>
        <div class="bgdots bg2"></div>
        <div class="bgdots bg3"></div>
        <div class="bgtext bgt1"></div>
        <div class="bgtext bgt2"></div>
    </div>

<?php endif; ?>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>