<section class="catmainsec questionspage">
    <div class="container mobfluid">
        <div class="row">
            <div class="col-lg-7">
                <div class="catmainsec__desc">
                    <!-- Breadcrumbs -->
                    <ul class="brdcrmb">
                        <?php $home_page = get_post(get_option('page_on_front')); ?>
                        <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                        <li class="brdcrmb__li"><?php echo $page->post_title; ?></li>
                    </ul>
                    <!-- End Breadcrumbs -->

                    <h1 class="catmainsec__desc__title variablefz"><?php echo $page->post_title; ?></h1>

                    <span class="catmainsec__desc__subtitle"><?php echo $page->page_information_subtitle; ?></span>

                    <?php echo wpautop($page->post_content); ?>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="formwrap">
                    <?php require app('path.views') . '/layouts/forms/header_form.php'; ?>
                </div>
            </div>
        </div>

        <?php $faqs = model('faq')->allWithTerms();

        $cats = [];

        foreach ($faqs as $i) {
            foreach ($i->categories as $c) {
                array_push($cats, $c);
            }
        } ?>

        <?php $specializations = model('service')->terms();
        if (!empty($specializations)) : ?>
            <div class="categorieswrap sliderwraptrgt">
                <div class="categorieswrap__controlswrap">
                    <span class="categorieswrap__controlswrap__desc"><?php echo trans('Выберите направление, чтобы отфильтровать вопросы'); ?></span>

                    <div class="categorieswrap__controlswrap__subwrp">
                        <a href="#" class="categorieswrap__controlswrap__subwrp__allnapr"><?php echo trans('Все направления'); ?></a>

                        <div class="slider_controls">
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

                <div class="directionsslider owl-carousel">
                    <?php foreach ($specializations as $specialization) :
                        if (!in_array($specialization->term_id, $cats)) continue; ?>
                        <a href="#" class="directionitem_wrap" data-key-id="<?php echo $specialization->term_id; ?>">
                            <div class="directionitem">
                                <?php if (!empty(get_term_meta($specialization->term_id, 'direction_information_icon', true))) : ?>
                                    <img src="<?php echo wp_get_attachment_image_url(get_term_meta($specialization->term_id, 'direction_information_icon', true), 'thumbnail'); ?>" alt="" class="directionitem__icon">
                                <?php endif; ?>

                                <span class="directionitem__text"><?php echo !empty(get_term_meta($specialization->term_id, 'direction_information_preview_title', true)) ? get_term_meta($specialization->term_id, 'direction_information_preview_title', true) : $specialization->name; ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="faq accordquestion">

            <?php foreach ($specializations as $specialization) :
                if (!in_array($specialization->term_id, $cats)) continue; ?>
                <div class="direction-group" data-sort-key="<?php echo $specialization->term_id; ?>">
                    <h2 class="faq__title"><?php echo !empty(get_term_meta($specialization->term_id, 'direction_information_preview_title', true)) ? get_term_meta($specialization->term_id, 'direction_information_preview_title', true) : $specialization->name; ?></h2>

                    <div class="accordion_wrap">
                        <div class="accordion-group">

                            <?php foreach ($faqs as $faq) :
                                if (!in_array($specialization->term_id, $faq->categories)) continue; ?>

                                <h3 class="accordion-header default-open"><?php echo $faq->post_title; ?></h3>
                                <div class="accordion-body">
                                    <?php echo wpautop($faq->post_content); ?>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="gomore">
            <a href="#" class="gomore__lnk"><span><?php echo trans('Показать ещё вопросы'); ?></span><img src="<?php echo appConfig('theme_url'); ?>/img/reloadicon.svg" alt="More"></a>
        </div>

    </div>
    <div class="bgdots bgtopcenter"></div>
    <div class="bgdots bgcenterleft"></div>
    <div class="bgdots bgbotright"></div>
    <div class="bgtext bg3row bgtopleft"></div>
</section>


<section class="menu3items">
    <div class="container">
        <?php if (is_active_sidebar('information-section' )) : ?>
            <div class="row prikol">
                <?php dynamic_sidebar('information-section'); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="bgdots bgtopright"></div>
    <div class="bgdots bgbotleft"></div>
    <div class="bgtext bg3row bgtopleft"></div>
</section>

<?php require app('path.views') . '/layouts/forms/footer_form.php'; ?>
