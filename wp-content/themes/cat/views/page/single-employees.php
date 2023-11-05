<section class="catmainsec staff">
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

        <?php $specializations = model('service')->terms();
        if (!empty($specializations)) : ?>
            <div class="categorieswrap sliderwraptrgt">
                <div class="categorieswrap__controlswrap">
                    <span class="categorieswrap__controlswrap__desc"><?php echo trans('Выберите направление, чтобы отфильтровать  специалистов'); ?></span>
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
                    <?php foreach ($specializations as $specialization) : ?>
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

        <?php $employees = model('employee')->allForPage()->posts;
        if (!empty($employees)) : ?>
            <div class="headerwrap">
                <div class="titlefigure"></div>
                <h2><?php echo trans('Наши врачи'); ?></h2>
            </div>

            <div class="row">
                <?php foreach ($employees as $employee) : ?>
                    <div class="col-lg-3 col-md-6 col-6" data-sort-key="<?php echo model('employee')->getRelationTermStringIds((array) $employee->employee_information_service); ?>">
                        <div class="crewitem">
                            <div class="crewitem__imgwrap" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($employee->ID) ? get_the_post_thumbnail_url($employee->ID, 'full') : ''; ?>')">
                                <div class="crewitem__imgwrap__soccontainer">
                                    <?php if ($employee->employee_information_facebook) : ?>
                                        <a href="<?php echo $employee->employee_information_facebook; ?>" class="crewitem__imgwrap__soccontainer__lnk"><i class="fab fa-facebook-f"></i></a>
                                    <?php endif; ?>

                                    <?php if ($employee->employee_information_twitter) : ?>
                                        <a href="<?php echo $employee->employee_information_twitter; ?>" class="crewitem__imgwrap__soccontainer__lnk"><i class="fab fa-twitter"></i></a>
                                    <?php endif; ?>

                                    <?php if ($employee->employee_information_linked_in) : ?>
                                        <a href="<?php echo $employee->employee_information_linked_in; ?>" class="crewitem__imgwrap__soccontainer__lnk"><i class="fab fa-linkedin-in"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="crewitem__textcontent">
                                <span class="crewitem__textcontent__exp"><?php echo $employee->employee_information_experience; ?></span>
                                <span class="crewitem__textcontent__name"><?php echo $employee->post_title; ?></span>
                                <p class="crewitem__textcontent__subtext"><?php echo $employee->employee_information_subtitle; ?></p>
                            </div>
                        </div>
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

<section class="seosection">
    <div class="container mobfluid">

        <?PHP IF (!empty($page->page_information_seo_text)) : ?>
            <div class="txtverticlimiter">
                <div id="seoTextSection"  class="constr txt1col">
                    <div class="container mobfluid">
                        <?php if (!empty($page->page_information_seo_title)) : ?>
                            <div class="headerwrap">
                                <div class="titlefigure"></div>
                                <h2><?php echo $page->page_information_seo_title; ?></h2>
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
