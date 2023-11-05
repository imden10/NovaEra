<section class="catmainsec beforeafterpage">
    <div class="container mobfluid">
        <div class="row">
            <div class="col-lg-7">
                <div class="catmainsec__desc">
                    <!-- Breadcrumbs -->
                    <ul class="brdcrmb">
                        <?php $home_page = get_post(get_option('page_on_front')); ?>
                        <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                        <li class="brdcrmb__li"><?php echo !empty($page->page_information_breadcrumb) ? $page->page_information_breadcrumb : $page->post_title; ?></li>
                    </ul>
                    <!-- End Breadcrumbs -->

                    <h1 class="catmainsec__desc__title variablefz"><?php echo $page->post_title; ?></h1>

                    <span class="catmainsec__desc__subtitle"><?php echo $page->page_information_subtitle; ?></span>

                    <?php echo wpautop($page->post_content); ?>

                    <?PHP IF (!empty($page->page_information_seo_text)) : ?>
                        <a href="#seoTextSection" class="catmainsec__desc__lnk"><span><?PHP ECHO TRANS('Читать больше'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    <?PHP ENDIF; ?>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="formwrap">
                    <?php require app('path.views') . '/layouts/forms/header_form.php'; ?>
                </div>
            </div>
        </div>

        <?php $before_after = model('before_after')->allWithTerms();

        $cats = [];

        foreach ($before_after as $i) {
            foreach ($i->categories as $c) {
                array_push($cats, $c);
            }
        } ?>

        <?php $specializations = model('service')->terms();
        if (!empty($specializations)) : ?>
            <div class="categorieswrap sliderwraptrgt">
                <div class="categorieswrap__controlswrap">
                    <span class="categorieswrap__controlswrap__desc"><?php echo trans('Выберите направление, чтобы отфильтровать результаты работ'); ?></span>
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

        <?php foreach ($specializations as $specialization) :
            if (!in_array($specialization->term_id, $cats)) continue; ?>
            <div class="direction-group" data-sort-key="<?php echo $specialization->term_id; ?>">
                <h2 class="blockheader"><?php echo !empty(get_term_meta($specialization->term_id, 'direction_information_preview_title', true)) ? get_term_meta($specialization->term_id, 'direction_information_preview_title', true) : $specialization->name; ?></h2>
                <div class="beforeafter">
                    <div class="row">

                        <?php foreach ($before_after as $item) :
                        if (!in_array($specialization->term_id, $item->categories)) continue; ?>
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
            </div>
        <?php endforeach; ?>
    </div>

    <div class="bgdots bgtopcenter"></div>
    <div class="bgdots bgcenterleft"></div>
    <div class="bgdots bgbotright"></div>
    <div class="bgtext bg3row bgtopleft"></div>
</section>

<section class="seosection">
    <div class="container mobfluid">
        <?PHP IF (!empty($page->page_information_seo_text)) : ?>
            <div class="txtverticlimiter">
                <div id="seoTextSection" class="constr txt1col">
                    <div class="container mobfluid">
                        <?php if (!empty($page->page_information_seo_title)) : ?>
                            <div class="headerwrap">
                                <div class="titlefigure"></div>
                                <h2 class="variablefz"><?php echo $page->page_information_seo_title; ?></h2>
                            </div>
                        <?php endif; ?>
                
                        <?php echo wpautop($page->page_information_seo_text); ?>
                    </div>
                </div>
            </div>

            <div class="gomore">
                <a href="#" class="gomore__readall"><?php echo trans('Читать полностью'); ?></a>
            </div>
        <?php endif; ?>

        <?php if (is_active_sidebar('information-section' )) : ?>
            <div class="row prikol">
                <?php dynamic_sidebar('information-section'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require app('path.views') . '/layouts/forms/footer_form.php'; ?>
