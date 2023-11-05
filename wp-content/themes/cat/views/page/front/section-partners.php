<?php $partners = model('partner')->forFrontPage()->posts;
if (!empty($partners)) : ?>
    <section class="partners">
        <div class="container">
            <div class="sectionheaderwrap">
                <div class="titlefigure"></div>
                <h2 class="sectionheader white_text"><?php echo trans('Наши партнеры'); ?></h2>
            </div>

            <div class="row justify-content-between">
                <div class="col-10">
                    <span class="sectionsubheader white_text"><?php echo trans('Поставщики оборудования и новейших материалов для клиники MK Dental Clinic'); ?></span>
                </div>
            </div>

            <div class="partners__container">
                <?php foreach ($partners as $partner) :
                    if (has_post_thumbnail($partner->ID)) : ?>
                        <div class="partners__container__item">
                            <img src="<?php echo get_the_post_thumbnail_url($partner->ID, 'full'); ?>" alt="<?php echo $partner->post_title; ?>" class="partners__container__item__img">
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
        </div>

        <div class="bgdots bgtopright"></div>
        <div class="bgdots bgbotleft"></div>
    </section>
<?php endif; ?>
