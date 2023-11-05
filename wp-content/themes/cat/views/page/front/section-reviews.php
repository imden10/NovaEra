<?php $reviews = model('review')->forFrontPage()->posts;
if (!empty($reviews)) : ?>
    <section class="reviews">
        <div class="container">
            <div class="sectionheaderwrap">
                <div class="titlefigure"></div>
                <h2 class="sectionheader"><?php echo trans('Отзывы наших пациентов'); ?></h2>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-9 col-md-9 col-12">
                    <span class="sectionsubheader"><?php echo trans('Мы публикуем отзывы настоящих клиентов, которые проходили лечение в нашей клинике.'); ?></span>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="headerlnk-wrap">
                        <a href="<?php echo get_permalink(getCustomOption('relations_reviews_page')); ?>" class="headergoalllnk"><span><?php echo trans('Все отзывы'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container monpad">
            <div class="rev_sliderwrap sliderwraptrgt">
                <div class="rev_slider owl-carousel">

                    <?php foreach($reviews as $review) : ?>
                        <div class="rev_slider_item">
                            <div class="rev_slider_item__user_col">
                                <img src="<?php echo has_post_thumbnail($review->ID) ? get_the_post_thumbnail_url($review->ID, 'thumbnail') : appConfig('theme_url') . '/img/user-icon.png'; ?>" alt="<?php echo $review->post_title; ?>" class="rev_slider_item__user_col__icon">

                                <div class="rev_slider_item__user_col__rating">
                                    <?php for ($i = 1; $i <=5; $i++) : ?>
                                        <span class="rev_slider_item__user_col__rating__star<?php echo (int) $review->review_information_rating >= $i ? ' coloredstar' : ''; ?>">
                                            <i class="fas fa-star"></i>
                                        </span>
                                    <?php endfor; ?>
                                </div>

                                <span class="rev_slider_item__user_col__name"><?php echo $review->post_title; ?></span>

                                <span class="rev_slider_item__user_col__date"><?php echo getPostDate($review->post_date, 'd.m.Y'); ?></span>
                            </div>

                            <div class="rev_slider_item__content_col">
                                <div class="rev_slider_item__content_col__content">
                                    <?php $service = model('service')->find($review->review_information_service); ?>
                                    <span class="rev_slider_item__content_col__content__title"><?php echo $service ? $service->post_title : ''; ?></span>

                                    <p><?php echo mb_substr(strip_tags($review->post_content), 0, 400); ?><?php if (mb_strlen(strip_tags($review->post_content)) > 400) echo '...'; ?></p>
                                </div>

                                <div class="rev_slider_item__content_col__footer">
                                    <?php if (mb_strlen(strip_tags($review->post_content)) > 400) : ?>
                                        <a href="#" data-review-id="<?php echo $review->ID; ?>" class="rev_slider_item__content_col__footer__detailslnk review-full-text-button"><?php echo trans('Читать весь отзыв'); ?></a>
                                    <?php endif; ?>

                                    <div class="rev_slider_item__content_col__footer__proved">
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

                <div class="rev_sliderwrap__controllwrap">
                    <div class="slider_controls">
                        <span class="slider_controls__prev" id="rev_slider_prev">
                            <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26 6.5H1.5M5 1L1 6.5L5 12" stroke="black" stroke-opacity="0.7"/>
                            </svg>
                        </span>

                        <span class="slider_controls__next" id="rev_slider_next">
                            <svg width="28" height="13" viewBox="0 0 28 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 6.5H26M22.5 1L26.5 6.5L22.5 12" stroke="white"/>
                            </svg>
                        </span>
                    </div>

                    <a href="#" class="rev_sliderwrap__controllwrap__reviewadd add-review-button"><?php echo trans('Оставить отзыв'); ?></a>
                </div>
            </div>
        </div>

        <div class="bgdots bgtopright"></div>
    </section>

    <!-- Review modals start -->
    <?php foreach($reviews as $review) : ?>
        <div id="modalReviewFullText<?php echo $review->ID; ?>" class="modalbg" style="display: none;">
            <div class="modalbody modalreview">
                <div class="modalclose">
                    <img src="<?php echo appConfig('theme_url'); ?>/img/modalclose.svg" alt="close" class="modalclose__img">
                </div>

                <div class="review_item">
                    <div class="review_item__user_col">
                        <?php if (has_post_thumbnail($review->ID)) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url($review->ID, 'thumbnail'); ?>" alt="<?php echo $review->post_title; ?>" class="review_item__user_col__icon">
                        <?php endif; ?>

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

                            <p><?php echo strip_tags($review->post_content); ?></p>
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
            </div>
        </div>
    <?php endforeach; ?>
    <!-- Review modals end -->

<?php endif; ?>
