<section class="cformbanner blogpage">
    <div class="cformbanner__wrap">
        <div class="cformbanner__textcol">
            <!-- Breadcrumbs -->
            <ul class="brdcrmb">
                <?php $home_page = get_post(get_option('page_on_front')); ?>
                <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                <li class="brdcrmb__li"><?php echo $page->post_title; ?></li>
            </ul>
            <!-- End Breadcrumbs -->

            <div class="cformbanner__textcol__formwrap">
                <h1 class="blogtitle"><?php echo $term->name; ?></h1>

<!--                --><?php //$main_article = model('post')->findMain(); ?>
<!---->
<!--                --><?php //if ($main_article) : ?>
<!--                    <h2 class="blogsubtitle variablefz">--><?php //echo $main_article->post_title; ?><!--</h2>-->
<!---->
<!--                    <p>--><?php //echo wpautop($main_article->post_excerpt); ?><!--</p>-->
<!---->
<!--                    <a href="--><?php //echo get_permalink($main_article->ID); ?><!--" class="catmainsec__desc__lnk"><span>--><?php //echo trans('Подробнее'); ?><!-- </span><img src="--><?php //echo appConfig('theme_url'); ?><!--/img/arrow_right.svg" alt=""></a>-->
<!--                --><?php //endif; ?>
            </div>
        </div>

        <?php if ($main_article) : ?>
            <div class="cformbanner__banner" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($main_article->ID) ? get_the_post_thumbnail_url($main_article->ID, 'full') : ''; ?>');"></div>
        <?php endif; ?>
    </div>

    <div class="bgdots bgtopcenter"></div>
    <div class="bgtext bgtopleft"></div>
</section>

<?php $article_objects = $taxonomy_query;
$articles = $article_objects->posts;
if (!empty($articles)) : ?>
    <section class="postssection blogpage">
        <div class="container mobfluid">
            <div class="row articles-container">

                <?php foreach ($articles as $article) :

                    require app('path.views') . '/page/articles/article-block.php';

                endforeach; ?>

            </div>

            <?php if ($article_objects->max_num_pages > 1) : ?>
                <script>
                    const ajaxurl = '<?php echo appConfig('ajax_handler'); ?>';
                    const query = '<?php echo serialize($article_objects->query_vars); ?>';
                    const max_pages = '<?php echo $article_objects->max_num_pages; ?>';
                    let current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                </script>

                <div class="gomore">
                    <a href="#" id="loadMoreArticles" class="gomore__lnk"><span><?php echo trans('Показать ещё статьи'); ?></span><img src="<?php echo appConfig('theme_url'); ?>/img/reloadicon.svg" alt="More"></a>
                </div>

            <?php add_action('wp_footer', function() { ?>
                <script>
                    jQuery(function($){
                        $('#loadMoreArticles').click(function(e) {
                            e.preventDefault();
                            const loadButton = $(this);
                            const articlesContainer = $('.articles-container');

                            loadButton.find('a').text('<?php echo trans('Загружаю...'); ?>');

                            const data = {
                                'action': 'load_more_articles',
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
                                        articlesContainer.append(response);
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
