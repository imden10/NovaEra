<section class="articlepage">
    <div class="container top-side">
        <ul class="breadcrumbs">
            <?php $home_page = get_post(get_option('page_on_front')); ?>
            <?php if ($post->post_information_breadcrumb_text) : ?>
                <li class="breadcrumbs-item"><a href="<?= $post->post_information_breadcrumb_url ?>" class="brdcrmb__lnk"><?= $post->post_information_breadcrumb_text ?></a></li>
            <?php elseif ($home_page->page_information_breadcrumb_text) : ?>
                <li class="breadcrumbs-item"><a href="<?= site_url() ?>" class="brdcrmb__lnk"><?= $home_page->page_information_breadcrumb_text ?></a></li>
            <?php else : ?>
                <li class="breadcrumbs-item"><a href="<?= site_url() ?>" class="brdcrmb__lnk"><?= $home_page->post_title ?></a></li>
            <?php endif ?>

            <?php $blog_page = get_post(get_option('page_for_posts')); ?>
            <li class="breadcrumbs-item"><a href="<?php echo get_permalink($blog_page->ID); ?>" class="brdcrmb__lnk"><?php echo $blog_page->post_title; ?></a></li>

            <!-- <li class="breadcrumbs-item"><?php echo $post->post_title; ?></li> -->
        </ul>
    </div>
    <div class="container article-container">

        <h1><?php echo $post->post_title; ?></h1>
        <div class="social-share">
            <span class="date">
                <?php echo date('d.m.Y', strtotime($post->post_date)); ?>
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
                <li onclick="copyLink(event)" class="ic-link copylink" aria-label="Copy link">
                    <span>copy</span>
                </li>
            </ul>
        </div>
        <!-- <div class="cformbanner__banner" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'full') : ''; ?>');"></div> -->
        <img class="article-banner" src="<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'full') : ''; ?>" alt="">
    </div>
</section>

<section class="article-container">

    <?php buildContentFromConstructorArray('service', $post->post_information_body); ?>
    <div class="container">
        <div onclick="history.back()" class="btn primary fill lg back"><i class="ic-chevron-left"></i> Назад</div>

        <div class="social-share bordered">
            <span class="date">
                <?php echo date('d.m.Y', strtotime($post->post_date)); ?>
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
    </div>
</section>



<?php $similarArticles = model('post')->similarArticles([$post->ID])->posts;
if (!empty($similarArticles)) : ?>
    <section class="otherposts">
        <div class="container">
            <div class="titlefigure"></div>
            <h2><?php echo trans('Тематичні публікації'); ?></h2>
            <div class="blocks">
                <div class="cards-wrapper card-in-row-4 ">
                    <?php foreach ($similarArticles as $item) : ?>
                        <a href="<?= get_permalink($item->ID); ?>" class="card card-article">
                            <?php if (get_the_post_thumbnail_url($item->ID, 'full')) : ?>
                                <img src="<?= get_the_post_thumbnail_url($item->ID, 'full'); ?> ?>" alt="">
                            <?php endif ?>
                            <div class="card-info">
                                <div class="title-wrp">
                                    <?php if ($item->post_title) : ?>
                                        <h2>
                                            <?= $item->post_title; ?>
                                        </h2>
                                    <?php endif; ?>
                                </div>

                                <p class="article-date"><?= date('d.m.Y', strtotime($item->post_date)); ?></p>

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
            <div class="btns-wrapper">
                <a href="/blog" class="btn primary fill lg">Всі статті <i class="ic-chevron-right"></i></a>
            </div>
        </div>
    </section>
<?php endif; ?>
<div class="up ic-chevron-up"></div>

<script>
    function copyLink(event) {
        event.target.classList.add('active');
        const url = location.href;
        navigator.clipboard.writeText(url).then(() => {
            console.log('Link copied to clipboard');
        }).catch(err => {
            console.error('Error copying link: ', err);
        });
        setTimeout(() => {
            event.target.classList.remove('active');
        }, 2000);
    }
</script>