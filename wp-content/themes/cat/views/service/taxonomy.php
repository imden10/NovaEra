<section class="cformbanner">
    <div class="cformbanner__wrap">
        <div class="cformbanner__textcol">
            <!-- Breadcrumbs -->
            <ul class="brdcrmb">
                <?php $home_page = get_post(get_option('page_on_front')); ?>
                <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                <?php $directions_page = get_post(getCustomOption('relations_directions_page')); ?>
                <li class="brdcrmb__li"><a href="<?php echo get_permalink($directions_page->ID); ?>" class="brdcrmb__lnk"><?php echo !empty($directions_page->page_information_seo_breadcrumbs) ? $directions_page->page_information_seo_breadcrumbs : $directions_page->post_title; ?></a></li>

                <li class="brdcrmb__li"><?php echo !empty(get_term_meta($term->term_id, 'direction_information_preview_title', true)) ? get_term_meta($term->term_id, 'direction_information_preview_title', true) : $term->name; ?></li>
            </ul>
            <!-- End Breadcrumbs -->

            <div class="cformbanner__textcol__formwrap">
                <h1 class="cformbanner__h1title variablefz"><?php echo $term->name; ?></h1>

                <?php require app('path.views') . '/layouts/forms/header_form.php'; ?>
            </div>
        </div>

        <div class="cformbanner__banner" style="background: no-repeat center/cover url('<?php echo !empty(get_term_meta($term->term_id, 'direction_information_image', true)) ? wp_get_attachment_image_url(get_term_meta($term->term_id, 'direction_information_image', true), 'full') : ''; ?>');"></div>
    </div>

    <div class="bgdots bg1"></div>
    <div class="bgtext bgt1"></div>
</section>

<?php $services_object = model('service')->allByTerm($term->term_id, 12);
$services = $services_object->posts;
if (!empty($services)) : ?>
    <section class="dent-directs singlecat">
        <div class="container">
            <div class="row services-container">

                <?php foreach ($services as $service) :

                    require app('path.views') . '/service/elements/service-block.php';

                endforeach; ?>

            </div>

            <?php if ($services_object->max_num_pages > 1) : ?>
                <script>
                    const ajaxurl = '<?php echo appConfig('ajax_handler'); ?>';
                    const query = '<?php echo serialize($services_object->query_vars); ?>';
                    const max_pages = '<?php echo $services_object->max_num_pages; ?>';
                    let current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                </script>

                <div class="gomore">
                    <a href="#" id="loadMoreServices" class="gomore__lnk"><span><?php echo trans('Показать ещё'); ?></span><img src="<?php echo appConfig('theme_url'); ?>/img/reloadicon.svg" alt="More"></a>
                </div>

                <?php add_action('wp_footer', function() { ?>
                    <script>
                        jQuery(function($){
                            $('#loadMoreServices').click(function(e) {
                                e.preventDefault();
                                const loadButton = $(this);
                                const servicesContainer = $('.services-container');

                                loadButton.find('a').text('<?php echo trans('Загружаю...'); ?>');

                                const data = {
                                    'action': 'load_more_services',
                                    'query': query,
                                    'page' : current_page
                                };

                                $.ajax({
                                    url: ajaxurl,
                                    data: data,
                                    type:'POST',
                                    success:function(response){
                                        if (response) {
                                            loadButton.text('<?php echo trans('Загрузить ещё'); ?>');
                                            servicesContainer.append(response);
                                            resizeimgs();
                                            current_page++;
                                            if (current_page == max_pages) {
                                                loadButton.remove();
                                            }
                                        } else {
                                            loadButton.remove();
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                <?php }, 999); ?>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<!-- Benefits start -->
<?php require_once app('path.views') . '/page/front/section-benefits.php'; ?>
<!-- Benefits end -->

<section class="seosection">
    <div class="container mobfluid">
        <?php if (!empty(get_term_meta($term->term_id, 'direction_information_seo_text', true))) : ?>
            <div class="txtverticlimiter">
                <div class="constr txt1col">
                    <div class="container mobfluid">
                        <?php if (!empty(get_term_meta($term->term_id, 'direction_information_seo_title', true))) : ?>
                            <div class="headerwrap">
                                <div class="titlefigure"></div>
                                <h2 class="variablefz"><?php echo get_term_meta($term->term_id, 'direction_information_seo_title', true); ?></h2>
                            </div>
                        <?php endif; ?>
                
                        <?php echo wpautop(get_term_meta($term->term_id, 'direction_information_seo_text', true)); ?>
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
