<?php

$services = !empty($content['ids']) ? get_posts([
    'post_type' => 'service',
    'posts_per_page' => -1,
    'post__in' => (array) $content['ids'],
    'orderby' => 'menu_order',
    'order' => 'ASC',
]) : [];

if (!empty($services)) : ?>

    <div class="constr usefulservices">
        <div class="container mobfluid">
            <div class="headerwrap">
                <div class="titlefigure"></div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <?php if (!empty($content['title'])) : ?>
                            <h2><?php echo $content['title']; ?></h2>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="headerlnk-wrap">
                            <a href="<?php echo get_permalink(getCustomOption('relations_services_page')); ?>" class="headergoalllnk"><span><?php echo trans('Все услуги'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="usfsrvlslider_wrap sliderwraptrgt">
                <div class="usfsrvlslider owl-carousel">

                    <?php foreach ($services as $service) : ?>
                        <div class="usfsrvlslider_item">
                            <div class="usfsrvlslider_item__imgwrap" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($service->ID) ? get_the_post_thumbnail_url($service->ID, 'full') : ''; ?>');"></div>

                            <span class="usfsrvlslider_item__title"><?php echo $service->post_title; ?></span>

                            <a href="<?php echo get_permalink($service->ID); ?>" class="usfsrvlslider_item__lnk"><?php echo trans('Подоробнее &#62'); ?></a>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="usfsrvlslider_controlswrap">
                    <div class="galleryslider_controls slider_controls">
                        <span class="slider_controls__prev">
                            <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26 6.5H1.5M5 1L1 6.5L5 12" stroke="black" stroke-opacity="0.7"/>
                            </svg>
                        </span>

                        <span class="slider_controls__next">
                            <svg width="28" height="13" viewBox="0 0 28 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 6.5H26M22.5 1L26.5 6.5L22.5 12" stroke="white"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bgdots bgtopright"></div>
        <div class="bgdots bgbotleft"></div>
    </div>

<?php endif; ?>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>