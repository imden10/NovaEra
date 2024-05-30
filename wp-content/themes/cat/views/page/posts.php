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

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$article_objects = model('post')->all([], null, $paged);
$articles = $article_objects->posts;
if (!empty($articles)) : ?>
    <section class="postssection blogpage">
        <div class="container">
            <div class="row articles-container">

                <?php foreach ($articles as $article) :
                    require app('path.views') . '/page/articles/article-block.php';
                endforeach; ?>

            </div>
        </div>
    </section>

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
