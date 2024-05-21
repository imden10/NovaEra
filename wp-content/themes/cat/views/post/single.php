<section class="cformbanner articlepage">
    <div class="container articleheadcontainer">
        <div class="cformbanner__wrap">
            <div class="cformbanner__textcol">
                <!-- Breadcrumbs -->
                <ul class="brdcrmb">
                    <?php $home_page = get_post(get_option('page_on_front')); ?>
                    <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                    <?php $blog_page = get_post(get_option('page_for_posts')); ?>
                    <li class="brdcrmb__li"><a href="<?php echo get_permalink($blog_page->ID); ?>" class="brdcrmb__lnk"><?php echo $blog_page->post_title; ?></a></li>

                    <li class="brdcrmb__li"><?php echo $post->post_title; ?></li>
                </ul>
                <!-- End Breadcrumbs -->

                <div class="cformbanner__textcol__formwrap">
                    <h1 class="postpagetitle variablefz"><?php echo $post->post_title; ?></h1>
                </div>
            </div>

            <div class="cformbanner__banner" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'full') : ''; ?>');"></div>
        </div>
    </div>

    <div class="bgdots bgtopcenter"></div>
    <div class="bgtext bgtopleft"></div>
</section>

<section class="articlecontent">

    <?php buildContentFromConstructorArray('service', $post->post_information_body); ?>

</section>

<?php $similarArticles = model('post')->similarArticles([$post->ID])->posts;
if (!empty($similarArticles)) : ?>
    <section class="otherposts">
        <div class="container">
            <div class="headerwrap">
                <div class="titlefigure"></div>
                <h2 class="variablefz"><?php echo trans('Другие посты на эту тему'); ?></h2>
            </div>

            <div class="therpostssliderwrap sliderwraptrgt">
                <div class="therpostsslider owl-carousel">

                    <?php foreach ($similarArticles as $similar) : ?>
                        <a href="<?php echo get_permalink($similar->ID); ?>" class="postitem">
                            <div class="postitem__img" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($similar->ID) ? get_the_post_thumbnail_url($similar->ID, 'full') : ''; ?>');"></div>

                            <div class="postitem__textwrap">
                                <div class="postitem__cont">
                                    <h3 class="postitem__title"><?php echo $similar->post_title; ?></h3>

                                    <!--<span class="postitem__subtitle">Эстетическая стоматология</span>-->

                                    <p class="postitem__text"><?php echo $similar->post_excerpt; ?></p>
                                </div>

                                <span class="postitem__lnk"><?php echo trans('Подробнее &#62'); ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
