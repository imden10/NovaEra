<section class="articlepage">
    <div class="container top-side">
        <ul class="breadcrumbs">
            <?php $home_page = get_post(get_option('page_on_front')); ?>
            <li class="breadcrumbs-item"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

            <?php $blog_page = get_post(get_option('page_for_posts')); ?>
            <li class="breadcrumbs-item"><a href="<?php echo get_permalink($blog_page->ID); ?>" class="brdcrmb__lnk"><?php echo $blog_page->post_title; ?></a></li>

            <li class="breadcrumbs-item"><?php echo $post->post_title; ?></li>
        </ul>

        <h1><?php echo $post->post_title; ?></h1>
        <div class="social-share">
            <span class="date">
                <?php echo $post->post_date ?>
            </span>
            <ul class="share">
                <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://nova-era.com.ua" target="_blank" class="ic-facebook" aria-label="Share on Facebook"></a>
                </li>
                <li>
                    <a href="https://twitter.com/intent/tweet?url=https://nova-era.com.ua&text=Check%20this%20out!" target="_blank" class="ic-twitter-simple" aria-label="Share on Twitter"></a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://nova-era.com.ua" target="_blank" class="ic-linkedin-simple" aria-label="Share on LinkedIn"></a>
                </li>
                <li onclick="copyLink()" class="ic-link" aria-label="Copy link">
                </li>
            </ul>
        </div>
        <div class="cformbanner__banner" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'full') : ''; ?>');"></div>
    </div>
</section>

<section class="article-container container">

    <?php buildContentFromConstructorArray('service', $post->post_information_body); ?>
    <div class="btn primary fill lg back">Назад</div>
    <div onclick="history.back" class="social-share bordered">
        <span class="date">
            <?php echo $post->post_date ?>
        </span>
        <ul class="share">
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://nova-era.com.ua" target="_blank" class="ic-facebook" aria-label="Share on Facebook"></a>
            </li>
            <li>
                <a href="https://twitter.com/intent/tweet?url=https://nova-era.com.ua&text=Check%20this%20out!" target="_blank" class="ic-twitter-simple" aria-label="Share on Twitter"></a>
            </li>
            <li>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://nova-era.com.ua" target="_blank" class="ic-linkedin-simple" aria-label="Share on LinkedIn"></a>
            </li>
            <li onclick="copyLink()" class="ic-link" aria-label="Copy link">
            </li>
        </ul>
    </div>
</section>



<?php $similarArticles = model('post')->similarArticles([$post->ID])->posts;
if (!empty($similarArticles)) : ?>
    <section class="otherposts">
        <div class="container">
            <div class="titlefigure"></div>
            <h2><?php echo trans('Другие посты на эту тему'); ?></h2>
            <div class="blocks">
                <div class="cards-wrapper card-in-row-4 ">
                    <?php foreach ($similarArticles as $item) : ?>
                        <a href="<?php echo get_permalink($similar->ID); ?>" class="card">

                            <img src="<?= get_image_url_by_id($item->image); ?>" alt="">



                            <div class="card-info">
                                <div class="title-wrp">
                                    <?php if ($item->post_title) : ?>
                                        <h2>
                                            <?php $item->post_title; ?>
                                        </h2>
                                    <?php endif; ?>
                                </div>


                                <?php if ($item->post_excerpt) : ?>
                                    <div class="description">
                                        <?= $item->post_excerpt; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>

                </div>
            </div>
            <!-- <div class="therpostssliderwrap sliderwraptrgt">
                <div class="therpostsslider">

                    <?php foreach ($similarArticles as $similar) : ?>
                        <a href="<?php echo get_permalink($similar->ID); ?>" class="postitem">
                            <div class="postitem__img" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($similar->ID) ? get_the_post_thumbnail_url($similar->ID, 'full') : ''; ?>');"></div>

                            <div class="postitem__textwrap">
                                <div class="postitem__cont">
                                    <h3 class="postitem__title"><?php echo $similar->post_title; ?></h3>

                                    <span class="postitem__subtitle">Эстетическая стоматология</span>

                                    <p class="postitem__text"><?php echo $similar->post_excerpt; ?></p>
                                </div>

                                <span class="postitem__lnk"><?php echo trans('Подробнее &#62'); ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>

                </div>
            </div> -->
        </div>
    </section>
<?php endif; ?>
<div class="up ic-chevron-up"></div>

<script>
    function copyLink() {
        const url = location.href;
        navigator.clipboard.writeText(url).then(() => {
            console.log('Link copied to clipboard');
        }).catch(err => {
            console.error('Error copying link: ', err);
        });
    }
</script>