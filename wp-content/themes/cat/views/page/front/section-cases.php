<?php $cases = model('post')->byCategoryForFrontPage(getCustomOption('relations_cases_category', 0))->posts;
if (!empty($cases)) : ?>
    <section class="cases">
        <div class="container">
            <div class="sectionheaderwrap">
                <div class="titlefigure"></div>
                <h2 class="sectionheader"><?php echo trans('Наши кейсы'); ?></h2>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-7 col-sm-12 expandcases">
                    <span class="sectionsubheader"><?php echo trans('Работы специалистов клиники MK Dental Clinic'); ?></span>
                </div>

                <div class="col-lg-3 col-sm-12">
                    <div class="headerlnk-wrap">
                        <a href="<?php echo get_category_link(getCustomOption('relations_cases_category', 0)); ?>" class="headergoalllnk"><span><?php echo trans('Все кейсы'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container fluidify">
            <div class="sliderwrap sliderwraptrgt">
                <div class="cases_sliderbg owl-carousel">
                    <?php foreach ($cases as $case) : ?>
                        <div class="cases_sliderbg_item" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($case->ID) ? get_the_post_thumbnail_url($case->ID, 'full') : ''; ?>');"></div>
                    <?php endforeach; ?>
                </div>

                <div class="cases_slidertextwrap">
                    <div class="slidertext owl-carousel">

                        <?php foreach ($cases as $case) : ?>
                            <div class="slidertext_item">
                                <div class="slidertextcontent">
                                    <span class="slidertext_item__title"><?php echo $case->post_title; ?></span>
                                    <span class="slidertext_item__doctor"><?php echo $case->post_information_subtitle; ?></span>

                                    <?php echo wpautop($case->post_content); ?>
                                </div>

                                <a href="<?php echo get_permalink($case->ID); ?>" class="slidertext_item__lnk"><?php echo trans('Подробнее &#62'); ?></a>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div class="sc4_slidercontrols slider_controls">
                        <span class="slider_controls__prev" id="casesslider_prev">
                            <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26 6.5H1.5M5 1L1 6.5L5 12" stroke="black" stroke-opacity="0.7"/>
                            </svg>
                        </span>

                        <span class="slider_controls__next" id="casesslider_next">
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
        <div class="bgtext bg3row bgtopleft"></div>
    </section>
<?php endif; ?>
