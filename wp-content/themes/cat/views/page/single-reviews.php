<section class="catmainsec reviewspage">
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
                </div>
            </div>

            <div class="col-lg-5">
                <div class="formwrap">
                    <span class="formwrap__subtitle"><?php echo trans('Напшите отзыв о клинике MK Dental Clinic'); ?></span>
                    <p class="formwrap__form__parag"><?php echo trans('Если вы посещали нашу клинику и хотите поделиться впечателниями, оставьте, отзыв. Будьте объективны, ваша оценка поможет другим определиться с выбором. Заранее благодарны за ваше участие!'); ?></p>
                    <input type="submit" class="formwrap__form__submit" id="reviewmodalshow" value="<?php echo trans('Оставить отзыв +'); ?>">
                </div>
            </div>
        </div>

        <?php $specializations = model('service')->terms();
        if (!empty($specializations)) : ?>
            <div class="categorieswrap sliderwraptrgt">
                <div class="categorieswrap__controlswrap">
                    <span class="categorieswrap__controlswrap__desc"><?php echo trans('Выберите направление, чтобы отфильтровать отзывы'); ?></span>
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

            <?php $reviews = model('review')->allWithTerms(); ?>
            <div class="reviewspage_wrap">

                <?php foreach ($specializations as $specialization) : ?>
                    <div class="direction-group" data-sort-key="<?php echo $specialization->term_id; ?>">
                        <h2 class="reviewspage_wrap__title"><?php echo $specialization->name; ?></h2>

                        <div class="reviews_wrap reviewsblock">
                            <?php foreach ($reviews as $review) :
                                if (!in_array($specialization->term_id, $review->categories)) continue; ?>

                                <div class="review_item">
                                    <div class="review_item__user_col">
                                        <img src="<?php echo has_post_thumbnail($review->ID) ? get_the_post_thumbnail_url($review->ID, 'thumbnail') : appConfig('theme_url') . '/img/user-icon.png'; ?>" alt="<?php echo $review->post_title; ?>" class="review_item__user_col__icon">

                                        <div class="review_item__user_col__rating">
                                            <?php for ($i = 1; $i <=5; $i++) : ?>
                                                <span class="rev_slider_item__user_col__rating__star<?php echo (int) $review->review_information_rating >= $i ? ' coloredstar' : ''; ?>">
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <?php endfor; ?>
                                        </div>

                                        <span class="review_item__user_col__name"><?php echo $review->post_title; ?></span>

                                        <span class="review_item__user_col__date"><?php echo getPostDate($review->post_date, 'd.m.Y'); ?></span>
                                    </div>

                                    <div class="review_item__content_col">
                                        <div class="review_item__content_col__content">
                                            <?php $service = model('service')->find($review->review_information_service); ?>
                                            <span class="rev_slider_item__content_col__content__title"><?php echo $service ? $service->post_title : ''; ?></span>

                                            <?php echo wpautop($review->post_content); ?>
                                        </div>

                                        <div class="review_item__content_col__footer">
                                            <div class="review_item__content_col__footer__proved">
                                                <div class="proved_icon">
                                                    <i class="fas fa-check"></i>
                                                </div>

                                                <span class="proved_text"><?php echo trans('Посещение клиники подтверждено'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="gomore">
                <a href="#" class="gomore__lnk"><span><?php echo trans('Показать ещё отзывы'); ?></span><img src="<?php echo appConfig('theme_url'); ?>/img/reloadicon.svg" alt="More"></a>
            </div>
        <?php endif; ?>

    </div>

    <div class="bgdots bgtopcenter"></div>
    <div class="bgdots bgcenterleft"></div>
    <div class="bgdots bgbotright"></div>
    <div class="bgtext bg3row bgtopleft"></div>
</section>

<section class="menu3items">
    <div class="container">
        <?php if (is_active_sidebar('information-section' )) : ?>
            <div class="row prikol">
                <?php dynamic_sidebar('information-section'); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="bgdots bgtopright"></div>
    <div class="bgdots bgbotleft"></div>
    <div class="bgtext bg3row bgtopleft"></div>
</section>

<?php require app('path.views') . '/layouts/forms/footer_form.php'; ?>
