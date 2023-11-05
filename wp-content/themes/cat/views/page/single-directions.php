<section class="catmainsec">
    <div class="container mobfluid">
        <div class="row">
            <div class="col-lg-7">
                <div class="catmainsec__desc">
                    <!-- Breadcrumbs -->
                    <ul class="brdcrmb">
                        <?php $home_page = get_post(get_option('page_on_front')); ?>
                        <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                        <li class="brdcrmb__li"><?php echo !empty($page->page_information_seo_breadcrumbs) ? $page->page_information_seo_breadcrumbs : $page->post_title; ?></li>
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

        <?php $specializations = model('service')->terms();
        if (!empty($specializations)) : ?>
            <div class="row">

                <?php foreach ($specializations as $specialization) : ?>
                    <div class="col-lg-3 col-md-6 col-6">
                        <a href="<?php echo get_term_link($specialization->term_id); ?>" class="dent-directs__item">
                            <div class="dent-directs__item__imgwrap" style="background: no-repeat center/cover url('<?php echo !empty(get_term_meta($specialization->term_id, 'direction_information_image', true)) ? wp_get_attachment_image_url(get_term_meta($specialization->term_id, 'direction_information_image', true), 'full') : ''; ?>');">
                                <div class="dent-directs__item__imgwrap__txtwrap">
                                    <span class="dent-directs__item__imgwrap__catcount"><?php echo trans('В категории:'); ?> <span><?php echo $specialization->count; ?> <?php echo trans('услуг:'); ?></span></span>
                                    <p class="dent-directs__item__imgwrap__desc"><?php echo $specialization->description; ?></p>
                                </div>
                            </div>
                            <div class="dent-directs__item__btn">
                                <span class="dent-directs__item__btn__txt"><?php echo !empty(get_term_meta($specialization->term_id, 'direction_information_preview_title', true)) ? get_term_meta($specialization->term_id, 'direction_information_preview_title', true) : $specialization->name; ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>
    </div>

    <div class="bgdots bgtopcenter"></div>
    <div class="bgdots bgcenterleft"></div>
    <div class="bgdots bgbotright"></div>
    <div class="bgtext bg3row bgtopleft"></div>
</section>

<!-- Benefits start -->
<?php require_once app('path.views') . '/page/front/section-benefits.php'; ?>
<!-- Benefits end -->

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
