<?php

$faqs = !empty($content['ids']) ? get_posts([
    'post_type' => 'faq',
    'posts_per_page' => -1,
    'post__in' => (array) $content['ids'],
    'orderby' => 'menu_order',
    'order' => 'ASC',
]) : [];

if (!empty($faqs)) : ?>

    <div class="faq">
        <div class="container">
            <div class="sectionheaderwrap">
                <div class="titlefigure"></div>
                <?php if (!empty($content['title'])) : ?>
                    <h2 class="sectionheader"><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-9 col-md-9 col-sm-12 expandcases">
                    <span class="sectionsubheader"><?php echo $content['subtitle']; ?></span>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="headerlnk-wrap">
                        <a href="<?php echo get_permalink(getCustomOption('relations_faqs_page')); ?>" class="headergoalllnk"><span><?php echo trans('Все вопросы'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    </div>
                </div>
            </div>

            <span class="headerrescription">
                <?php echo trans('Ознакомтесь со всеми вопросами ниже, возможно вы найдете ответ на интересующий вас вопрос.'); ?>
            </span>

            <div class="accordion-group">

                <?php foreach ($faqs as $faq) : ?>
                    <h3 class="accordion-header default-open"><?php echo $faq->post_title; ?></h3>

                    <div class="accordion-body">
                        <?php echo wpautop($faq->post_content); ?>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="bgdots bgtopright"></div>
        <div class="bgdots bgcenterleft"></div>
        <div class="bgdots bgbotright"></div>
    </div>

<?php endif; ?>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>