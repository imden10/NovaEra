<div class="col-lg-4 col-md-6 col-sm-6">
    <a href="<?php echo get_permalink($article->ID); ?>" class="postitem">
        <div class="postitem__img" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($article->ID) ? get_the_post_thumbnail_url($article->ID, 'full') : ''; ?>');"></div>

        <div class="postitem__textwrap">
            <div class="postitem__cont">
                <h3 class="postitem__title"><?php echo $article->post_title; ?></h3>

                <!-- <span class="postitem__subtitle">Эстетическая стоматология</span>-->

                <p class="postitem__text"><?php echo $article->post_excerpt; ?></p>
            </div>

            <span class="postitem__lnk"><?php echo trans('Подробнее &#62'); ?></span>
        </div>
    </a>
</div>
