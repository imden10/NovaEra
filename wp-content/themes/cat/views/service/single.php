<section class="cformbanner">
    <div class="cformbanner__wrap">
        <div class="cformbanner__textcol">
            <!-- Breadcrumbs -->
            <ul class="brdcrmb">
                <?php $home_page = get_post(get_option('page_on_front')); ?>
                <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                <?php $directions_page = get_post(getCustomOption('relations_directions_page')); ?>
                <li class="brdcrmb__li"><a href="<?php echo get_permalink($directions_page->ID); ?>" class="brdcrmb__lnk"><?php echo !empty($directions_page->page_information_seo_breadcrumbs) ? $directions_page->page_information_seo_breadcrumbs : $directions_page->post_title; ?></a></li>

                <?php $term = get_the_terms($post->ID, 'direction'); if ($term) : ?>
                    <li class="brdcrmb__li"><a href="<?php echo get_term_link($term[0]->term_id); ?>" class="brdcrmb__lnk"><?php echo !empty(get_term_meta($term[0]->term_id, 'direction_information_preview_title', true)) ? get_term_meta($term[0]->term_id, 'direction_information_preview_title', true) : $term[0]->name; ?></a></li>
                <?php endif; ?>

                <li class="brdcrmb__li"><?php echo !empty($post->service_information_preview_title) ? $post->service_information_preview_title : $post->post_title; ?></li>
            </ul>
            <!-- End Breadcrumbs -->

            <div class="cformbanner__textcol__formwrap">
                <h1 class="cformbanner__h1title"><?php echo $post->post_title; ?></h1>

                <span class="cformbanner__subtitle"><?php echo trans('Запишитесь онлайн в клинику MK Dental Clinic'); ?></span>

                <?php $service_id = $post->ID; require app('path.views') . '/layouts/forms/appointment_form.php'; ?>

                <span class="cformbanner__srvpricetip"><?php echo sprintf(trans('Стоимость услуги: от %s %s грн'), '<span class="crosed">' . $post->service_information_price . '</span>', $post->service_information_price_actual); ?></span>
            </div>
        </div>

        <div class="cformbanner__banner" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'full') : ''; ?>');"></div>
    </div>

    <div class="bgdots bg1"></div>
    <div class="bgtext bgt1"></div>
</section>

<section class="constructor">

    <?php buildContentFromConstructorArray($post->post_type, $post->service_content_body); ?>

    <?php require app('path.views') . '/layouts/forms/footer_form.php'; ?>
</section>
