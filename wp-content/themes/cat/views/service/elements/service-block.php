<a href="<?php echo get_permalink($service->ID); ?>">
    <div class="col-lg-3 col-md-6 col-6">
        <div class="dent-directs__item">
            <div class="dent-directs__item__imgwrap" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($service->ID) ? get_the_post_thumbnail_url($service->ID, 'full') : ''; ?>');"></div>

            <div class="dent-directs__item__txt">
                <div class="txtwrap">
                    <span class="txtwrap__title"><?php echo !empty($service->service_information_preview_title) ? $service->service_information_preview_title : $service->post_title; ?></span>
                    <p class="txtwrap__desc"><?php echo $service->post_excerpt; ?></p>
                </div>

                <div class="linkswrap">
                    <a href="#" data-service-id="<?php echo $service->ID; ?>" class="linkswrap__lnk appointment-service-button"><?php echo trans('записаться онлайн +'); ?></a>

                    <a href="<?php echo get_permalink($service->ID); ?>" class="linkswrap__details"><?php echo trans('Подробнее >'); ?></a>
                </div>
            </div>
        </div>
    </div>
</a>
