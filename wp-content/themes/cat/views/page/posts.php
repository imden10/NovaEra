<div class="blogpage container">
    <div class="top-side">
        <ul class="breadcrumbs">
            <?php $home_page = get_post(get_option('page_on_front')); ?>
            <?php if ( $page->page_information_breadcrumb_text ): ?>
                <li class="breadcrumbs-item"><a href="<?= $page->page_information_breadcrumb_url ?>" class="brdcrmb__lnk"><?= $page->page_information_breadcrumb_text ?></a></li>
            <?php elseif ($home_page->page_information_breadcrumb_text): ?>
                <li class="breadcrumbs-item"><a href="<?= site_url() ?>" class="brdcrmb__lnk"><?= $home_page->page_information_breadcrumb_text ?></a></li>
            <?php else: ?>
                <li class="breadcrumbs-item"><a href="<?= site_url() ?>" class="brdcrmb__lnk"><?= $home_page->post_title ?></a></li>
            <?php endif ?>
            <li class="breadcrumbs-item"><?= $page->post_title; ?></li>
        </ul>
        <h1><?php echo $page->post_title; ?></h1>
    </div>
    <div class="blog-wrapper">


        <aside class="blog-aside">
            <div class="redactor">
                <?= $page->page_information_description ?? '' ?>
            </div>
        </aside>

        <section>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $article_objects = model('post')->all([], null, $paged);
            $articles = $article_objects->posts;
            if (!empty($articles)) : ?>

                <div class="article-list">
                    <?php foreach ($articles as $article) :
                        require app('path.views') . '/page/articles/article-block.php';
                    endforeach; ?>
                </div>

                <!-- Пагінація -->
                <div class="pagination">
                    <?php
                    $pagination_args = array(
                        'total'        => $article_objects->max_num_pages,
                        'current'      => $paged,
                        'show_all'     => false,
                        'end_size'     => 1,
                        'mid_size'     => 2,
                        'prev_next'    => true,
                        'prev_text'    => __('« Попередня'),
                        'next_text'    => __('Наступна »'),
                        'type'         => 'plain',
                    );
                    echo paginate_links($pagination_args);
                    ?>
                </div>

            <?php endif; ?>
        </section>
    </div>
</div>
<div class="up ic-chevron-up"></div>