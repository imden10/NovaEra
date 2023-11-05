<?php $specializations = model('service')->termsForFrontPage();
if (!empty($specializations)) : ?>
    <section class="dent-directs">
        <div class="container">
            <div class="dent-directs__titlewrap sectionheaderwrap">
                <div class="titlefigure"></div>
                <h2 class="dent-directs__titlewrap__title sectionheader"><?php echo trans('Направления стоматологии'); ?></h2>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <span class="dent-directs__subtitle sectionsubheader"><?php echo trans('в клинике MK Dental Clinic'); ?></span>
                </div>

                <div class="col-lg-3 col-sm-12">
                    <div class="headerlnk-wrap">
                        <a href="<?php echo get_permalink(getCustomOption('relations_directions_page')); ?>" class="dent-directs__lnk headergoalllnk"><span><?php echo trans('Все направления'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="row">

                <?php foreach ($specializations as $specialization) : ?>
                    <div class="col-lg-3 col-md-6 col-6">
                        <a href="<?php echo get_term_link($specialization->term_id); ?>" class="dent-directs__item">
                            <div class="dent-directs__item__imgwrap" style="background: no-repeat center/cover url('<?php echo !empty(get_term_meta($specialization->term_id, 'direction_information_image', true)) ? wp_get_attachment_image_url(get_term_meta($specialization->term_id, 'direction_information_image', true), 'full') : ''; ?>');">
                                <div class="dent-directs__item__imgwrap__txtwrap">
                                    <span class="dent-directs__item__imgwrap__catcount"><?php echo trans('В категории:'); ?> <span><?php echo num_decline($specialization->count, trans('услуга, услуги, услуг')); ?></span></span>
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
        </div>
    </section>
<?php endif; ?>
