<?php $packages = model('service_package')->forFrontPage()->posts;
if (!empty($packages)) : ?>
    <section class="srv_price">
        <div class="container">
            <div class="sectionheaderwrap">
                <div class="titlefigure"></div>
                <h2 class="sectionheader"><?php echo trans('Стоимость услуг'); ?></h2>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-9 col-sm-12">
                    <span class="sectionsubheader"><?php echo trans('Пакеты услуг клиники MK Dental Clinic'); ?></span>
                </div>

                <div class="col-lg-3 col-sm-12">
                    <div class="headerlnk-wrap">
                        <a href="<?php echo get_permalink(getCustomOption('relations_prices_page')); ?>" class="headergoalllnk"><span><?php echo trans('Cмотреть все цены'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="row">

                <?php foreach ($packages as $package) : ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="srv_price_item">
                            <div class="srv_price_item__topcontent">
                                <spna class="srv_price_item__topcontent__title"><?php echo $package->post_title; ?></spna>

                                <?php if (!empty($package->service_package_information_note)) : ?>
                                    <span class="srv_price_item__topcontent__subtitle">* <?php echo $package->service_package_information_note; ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="srv_price_item__imgwrap">
                                <div class="srv_price_item__imgwrap__bg" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($package->ID) ? get_the_post_thumbnail_url($package->ID, 'full') : ''; ?>');"></div>
                                <span class="srv_price_item__imgwrap__price"><?php echo $package->service_package_information_price; ?> <?php echo trans('грн'); ?></span>
                            </div>

                            <div class="srv_price_item__botcontent">
                                <ul class="srv_price_item__botcontent__list">
                                    <?php foreach ((array) $package->service_package_information_services as $item) : ?>
                                        <li class="srv_price_item__botcontent__list__item"><?php echo $item; ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <a href="#" class="srv_price_item__botcontent__lnk package-service-button" data-package-name="<?php echo $package->post_title; ?>"><?php echo trans('записаться онлайн +'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="bgdots bgdark bgtopright"></div>
        <div class="bgdots bgdark bgbotleft"></div>
    </section>
<?php endif; ?>
