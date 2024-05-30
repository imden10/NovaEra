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
                <h1 class="blogtitle"><?php echo $page->post_title; ?></h1>
            </div>
        </div>
    </div>

    <div class="bgdots bgtopcenter"></div>
    <div class="bgtext bgtopleft"></div>
</section>

<div class="blog-description">
    <?= $page->page_information_description ?? '' ?>
</div>

<?php $article_objects = model('post')->all(isset($main_article->ID) ? [$main_article->ID] : [], 12);
$articles = $article_objects->posts;
if (!empty($articles)) : ?>
    <section class="postssection blogpage">
        <div class="container">
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
