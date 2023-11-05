<?php $banners = model('banner')->all()->posts;
if (!empty($banners)) :
    $banner = array_shift($banners); ?>
    <section class="firstbanner">
        <?php if (!empty($banner->banner_information_link)) : ?>
            <a href="<?php echo esc_url($banner->banner_information_link); ?>">
        <?php endif; ?>

                <?php if (!empty($banner->banner_information_desktop_image)) : ?>
                    <img class="descbanner" src="<?php echo wp_get_attachment_image_url($banner->banner_information_desktop_image, 'full') ?>" alt="">
                <?php endif; ?>

                <?php if (!empty($banner->banner_information_mobile_image)) : ?>
                    <img class="mobbanner" src="<?php echo wp_get_attachment_image_url($banner->banner_information_mobile_image, 'full') ?>" alt="">
                <?php endif; ?>

        <?php if (!empty($banner->banner_information_link)) : ?>
            </a>
        <?php endif; ?>
    </section>
<?php endif; ?>
</div>
<section class="firstscreen" id="firstscreen">

    <div class="firstscreen__bnrwarp">
        <div class="container">
            <div class="row">
                
                <div class="firstscreen__bnrwarp__textwrap col-12 col-lg-6">
                    <h1 class="firstscreen__bnrwarp__textwrap__heading">
                        <?php echo sprintf(trans('MK %s Dental Clinic'), '<a href="#" class="firstscreen__bnrwarp__textwrap__heading__lnk nomobile callback-form-button"> ' . trans('Записаться онлайн') . ' <i class="fas fa-plus"></i></a>'); ?>

                        <span class="firstscreen__bnrwarp__textwrap__subheading"><?PHP echo $page->page_information_subtitle; ?></span>
                    </h1>

                    <p class="firstscreen__bnrwarp__textwrap__desc"><?PHP echo $page->post_content; ?></p>

                    <a href="#" class="firstscreen__bnrwarp__textwrap__moblnk appointment-service-button"><?php echo trans('Записаться онлайн'); ?> <i class="fas fa-plus"></i></a>
                </div>
                <?php if (is_active_sidebar('information-section' )) : ?>
                    <div class="row col-12 col-lg-6">
                        <?php dynamic_sidebar('information-section'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <a href="#" class="callbtn callbtn_banner callback-form-button"><i class="fas fa-phone-alt"></i></a>
    </div>
    <span class="firstscreen__decortext"><?php echo trans('MK Dental Clinic'); ?></span>
    <div class="bgdots bgtopcenter"></div>
</section>

<!-- Specializations start -->
<?php require_once app('path.views') . '/page/front/section-specializations.php'; ?>
<!-- Specializations end -->

<!-- Benefits start -->
<?php require_once app('path.views') . '/page/front/section-benefits.php'; ?>
<!-- Benefits end -->

<!-- Cases start -->
<?php require_once app('path.views') . '/page/front/section-cases.php'; ?>
<!-- Cases end -->

<!-- Team start -->
<?php require_once app('path.views') . '/page/front/section-team.php'; ?>
<!-- Team end -->

<!-- Prices start -->
<?php require_once app('path.views') . '/page/front/section-service-packages.php'; ?>
<!-- Prices end -->

<!-- Partners start -->
<?php require_once app('path.views') . '/page/front/section-partners.php'; ?>
<!-- Partners end -->

<!-- Reviews start -->
<?php require_once app('path.views') . '/page/front/section-reviews.php'; ?>
<!-- Reviews end -->

<?php if (!empty($page->page_information_seo_text)) : ?>
    <section class="seosection">
        <div class="container mobfluid">
            <div class="txtverticlimiter">
                <div class="constr txt1col">
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
        </div>
    </section>
<?php endif; ?>

<!-- Feedback form and map start -->
<?php require_once app('path.views') . '/page/front/section-feedback-map.php'; ?>
<!-- Feedback form and map end -->
