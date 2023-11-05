<section class="searchresults">
    <div class="container">
        <!-- Breadcrumbs -->
        <ul class="brdcrmb">
            <?php $home_page = get_post(get_option('page_on_front')); ?>
            <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

            <li class="brdcrmb__li"><?php echo sprintf('Поиск по запросу "%s"', get_search_query()); ?></li>
        </ul>
        <!-- End Breadcrumbs -->

        <?php if (!empty($result)) : ?>
            <span class="searchresults__userquerry"><?php echo sprintf('по запросу "%s" мы нашли', get_search_query()); ?></span>

            <?php foreach($result as $type => $results) : ?>

                <?php if ($type == 'service') : ?>
                    <h2 class="blockheader"><?php echo trans('Услуги'); ?></h2>

                    <div class="row srvrow">
                        <?php foreach ($results as $item) : ?>
                            <div class="col-lg-3 col-md-6 col-6 srvcol">
                                <div class="dent-directs__item">
                                    <div class="dent-directs__item__imgwrap" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($item->ID) ? get_the_post_thumbnail_url($item->ID, 'full') : ''; ?>');"></div>

                                    <div class="dent-directs__item__txt">
                                        <div class="txtwrap">
                                            <span class="txtwrap__title"><?php echo $item->post_title; ?></span>
                                            <p class="txtwrap__desc"><?php echo $item->post_excerpt; ?></p>
                                        </div>

                                        <div class="linkswrap">
                                            <a href="#" data-service-id="<?php echo $item->ID; ?>" class="linkswrap__lnk appointment-service-button"><?php echo trans('записаться онлайн +'); ?></a>

                                            <a href="<?php echo get_permalink($item->ID); ?>" class="linkswrap__details"><?php echo trans('Подробнее >'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($type == 'post') : ?>
                    <h2 class="blockheader"><?php echo trans('Новости'); ?></h2>

                    <div class="row postrow">
                        <?php foreach ($results as $item) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 postcol">
                                <a href="<?php echo get_permalink($item->ID); ?>" class="postitem">
                                    <div class="postitem__img" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($item->ID) ? get_the_post_thumbnail_url($item->ID, 'full') : ''; ?>');"></div>

                                    <div class="postitem__textwrap">
                                        <div class="postitem__cont">
                                            <h3 class="postitem__title"><?php echo $item->post_title; ?></h3>

                                            <!--<span class="postitem__subtitle">Эстетическая стоматология</span>-->

                                            <p class="postitem__text"><?php echo $item->post_excerpt; ?></p>
                                        </div>

                                        <span class="postitem__lnk"><?php echo trans('Подробнее &#62'); ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php else : ?>
            <span class="searchresults__userquerry"><?php echo sprintf('по запросу "%s" мы не нашли информации', get_search_query()); ?></span>

            <span class="searchresults__tryagain"><?php echo trans('попробуйте ввести другие ключевые слова'); ?></span>

            <div class="searchresults__srchinputwrap">
                <div class="searchfieldwrap">
                    <span class="searchfieldwrap__desc"><?php echo trans('Ищите услуги и другую полезную информацию'); ?></span>

                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require app('path.views') . '/layouts/forms/footer_form.php'; ?>
