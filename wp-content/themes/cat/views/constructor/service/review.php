<?php

$reviews = !empty($content['ids']) ? get_posts([
    'post_type' => 'review',
    'posts_per_page' => -1,
    'post__in' => (array) $content['ids'],
    'orderby' => 'menu_order',
    'order' => 'ASC',
]) : [];

if (!empty($reviews)) : ?>

    <div class="constr reviewsblock">
        <div class="container">
            <div class="sectionheaderwrap">
                <div class="titlefigure"></div>
                <?php if (!empty($content['title'])) : ?>
                    <h2 class="sectionheader"><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-9 col-md-9 col-sm-12 expandcases">
                    <span class="sectionsubheader"><?php echo $content['subtitle']; ?></span>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="headerlnk-wrap">
                        <a href="<?php echo get_permalink(getCustomOption('relations_reviews_page')); ?>" class="headergoalllnk"><span><?php echo trans('Все отзывы'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="reviews_wrap">

                <?php foreach($reviews as $review) : ?>
                    <div class="review_item">
                        <div class="review_item__user_col">
                            <?php if (has_post_thumbnail($review->ID)) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url($review->ID, 'thumbnail'); ?>" alt="<?php echo $review->post_title; ?>" class="review_item__user_col__icon">
                            <?php endif; ?>

                            <div class="review_item__user_col__rating">
                                <?php for ($i = 1; $i <=5; $i++) : ?>
                                    <span class="review_item__user_col__rating__star<?php echo (int) $review->review_information_rating >= $i ? ' coloredstar' : ''; ?>">
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

            <div class="reviews_footer">
                <span class="reviews_footer__desc"><?php echo trans('Если вы посещали нашу клинику и хотите поделиться впечателниями, оставьте, отзыв. Будьте объективны, ваша оценка поможет другим определиться с выбором. Заранее благодарны за ваше участие! '); ?></span>

                <a href="#" data-review-id="<?php echo $review->ID; ?>" class="reviews_footer__lnk add-review-in-service add-review-button"><?php echo trans('Оставить отзыв'); ?></a>
            </div>
        </div>

        <div class="bgdots bgtopright"></div>
        <div class="bgdots bgcenterleft"></div>
        <div class="bgdots bgbotright"></div>
    </div>

<?php endif; ?>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>